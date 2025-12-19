<?php

declare(strict_types=1);

namespace Reactic\SymfonyBaseUi\Component\Accordion;

use Symfony\UX\TwigComponent\Attribute\AsTwigComponent;

#[AsTwigComponent(name: 'BaseUI:AccordionHeader', template: '@SymfonyBaseUi/components/BaseUI/Accordion/AccordionHeader.html.twig')]
class AccordionHeader
{
    public string $level = '3';

    /**
     * Get ARIA attributes for accessibility
     */
    public function getAriaAttributes(): array
    {
        return [
            'role' => 'heading',
            'aria-level' => $this->level,
        ];
    }

    /**
     * Get data attributes for styling hooks
     */
    public function getDataAttributes(): array
    {
        return [
            'data-slot' => 'accordion-header',
        ];
    }
}
