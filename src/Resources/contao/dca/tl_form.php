<?php

declare( strict_types=1 );

/**
 * Extension for Contao 5
 *
 * @copyright  Softleister 2014-2026
 * @author     Softleister <info@softleister.de>
 * @package    contao-pdfforms-bundle
 * @licence    LGPL
 * @see	       https://github.com/do-while/contao-pdfforms-bundle
 */

use Contao\Image;
use Contao\DataContainer;
use Softleister\PdfformsBundle\PdfformsHelper;
use Doctrine\DBAL\Platforms\AbstractMySQLPlatform;
use Contao\CoreBundle\DataContainer\PaletteManipulator;
use Contao\CoreBundle\DataContainer\DataContainerOperation;


PaletteManipulator::create()
    ->addLegend( 'pdff_legend', 'confirm_legend' )
    ->addField( 'pdff_on', 'pdff_legend', PaletteManipulator::POSITION_APPEND )
    ->applyToPalette( 'default', 'tl_form' );

// Subpalette hinzufügen
$GLOBALS['TL_DCA']['tl_form']['subpalettes']['pdff_on'] = 'pdff_vorlage,pdff_handler,pdff_savepath,pdff_userhome,pdff_fileext,pdff_multiform,pdff_allpages,pdff_offset,pdff_textcolor,pdff_title,pdff_author,pdff_protect,pdff_password,pdff_openpassword,pdff_protectflags,pdff_font,pdff_fontb,pdff_fonti,pdff_fontbi';

// Selector hinzufügen
$GLOBALS['TL_DCA']['tl_form']['palettes']['__selector__'][] = 'pdff_on'; 

// Positions-Icon hinzufügen
$GLOBALS['TL_DCA']['tl_form']['list']['operations']['positions'] = [
    'href'            => 'table=tl_pdff_positions',
    'icon'            => 'iconPDF.svg',
    'primary'         => true,
    'button_callback' => ['tl_pdff_form', 'renderPdfButton'],
];

// Kopplung mit weiterer Child-Tabelle aufbauen
$GLOBALS['TL_DCA']['tl_form']['config']['ctable'][] = 'tl_pdff_positions';


// Neue Felder hinzufügen
$GLOBALS['TL_DCA']['tl_form']['fields']['pdff_on'] = array (
    'exclude'           => true,
    'filter'            => true,
    'inputType'         => 'checkbox',
    'eval'              => ['submitOnChange' => true],
    'sql'               => ['type' => 'string', 'length' => 1, 'fixed' => true, 'default' => '']
);

$GLOBALS['TL_DCA']['tl_form']['fields']['pdff_vorlage'] = array (
    'exclude'           => true,
    'inputType'         => 'fileTree',
    'eval'              => ['filesOnly' => true, 'fieldType' => 'radio', 'mandatory' => true, 'tl_class' => 'clr w50', 'extensions' => 'pdf'],
    'sql'               => ['type' => 'binary', 'length' => 16, 'fixed' => true, 'notnull' => false],
);

$GLOBALS['TL_DCA']['tl_form']['fields']['pdff_handler'] = array (
    'default'           => 'save',
    'exclude'           => true,
    'inputType'         => 'select',
    'options'           => ['save', 'email'],
    'reference'         => &$GLOBALS['TL_LANG']['tl_form']['pdff_handlers'],
    'eval'              => ['tl_class' => 'w50'],
    'sql'               => ['type' => 'string', 'length' => 5, 'default' => '']
);

$GLOBALS['TL_DCA']['tl_form']['fields']['pdff_savepath'] = array (
    'exclude'           => true,
    'inputType'         => 'fileTree',
    'eval'              => ['files' => false, 'fieldType' => 'radio', 'tl_class' => 'clr w50'],
    'sql'               => ['type' => 'binary', 'length' => 16, 'fixed' => true, 'notnull' => false],
);

$GLOBALS['TL_DCA']['tl_form']['fields']['pdff_userhome'] = array (
    'exclude'           => true,
    'inputType'         => 'checkbox',
    'eval'              => ['tl_class' => 'm12 w50'],
    'sql'               => ['type' => 'string', 'length' => 1, 'fixed' => true, 'default' => '']
);

