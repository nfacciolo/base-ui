# AlertDialog

A modal dialog component designed for critical user confirmations. Unlike regular dialogs, AlertDialogs require explicit user action before proceeding, making them ideal for destructive operations or important decisions.

## Setup

### Stimulus Controller Registration

The AlertDialog component requires a Stimulus controller for modal behavior, focus management, and keyboard interactions. Add it to your `assets/controllers.json`:

```json
{
  "controllers": {
    "@reactic/base-ui": {
      "alert-dialog": {
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

The AlertDialog is composed of multiple sub-components that work together:

```twig
<twig:BaseUI:AlertDialog>
    <twig:BaseUI:AlertDialog:Trigger>
        Delete Account
    </twig:BaseUI:AlertDialog:Trigger>

    <twig:BaseUI:AlertDialog:Backdrop />

    <twig:BaseUI:AlertDialog:Popup>
        <twig:BaseUI:AlertDialog:Title>
            Are you sure?
        </twig:BaseUI:AlertDialog:Title>

        <twig:BaseUI:AlertDialog:Description>
            This action cannot be undone. Your account will be permanently deleted.
        </twig:BaseUI:AlertDialog:Description>

        <twig:BaseUI:AlertDialog:Close variant="cancel">
            Cancel
        </twig:BaseUI:AlertDialog:Close>

        <twig:BaseUI:AlertDialog:Close variant="confirm">
            Delete Account
        </twig:BaseUI:AlertDialog:Close>
    </twig:BaseUI:AlertDialog:Popup>
</twig:BaseUI:AlertDialog>
```

## Examples

### Basic Confirmation Dialog

```twig
<twig:BaseUI:AlertDialog>
    <twig:BaseUI:AlertDialog:Trigger>
        Delete Item
    </twig:BaseUI:AlertDialog:Trigger>

    <twig:BaseUI:AlertDialog:Backdrop />

    <twig:BaseUI:AlertDialog:Popup>
        <twig:BaseUI:AlertDialog:Title>
            Confirm Deletion
        </twig:BaseUI:AlertDialog:Title>

        <twig:BaseUI:AlertDialog:Description>
            Are you sure you want to delete this item? This action cannot be undone.
        </twig:BaseUI:AlertDialog:Description>

        <twig:BaseUI:AlertDialog:Close variant="cancel">
            Cancel
        </twig:BaseUI:AlertDialog:Close>

        <twig:BaseUI:AlertDialog:Close variant="confirm">
            Delete
        </twig:BaseUI:AlertDialog:Close>
    </twig:BaseUI:AlertDialog:Popup>
</twig:BaseUI:AlertDialog>
```

The AlertDialog renders with no styles by default. Use data attributes or add custom classes for styling:

```css
/* Style via data attributes */
[data-component="alert-dialog-popup"] {
    background: white;
    border-radius: 8px;
    padding: 24px;
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
}
```

### Destructive Action with Custom Styling

```twig
<twig:BaseUI:AlertDialog>
    <twig:BaseUI:AlertDialog:Trigger class="btn btn-danger">
        Delete Account
    </twig:BaseUI:AlertDialog:Trigger>

    <twig:BaseUI:AlertDialog:Backdrop />

    <twig:BaseUI:AlertDialog:Popup class="alert-dialog-danger">
        <twig:BaseUI:AlertDialog:Title>
            Delete Your Account
        </twig:BaseUI:AlertDialog:Title>

        <twig:BaseUI:AlertDialog:Description>
            This will permanently delete your account and all associated data.
            You will not be able to recover your information.
        </twig:BaseUI:AlertDialog:Description>

        <div class="alert-dialog-actions">
            <twig:BaseUI:AlertDialog:Close variant="cancel" class="btn btn-secondary">
                Keep My Account
            </twig:BaseUI:AlertDialog:Close>

            <twig:BaseUI:AlertDialog:Close variant="confirm" class="btn btn-danger">
                Yes, Delete Forever
            </twig:BaseUI:AlertDialog:Close>
        </div>
    </twig:BaseUI:AlertDialog:Popup>
</twig:BaseUI:AlertDialog>
```

### Controlled State

Control the open/close state programmatically:

```twig
<twig:BaseUI:AlertDialog
    open="{{ isOpen }}"
    onOpenChange="handleOpenChange"
