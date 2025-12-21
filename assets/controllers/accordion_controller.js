import { Controller } from '@hotwired/stimulus';

export default class extends Controller {
    static targets = ['item', 'trigger', 'panel'];
    static values = {
        multiple: Boolean,
        defaultValue: String
    };

    connect() {
        this.openItems = new Set();

        // Initialize with default open items
        if (this.defaultValueValue) {
            const defaultValues = this.defaultValueValue.split(',').map(v => v.trim());
            defaultValues.forEach(value => this.openItems.add(value));
        }

        // Apply initial state
        this.updateUI();
    }

    toggle(event) {
        const trigger = event.currentTarget;
        const item = trigger.closest('[data-reactic--base-ui--accordion-target="item"]');
        const value = item.dataset.value;
        const isDisabled = item.dataset.disabled === 'true';

        if (isDisabled) {
            return;
        }

        if (this.openItems.has(value)) {
            this.openItems.delete(value);
        } else {
            if (!this.multipleValue) {
                // Close all other items in single mode
                this.openItems.clear();
            }
            this.openItems.add(value);
        }

        this.updateUI();
    }

    handleKeydown(event) {
        const triggers = this.triggerTargets;
        const currentIndex = triggers.indexOf(event.currentTarget);

        switch (event.key) {
            case 'ArrowDown':
                event.preventDefault();
                this.focusTrigger(currentIndex + 1);
                break;
            case 'ArrowUp':
                event.preventDefault();
                this.focusTrigger(currentIndex - 1);
                break;
            case 'Home':
                event.preventDefault();
                this.focusTrigger(0);
                break;
            case 'End':
                event.preventDefault();
                this.focusTrigger(triggers.length - 1);
                break;
            case 'Enter':
            case ' ':
                event.preventDefault();
                this.toggle(event);
                break;
        }
    }

    focusTrigger(index) {
        const triggers = this.triggerTargets;
        if (index < 0) index = triggers.length - 1;
        if (index >= triggers.length) index = 0;
        triggers[index].focus();
    }

    updateUI() {
        this.itemTargets.forEach(item => {
            const value = item.dataset.value;
            const isOpen = this.openItems.has(value);
            const trigger = item.querySelector('[data-reactic--base-ui--accordion-target="trigger"]');
            const panel = item.querySelector('[data-reactic--base-ui--accordion-target="panel"]');

            // Update item state
            item.dataset.state = isOpen ? 'open' : 'closed';

            // Update trigger state and aria
            if (trigger) {
                trigger.dataset.state = isOpen ? 'open' : 'closed';
                trigger.setAttribute('aria-expanded', isOpen ? 'true' : 'false');

                // Link trigger to panel via aria-controls
                if (!trigger.hasAttribute('aria-controls') && panel) {
                    const panelId = panel.id || this.generateId('panel');
                    panel.id = panelId;
                    trigger.setAttribute('aria-controls', panelId);
                }
            }

            // Update panel state and aria with animation
            if (panel) {
                panel.dataset.state = isOpen ? 'open' : 'closed';

                // Link panel to trigger via aria-labelledby
                if (!panel.hasAttribute('aria-labelledby') && trigger) {
                    const triggerId = trigger.id || this.generateId('trigger');
                    trigger.id = triggerId;
                    panel.setAttribute('aria-labelledby', triggerId);
                }

                // Animate panel with CSS variable
                if (isOpen) {
                    // Opening: add starting-style, measure height, then animate
                    panel.setAttribute('data-starting-style', '');
                    const height = panel.scrollHeight;
                    panel.style.setProperty('--accordion-panel-height', `${height}px`);

                    requestAnimationFrame(() => {
                        panel.removeAttribute('data-starting-style');
                    });
                } else {
                    // Closing: set current height, add ending-style
                    const height = panel.scrollHeight;
                    panel.style.setProperty('--accordion-panel-height', `${height}px`);

                    requestAnimationFrame(() => {
                        panel.setAttribute('data-ending-style', '');

                        // Remove ending-style after animation completes
                        setTimeout(() => {
                            panel.removeAttribute('data-ending-style');
                        }, 150);
                    });
                }
            }
        });
    }

    generateId(prefix) {
        return `${prefix}-${Math.random().toString(36).substr(2, 9)}`;
    }
}
