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

require_once( 'PdfformsHelper.php' );

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
                         'openpassword'  => $objForm->pdff_openpassword,
                         'protectflags'  => deserialize($objForm->pdff_protectflags),
                         'password'      => $objForm->pdff_password,
                         'allpages'      => $objForm->pdff_allpages,
                         'offset'        => deserialize($objForm->pdff_offset),
                         'textcolor'     => $objForm->pdff_textcolor,
                         'title'         => $objForm->pdff_title,
                         'author'        => $objForm->pdff_author,
                         'arrFields'     => $arrFields,
                        );
        unset( $arrFields );
        if( !is_numeric($arrPDF['offset'][0] ) ) $arrPDF['offset'][0] = 0;
        if( !is_numeric($arrPDF['offset'][1] ) ) $arrPDF['offset'][1] = 0;

        if( !is_array($arrPDF['protectflags']) ) $arrPDF['protectflags'] = array( $arrPDF['protectflags'] );

        // HOOK: before pdf generation
        if( isset($GLOBALS['TL_HOOKS']['pdf_formsBeforePdf']) && \is_array($GLOBALS['TL_HOOKS']['pdf_formsBeforePdf']) ) {
            foreach( $GLOBALS['TL_HOOKS']['pdf_formsBeforePdf'] as $callback ) {
                $arrPDF = \System::importStatic($callback[0])->{$callback[1]}( $arrPDF, $this );
            }
        }

        //--- PDF-Datei erstellen ---

        // Include library
        require_once( TL_ROOT . '/system/config/tcpdf.php' );           // TCPDF-Konfiguration von Contao
        require_once( K_PATH_MAIN . 'tcpdf.php' );                      // Standard TCPDF
        require_once( TL_ROOT . '/vendor/setasign/fpdi/fpdi.php' );     // FPDI-Erweiterung

        PdfformsHelper::pdfforms( 'D', $arrPDF );
    }


    //-----------------------------------------------------------------
}
