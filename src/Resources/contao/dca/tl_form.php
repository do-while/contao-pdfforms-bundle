<?php

/**
 * Extension for Contao 4
 *
 * @copyright  Softleister 2014-2021
 * @author     Softleister <info@softleister.de>
 * @package    contao-pdfforms-bundle
 * @licence    LGPL
 * @see	       https://github.com/do-while/contao-pdfforms-bundle
 */

require_once( TL_ROOT . '/vendor/do-while/contao-pdfforms-bundle/src/Resources/contao/classes/PdfformsHelper.php' );

// Subpalette hinzufügen
$GLOBALS['TL_DCA']['tl_form']['subpalettes']['pdff_on']      = 'pdff_vorlage,pdff_handler,pdff_savepath,pdff_fileext,pdff_notification,pdff_multiform,pdff_allpages,pdff_offset,pdff_textcolor,pdff_title,pdff_author,pdff_protect;{pdff_fontlegend:hide},pdff_font,pdff_fontb,pdff_fonti,pdff_fontbi';
$GLOBALS['TL_DCA']['tl_form']['subpalettes']['pdff_protect'] = 'pdff_password,pdff_openpassword,pdff_protectflags';

// Selector hinzufügen
$GLOBALS['TL_DCA']['tl_form']['palettes']['__selector__'][] = 'pdff_on'; 
$GLOBALS['TL_DCA']['tl_form']['palettes']['__selector__'][] = 'pdff_protect'; 
$GLOBALS['TL_DCA']['tl_form']['palettes']['default'] = str_replace( '{email_legend', '{pdff_legend:hide},pdff_on;{email_legend', $GLOBALS['TL_DCA']['tl_form']['palettes']['default'] );

// Positions-Icon hinzufügen
$GLOBALS['TL_DCA']['tl_form']['list']['operations']['positions'] = array (
    'label'     => &$GLOBALS['TL_LANG']['tl_form']['positions'],
    'href'      => 'table=tl_pdff_positions',
    'icon'      => 'bundles/softleisterpdfforms/pdf_positions.png'
);

// Kopplung mit weiterer Child-Tabelle aufbauen
$GLOBALS['TL_DCA']['tl_form']['config']['ctable'][] = 'tl_pdff_positions';

if( !class_exists( 'NotificationCenter\tl_form' ) ) {
    $GLOBALS['TL_DCA']['tl_form']['subpalettes']['pdff_on'] = str_replace( ',pdff_notification', '', $GLOBALS['TL_DCA']['tl_form']['subpalettes']['pdff_on'] );
}



// Neue Felder hinzufügen
$GLOBALS['TL_DCA']['tl_form']['fields']['pdff_on'] = array (
    'label'     => &$GLOBALS['TL_LANG']['tl_form']['pdff_on'],
    'exclude'   => true,
    'filter'    => true,
    'inputType' => 'checkbox',
    'eval'      => array('submitOnChange'=>true),
    'sql'       => "char(1) NOT NULL default ''"
);

$GLOBALS['TL_DCA']['tl_form']['fields']['pdff_vorlage'] = array (
    'label'     => &$GLOBALS['TL_LANG']['tl_form']['pdff_vorlage'],
    'exclude'   => true,
    'inputType' => 'fileTree',
    'eval'      => array('filesOnly'=>true, 'fieldType'=>'radio', 'mandatory'=>true, 'tl_class'=>'clr w50', 'extensions'=>'pdf'),
    'sql'       => "binary(16) NULL",
);

$GLOBALS['TL_DCA']['tl_form']['fields']['pdff_handler'] = array (
    'label'     => &$GLOBALS['TL_LANG']['tl_form']['pdff_handler'],
    'default'   => 'save',
    'exclude'   => true,
    'inputType' => 'select',
    'options'   => array('save', 'email'),
    'reference' => &$GLOBALS['TL_LANG']['tl_form']['pdff_handlers'],
    'eval'      => array('tl_class'=>'w50'),
    'sql'       => "varchar(5) NOT NULL default ''"
);

$GLOBALS['TL_DCA']['tl_form']['fields']['pdff_savepath'] = array (
    'label'     => &$GLOBALS['TL_LANG']['tl_form']['pdff_savepath'],
    'exclude'   => true,
    'inputType' => 'fileTree',
    'eval'      => array('files'=>false, 'fieldType'=>'radio', 'tl_class'=>'clr'),
    'sql'       => "binary(16) NULL",
);

$GLOBALS['TL_DCA']['tl_form']['fields']['pdff_fileext'] = array (
    'label'     => &$GLOBALS['TL_LANG']['tl_form']['pdff_fileext'],
    'default'   => '_{{date::ymd_His}}',
    'exclude'   => true,
    'inputType' => 'text',
    'eval'      => array('maxlength'=>255, 'tl_class'=>'w50'),
    'sql'       => "varchar(255) NOT NULL default '_{{date::ymd_His}}'"
);