$GLOBALS['TL_DCA']['tl_form']['fields']['pdff_fileext'] = array (
    'default'           => '_{{date::ymd_His}}',
    'exclude'           => true,
    'inputType'         => 'text',
    'eval'              => ['maxlength' => 255, 'tl_class' => 'clr w50'],
    'sql'               => ['type' => 'string', 'length' => 255, 'default' => '_{{date::ymd_His}}']
);

$GLOBALS['TL_DCA']['tl_form']['fields']['pdff_allpages'] = array (
    'default'           => '1',
    'exclude'           => true,
    'inputType'         => 'checkbox',
    'eval'              => ['tl_class' => 'clr'],
    'sql'               => ['type' => 'string', 'length' => 1, 'fixed' => true, 'default' => '']
);

$GLOBALS['TL_DCA']['tl_form']['fields']['pdff_offset'] = array (
    'default'           => serialize( ['0', '0'] ),
    'exclude'           => true,
    'inputType'         => 'text',
    'eval'              => ['multiple' => true, 'size' => 2, 'rgxp' => 'digit', 'nospace' => true, 'tl_class' => 'w50'],
    'sql'               => ['type' => 'string', 'length' => 64, 'default' => '']
);

$GLOBALS['TL_DCA']['tl_form']['fields']['pdff_textcolor'] = array (
    'default'           => '000ac0',
    'inputType'         => 'text',
    'eval'              => ['maxlength' => 6, 'colorpicker' => true, 'isHexColor' => true, 'decodeEntities' => true, 'tl_class' => 'w50 wizard', 'style' => 'width:138px'],
    'sql'               => ['type' => 'string', 'length' => 64, 'default' => '']
);

$GLOBALS['TL_DCA']['tl_form']['fields']['pdff_title'] = array (
    'exclude'           => true,
    'inputType'         => 'text',
    'eval'              => ['maxlength' => 255, 'tl_class' => 'clr w50'],
    'sql'               => ['type' => 'string', 'length' => 255, 'default' => '']
);

$GLOBALS['TL_DCA']['tl_form']['fields']['pdff_author'] = array (
    'exclude'           => true,
    'inputType'         => 'text',
    'eval'              => ['maxlength' => 255, 'tl_class' => 'w50'],
    'sql'               => ['type' => 'string', 'length' => 255, 'default' => '']
);

$GLOBALS['TL_DCA']['tl_form']['fields']['pdff_protect'] = array (
    'exclude'           => true,
    'inputType'         => 'checkbox',
    'eval'              => ['tl_class' => 'clr w50 m12'],
    'sql'               => ['type' => 'string', 'length' => 1, 'fixed' => true, 'default' => '']
);

$GLOBALS['TL_DCA']['tl_form']['fields']['pdff_openpassword'] = array (
    'exclude'           => true,
    'inputType'         => 'text',
    'load_callback'     => [['Softleister\PdfformsBundle\PdfformsHelper', 'decrypt']],
    'save_callback'     => [['Softleister\PdfformsBundle\PdfformsHelper', 'encrypt']],
    'eval'              => ['preserveTags' => true, 'tl_class' => 'w50'],
    'sql'               => ['type' => 'string', 'length' => 255, 'default' => '']
);

$GLOBALS['TL_DCA']['tl_form']['fields']['pdff_password'] = array (
    'exclude'           => true,
    'inputType'         => 'text',
    'load_callback'     => [['Softleister\PdfformsBundle\PdfformsHelper', 'decrypt']],
    'save_callback'     => [['Softleister\PdfformsBundle\PdfformsHelper', 'encrypt']],
    'eval'              => ['preserveTags' => true, 'tl_class' => 'clr w50'],
    'sql'               => ['type' => 'string', 'length' => 255, 'default' => '']
);

