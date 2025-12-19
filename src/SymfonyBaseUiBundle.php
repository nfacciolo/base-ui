<?php

declare(strict_types=1);

namespace Reactic\SymfonyBaseUi;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator;
use Symfony\Component\HttpKernel\Bundle\AbstractBundle;

use function dirname;

final class SymfonyBaseUiBundle extends AbstractBundle
{
    public function prependExtension(ContainerConfigurator $container, ContainerBuilder $builder): void
    {
        // Namespace Twig => @SymfonyBaseUi
        $viewsPath = dirname(__DIR__).'/templates';

        $container->extension('twig', [
            'paths' => [
                $viewsPath => 'SymfonyBaseUi',
            ],
        ]);

        // TwigComponent: namespace PHP => dossier template
        $container->extension('twig_component', [
            'defaults' => [
                'Reactic\\SymfonyBaseUi\\Component\\' => '@SymfonyBaseUi/components',
            ],
        ]);
    }

    public function loadExtension(array $config, ContainerConfigurator $container, ContainerBuilder $builder): void
    {
        $container->import('../config/services.php');
    }
}
