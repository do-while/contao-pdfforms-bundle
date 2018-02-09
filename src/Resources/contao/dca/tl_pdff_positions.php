<?php

/**
 * Extension for Contao 4
 *
 * @copyright  Softleister 2014-2018
 * @author     Softleister <info@softleister.de>
 * @package    contao-pdfforms-bundle
 * @licence    LGPL
 * @see	       https://github.com/do-while/contao-pdfforms-bundle
 */


/**
 * Table tl_pdff_positions
 */
$GLOBALS['TL_DCA']['tl_pdff_positions'] = array
(
    // Config
    'config' => array
    (
        'dataContainer'               => 'Table',
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
            'mode'                    => 4,
            'fields'                  => array('sorting'),
            'panelLayout'             => 'filter,search,limit',
            'headerFields'            => array('title', 'tstamp', 'formID', 'storeValues', 'sendViaEmail', 'recipient', 'subject', 'tableless'),
            'child_record_callback'   => array('tl_pdff_positions', 'listPositions')
        ),
        'global_operations' => array
        (
            'testpdf' => array
            (
                'label'               => &$GLOBALS['TL_LANG']['tl_pdff_positions']['testpdf'],
                'href'                => 'key=testpdf',
                'class'               => 'header_testpdf',
                'attributes'          => 'onclick="Backend.getScrollOffset()" accesskey="t"'
            ),
            'all' => array
            (
                'label'               => &$GLOBALS['TL_LANG']['MSC']['all'],
                'href'                => 'act=select',
                'class'               => 'header_edit_all',
                'attributes'          => 'onclick="Backend.getScrollOffset()" accesskey="e"'
            )
        ),
        'operations' => array
        (
            'edit' => array
            (
                'label'               => &$GLOBALS['TL_LANG']['tl_pdff_positions']['edit'],
                'href'                => 'act=edit',
                'icon'                => 'edit.gif'
            ),
            'copy' => array
            (
                'label'               => &$GLOBALS['TL_LANG']['tl_pdff_positions']['copy'],
                'href'                => 'act=paste&amp;mode=copy',
                'icon'                => 'copy.gif',
                'attributes'          => 'onclick="Backend.getScrollOffset()"'
            ),
            'cut' => array
            (
                'label'               => &$GLOBALS['TL_LANG']['tl_pdff_positions']['cut'],
                'href'                => 'act=paste&amp;mode=cut',
                'icon'                => 'cut.gif',
                'attributes'          => 'onclick="Backend.getScrollOffset()"'
            ),
            'delete' => array
            (
                'label'               => &$GLOBALS['TL_LANG']['tl_pdff_positions']['delete'],
                'href'                => 'act=delete',
                'icon'                => 'delete.gif',
                'attributes'          => 'onclick="if(!confirm(\'' . $GLOBALS['TL_LANG']['MSC']['deleteConfirm'] . '\'))return false;Backend.getScrollOffset()"'
            ),
            'toggle' => array
            (
                'label'               => &$GLOBALS['TL_LANG']['tl_pdff_positions']['toggle'],
                'icon'                => 'visible.gif',
                'attributes'          => 'onclick="Backend.getScrollOffset();return AjaxRequest.toggleVisibility(this,%s)"',
                'button_callback'     => array('tl_pdff_positions', 'toggleIcon')
            ),
            'show' => array
            (
                'label'               => &$GLOBALS['TL_LANG']['tl_pdff_positions']['show'],
                'href'                => 'act=show',
                'icon'                => 'show.gif'
            )
        )
    ),

    // Palettes
    'palettes' => array
    (
        'default'                     => '{pdff_legend},textitems;'
                                        .'{attr_legend},page,posxy,borderright,align,fontsize,fontstyle;'
                                        .'{publish_legend},published',
    ),

    // Fields
    'fields' => array
    (
        'id' => array
        (
            'sql'                     => "int(10) unsigned NOT NULL auto_increment"
        ),
        'pid' => array
        (
            'foreignKey'              => 'tl_form.title',
            'sql'                     => "int(10) unsigned NOT NULL default '0'",
            'relation'                => array('type'=>'belongsTo', 'load'=>'lazy')
        ),
        'sorting' => array
        (
            'sql'                     => "int(10) unsigned NOT NULL default '0'"
        ),
        'tstamp' => array
        (
            'label'                   => &$GLOBALS['TL_LANG']['tl_pdff_positions']['tstamp'],
            'sql'                     => "int(10) unsigned NOT NULL default '0'"
        ),
        'textitems' => array
        (
            'label'                   => &$GLOBALS['TL_LANG']['tl_pdff_positions']['textitems'],
            'exclude'                 => true,
            'inputType'               => 'multiColumnWizard',
            'eval'                    => array
            (
                    'columnFields' => array
                    (
                            'feld' => array
                            (
                                    'label'             => &$GLOBALS['TL_LANG']['tl_pdff_positions']['textitem_feld'],
                                    'default'           => '',
                                    'exclude'           => true,
                                    'inputType'         => 'text',
                                    'eval'              => array('allowHtml' => true, 'style' => 'width:265px'),
                            ),
                            'bedingung' => array
                            (
                                    'label'             => &$GLOBALS['TL_LANG']['tl_pdff_positions']['textitem_bedingung'],
                                    'exclude'           => true,
                                    'inputType'         => 'select',
                                    'eval'              => array('style' => 'width:235px', 'chosen' => true, 'includeBlankOption' => true),
                                    'options_callback'  => array('tl_pdff_positions', 'getFelder'),
                            ),
                            'invert' => array
                            (
                                    'label'             => &$GLOBALS['TL_LANG']['tl_pdff_positions']['textitem_invert'],
                                    'exclude'           => true,
                                    'inputType'         => 'select',
                                    'options'           => array('used', 'empty'),
                                    'reference'         => &$GLOBALS['TL_LANG']['tl_pdff_positions']['textitem_inverts'],
                                    'eval'              => array('style' => 'width:85px'),
                            ),
                    )
            ),
            'sql'                     => "mediumtext NULL"
        ),
        'page' => array
        (
            'label'                   => &$GLOBALS['TL_LANG']['tl_pdff_positions']['page'],
            'default'                 => '1',
            'exclude'                 => true,
            'filter'                  => true,
            'inputType'               => 'text',
            'eval'                    => array('mandatory'=>true, 'rgxp'=>'digit', 'tl_class'=>'w50'),
            'sql'                     => "int(10) unsigned NOT NULL default '1'"
        ),
        'posxy' => array
        (
            'label'                   => &$GLOBALS['TL_LANG']['tl_pdff_positions']['posxy'],
            'inputType'               => 'text',
            'eval'                    => array('mandatory'=>true, 'maxlength'=>6, 'multiple'=>true, 'size'=>2, 'decodeEntities'=>true, 'tl_class'=>'clr w50'),
            'sql'                     => "varchar(64) NOT NULL default ''"
        ),
        'borderright' => array
        (
            'label'                   => &$GLOBALS['TL_LANG']['tl_pdff_positions']['borderright'],
            'exclude'                 => true,
            'inputType'               => 'text',
            'eval'                    => array('rgxp'=>'digit', 'maxlength'=>16, 'tl_class'=>'w50'),
            'sql'                     => "varchar(16) NOT NULL default ''"
        ),
        'align' => array
        (
            'label'                   => &$GLOBALS['TL_LANG']['tl_pdff_positions']['align'],
            'default'                 => 'left',
            'inputType'               => 'select',
            'options'                 => array('left', 'center', 'right'),
            'reference'               => &$GLOBALS['TL_LANG']['MSC'],
            'eval'                    => array('tl_class'=>'clr w50'),
            'sql'                     => "varchar(32) NOT NULL default ''"
        ),
        'fontsize' => array
        (
            'label'                   => &$GLOBALS['TL_LANG']['tl_pdff_positions']['fontsize'],
            'default'                 => '11',
            'exclude'                 => true,
            'inputType'               => 'text',
            'eval'                    => array('rgxp'=>'digit', 'maxlength'=>16, 'tl_class'=>'w50'),
            'sql'                     => "varchar(16) NOT NULL default '11'"
        ),
        'fontstyle' => array
        (
            'label'                   => &$GLOBALS['TL_LANG']['tl_pdff_positions']['fontstyle'],
            'inputType'               => 'checkbox',
            'options'                 => array('bold', 'italic'),
            'reference'               => &$GLOBALS['TL_LANG']['tl_pdff_positions']['fontstyles'],
            'eval'                    => array('multiple'=>true, 'tl_class'=>'clr w50'),
            'sql'                     => "varchar(255) NOT NULL default ''"
        ),
        'published' => array
        (
            'label'                   => &$GLOBALS['TL_LANG']['tl_pdff_positions']['published'],
            'exclude'                 => true,
            'filter'                  => true,
            'inputType'               => 'checkbox',
            'eval'                    => array('doNotCopy'=>true),
            'sql'                     => "char(1) NOT NULL default ''"
        )
    )
);