>
    <twig:BaseUI:AlertDialog:Trigger>
        Open Dialog
    </twig:BaseUI:AlertDialog:Trigger>

    <twig:BaseUI:AlertDialog:Backdrop />

    <twig:BaseUI:AlertDialog:Popup>
        <twig:BaseUI:AlertDialog:Title>
            Controlled Dialog
        </twig:BaseUI:AlertDialog:Title>

        <twig:BaseUI:AlertDialog:Description>
            The open state is controlled externally.
        </twig:BaseUI:AlertDialog:Description>

        <twig:BaseUI:AlertDialog:Close variant="confirm">
            OK
        </twig:BaseUI:AlertDialog:Close>
    </twig:BaseUI:AlertDialog:Popup>
</twig:BaseUI:AlertDialog>
```

### Multiple Triggers

A single AlertDialog can be opened by multiple triggers:

```twig
<twig:BaseUI:AlertDialog>
    <twig:BaseUI:AlertDialog:Trigger id="trigger-1">
        Delete from List
    </twig:BaseUI:AlertDialog:Trigger>

    <twig:BaseUI:AlertDialog:Trigger id="trigger-2">
        Delete from Grid
    </twig:BaseUI:AlertDialog:Trigger>

    <twig:BaseUI:AlertDialog:Backdrop />

    <twig:BaseUI:AlertDialog:Popup>
        <twig:BaseUI:AlertDialog:Title>
            Confirm Deletion
        </twig:BaseUI:AlertDialog:Title>

        <twig:BaseUI:AlertDialog:Description>
            Are you sure you want to delete this item?
        </twig:BaseUI:AlertDialog:Description>

        <twig:BaseUI:AlertDialog:Close variant="cancel">
            Cancel
        </twig:BaseUI:AlertDialog:Close>

        <twig:BaseUI:AlertDialog:Close variant="confirm">
            Delete
        </twig:BaseUI:AlertDialog:Close>
    </twig:BaseUI:AlertDialog:Popup>
</twig:BaseUI:AlertDialog>
```

### With Form Submission

```twig
<twig:BaseUI:AlertDialog>
    <twig:BaseUI:AlertDialog:Trigger class="btn btn-primary">
        Submit Order
    </twig:BaseUI:AlertDialog:Trigger>

    <twig:BaseUI:AlertDialog:Backdrop />

    <twig:BaseUI:AlertDialog:Popup>
        <twig:BaseUI:AlertDialog:Title>
            Confirm Order
        </twig:BaseUI:AlertDialog:Title>

        <twig:BaseUI:AlertDialog:Description>
            You are about to place an order for ${{ total }}.
            Please confirm to proceed with payment.
        </twig:BaseUI:AlertDialog:Description>

        <twig:BaseUI:AlertDialog:Close variant="cancel">
            Review Order
        </twig:BaseUI:AlertDialog:Close>

        <twig:BaseUI:AlertDialog:Close
            variant="confirm"
            formAction="{{ path('order_submit') }}"
            formMethod="post"
        >
            Confirm & Pay
        </twig:BaseUI:AlertDialog:Close>
    </twig:BaseUI:AlertDialog:Popup>
</twig:BaseUI:AlertDialog>
```

### Focus Management

Control which element receives focus when the dialog opens and closes:

```twig
<twig:BaseUI:AlertDialog>
    <twig:BaseUI:AlertDialog:Trigger>
        Open Settings
    </twig:BaseUI:AlertDialog:Trigger>

    <twig:BaseUI:AlertDialog:Backdrop />

    <twig:BaseUI:AlertDialog:Popup
        initialFocus="#confirm-button"
        finalFocus="#settings-link"
    >
        <twig:BaseUI:AlertDialog:Title>
            Confirm Settings Change
        </twig:BaseUI:AlertDialog:Title>

        <twig:BaseUI:AlertDialog:Description>
            This will modify your notification preferences.
        </twig:BaseUI:AlertDialog:Description>

        <twig:BaseUI:AlertDialog:Close variant="cancel">
            Cancel
        </twig:BaseUI:AlertDialog:Close>

        <twig:BaseUI:AlertDialog:Close variant="confirm" id="confirm-button">
            Confirm
        </twig:BaseUI:AlertDialog:Close>
    </twig:BaseUI:AlertDialog:Popup>
