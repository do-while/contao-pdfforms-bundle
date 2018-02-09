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
$GLOBALS['TL_LANG']['tl_form']['pdff_on']           = array('Fill PDF form', 'Filling out a PDF template');
$GLOBALS['TL_LANG']['tl_form']['pdff_vorlage']      = array('PDF template file', 'Please select the PDF file as a template. You have the opportunity to make parts of submission dependent.');
$GLOBALS['TL_LANG']['tl_form']['pdff_handler']      = array('Further processing', 'What will happen next with the PDF');
$GLOBALS['TL_LANG']['tl_form']['pdff_savepath']     = array('Directory for storing', 'Please select the directory where the PDF files should be saved. The directory can also be protected.');
$GLOBALS['TL_LANG']['tl_form']['pdff_protect']      = array('Protect PDF', 'The PDF is provided with password protection');
$GLOBALS['TL_LANG']['tl_form']['pdff_openpassword'] = array('PDF password for opening', 'Leave the field blank if open without a password should be possible.');
$GLOBALS['TL_LANG']['tl_form']['pdff_protectflags'] = array('Permissions', 'Select everything that should be possible without a password.');
$GLOBALS['TL_LANG']['tl_form']['pdff_password']     = array('PDF password for permissions', 'If this field is left blank, a random password is generated');
$GLOBALS['TL_LANG']['tl_form']['pdff_allpages']     = array('Take all document pages', 'Applies also template pages without position entries in the PDF.');
$GLOBALS['TL_LANG']['tl_form']['pdff_offset']       = array('Basic offset', 'X and Y displacement in millimeters of all positions on the sides.');
$GLOBALS['TL_LANG']['tl_form']['pdff_textcolor']    = array('text color in PDF', 'Please select the pen color to fill in the entries');
$GLOBALS['TL_LANG']['tl_form']['pdff_author']       = array('Author', 'Stated author in the PDF properties');
$GLOBALS['TL_LANG']['tl_form']['pdff_title']        = array('Title', 'Title of PDF document');
$GLOBALS['TL_LANG']['tl_form']['pdff_fileext']      = array('Expand file name', 'Expand the file name with InsertTags, e.g. {{date::ymd_His}} to make it unique.');

/**
 * References
 */
$GLOBALS['TL_LANG']['tl_form']['pdff_handlers']['save']           = 'Save PDF file';
$GLOBALS['TL_LANG']['tl_form']['pdff_handlers']['email']          = 'Save PDF file and attach it to the email';

$GLOBALS['TL_LANG']['tl_form']['pdff_protectflag']['print']       = 'Print';
$GLOBALS['TL_LANG']['tl_form']['pdff_protectflag']['print-high']  = 'Print in high resolution';
$GLOBALS['TL_LANG']['tl_form']['pdff_protectflag']['modify']      = 'Modify the document';
$GLOBALS['TL_LANG']['tl_form']['pdff_protectflag']['assemble']    = 'Insert pages, rotate, delete, bookmarks';
$GLOBALS['TL_LANG']['tl_form']['pdff_protectflag']['copy']        = 'Copying content';
$GLOBALS['TL_LANG']['tl_form']['pdff_protectflag']['annot-forms'] = 'comment on';
$GLOBALS['TL_LANG']['tl_form']['pdff_protectflag']['extract']     = 'Remove pages';
$GLOBALS['TL_LANG']['tl_form']['pdff_protectflag']['fill-forms']  = 'Fill in form fields';

/**
 * Buttons
 */
$GLOBALS['TL_LANG']['tl_form']['positions']  = array('Positions', 'Definition of text positions within the PDF');
 
/**
 * Legends
 */
$GLOBALS['TL_LANG']['tl_form']['pdff_legend']  = 'Fill in PDF form';
