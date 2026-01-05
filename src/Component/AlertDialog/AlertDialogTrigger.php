<?php

declare(strict_types=1);

namespace Reactic\BaseUi\Component\AlertDialog;

use Symfony\UX\TwigComponent\Attribute\AsTwigComponent;

#[AsTwigComponent(name: 'BaseUI:AlertDialog:Trigger', template: '@BaseUi/components/BaseUI/AlertDialog/AlertDialogTrigger.html.twig')]
class AlertDialogTrigger
{
    public ?string $id = null;
    public bool $disabled = false;

    /**
     * Get ARIA attributes for accessibility
     */
    public function getAriaAttributes(): array
    {
        $attributes = [];

        if ($this->disabled) {
            $attributes['aria-disabled'] = 'true';
        }

        return $attributes;
    }

    /**
     * Get data attributes for styling hooks
     */
    public function getDataAttributes(): array
    {
        return [
            'data-component' => 'alert-dialog-trigger',
            'data-reactic--base-ui--alert-dialog-target' => 'trigger',
        ];
    }

    /**
     * Generate unique ID if not provided
     */
    public function getId(): string
    {
        if ($this->id === null) {
            $this->id = 'trigger-' . uniqid();
        }

        return $this->id;
    }
}