</twig:BaseUI:AlertDialog>
```

## API Reference

### Root Component (AlertDialog)

| Prop | Type | Default | Description |
|------|------|---------|-------------|
| `open` | `bool` | `null` | Controlled open state |
| `defaultOpen` | `bool` | `false` | Initial open state (uncontrolled) |
| `onOpenChange` | `string` | `null` | Callback when open state changes |
| `triggerId` | `string` | `null` | ID of the trigger that opened the dialog |

### Trigger Component

| Prop | Type | Default | Description |
|------|------|---------|-------------|
| `id` | `string` | auto-generated | Unique identifier for this trigger |
| `disabled` | `bool` | `false` | Whether the trigger is disabled |

**Note:** Standard HTML attributes like `class`, `type`, etc. are automatically passed through.

### Backdrop Component

| Prop | Type | Default | Description |
|------|------|---------|-------------|
| `dismissible` | `bool` | `true` | Whether clicking the backdrop closes the dialog |
| `class` | `string` | `null` | Additional CSS classes |

### Popup Component

| Prop | Type | Default | Description |
|------|------|---------|-------------|
| `initialFocus` | `string` | `null` | CSS selector for element to focus on open |
| `finalFocus` | `string` | `null` | CSS selector for element to focus on close |
| `class` | `string` | `null` | Additional CSS classes |

### Title Component

| Prop | Type | Default | Description |
|------|------|---------|-------------|
| `level` | `int` | `2` | Heading level (1-6) |
| `class` | `string` | `null` | Additional CSS classes |

### Description Component

| Prop | Type | Default | Description |
|------|------|---------|-------------|
| `class` | `string` | `null` | Additional CSS classes |

### Close Component

| Prop | Type | Default | Description |
|------|------|---------|-------------|
| `variant` | `string` | `'cancel'` | Button variant: `'cancel'` or `'confirm'` |
| `formAction` | `string` | `null` | URL to submit form to (for confirm buttons) |
| `formMethod` | `string` | `'post'` | HTTP method for form submission |
| `class` | `string` | `null` | Additional CSS classes |

## Data Attributes

The component exposes these data attributes for styling:

| Attribute | Values | Applied To | Description |
|-----------|--------|------------|-------------|
| `data-component` | `"alert-dialog"` | Root | Identifies the component type |
| `data-component` | `"alert-dialog-trigger"` | Trigger | Identifies the trigger element |
| `data-component` | `"alert-dialog-backdrop"` | Backdrop | Identifies the backdrop element |
| `data-component` | `"alert-dialog-popup"` | Popup | Identifies the popup element |
| `data-open` | `"true"` \| `"false"` | Root, Popup | Reflects the open state |
| `data-variant` | `"cancel"` \| `"confirm"` | Close | Indicates the button variant |

## ARIA Attributes

Automatically applied for accessibility:

- **Root**: `role="alertdialog"`, `aria-modal="true"`
- **Title**: `id="alert-dialog-title-{id}"` (referenced by popup)
- **Description**: `id="alert-dialog-description-{id}"` (referenced by popup)
- **Popup**: `aria-labelledby="alert-dialog-title-{id}"`, `aria-describedby="alert-dialog-description-{id}"`
- **Backdrop**: `aria-hidden="true"`

## Styling Examples

### Using Data Attributes

```css
/* Backdrop overlay */
[data-component="alert-dialog-backdrop"] {
    position: fixed;
    inset: 0;
    background: rgba(0, 0, 0, 0.5);
    backdrop-filter: blur(4px);
    z-index: 1000;
    animation: fadeIn 0.2s;
}

/* Popup container */
[data-component="alert-dialog-popup"] {
    position: fixed;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    background: white;
    border-radius: 12px;
    padding: 24px;
    box-shadow: 0 8px 24px rgba(0, 0, 0, 0.15);
    max-width: 500px;
    width: 90%;
    z-index: 1001;
    animation: slideUp 0.3s;
}

/* Title styling */
[data-component="alert-dialog-popup"] h2 {
    margin: 0 0 8px;
    font-size: 20px;
    font-weight: 600;
    color: #1a1a1a;
}

/* Description styling */
[data-component="alert-dialog-popup"] p {
    margin: 0 0 24px;
    color: #666;
    line-height: 1.5;
}

/* Button variants */
[data-component="alert-dialog-popup"] button[data-variant="cancel"] {
    background: #f5f5f5;
    color: #333;
    border: 1px solid #ddd;
    padding: 8px 16px;
    border-radius: 6px;
    cursor: pointer;
}

[data-component="alert-dialog-popup"] button[data-variant="confirm"] {
    background: #dc3545;
    color: white;
    border: none;
    padding: 8px 16px;
    border-radius: 6px;
    cursor: pointer;
    font-weight: 500;
}

[data-component="alert-dialog-popup"] button[data-variant="confirm"]:hover {
    background: #c82333;
}

/* Animations */
@keyframes fadeIn {
    from { opacity: 0; }
    to { opacity: 1; }
}