$GLOBALS['TL_DCA']['tl_form']['fields']['pdff_notification'] = array
(
    'label'                     => &$GLOBALS['TL_LANG']['tl_form']['nc_notification'],
    'exclude'                   => true,
    'inputType'                 => 'select',
    'options_callback'          => array('tl_pdff_form', 'getNotificationChoices'),
    'eval'                      => array('includeBlankOption'=>true, 'chosen'=>true, 'tl_class'=>'clr'),
    'sql'                       => "int(10) unsigned NOT NULL default '0'"
);

$GLOBALS['TL_DCA']['tl_form']['fields']['pdff_allpages'] = array (
    'label'     => &$GLOBALS['TL_LANG']['tl_form']['pdff_allpages'],
    'default'   => '1',
    'exclude'   => true,
    'inputType' => 'checkbox',
    'eval'      => array('tl_class'=>'clr'),
    'sql'       => "char(1) NOT NULL default ''"
);

$GLOBALS['TL_DCA']['tl_form']['fields']['pdff_offset'] = array (
    'label'     => &$GLOBALS['TL_LANG']['tl_form']['pdff_offset'],
    'default'   => serialize(array('0', '0')),
    'exclude'   => true,
    'inputType' => 'text',
    'eval'      => array('multiple'=>true, 'size'=>2, 'rgxp'=>'digit', 'nospace'=>true, 'tl_class'=>'w50'),
    'sql'       => "varchar(64) NOT NULL default ''"
);

$GLOBALS['TL_DCA']['tl_form']['fields']['pdff_textcolor'] = array (
    'label'     => &$GLOBALS['TL_LANG']['tl_form']['pdff_textcolor'],
    'default'   => '000ac0',
    'inputType' => 'text',
    'eval'      => array('maxlength'=>6, 'colorpicker'=>true, 'isHexColor'=>true, 'decodeEntities'=>true, 'tl_class'=>'w50 wizard', 'style'=>'width:138px'),
    'sql'       => "varchar(64) NOT NULL default ''"
);

$GLOBALS['TL_DCA']['tl_form']['fields']['pdff_title'] = array (
    'label'     => &$GLOBALS['TL_LANG']['tl_form']['pdff_title'],
    'exclude'   => true,
    'inputType' => 'text',
    'eval'      => array('maxlength'=>255, 'tl_class'=>'clr w50'),
    'sql'       => "varchar(255) NOT NULL default ''"
);

$GLOBALS['TL_DCA']['tl_form']['fields']['pdff_author'] = array (
    'label'     => &$GLOBALS['TL_LANG']['tl_form']['pdff_author'],
    'exclude'   => true,
    'inputType' => 'text',
    'eval'      => array('maxlength'=>255, 'tl_class'=>'w50'),
    'sql'       => "varchar(255) NOT NULL default ''"
);

$GLOBALS['TL_DCA']['tl_form']['fields']['pdff_protect'] = array (
    'label'     => &$GLOBALS['TL_LANG']['tl_form']['pdff_protect'],
    'exclude'   => true,
    'inputType' => 'checkbox',
    'eval'      => array('submitOnChange'=>true, 'tl_class'=>'clr w50 m12'),
    'sql'       => "char(1) NOT NULL default ''"
);

$GLOBALS['TL_DCA']['tl_form']['fields']['pdff_openpassword'] = array (
    'label'         => &$GLOBALS['TL_LANG']['tl_form']['pdff_openpassword'],
    'exclude'       => true,
    'inputType'     => 'text',
    'load_callback' => array( array('Softleister\Pdfforms\PdfformsHelper', 'decrypt') ),
    'save_callback' => array( array('Softleister\Pdfforms\PdfformsHelper', 'encrypt') ),
    'eval'          => array('preserveTags'=>true, 'tl_class'=>'w50'),
    'sql'           => "varchar(255) NOT NULL default ''"
);

$GLOBALS['TL_DCA']['tl_form']['fields']['pdff_password'] = array (
    'label'         => &$GLOBALS['TL_LANG']['tl_form']['pdff_password'],
    'exclude'       => true,
    'inputType'     => 'text',
    'load_callback' => array( array('Softleister\Pdfforms\PdfformsHelper', 'decrypt') ),
    'save_callback' => array( array('Softleister\Pdfforms\PdfformsHelper', 'encrypt') ),
    'eval'          => array('preserveTags'=>true, 'tl_class'=>'clr w50'),
    'sql'           => "varchar(255) NOT NULL default ''"
);

