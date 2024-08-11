<?php

/**
 * Extension for Contao 5
 *
 * @copyright  Softleister 2014-2024
 * @author     Softleister <info@softleister.de>
 * @package    contao-pdfforms-bundle
 * @licence    LGPL
 * @see	       https://github.com/do-while/contao-pdfforms-bundle
 */

/**
 * Fields
 */
$GLOBALS['TL_LANG']['tl_pdff_positions']['tstamp']             = ['Änderungsdatum', 'Zeitpunkt der letzten Änderung'];
$GLOBALS['TL_LANG']['tl_pdff_positions']['type']               = ['Positionstyp', 'Art der Position auswählen'];
$GLOBALS['TL_LANG']['tl_pdff_positions']['bartype']            = ['Barcode-Typ', 'Wählen Sie einen Barcodetyp aus'];
$GLOBALS['TL_LANG']['tl_pdff_positions']['textitems']          = ['Eingaben und Texte', 'Eingaben und/oder Texte, die hier ins PDF eingefügt werden sollen'];
$GLOBALS['TL_LANG']['tl_pdff_positions']['textitem_feld']      = ['Feldname oder "Text" ', 'Geben Sie den Feldnamen an, oder in Gänsefüssen einen Text, der eingetragen werden soll.'];
$GLOBALS['TL_LANG']['tl_pdff_positions']['textitem_bedingung'] = ['Bedingung ', 'Der Text wird nur ausgegeben, wenn das Feld ausgefüllt ist, bei Auswahlen muss die angegebene Option ausgewählt sein.'];
$GLOBALS['TL_LANG']['tl_pdff_positions']['textitem_invert']    = [' ', 'Invertierung: verwendet = ausgefüllt/ausgewählt; leer = unausgefüllt bzw. nicht ausgewählt'];
$GLOBALS['TL_LANG']['tl_pdff_positions']['notice']             = ['Bemerkungen und Notizen', 'Diese Hinweise werden nicht öffentlich angezeigt'];
$GLOBALS['TL_LANG']['tl_pdff_positions']['page']               = ['Seite im PDF', 'Seite, auf der die Position eingefügt werden soll'];
$GLOBALS['TL_LANG']['tl_pdff_positions']['posxy']              = ['Position in X und Y', 'Position im mm von der oberen, linken Ecke. Beginnt die Angabe mit + oder -, dann wird die Ausgabe relativ zur vorigen Position ausgegeben.'];
$GLOBALS['TL_LANG']['tl_pdff_positions']['borderright']        = ['Rechter Rand', 'Optionelle Randeinstellung, als Umbruchgrenze bei langen Texten'];
$GLOBALS['TL_LANG']['tl_pdff_positions']['align']              = ['Ausrichtung', 'Ausrichtung bezogen auf die Position.'];
$GLOBALS['TL_LANG']['tl_pdff_positions']['fontstyle']          = ['Textattribute', 'Attribute Fett oder Kursiv für die eingefügten Texte'];
$GLOBALS['TL_LANG']['tl_pdff_positions']['fontsize']           = ['Textgröße', 'Font Textgröße in pt'];
$GLOBALS['TL_LANG']['tl_pdff_positions']['texttransform']      = ['Text-Transformation', 'Hier können Sie einen Text-Transformationsmodus auswählen.'];
$GLOBALS['TL_LANG']['tl_pdff_positions']['textcolor']          = ['Textfarbe überschreiben', 'Lassen Sie das Feld leer, wenn Sie die Standard-Textfarbe für diese Position nicht überschreiben möchten.'];
$GLOBALS['TL_LANG']['tl_pdff_positions']['published']          = ['Veröffentlicht', 'Die Position wird nur im PDF eingetragen, wenn sie veröffentlicht ist.'];
$GLOBALS['TL_LANG']['tl_pdff_positions']['picsize']            = ['Abmessungen', 'Größe des Rahmens Breite x Höhe in mm. Wird ein Wert mit 0 angegeben, wird er proportional errechnet.'];
$GLOBALS['TL_LANG']['tl_pdff_positions']['picture']            = ['Bild', 'Wählen Sie das Bild aus'];
$GLOBALS['TL_LANG']['tl_pdff_positions']['pictype']            = ['Bildquelle', 'Bild aus Datei oder aus einem Data-Stream verwenden.'];
$GLOBALS['TL_LANG']['tl_pdff_positions']['pictag']             = ['Bilddaten', 'Definieren Sie den SimpleToken, der die Bilddaten enthält oder eine UUID.'];
$GLOBALS['TL_LANG']['tl_pdff_positions']['qrsize']             = ['Größe des Barcodes', 'Wählen Sie die Größe aus.'];
$GLOBALS['TL_LANG']['tl_pdff_positions']['noblanks']           = ['Keine automatischen Leerzeichen', 'Unterdrückt das automatische Einfügen von Leerzeichen zwischen den Feldern.'];
$GLOBALS['TL_LANG']['tl_pdff_positions']['bedingung']          = ['Bedingung', 'Die Position wird nur ausgegeben, wenn die Bedingung erfüllt ist oder die Bedingung leer ist.'];
$GLOBALS['TL_LANG']['tl_pdff_positions']['invert']             = ['nicht vorhanden', 'nicht vorhanden = nicht ausgewählt/nicht ausgefüllt.'];

