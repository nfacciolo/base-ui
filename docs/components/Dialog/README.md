# Dialog

A modal dialog component built on the native HTML `<dialog>` element with built-in accessibility, focus management, and backdrop support.

## Setup

### Stimulus Controller Registration

The Dialog component requires a Stimulus controller for opening, closing, and managing the dialog lifecycle. Add it to your `assets/controllers.json`:

```json
{
  "controllers": {
    "@reactic/base-ui": {
      "dialog": {
        "enabled": true,
        "fetch": "eager",
        "webpackMode": "eager"
      }
    }
  }
}
```

After adding the configuration, rebuild your assets:

```bash
npm run build
# or
npm run dev
```

## Anatomy

```twig
<twig:BaseUI:Dialog>
    <twig:BaseUI:Dialog:Trigger>
        Open Dialog
    </twig:BaseUI:Dialog:Trigger>

    <twig:BaseUI:Dialog:Content>
        <twig:BaseUI:Dialog:Header>
            <twig:BaseUI:Dialog:Title>Dialog Title</twig:BaseUI:Dialog:Title>
            <twig:BaseUI:Dialog:Close />
        </twig:BaseUI:Dialog:Header>

        <twig:BaseUI:Dialog:Description>
            Dialog content goes here
        </twig:BaseUI:Dialog:Description>

        <twig:BaseUI:Dialog:Footer>
            <button>Cancel</button>
            <button>Confirm</button>
        </twig:BaseUI:Dialog:Footer>
    </twig:BaseUI:Dialog:Content>
</twig:BaseUI:Dialog>
```

## Examples

### Basic Usage

```twig
<twig:BaseUI:Dialog>
    <twig:BaseUI:Dialog:Trigger>
        Open Dialog
    </twig:BaseUI:Dialog:Trigger>

    <twig:BaseUI:Dialog:Content>
        <twig:BaseUI:Dialog:Header>
            <twig:BaseUI:Dialog:Title>Welcome</twig:BaseUI:Dialog:Title>
            <twig:BaseUI:Dialog:Close />
        </twig:BaseUI:Dialog:Header>

        <twig:BaseUI:Dialog:Description>
            This is a basic dialog example.
        </twig:BaseUI:Dialog:Description>
    </twig:BaseUI:Dialog:Content>
</twig:BaseUI:Dialog>
```

The dialog renders with minimal styles by default. Use data attributes or custom classes for styling:

```css
/* Style via data attributes */
[data-component="dialog"] {
    border: none;
    border-radius: 8px;
    padding: 0;
    max-width: 500px;
}

[data-component="dialog"]::backdrop {
    background: rgba(0, 0, 0, 0.5);
}
```

### With Header and Footer

```twig
<twig:BaseUI:Dialog>
    <twig:BaseUI:Dialog:Trigger class="btn btn-primary">
        Delete Account
    </twig:BaseUI:Dialog:Trigger>

    <twig:BaseUI:Dialog:Content>
        <twig:BaseUI:Dialog:Header>
            <twig:BaseUI:Dialog:Title>Confirm Deletion</twig:BaseUI:Dialog:Title>
            <twig:BaseUI:Dialog:Close />
        </twig:BaseUI:Dialog:Header>

        <twig:BaseUI:Dialog:Description>
            Are you sure you want to delete your account? This action cannot be undone.
        </twig:BaseUI:Dialog:Description>

        <twig:BaseUI:Dialog:Footer>
            <twig:BaseUI:Dialog:Close class="btn btn-secondary">
                Cancel
            </twig:BaseUI:Dialog:Close>
            <button type="button" class="btn btn-danger">
                Delete Account
            </button>
        </twig:BaseUI:Dialog:Footer>
    </twig:BaseUI:Dialog:Content>
</twig:BaseUI:Dialog>
```

**Best practice:** Always include a close button in the header and a cancel option in the footer for better UX.

### Modal vs Non-Modal

By default, dialogs are modal (blocking interaction with the rest of the page). You can create non-modal dialogs:

