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
 * Fields
 */
$GLOBALS['TL_LANG']['tl_pdff_positions']['tstamp']             = array('Modification date', 'Last modification time');
$GLOBALS['TL_LANG']['tl_pdff_positions']['textitems']          = array('Inputs and texts', 'Input values and/or text to be inserted her into PDF');
$GLOBALS['TL_LANG']['tl_pdff_positions']['textitem_feld']      = array('Field name or "text" ', 'Enter the field name, or a text in quotations to be inserted here');
$GLOBALS['TL_LANG']['tl_pdff_positions']['textitem_bedingung'] = array('Condition ', 'The text is output only when the field is filled, in selections the specified option must be selected');
$GLOBALS['TL_LANG']['tl_pdff_positions']['textitem_invert']    = array(' ', 'Inversion: used = selected/checked; empty = blank or not selected/unchecked');
$GLOBALS['TL_LANG']['tl_pdff_positions']['page']               = array('Page in PDF', 'Page on which the item is to be inserted');
$GLOBALS['TL_LANG']['tl_pdff_positions']['posxy']              = array('Position in X and Y', 'Position im mm from the upper left corner');
$GLOBALS['TL_LANG']['tl_pdff_positions']['borderright']        = array('Border right', 'Optional margin setting for wordwrap of long texts');
$GLOBALS['TL_LANG']['tl_pdff_positions']['align']              = array('Orientation', 'Orientation based on the position');
$GLOBALS['TL_LANG']['tl_pdff_positions']['fontstyle']          = array('Text attributes', 'Attributes bold or italic for the inserted text');
$GLOBALS['TL_LANG']['tl_pdff_positions']['fontsize']           = array('Text size', 'Font size of text in pt');
$GLOBALS['TL_LANG']['tl_pdff_positions']['published']          = array('Published', 'The position is inserted in PDF only when it is published');

/**
 * References
 */
$GLOBALS['TL_LANG']['tl_pdff_positions']['pdff_handlers']['save']     = 'Save PDF document';
$GLOBALS['TL_LANG']['tl_pdff_positions']['pdff_handlers']['email']    = 'Send PDF document as email attachment';
$GLOBALS['TL_LANG']['tl_pdff_positions']['fontstyles']['bold']        = 'Bold';
$GLOBALS['TL_LANG']['tl_pdff_positions']['fontstyles']['italic']      = 'Italic';
$GLOBALS['TL_LANG']['tl_pdff_positions']['textitem_inverts']['used']  = 'used';
$GLOBALS['TL_LANG']['tl_pdff_positions']['textitem_inverts']['empty'] = 'empty';

/**
 * Buttons
 */
$GLOBALS['TL_LANG']['tl_pdff_positions']['new']        = array('New position', 'Create new variables position');
$GLOBALS['TL_LANG']['tl_pdff_positions']['edit']       = array('Edit position', 'Edit position ID %s');
$GLOBALS['TL_LANG']['tl_pdff_positions']['copy']       = array('Duplicate position', 'Copy position ID %s');
$GLOBALS['TL_LANG']['tl_pdff_positions']['cut']        = array('Move position', 'Move position ID %s');
$GLOBALS['TL_LANG']['tl_pdff_positions']['delete']     = array('Delete position', 'Delete position ID %s');
$GLOBALS['TL_LANG']['tl_pdff_positions']['toggle']     = array('Position publish/unpublish', 'Position ID %s publish/unpublish');
$GLOBALS['TL_LANG']['tl_pdff_positions']['show']       = array('Position details', 'Details of position ID %s');
$GLOBALS['TL_LANG']['tl_pdff_positions']['editheader'] = array('Edit position', 'Edit this position');
$GLOBALS['TL_LANG']['tl_pdff_positions']['pasteafter'] = array('Paste after', 'Paste after position ID %s');
$GLOBALS['TL_LANG']['tl_pdff_positions']['pastenew']   = array('Create a new position below', 'Create a new position below ID %s');
$GLOBALS['TL_LANG']['tl_pdff_positions']['testpdf']    = array('Download Test PDF', 'Download of a filled template PDF');

/**
 * Legends
 */
$GLOBALS['TL_LANG']['tl_pdff_positions']['pdff_legend']    = 'Fill PDF form';
$GLOBALS['TL_LANG']['tl_pdff_positions']['attr_legend']    = 'Positions and attributes';
$GLOBALS['TL_LANG']['tl_pdff_positions']['publish_legend'] = 'Publication';