/**
 * References
 */
$GLOBALS['TL_LANG']['tl_pdff_positions']['type_']['text']                = 'Textposition';
$GLOBALS['TL_LANG']['tl_pdff_positions']['type_']['pic']                 = 'Bildposition';
$GLOBALS['TL_LANG']['tl_pdff_positions']['type_']['qrcode']              = 'Barcode';

$GLOBALS['TL_LANG']['tl_pdff_positions']['pdff_handlers']['save']        = 'PDF-Datei speichern';
$GLOBALS['TL_LANG']['tl_pdff_positions']['pdff_handlers']['email']       = 'PDF-Datei in der E-Mail versenden';
$GLOBALS['TL_LANG']['tl_pdff_positions']['fontstyle_']['bold']           = 'Fett';
$GLOBALS['TL_LANG']['tl_pdff_positions']['fontstyle_']['italic']         = 'Kursiv';
$GLOBALS['TL_LANG']['tl_pdff_positions']['textitem_inverts']['used']     = 'verwendet';
$GLOBALS['TL_LANG']['tl_pdff_positions']['textitem_inverts']['empty']    = 'leer';

$GLOBALS['TL_LANG']['tl_pdff_positions']['texttransform_']['uppercase']  = 'Großbuchstaben';
$GLOBALS['TL_LANG']['tl_pdff_positions']['texttransform_']['lowercase']  = 'Kleinbuchstaben';
$GLOBALS['TL_LANG']['tl_pdff_positions']['texttransform_']['capitalize'] = 'Anfangsbuchstaben groß';
$GLOBALS['TL_LANG']['tl_pdff_positions']['texttransform_']['none']       = 'deaktivieren';

$GLOBALS['TL_LANG']['tl_pdff_positions']['pictype_']['file']             = 'Datei';
$GLOBALS['TL_LANG']['tl_pdff_positions']['pictype_']['upload']           = 'Upload-Datei';
$GLOBALS['TL_LANG']['tl_pdff_positions']['pictype_']['data']             = 'Data-Stream';
$GLOBALS['TL_LANG']['tl_pdff_positions']['pictype_']['uuid']             = 'UUID der Datei';

$GLOBALS['TL_LANG']['tl_pdff_positions']['bartype_']['2d']               = '2D-Barcodes';
$GLOBALS['TL_LANG']['tl_pdff_positions']['bartype_']['QRCODE,L']         = 'QR-Code - einfache Fehlerkorrektur';
$GLOBALS['TL_LANG']['tl_pdff_positions']['bartype_']['QRCODE,M']         = 'QR-Code - mittlere Fehlerkorrektur';
$GLOBALS['TL_LANG']['tl_pdff_positions']['bartype_']['QRCODE,Q']         = 'QR-Code - bessere Fehlerkorrektur';
$GLOBALS['TL_LANG']['tl_pdff_positions']['bartype_']['QRCODE,H']         = 'QR-Code - beste Fehlerkorrektur';
$GLOBALS['TL_LANG']['tl_pdff_positions']['bartype_']['PDF417']           = 'PDF417 (ISO/IEC 15438:2006)';
$GLOBALS['TL_LANG']['tl_pdff_positions']['bartype_']['DATAMATRIX']       = 'Datamatrix (ISO/IEC 16022:2006)';
$GLOBALS['TL_LANG']['tl_pdff_positions']['bartype_']['1d']               = '1D-Barcodes';
$GLOBALS['TL_LANG']['tl_pdff_positions']['bartype_']['C39']              = 'Code 39 - ANSI MH10.8M-1983 - USD-3 - 3 of 9';
$GLOBALS['TL_LANG']['tl_pdff_positions']['bartype_']['C39+']             = 'Code 39 + Checksumme';
$GLOBALS['TL_LANG']['tl_pdff_positions']['bartype_']['C39E']             = 'Code 39 Extended';
$GLOBALS['TL_LANG']['tl_pdff_positions']['bartype_']['C39E+']            = 'Code 39 Extended + Checksumme';
$GLOBALS['TL_LANG']['tl_pdff_positions']['bartype_']['C93']              = 'Code 93 - USS-93';
$GLOBALS['TL_LANG']['tl_pdff_positions']['bartype_']['S25']              = 'Standard 2 of 5';
$GLOBALS['TL_LANG']['tl_pdff_positions']['bartype_']['S25+']             = 'Standard 2 of 5 + Checksumme';
$GLOBALS['TL_LANG']['tl_pdff_positions']['bartype_']['I25']              = 'Interleaved 2 of 5';
$GLOBALS['TL_LANG']['tl_pdff_positions']['bartype_']['I25+']             = 'Interleaved 2 of 5 + Checksumme';
$GLOBALS['TL_LANG']['tl_pdff_positions']['bartype_']['C128']             = 'Code 128 AUTO';
$GLOBALS['TL_LANG']['tl_pdff_positions']['bartype_']['C128A']            = 'Code 128 A';
$GLOBALS['TL_LANG']['tl_pdff_positions']['bartype_']['C128B']            = 'Code 128 B';
$GLOBALS['TL_LANG']['tl_pdff_positions']['bartype_']['C128C']            = 'Code 128 C';
$GLOBALS['TL_LANG']['tl_pdff_positions']['bartype_']['EAN8']             = 'EAN 8';
$GLOBALS['TL_LANG']['tl_pdff_positions']['bartype_']['EAN13']            = 'EAN 13';
$GLOBALS['TL_LANG']['tl_pdff_positions']['bartype_']['UPCA']             = 'UPC-A';
$GLOBALS['TL_LANG']['tl_pdff_positions']['bartype_']['UPCE']             = 'UPC-E';
$GLOBALS['TL_LANG']['tl_pdff_positions']['bartype_']['EAN5']             = '5-Ziffern UPC-Based Extension';
$GLOBALS['TL_LANG']['tl_pdff_positions']['bartype_']['EAN2']             = '2-Ziffern UPC-Based Extension';
$GLOBALS['TL_LANG']['tl_pdff_positions']['bartype_']['MSI']              = 'MSI';
$GLOBALS['TL_LANG']['tl_pdff_positions']['bartype_']['MSI+']             = 'MSI + Checksumme (module 11)';
$GLOBALS['TL_LANG']['tl_pdff_positions']['bartype_']['CODABAR']          = 'Codabar';
$GLOBALS['TL_LANG']['tl_pdff_positions']['bartype_']['CODE11']           = 'Code 11';
$GLOBALS['TL_LANG']['tl_pdff_positions']['bartype_']['PHARMA']           = 'Pharmacode';
$GLOBALS['TL_LANG']['tl_pdff_positions']['bartype_']['PHARMA2T']         = 'Pharmacode TWO-TRACKS';
$GLOBALS['TL_LANG']['tl_pdff_positions']['bartype_']['IMB']              = 'IMB - Intelligent Mail Barcode - Onecode - USPS-B-3200';
$GLOBALS['TL_LANG']['tl_pdff_positions']['bartype_']['POSTNET']          = 'Postnet';
$GLOBALS['TL_LANG']['tl_pdff_positions']['bartype_']['PLANET']           = 'Planet';
$GLOBALS['TL_LANG']['tl_pdff_positions']['bartype_']['RMS4CC']           = 'RMS4CC (Royal Mail 4-state Customer Code) - CBC (Customer Bar Code)';
$GLOBALS['TL_LANG']['tl_pdff_positions']['bartype_']['KIX']              = 'KIX (Klant index - Customer index)';

