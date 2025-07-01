<?php

/**
 * Extension for Contao 5
 *
 * @copyright  Softleister 2014-2025
 * @author     Softleister <info@softleister.de>
 * @package    contao-pdfforms-bundle
 * @licence    LGPL
 * @see	       https://github.com/do-while/contao-pdfforms-bundle
 */

/**
 * Fields
 */
$GLOBALS['TL_LANG']['tl_pdff_positions']['tstamp']             = ['Modification date', 'Last modification time'];
$GLOBALS['TL_LANG']['tl_pdff_positions']['type']               = ['Type of position', 'Select the type of position'];
$GLOBALS['TL_LANG']['tl_pdff_positions']['bartype']            = ['Barcode type', 'Select a barcode type'];
$GLOBALS['TL_LANG']['tl_pdff_positions']['textitems']          = ['Inputs and texts', 'Input values and/or text to be inserted her into PDF'];
$GLOBALS['TL_LANG']['tl_pdff_positions']['textitem_feld']      = ['Field name or "text" ', 'Enter the field name, or a text in quotations to be inserted here'];
$GLOBALS['TL_LANG']['tl_pdff_positions']['textitem_bedingung'] = ['Condition ', 'The text is output only when the field is filled, in selections the specified option must be selected'];
$GLOBALS['TL_LANG']['tl_pdff_positions']['textitem_invert']    = [' ', 'Inversion: used = selected/checked; empty = blank or not selected/unchecked'];
$GLOBALS['TL_LANG']['tl_pdff_positions']['notice']             = ['Remarks and notes', 'These notes are not displayed in the frontend'];
$GLOBALS['TL_LANG']['tl_pdff_positions']['page']               = ['Page in PDF', 'Page on which the item is to be inserted'];
$GLOBALS['TL_LANG']['tl_pdff_positions']['posxy']              = ['Position in X and Y', 'Position im mm from the upper left corner. If the value begins with + or -, the output is relative to the previous position.'];
$GLOBALS['TL_LANG']['tl_pdff_positions']['borderright']        = ['Border right', 'Optional margin setting for wordwrap of long texts'];
$GLOBALS['TL_LANG']['tl_pdff_positions']['align']              = ['Orientation', 'Orientation based on the position'];
$GLOBALS['TL_LANG']['tl_pdff_positions']['fontstyle']          = ['Text attributes', 'Attributes bold or italic for the inserted text'];
$GLOBALS['TL_LANG']['tl_pdff_positions']['fontsize']           = ['Text size', 'Font size of text in pt'];
$GLOBALS['TL_LANG']['tl_pdff_positions']['texttransform']      = ['Text transformation', 'Here you can choose a text transformation mode.'];
$GLOBALS['TL_LANG']['tl_pdff_positions']['textcolor']          = ['Overwrite text color', 'Leave the field blank if you do not want to overwrite the default text color for this item.'];
$GLOBALS['TL_LANG']['tl_pdff_positions']['published']          = ['Published', 'The position is inserted in PDF only when it is published'];
$GLOBALS['TL_LANG']['tl_pdff_positions']['picsize']            = ['Dimensions', 'Size of the box width x height in mm. If one value is specified as 0, it will be calculated proportionally.'];
$GLOBALS['TL_LANG']['tl_pdff_positions']['picture']            = ['Picture', 'Select your picture'];
$GLOBALS['TL_LANG']['tl_pdff_positions']['pictype']            = ['Image source', 'Use an image from file or from a data stream.'];
$GLOBALS['TL_LANG']['tl_pdff_positions']['pictag']             = ['Image data', 'Define the form field that contains the image data or a UUID.'];
$GLOBALS['TL_LANG']['tl_pdff_positions']['qrsize']             = ['Size of bar code', 'Select the size.'];
$GLOBALS['TL_LANG']['tl_pdff_positions']['noblanks']           = ['No automatic spaces', 'Suppresses the automatic insertion of spaces between fields.'];
$GLOBALS['TL_LANG']['tl_pdff_positions']['bedingung']          = ['Condition', 'The item is only output if the condition is fulfilled or the condition is empty.'];
$GLOBALS['TL_LANG']['tl_pdff_positions']['invert']             = ['not used', 'not used = unchecked/not selected/empty.'];

/**
 * References
 */
$GLOBALS['TL_LANG']['tl_pdff_positions']['type_']['text']                = 'Text position';
$GLOBALS['TL_LANG']['tl_pdff_positions']['type_']['pic']                 = 'Picture position';
$GLOBALS['TL_LANG']['tl_pdff_positions']['type_']['qrcode']              = 'Bar code';

