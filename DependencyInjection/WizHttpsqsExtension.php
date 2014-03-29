<?php

namespace Wiz\HttpsqsBundle\DependencyInjection;

use HTTPSQS\Queue;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\Definition;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;
use Symfony\Component\DependencyInjection\Loader;
use Symfony\Component\PropertyAccess\PropertyAccess;

/**
 * This is the class that loads and manages your bundle configuration
 *
 * To learn more see {@link http://symfony.com/doc/current/cookbook/bundles/extension.html}
 */
class WizHttpsqsExtension extends Extension
{
    /**
     * {@inheritDoc}
     */
    public function load(array $configs, ContainerBuilder $container)
    {
        $configuration = new Configuration();
        $config = $this->processConfiguration($configuration, $configs);

        $propertyAccess = PropertyAccess::createPropertyAccessor();

        $queues = $propertyAccess->getValue($config, '[queues]');
        foreach ($queues as $queue) {
            $serviceId = 'wiz_httpsqs.queue.' . $queue;
            $definition = new Definition('HTTPSQS\Queue', array($queue));
            $container->setDefinition($serviceId, $definition);
        }
    }
}
