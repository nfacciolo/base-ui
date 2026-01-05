import { Controller } from '@hotwired/stimulus';

/**
 * AlertDialog Controller - Modal Dialog Handler
 *
 * Manages AlertDialog state, focus management, keyboard interactions,
 * and accessibility features following WAI-ARIA AlertDialog pattern.
 *
 * @example
 * <div data-controller="reactic--base-ui--alert-dialog">
 *   <button data-action="click->reactic--base-ui--alert-dialog#open">Open</button>
 *   <div data-reactic--base-ui--alert-dialog-target="backdrop"></div>
 *   <div data-reactic--base-ui--alert-dialog-target="popup">...</div>
 * </div>
 */
export default class extends Controller {
    static targets = ['trigger', 'backdrop', 'popup', 'title', 'description'];

    static values = {
        open: Boolean,
        defaultOpen: Boolean,
        triggerId: String,
        initialFocus: String,
        finalFocus: String,
    };

    connect() {
        // Track which trigger opened the dialog
        this.activeTrigger = null;

        // Store focusable elements for focus trap
        this.focusableElements = [];

        // Initialize with default open state
        if (this.defaultOpenValue) {
            this.openDialog(null);
        }

        // Apply controlled open state if provided
        if (this.hasOpenValue && this.openValue) {
            this.openDialog(null);
        }

        // Link title and description to popup for ARIA
        this.setupAriaReferences();
    }

    /**
     * Open the dialog
     * Called when trigger is clicked
     *
     * @param {Event} event - Click event from trigger
     */
    open(event) {
        const trigger = event?.currentTarget;
        this.openDialog(trigger);
    }

    /**
     * Close the dialog
     * Called when close button is clicked or Escape is pressed
     *
     * @param {Event} event - Click or keyboard event
     */
    close(event) {
        event?.preventDefault();
        this.closeDialog();
    }

    /**
     * Close dialog when backdrop is clicked (if dismissible)
     *
     * @param {Event} event - Click event
     */
    closeOnBackdrop(event) {
        // Only close if clicking directly on backdrop, not on popup
        if (event.target === event.currentTarget) {
            this.closeDialog();
        }
    }

    /**
     * Confirm and submit form
     * Called when confirm button with formAction is clicked
     *
     * @param {Event} event - Click event
     */
    confirmAndSubmit(event) {
        // Let the browser handle form submission
        // Dialog will close after submission completes
        this.closeDialog();
    }

    /**
     * Handle keyboard interactions
     * Implements focus trap and Escape key handling
     *
     * @param {KeyboardEvent} event - Keyboard event
     */
    handleKeydown(event) {
        switch (event.key) {
            case 'Escape':
                event.preventDefault();
                this.closeDialog();
                break;

            case 'Tab':
                this.handleTabKey(event);
                break;
        }
    }

    /**
     * Handle Tab key for focus trap
     * Keeps focus within the dialog
     *
     * @param {KeyboardEvent} event - Keyboard event
     */
    handleTabKey(event) {
        if (!this.hasPopupTarget) return;

        const focusableElements = this.getFocusableElements();

        if (focusableElements.length === 0) return;

        const firstElement = focusableElements[0];
        const lastElement = focusableElements[focusableElements.length - 1];

        if (event.shiftKey) {
            // Shift + Tab: moving backwards
            if (document.activeElement === firstElement) {
                event.preventDefault();
                lastElement.focus();
            }
        } else {
            // Tab: moving forwards
            if (document.activeElement === lastElement) {
                event.preventDefault();
                firstElement.focus();
            }
        }
    }

    /**
     * Open the dialog and handle focus management
     *
     * @param {HTMLElement|null} trigger - The trigger element that opened the dialog
     */
    openDialog(trigger) {
        // Store active trigger for return focus
        this.activeTrigger = trigger;

        // Show backdrop and popup
        if (this.hasBackdropTarget) {
            this.backdropTarget.style.display = 'block';
        }

        if (this.hasPopupTarget) {
            this.popupTarget.style.display = 'block';
        }

        // Update data attributes
        this.element.dataset.open = 'true';

        // Prevent body scroll
        // this.preventBodyScroll();

        // Set focus to initial element
        requestAnimationFrame(() => {
            this.setInitialFocus();
        });

        // Dispatch custom event
        this.dispatch('open', { detail: { triggerId: trigger?.id } });
    }