```twig
{# Modal dialog (default) - blocks interaction with page #}
<twig:BaseUI:Dialog modal="true">
    <twig:BaseUI:Dialog:Trigger>Open Modal</twig:BaseUI:Dialog:Trigger>
    <twig:BaseUI:Dialog:Content>
        <twig:BaseUI:Dialog:Title>Modal Dialog</twig:BaseUI:Dialog:Title>
        <twig:BaseUI:Dialog:Description>
            You must interact with this dialog before continuing.
        </twig:BaseUI:Dialog:Description>
    </twig:BaseUI:Dialog:Content>
</twig:BaseUI:Dialog>

{# Non-modal dialog - allows interaction with page #}
<twig:BaseUI:Dialog modal="false">
    <twig:BaseUI:Dialog:Trigger>Open Non-Modal</twig:BaseUI:Dialog:Trigger>
    <twig:BaseUI:Dialog:Content>
        <twig:BaseUI:Dialog:Title>Non-Modal Dialog</twig:BaseUI:Dialog:Title>
        <twig:BaseUI:Dialog:Description>
            You can still interact with the page while this is open.
        </twig:BaseUI:Dialog:Description>
    </twig:BaseUI:Dialog:Content>
</twig:BaseUI:Dialog>
```

**When to use:**
- **Modal** (default): Confirmations, critical alerts, forms requiring immediate attention
- **Non-modal**: Tooltips, help panels, chat windows, non-blocking notifications

### Controlled Dialog (Programmatic Control)

Control the dialog state externally using a Stimulus controller:

```twig
<div data-controller="my-form">
    <twig:BaseUI:Dialog id="success-dialog">
        <twig:BaseUI:Dialog:Content>
            <twig:BaseUI:Dialog:Header>
                <twig:BaseUI:Dialog:Title>Success!</twig:BaseUI:Dialog:Title>
                <twig:BaseUI:Dialog:Close />
            </twig:BaseUI:Dialog:Header>

            <twig:BaseUI:Dialog:Description>
                Your changes have been saved successfully.
            </twig:BaseUI:Dialog:Description>
        </twig:BaseUI:Dialog:Content>
    </twig:BaseUI:Dialog>

    <button data-action="click->my-form#submit">
        Save Changes
    </button>
</div>
```

```javascript
// my-form_controller.js
import { Controller } from '@hotwired/stimulus';

export default class extends Controller {
    async submit() {
        // Save data...

        // Open dialog programmatically
        const dialog = document.getElementById('success-dialog');
        dialog.showModal();
    }
}
```

### Dialog Without Trigger

Sometimes you need a dialog without a visible trigger (e.g., shown on page load or after an action):

```twig
<twig:BaseUI:Dialog id="welcome-dialog" open="true">
    <twig:BaseUI:Dialog:Content>
        <twig:BaseUI:Dialog:Header>
            <twig:BaseUI:Dialog:Title>Welcome!</twig:BaseUI:Dialog:Title>
            <twig:BaseUI:Dialog:Close />
        </twig:BaseUI:Dialog:Header>

        <twig:BaseUI:Dialog:Description>
            Thank you for joining us. Here's what you need to know.
        </twig:BaseUI:Dialog:Description>
    </twig:BaseUI:Dialog:Content>
</twig:BaseUI:Dialog>
```

**Use case:** First-time user onboarding, important announcements, session timeout warnings.

### Form in Dialog

```twig
<twig:BaseUI:Dialog>
    <twig:BaseUI:Dialog:Trigger>Add User</twig:BaseUI:Dialog:Trigger>

    <twig:BaseUI:Dialog:Content>
        <form method="dialog">
            <twig:BaseUI:Dialog:Header>
                <twig:BaseUI:Dialog:Title>Create New User</twig:BaseUI:Dialog:Title>
                <twig:BaseUI:Dialog:Close />
            </twig:BaseUI:Dialog:Header>

            <twig:BaseUI:Dialog:Description>
                <div class="form-group">
                    <label for="username">Username</label>
                    <input type="text" id="username" name="username" required>
                </div>

                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" id="email" name="email" required>
                </div>
            </twig:BaseUI:Dialog:Description>

            <twig:BaseUI:Dialog:Footer>
                <button type="button" value="cancel" formmethod="dialog">
                    Cancel
                </button>
                <button type="submit" value="confirm">
                    Create User
                </button>
            </twig:BaseUI:Dialog:Footer>
        </form>
    </twig:BaseUI:Dialog:Content>
</twig:BaseUI:Dialog>
```

