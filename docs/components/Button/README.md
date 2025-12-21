# Button

A button component that can be rendered as another tag or focusable when disabled.

## Anatomy

```twig
<twig:BaseUI:Button>
    Click me
</twig:BaseUI:Button>
```

## Examples

### Basic Usage

```twig
<twig:BaseUI:Button>
    Submit
</twig:BaseUI:Button>
```

The button renders with no styles by default. Use data attributes or add custom classes for styling:

```css
/* Style via data attributes */
[data-component="button"] {
    padding: 8px 16px;
    border-radius: 4px;
}
```

```twig
{# Or add custom classes #}
<twig:BaseUI:Button class="btn btn-primary">
    Submit
</twig:BaseUI:Button>
```

### Focusable When Disabled

By default, disabled buttons cannot receive focus. This can be problematic for accessibility, as users navigating with keyboard may not understand why a button is unavailable.

The `focusableWhenDisabled` prop allows the button to remain focusable even when disabled, enabling tooltips or other feedback:

```twig
<twig:BaseUI:Button
    disabled="true"
    focusableWhenDisabled="true"
    title="Please fill all required fields"
>
    Submit
</twig:BaseUI:Button>
```

**When to use:**
- Loading states - Keep focus during async operations
- Form validation - Show tooltips explaining why submission is disabled
- Better UX - Allow screen readers to explain unavailability

**Technical implementation:**
When `focusableWhenDisabled` is true, the button uses `aria-disabled="true"` instead of the HTML `disabled` attribute, maintaining keyboard focus while preventing interaction.

### Rendering as Another Tag

You can render the button functionality as a different HTML element using the `tag` prop:

```twig
{# Render as a div (useful for custom interactive elements) #}
<twig:BaseUI:Button tag="div">
    Custom Button
</twig:BaseUI:Button>
```

**Note:** When rendering as a non-button element, appropriate ARIA attributes are added to maintain accessibility (e.g., `role="button"`, keyboard event handlers).

**Avoid using `tag="a"`:** Buttons are for actions, links are for navigation. Use a proper `<a>` element or a Link component for navigation instead.

## API Reference

### Props

| Prop | Type | Default | Description |
|------|------|---------|-------------|
| `disabled` | `bool` | `false` | Whether the button should ignore user interaction |
| `focusableWhenDisabled` | `bool` | `false` | Whether the button can be focused when disabled. Uses `aria-disabled` instead of `disabled` attribute |
| `tag` | `string` | `'button'` | The HTML tag to render (`button`, `div`, etc.) |

**Note:** Standard HTML attributes like `type`, `class`, `id`, etc. are automatically passed through via Twig Component's `{{ attributes }}` and don't need to be explicitly defined as props.

### Data Attributes

The component exposes these data attributes for styling:

| Attribute | Values | Description |
|-----------|--------|-------------|
| `data-component` | `"button"` | Identifies the component type |
| `data-disabled` | `"true"` \| `"false"` | Reflects the disabled state |

### ARIA Attributes

Automatically applied based on props:

- `aria-disabled="true"` - When `disabled=true` and `focusableWhenDisabled=true`
- `role="button"` - When rendered as non-button tag
- `tabindex="0"` - When rendered as non-button focusable element

## Styling Examples

### Using Data Attributes

```css
/* Base button styles */
[data-component="button"] {
    padding: 8px 16px;
    border: 1px solid #ccc;
    background: white;
    cursor: pointer;
}

/* Disabled state */
[data-component="button"][data-disabled="true"] {
    opacity: 0.5;
    cursor: not-allowed;
}
```

### Using Custom Classes

```twig
<twig:BaseUI:Button class="btn btn-primary">Primary</twig:BaseUI:Button>
<twig:BaseUI:Button class="btn btn-secondary">Secondary</twig:BaseUI:Button>
```

```css
.btn {
    padding: 8px 16px;
    border-radius: 4px;
}

.btn-primary {
    background: blue;
    color: white;
}

.btn-secondary {
    background: gray;
    color: white;
}
```

### Combining Both Approaches

```twig
<twig:BaseUI:Button class="btn" disabled="true">
    Submit
</twig:BaseUI:Button>
```

```css
/* Your custom classes */
.btn {
    padding: 8px 16px;
}

/* Enhance with data attribute selectors */
.btn[data-disabled="true"] {
    opacity: 0.5;
}
```
