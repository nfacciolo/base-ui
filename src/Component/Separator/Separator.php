<?php

declare(strict_types=1);

namespace Reactic\BaseUi\Component\Separator;

use Symfony\UX\TwigComponent\Attribute\AsTwigComponent;

#[AsTwigComponent(name: 'BaseUI:Separator', template: '@BaseUi/components/BaseUI/Separator/Separator.html.twig')]
class Separator
{
    public string $orientation = 'horizontal';
    public bool $decorative = false;

    /**
     * Get ARIA attributes for accessibility
     */
    public function getAriaAttributes(): array
    {
        // When decorative, hide from screen readers
        if ($this->decorative) {
            return [
                'role' => 'none',
            ];
        }

        // When not decorative, use proper separator role
        return [
            'role' => 'separator',
            'aria-orientation' => $this->orientation,
        ];
    }

    /**
     * Get data attributes for styling hooks
     */
    public function getDataAttributes(): array
    {
        return [
            'data-component' => 'separator',
            'data-orientation' => $this->orientation,
        ];
    }
}
