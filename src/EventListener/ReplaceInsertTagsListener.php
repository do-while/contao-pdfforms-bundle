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

use Contao\CoreBundle\DependencyInjection\Attribute\AsHook;

//-----------------------------------------------------------------
//  InsertTags abarbeiten
//
//  {{pdf_forms::pdfdocument}}
//  {{pdf_forms::pdfdocument::name}}
//  {{pdf_forms::password_random}}
//-----------------------------------------------------------------
#[AsHook('replaceInsertTags')]
class ReplaceInsertTagsListener
{
    public function __invoke( string $insertTag, bool $useCache, string $cachedValue, array $flags, array $tags, array $cache, int $_rit, int $_cnt )
    {
        $tag = explode( '::', $insertTag );
        if( strtolower( $tag[0] ) !== 'pdf_forms' ) return false;                       // nicht zuständig für diese InsertTags

        if( strtolower( $tag[1] ) === 'pdfdocument' ) {
            if( !isset( $_SESSION['pdf_forms']['pdfdocument'] ) ) return '';            // bisher kein Dokument erstellt: Leerstring

            if( !isset( $tag[2] ) ) $tag[2] = '';                                       // kein 3. Parameter angegeben, mit default ergänzen
            switch( strtolower( $tag[2] ) ) {
                case 'name':    return basename( $_SESSION['pdf_forms']['pdfdocument'] );
                default:        return $_SESSION['pdf_forms']['pdfdocument'];
            }
        }
        else if( strtolower( $tag[1] ) === 'password_random' ) {
            return self::getRandomPassword( );
        }

        return false;                                                                   // kein bekannter InsertTag => nicht zuständig!
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