$GLOBALS['TL_LANG']['tl_pdff_positions']['pdff_handlers']['save']        = 'Save PDF document';
$GLOBALS['TL_LANG']['tl_pdff_positions']['pdff_handlers']['email']       = 'Send PDF document as email attachment';
$GLOBALS['TL_LANG']['tl_pdff_positions']['fontstyle_']['bold']           = 'Bold';
$GLOBALS['TL_LANG']['tl_pdff_positions']['fontstyle_']['italic']         = 'Italic';
$GLOBALS['TL_LANG']['tl_pdff_positions']['textitem_inverts']['used']     = 'used';
$GLOBALS['TL_LANG']['tl_pdff_positions']['textitem_inverts']['empty']    = 'empty';

$GLOBALS['TL_LANG']['tl_pdff_positions']['texttransform_']['uppercase']  = 'uppercase';
$GLOBALS['TL_LANG']['tl_pdff_positions']['texttransform_']['lowercase']  = 'lowercase';
$GLOBALS['TL_LANG']['tl_pdff_positions']['texttransform_']['capitalize'] = 'capitalize';
$GLOBALS['TL_LANG']['tl_pdff_positions']['texttransform_']['none']       = 'none';

$GLOBALS['TL_LANG']['tl_pdff_positions']['pictype_']['file']             = 'File';
$GLOBALS['TL_LANG']['tl_pdff_positions']['pictype_']['upload']           = 'Upload file';
$GLOBALS['TL_LANG']['tl_pdff_positions']['pictype_']['data']             = 'Data stream';
$GLOBALS['TL_LANG']['tl_pdff_positions']['pictype_']['uuid']             = 'UUID of the file';

$GLOBALS['TL_LANG']['tl_pdff_positions']['bartype_']['2d']               = '2D bar codes';
$GLOBALS['TL_LANG']['tl_pdff_positions']['bartype_']['QRCODE,L']         = 'QR-CODE - Low error correction';
$GLOBALS['TL_LANG']['tl_pdff_positions']['bartype_']['QRCODE,M']         = 'QR-CODE - Medium error correction';
$GLOBALS['TL_LANG']['tl_pdff_positions']['bartype_']['QRCODE,Q']         = 'QR-CODE - Better error correction';
$GLOBALS['TL_LANG']['tl_pdff_positions']['bartype_']['QRCODE,H']         = 'QR-CODE - Best error correction';
$GLOBALS['TL_LANG']['tl_pdff_positions']['bartype_']['PDF417']           = 'PDF417 (ISO/IEC 15438:2006)';
$GLOBALS['TL_LANG']['tl_pdff_positions']['bartype_']['DATAMATRIX']       = 'Datamatrix (ISO/IEC 16022:2006)';
$GLOBALS['TL_LANG']['tl_pdff_positions']['bartype_']['1d']               = '1D bar codes';
$GLOBALS['TL_LANG']['tl_pdff_positions']['bartype_']['C39']              = 'Code 39 - ANSI MH10.8M-1983 - USD-3 - 3 of 9';
$GLOBALS['TL_LANG']['tl_pdff_positions']['bartype_']['C39+']             = 'Code 39 + Checksum';
$GLOBALS['TL_LANG']['tl_pdff_positions']['bartype_']['C39E']             = 'Code 39 Extended';
$GLOBALS['TL_LANG']['tl_pdff_positions']['bartype_']['C39E+']            = 'Code 39 Extended + Checksum';
$GLOBALS['TL_LANG']['tl_pdff_positions']['bartype_']['C93']              = 'Code 93 - USS-93';
$GLOBALS['TL_LANG']['tl_pdff_positions']['bartype_']['S25']              = 'Standard 2 of 5';
$GLOBALS['TL_LANG']['tl_pdff_positions']['bartype_']['S25+']             = 'Standard 2 of 5 + Checksum';
$GLOBALS['TL_LANG']['tl_pdff_positions']['bartype_']['I25']              = 'Interleaved 2 of 5';
$GLOBALS['TL_LANG']['tl_pdff_positions']['bartype_']['I25+']             = 'Interleaved 2 of 5 + Checksum';
$GLOBALS['TL_LANG']['tl_pdff_positions']['bartype_']['C128']             = 'Code 128 AUTO';
$GLOBALS['TL_LANG']['tl_pdff_positions']['bartype_']['C128A']            = 'Code 128 A';
$GLOBALS['TL_LANG']['tl_pdff_positions']['bartype_']['C128B']            = 'Code 128 B';
$GLOBALS['TL_LANG']['tl_pdff_positions']['bartype_']['C128C']            = 'Code 128 C';
$GLOBALS['TL_LANG']['tl_pdff_positions']['bartype_']['EAN8']             = 'EAN 8';
$GLOBALS['TL_LANG']['tl_pdff_positions']['bartype_']['EAN13']            = 'EAN 13';
$GLOBALS['TL_LANG']['tl_pdff_positions']['bartype_']['UPCA']             = 'UPC-A';
$GLOBALS['TL_LANG']['tl_pdff_positions']['bartype_']['UPCE']             = 'UPC-E';
$GLOBALS['TL_LANG']['tl_pdff_positions']['bartype_']['EAN5']             = '5-Digits UPC-Based Extension';
$GLOBALS['TL_LANG']['tl_pdff_positions']['bartype_']['EAN2']             = '2-Digits UPC-Based Extension';
$GLOBALS['TL_LANG']['tl_pdff_positions']['bartype_']['MSI']              = 'MSI';
$GLOBALS['TL_LANG']['tl_pdff_positions']['bartype_']['MSI+']             = 'MSI + Checksum (module 11)';
$GLOBALS['TL_LANG']['tl_pdff_positions']['bartype_']['CODABAR']          = 'Codabar';
$GLOBALS['TL_LANG']['tl_pdff_positions']['bartype_']['CODE11']           = 'Code 11';
$GLOBALS['TL_LANG']['tl_pdff_positions']['bartype_']['PHARMA']           = 'Pharmacode';
$GLOBALS['TL_LANG']['tl_pdff_positions']['bartype_']['PHARMA2T']         = 'Pharmacode TWO-TRACKS';
$GLOBALS['TL_LANG']['tl_pdff_positions']['bartype_']['IMB']              = 'IMB - Intelligent Mail Barcode - Onecode - USPS-B-3200';
$GLOBALS['TL_LANG']['tl_pdff_positions']['bartype_']['POSTNET']          = 'Postnet';
$GLOBALS['TL_LANG']['tl_pdff_positions']['bartype_']['PLANET']           = 'Planet';
$GLOBALS['TL_LANG']['tl_pdff_positions']['bartype_']['RMS4CC']           = 'RMS4CC (Royal Mail 4-state Customer Code) - CBC (Customer Bar Code)';
$GLOBALS['TL_LANG']['tl_pdff_positions']['bartype_']['KIX']              = 'KIX (Klant index - Customer index)';

