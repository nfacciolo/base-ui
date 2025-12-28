<?php

declare(strict_types=1);

namespace Reactic\BaseUi\Component\Link;

use Symfony\UX\TwigComponent\Attribute\AsTwigComponent;

#[AsTwigComponent(name: 'BaseUI:Link', template: '@BaseUi/components/BaseUI/Link/Link.html.twig')]
class Link
{
    public string $href = '';
    public bool $external = false;
    public bool $disabled = false;
    public bool $active = false;
    public string $underline = 'always';
    public bool $preserveScroll = false;
    public ?string $target = null;
    public string|bool $download = false;
    public ?string $rel = null;
    public ?string $title = null;

    /**
     * Get ARIA attributes for accessibility
     */
    public function getAriaAttributes(): array
    {
        $attributes = [];

        // Mark as disabled for accessibility
        if ($this->disabled) {
            $attributes['aria-disabled'] = 'true';
        }

        // Mark as current page
        if ($this->active) {
            $attributes['aria-current'] = 'page';
        }

        return $attributes;
    }

    /**
     * Get data attributes for styling hooks
     */
    public function getDataAttributes(): array
    {
        return [
            'data-component' => 'link',
            'data-disabled' => $this->disabled ? 'true' : 'false',
            'data-external' => $this->external ? 'true' : 'false',
            'data-active' => $this->active ? 'true' : 'false',
            'data-underline' => $this->underline,
        ];
    }

    /**
     * Get link-specific HTML attributes
     */
    public function getLinkAttributes(): array
    {
        $attributes = [];

        // Add href if not disabled
        if (!$this->disabled && $this->href !== '') {
            $attributes['href'] = $this->href;
        } elseif ($this->disabled) {
            // Disabled links should still have href for accessibility, but will be prevented via JS
            $attributes['href'] = $this->href;
        }

        // Handle external links
        if ($this->external) {
            $attributes['target'] = '_blank';
            $attributes['rel'] = 'noopener noreferrer';
        }

        // Override target if explicitly set (but warn about security in docs)
        if ($this->target !== null) {
            $attributes['target'] = $this->target;
        }

        // Add rel if explicitly set (merges with external rel)
        if ($this->rel !== null) {
            if (isset($attributes['rel'])) {
                $attributes['rel'] .= ' ' . $this->rel;
            } else {
                $attributes['rel'] = $this->rel;
            }
        }

        // Add download attribute
        if ($this->download !== false) {
            $attributes['download'] = is_string($this->download) ? $this->download : '';
        }

        // Add title for tooltip
        if ($this->title !== null) {
            $attributes['title'] = $this->title;
        }

        return $attributes;
    }

    /**
     * Check if link should be prevented from navigation (disabled state)
     */
    public function shouldPreventNavigation(): bool
    {
        return $this->disabled;
    }

    /**
     * Get the href value (for template access)
     */
    public function getHref(): string
    {
        return $this->href;
    }
}
