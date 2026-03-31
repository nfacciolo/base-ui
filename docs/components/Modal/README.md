# Modal

A modal dialog component that overlays the page content, inspired by Bootstrap's modal implementation.

## Anatomy

```twig
<twig:BaseUI:Modal id="myModal" labelledBy="myModalLabel">
    <twig:block name="header">
        <h2 id="myModalLabel">Modal title</h2>
        <twig:BaseUI:Modal:Close />
    </twig:block>

    <twig:block name="content">
        Modal content goes here
    </twig:block>

    <twig:block name="footer">
        <twig:BaseUI:Button data-dismiss="modal">Close</twig:BaseUI:Button>
        <twig:BaseUI:Button>Save changes</twig:BaseUI:Button>
    </twig:block>
</twig:BaseUI:Modal>

{# Trigger button #}
<twig:BaseUI:Button data-toggle="modal" data-target="#myModal">
    Open Modal
</twig:BaseUI:Button>
```

## Examples

### Basic Usage

```twig
<twig:BaseUI:Modal id="exampleModal" labelledBy="exampleModalLabel">
    <twig:block name="header">
        <h2 id="exampleModalLabel">Welcome</h2>
        <twig:BaseUI:Modal:Close />
    </twig:block>

    <twig:block name="content">
        This is a simple modal dialog.
    </twig:block>

    <twig:block name="footer">
        <twig:BaseUI:Button data-dismiss="modal">Close</twig:BaseUI:Button>
    </twig:block>
</twig:BaseUI:Modal>

<twig:BaseUI:Button data-toggle="modal" data-target="#exampleModal">
    Launch Modal
</twig:BaseUI:Button>
```

The modal renders with no styles by default. Use data attributes or add custom classes for styling:

```css
/* Style via data attributes */
[data-component="modal"] {
    position: fixed;
    inset: 0;
    background: rgba(0, 0, 0, 0.5);
}

[data-component="modal-dialog"] {
    max-width: 500px;
    margin: 1.75rem auto;
}

[data-component="modal-content"] {
    background: white;
    border-radius: 8px;
}
```

### Modal Without Header or Footer

You can omit the header or footer blocks if not needed:

```twig
<twig:BaseUI:Modal id="simpleModal">
    <twig:block name="content">
        Just a message without header or footer.
    </twig:block>
</twig:BaseUI:Modal>
```

### Custom Close Button

You can customize the close button or use your own:

```twig
<twig:BaseUI:Modal id="customCloseModal" labelledBy="customLabel">
    <twig:block name="header">
        <h2 id="customLabel">Custom Close</h2>
        <button type="button" data-dismiss="modal" aria-label="Close" class="custom-close">
            ✕
        </button>
    </twig:block>

    <twig:block name="content">
        Content with custom close button.
    </twig:block>
</twig:BaseUI:Modal>
```

### Modal Sizes

Control the modal width using the `size` prop:

```twig
{# Small modal #}
<twig:BaseUI:Modal id="smallModal" size="sm">
    <twig:block name="content">Small modal content</twig:block>
</twig:BaseUI:Modal>

{# Large modal #}
<twig:BaseUI:Modal id="largeModal" size="lg">
    <twig:block name="content">Large modal content</twig:block>
</twig:BaseUI:Modal>

{# Extra large modal #}
<twig:BaseUI:Modal id="xlModal" size="xl">
    <twig:block name="content">Extra large modal content</twig:block>
</twig:BaseUI:Modal>
```

### Centered Modal

Center the modal vertically in the viewport:

```twig
<twig:BaseUI:Modal id="centeredModal" centered="true">
    <twig:block name="content">
        This modal is vertically centered.
    </twig:block>
</twig:BaseUI:Modal>
```

### Scrollable Modal

When the modal content is too long, make the body scrollable:

```twig
<twig:BaseUI:Modal id="scrollableModal" scrollable="true">
    <twig:block name="content">
        Very long content that will scroll...
    </twig:block>
</twig:BaseUI:Modal>
```

### Static Backdrop

Prevent closing the modal when clicking outside:

```twig
<twig:BaseUI:Modal id="staticModal" backdrop="static" keyboard="false">
    <twig:block name="content">
        This modal cannot be closed by clicking outside or pressing Escape.
    </twig:block>

    <twig:block name="footer">
        <twig:BaseUI:Button data-dismiss="modal">
            Click here to close
        </twig:BaseUI:Button>
    </twig:block>
</twig:BaseUI:Modal>
```

### Fullscreen Modal

Display the modal in fullscreen mode:

