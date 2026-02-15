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

namespace Softleister\PdfformsBundle\DependencyInjection;

use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Extension\Extension;
use Symfony\Component\DependencyInjection\Loader\YamlFileLoader;

class SoftleisterPdfformsExtension extends Extension
{
    public function load( array $configs, ContainerBuilder $container ): void
    {
        $configuration = new Configuration( );
        $config = $this->processConfiguration( $configuration, $configs );
        $container->setParameter( 'softleister_pdfforms.add_condition_options', $config['add_condition_options'] );

        $loader = new YamlFileLoader( $container, new FileLocator( __DIR__ . '/../Resources/config' ) );
        $loader->load( 'services.yaml' );
    }
}
