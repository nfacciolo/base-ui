<?php

declare(strict_types=1);

namespace Reactic\BaseUi;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator;
use Symfony\Component\HttpKernel\Bundle\AbstractBundle;

use function dirname;

final class BaseUiBundle extends AbstractBundle
{
    public function prependExtension(ContainerConfigurator $container, ContainerBuilder $builder): void
    {
        // Namespace Twig => @BaseUi
        $viewsPath = dirname(__DIR__).'/templates';

        $container->extension('twig', [
            'paths' => [
                $viewsPath => 'BaseUi',
            ],
        ]);

        // TwigComponent: namespace PHP => dossier template
        $container->extension('twig_component', [
            'defaults' => [
                'Reactic\\BaseUi\\Component\\' => '@BaseUi/components',
            ],
        ]);
    }

    public function loadExtension(array $config, ContainerConfigurator $container, ContainerBuilder $builder): void
    {
        $container->import('../config/services.php');
    }
}
