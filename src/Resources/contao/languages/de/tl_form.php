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
$GLOBALS['TL_LANG']['tl_form']['pdff_on']           = array('PDF-Formular ausfüllen', 'Ausfüllen einer PDF-Vorlage');
$GLOBALS['TL_LANG']['tl_form']['pdff_vorlage']      = array('PDF-Vorlage-Datei', 'Bitte wählen Sie die PDF-Datei als Vorlage aus. Sie haben so die Möglichkeit, die Vorlage von Formularinhalten abhängig zu machen.');
$GLOBALS['TL_LANG']['tl_form']['pdff_handler']      = array('Weiterverarbeitung', 'Was weiter mit dem PDF passieren soll');
$GLOBALS['TL_LANG']['tl_form']['pdff_savepath']     = array('Verzeichnis zur Speicherung', 'Bitte wählen Sie das Verzeichnis aus, wo die PDF-Dateien gespeichert werden sollen. Das Verzeichnis kann auch geschützt sein.');
$GLOBALS['TL_LANG']['tl_form']['pdff_protect']      = array('PDF schützen', 'Das PDF wird mit Passwortschutz versehen');
$GLOBALS['TL_LANG']['tl_form']['pdff_openpassword'] = array('PDF-Passwort zum Öffnen', 'Lassen Sie das Feld leer, wenn Öffnen ohne Passwort möglich sein soll.');
$GLOBALS['TL_LANG']['tl_form']['pdff_protectflags'] = array('Berechtigungen', 'Markieren Sie alles, was ohne Passwort möglich sein soll.');
$GLOBALS['TL_LANG']['tl_form']['pdff_password']     = array('PDF-Passwort für Berechtigungen', 'Wenn dieses Feld leer bleibt, wird ein Zufallspasswort erzeugt');
$GLOBALS['TL_LANG']['tl_form']['pdff_allpages']     = array('Alle Vorlagenseiten übernehmen', 'Übernimmt auch Vorlagenseiten ohne Positionseinträge in das PDF.');
$GLOBALS['TL_LANG']['tl_form']['pdff_offset']       = array('Grund-Offset', 'X- und Y-Verschiebung in Millimeter aller Positionen auf den Seiten.');
$GLOBALS['TL_LANG']['tl_form']['pdff_textcolor']    = array('Schreibfarbe im PDF', 'Bitte wählen Sie die Stiftfarbe für das Ausfüllen der Einträge aus');
$GLOBALS['TL_LANG']['tl_form']['pdff_author']       = array('Autor', 'Angegebener Autor in den PDF-Eigenschaften');
$GLOBALS['TL_LANG']['tl_form']['pdff_title']        = array('Titel', 'Titel des PDF-Dokuments');
$GLOBALS['TL_LANG']['tl_form']['pdff_fileext']      = array('Dateinamen erweitern', 'Ergänzen Sie den Dateinamen mit InsertTags, z.B. {{date::ymd_His}}, um ihn eindeutig zu machen.');

/**
 * References
 */
$GLOBALS['TL_LANG']['tl_form']['pdff_handlers']['save']           = 'PDF-Datei speichern';
$GLOBALS['TL_LANG']['tl_form']['pdff_handlers']['email']          = 'PDF-Datei speichern und an die E-Mail anhängen';

$GLOBALS['TL_LANG']['tl_form']['pdff_protectflag']['print']       = 'Drucken';
$GLOBALS['TL_LANG']['tl_form']['pdff_protectflag']['print-high']  = 'Drucken in hoher Auflösung';
$GLOBALS['TL_LANG']['tl_form']['pdff_protectflag']['modify']      = 'Ändern des Dokuments';
$GLOBALS['TL_LANG']['tl_form']['pdff_protectflag']['assemble']    = 'Seiten einfügen, drehen, löschen, Lesezeichen';
$GLOBALS['TL_LANG']['tl_form']['pdff_protectflag']['copy']        = 'Kopieren von Inhalten';
$GLOBALS['TL_LANG']['tl_form']['pdff_protectflag']['annot-forms'] = 'Kommentieren';
$GLOBALS['TL_LANG']['tl_form']['pdff_protectflag']['extract']     = 'Seitenentnahme';
$GLOBALS['TL_LANG']['tl_form']['pdff_protectflag']['fill-forms']  = 'Formularfelder ausfüllen';

/**
 * Buttons
 */
$GLOBALS['TL_LANG']['tl_form']['positions']  = array('Positionen', 'Definition der Textpositionen im PDF');
 
/**
 * Legends
 */
$GLOBALS['TL_LANG']['tl_form']['pdff_legend']  = 'PDF-Formular ausfüllen';
