<?php

declare(strict_types=1);

namespace Reactic\BaseUi\Component\AlertDialog;

use Symfony\UX\TwigComponent\Attribute\AsTwigComponent;

#[AsTwigComponent(name: 'BaseUI:AlertDialog:Close', template: '@BaseUi/components/BaseUI/AlertDialog/AlertDialogClose.html.twig')]
class AlertDialogClose
{
    public string $variant = 'cancel';
    public ?string $formAction = null;
    public string $formMethod = 'post';

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
            'data-component' => 'alert-dialog-close',
            'data-variant' => $this->variant,
        ];
    }

    /**
     * Get action attributes for Stimulus
     */
    public function getActionAttributes(): array
    {
        if ($this->formAction !== null && $this->variant === 'confirm') {
            return [
                'data-action' => 'click->reactic--base-ui--alert-dialog#confirmAndSubmit',
            ];
        }

        return [
            'data-action' => 'click->reactic--base-ui--alert-dialog#close',
        ];
    }

    /**
     * Get button type based on whether form action is present
     */
    public function getButtonType(): string
    {
        return $this->formAction !== null && $this->variant === 'confirm' ? 'submit' : 'button';
    }

    /**
     * Check if button should act as a form submit
     */
    public function hasFormAction(): bool
    {
        return $this->formAction !== null && $this->variant === 'confirm';
    }
}