**Technical note:** Using `method="dialog"` on forms automatically closes the dialog when submitting. The submit button's `value` is available via `dialog.returnValue`.

### Nested Dialogs

Multiple dialogs can be stacked (use sparingly):

```twig
<twig:BaseUI:Dialog>
    <twig:BaseUI:Dialog:Trigger>Open First Dialog</twig:BaseUI:Dialog:Trigger>

    <twig:BaseUI:Dialog:Content>
        <twig:BaseUI:Dialog:Title>First Dialog</twig:BaseUI:Dialog:Title>

        <twig:BaseUI:Dialog>
            <twig:BaseUI:Dialog:Trigger>Open Second Dialog</twig:BaseUI:Dialog:Trigger>

            <twig:BaseUI:Dialog:Content>
                <twig:BaseUI:Dialog:Title>Second Dialog</twig:BaseUI:Dialog:Title>
                <twig:BaseUI:Dialog:Description>
                    This is a nested dialog.
                </twig:BaseUI:Dialog:Description>
            </twig:BaseUI:Dialog:Content>
        </twig:BaseUI:Dialog>
    </twig:BaseUI:Dialog:Content>
</twig:BaseUI:Dialog>
```

**Warning:** Nested dialogs can confuse users. Only use when absolutely necessary and ensure clear navigation between levels.

### Alert Dialog

For simple confirmations without complex content:

```twig
<twig:BaseUI:Dialog role="alertdialog">
    <twig:BaseUI:Dialog:Trigger class="btn btn-danger">
        Delete Item
    </twig:BaseUI:Dialog:Trigger>

    <twig:BaseUI:Dialog:Content>
        <twig:BaseUI:Dialog:Header>
            <twig:BaseUI:Dialog:Title>Confirm Deletion</twig:BaseUI:Dialog:Title>
        </twig:BaseUI:Dialog:Header>

        <twig:BaseUI:Dialog:Description>
            This action cannot be undone.
        </twig:BaseUI:Dialog:Description>

        <twig:BaseUI:Dialog:Footer>
            <twig:BaseUI:Dialog:Close>Cancel</twig:BaseUI:Dialog:Close>
            <button type="button" class="btn-danger">Delete</button>
        </twig:BaseUI:Dialog:Footer>
    </twig:BaseUI:Dialog:Content>
</twig:BaseUI:Dialog>
```

**Accessibility note:** `role="alertdialog"` tells screen readers this requires immediate attention.

## API Reference

### Dialog (Root Component)

| Prop | Type | Default | Description |
|------|------|---------|-------------|
| `id` | `string` | auto-generated | Unique identifier for the dialog |
| `modal` | `bool` | `true` | Whether the dialog is modal (blocks interaction with page) |
| `open` | `bool` | `false` | Whether the dialog is open by default |
| `role` | `string` | `'dialog'` | ARIA role (`'dialog'` or `'alertdialog'`) |
| `closeOnBackdropClick` | `bool` | `true` | Whether clicking the backdrop closes the dialog |
| `closeOnEscape` | `bool` | `true` | Whether pressing ESC closes the dialog |

### Dialog:Trigger

| Prop | Type | Default | Description |
|------|------|---------|-------------|
| `disabled` | `bool` | `false` | Whether the trigger button is disabled |

**Note:** Trigger accepts all standard button attributes (`type`, `class`, `data-*`, etc.)

### Dialog:Content

| Prop | Type | Default | Description |
|------|------|---------|-------------|
| `class` | `string` | `null` | Additional CSS classes for the dialog content wrapper |

### Dialog:Header

Container for title and close button. No specific props, accepts standard HTML attributes.

### Dialog:Title

