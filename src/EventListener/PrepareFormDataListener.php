<?php

declare( strict_types=1 );

/**
 * Extension for Contao 5
 *
 * @copyright  Softleister 2014-2025
 * @author     Softleister <info@softleister.de>
 * @package    contao-pdfforms-bundle
 * @licence    LGPL
 * @see	       https://github.com/do-while/contao-pdfforms-bundle
 */

namespace Softleister\PdfformsBundle\EventListener;

use Contao\Form;
use Contao\Dbafs;
use Contao\System;
use Contao\Database;
use Contao\FilesModel;
use Contao\StringUtil;
use Contao\FrontendUser;
use Softleister\PdfformsBundle\PdfformsHelper;
use Contao\CoreBundle\DependencyInjection\Attribute\AsHook;
use Symfony\Component\HttpFoundation\Request;

//-----------------------------------------------------------------
//  InsertTags abarbeiten
//
//  {{pdf_forms::pdfdocument}}
//  {{pdf_forms::pdfdocument::name}}
//  {{pdf_forms::password_random}}
//-----------------------------------------------------------------
#[AsHook('prepareFormData')]
class PrepareFormDataListener
{
    public const SUBMITKEY = '__Zy7a9_jP6zZMbXMEJeRK__';

    public function __invoke( array &$submittedData, array $labels, array $fields, Form $form, array &$files ): void
    {
        /** @var Request $request */
        $request = System::getContainer( )->get( 'request_stack' )->getCurrentRequest( );

        if( $request->attributes->has( self::SUBMITKEY ) ) return;                      // Das ist nicht der erste Aufruf dieses Submits (warum auch immer)
        $request->attributes->set( self::SUBMITKEY, true );                             // Test-Key in die Submit-Daten einschleusen (zur Erkennung der Wiederholung)

        if( $form->pdff_on != '1' ) return;                                             // PDF-Forms abgeschaltet!

        $rootDir = System::getContainer()->getParameter('kernel.project_dir');
        $tags = System::getContainer()->get('contao.insert_tag.parser');
        $session = System::getContainer()->get('request_stack')->getSession();
        if( $session && !$session->isStarted( ) ) {                                     // IF( keine Session )
            $session->start( );                                                         //   Session nachträglich starten
        }                                                                               // ENDIF

        // Aufbau eines Feldes mit den Feldtypen
        $db = Database::getInstance( );
        $objFields = $db->prepare( "SELECT name, type FROM tl_form_field WHERE invisible<>1 AND pid=?" )
                        ->execute( $form->id );

        $arrFields = $arrTypes  = [];
        $flag_mpforms = false;                                                          // erstmal kein mp_forms erkannt
        while( $objFields->next() ) {                                                   // WHILE ( Einträge )
            if( $objFields->type === 'mp_form_pageswitch' ) $flag_mpforms = true;       //   IF( Pageswitch ) mp_forms erkannt!
            if( !empty( $objFields->name ) ) {                                          //   IF( Feldname )
                $arrTypes[$objFields->name] = $objFields->type;                         //     Feld in die Liste aufnahmen
            }                                                                           //   ENDIF
        }                                                                               // END WHILE

        // Bei mp_forms-Verwendung muss ab Step 2 die Session erst geladen werden
        if( $flag_mpforms && ( $tags->replaceInline( '{{mp_forms::' . $form->id . '::step::current}}' ) > 1 ) ) {
            $arrFields = $session?->get( 'pdf_forms.form_' . $form->id . '.arrFields', [] );    // ggf. vorhandene Daten laden
        }

        foreach( $arrTypes as $key=>$type ) {                                           // Alle Felder verarbeiten
            if( isset( $submittedData[$key] ) ) {                                       // IF( Feld in den Daten vorhanden )
                $widgetName = PdfformsHelper::normalisierung( $key );                   //   normalisierter Feldname

                $arrFields[$widgetName]['type']  = $type;                               //   Feldtyp (wichtig für die auswertenden InsertTags)
                $arrFields[$widgetName]['value'] = $submittedData[$key];                //   gesendeter Wert
                $arrFields[$widgetName]['orig']  = $key;                                //   Original Feldname
            }                                                                           // ENDIF
        }           
        foreach( $files as $key=>$upload ) {                                            // Alle Uploads verarbeiten           
            if( isset( $arrTypes[$key] ) ) {                                            // IF( Feld in den Daten vorhanden )
                $widgetName = PdfformsHelper::normalisierung( $key );                   //   normalisierter Feldname

                if( !$upload['error'] ) {           
                    $newPath = dirname( $upload['tmp_name'] ) . '/_' . basename( $upload['tmp_name'] );     // TMP-Datei umbennen, um das Löschen zu verhindern
                    if( copy( $upload['tmp_name'], $newPath ) ) {
                        $upload['tmp_name'] = $newPath;
                    }
                    $arrFields[$widgetName]['value']    = $upload['tmp_name'];          //   Datei im TMP-Verzeichnis
                    $arrFields[$widgetName]['basename'] = $upload['name'];              //   Basename der Datei
                    $arrFields[$widgetName]['size']     = $upload['size'];              //   Dateigröße
                    $arrFields[$widgetName]['temp']     = 'system/tmp/' . basename( $upload['tmp_name'] ) . '.' . pathinfo( $upload['name'] )['extension'];  // TMP-Verzeichnis von Contao
                }
            }                                                                           // ENDIF
        }
        $session?->set( 'pdf_forms.form_' . $form->id . '.arrFields', $arrFields );     // Aktualisierte Formulardaten wieder in die Session

        // bei mp_forms muss ggf. weiter gesammelt werden
        if( $flag_mpforms && ( $tags->replaceInline( '{{mp_forms::' . $form->id . '::step::percentage}}' ) < 99.9 ) ) {
            return;                                                                     // Hier abbrechen bei mp_forms, wenn nicht finales Formular
        }

        // Beginn der Verarbeitung der Formulardaten
        $session?->set( 'pdf_forms.formid', $form->id ) ;

        // Dateinamen festlegen
        // Der InsertTag {{form_session_data::*}} steht noch nicht zur Verfügung, 
        // daher muss das zuvor manuell ersetzt werden
        $fileext = $form->pdff_fileext;
        if( preg_match_all( '/\{\{form_session_data::([^}]+)\}\}/', $fileext, $matches ) ) {    // suchen nach 'form_session_data' => $matches[1]
            foreach( $matches[1] as $fieldName ) {
                if( isset( $submittedData[$fieldName] ) ) {
                    $fileext = str_replace( '{{form_session_data::' . $fieldName . '}}', $submittedData[$fieldName], $fileext );
                }
            }
        }
        $fileext = $tags->replaceInline( $fileext );

        $filename = StringUtil::standardize( StringUtil::restoreBasicEntities( $form->title ) ) . $fileext;
        $savepath = FilesModel::findByUuid( $form->pdff_savepath )->path ?? '';

        // Speichern im Home-Verzeichnis des eingeloggten Benutzers
        if( $form->pdff_userhome && System::getContainer( )->get( 'contao.security.token_checker' )->hasFrontendUser( ) ) { // IF( User eingeloggt )

            $user = FrontendUser::getInstance( );
            if( $user->assignDir && $user->homeDir ) {                                                                      //   IF( User hat HomeDir )

                $dir = FilesModel::findByUuid( $user->homeDir )->path;                                                      //     HomeDir ermitteln
                if( is_dir( $rootDir . '/' . $dir ) ) {                                                                     //     IF( HomeDir ist Verzeichnis )
                    $savepath = $dir;                                                                                       //       HomeDir verwenden
                }
            }
        }

        if( file_exists( $rootDir . '/' . $savepath . '/' . $filename . '.pdf' ) ) {
            $i = 2;
            while( file_exists( $rootDir . '/' . $savepath . '/' . $filename . '-' . $i . '.pdf' ) ) $i++;
            $filename = $filename . '-' . $i;
        }
        $pdfdatei = $savepath . '/' . $filename . '.pdf';
        file_put_contents( $rootDir . '/' . $pdfdatei, '' );                // leere Datei erzeugen um Dateinamen zu sichern

        $arrPDF = array( 'formid'        => $form->id,
                         'formtitle'     => $form->title,
                         'filename'      => $filename,
                         'vorlage'       => FilesModel::findByUuid( $form->pdff_vorlage )->path ?? '',
                         'handler'       => $form->pdff_handler,
                         'savepath'      => $savepath,
                         'protect'       => $form->pdff_protect,
                         'openpassword'  => $tags->replaceInline( PdfformsHelper::decrypt( $form->pdff_openpassword ) ),
                         'protectflags'  => StringUtil::deserialize( $form->pdff_protectflags, true ),
                         'password'      => $tags->replaceInline( PdfformsHelper::decrypt( $form->pdff_password ) ),
                         'multiform'     => StringUtil::deserialize( $form->pdff_multiform, true ),
                         'allpages'      => $form->pdff_allpages,
                         'offset'        => [0, 0],
                         'textcolor'     => $form->pdff_textcolor,
                         'title'         => $form->pdff_title,
                         'author'        => $form->pdff_author,
                         'R'             => FilesModel::findByUuid( $form->pdff_font )->path ?? '',
                         'B'             => FilesModel::findByUuid( $form->pdff_fontb )->path ?? '',
                         'I'             => FilesModel::findByUuid( $form->pdff_fonti )->path ?? '',
                         'IB'            => FilesModel::findByUuid( $form->pdff_fontbi )->path ?? '',
                         'arrFields'     => $arrFields,
                       );
        unset( $arrFields );
        $session?->remove( 'pdf_forms.form_' . $form->id . '.arrFields' );      // Gesammelte Sessiondaten zum Formular löschen

        // Offsets eintragen, wenn angegeben
        $ofs = StringUtil::deserialize( $form->pdff_offset );
        if( isset( $ofs[0] ) && is_numeric( $ofs[0] ) ) $arrPDF['offset'][0] = $ofs[0];
        if( isset( $ofs[1] ) && is_numeric( $ofs[1] ) ) $arrPDF['offset'][1] = $ofs[1];

        // HOOK: before pdf generation
        if( isset( $GLOBALS['TL_HOOKS']['pdf_formsBeforePdf'] ) && \is_array( $GLOBALS['TL_HOOKS']['pdf_formsBeforePdf'] ) ) {
            foreach( $GLOBALS['TL_HOOKS']['pdf_formsBeforePdf'] as $callback ) {
                $arrPDF = System::importStatic( $callback[0] )->{$callback[1]}( $arrPDF );
            }
        }


        // Own tcpdf.php from files directory
        if( file_exists($rootDir . '/files/tcpdf.php') ) {
            require_once($rootDir . '/files/tcpdf.php');
        }
        // ELSE: not found? - Then take it from this extension
        else {
            require_once($rootDir . '/vendor/do-while/contao-pdfforms-bundle/src/Resources/contao/config/tcpdf.php');
        }

        //--- PDF-Datei erstellen und speichern ---
        if( PdfformsHelper::pdfforms( 'S', $arrPDF, $pdfdatei ) ) {

            //--- PDF-Datei in der Dateiverwaltung eintragen ---
            $objFile = Dbafs::addResource( $pdfdatei );                // Datei in der Dateiverwaltung eintragen

            //--- PDF-Datei wenn gefordert als E-Mail-Anhang bereitstellen ---
            if( $arrPDF['handler'] === 'email' ) {                      //=== Datei an die E-Mail anhängen? ===
                $files['pdfattachment'] = [                             // Add the PDF file as attachment
                    'name'      => $arrPDF['filename'] . '.pdf',
                    'tmp_name'  => $rootDir . '/' . $pdfdatei,
                    'type'      => 'application/x-pdf',
                    'error'     =>  0,
                    'size'      =>  filesize( $rootDir . '/' . $pdfdatei ),
                ];
            }

            // HOOK: after pdf generation
            if( isset( $GLOBALS['TL_HOOKS']['pdf_formsAfterPdf'] ) && \is_array( $GLOBALS['TL_HOOKS']['pdf_formsAfterPdf'] ) ) {
                foreach( $GLOBALS['TL_HOOKS']['pdf_formsAfterPdf'] as $callback ) {
                    System::importStatic( $callback[0] )->{$callback[1]}( $pdfdatei, $arrPDF );
                }
            }
        }
        else {
            $pdfdatei = '';        // es wurde keine Datei erzeugt
        }

        //--- temporäre Upload-Dateien aufräumen ---
        foreach( $arrPDF['arrFields'] AS $key=>$attr ) {            // FOREACH Alle Formularfelder durchsuchen
            if( !isset( $attr['basename'] ) ) continue;             //   Nur Temporäre Dateien

            if( file_exists( $attr['value'] ) ) {                   //   IF( TMP-Datei existiert noch )
                @unlink( $attr['value'] );                          //     Datei löschen
            }                                                       //   ENDIF  
        }                                                           // ENDFOREACH
    }


    //-----------------------------------------------------------------
}
