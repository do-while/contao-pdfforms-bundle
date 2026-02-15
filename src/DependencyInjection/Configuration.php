<?php

declare(strict_types=1);

/**
 * Extension for Contao 5
 *
 * @copyright  Softleister 2014-2026
 * @author     Softleister <info@softleister.de>
 * @package    contao-pdfforms-bundle
 * @licence    LGPL
 * @see	       https://github.com/do-while/contao-pdfforms-bundle
 */

namespace Softleister\PdfformsBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;


final class Configuration implements ConfigurationInterface
{
    public function getConfigTreeBuilder( ): TreeBuilder
    {
        $treeBuilder = new TreeBuilder( 'softleister_pdfforms' );

        $treeBuilder->getRootNode( )
                    ->children( )
                    ->arrayNode( 'add_condition_options' )
                    ->scalarPrototype( )
                    ->end( )
                    ->defaultValue( [] )   // falls nicht gesetzt
                    ->end( )
                    ->end( );

        return $treeBuilder;
    }
}
