<?php

declare(strict_types=1);

namespace Reactic\SymfonyBaseUi\Component\Accordion;

use Symfony\UX\TwigComponent\Attribute\AsTwigComponent;

#[AsTwigComponent(name: 'BaseUI:AccordionTrigger', template: '@SymfonyBaseUi/components/BaseUI/Accordion/AccordionTrigger.html.twig')]
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
            'data-reactic--symfony-base-ui--accordion-target' => 'trigger',
            'data-action' => 'click->reactic--symfony-base-ui--accordion#toggle keydown->reactic--symfony-base-ui--accordion#handleKeydown',
        ];
    }
}
