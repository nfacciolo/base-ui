<?php

declare(strict_types=1);

namespace Reactic\BaseUi\Component\Accordion;

use Symfony\UX\TwigComponent\Attribute\AsTwigComponent;

#[AsTwigComponent(name: 'BaseUI:Accordion', template: '@BaseUi/components/BaseUI/Accordion/Accordion.html.twig')]
class Accordion
{
    public bool $multiple = false;
    public ?string $defaultValue = null;
    public bool $disabled = false;
    public string $orientation = 'vertical';

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
            'data-component' => 'accordion',
            'data-orientation' => $this->orientation,
            'data-disabled' => $this->disabled ? 'true' : 'false',
        ];
    }

    /**
     * Get Stimulus controller data attributes
     */
    public function getControllerAttributes(): array
    {
        $attributes = [
            'data-controller' => 'reactic--base-ui--accordion',
        ];

        if ($this->multiple) {
            $attributes['data-reactic--base-ui--accordion-multiple-value'] = 'true';
        }

        if ($this->defaultValue !== null) {
            $attributes['data-reactic--base-ui--accordion-default-value-value'] = $this->defaultValue;
        }

        return $attributes;
    }
}
