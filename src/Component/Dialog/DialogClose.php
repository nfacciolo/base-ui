<?php

declare(strict_types=1);

namespace Reactic\BaseUi\Component\Dialog;

use Symfony\UX\TwigComponent\Attribute\AsTwigComponent;

#[AsTwigComponent(name: 'BaseUI:Dialog:Close', template: '@BaseUi/components/BaseUI/Dialog/DialogClose.html.twig')]
class DialogClose
{
    public string $label = 'Close';
    public bool $icon = true;

    /**
     * Get ARIA attributes for accessibility
     */
    public function getAriaAttributes(): array
    {
        return [
            'aria-label' => $this->label,
        ];
    }

    /**
     * Get data attributes for styling and controller actions
     */
    public function getDataAttributes(): array
    {
        return [
            'data-dialog-close' => '',
            'data-action' => 'click->reactic--base-ui--dialog#close',
        ];
    }

    /**
     * Get button attributes
     */
    public function getButtonAttributes(): array
    {
        return [
            'type' => 'button',
        ];
    }

    /**
     * Check if close button should render as icon-only
     */
    public function isIconOnly(): bool
    {
        return $this->icon;
    }
}
