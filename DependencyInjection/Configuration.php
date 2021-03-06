<?php

namespace Wiz\HttpsqsBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

/**
 * This is the class that validates and merges configuration from your app/config files
 *
 * To learn more see {@link http://symfony.com/doc/current/cookbook/bundles/extension.html#cookbook-bundles-extension-config-class}
 */
class Configuration implements ConfigurationInterface
{
    /**
     * {@inheritDoc}
     */
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder();
        $rootNode = $treeBuilder->root('wiz_httpsqs');

        $rootNode
            ->children()
                ->scalarNode('host')->defaultValue('127.0.0.1')->end()
                ->integerNode('port')->defaultValue(1218)->end()
                ->scalarNode('auth')->defaultValue('')->end()
                ->scalarNode('charset')->defaultValue('utf-8')->end()
                ->arrayNode('queues')
                    ->isRequired()
                    ->requiresAtLeastOneElement()
                    ->prototype('scalar')
                ->end()
            ->end();

        return $treeBuilder;
    }
}