/**
 * Class tl_pdff_positions
 */
class tl_pdff_positions extends Backend
{
    /**
     * Import the back end user object
     */
    public function __construct()
    {
        parent::__construct();
        $this->import('BackendUser', 'User');
    }

    //-----------------------------------------------------------------
    //  Callback zum Anzeigen der Positionen im Backend
    //
    //  $arrRow - aktueller Datensatz
    //-----------------------------------------------------------------
    public function listPositions($arrRow)
    {
        $pub = $arrRow['published'] ? 'color:#555' : 'color:#bbb';
        $pos = deserialize($arrRow['posxy']);
        $items = deserialize($arrRow['textitems']);

        $style = deserialize($arrRow['fontstyle']);
        $text = (is_array($style) && in_array('bold', $style) ? '<strong>' : '') . (is_array($style) && in_array('italic', $style) ? '<em>' : '');
        foreach($items as $item) $text .= $item['feld'] . '<br>';
        $text .= (is_array($style) && in_array('italic', $style) ? '</em>' : '') . (is_array($style) && in_array('bold', $style) ? '</strong>' : '');

        $result = '<table><tr>'
                 .'<td style="'.$pub.'" width="240" valign="top">' . $text . '</td>'
                 .'<td style="'.$pub.'" width="80" valign="top">Seite ' . $arrRow['page'] . '</td>'
                 .'<td style="'.$pub.'" width="80" valign="top">X = ' . $pos[0] . '</td>'
                 .'<td style="'.$pub.'" width="80" valign="top">Y = ' . $pos[1] . '</td>'
                 .'</tr></table>';
        return $result;
    }