| Prop | Type | Default | Description |
|------|------|---------|-------------|
| `level` | `int` | `2` | Heading level (1-6) for the title element |

**Accessibility:** The title is automatically linked to the dialog via `aria-labelledby`.

### Dialog:Description

Container for the main dialog content. No specific props, accepts standard HTML attributes.

**Accessibility:** Automatically linked to the dialog via `aria-describedby`.

### Dialog:Footer

Container for action buttons. No specific props, accepts standard HTML attributes.

### Dialog:Close

| Prop | Type | Default | Description |
|------|------|---------|-------------|
| `label` | `string` | `'Close'` | Accessible label for the close button |
| `icon` | `bool` | `true` | Whether to show as icon-only button (× symbol) |

**Note:** When used without content, renders an icon-only close button. With content, renders a regular button.

## Data Attributes

The component exposes these data attributes for styling:

| Attribute | Values | Description |
|-----------|--------|-------------|
| `data-component` | `"dialog"` | Identifies the dialog element |
| `data-modal` | `"true"` \| `"false"` | Indicates if the dialog is modal |
| `data-open` | `"true"` \| `"false"` | Indicates if the dialog is currently open |

Sub-components:

| Component | Attribute | Value |
|-----------|-----------|-------|
| Trigger | `data-dialog-trigger` | `""` |
| Content | `data-dialog-content` | `""` |
| Header | `data-dialog-header` | `""` |
| Title | `data-dialog-title` | `""` |
| Description | `data-dialog-description` | `""` |
| Footer | `data-dialog-footer` | `""` |
| Close | `data-dialog-close` | `""` |

## ARIA Attributes

Automatically applied for accessibility:

- `role="dialog"` or `role="alertdialog"` - Identifies the dialog type
- `aria-modal="true"` - Indicates modal dialogs (when `modal=true`)
- `aria-labelledby="[title-id]"` - Links dialog to its title
- `aria-describedby="[description-id]"` - Links dialog to its description
- `aria-hidden="true"` - Applied when dialog is closed

## Styling Examples

### Using Data Attributes

```css
/* Dialog container */
[data-component="dialog"] {
    border: none;
    border-radius: 12px;
    padding: 0;
    max-width: 90vw;
    max-height: 90vh;
    box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1),
                0 10px 10px -5px rgba(0, 0, 0, 0.04);
}

/* Backdrop (background overlay) */
[data-component="dialog"]::backdrop {
    background: rgba(0, 0, 0, 0.6);
    backdrop-filter: blur(4px);
}

/* Dialog header */
[data-dialog-header] {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 24px 24px 16px;
    border-bottom: 1px solid #e5e7eb;
}

/* Dialog title */
[data-dialog-title] {
    margin: 0;
    font-size: 1.25rem;
    font-weight: 600;
    color: #111827;
}

/* Dialog description/content */
[data-dialog-description] {
    padding: 24px;
    color: #4b5563;
    line-height: 1.6;
}

/* Dialog footer */
[data-dialog-footer] {
    display: flex;
    justify-content: flex-end;
    gap: 12px;
    padding: 16px 24px 24px;
    border-top: 1px solid #e5e7eb;
}

/* Close button (icon) */
[data-dialog-close] {
    display: flex;
    align-items: center;
    justify-content: center;
    width: 32px;
    height: 32px;
    padding: 0;
    border: none;
    background: transparent;
    border-radius: 6px;
    cursor: pointer;
    color: #6b7280;
    transition: all 0.2s;
}

[data-dialog-close]:hover {
    background: #f3f4f6;
    color: #111827;
}

/* Trigger button */
[data-dialog-trigger] {
    /* Style as needed */
}
```

### Animation with Opening Class

