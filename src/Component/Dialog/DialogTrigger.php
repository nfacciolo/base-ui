<?php

declare(strict_types=1);

namespace Reactic\BaseUi\Component\Dialog;

use Symfony\UX\TwigComponent\Attribute\AsTwigComponent;

#[AsTwigComponent(name: 'BaseUI:Dialog:Trigger', template: '@BaseUi/components/BaseUI/Dialog/DialogTrigger.html.twig')]
class DialogTrigger
{
    public bool $disabled = false;

    /**
     * Get ARIA attributes for accessibility
     */
    public function getAriaAttributes(): array
    {
        return [
            'aria-haspopup' => 'dialog',
        ];
    }

    /**
     * Get data attributes for styling and controller actions
     */
    public function getDataAttributes(): array
    {
        return [
            'data-dialog-trigger' => '',
            'data-action' => 'click->reactic--base-ui--dialog#open',
        ];
    }

    /**
     * Get button attributes
     */
    public function getButtonAttributes(): array
    {
        $attributes = [
            'type' => 'button',
        ];

        if ($this->disabled) {
            $attributes['disabled'] = 'disabled';
        }

        return $attributes;
    }
}