    //-----------------------------------------------------------------
    //    Veröffentlichung umschalten
    //-----------------------------------------------------------------
    public function toggleIcon( $row, $href, $label, $title, $icon, $attributes )
    {
        if( strlen(Input::get('tid')) ) {
            $this->toggleVisibility( Input::get('tid'), (Input::get('state') == 1) );
            $this->redirect( $this->getReferer() );
        }

        $href .= '&amp;tid='.$row['id'].'&amp;state='.($row['published'] ? '' : 1);

        if( !$row['published'] ) {
            $icon = 'invisible.gif';
        }

        return '<a href="'.$this->addToUrl($href).'" title="'.specialchars($title).'"'.$attributes.'>'.Image::getHtml($icon, $label).'</a> ';
    }


    //-----------------------------------------------------------------
    //    Veröffentlichung umschalten
    //-----------------------------------------------------------------
    public function toggleVisibility( $intId, $blnVisible )
    {
        $objVersions = new Versions( 'tl_pdff_positions', $intId );
        $objVersions->initialize( );

        // Trigger the save_callback
        if( is_array($GLOBALS['TL_DCA']['tl_pdff_positions']['fields']['published']['save_callback']) ) {
            foreach( $GLOBALS['TL_DCA']['tl_pdff_positions']['fields']['published']['save_callback'] as $callback ) {
                if( is_array( $callback ) ) {
                    $this->import( $callback[0] );
                    $blnVisible = $this->$callback[0]->$callback[1]( $blnVisible, $this );
                }
                else if( is_callable( $callback ) ) {
                    $blnVisible = $callback( $blnVisible, $this );
                }
            }
        }

        // Update the database
        $this->Database->prepare("UPDATE tl_pdff_positions SET tstamp=". time() .", published='" . $blnVisible . "' WHERE id=?")->execute( $intId );

        $objVersions->create();
        $this->log( 'A new version of record "tl_pdff_positions.id='.$intId.'" has been created'.$this->getParentEntries('tl_pdff_positions', $intId ), __METHOD__, TL_GENERAL);
    }