```css
/* Smooth opening animation */
[data-component="dialog"] {
    opacity: 0;
    transform: scale(0.95);
    transition: opacity 0.2s ease-out,
                transform 0.2s ease-out,
                overlay 0.2s ease-out allow-discrete,
                display 0.2s ease-out allow-discrete;
}

[data-component="dialog"][open] {
    opacity: 1;
    transform: scale(1);
}

/* Backdrop animation */
[data-component="dialog"]::backdrop {
    opacity: 0;
    transition: opacity 0.2s ease-out,
                overlay 0.2s ease-out allow-discrete,
                display 0.2s ease-out allow-discrete;
}

[data-component="dialog"][open]::backdrop {
    opacity: 1;
}

/* Starting style for animations */
@starting-style {
    [data-component="dialog"][open] {
        opacity: 0;
        transform: scale(0.95);
    }

    [data-component="dialog"][open]::backdrop {
        opacity: 0;
    }
}
```

### Size Variants

```css
/* Small dialog */
[data-component="dialog"][data-size="sm"] {
    max-width: 400px;
}

/* Medium dialog (default) */
[data-component="dialog"][data-size="md"] {
    max-width: 600px;
}

/* Large dialog */
[data-component="dialog"][data-size="lg"] {
    max-width: 800px;
}

/* Full width dialog */
[data-component="dialog"][data-size="full"] {
    max-width: 95vw;
    width: 95vw;
    height: 95vh;
}
```

### Combining with Utility Classes

```twig
<twig:BaseUI:Dialog>
    <twig:BaseUI:Dialog:Trigger class="btn btn-primary">
        Open Styled Dialog
    </twig:BaseUI:Dialog:Trigger>

    <twig:BaseUI:Dialog:Content class="dialog-lg">
        <twig:BaseUI:Dialog:Header class="bg-primary text-white">
            <twig:BaseUI:Dialog:Title>Styled Dialog</twig:BaseUI:Dialog:Title>
            <twig:BaseUI:Dialog:Close />
        </twig:BaseUI:Dialog:Header>

        <twig:BaseUI:Dialog:Description class="p-6">
            Custom styled content
        </twig:BaseUI:Dialog:Description>
    </twig:BaseUI:Dialog:Content>
</twig:BaseUI:Dialog>
```

## Accessibility Guidelines

### Do's ✓

- **Always** include a title using `Dialog:Title` for screen readers
- **Always** provide a close mechanism (ESC key is handled automatically)
- **Use** `Dialog:Description` for the main content to link it via `aria-describedby`
- **Use** `role="alertdialog"` for urgent confirmations or alerts
- **Use** focus-visible styles so keyboard users can see focus
- **Ensure** sufficient color contrast (WCAG AA minimum 4.5:1)
- **Keep** tab order logical within the dialog

### Don'ts ✗

- **Don't** trap users without a way to close (always provide close button and/or cancel action)
- **Don't** use dialogs for non-critical information (consider alternatives)
- **Don't** nest dialogs excessively (causes confusion)
- **Don't** auto-open dialogs without user action (exceptions: critical security alerts)
- **Don't** disable backdrop click or ESC without good reason
- **Don't** use extremely long content (consider scrollable areas or pagination)

### Focus Management

The dialog component automatically handles focus:

1. **On open**: Focus moves to the first focusable element (usually close button or first input)
2. **During open**: Focus is trapped within the dialog (cannot tab outside)
3. **On close**: Focus returns to the trigger element

**Custom focus target:**
```twig
<twig:BaseUI:Dialog:Content>
    <twig:BaseUI:Dialog:Header>
        <twig:BaseUI:Dialog:Title>Login</twig:BaseUI:Dialog:Title>
        <twig:BaseUI:Dialog:Close />
    </twig:BaseUI:Dialog:Header>

    <twig:BaseUI:Dialog:Description>
        <input type="text" id="username" autofocus>
    </twig:BaseUI:Dialog:Description>
</twig:BaseUI:Dialog:Content>
```

### Keyboard Navigation

Automatically supported:

- **ESC**: Close dialog (if `closeOnEscape=true`)
- **Tab**: Navigate forward through focusable elements
- **Shift + Tab**: Navigate backward through focusable elements
- **Enter/Space**: Activate buttons and close triggers

## Implementation Details

### Why Native `<dialog>` Element?

**✅ Advantages:**

1. **Accessibility Built-in**:
   - Automatic focus management
   - Focus trap (cannot tab outside)
   - Screen reader announcements
   - ARIA attributes handled by browser

