<?php

declare(strict_types=1);

namespace Reactic\BaseUi\Component\Dialog;

use Symfony\UX\TwigComponent\Attribute\AsTwigComponent;

#[AsTwigComponent(name: 'BaseUI:Dialog:Footer', template: '@BaseUi/components/BaseUI/Dialog/DialogFooter.html.twig')]
class DialogFooter
{
    /**
     * Get data attributes for styling
     */
    public function getDataAttributes(): array
    {
        return [
            'data-dialog-footer' => '',
        ];
    }
}
