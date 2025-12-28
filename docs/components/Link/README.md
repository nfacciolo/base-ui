# Link

A navigation link component with built-in support for external links, disabled states, active states, and accessibility features.

## Setup

### Stimulus Controller Registration

The Link component requires a Stimulus controller for interactive disabled state handling. Add it to your `assets/controllers.json`:

```json
{
  "controllers": {
    "@reactic/base-ui": {
      "link": {
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
<twig:BaseUI:Link href="/path">
    Click me
</twig:BaseUI:Link>
```

## Examples

### Basic Usage

```twig
<twig:BaseUI:Link href="/about">
    About Us
</twig:BaseUI:Link>
```

The link renders with no styles by default. Use data attributes or add custom classes for styling:

```css
/* Style via data attributes */
[data-component="link"] {
    color: blue;
    text-decoration: underline;
}
```

```twig
{# Or add custom classes #}
<twig:BaseUI:Link href="/contact" class="text-primary">
    Contact
</twig:BaseUI:Link>
```

### External Links

External links automatically open in a new tab and include security attributes:

```twig
<twig:BaseUI:Link href="https://example.com" external="true">
    Visit Example.com
</twig:BaseUI:Link>
```

**What happens automatically:**
- Adds `target="_blank"` to open in new tab
- Adds `rel="noopener noreferrer"` for security (prevents reverse tabnabbing)
- Sets `data-external="true"` for custom styling (e.g., adding an external icon)

**Security note:** Always use `external="true"` for links to other domains to prevent security vulnerabilities.

### Disabled Links

Links can be disabled to prevent navigation, similar to disabled buttons:

```twig
<twig:BaseUI:Link
    href="/premium-feature"
    disabled="true"
    title="Upgrade to access this feature"
>
    Premium Feature
</twig:BaseUI:Link>
```

**When to use:**
- Conditional access based on user permissions
- Loading states during navigation
- Features requiring prerequisites

**Technical implementation:**
Disabled links use a modern, standards-compliant Stimulus controller approach:
- Sets `aria-disabled="true"` for screen readers
- Sets `tabindex="-1"` to remove from keyboard navigation
- Uses CSS `pointer-events: none` to prevent mouse clicks
- Stimulus controller provides programmatic prevention (click + keyboard)
- Maintains original `href` for better accessibility

**Setup automatique:**
Le composant Link utilise un Stimulus controller qui est automatiquement enregistré via Symfony UX. Aucune configuration manuelle n'est nécessaire.

Si vous utilisez Webpack Encore, le controller sera chargé automatiquement lors de la compilation des assets.

### Active Links

Mark links as active when they correspond to the current page:

```twig
{# In your navigation template #}
<nav>
    <twig:BaseUI:Link
        href="/dashboard"
        active="{{ app.request.pathInfo == '/dashboard' }}"
    >
        Dashboard
    </twig:BaseUI:Link>

    <twig:BaseUI:Link
        href="/settings"
        active="{{ app.request.pathInfo == '/settings' }}"
    >
        Settings
    </twig:BaseUI:Link>
</nav>
```

**What happens automatically:**
- Adds `aria-current="page"` for screen readers
- Sets `data-active="true"` for custom styling
- Improves navigation clarity for all users

### Underline Control

Control when links are underlined for better design flexibility while maintaining accessibility:

```twig
{# Always underlined (default, best for accessibility) #}
<twig:BaseUI:Link href="/page" underline="always">
    Always Underlined
</twig:BaseUI:Link>

{# Underlined on hover only #}
<twig:BaseUI:Link href="/page" underline="hover">
    Hover to See Underline
</twig:BaseUI:Link>

{# No underline (use sparingly, ensure links are visually distinct) #}
<twig:BaseUI:Link href="/page" underline="none" class="btn btn-link">
    Button-styled Link
</twig:BaseUI:Link>
```

**Accessibility warning:** When using `underline="none"`, ensure links are visually distinguishable from regular text through color, weight, or other visual cues. Color alone is not sufficient (WCAG 2.1).

### Download Links

Force download of resources:

