<?php

declare( strict_types=1 );

/**
 * Extension for Contao 5
 *
 * @copyright  Softleister 2014-2024
 * @author     Softleister <info@softleister.de>
 * @package    contao-pdfforms-bundle
 * @licence    LGPL
 * @see	       https://github.com/do-while/contao-pdfforms-bundle
 */

namespace Softleister\PdfformsBundle\EventListener;

use Contao\System;
use Contao\StringUtil;
use Softleister\PdfformsBundle\PdfformsHelper;
use Contao\CoreBundle\DependencyInjection\Attribute\AsHook;

//-----------------------------------------------------------------
//  InsertTags abarbeiten
//
//  {{pdf_forms::pdfdocument}}
//  {{pdf_forms::pdfdocument::name}}
//  {{pdf_forms::password_random}}
//  {{pdf_forms::form_*}}
//-----------------------------------------------------------------
#[AsHook('replaceInsertTags')]
class ReplaceInsertTagsListener
{
    public function __invoke( string $insertTag, bool $useCache, string $cachedValue, array $flags, array $tags, array $cache, int $_rit, int $_cnt )
    {
        $tag = explode( '::', $insertTag );
        if( !isset( $tag[2] ) ) $tag[2] = '';                                               // kein 3. Parameter angegeben, mit default ergänzen

        if( strtolower( $tag[0] ) !== 'pdf_forms' ) return false;                           // nicht zuständig für diese InsertTags

        $session = System::getContainer()->get('request_stack')->getSession();
        if( !$session || !$session->isStarted( ) ) return '';                               // IF( keine Session ) bisher kein Dokument erstellt: Leerstring

        if( strtolower( $tag[1] ) === 'pdfdocument' ) {
            $subtag = $session?->get( 'pdf_forms.pdfdocument', '' );                        // Sessionvariable lesen mit Fallback

            switch( strtolower( $tag[2] ) ) {
                case 'name':    return basename( $subtag );
                default:        return $subtag;
            }
        }
        else if( strtolower( $tag[1] ) === 'password_random' ) {
            return self::getRandomPassword( );
        }
        else if( substr( strtolower( $tag[1] ), 0, 5 ) === 'form_' ) {
            $widgetName = PdfformsHelper::normalisierung( substr( $tag[1], 5 ) );           // normalisierter Feldname

            $formid = $session?->get( 'pdf_forms.formid', '' );                             // Form-ID lesen
            $arrFields = $session?->get( 'pdf_forms.form_' . $formid . '.arrFields', [] );  // Sessionvariable lesen mit Fallback
            $value = $arrFields[$widgetName]['value'] ?? '';

            $value = StringUtil::standardize( StringUtil::restoreBasicEntities( $value ) ); // Inhalt Dateinamen-tauglich machen
            if( substr( $value, 0, 3 ) === 'id-' ) {                                        // Bei rein numerischen Werten wird id- voangestellt
                $value = substr( $value, 3 );                                               // das wird hier wieder entfernt
            }
            return $value;
        }

        return false;                                                                       // kein bekannter InsertTag => nicht zuständig!
    }


    //-----------------------------------------------------------------
    //  Erstellt ein Zufalls-Passwort
    //-----------------------------------------------------------------
    private function getRandomPassword( )
    {
        $zeichen = 'aAbBcCdDeEfFgGhHijJkKLmMnNopPqQrRsStTuUvVwWxXyYzZ-$!123456789';
        
        // Passwort erstellen
        $pw = '';
        for( $i = 0; $i < 12; $i++ ) {                               // 12 Zeichen
            $pw .= $zeichen[rand( 0, strlen( $zeichen ) - 1 )];
        }

        return $pw;
    }


    //-----------------------------------------------------------------
}