@keyframes slideUp {
    from {
        opacity: 0;
        transform: translate(-50%, -45%);
    }
    to {
        opacity: 1;
        transform: translate(-50%, -50%);
    }
}
```

### Themed Variants

```css
/* Danger variant */
.alert-dialog-danger h2 {
    color: #dc3545;
}

.alert-dialog-danger [data-variant="confirm"] {
    background: #dc3545;
}

/* Success variant */
.alert-dialog-success h2 {
    color: #28a745;
}

.alert-dialog-success [data-variant="confirm"] {
    background: #28a745;
}

/* Warning variant */
.alert-dialog-warning h2 {
    color: #ffc107;
}

.alert-dialog-warning [data-variant="confirm"] {
    background: #ffc107;
    color: #000;
}
```

### Action Buttons Layout

```css
/* Horizontal button layout */
.alert-dialog-actions {
    display: flex;
    gap: 12px;
    justify-content: flex-end;
    margin-top: 24px;
}

/* Stacked on mobile */
@media (max-width: 480px) {
    .alert-dialog-actions {
        flex-direction: column-reverse;
    }

    .alert-dialog-actions button {
        width: 100%;
    }
}
```

## Accessibility Guidelines

### Do's ✓

- **Always** provide both a Title and Description for screen readers
- **Always** ensure keyboard navigation works (Tab, Escape, Enter)
- **Use** clear, action-oriented button labels ("Delete Account" not "OK")
- **Use** the `initialFocus` prop to focus the safest action (usually Cancel)
- **Use** AlertDialog for destructive or critical actions only
- **Ensure** the backdrop is not dismissible for truly critical confirmations

### Don'ts ✗

- **Don't** use AlertDialog for informational messages (use Toast or Dialog instead)
- **Don't** use generic button text ("Yes/No" instead of describing the action)
- **Don't** make multiple destructive actions available simultaneously
- **Don't** auto-dismiss critical confirmations
- **Don't** nest AlertDialogs (one confirmation at a time)

### When to Use AlertDialog vs Dialog

**Use AlertDialog when:**
- Confirming destructive actions (delete, remove, cancel subscription)
- Obtaining explicit consent for critical operations
- Warning about consequences before proceeding
- Requiring user acknowledgment of important information

**Use Dialog when:**
- Displaying forms or multi-step processes
- Showing informational content
- Presenting options without consequences
- Building wizards or onboarding flows

**Rule of thumb:** If the user would be upset if they accidentally triggered the action, use an AlertDialog.

## Implementation Details

### Focus Management

The AlertDialog implements the WAI-ARIA AlertDialog pattern:

1. **On Open:**
   - Focus moves to the element specified by `initialFocus`
   - If not specified, focuses the first focusable element (typically Cancel button)
   - Focus is trapped within the dialog

2. **During Interaction:**
   - Tab cycles through focusable elements within the dialog
   - Escape key closes the dialog (returns to trigger)
   - Click outside may close the dialog (if `dismissible=true`)

3. **On Close:**
   - Focus returns to the element specified by `finalFocus`
   - If not specified, returns to the trigger that opened the dialog

### Keyboard Interactions

| Key | Action |
|-----|--------|
| `Escape` | Closes the dialog (equivalent to Cancel) |
| `Tab` | Moves focus to next focusable element |
| `Shift + Tab` | Moves focus to previous focusable element |
| `Enter` | Activates the focused button |

### Best Practice: Focus Order

```twig
{# ✓ Good: Cancel button focused first (safest action) #}
<twig:BaseUI:AlertDialog:Popup initialFocus="#cancel-btn">
    <twig:BaseUI:AlertDialog:Close variant="cancel" id="cancel-btn">
        Cancel
    </twig:BaseUI:AlertDialog:Close>

    <twig:BaseUI:AlertDialog:Close variant="confirm">
        Delete
    </twig:BaseUI:AlertDialog:Close>
</twig:BaseUI:AlertDialog:Popup>
```

## Best Practices

### Clear Communication

```twig
{# ✓ Good: Specific, action-oriented labels #}
<twig:BaseUI:AlertDialog>
    <twig:BaseUI:AlertDialog:Title>
        Delete 3 Selected Items?
    </twig:BaseUI:AlertDialog:Title>

    <twig:BaseUI:AlertDialog:Description>
        This will permanently remove these items from your library.
        This action cannot be undone.
    </twig:BaseUI:AlertDialog:Description>

    <twig:BaseUI:AlertDialog:Close variant="cancel">
        Keep Items
    </twig:BaseUI:AlertDialog:Close>

    <twig:BaseUI:AlertDialog:Close variant="confirm">
        Delete 3 Items
    </twig:BaseUI:AlertDialog:Close>
</twig:BaseUI:AlertDialog>

{# ✗ Bad: Vague, generic labels #}
<twig:BaseUI:AlertDialog>
    <twig:BaseUI:AlertDialog:Title>
        Are you sure?
    </twig:BaseUI:AlertDialog:Title>

    <twig:BaseUI:AlertDialog:Description>
        Do you want to continue?
    </twig:BaseUI:AlertDialog:Description>

    <twig:BaseUI:AlertDialog:Close variant="cancel">
        No
    </twig:BaseUI:AlertDialog:Close>

    <twig:BaseUI:AlertDialog:Close variant="confirm">
        Yes
    </twig:BaseUI:AlertDialog:Close>
</twig:BaseUI:AlertDialog>
```

### Progressive Disclosure

```twig
{# ✓ Good: Extra confirmation for severe actions #}
<twig:BaseUI:AlertDialog>
    <twig:BaseUI:AlertDialog:Title>
        Delete Your Account?
    </twig:BaseUI:AlertDialog:Title>

    <twig:BaseUI:AlertDialog:Description>
        <p>This will:</p>
        <ul>
            <li>Delete all your data permanently</li>
            <li>Cancel your active subscriptions</li>
            <li>Remove you from all shared projects</li>
        </ul>
        <p>Type "DELETE" to confirm:</p>
        <input type="text" id="confirm-input" />
    </twig:BaseUI:AlertDialog:Description>

    <twig:BaseUI:AlertDialog:Close
        variant="confirm"
        disabled="{{ confirmInput != 'DELETE' }}"
    >
        Delete My Account
    </twig:BaseUI:AlertDialog:Close>
</twig:BaseUI:AlertDialog>
```

### Visual Hierarchy

```twig
{# ✓ Good: Cancel button is visually less prominent #}
<div class="alert-dialog-actions">
    <twig:BaseUI:AlertDialog:Close variant="cancel" class="btn-secondary">
        Cancel
    </twig:BaseUI:AlertDialog:Close>

    <twig:BaseUI:AlertDialog:Close variant="confirm" class="btn-danger">
        Delete Account
    </twig:BaseUI:AlertDialog:Close>
</div>
```

```css
.btn-secondary {
    /* Less prominent styling */
    background: transparent;
    border: 1px solid #ddd;
}

.btn-danger {
    /* More prominent, but dangerous */
    background: #dc3545;
    color: white;
}
```

## Common Patterns

### Confirmation with Undo Option

```twig
{# Show AlertDialog first, then provide undo in Toast #}
<twig:BaseUI:AlertDialog>
    <twig:BaseUI:AlertDialog:Close
        variant="confirm"
        data-action="delete-with-undo"
    >
        Delete
    </twig:BaseUI:AlertDialog:Close>
</twig:BaseUI:AlertDialog>

{# After confirmation, show toast with undo #}
<twig:BaseUI:Toast type="success">
    Item deleted. <button>Undo</button>
</twig:BaseUI:Toast>
```

### Loading State During Async Action

```twig
<twig:BaseUI:AlertDialog>
    <twig:BaseUI:AlertDialog:Close
        variant="confirm"
        data-loading="{{ isDeleting }}"
    >
        {% if isDeleting %}
            Deleting...
        {% else %}
            Delete Item
        {% endif %}
    </twig:BaseUI:AlertDialog:Close>
</twig:BaseUI:AlertDialog>
```

### Contextual Content Based on Trigger

```twig
<twig:BaseUI:AlertDialog triggerId="{{ triggeredBy }}">
    <twig:BaseUI:AlertDialog:Description>
        {% if triggeredBy == 'bulk-delete' %}
            You are about to delete {{ count }} items.
        {% else %}
            You are about to delete "{{ itemName }}".
        {% endif %}
    </twig:BaseUI:AlertDialog:Description>
</twig:BaseUI:AlertDialog>
```

## Testing Checklist

Before releasing an AlertDialog implementation:

- [ ] Keyboard navigation works (Tab, Shift+Tab, Escape, Enter)
- [ ] Screen reader announces title and description
- [ ] Focus moves to correct element on open
- [ ] Focus returns to trigger on close
- [ ] Backdrop click behavior is correct (dismissible or not)
- [ ] Button labels clearly describe the action
- [ ] Destructive actions are visually distinct
- [ ] Mobile layout works (buttons stack on small screens)
- [ ] Loading/disabled states work correctly
- [ ] Form submission works (if applicable)