    /**
     * Close the dialog and restore focus
     */
    closeDialog() {
        // Hide backdrop and popup
        if (this.hasBackdropTarget) {
            this.backdropTarget.style.display = 'none';
        }

        if (this.hasPopupTarget) {
            this.popupTarget.style.display = 'none';
        }

        // Update data attributes
        this.element.dataset.open = 'false';

        // Restore body scroll
        // this.restoreBodyScroll();
        //
        // // Return focus to final element or trigger
        // this.restoreFocus();

        // Dispatch custom event
        this.dispatch('close');
    }

    /**
     * Set initial focus when dialog opens
     * Priority: initialFocus selector > first cancel button > first focusable element
     */
    setInitialFocus() {
        if (!this.hasPopupTarget) return;

        let elementToFocus = null;

        // Try initialFocus selector if provided
        if (this.hasInitialFocusValue) {
            elementToFocus = this.popupTarget.querySelector(this.initialFocusValue);
        }

        // Fallback to first cancel button (safest action)
        if (!elementToFocus) {
            elementToFocus = this.popupTarget.querySelector('[data-variant="cancel"]');
        }

        // Fallback to first focusable element
        if (!elementToFocus) {
            const focusableElements = this.getFocusableElements();
            elementToFocus = focusableElements[0];
        }

        if (elementToFocus) {
            elementToFocus.focus();
        }
    }

    /**
     * Restore focus when dialog closes
     * Priority: finalFocus selector > active trigger > body
     */
    restoreFocus() {
        let elementToFocus = null;

        // Try finalFocus selector if provided
        if (this.hasFinalFocusValue) {
            elementToFocus = document.querySelector(this.finalFocusValue);
        }

        // Fallback to active trigger
        if (!elementToFocus && this.activeTrigger) {
            elementToFocus = this.activeTrigger;
        }

        if (elementToFocus) {
            elementToFocus.focus();
        }

        // Clear active trigger
        this.activeTrigger = null;
    }

    /**
     * Get all focusable elements within the popup
     *
     * @returns {Array<HTMLElement>} Array of focusable elements
     */
    getFocusableElements() {
        if (!this.hasPopupTarget) return [];

        const selector = [
            'a[href]',
            'button:not([disabled])',
            'textarea:not([disabled])',
            'input:not([disabled])',
            'select:not([disabled])',
            '[tabindex]:not([tabindex="-1"])',
        ].join(', ');

        return Array.from(this.popupTarget.querySelectorAll(selector));
    }

    /**
     * Setup ARIA references between title, description, and popup
     */
    setupAriaReferences() {
        if (!this.hasPopupTarget) return;

        const titleId = this.hasTitleTarget ? this.titleTarget.id : null;
        const descriptionId = this.hasDescriptionTarget ? this.descriptionTarget.id : null;

        if (titleId) {
            this.popupTarget.setAttribute('aria-labelledby', titleId);
        }

        if (descriptionId) {
            this.popupTarget.setAttribute('aria-describedby', descriptionId);
        }
    }

    /**
     * Prevent body scroll when dialog is open
     */
    preventBodyScroll() {
        // Store current scroll position
        this.scrollPosition = window.pageYOffset;

        // Add padding to prevent layout shift when scrollbar disappears
        const scrollbarWidth = window.innerWidth - document.documentElement.clientWidth;

        // Lock scroll
        document.body.style.overflow = 'hidden';
        document.body.style.position = 'fixed';
        document.body.style.top = `-${this.scrollPosition}px`;
        document.body.style.width = '100%';
        document.body.style.paddingRight = scrollbarWidth + 'px';
    }

    /**
     * Restore body scroll when dialog is closed
     */
    restoreBodyScroll() {
        // Store the scroll position
        const scrollY = this.scrollPosition;

        // Remove all scroll lock styles
        document.body.style.removeProperty('overflow');
        document.body.style.removeProperty('position');
        document.body.style.removeProperty('top');
        document.body.style.removeProperty('width');
        document.body.style.removeProperty('padding-right');

        // Restore scroll position immediately (synchronous, no animation frame)
        window.scrollTo(0, scrollY, { behavior: 'instant' });
    }

    /**
     * Cleanup when controller is disconnected
     */
    disconnect() {
        // Ensure body scroll is restored if dialog was open
        if (this.element.dataset.open === 'true') {
            this.restoreBodyScroll();
        }
    }
}
