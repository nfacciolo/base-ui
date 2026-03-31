<?php

declare(strict_types=1);

namespace Reactic\BaseUi\Component\Dialog;

use Symfony\UX\TwigComponent\Attribute\AsTwigComponent;

#[AsTwigComponent(name: 'BaseUI:Dialog:Description', template: '@BaseUi/components/BaseUI/Dialog/DialogDescription.html.twig')]
class DialogDescription
{
    /**
     * Get data attributes for styling and accessibility
     */
    public function getDataAttributes(): array
    {
        return [
            'data-dialog-description' => '',
            'data-reactic--base-ui--dialog-target' => 'description',
        ];
    }

    /**
     * Get a unique ID for aria-describedby
     */
    public function getId(): string
    {
        return 'dialog-description-' . uniqid();
    }
}
