<?php

/**
 * Extension for Contao 4
 *
 * @copyright  Softleister 2014-2018
 * @author     Softleister <info@softleister.de>
 * @package    contao-pdfforms-bundle
 * @licence    LGPL
 * @see        https://github.com/do-while/contao-pdfforms-bundle
 */

namespace Softleister\Pdfforms;

require_once( TL_ROOT . '/vendor/do-while/contao-pdfforms-bundle/src/Resources/contao/classes/PdfformsHelper.php' );

//-----------------------------------------------------------------
//  PdfformsTestPdf:    Testausgabe des PDF
//-----------------------------------------------------------------
class PdfformsTestPdf extends \Backend
{
    //-----------------------------------------------------------------------------------
    //  Test-PDF erstellen
    //-----------------------------------------------------------------------------------
    public function testpdf( )
    {
        if( \Input::get('key') !== 'testpdf' ) return '';        // Falscher Aufruf

        // Formulareinstellungen laden
        $db = \Database::getInstance();
        $objForm = $db->prepare("SELECT * FROM tl_form WHERE id=?")
                      ->limit(1)
                      ->execute(\Input::get('id'));

        if( ($objForm->numRows < 1) || ($objForm->pdff_on != '1') ) return '';  // PDF-Forms abgeschaltet!

        // Aufbau eines Feldes mit den Feldtypen
        $objFields = $db->prepare("SELECT name, type FROM tl_form_field WHERE invisible<>1 AND pid=?")
                        ->execute($objForm->id);

        $arrFields = array();
        $arrTypes  = array();
        while( $objFields->next() ) {
            if( !empty($objFields->name) ) {
                $arrTypes[$objFields->name] = $objFields->type;
            }
        }
        foreach( $arrTypes as $key=>$type ) {
            $widgetName = PdfformsHelper::normalisierung($key);         // normalisierter Feldname

            $arrFields[$widgetName]['type']  = $type;                   // Feldtyp (wichtig für die auswertenden InsertTags)
            $arrFields[$widgetName]['value'] = $arrSubmitted[$key];     // gesendeter Wert
            $arrFields[$widgetName]['orig']  = $key;                    // Original Feldname
        }

        $arrPDF = array( 'formid'        => $objForm->id,
                         'formtitle'     => $objForm->title,
                         'filename'      => \StringUtil::restoreBasicEntities($objForm->title),
                         'vorlage'       => \FilesModel::findByUuid($objForm->pdff_vorlage)->path,
                         'handler'       => $objForm->pdff_handler,
                         'savepath'      => \FilesModel::findByUuid($objForm->pdff_savepath)->path,
                         'protect'       => $objForm->pdff_protect,
                         'openpassword'  => \Controller::replaceInsertTags( PdfformsHelper::decrypt($objForm->pdff_openpassword) ),
                         'protectflags'  => deserialize($objForm->pdff_protectflags),
                         'password'      => \Controller::replaceInsertTags( PdfformsHelper::decrypt($objForm->pdff_password) ),
                         'multiform'     => deserialize($objForm->pdff_multiform),
                         'allpages'      => $objForm->pdff_allpages,
                         'offset'        => array(0, 0),
                         'textcolor'     => $objForm->pdff_textcolor,
                         'title'         => $objForm->pdff_title,
                         'author'        => $objForm->pdff_author,
                         'arrFields'     => $arrFields,
                        );
        unset( $arrFields );
        if( !is_array($arrPDF['protectflags']) ) $arrPDF['protectflags'] = array( $arrPDF['protectflags'] );

        // Offsets eintragen, wenn angegeben
        $ofs = deserialize($objForm->pdff_offset);
        if( isset($ofs[0]) && is_numeric($ofs[0]) ) $arrPDF['offset'][0] = $ofs[0];
        if( isset($ofs[1]) && is_numeric($ofs[1]) ) $arrPDF['offset'][1] = $ofs[1];


        // HOOK: before pdf generation
        if( isset($GLOBALS['TL_HOOKS']['pdf_formsBeforePdf']) && \is_array($GLOBALS['TL_HOOKS']['pdf_formsBeforePdf']) ) {
            foreach( $GLOBALS['TL_HOOKS']['pdf_formsBeforePdf'] as $callback ) {
                $arrPDF = \System::importStatic($callback[0])->{$callback[1]}( $arrPDF, $this );
            }
        }


        //-- Include Settings
        $tcpdfinit = \Config::get("pdftemplateTcpdf");

        // 1: Own settings addressed via app/config/config.yml
        if( !empty($tcpdfinit) && file_exists(TL_ROOT . '/' . $tcpdfinit) ) {
            require_once(TL_ROOT . '/' . $tcpdfinit);
        }
        // 2: Own tcpdf.php from files directory
        else if( file_exists(TL_ROOT . '/files/tcpdf.php') ) {
            require_once(TL_ROOT . '/files/tcpdf.php');
        }
        // 3: From config directory (up to Contao 4.6)
        else if( file_exists(TL_ROOT . '/vendor/contao/core-bundle/src/Resources/contao/config/tcpdf.php') ) {
            require_once(TL_ROOT . '/vendor/contao/core-bundle/src/Resources/contao/config/tcpdf.php');
        }
        // 4: From config directory of tcpdf-bundle (from Contao 4.7)
        else if( file_exists(TL_ROOT . '/vendor/contao/tcpdf-bundle/src/Resources/contao/config/tcpdf.php') ) {
            require_once(TL_ROOT . '/vendor/contao/tcpdf-bundle/src/Resources/contao/config/tcpdf.php');
        }
        // 5: not found? - Then take it from this extension
        else {
            require_once(TL_ROOT . '/vendor/do-while/contao-pdfforms-bundle/src/Resources/contao/config/tcpdf.php');
        }


        //--- PDF-Datei erstellen ---
        PdfformsHelper::pdfforms( 'D', $arrPDF );
    }


    //-----------------------------------------------------------------
}
