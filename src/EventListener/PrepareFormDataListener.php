<?php

declare( strict_types=1 );

/**
 * Extension for Contao 5
 *
 * @copyright  Softleister 2014-2024
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
use Symfony\Component\VarDumper\VarDumper;
use Softleister\PdfformsBundle\PdfformsHelper;
use Contao\CoreBundle\DependencyInjection\Attribute\AsHook;

define( 'SUBMITKEY', '__Zy7a9_jP6zZMbXMEJeRK__' );

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
    public function __invoke( array &$submittedData, array $labels, array $fields, Form $form, array &$files ): void
    {
        if( isset( $submittedData[ constant('SUBMITKEY') ] ) ) return;      // Das ist nicht der erste Aufruf dieses Submits (warum auch immer)
        $submittedData[ constant('SUBMITKEY') ] = true;                     // Test-Key in die Submit-Daten einschleusen (zur Erkennung der Wiederholung)

        if( $form->pdff_on != '1' ) return;                                 // PDF-Forms abgeschaltet!

        $rootDir = System::getContainer()->getParameter('kernel.project_dir');
        // Aufbau eines Feldes mit den Feldtypen
        $db = Database::getInstance( );
        $objFields = $db->prepare( "SELECT name, type FROM tl_form_field WHERE invisible<>1 AND pid=?" )
                        ->execute( $form->id );

        $arrFields = $arrTypes  = [];
        while( $objFields->next() ) {
            if( !empty( $objFields->name ) ) {
                $arrTypes[$objFields->name] = $objFields->type;
            }
        }
        foreach( $arrTypes as $key=>$type ) {
            $widgetName = PdfformsHelper::normalisierung( $key );           // normalisierter Feldname

            $arrFields[$widgetName]['type']  = $type;                       // Feldtyp (wichtig für die auswertenden InsertTags)
            $arrFields[$widgetName]['value'] = $submittedData[$key] ?? '';  // gesendeter Wert
            $arrFields[$widgetName]['orig']  = $key;                        // Original Feldname
        }
        foreach( $files as $key=>$upload ) {
            $widgetName = PdfformsHelper::normalisierung( $key );           // normalisierter Feldname

            if( !$upload['error'] ) {
                $arrFields[$widgetName]['value']    = $upload['tmp_name'];  // Datei im TMP-Verzeichnis
                $arrFields[$widgetName]['basename'] = $upload['name'];      // Basename der Datei
                $arrFields[$widgetName]['size']     = $upload['size'];      // Dateigröße
                $arrFields[$widgetName]['temp']     = 'system/tmp/' . basename( $upload['tmp_name'] ) . '.' . pathinfo( $upload['name'] )['extension'];  // TMP-Verzeichnis von Contao
            }
        }

        $filename = StringUtil::standardize( StringUtil::restoreBasicEntities( $form->title ) )
                  . System::getContainer()->get('contao.insert_tag.parser')->replaceInline( $form->pdff_fileext );
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
                         'openpassword'  => System::getContainer()->get('contao.insert_tag.parser')->replaceInline( PdfformsHelper::decrypt( $form->pdff_openpassword ) ),
                         'protectflags'  => StringUtil::deserialize( $form->pdff_protectflags, true ),
                         'password'      => System::getContainer()->get('contao.insert_tag.parser')->replaceInline( PdfformsHelper::decrypt( $form->pdff_password ) ),
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
    }


    //-----------------------------------------------------------------
}
