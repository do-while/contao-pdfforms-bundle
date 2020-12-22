# do-while/contao-pdfforms-bundle
**Diese Contao-Erweiterung erweitert den Formulargenerator von Contao 4 um die Möglichkeit, mit den im Online-Formular eingegebenen Daten eine PDF-Vorlage auszufüllen, zu speichern und zu versenden.**

Die Erweiterung contao-pdfforms-bundle installiert sich als eingeschränkte Demo. Die Demoversion druckt bei vollem Funktionsumfang einen Demo-Hinweis in das PDF und ist auf 2 Ausgabeseiten begrenzt. Wenn Sie einen Lizenzkey kaufen, wird die volle Funktionalität freigeschaltet. Die Lizenz erlaubt ihnen den Einsatz der Erweiterung in der beim Kauf angegebenen Domain. Der Einsatz in weiteren Domains bedarf einer zusätzlichen Lizenz.

Eine ausführliche Anleitung finden Sie als PDF-Datei im Verzeichnis der Erweiterung:<br>`vendor/do-while/contao-pdfforms-bundle/src/Resources/contao/docs`
___


**This Contao extension expands the form generator of Contao 4 with the ability to fill out a PDF template with the data entered in the online form, to store and to mail it.**

The extension contao-pdfforms-bundle is installed as a limited demo. The demo version prints a demo note in the PDF, has full functionality but is limited to 2 output pages. When you buy a license key, the restrictions are removed. The license allows you to use the extension in the domain specified at the time of purchase. The use in other domains requires an additional license.

Detailed instructions can be found as a PDF file in the extension directory:<br>`vendor/do-while/contao-pdfforms-bundle/src/Resources/contao/docs`


## Installation
Installieren Sie die Erweiterung einfach mit dem **Contao Manager** oder auf der Kommandozeile mit dem **Composer**:<br>*Simply install the extension with the **Contao Manager** or on the command line with the **Composer**:*
```
composer require do-while/contao-pdfforms-bundle
```

## Documentation
[Deutsches Handbuch](http://www.softleister.de/files/manuals/contao-pdfforms-bundle/Anleitung_contao-pdfforms-bundle.pdf)<br>
[English manual](http://www.softleister.de/files/manuals/contao-pdfforms-bundle/Manual_contao-pdfforms-bundle.pdf)


## Version
* 1.6.0<br>Freigabedatum: 2020-12-23<br>Erweitert um die Verwendung eigener Fonts
* 1.5.2<br>Freigabedatum: 2020-03-19<br>Warnings in PHP 7.3 beseitigt
* 1.5.0<br>Freigabedatum: 2019-05-24<br>1) Lauffähig in Contao >=4.7, Problematik: TCPDF ist jetzt ein Bundle
* 1.4.0<br>Freigabedatum: 2018-10-03<br>Kompatibilität mit PHP 7.2, mcrypt ersetzt<br>**Achtung** Die Passwörter in den Formulareigenschaften müssen neu gesetzt werden!
* 1.3.0<br>Freigabedatum: 2018-03-04<br>Neues Feature: Mehrformular-Vorlagen
* 1.2.0<br>Freigabedatum: 2018-02-25<br>Leere Seiten werden unterdrückt, wenn nicht "Alle Vorlagenseiten übernehmen" angehakt
* 1.1.0<br>Freigabedatum: 2018-02-22<br>InsertTag {{pdf_forms::password_random}}, Simple-Token ##openpassword##
* 1.0.0<br>Freigabedatum: 2018-02-09<br>Version für Contao ab Version 4.4 LTS


**Problem melden | *Report Problem*:**<br>per E-Mail | *via Email*: licence@softleister.de

___
Softleister - 2020-12-23
