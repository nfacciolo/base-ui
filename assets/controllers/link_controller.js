import { Controller } from '@hotwired/stimulus';

/**
 * Link Controller - Disabled State Handler
 *
 * Prevents navigation on disabled links while maintaining accessibility.
 * Handles both click and keyboard (Enter/Space) events.
 *
 * @example
 * <a data-controller="reactic--base-ui--link"
 *    data-reactic--base-ui--link-disabled-value="true"
 *    data-action="click->reactic--base-ui--link#handleClick keydown->reactic--base-ui--link#handleKeydown"
 *    href="/path">
 *   Link text
 * </a>
 */
export default class extends Controller {
    static values = {
        disabled: Boolean
    };

    /**
     * Handle click events on the link
     * Prevents navigation when link is disabled
     *
     * @param {Event} event - Click event
     */
    handleClick(event) {
        if (this.disabledValue) {
            event.preventDefault();
            event.stopPropagation();
        }
    }

    /**
     * Handle keyboard events on the link
     * Prevents navigation for Enter and Space keys when disabled
     *
     * @param {KeyboardEvent} event - Keyboard event
     */
    handleKeydown(event) {
        if (this.disabledValue && (event.key === 'Enter' || event.key === ' ')) {
            event.preventDefault();
            event.stopPropagation();
        }
    }
}