2. **Top Layer API**:
   - Automatically positioned above all content
   - No z-index conflicts
   - Proper stacking context

3. **Backdrop**:
   - Native `::backdrop` pseudo-element
   - Blocks interaction with page (modal mode)
   - Stylable with CSS

4. **Performance**:
   - Browser-optimized rendering
   - Minimal JavaScript required
   - Hardware-accelerated animations

5. **Standards Compliant**:
   - W3C specification
   - Future-proof
   - Better browser support than custom solutions

**❌ What We're NOT Doing:**

- **No manual focus management** - Browser handles it
- **No manual z-index** - Top layer handles it
- **No manual backdrop element** - `::backdrop` handles it
- **No complex ARIA** - Native element provides it
- **No heavy JavaScript** - Just open/close API

### Browser Support

Native `<dialog>` is supported in all modern browsers:
- Chrome 37+ (2014)
- Edge 79+ (2020)
- Firefox 98+ (2022)
- Safari 15.4+ (2022)

For older browsers, consider a polyfill or the component will gracefully degrade.

## Best Practices

### User Experience

```twig
{# ✓ Good: Clear action and escape route #}
<twig:BaseUI:Dialog>
    <twig:BaseUI:Dialog:Trigger>Delete Account</twig:BaseUI:Dialog:Trigger>
    <twig:BaseUI:Dialog:Content>
        <twig:BaseUI:Dialog:Header>
            <twig:BaseUI:Dialog:Title>Confirm Deletion</twig:BaseUI:Dialog:Title>
            <twig:BaseUI:Dialog:Close />
        </twig:BaseUI:Dialog:Header>
        <twig:BaseUI:Dialog:Description>
            Are you sure? This action cannot be undone.
        </twig:BaseUI:Dialog:Description>
        <twig:BaseUI:Dialog:Footer>
            <twig:BaseUI:Dialog:Close class="btn-secondary">Cancel</twig:BaseUI:Dialog:Close>
            <button class="btn-danger">Delete</button>
        </twig:BaseUI:Dialog:Footer>
    </twig:BaseUI:Dialog:Content>
</twig:BaseUI:Dialog>

{# ✗ Bad: No clear way to cancel #}
<twig:BaseUI:Dialog closeOnBackdropClick="false" closeOnEscape="false">
    <twig:BaseUI:Dialog:Trigger>Delete</twig:BaseUI:Dialog:Trigger>
    <twig:BaseUI:Dialog:Content>
        <p>Deleting...</p>
    </twig:BaseUI:Dialog:Content>
</twig:BaseUI:Dialog>
```

### Content

```twig
{# ✓ Good: Concise, scannable content #}
<twig:BaseUI:Dialog:Description>
    <p>Your session will expire in 2 minutes.</p>
    <p>Would you like to continue?</p>
</twig:BaseUI:Dialog:Description>

{# ✗ Bad: Too much text #}
<twig:BaseUI:Dialog:Description>
    <p>Lorem ipsum dolor sit amet... (500 words)</p>
</twig:BaseUI:Dialog:Description>
```

**Rule of thumb:** If content requires scrolling, consider:
1. Simplifying the content
2. Breaking into multiple steps
3. Using a full page instead of a dialog

### Actions

```twig
{# ✓ Good: Primary action is visually distinct #}
<twig:BaseUI:Dialog:Footer>
    <button class="btn-secondary">Cancel</button>
    <button class="btn-primary">Save Changes</button>
</twig:BaseUI:Dialog:Footer>

{# ✗ Bad: Actions look the same #}
<twig:BaseUI:Dialog:Footer>
    <button>Cancel</button>
    <button>Save Changes</button>
</twig:BaseUI:Dialog:Footer>
```

**Action ordering:** Place the primary action on the right (Western reading pattern).

### When NOT to Use Dialog

**Use alternatives when:**
- Information is not urgent → Use regular page or toast notification
- User needs to reference other content → Use side panel or split view
- Content is very long → Use dedicated page
- Multiple steps required → Use wizard or multi-page form
- Just showing status → Use toast or banner

