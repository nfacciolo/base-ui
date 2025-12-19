<?php

declare(strict_types=1);

namespace Reactic\SymfonyBaseUi\Component\Button;

use Symfony\UX\TwigComponent\Attribute\AsTwigComponent;

#[AsTwigComponent(name: 'BaseUI:Button', template: '@SymfonyBaseUi/components/BaseUI/Button/Button.html.twig')]
class Button
{
    public bool $disabled = false;
    public bool $focusableWhenDisabled = false;
    public string $tag = 'button';
    public string $label = 'click me';
    public string $type = 'button';

    /**
     * Get ARIA attributes for accessibility
     */
    public function getAriaAttributes(): array
    {
        $attributes = [];

        // When focusableWhenDisabled is true, use aria-disabled instead of disabled attribute
        if ($this->disabled && $this->focusableWhenDisabled) {
            $attributes['aria-disabled'] = 'true';
        }

        // Add role="button" when rendering as non-button element
        if ($this->tag !== 'button') {
            $attributes['role'] = 'button';
            // Make non-button elements focusable
            if (!$this->disabled || $this->focusableWhenDisabled) {
                $attributes['tabindex'] = '0';
            }
        }

        return $attributes;
    }

    /**
     * Get data attributes for styling hooks
     */
    public function getDataAttributes(): array
    {
        return [
            'data-component' => 'button',
            'data-disabled' => $this->disabled ? 'true' : 'false',
        ];
    }

    /**
     * Check if native disabled attribute should be used
     * Only when disabled=true and focusableWhenDisabled=false
     */
    public function shouldUseNativeDisabled(): bool
    {
        return $this->disabled && !$this->focusableWhenDisabled;
    }

    /**
     * Get the HTML tag to render
     */
    public function getTag(): string
    {
        return $this->tag;
    }

    /**
     * Get the button type attribute
     * Returns 'button' by default to prevent form submission
     */
    public function getType(): ?string
    {
        if ($this->type !== null) {
            return $this->type;
        }

        return $this->tag === 'button' ? 'button' : null;
    }
}
