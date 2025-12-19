# Separator

A visual divider that separates content into clear sections. Accessible to screen readers and supports both horizontal and vertical orientations.

## Anatomy

The Separator is a single component:

```twig
<Separator.Root />
```

## Examples

### Basic Usage

```twig
<div>
    <a href="#">Home</a>
    <a href="#">Pricing</a>

    <twig:BaseUI:Separator />

    <a href="#">Log in</a>
    <a href="#">Sign up</a>
</div>
```

Style using data attributes:

```css
[data-component="separator"] {
    background-color: #e5e7eb;
}

[data-component="separator"][data-orientation="horizontal"] {
    height: 1px;
    width: 100%;
}

[data-component="separator"][data-orientation="vertical"] {
    width: 1px;
    height: 100%;
}
```

### Vertical Separator

Use vertical separators in horizontal layouts:

```twig
<div style="display: flex; gap: 1rem; align-items: center;">
    <a href="#">Home</a>
    <a href="#">Pricing</a>

    <twig:BaseUI:Separator orientation="vertical" />

    <a href="#">Log in</a>
    <a href="#">Sign up</a>
</div>
```

### Decorative Separator

Use decorative separators that are hidden from screen readers:

```twig
<div>
    <h2>Section Title</h2>
    <twig:BaseUI:Separator decorative="true" />
    <p>Section content goes here...</p>
</div>
```

### Separator in a Menu

```twig
<nav>
    <a href="#">Dashboard</a>
    <a href="#">Projects</a>
    <a href="#">Team</a>

    <twig:BaseUI:Separator />

    <a href="#">Settings</a>
    <a href="#">Logout</a>
</nav>
```

## API Reference

### Separator.Root

The separator component.

#### Props

| Prop | Type | Default | Description |
|------|------|---------|-------------|
| `orientation` | `string` | `'horizontal'` | The orientation of the separator (`horizontal` or `vertical`) |
| `decorative` | `bool` | `false` | When `true`, the separator is hidden from screen readers |

#### Data Attributes

| Attribute | Values | Description |
|-----------|--------|-------------|
| `data-component` | `"separator"` | Identifies the component type |
| `data-orientation` | `"horizontal"` \| `"vertical"` | Separator orientation |

#### ARIA Attributes

| Attribute | Values | Description |
|-----------|--------|-------------|
| `role` | `"separator"` | Identifies the element as a separator (only when `decorative` is `false`) |
| `aria-orientation` | `"horizontal"` \| `"vertical"` | Indicates the separator orientation (only when `decorative` is `false`) |

## Styling Examples

### Basic Styling

```css
[data-component="separator"] {
    border: none;
    background-color: #e5e7eb;
}

/* Horizontal separator */
[data-component="separator"][data-orientation="horizontal"] {
    height: 1px;
    width: 100%;
    margin: 1rem 0;
}

/* Vertical separator */
[data-component="separator"][data-orientation="vertical"] {
    width: 1px;
    height: 1.5rem;
    margin: 0 0.5rem;
}
```

### Styled Separator with Shadow

```css
[data-component="separator"][data-orientation="horizontal"] {
    height: 1px;
    background: linear-gradient(to right, transparent, #d1d5db, transparent);
}
```

### Dotted Separator

```css
[data-component="separator"][data-orientation="horizontal"] {
    height: 2px;
    background-image: repeating-linear-gradient(
        to right,
        #d1d5db 0,
        #d1d5db 4px,
        transparent 4px,
        transparent 8px
    );
}
```

## Implementation Notes

**No JavaScript Required:**
The Separator component is purely presentational and does not require any JavaScript or Stimulus controller. It renders semantic HTML with appropriate ARIA attributes.

**Accessibility:**
- When `decorative` is `false` (default), the separator has `role="separator"` and `aria-orientation` for screen readers
- When `decorative` is `true`, the separator has `role="none"` and is hidden from assistive technologies
- Use `decorative="true"` for visual-only separators that don't convey meaning

**Orientation:**
- **Horizontal** (default): Use for separating vertical content (paragraphs, sections, menu items)
- **Vertical**: Use for separating horizontal content (navigation items, inline elements)

**Styling:**
The component is completely unstyled by default. Use the `data-component` and `data-orientation` attributes to apply your own styles. The separator automatically adapts its ARIA attributes based on orientation.
