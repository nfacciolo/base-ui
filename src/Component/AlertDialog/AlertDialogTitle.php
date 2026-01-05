<?php

declare(strict_types=1);

namespace Reactic\BaseUi\Component\AlertDialog;

use Symfony\UX\TwigComponent\Attribute\AsTwigComponent;

#[AsTwigComponent(name: 'BaseUI:AlertDialog:Title', template: '@BaseUi/components/BaseUI/AlertDialog/AlertDialogTitle.html.twig')]
class AlertDialogTitle
{
    public int $level = 2;

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
            'data-component' => 'alert-dialog-title',
            'data-reactic--base-ui--alert-dialog-target' => 'title',
        ];
    }

    /**
     * Get the heading tag based on level
     */
    public function getHeadingTag(): string
    {
        $level = max(1, min(6, $this->level));

        return 'h' . $level;
    }

    /**
     * Generate unique ID for ARIA reference
     */
    public function getId(): string
    {
        return 'alert-dialog-title-' . uniqid();
    }
}