$GLOBALS['TL_LANG']['tl_pdff_positions']['seite']                        = 'Page';

/**
 * Buttons
 */
$GLOBALS['TL_LANG']['tl_pdff_positions']['new']        = ['New position', 'Create new variables position'];
$GLOBALS['TL_LANG']['tl_pdff_positions']['edit']       = ['Edit position', 'Edit position ID %s'];
$GLOBALS['TL_LANG']['tl_pdff_positions']['copy']       = ['Duplicate position', 'Copy position ID %s'];
$GLOBALS['TL_LANG']['tl_pdff_positions']['cut']        = ['Move position', 'Move position ID %s'];
$GLOBALS['TL_LANG']['tl_pdff_positions']['delete']     = ['Delete position', 'Delete position ID %s'];
$GLOBALS['TL_LANG']['tl_pdff_positions']['toggle']     = ['Position publish/unpublish', 'Position ID %s publish/unpublish'];
$GLOBALS['TL_LANG']['tl_pdff_positions']['show']       = ['Position details', 'Details of position ID %s'];
$GLOBALS['TL_LANG']['tl_pdff_positions']['editheader'] = ['Edit position', 'Edit this position'];
$GLOBALS['TL_LANG']['tl_pdff_positions']['pasteafter'] = ['Paste after', 'Paste after position ID %s'];
$GLOBALS['TL_LANG']['tl_pdff_positions']['pastenew']   = ['Create a new position below', 'Create a new position below ID %s'];
$GLOBALS['TL_LANG']['tl_pdff_positions']['testpdf']    = ['Download Test PDF', 'Download of a filled template PDF'];

/**
 * Legends
 */
$GLOBALS['TL_LANG']['tl_pdff_positions']['type_legend']    = 'Type of position';
$GLOBALS['TL_LANG']['tl_pdff_positions']['pdff_legend']    = 'Fill PDF form';
$GLOBALS['TL_LANG']['tl_pdff_positions']['attr_legend']    = 'Positions and attributes';
$GLOBALS['TL_LANG']['tl_pdff_positions']['publish_legend'] = 'Publication';
$GLOBALS['TL_LANG']['tl_pdff_positions']['img_legend']     = 'Image selection';

