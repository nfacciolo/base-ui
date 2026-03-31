<?php

declare(strict_types=1);

namespace Reactic\BaseUi\Component\Dialog;

use Symfony\UX\TwigComponent\Attribute\AsTwigComponent;

#[AsTwigComponent(name: 'BaseUI:Dialog:Title', template: '@BaseUi/components/BaseUI/Dialog/DialogTitle.html.twig')]
class DialogTitle
{
    public int $level = 2;

    /**
     * Get the heading tag based on level
     */
    public function getTag(): string
    {
        return 'h' . $this->level;
    }

    /**
     * Get data attributes for styling and accessibility
     */
    public function getDataAttributes(): array
    {
        return [
            'data-dialog-title' => '',
            'data-reactic--base-ui--dialog-target' => 'title',
        ];
    }

    /**
     * Get a unique ID for aria-labelledby
     */
    public function getId(): string
    {
        return 'dialog-title-' . uniqid();
    }
}
