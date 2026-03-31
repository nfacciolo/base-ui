<?php

declare(strict_types=1);

namespace Reactic\BaseUi\Component\Dialog;

use Symfony\UX\TwigComponent\Attribute\AsTwigComponent;

#[AsTwigComponent(name: 'BaseUI:Dialog:Header', template: '@BaseUi/components/BaseUI/Dialog/DialogHeader.html.twig')]
class DialogHeader
{
    /**
     * Get data attributes for styling
     */
    public function getDataAttributes(): array
    {
        return [
            'data-dialog-header' => '',
        ];
    }
}
