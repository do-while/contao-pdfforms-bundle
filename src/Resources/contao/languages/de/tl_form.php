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
$GLOBALS['TL_LANG']['tl_form']['pdff_on']             = ['PDF-Formular ausfüllen', 'Ausfüllen einer PDF-Vorlage'];
$GLOBALS['TL_LANG']['tl_form']['pdff_vorlage']        = ['PDF-Vorlage-Datei', 'Bitte wählen Sie die PDF-Datei als Vorlage aus. Sie haben so die Möglichkeit, die Vorlage von Formularinhalten abhängig zu machen.'];
$GLOBALS['TL_LANG']['tl_form']['pdff_handler']        = ['Weiterverarbeitung', 'Was weiter mit dem PDF passieren soll'];
$GLOBALS['TL_LANG']['tl_form']['pdff_savepath']       = ['Verzeichnis zur Speicherung', 'Bitte wählen Sie das Verzeichnis aus, wo die PDF-Dateien gespeichert werden sollen. Das Verzeichnis kann auch geschützt sein. Beim Speichern ins Home-Verzeichnis ist es Fallback, wenn kein Benutzer eingeloggt ist.'];
$GLOBALS['TL_LANG']['tl_form']['pdff_protect']        = ['PDF schützen', 'Das PDF wird mit Passwortschutz versehen'];
$GLOBALS['TL_LANG']['tl_form']['pdff_openpassword']   = ['PDF-Passwort zum Öffnen', 'Lassen Sie das Feld leer, wenn Öffnen ohne Passwort möglich sein soll.'];
$GLOBALS['TL_LANG']['tl_form']['pdff_protectflags']   = ['Berechtigungen', 'Markieren Sie alles, was ohne Passwort möglich sein soll.'];
$GLOBALS['TL_LANG']['tl_form']['pdff_password']       = ['PDF-Passwort für Berechtigungen', 'Wenn dieses Feld leer bleibt, wird ein Zufallspasswort erzeugt'];
$GLOBALS['TL_LANG']['tl_form']['pdff_allpages']       = ['Alle gültigen Vorlagenseiten übernehmen', 'Übernimmt auch Vorlagenseiten ohne Positionseinträge in das PDF.'];
$GLOBALS['TL_LANG']['tl_form']['pdff_offset']         = ['Grund-Offset', 'X- und Y-Verschiebung in Millimeter aller Positionen auf den Seiten.'];
$GLOBALS['TL_LANG']['tl_form']['pdff_textcolor']      = ['Schreibfarbe im PDF', 'Bitte wählen Sie die Stiftfarbe für das Ausfüllen der Einträge aus'];
$GLOBALS['TL_LANG']['tl_form']['pdff_author']         = ['Autor', 'Angegebener Autor in den PDF-Eigenschaften'];
$GLOBALS['TL_LANG']['tl_form']['pdff_title']          = ['Titel', 'Titel des PDF-Dokuments'];
$GLOBALS['TL_LANG']['tl_form']['pdff_fileext']        = ['Dateinamen erweitern', 'Ergänzen Sie den Dateinamen mit InsertTags, z.B. {{date::ymd_His}}, um ihn eindeutig zu machen.'];
$GLOBALS['TL_LANG']['tl_form']['pdff_multiform']      = ['Mehrformular-Vorlage', 'Enthält die Vorlagedatei mehrere Formulare, können hier zutreffende Seiten definiert werden, z.B. 1-4,7,10. Lassen Sie die Felder leer, um alle Seiten zu verwenden.'];
$GLOBALS['TL_LANG']['tl_form']['multiform_bedingung'] = ['Bedingung', 'Ist die Bedingung erfüllt, werden nur die angegebenen Seiten in die PDF-Ausgabe übernommen.'];
$GLOBALS['TL_LANG']['tl_form']['multiform_seiten']    = ['Seiten aus der PDF-Vorlage', 'Geben Sie mit Komma getrennt oder als Bereichsangaben eine Liste der zugehörigen Seiten an, z.B. 1-4,7,10'];
$GLOBALS['TL_LANG']['tl_form']['pdff_font']           = ['Eigener Font (normal)', 'Wählen Sie hier ihre Fontdatei für die regular-Schrift oder lassen Sie das Feld leer für den Standardfont.'];
$GLOBALS['TL_LANG']['tl_form']['pdff_fontb']          = ['Eigener Font (fett)', 'Wählen Sie hier ihre Fontdatei für die bold-Schrift oder lassen Sie das Feld leer für den Standardfont.'];
$GLOBALS['TL_LANG']['tl_form']['pdff_fonti']          = ['Eigener Font (kursiv)', 'Wählen Sie hier ihre Fontdatei für die italic-Schrift oder lassen Sie das Feld leer für den Standardfont.'];
$GLOBALS['TL_LANG']['tl_form']['pdff_fontbi']         = ['Eigener Font (fett+kursiv)', 'Wählen Sie hier ihre Fontdatei für die bold-italic-Schrift oder lassen Sie das Feld leer für den Standardfont.'];
$GLOBALS['TL_LANG']['tl_form']['pdff_userhome']       = ['Speicherm im Home-Verzeichnis', 'Bei eigeloggtem Benutzer, soll das PDF abweichend im dessen privaten Verzeichnis gespeichert werden.'];

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
$GLOBALS['TL_LANG']['tl_form']['positions']  = ['Positionen', 'Definition der Textpositionen im PDF'];
 
/**
 * Legends
 */
$GLOBALS['TL_LANG']['tl_form']['pdff_legend']     = 'PDF-Formular ausfüllen';
$GLOBALS['TL_LANG']['tl_form']['pdff_fontlegend'] = 'Eigene Fonts verwenden';