```twig
{# Always fullscreen #}
<twig:BaseUI:Modal id="fullscreenModal" fullscreen="true">
    <twig:block name="content">Fullscreen content</twig:block>
</twig:BaseUI:Modal>

{# Fullscreen on small screens only #}
<twig:BaseUI:Modal id="responsiveModal" fullscreen="sm-down">
    <twig:block name="content">Fullscreen on mobile</twig:block>
</twig:BaseUI:Modal>
```

## API Reference

### Props

| Prop | Type | Default | Description |
|------|------|---------|-------------|
| `id` | `string` | **required** | Unique identifier for the modal (used by trigger buttons) |
| `labelledBy` | `string` | `null` | ID of the element that labels the modal (for accessibility) |
| `describedBy` | `string` | `null` | ID of the element that describes the modal (for accessibility) |
| `size` | `string` | `null` | Modal size: `'sm'`, `'lg'`, `'xl'` |
| `centered` | `bool` | `false` | Whether to vertically center the modal in the viewport |
| `scrollable` | `bool` | `false` | Whether to make the modal body scrollable |
| `backdrop` | `string\|bool` | `true` | Include a backdrop. Use `'static'` to prevent closing on click |
| `keyboard` | `bool` | `true` | Close the modal when Escape key is pressed |
| `fade` | `bool` | `true` | Apply fade animation when opening/closing |
| `fullscreen` | `string\|bool` | `false` | Display fullscreen. Values: `true`, `'sm-down'`, `'md-down'`, `'lg-down'`, `'xl-down'`, `'xxl-down'` |
| `open` | `bool` | `false` | Whether the modal is initially open (server-side rendered) |

**Note:** Standard HTML attributes like `class`, `data-*`, etc. are automatically passed through to the modal container.

### Blocks

| Block | Required | Description |
|-------|----------|-------------|
| `header` | No | Modal header content (typically contains title and close button) |
| `body` | No | Main modal content |
| `footer` | No | Modal footer content (typically contains action buttons) |

### Data Attributes for Triggers

Use these data attributes on buttons or links to control modals:

| Attribute | Value | Description |
|-----------|-------|-------------|
| `data-toggle` | `"modal"` | Indicates this element triggers a modal |
| `data-target` | `"#modalId"` | ID selector of the modal to open |

### Data Attributes for Dismissing

Use these data attributes to close the modal:

| Attribute | Value | Description |
|-----------|-------|-------------|
| `data-dismiss` | `"modal"` | Closes the modal when clicked |

### Component Data Attributes

The component exposes these data attributes for styling:

| Attribute | Values | Description |
|-----------|--------|-------------|
| `data-component` | `"modal"` | Identifies the modal container |
| `data-component` | `"modal-dialog"` | Identifies the modal dialog wrapper |
| `data-component` | `"modal-content"` | Identifies the modal content container |
| `data-component` | `"modal-header"` | Identifies the modal header |
| `data-component` | `"modal-body"` | Identifies the modal body |
| `data-component` | `"modal-footer"` | Identifies the modal footer |
| `data-open` | `"true"` \| `"false"` | Reflects whether the modal is currently open |
| `data-size` | `"sm"` \| `"lg"` \| `"xl"` | Reflects the modal size |
| `data-centered` | `"true"` \| `"false"` | Reflects the centered state |
| `data-scrollable` | `"true"` \| `"false"` | Reflects the scrollable state |
| `data-fullscreen` | `"true"` \| breakpoint | Reflects the fullscreen setting |

### ARIA Attributes

Automatically applied for accessibility:

- `role="dialog"` - Identifies the modal as a dialog
- `aria-modal="true"` - Indicates this is a modal dialog
- `aria-labelledby="..."` - References the element that labels the modal (when `labelledBy` prop is set)
- `aria-describedby="..."` - References the element that describes the modal (when `describedBy` prop is set)
- `aria-hidden="true"` - Applied when modal is closed
- `tabindex="-1"` - Ensures keyboard focus management

### Modal:Close Component

A specialized close button for modals:

```twig
<twig:BaseUI:Modal:Close aria-label="Close" />
```

| Prop | Type | Default | Description |
|------|------|---------|-------------|
| `aria-label` | `string` | `'Close'` | Accessible label for the close button |

## Styling Examples

### Using Data Attributes

