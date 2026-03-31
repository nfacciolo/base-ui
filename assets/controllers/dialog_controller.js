import { Controller } from '@hotwired/stimulus';

/**
 * Dialog Controller - Native HTML Dialog Management
 *
 * Manages the native <dialog> element with built-in accessibility,
 * focus management, and backdrop support.
 *
 * Features:
 * - Modal and non-modal dialog support
 * - Automatic focus management
 * - ESC key to close (configurable)
 * - Backdrop click to close (configurable)
 * - Custom events for integration
 *
 * @example
 * <div data-controller="reactic--base-ui--dialog">
 *   <button data-action="click->reactic--base-ui--dialog#open">Open</button>
 *   <dialog data-reactic--base-ui--dialog-target="content">
 *     <h2 data-reactic--base-ui--dialog-target="title">Title</h2>
 *     <div data-reactic--base-ui--dialog-target="description">Content</div>
 *     <button data-action="click->reactic--base-ui--dialog#close">Close</button>
 *   </dialog>
 * </div>
 */
export default class extends Controller {
    static targets = ['content', 'title', 'description'];

    static values = {
        modal: { type: Boolean, default: true },
        open: { type: Boolean, default: false },
        closeOnBackdropClick: { type: Boolean, default: true },
        closeOnEscape: { type: Boolean, default: true },
    };

    /**
     * Initialize the dialog controller
     */
    connect() {
        // Set up ARIA attributes
        this.setupAccessibility();

        // Open dialog if open value is true
        if (this.openValue) {
            this.open();
        }

        // Listen for native dialog close event
        if (this.hasContentTarget) {
            this.contentTarget.addEventListener('close', this.handleNativeClose.bind(this));
            this.contentTarget.addEventListener('click', this.handleBackdropClick.bind(this));
        }
    }

    /**
     * Cleanup when controller disconnects
     */
    disconnect() {
        if (this.hasContentTarget) {
            this.contentTarget.removeEventListener('close', this.handleNativeClose.bind(this));
            this.contentTarget.removeEventListener('click', this.handleBackdropClick.bind(this));
        }
    }

    /**
     * Set up ARIA attributes for accessibility
     */
    setupAccessibility() {
        if (!this.hasContentTarget) return;

        const dialog = this.contentTarget;

        // Link title to dialog with aria-labelledby
        if (this.hasTitleTarget) {
            const titleId = this.titleTarget.id || `dialog-title-${Date.now()}`;
            this.titleTarget.id = titleId;
            dialog.setAttribute('aria-labelledby', titleId);
        }

        // Link description to dialog with aria-describedby
        if (this.hasDescriptionTarget) {
            const descId = this.descriptionTarget.id || `dialog-desc-${Date.now()}`;
            this.descriptionTarget.id = descId;
            dialog.setAttribute('aria-describedby', descId);
        }

        // Set aria-modal
        if (this.modalValue) {
            dialog.setAttribute('aria-modal', 'true');
        }
    }

    /**
     * Open the dialog
     * @param {Event} event - Optional event that triggered the open
     */
    open(event) {
        if (event) {
            event.preventDefault();
        }

        if (!this.hasContentTarget) {
            console.warn('Dialog: No content target found');
            return;
        }

        const dialog = this.contentTarget;

        // Dispatch before-open event (cancellable)
        const beforeOpenEvent = this.dispatch('before-open', {
            cancelable: true,
            detail: { dialog },
        });

        if (beforeOpenEvent.defaultPrevented) {
            return;
        }

        // Open as modal or non-modal
        if (this.modalValue) {
            dialog.showModal();
        } else {
            dialog.show();
        }

        // Update open value
        this.openValue = true;

        // Update data attributes
        this.element.setAttribute('data-open', 'true');
        dialog.setAttribute('data-open', 'true');

        // Dispatch open event
        this.dispatch('open', {
            detail: { dialog },
        });
    }

    /**
     * Close the dialog
     * @param {Event} event - Optional event that triggered the close
     */
    close(event) {
        if (event) {
            event.preventDefault();
        }

        if (!this.hasContentTarget) {
            console.warn('Dialog: No content target found');
            return;
        }

        const dialog = this.contentTarget;

        // Dispatch before-close event (cancellable)
        const beforeCloseEvent = this.dispatch('before-close', {
            cancelable: true,
            detail: { dialog, returnValue: dialog.returnValue },
        });

        if (beforeCloseEvent.defaultPrevented) {
            return;
        }

        // Close the dialog
        dialog.close();

        // Update open value
        this.openValue = false;

        // Update data attributes
        this.element.setAttribute('data-open', 'false');
        dialog.setAttribute('data-open', 'false');

        // Dispatch close event
        this.dispatch('close', {
            detail: { dialog, returnValue: dialog.returnValue },
        });
    }

    /**
     * Handle native dialog close event
     * This is triggered when ESC is pressed or form with method="dialog" is submitted
     */
    handleNativeClose(event) {
        // Check if ESC key should close the dialog
        if (!this.closeOnEscapeValue && event.type === 'cancel') {
            event.preventDefault();
            return;
        }

        // Update state
        this.openValue = false;
        this.element.setAttribute('data-open', 'false');
        this.contentTarget.setAttribute('data-open', 'false');

        // Dispatch close event
        this.dispatch('close', {
            detail: {
                dialog: this.contentTarget,
                returnValue: this.contentTarget.returnValue
            },
        });
    }

    /**
     * Handle backdrop click
     * Close dialog if clicked outside the dialog content
     */
    handleBackdropClick(event) {
        if (!this.closeOnBackdropClickValue) {
            return;
        }

        const dialog = this.contentTarget;
        const rect = dialog.getBoundingClientRect();

        // Check if click is outside dialog content
        const isOutside = (
            event.clientX < rect.left ||
            event.clientX > rect.right ||
            event.clientY < rect.top ||
            event.clientY > rect.bottom
        );

        if (isOutside) {
            this.close();
        }
    }

    /**
     * Handle open value change
     */
    openValueChanged() {
        if (this.openValue) {
            this.open();
        } else {
            this.close();
        }
    }
}
