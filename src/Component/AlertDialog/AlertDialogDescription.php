<?php

declare(strict_types=1);

namespace Reactic\BaseUi\Component\AlertDialog;

use Symfony\UX\TwigComponent\Attribute\AsTwigComponent;

#[AsTwigComponent(name: 'BaseUI:AlertDialog:Description', template: '@BaseUi/components/BaseUI/AlertDialog/AlertDialogDescription.html.twig')]
class AlertDialogDescription
{
    /**
     * Get ARIA attributes for accessibility
     */
    public function getAriaAttributes(): array
    {
        return [];
    }

    /**
     * Get data attributes for styling hooks
     */
    public function getDataAttributes(): array
    {
        return [
            'data-component' => 'alert-dialog-description',
            'data-reactic--base-ui--alert-dialog-target' => 'description',
        ];
    }

    /**
     * Generate unique ID for ARIA reference
     */
    public function getId(): string
    {
        return 'alert-dialog-description-' . uniqid();
    }
}
