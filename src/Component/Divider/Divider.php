<?php

namespace Reactic\BaseUi\Component\Divider;

use Symfony\UX\TwigComponent\Attribute\AsTwigComponent;

//#[AsTwigComponent('Divider:Divider')]
class Divider
{
    public string $orientation = 'horizontal';
    public ?string $label = 'parent';
    public string $labelPosition = 'center';

    /**
     * Get ARIA attributes for accessibility
     */
    public function getAriaAttributes(): array
    {
        $attributes = [
            'role' => 'separator',
        ];

        if ($this->orientation === 'vertical') {
            $attributes['aria-orientation'] = 'vertical';
        }

        return $attributes;
    }

    /**
     * Get data attributes
     */
    public function getDataAttributes(): array
    {
        return [
            'data-orientation' => $this->orientation,
        ];
    }

    /**
     * Check if divider has a label
     */
    public function hasLabel(): bool
    {
        return $this->label !== null && $this->label !== '';
    }
}
