<?php

declare(strict_types=1);

namespace Reactic\BaseUi\Component\AlertDialog;

use Symfony\UX\TwigComponent\Attribute\AsTwigComponent;

#[AsTwigComponent(name: 'BaseUI:AlertDialog:Popup', template: '@BaseUi/components/BaseUI/AlertDialog/AlertDialogPopup.html.twig')]
class AlertDialogPopup
{
    public ?string $initialFocus = null;
    public ?string $finalFocus = null;

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
        $attributes = [
            'data-component' => 'alert-dialog-popup',
            'data-reactic--base-ui--alert-dialog-target' => 'popup',
        ];

        if ($this->initialFocus !== null) {
            $attributes['data-reactic--base-ui--alert-dialog-initial-focus-value'] = $this->initialFocus;
        }

        if ($this->finalFocus !== null) {
            $attributes['data-reactic--base-ui--alert-dialog-final-focus-value'] = $this->finalFocus;
        }

        return $attributes;
    }

    /**
     * Get action attributes for Stimulus
     */
    public function getActionAttributes(): array
    {
        return [
            'data-action' => 'keydown->reactic--base-ui--alert-dialog#handleKeydown',
        ];
    }
}
