<?php

declare(strict_types=1);

namespace Reactic\BaseUi\Component\AlertDialog;

use Symfony\UX\TwigComponent\Attribute\AsTwigComponent;

#[AsTwigComponent(name: 'BaseUI:AlertDialog', template: '@BaseUi/components/BaseUI/AlertDialog/AlertDialog.html.twig')]
class AlertDialog
{
    public ?bool $open = null;
    public bool $defaultOpen = false;
    public ?string $onOpenChange = null;
    public ?string $triggerId = null;

    /**
     * Get ARIA attributes for accessibility
     */
    public function getAriaAttributes(): array
    {
        return [
            'role' => 'alertdialog',
            'aria-modal' => 'true',
        ];
    }

    /**
     * Get data attributes for styling hooks
     */
    public function getDataAttributes(): array
    {
        return [
            'data-component' => 'alert-dialog',
            'data-open' => $this->isOpen() ? 'true' : 'false',
        ];
    }

    /**
     * Get Stimulus controller data attributes
     */
    public function getControllerAttributes(): array
    {
        $attributes = [
            'data-controller' => 'reactic--base-ui--alert-dialog',
        ];

        if ($this->open !== null) {
            $attributes['data-reactic--base-ui--alert-dialog-open-value'] = $this->open ? 'true' : 'false';
        }

        if ($this->defaultOpen) {
            $attributes['data-reactic--base-ui--alert-dialog-default-open-value'] = 'true';
        }

        if ($this->triggerId !== null) {
            $attributes['data-reactic--base-ui--alert-dialog-trigger-id-value'] = $this->triggerId;
        }

        return $attributes;
    }

    /**
     * Check if dialog is currently open
     */
    private function isOpen(): bool
    {
        return $this->open ?? $this->defaultOpen;
    }
}