$GLOBALS['TL_LANG']['tl_pdff_positions']['seite']                        = 'Seite';

/**
 * Buttons
 */
$GLOBALS['TL_LANG']['tl_pdff_positions']['new']        = ['Neue Position', 'Neue Variablenposition erstellen'];
$GLOBALS['TL_LANG']['tl_pdff_positions']['edit']       = ['Position bearbeiten', 'Position ID %s bearbeiten'];
$GLOBALS['TL_LANG']['tl_pdff_positions']['copy']       = ['Position duplizieren', 'Position ID %s kopieren'];
$GLOBALS['TL_LANG']['tl_pdff_positions']['cut']        = ['Position verschieben', 'Position ID %s verschieben'];
$GLOBALS['TL_LANG']['tl_pdff_positions']['delete']     = ['Position löschen', 'Position ID %s löschen'];
$GLOBALS['TL_LANG']['tl_pdff_positions']['toggle']     = ['Position veröffentlichen/unveröffentlichen', 'Position ID %s veröffentlichen/unveröffentlichen'];
$GLOBALS['TL_LANG']['tl_pdff_positions']['show']       = ['Positions-Details', 'Details zu Position ID %s'];
$GLOBALS['TL_LANG']['tl_pdff_positions']['editheader'] = ['Position bearbeiten', 'Diese Position bearbeiten'];
$GLOBALS['TL_LANG']['tl_pdff_positions']['pasteafter'] = ['Am Anfang einfügen', 'Nach Position ID %s einfügen'];
$GLOBALS['TL_LANG']['tl_pdff_positions']['pastenew']   = ['Neue Position unterhalb erstellen', 'Neue Position hinter ID %s erstellen'];
$GLOBALS['TL_LANG']['tl_pdff_positions']['testpdf']    = ['Download Test-PDF', 'Testweise Ausgabe der ausgefüllten Vorlage als Download'];

/**
 * Legends
 */
$GLOBALS['TL_LANG']['tl_pdff_positions']['type_legend']    = 'Positionstyp';
$GLOBALS['TL_LANG']['tl_pdff_positions']['pdff_legend']    = 'PDF-Formular ausfüllen';
$GLOBALS['TL_LANG']['tl_pdff_positions']['attr_legend']    = 'Position und Attribute';
$GLOBALS['TL_LANG']['tl_pdff_positions']['publish_legend'] = 'Veröffentlichung';
$GLOBALS['TL_LANG']['tl_pdff_positions']['img_legend']     = 'Bildauswahl';

