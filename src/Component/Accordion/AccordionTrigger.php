<?php

declare(strict_types=1);

namespace Reactic\BaseUi\Component\Accordion;

use Symfony\UX\TwigComponent\Attribute\AsTwigComponent;

#[AsTwigComponent(name: 'BaseUI:AccordionTrigger', template: '@BaseUi/components/BaseUI/Accordion/AccordionTrigger.html.twig')]
class AccordionTrigger
{
    /**
     * Get ARIA attributes for accessibility
     */
    public function getAriaAttributes(): array
    {
        return [
            'aria-expanded' => 'false',
        ];
    }

    /**
     * Get data attributes for styling hooks
     */
    public function getDataAttributes(): array
    {
        return [
            'data-slot' => 'accordion-trigger',
            'data-state' => 'closed',
            'data-reactic--base-ui--accordion-target' => 'trigger',
            'data-action' => 'click->reactic--base-ui--accordion#toggle keydown->reactic--base-ui--accordion#handleKeydown',
        ];
    }
}
