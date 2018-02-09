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
$GLOBALS['TL_LANG']['tl_pdff_positions']['tstamp']             = array('Änderungsdatum', 'Zeitpunkt der letzten Änderung');
$GLOBALS['TL_LANG']['tl_pdff_positions']['textitems']          = array('Eingaben und Texte', 'Eingaben und/oder Texte, die hier ins PDF eingefügt werden sollen');
$GLOBALS['TL_LANG']['tl_pdff_positions']['textitem_feld']      = array('Feldname oder "Text" ', 'Geben Sie den Feldnamen an, oder in Gänsefüssen einen Text, der eingetragen werden soll.');
$GLOBALS['TL_LANG']['tl_pdff_positions']['textitem_bedingung'] = array('Bedingung ', 'Der Text wird nur ausgegeben, wenn das Feld ausgefüllt ist, bei Auswahlen muss die angegebene Option ausgewählt sein.');
$GLOBALS['TL_LANG']['tl_pdff_positions']['textitem_invert']    = array(' ', 'Invertierung: verwendet = ausgefüllt/ausgewählt; leer = unausgefüllt bzw. nicht ausgewählt');
$GLOBALS['TL_LANG']['tl_pdff_positions']['page']               = array('Seite im PDF', 'Seite, auf der die Position eingefügt werden soll');
$GLOBALS['TL_LANG']['tl_pdff_positions']['posxy']              = array('Position in X und Y', 'Position im mm von der oberen, linken Ecke');
$GLOBALS['TL_LANG']['tl_pdff_positions']['borderright']        = array('Rechter Rand', 'Optionelle Randeinstellung, als Umbruchgrenze bei langen Texten');
$GLOBALS['TL_LANG']['tl_pdff_positions']['align']              = array('Ausrichtung', 'Ausrichtung bezogen auf die Position.');
$GLOBALS['TL_LANG']['tl_pdff_positions']['fontstyle']          = array('Textattribute', 'Attribute Fett oder Kursiv für die eingefügten Texte');
$GLOBALS['TL_LANG']['tl_pdff_positions']['fontsize']           = array('Textgröße', 'Font Textgröße in pt');
$GLOBALS['TL_LANG']['tl_pdff_positions']['published']          = array('Veröffentlicht', 'Die Position wird nur im PDF eingetragen, wenn sie veröffentlicht ist.');

/**
 * References
 */
$GLOBALS['TL_LANG']['tl_pdff_positions']['pdff_handlers']['save']     = 'PDF-Datei speichern';
$GLOBALS['TL_LANG']['tl_pdff_positions']['pdff_handlers']['email']    = 'PDF-Datei in der E-Mail versenden';
$GLOBALS['TL_LANG']['tl_pdff_positions']['fontstyles']['bold']        = 'Fett';
$GLOBALS['TL_LANG']['tl_pdff_positions']['fontstyles']['italic']      = 'Kursiv';
$GLOBALS['TL_LANG']['tl_pdff_positions']['textitem_inverts']['used']  = 'verwendet';
$GLOBALS['TL_LANG']['tl_pdff_positions']['textitem_inverts']['empty'] = 'leer';

/**
 * Buttons
 */
$GLOBALS['TL_LANG']['tl_pdff_positions']['new']        = array('Neue Position', 'Neue Variablenposition erstellen');
$GLOBALS['TL_LANG']['tl_pdff_positions']['edit']       = array('Position bearbeiten', 'Position ID %s bearbeiten');
$GLOBALS['TL_LANG']['tl_pdff_positions']['copy']       = array('Position duplizieren', 'Position ID %s kopieren');
$GLOBALS['TL_LANG']['tl_pdff_positions']['cut']        = array('Position verschieben', 'Position ID %s verschieben');
$GLOBALS['TL_LANG']['tl_pdff_positions']['delete']     = array('Position löschen', 'Position ID %s löschen');
$GLOBALS['TL_LANG']['tl_pdff_positions']['toggle']     = array('Position veröffentlichen/unveröffentlichen', 'Position ID %s veröffentlichen/unveröffentlichen');
$GLOBALS['TL_LANG']['tl_pdff_positions']['show']       = array('Positions-Details', 'Details zu Position ID %s');
$GLOBALS['TL_LANG']['tl_pdff_positions']['editheader'] = array('Position bearbeiten', 'Diese Position bearbeiten');
$GLOBALS['TL_LANG']['tl_pdff_positions']['pasteafter'] = array('Am Anfang einfügen', 'Nach Position ID %s einfügen');
$GLOBALS['TL_LANG']['tl_pdff_positions']['pastenew']   = array('Neue Position unterhalb erstellen', 'Neue Position hinter ID %s erstellen');
$GLOBALS['TL_LANG']['tl_pdff_positions']['testpdf']    = array('Download Test-PDF', 'Testweise Ausgabe der ausgefüllten Vorlage als Download');

/**
 * Legends
 */
$GLOBALS['TL_LANG']['tl_pdff_positions']['pdff_legend']    = 'PDF-Formular ausfüllen';
$GLOBALS['TL_LANG']['tl_pdff_positions']['attr_legend']    = 'Position und Attribute';
$GLOBALS['TL_LANG']['tl_pdff_positions']['publish_legend'] = 'Veröffentlichung';