    //-----------------------------------------------------------------
    //  Erstellt eine Liste der Formularfelder
    //  $dc->currentRecord   ist die ID des tl_pdff_positions
    //-----------------------------------------------------------------
    public function getFelder( $dc )
    {
        $arrFields = array();                       //=== Aufbau eines Feldes mit Vergleichswerten ===
        $cm_text = '';
        $cm_nr = 0;

        // Formular ermitteln
        $objFormField = $this->Database->prepare("SELECT * FROM tl_form_field WHERE invisible<>1 AND pid=(SELECT pid FROM tl_pdff_positions WHERE id=?) ORDER BY sorting")
                                       ->execute($dc->currentRecord);

        if( $objFormField->numRows < 1 ) return $arrFields;                         // keine Felder nicht gefunden: leeres Array zurück

        while( $objFormField->next() ) {
            $options = deserialize($objFormField->options);                         // Options auflösen

            switch( $objFormField->type ) {
                case 'submit':              continue;                               // Kommt nicht in die Liste

                case 'efgLookupRadio':
                case 'efgLookupCheckbox':
                case 'efgLookupSelect':
                                            $efgOpt = deserialize($objFormField->efgLookupOptions);
                                            $dot = strpos( $efgOpt['lookup_val_field'], '.' ) + 1;
                                            $val_field = substr($efgOpt['lookup_val_field'], $dot);
                                            $name_field = substr($efgOpt['lookup_field'], $dot);

                                            $sql = 'SELECT ' . $val_field . ', ' . $name_field
                                                 . ' FROM ' . substr($efgOpt['lookup_field'], 0, strpos($efgOpt['lookup_field'], '.'));
                                            if( !empty($efgOpt['lookup_where']) ) $sql .= ' WHERE ' . html_entity_decode($efgOpt['lookup_where']);
                                            if( !empty($efgOpt['lookup_sort']) )  $sql .= ' ORDER BY ' . html_entity_decode($efgOpt['lookup_sort']);
                                            $objOpts = $this->Database->execute($sql);

                                            while( $objOpts->next() ) {
                                                $options[] = array('value'=>$objOpts->$val_field, 'label'=>$objOpts->$name_field);
                                            }
                                            // v v v   weiter, wie select, radio, checkbox   v v v
                case 'select':
                case 'radio':
                case 'checkbox':
                                            if( empty($options) ) continue;
                                            foreach($options as $opt) {                             // Die Optionen einzeln
                                                $arrFields[$objFormField->name . '~'. $opt['value']] = $objFormField->name . '~'. $opt['value'];
                                            }
                                            break;

                case 'condition':
                case 'text':
                case 'textarea':
                case 'hidden':              $arrFields[$objFormField->name] = $objFormField->name;  // Feldname direkt
                                            break;

                case 'cm_alternative':      if( $objFormField->cm_alternativeType === 'cm_stop' ) break;
                                            if( $objFormField->cm_alternativeType === 'cm_start' ) {
                                                $cm_text = $objFormField->name;
                                                $cm_nr = 0;
                                            }
                                            else {
                                                $cm_nr++;
                                            }
                                            $arrFields[$cm_text . '~'. $cm_nr] = $cm_text . '~'. $cm_nr;          // Feldname mit Option
                                            break;
            }
        }

        if( version_compare(PHP_VERSION, '5.4.0') >= 0 ) {
            asort( $arrFields, SORT_FLAG_CASE );    // Alphabetisch sortieren
        }
        else {
            asort( $arrFields );                    // Alphabetisch sortieren, Groß/Kleinschreibung erst ab PHP 5.4
        }

        return $arrFields;
    }


    //-----------------------------------------------------------------
}