```twig
{# Basic download #}
<twig:BaseUI:Link href="/files/report.pdf" download="true">
    Download Report
</twig:BaseUI:Link>

{# Download with custom filename #}
<twig:BaseUI:Link href="/files/report.pdf" download="Q4-Report.pdf">
    Download Q4 Report
</twig:BaseUI:Link>
```

### Preserve Scroll Position

In single-page applications, preserve scroll position during navigation:

```twig
<twig:BaseUI:Link href="/products" preserveScroll="true">
    View Products
</twig:BaseUI:Link>
```

**Use case:** Useful when navigating between pages where maintaining the user's scroll position improves UX (e.g., returning from a detail page to a list).

### Navigation with Custom Target

```twig
{# Open in new tab (prefer using external="true" instead) #}
<twig:BaseUI:Link href="/help" target="_blank" rel="noopener noreferrer">
    Help Center
</twig:BaseUI:Link>

{# Other targets #}
<twig:BaseUI:Link href="/content" target="_parent">
    Parent Frame
</twig:BaseUI:Link>
```

**Best practice:** Use `external="true"` instead of manually setting `target="_blank"` to ensure proper security attributes.

## API Reference

### Props

| Prop | Type | Default | Description |
|------|------|---------|-------------|
| `href` | `string` | *required* | The destination URL |
| `external` | `bool` | `false` | Whether the link is external. Automatically adds `target="_blank"` and `rel="noopener noreferrer"` |
| `disabled` | `bool` | `false` | Whether the link should be disabled (prevents navigation) |
| `active` | `bool` | `false` | Whether the link represents the current page. Adds `aria-current="page"` |
| `underline` | `string` | `'always'` | When to show underline: `'always'`, `'hover'`, or `'none'` |
| `preserveScroll` | `bool` | `false` | Preserve scroll position during navigation (SPA only) |
| `target` | `string` | `null` | Where to open the linked document (`_blank`, `_self`, `_parent`, `_top`) |
| `download` | `string\|bool` | `false` | Forces download. If string, specifies the filename |
| `rel` | `string` | `null` | Relationship between current and linked document |
| `title` | `string` | `null` | Tooltip text displayed on hover |

**Note:** Standard HTML attributes like `class`, `id`, `data-*`, etc. are automatically passed through via Twig Component's `{{ attributes }}` and don't need to be explicitly defined as props.

### Data Attributes

The component exposes these data attributes for styling:

| Attribute | Values | Description |
|-----------|--------|-------------|
| `data-component` | `"link"` | Identifies the component type |
| `data-disabled` | `"true"` \| `"false"` | Reflects the disabled state |
| `data-external` | `"true"` \| `"false"` | Indicates if the link is external |
| `data-active` | `"true"` \| `"false"` | Indicates if the link represents the current page |
| `data-underline` | `"always"` \| `"hover"` \| `"none"` | Indicates the underline behavior |

### ARIA Attributes

Automatically applied based on props:

- `aria-disabled="true"` - When `disabled=true`
- `aria-current="page"` - When `active=true`
- `rel="noopener noreferrer"` - When `external=true`

## Styling Examples

### Using Data Attributes

```css
/* Base link styles */
[data-component="link"] {
    color: #0066cc;
    transition: color 0.2s;
}

[data-component="link"]:hover {
    color: #0052a3;
}

/* Disabled state */
[data-component="link"][data-disabled="true"] {
    color: #999;
    cursor: not-allowed;
    pointer-events: none;
}

/* Active state */
[data-component="link"][data-active="true"] {
    color: #000;
    font-weight: 600;
}

/* External link with icon */
[data-component="link"][data-external="true"]::after {
    content: " ↗";
    font-size: 0.8em;
}

/* Underline control */
[data-component="link"][data-underline="always"] {
    text-decoration: underline;
}

[data-component="link"][data-underline="hover"] {
    text-decoration: none;
}

[data-component="link"][data-underline="hover"]:hover {
    text-decoration: underline;
}

[data-component="link"][data-underline="none"] {
    text-decoration: none;
}
```

### Using Custom Classes