```css
/* Modal backdrop */
[data-component="modal"] {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(0, 0, 0, 0.5);
    display: none;
    z-index: 1050;
}

[data-component="modal"][data-open="true"] {
    display: flex;
    align-items: center;
    justify-content: center;
}

/* Modal dialog */
[data-component="modal-dialog"] {
    max-width: 500px;
    width: 100%;
    margin: 1.75rem;
}

[data-component="modal-dialog"][data-size="sm"] {
    max-width: 300px;
}

[data-component="modal-dialog"][data-size="lg"] {
    max-width: 800px;
}

[data-component="modal-dialog"][data-size="xl"] {
    max-width: 1140px;
}

/* Modal content */
[data-component="modal-content"] {
    background-color: white;
    border-radius: 8px;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
}

/* Modal sections */
[data-component="modal-header"],
[data-component="modal-footer"] {
    padding: 1rem;
    border-bottom: 1px solid #dee2e6;
}

[data-component="modal-footer"] {
    border-top: 1px solid #dee2e6;
    border-bottom: none;
}

[data-component="modal-body"] {
    padding: 1rem;
}

/* Scrollable modal */
[data-component="modal-dialog"][data-scrollable="true"] {
    max-height: calc(100vh - 3.5rem);
}

[data-component="modal-dialog"][data-scrollable="true"] [data-component="modal-content"] {
    max-height: calc(100vh - 3.5rem);
    display: flex;
    flex-direction: column;
}

[data-component="modal-dialog"][data-scrollable="true"] [data-component="modal-body"] {
    overflow-y: auto;
}

/* Centered modal */
[data-component="modal"][data-centered="true"] {
    align-items: center;
}

/* Fullscreen modal */
[data-component="modal-dialog"][data-fullscreen="true"] {
    max-width: 100%;
    margin: 0;
    height: 100vh;
}

[data-component="modal-dialog"][data-fullscreen="true"] [data-component="modal-content"] {
    height: 100%;
    border-radius: 0;
}
```

### Animation with Fade

```css
/* Fade animation */
[data-component="modal"].fade {
    opacity: 0;
    transition: opacity 0.15s linear;
}

[data-component="modal"].fade[data-open="true"] {
    opacity: 1;
}

[data-component="modal-dialog"].fade {
    transform: translate(0, -50px);
    transition: transform 0.3s ease-out;
}

[data-component="modal"].fade[data-open="true"] [data-component="modal-dialog"] {
    transform: translate(0, 0);
}
```

## JavaScript Integration

The modal component is designed to work with JavaScript for interactive behavior:

```javascript
// Open modal
document.querySelector('[data-toggle="modal"]').addEventListener('click', (e) => {
    const targetId = e.currentTarget.getAttribute('data-target');
    const modal = document.querySelector(targetId);
    modal.setAttribute('data-open', 'true');
    modal.setAttribute('aria-hidden', 'false');
    document.body.style.overflow = 'hidden'; // Prevent body scroll
});

// Close modal
document.querySelectorAll('[data-dismiss="modal"]').forEach(btn => {
    btn.addEventListener('click', (e) => {
        const modal = e.target.closest('[data-component="modal"]');
        modal.setAttribute('data-open', 'false');
        modal.setAttribute('aria-hidden', 'true');
        document.body.style.overflow = ''; // Restore body scroll
    });
});

// Close on backdrop click
document.querySelectorAll('[data-component="modal"]').forEach(modal => {
    modal.addEventListener('click', (e) => {
        if (e.target === modal && modal.dataset.backdrop !== 'static') {
            modal.setAttribute('data-open', 'false');
            modal.setAttribute('aria-hidden', 'true');
            document.body.style.overflow = '';
        }
    });
});

// Close on Escape key
document.addEventListener('keydown', (e) => {
    if (e.key === 'Escape') {
        const openModal = document.querySelector('[data-component="modal"][data-open="true"]');
        if (openModal && openModal.dataset.keyboard !== 'false') {
            openModal.setAttribute('data-open', 'false');
            openModal.setAttribute('aria-hidden', 'true');
            document.body.style.overflow = '';
        }
    }
});
```

**Note:** For production use, consider using a more robust solution like Stimulus controllers or a dedicated modal library.

## Accessibility Best Practices

1. **Always provide a label**: Use the `labelledBy` prop to reference the modal's title
2. **Trap keyboard focus**: Ensure focus stays within the modal when open
3. **Return focus**: When closing, return focus to the trigger element
4. **Escape key**: Allow closing with Escape unless explicitly disabled
5. **Screen reader announcements**: The `role="dialog"` and `aria-modal="true"` attributes help screen readers understand the modal context

```twig
{# Good accessibility example #}
<twig:BaseUI:Modal
    id="accessibleModal"
    labelledBy="modalTitle"
    describedBy="modalDescription"
>
    <twig:block name="header">
        <h2 id="modalTitle">Delete Account</h2>
        <twig:BaseUI:Modal:Close aria-label="Close dialog" />
    </twig:block>

    <twig:block name="content">
        <p id="modalDescription">
            Are you sure you want to delete your account?
            This action cannot be undone.
        </p>
    </twig:block>

    <twig:block name="footer">
        <twig:BaseUI:Button data-dismiss="modal">Cancel</twig:BaseUI:Button>
        <twig:BaseUI:Button type="submit">Delete Account</twig:BaseUI:Button>
    </twig:block>
</twig:BaseUI:Modal>
```
