<?php

declare(strict_types=1);

namespace Reactic\BaseUi\Component\Accordion;

use Symfony\UX\TwigComponent\Attribute\AsTwigComponent;

#[AsTwigComponent(name: 'BaseUI:AccordionPanel', template: '@BaseUi/components/BaseUI/Accordion/AccordionPanel.html.twig')]
class AccordionPanel
{
    /**
     * Get ARIA attributes for accessibility
     */
    public function getAriaAttributes(): array
    {
        return [
            'role' => 'region',
        ];
    }

    /**
     * Get data attributes for styling hooks
     */
    public function getDataAttributes(): array
    {
        return [
            'data-slot' => 'accordion-panel',
            'data-state' => 'closed',
            'data-reactic--base-ui--accordion-target' => 'panel',
        ];
    }
}