```twig
<twig:BaseUI:Link href="/page" class="nav-link">Navigation</twig:BaseUI:Link>
<twig:BaseUI:Link href="/page" class="btn-link">Button Style</twig:BaseUI:Link>
```

```css
.nav-link {
    color: #333;
    text-decoration: none;
    padding: 8px 16px;
    border-radius: 4px;
}

.nav-link:hover {
    background: #f0f0f0;
}

.btn-link {
    display: inline-block;
    padding: 8px 16px;
    background: blue;
    color: white;
    text-decoration: none;
    border-radius: 4px;
}
```

### Combining Both Approaches

```twig
<nav class="main-nav">
    <twig:BaseUI:Link
        href="/dashboard"
        class="nav-item"
        active="{{ currentPage == 'dashboard' }}"
    >
        Dashboard
    </twig:BaseUI:Link>
</nav>
```

```css
/* Your custom classes */
.nav-item {
    padding: 12px 24px;
    text-decoration: none;
}

/* Enhance with data attribute selectors */
.nav-item[data-active="true"] {
    background: #e3f2fd;
    border-left: 3px solid #1976d2;
}
```

## Accessibility Guidelines

### Do's ✓
- **Always** ensure links are visually distinguishable from text (underline, color + weight, or other visual cues)
- **Use** descriptive link text ("Read our privacy policy" not "Click here")
- **Use** `title` attribute to provide additional context when helpful
- **Use** `external="true"` for all external links
- **Use** `active="true"` for current page links in navigation

### Don'ts ✗
- **Don't** rely on color alone to distinguish links (WCAG violation)
- **Don't** use generic link text like "Click here" or "Read more"
- **Don't** manually set `target="_blank"` without `rel="noopener noreferrer"`
- **Don't** disable links without providing an explanation (use `title` attribute)
- **Don't** use links for actions (use Button component instead)

### When to Use Link vs Button

**Use Link when:**
- Navigating to another page or section
- Opening external resources
- Downloading files

**Use Button when:**
- Submitting forms
- Triggering actions (open modal, toggle state)
- Any JavaScript-driven interaction

**Rule of thumb:** If pressing the back button should undo the action, use a Button. If the back button should return to the previous page, use a Link.

## Implementation Details

### Why Not `javascript:void(0)`?

You might wonder why we don't use `href="javascript:void(0)"` for disabled links. Here's why:

**❌ Problems with `javascript:` URLs:**
- **CSP (Content Security Policy)**: Blocked by modern security policies
- **SEO**: Flagged as bad practice by search engines
- **Accessibility**: Can cause issues with screen readers
- **Standards**: Discouraged by W3C and modern web standards
- **Security**: Opens potential XSS attack vectors

**✅ Our Recommended Approach:**
- Maintains original `href` for semantic meaning
- Uses `aria-disabled` for assistive technologies
- Removes from tab order with `tabindex="-1"`
- Prevents clicks via CSS `pointer-events: none`
- JavaScript fallback for edge cases
- Fully compliant with WCAG 2.1 and modern standards

This approach provides the best accessibility, security, and standards compliance.

## Best Practices

### Security
```twig
{# ✓ Good: External link with automatic security #}
<twig:BaseUI:Link href="https://external.com" external="true">
    External Site
</twig:BaseUI:Link>

{# ✗ Bad: Manual target without security attributes #}
<a href="https://external.com" target="_blank">
    External Site
</a>
```

### Accessibility
```twig
{# ✓ Good: Descriptive link text #}
<twig:BaseUI:Link href="/privacy">
    Read our privacy policy
</twig:BaseUI:Link>

{# ✗ Bad: Generic link text #}
<twig:BaseUI:Link href="/privacy">
    Click here
</twig:BaseUI:Link>
```

### Navigation
```twig
{# ✓ Good: Active state for current page #}
<twig:BaseUI:Link
    href="/settings"
    active="{{ currentPage == 'settings' }}"
>
    Settings
</twig:BaseUI:Link>

{# ✗ Bad: No indication of current page #}
<twig:BaseUI:Link href="/settings">
    Settings
</twig:BaseUI:Link>
```