## Events

The dialog component dispatches custom events for integration:

```javascript
const dialog = document.querySelector('[data-component="dialog"]');

// Dialog opened
dialog.addEventListener('dialog:open', (event) => {
    console.log('Dialog opened', event.detail);
});

// Dialog closed
dialog.addEventListener('dialog:close', (event) => {
    console.log('Dialog closed', event.detail);
    console.log('Return value:', event.detail.returnValue);
});

// Before dialog opens (cancellable)
dialog.addEventListener('dialog:before-open', (event) => {
    if (someCondition) {
        event.preventDefault(); // Prevents dialog from opening
    }
});

// Before dialog closes (cancellable)
dialog.addEventListener('dialog:before-close', (event) => {
    if (hasUnsavedChanges) {
        event.preventDefault(); // Prevents dialog from closing
        // Show confirmation dialog
    }
});
```

## Testing

### Unit Testing

```javascript
import { Application } from '@hotwired/stimulus';
import DialogController from './dialog_controller';

describe('DialogController', () => {
    beforeEach(() => {
        document.body.innerHTML = `
            <div data-controller="dialog">
                <button data-action="click->dialog#open">Open</button>
                <dialog data-dialog-target="dialog">
                    <button data-action="click->dialog#close">Close</button>
                </dialog>
            </div>
        `;

        const application = Application.start();
        application.register('dialog', DialogController);
    });

    it('opens dialog when trigger clicked', () => {
        const trigger = document.querySelector('[data-action*="dialog#open"]');
        const dialog = document.querySelector('dialog');

        trigger.click();

        expect(dialog.open).toBe(true);
    });

    it('closes dialog when close clicked', () => {
        const dialog = document.querySelector('dialog');
        dialog.showModal();

        const closeBtn = document.querySelector('[data-action*="dialog#close"]');
        closeBtn.click();

        expect(dialog.open).toBe(false);
    });
});
```

### E2E Testing (Playwright)

```javascript
test('dialog interaction', async ({ page }) => {
    await page.goto('/');

    // Open dialog
    await page.click('text=Open Dialog');
    await expect(page.locator('[data-component="dialog"]')).toBeVisible();

    // Check focus is trapped
    await page.keyboard.press('Tab');
    const focusedElement = await page.locator(':focus');
    const isInsideDialog = await focusedElement.evaluate((el) => {
        return el.closest('[data-component="dialog"]') !== null;
    });
    expect(isInsideDialog).toBe(true);

    // Close with ESC
    await page.keyboard.press('Escape');
    await expect(page.locator('[data-component="dialog"]')).not.toBeVisible();

    // Open again
    await page.click('text=Open Dialog');

    // Close with backdrop click
    await page.locator('[data-component="dialog"]::backdrop').click();
    await expect(page.locator('[data-component="dialog"]')).not.toBeVisible();
});
```

## Troubleshooting

### Dialog doesn't open

**Check:**
1. Stimulus controller is registered in `controllers.json`
2. Assets are rebuilt (`npm run build`)
3. JavaScript is not throwing errors (check console)
4. `open` attribute is not conflicting

### Dialog closes immediately

**Possible causes:**
- Form with `method="dialog"` is submitting unintentionally
- JavaScript calling `close()` method
- Event bubbling from nested elements

**Solution:**
```javascript
// Prevent form submission from closing dialog
dialog.addEventListener('submit', (e) => {
    e.preventDefault();
    // Handle form submission
});
```

### Focus not trapped

**Check:**
- Dialog is opened with `showModal()` not `show()` (modal vs non-modal)
- No conflicting JavaScript managing focus
- Dialog has focusable elements

### Backdrop not showing

**Check:**
- Dialog is modal (`modal="true"`)
- CSS for `::backdrop` is defined
- Dialog is opened with `showModal()`

### Animations not working

**Solution:** Use `@starting-style` and transition-behavior:
```css
[data-component="dialog"] {
    transition: opacity 0.3s, display 0.3s allow-discrete;
}

@starting-style {
    [data-component="dialog"][open] {
        opacity: 0;
    }
}
```
