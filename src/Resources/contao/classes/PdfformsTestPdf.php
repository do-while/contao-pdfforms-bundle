<?php

declare( strict_types=1 );

/**
 * Extension for Contao 5
 *
 * @copyright  Softleister 2014-2024
 * @author     Softleister <info@softleister.de>
 * @package    contao-pdfforms-bundle
 * @licence    LGPL
 * @see        https://github.com/do-while/contao-pdfforms-bundle
 */

namespace Softleister\PdfformsBundle;

use Contao\Input;
use Contao\Config;
use Contao\System;
use Contao\Backend;
use Contao\Database;
use Contao\FilesModel;
use Contao\StringUtil;
use Softleister\PdfformsBundle\PdfformsHelper;
use Symfony\Component\VarDumper\VarDumper;

//-----------------------------------------------------------------
//  PdfformsTestPdf:    Testausgabe des PDF
//-----------------------------------------------------------------
class PdfformsTestPdf extends Backend
{
    //-----------------------------------------------------------------------------------
    //  Test-PDF erstellen
    //-----------------------------------------------------------------------------------
    public function testpdf( )
    {
        if( Input::get('key') !== 'testpdf' ) return '';        // Falscher Aufruf

        $rootDir = System::getContainer()->getParameter('kernel.project_dir');

        // Formulareinstellungen laden
        $db = Database::getInstance();
        $objForm = $db->prepare("SELECT * FROM tl_form WHERE id=?")
                      ->limit(1)
                      ->execute(Input::get('id'));

        if( ($objForm->numRows < 1) || ($objForm->pdff_on != '1') ) return '';  // PDF-Forms abgeschaltet!

        // Aufbau eines Feldes mit den Feldtypen
        $objFields = $db->prepare("SELECT name, type FROM tl_form_field WHERE invisible<>1 AND pid=?")
                        ->execute($objForm->id);

        $arrFields = [];
        $arrTypes  = [];
        while( $objFields->next() ) {
            if( !empty($objFields->name) ) {
                $arrTypes[$objFields->name] = $objFields->type;
            }
        }
        foreach( $arrTypes as $key=>$type ) {
            $widgetName = PdfformsHelper::normalisierung( $key );       // normalisierter Feldname

            $arrFields[$widgetName]['type']    = $type;                 // Feldtyp (wichtig für die auswertenden InsertTags)
            $arrFields[$widgetName]['value']   = $key;                  // (gesendeter Wert) Im TestPDF: Feldname
            $arrFields[$widgetName]['orig']    = $key;                  // Original Feldname
            $arrFields[$widgetName]['options'] = '';                    // mögliche Optionen bei der Verarbeitung, z.B. 'basename:1'
        }

        $arrPDF = array( 'formid'        => $objForm->id,
                         'formtitle'     => $objForm->title,
                         'filename'      => StringUtil::restoreBasicEntities($objForm->title),
                         'vorlage'       => FilesModel::findByUuid($objForm->pdff_vorlage)->path ?? '',
                         'handler'       => $objForm->pdff_handler,
                         'savepath'      => FilesModel::findByUuid($objForm->pdff_savepath)->path ?? '',
                         'protect'       => $objForm->pdff_protect,
                         'openpassword'  => System::getContainer()->get('contao.insert_tag.parser')->replaceInline( PdfformsHelper::decrypt( $objForm->pdff_openpassword ) ),
                         'protectflags'  => StringUtil::deserialize($objForm->pdff_protectflags),
                         'password'      => System::getContainer()->get('contao.insert_tag.parser')->replaceInline( PdfformsHelper::decrypt( $objForm->pdff_password ) ),
                         'multiform'     => StringUtil::deserialize($objForm->pdff_multiform),
                         'allpages'      => $objForm->pdff_allpages,
                         'offset'        => [0, 0],
                         'textcolor'     => $objForm->pdff_textcolor,
                         'title'         => $objForm->pdff_title,
                         'author'        => $objForm->pdff_author,
                         'R'             => FilesModel::findByUuid($objForm->pdff_font)->path ?? '',
                         'B'             => FilesModel::findByUuid($objForm->pdff_fontb)->path ?? '',
                         'I'             => FilesModel::findByUuid($objForm->pdff_fonti)->path ?? '',
                         'IB'            => FilesModel::findByUuid($objForm->pdff_fontbi)->path ?? '',
                         'arrFields'     => $arrFields,
                        );
        unset( $arrFields );
        if( !is_array($arrPDF['protectflags']) ) $arrPDF['protectflags'] = array( $arrPDF['protectflags'] );

        // Offsets eintragen, wenn angegeben
        $ofs = StringUtil::deserialize($objForm->pdff_offset);
        if( isset($ofs[0]) && is_numeric($ofs[0]) ) $arrPDF['offset'][0] = $ofs[0];
        if( isset($ofs[1]) && is_numeric($ofs[1]) ) $arrPDF['offset'][1] = $ofs[1];


        // HOOK: before pdf generation
        if( isset($GLOBALS['TL_HOOKS']['pdf_formsBeforePdf']) && \is_array($GLOBALS['TL_HOOKS']['pdf_formsBeforePdf']) ) {
            foreach( $GLOBALS['TL_HOOKS']['pdf_formsBeforePdf'] as $callback ) {
                $arrPDF = System::importStatic($callback[0])->{$callback[1]}( $arrPDF );
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


        //--- PDF-Datei erstellen ---
        PdfformsHelper::pdfforms( 'D', $arrPDF );
    }


    //-----------------------------------------------------------------
}