$GLOBALS['TL_DCA']['tl_form']['fields']['pdff_protectflags'] = array (
    'label'     => &$GLOBALS['TL_LANG']['tl_form']['pdff_protectflags'],
    'exclude'   => true,
    'inputType' => 'checkbox',
    'options'   => array('print', 'print-high', 'modify', 'assemble', 'extract', 'copy', 'annot-forms', 'fill-forms'),
    'reference' => &$GLOBALS['TL_LANG']['tl_form']['pdff_protectflag'],
    'eval'      => array('multiple'=>true, 'tl_class'=>'clr w50'),
    'sql'       => "blob NULL"
);

$GLOBALS['TL_DCA']['tl_form']['fields']['pdff_multiform'] = array (
    'label'                   => &$GLOBALS['TL_LANG']['tl_form']['pdff_multiform'],
    'exclude'                 => true,
    'inputType'               => 'multiColumnWizard',
    'eval'                    => array
    (
            'tl_class'     => 'clr',
            'columnFields' => array
            (
                    'bedingung' => array
                    (
                            'label'             => &$GLOBALS['TL_LANG']['tl_form']['multiform_bedingung'],
                            'exclude'           => true,
                            'inputType'         => 'select',
                            'eval'              => array('style' => 'width:235px', 'chosen' => true, 'includeBlankOption' => true),
                            'options_callback'  => array('tl_pdff_form', 'getFelder'),
                    ),
                    'seiten' => array
                    (
                            'label'             => &$GLOBALS['TL_LANG']['tl_form']['multiform_seiten'],
                            'default'           => '',
                            'exclude'           => true,
                            'inputType'         => 'text',
                            'eval'              => array('allowHtml' => true, 'style' => 'width:265px'),
                    ),
            )
    ),
    'sql'                     => "mediumtext NULL"
);

$GLOBALS['TL_DCA']['tl_form']['fields']['pdff_font'] = array (
    'label'     => &$GLOBALS['TL_LANG']['tl_form']['pdff_font'],
    'exclude'   => true,
    'inputType' => 'fileTree',
    'eval'      => array('filesOnly'=>true, 'fieldType'=>'radio', 'tl_class'=>'clr w50', 'extensions'=>'ttf,otf'),
    'sql'       => "binary(16) NULL",
);

$GLOBALS['TL_DCA']['tl_form']['fields']['pdff_fontb'] = array (
    'label'     => &$GLOBALS['TL_LANG']['tl_form']['pdff_fontb'],
    'exclude'   => true,
    'inputType' => 'fileTree',
    'eval'      => array('filesOnly'=>true, 'fieldType'=>'radio', 'tl_class'=>'w50', 'extensions'=>'ttf,otf'),
    'sql'       => "binary(16) NULL",
);

$GLOBALS['TL_DCA']['tl_form']['fields']['pdff_fonti'] = array (
    'label'     => &$GLOBALS['TL_LANG']['tl_form']['pdff_fonti'],
    'exclude'   => true,
    'inputType' => 'fileTree',
    'eval'      => array('filesOnly'=>true, 'fieldType'=>'radio', 'tl_class'=>'w50', 'extensions'=>'ttf,otf'),
    'sql'       => "binary(16) NULL",
);

$GLOBALS['TL_DCA']['tl_form']['fields']['pdff_fontbi'] = array (
    'label'     => &$GLOBALS['TL_LANG']['tl_form']['pdff_fontbi'],
    'exclude'   => true,
    'inputType' => 'fileTree',
    'eval'      => array('filesOnly'=>true, 'fieldType'=>'radio', 'tl_class'=>'w50', 'extensions'=>'ttf,otf'),
    'sql'       => "binary(16) NULL",
);




class tl_pdff_form extends \tl_form
{
    /**
     * Get notification choices
     *
     * @return array
     */
    public function getNotificationChoices()
    {
        $arrChoices = array();
        if( class_exists( 'NotificationCenter\tl_form' ) ) {
            $objNotifications = \Contao\Database::getInstance()->execute("SELECT id,title FROM tl_nc_notification WHERE type='pdf_form_transmit' ORDER BY title");
    
            while ($objNotifications->next()) {
                $arrChoices[$objNotifications->id] = $objNotifications->title;
            }
        }
        return $arrChoices;
    }
    
    
    //-----------------------------------------------------------------
    //  Erstellt eine Liste der Formularfelder
    //  $dc->currentRecord   ist die ID des tl_pdff_positions
    //-----------------------------------------------------------------
    public function getFelder( $dc )
    {
        return Softleister\Pdfforms\PdfformsHelper::getFormFields( $dc->currentRecord );
    }
    
}
