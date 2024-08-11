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

namespace Softleister\PdfformsBundle\ContaoManager;

use Contao\CoreBundle\ContaoCoreBundle;
use Contao\ManagerPlugin\Bundle\Config\BundleConfig;
use Contao\ManagerPlugin\Bundle\BundlePluginInterface;
use Contao\ManagerPlugin\Bundle\Parser\ParserInterface;
use Softleister\PdfformsBundle\SoftleisterPdfformsBundle;


/**
 * Plugin for the Contao Manager.
 *
 * @author Softleister
 */
class Plugin implements BundlePluginInterface
{
    public function getBundles( ParserInterface $parser ): array
    {
        return [
            BundleConfig::create( SoftleisterPdfformsBundle::class )
                ->setLoadAfter( [ContaoCoreBundle::class] ),
        ];
    }
}
