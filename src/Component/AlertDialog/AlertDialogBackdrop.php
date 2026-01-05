<?php

declare(strict_types=1);

namespace Reactic\BaseUi\Component\AlertDialog;

use Symfony\UX\TwigComponent\Attribute\AsTwigComponent;

#[AsTwigComponent(name: 'BaseUI:AlertDialog:Backdrop', template: '@BaseUi/components/BaseUI/AlertDialog/AlertDialogBackdrop.html.twig')]
class AlertDialogBackdrop
{
    public bool $dismissible = true;

    /**
     * Get ARIA attributes for accessibility
     */
    public function getAriaAttributes(): array
    {
        return [
            'aria-hidden' => 'true',
        ];
    }

    /**
     * Get data attributes for styling hooks
     */
    public function getDataAttributes(): array
    {
        return [
            'data-component' => 'alert-dialog-backdrop',
            'data-reactic--base-ui--alert-dialog-target' => 'backdrop',
        ];
    }

    /**
     * Get action attributes for Stimulus
     */
    public function getActionAttributes(): array
    {
        if ($this->dismissible) {
            return [
                'data-action' => 'click->reactic--base-ui--alert-dialog#closeOnBackdrop',
            ];
        }

        return [];
    }
}