$GLOBALS['TL_DCA']['tl_form']['fields']['pdff_protectflags'] = array (
    'exclude'           => true,
    'inputType'         => 'checkbox',
    'options'           => ['print', 'print-high', 'modify', 'assemble', 'extract', 'copy', 'annot-forms', 'fill-forms'],
    'reference'         => &$GLOBALS['TL_LANG']['tl_form']['pdff_protectflag'],
    'eval'              => ['multiple' => true, 'tl_class' => 'clr w50'],
    'sql'               => "blob NULL"
);

$GLOBALS['TL_DCA']['tl_form']['fields']['pdff_multiform'] = array (
    'inputType'         => 'rowWizard',
    'fields'            => array
                            (
                                'bedingung' => array
                                (
                                    'label'             => &$GLOBALS['TL_LANG']['tl_form']['multiform_bedingung'],
                                    'inputType'         => 'select',
                                    'eval'              => ['chosen' => true, 'includeBlankOption' => true],
                                    'options_callback'  => ['tl_pdff_form', 'getRowFelder'],
                                ),
                                'seiten' => array
                                (
                                    'label'             => &$GLOBALS['TL_LANG']['tl_form']['multiform_seiten'],
                                    'default'           => '',
                                    'inputType'         => 'text',
                                    'eval'              => ['allowHtml' => true],
                                ),
                            ),
    'eval'              => array
                            (
                                'tl_class'      => 'clr',
                                'actions'       => ['copy', 'delete'],
                            ),
    'sql'               => array
                            (
                                'type' => 'blob',
                                'length' => AbstractMySQLPlatform::LENGTH_LIMIT_BLOB,
                                'notnull' => false,
                            ),
);

$GLOBALS['TL_DCA']['tl_form']['fields']['pdff_font'] = array (
    'exclude'           => true,
    'inputType'         => 'fileTree',
    'eval'              => ['filesOnly' => true, 'fieldType' => 'radio', 'tl_class' => 'clr w50', 'extensions' => 'ttf,otf'],
    'sql'               => ['type' => 'binary', 'length' => 16, 'fixed' => true, 'notnull' => false],
);

$GLOBALS['TL_DCA']['tl_form']['fields']['pdff_fontb'] = array (
    'exclude'           => true,
    'inputType'         => 'fileTree',
    'eval'              => ['filesOnly' => true, 'fieldType' => 'radio', 'tl_class' => 'w50', 'extensions' => 'ttf,otf'],
    'sql'               => ['type' => 'binary', 'length' => 16, 'fixed' => true, 'notnull' => false],
);

$GLOBALS['TL_DCA']['tl_form']['fields']['pdff_fonti'] = array (
    'exclude'           => true,
    'inputType'         => 'fileTree',
    'eval'              => ['filesOnly' => true, 'fieldType' => 'radio', 'tl_class' => 'w50', 'extensions' => 'ttf,otf'],
    'sql'               => ['type' => 'binary', 'length' => 16, 'fixed' => true, 'notnull' => false],
);

$GLOBALS['TL_DCA']['tl_form']['fields']['pdff_fontbi'] = array (
    'exclude'           => true,
    'inputType'         => 'fileTree',
    'eval'              => ['filesOnly' => true, 'fieldType' => 'radio', 'tl_class' => 'w50', 'extensions' => 'ttf,otf'],
    'sql'               => ['type' => 'binary', 'length' => 16, 'fixed' => true, 'notnull' => false],
);


class tl_pdff_form extends tl_form
{
    //-----------------------------------------------------------------
    //  Erstellt eine Liste der Formularfelder
    //  $dc->currentRecord   ist die ID des tl_pdff_positions
    //-----------------------------------------------------------------
    public function getRowFelder( DataContainer $dc )
    {
        return PdfformsHelper::getFormFields( $dc->id );
    }


    //-----------------------------------------------------------------
    //  PDF-Button nur anzeigen, wenn "PDF-Formular ausfüllen" angehakt ist
    //-----------------------------------------------------------------
	public function renderPdfButton( DataContainerOperation $operation )
    {
		$row = $operation->getRecord( );

        if( empty( $row['pdff_on'] ) ) {
            $operation->hide( );
        }
    }


    //-----------------------------------------------------------------
}
