<?php

declare(strict_types=1);

namespace Reactic\BaseUi\Component\Accordion;

use Symfony\UX\TwigComponent\Attribute\AsTwigComponent;

#[AsTwigComponent(name: 'BaseUI:AccordionItem', template: '@BaseUi/components/BaseUI/Accordion/AccordionItem.html.twig')]
class AccordionItem
{
    public string $value;
    public bool $disabled = false;

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
            'data-slot' => 'accordion-item',
            'data-state' => 'closed',
            'data-disabled' => $this->disabled ? 'true' : 'false',
            'data-reactic--base-ui--accordion-target' => 'item',
            'data-value' => $this->value,
        ];
    }
}
