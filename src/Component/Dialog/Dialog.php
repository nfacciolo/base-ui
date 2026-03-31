<?php

declare(strict_types=1);

namespace Reactic\BaseUi\Component\Dialog;

use Symfony\UX\TwigComponent\Attribute\AsTwigComponent;

#[AsTwigComponent(name: 'BaseUI:Dialog', template: '@BaseUi/components/BaseUI/Dialog/Dialog.html.twig')]
class Dialog
{
    public ?string $id = null;
    public bool $modal = true;
    public bool $open = false;
    public string $role = 'dialog';
    public bool $closeOnBackdropClick = true;
    public bool $closeOnEscape = true;

    /**
     * Generate a unique ID for the dialog if not provided
     */
    public function mount(): void
    {
        if ($this->id === null) {
            $this->id = 'dialog-' . uniqid('', true);
        }
    }

    /**
     * Get ARIA attributes for accessibility
     */
    public function getAriaAttributes(): array
    {
        $attributes = [
            'role' => $this->role,
        ];

        if ($this->modal) {
            $attributes['aria-modal'] = 'true';
        }

        return $attributes;
    }

    /**
     * Get data attributes for styling hooks and controller communication
     */
    public function getDataAttributes(): array
    {
        return [
            'data-component' => 'dialog',
            'data-modal' => $this->modal ? 'true' : 'false',
            'data-open' => $this->open ? 'true' : 'false',
        ];
    }

    /**
     * Get Stimulus controller data attributes
     */
    public function getControllerAttributes(): array
    {
        $attributes = [
            'data-controller' => 'reactic--base-ui--dialog',
            'data-reactic--base-ui--dialog-modal-value' => $this->modal ? 'true' : 'false',
            'data-reactic--base-ui--dialog-open-value' => $this->open ? 'true' : 'false',
            'data-reactic--base-ui--dialog-close-on-backdrop-click-value' => $this->closeOnBackdropClick ? 'true' : 'false',
            'data-reactic--base-ui--dialog-close-on-escape-value' => $this->closeOnEscape ? 'true' : 'false',
        ];

        return $attributes;
    }

    /**
     * Get the dialog ID
     */
    public function getId(): string
    {
        return $this->id;
    }
}
