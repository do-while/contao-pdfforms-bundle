<?php

/**
 * Extension for Contao 5
 *
 * @copyright  Softleister 2014-2026
 * @author     Softleister <info@softleister.de>
 * @package    contao-pdfforms-bundle
 * @licence    LGPL
 * @see	       https://github.com/do-while/contao-pdfforms-bundle
 */


use Contao\Backend;
use Contao\DC_Table;
use Contao\FilesModel;
use Contao\StringUtil;
use Contao\DataContainer;
use Softleister\PdfformsBundle\PdfformsHelper;
use Doctrine\DBAL\Platforms\AbstractMySQLPlatform;


/**
 * Table tl_pdff_positions
 */
$GLOBALS['TL_DCA']['tl_pdff_positions'] = array
(
    // Config
    'config' => array
    (
        'dataContainer'               => DC_Table::class,
        'enableVersioning'            => true,
        'ptable'                      => 'tl_form',
        'sql' => array
        (
            'keys' => array
            (
                'id'  => 'primary',
                'pid' => 'index'
            )
        )
    ),

    // List
    'list' => array
    (
        'sorting' => array
        (
            'mode'                    => DataContainer::MODE_PARENT,
            'fields'                  => ['sorting'],
            'panelLayout'             => 'filter;sort,search,limit',
            'defaultSearchField'      => 'label',
            'headerFields'            => ['title', 'tstamp', 'storeValues', 'sendViaEmail', 'recipient', 'subject'],
            'child_record_callback'   => ['tl_pdff_positions', 'listPositions']
        ),
        'global_operations' => array
        (
            'testpdf' => array
            (
                'href'                => 'key=testpdf',
                'class'               => 'header_testpdf',
                'attributes'          => 'onclick="Backend.getScrollOffset()" accesskey="t"'
            ),
            'all'
        ),
    ),

    // Palettes
    'palettes' => array
    (
        '__selector__'  => ['type', 'pictype'],
        'default'       => '{type_legend},type;'
                          .'{publish_legend},published',

        'text'          => '{type_legend},type;'
                          .'{pdff_legend},textitems,textcolor,noblanks,notice;'
                          .'{attr_legend},page,posxy,borderright,align,fontsize,fontstyle,texttransform;'
                          .'{publish_legend},published',

        'picfile'       => '{type_legend},type,notice;'
                          .'{attr_legend},page,bedingung,invert,posxy,picsize;'
                          .'{img_legend},pictype,picture,size;'
                          .'{publish_legend},published',

        'picupload'     => '{type_legend},type,notice;'
                          .'{attr_legend},page,bedingung,invert,posxy,picsize;'
                          .'{img_legend},pictype,pictag,size;'
                          .'{publish_legend},published',

        'picdata'       => '{type_legend},type,notice;'
                          .'{attr_legend},page,bedingung,invert,posxy,picsize;'
                          .'{img_legend},pictype,pictag,size;'
                          .'{publish_legend},published',

        'picuuid'       => '{type_legend},type,notice;'
                          .'{attr_legend},page,bedingung,invert,posxy,picsize;'
                          .'{img_legend},pictype,pictag,size;'
                          .'{publish_legend},published',

        'qrcode'        => '{type_legend},type,bartype;'
                          .'{pdff_legend},textitems,textcolor,noblanks,notice;'
                          .'{attr_legend},page,bedingung,invert,posxy,qrsize;'
                          .'{publish_legend},published',
    ),

    // Fields
    'fields' => array
    (
        'id' => array
        (
            'sql'                     => ['type' => 'integer', 'notnull' => false, 'unsigned' => true, 'autoincrement' => true]
        ),
        'pid' => array
        (
            'foreignKey'              => 'tl_form.title',
            'sql'                     => ['type' => 'integer', 'notnull' => false, 'unsigned' => true, 'default' => '0'],
            'relation'                => ['type' => 'belongsTo', 'load' => 'lazy']
        ),
        'sorting' => array
        (
            'sql'                     => ['type' => 'integer', 'notnull' => false, 'unsigned' => true, 'default' => '0']
        ),
        'tstamp' => array
        (
            'sql'                     => ['type' => 'integer', 'notnull' => false, 'unsigned' => true, 'default' => '0']
        ),
//-------
        'type' => array
        (
            'exclude'                 => true,
            'default'                 => 'text',
            'inputType'               => 'select',
            'options'                 => ['text', 'pic', 'qrcode'],
            'reference'               => &$GLOBALS['TL_LANG']['tl_pdff_positions']['type_'],
            'eval'                    => ['tl_class' => 'w50', 'submitOnChange' => true],
            'sql'                     => ['type' => 'string', 'length' => 8, 'default' => 'text']
        ),
        'bartype' => array
        (
            'exclude'                 => true,
            'default'                 => 'QRCODE,Q',
            'filter'                  => true,
            'inputType'               => 'select',
            'options'                 => [ '2d' => ['QRCODE,L', 'QRCODE,M', 'QRCODE,Q', 'QRCODE,H', 'PDF417', 'DATAMATRIX'], 
                                           '1d' => ['C39', 'C39+', 'C39E', 'C39E+', 'C93', 'S25', 'S25+', 'I25', 'I25+', 'C128', 'C128A', 'C128B', 'C128C', 'EAN8', 'EAN13', 'UPCA', 'UPCE', 'EAN5', 'EAN2', 'MSI', 'MSI+', 'CODABAR', 'CODE11', 'PHARMA', 'PHARMA2T', 'IMB', 'POSTNET', 'PLANET', 'RMS4CC', 'KIX']
                                         ],
            'reference'               => &$GLOBALS['TL_LANG']['tl_pdff_positions']['bartype_'],
            'eval'                    => ['tl_class' => 'w50'],
            'sql'                     => ['type' => 'string', 'length' => 12, 'default' => 'QRCODE,Q']
        ),
//-------
        'textitems' => array (
            'inputType'         => 'rowWizard',
            'search'            => true,
            'fields'            => array
                                    (
                                        'feld' => array
                                        (
                                            'label'             => &$GLOBALS['TL_LANG']['tl_pdff_positions']['textitem_feld'],
                                            'default'           => '',
                                            'inputType'         => 'text',
                                            'eval'              => ['allowHtml' => true],
                                        ),
                                        'bedingung' => array
                                        (
                                            'label'             => &$GLOBALS['TL_LANG']['tl_pdff_positions']['textitem_bedingung'],
                                            'inputType'         => 'select',
                                            'eval'              => ['chosen' => true, 'includeBlankOption' => true],
                                            'options_callback'  => ['tl_pdff_positions', 'getFelder'],
                                        ),
                                        'invert' => array
                                        (
                                            'label'             => &$GLOBALS['TL_LANG']['tl_pdff_positions']['textitem_invert'],
                                            'inputType'         => 'select',
                                            'options'           => ['used', 'empty'],
                                            'reference'         => &$GLOBALS['TL_LANG']['tl_pdff_positions']['textitem_inverts'],
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
        ),
        'notice' => array
        (
            'exclude'                 => true,
            'exclude'                 => true,
            'search'                  => true,
            'inputType'               => 'textarea',
            'eval'                    => ['tl_class' => 'clr long'],
            'sql'                     => "text NULL"
        ),
        'noblanks' => array
        (
            'exclude'                 => true,
            'inputType'               => 'checkbox',
            'eval'                    => ['tl_class' => 'm12 w50'],
            'sql'                     => ['type' => 'string', 'length' => 1, 'fixed' => true, 'default' => '']
        ),
//-------
        'page' => array
        (
            'exclude'                 => true,
            'default'                 => '1',
            'filter'                  => true,
            'inputType'               => 'text',
            'eval'                    => ['mandatory' => true, 'rgxp' => 'digit', 'tl_class' => 'w50'],
            'sql'                     => ['type' => 'integer', 'notnull' => false, 'unsigned' => true, 'default' => '1']
        ),
        'posxy' => array
        (
            'exclude'                 => true,
            'inputType'               => 'text',
            'eval'                    => ['mandatory' => true, 'maxlength' => 6, 'multiple' => true, 'size' => 2, 'decodeEntities' => true, 'tl_class' => 'clr w50'],
            'sql'                     => ['type' => 'string', 'length' => 64, 'default' => '']
        ),
        'picsize' => array
        (
            'exclude'                 => true,
            'inputType'               => 'text',
            'eval'                    => ['mandatory' => true, 'maxlength' => 6, 'multiple' => true, 'size' => 2, 'decodeEntities' => true, 'tl_class' => 'w50'],
            'sql'                     => ['type' => 'string', 'length' => 64, 'default' => '']
        ),
//-------
        'borderright' => array
        (
            'exclude'                 => true,
            'inputType'               => 'text',
            'eval'                    => ['rgxp' => 'digit', 'maxlength' => 16, 'tl_class' => 'w50'],
            'sql'                     => ['type' => 'string', 'length' => 16, 'default' => '']
        ),
        'align' => array
        (
            'exclude'                 => true,
            'default'                 => 'left',
            'inputType'               => 'select',
            'options'                 => ['left', 'center', 'right'],
            'reference'               => &$GLOBALS['TL_LANG']['MSC'],
            'eval'                    => ['tl_class' => 'clr w50'],
            'sql'                     => ['type' => 'string', 'length' => 32, 'default' => '']
        ),
        'fontsize' => array
        (
            'exclude'                 => true,
            'default'                 => '11',
            'exclude'                 => true,
            'inputType'               => 'text',
            'eval'                    => ['rgxp' => 'digit', 'maxlength' => 16, 'tl_class' => 'w50'],
            'sql'                     => ['type' => 'string', 'length' => 16, 'default' => '11']
        ),
        'textcolor' => array
        (
            'exclude'                 => true,
            'default'                 => '',
            'inputType'               => 'text',
            'eval'                    => ['maxlength' => 6, 'colorpicker' => true, 'isHexColor' => true, 'decodeEntities' => true, 'tl_class' => 'w50 wizard', 'style' => 'width:138px'],
            'sql'                     => ['type' => 'string', 'length' => 8, 'default' => '']
        ),
        'fontstyle' => array
        (
            'exclude'                 => true,
            'inputType'               => 'checkbox',
            'options'                 => ['bold', 'italic'],
            'reference'               => &$GLOBALS['TL_LANG']['tl_pdff_positions']['fontstyle_'],
            'eval'                    => ['multiple' => true, 'tl_class' => 'clr w50'],
            'sql'                     => ['type' => 'string', 'length' => 255, 'default' => '']
        ),
        'texttransform' => array
        (
            'exclude'                 => true,
            'inputType'               => 'select',
            'options'                 => ['uppercase', 'lowercase', 'capitalize', 'none'],
            'reference'               => &$GLOBALS['TL_LANG']['tl_pdff_positions']['texttransform_'],
            'eval'                    => ['includeBlankOption' => true, 'tl_class' => 'w50'],
            'sql'                     => ['type' => 'string', 'length' => 32, 'default' => '']
        ),
//-------
        'pictype' => array
        (
            'exclude'                 => true,
            'default'                 => 'file',
            'filter'                  => true,
            'inputType'               => 'select',
            'options'                 => ['file', 'upload', 'data', 'uuid'],
            'reference'               => &$GLOBALS['TL_LANG']['tl_pdff_positions']['pictype_'],
            'eval'                    => ['tl_class' => 'w50', 'submitOnChange' => true],
            'sql'                     => ['type' => 'string', 'length' => 8, 'default' => 'file']
        ),
        'picture' => array
        (
            'exclude'                 => true,
            'inputType'               => 'fileTree',
            'eval'                    => ['mandatory' => true, 'filesOnly' => true, 'fieldType' => 'radio', 'tl_class' => 'clr', 'extensions' => '%contao.image.valid_extensions%'],
            'sql'                     => ['type' => 'binary', 'length' => 16, 'fixed' => true, 'notnull' => false],
        ),
        'pictag' => array
        (
            'exclude'                 => true,
            'inputType'               => 'text',
            'eval'                    => ['mandatory' => true, 'maxlength' => 64, 'tl_class' => 'clr w50'],
            'sql'                     => ['type' => 'string', 'length' => 64, 'default' => 'file']
        ),
        'qrsize' => array
        (
            'exclude'                 => true,
            'default'                 => '2',
            'inputType'               => 'select',
            'options'                 => ['1', '2', '3', '4', '5', '6', '7', '8', '9', '10'],
            'eval'                    => ['tl_class' => 'w50'],
            'sql'                     => ['type' => 'string', 'length' => 2, 'default' => '2']
        ),
//-------
        'bedingung' => array
        (
            'exclude'                 => true,
            'inputType'               => 'select',
            'eval'                    => ['chosen' => true, 'includeBlankOption' => true, 'tl_class' => 'w25'],
            'options_callback'        => ['tl_pdff_positions', 'optgetFelder'],
            'sql'                     => ['type' => 'string', 'length' => 80, 'default' => '']
        ),
        'invert' => array
        (
            'exclude'                 => true,
            'inputType'               => 'checkbox',
            'eval'                    => ['tl_class' => 'm12 w25'],
            'sql'                     => ['type' => 'string', 'length' => 1, 'fixed' => true, 'default' => '']
        ),
//-------
        'published' => array
        (
            'exclude'                 => true,
            'filter'                  => true,
            'toggle'                  => true,
            'inputType'               => 'checkbox',
            'eval'                    => ['doNotCopy' => true],
            'sql'                     => ['type' => 'string', 'length' => 1, 'fixed' => true, 'default' => '']
        )
    )
);


/**
 * Class tl_pdff_positions
 */
class tl_pdff_positions extends Backend
{
    //-----------------------------------------------------------------
    //  Callback zum Anzeigen der Positionen im Backend
    //
    //  $arrRow - aktueller Datensatz
    //-----------------------------------------------------------------
    public function listPositions( $arrRow )
    {
        $pub     = $arrRow['published'] ? 'pdfcolor' : 'pdfcolor unpublished';
        $pos     = StringUtil::deserialize( $arrRow['posxy'], true );
        $picsize = StringUtil::deserialize( $arrRow['picsize'], true );
        $items   = StringUtil::deserialize( $arrRow['textitems'], true );

        switch( $arrRow['type'] ) {
            case 'pic':     if( $arrRow['pictype'] === 'file') {
                                $text = FilesModel::findByUuid( $arrRow['picture'] )->path ?? '';
                                $text = '<span title="' . $text . '">' . basename( $text ) . '</span>';
                            }
                            else {
                                $text = $arrRow['pictag'];
                            }
                            break;

            case 'qrcode':
            case 'text':
            default:        $style = StringUtil::deserialize( $arrRow['fontstyle'], true );
                            $text = ( in_array( 'bold', $style ) ? '<strong>' : '' ) . ( in_array( 'italic', $style ) ? '<em>' : '' );
                            foreach( $items as $item ) {
                                $text .= $item['feld'] . '<br>';
                            }
                            $text .= ( in_array( 'italic', $style ) ? '</em>' : '' ) . ( in_array( 'bold', $style ) ? '</strong>' : '' );
                            break;
        }

        $result = '<table class="pdfposition"><tr class="' . $pub . '">'
                 .'<td width="32"><img src="bundles/softleisterpdfforms/pos_' . $arrRow['type'] . '.svg" width="16" height="16" alt=""></td>'
                 .'<td width="240" valign="top">' . $text . '</td>'
                 .'<td width="65" valign="top">' . $GLOBALS['TL_LANG']['tl_pdff_positions']['seite'] . ' ' . ( $arrRow['page'] ?? '' ) . '</td>'
                 .'<td width="65" valign="top">X = ' . ( $pos[0] ?? '' ) . '</td>'
                 .'<td width="65" valign="top">Y = ' . ( $pos[1] ?? '' ) . '</td>';

        if( ($arrRow['type'] === 'pic') && !empty( $arrRow['picsize'] ) ) {
            $result .= '<td width="120" valign="top">(' . $picsize[0] . ' x ' . $picsize[1] . ' mm)</td>';
        }
        else {
            $result .= '<td width="120" valign="top">&nbsp;</td>';
        }

        $result .= '<td valign="top">' . ( $arrRow['notice'] ?? '' ) . '</td>'
                  .'</tr></table>';

        return $result;
    }


    //-----------------------------------------------------------------
    //  Erstellt eine Liste der Formularfelder für Multicolumn-Wizard
    //  $dc->currentRecord   ist die ID des tl_pdff_positions
    //-----------------------------------------------------------------
    public function getFelder( DataContainer $dc )
    {
        $objForm = $this->Database->prepare( "SELECT pid FROM tl_pdff_positions WHERE id=?" )
                                  ->execute( $dc->id );
                                  
        if( $objForm->numRows < 1 ) return [];
        
        return PdfformsHelper::getFormFields( $objForm->pid );
    }


    //-----------------------------------------------------------------
    //  Erstellt eine Liste der Formularfelder für Standardfeld
    //  $dc->currentRecord   ist die ID des tl_pdff_positions
    //-----------------------------------------------------------------
    public function optgetFelder( DataContainer $dc )
    {
        return PdfformsHelper::getFormFields( $dc->activeRecord->pid );
    }


   //-----------------------------------------------------------------
}
