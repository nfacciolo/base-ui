<?php

declare(strict_types=1);

namespace Reactic\BaseUi\Component\Dialog;

use Symfony\UX\TwigComponent\Attribute\AsTwigComponent;

#[AsTwigComponent(name: 'BaseUI:Dialog:Content', template: '@BaseUi/components/BaseUI/Dialog/DialogContent.html.twig')]
class DialogContent
{
    /**
     * Get data attributes for styling
     */
    public function getDataAttributes(): array
    {
        return [
            'data-dialog-content' => '',
            'data-reactic--base-ui--dialog-target' => 'content',
        ];
    }
}
