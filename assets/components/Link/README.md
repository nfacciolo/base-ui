# Link Component Assets

This directory contains the CSS file for the Link component. The JavaScript functionality is handled by a Stimulus controller that is automatically registered via Symfony UX.

## Files

- **`link.css`** - Base styles for the Link component, including disabled state handling

## Usage

### 1. Stimulus Controller (Automatic)

The Link component uses a Stimulus controller (`reactic--base-ui--link`) that is automatically registered and loaded via Symfony UX and Webpack Encore. No manual setup is required.

### 2. CSS Styling (Optional)

The base styles are already included if you're using the base-ui bundle. To customize or override styles:

```css
/* In your custom CSS */
[data-component="link"] {
    /* Your custom link styles */
}
```

### 3. Custom Styling

You can override the default styles by adding your own CSS after including `link.css`:

```css
/* Your custom styles */
[data-component="link"] {
    color: #custom-color;
}

[data-component="link"][data-disabled="true"] {
    opacity: 0.4; /* Override default opacity */
}
```

## How It Works

### CSS (`link.css`)

- Uses `pointer-events: none` to prevent mouse clicks on disabled links
- Provides visual feedback with opacity and cursor changes
- Includes optional styles for external links, active states, and underline control

### Stimulus Controller (`link_controller.js`)

The Link component uses a Stimulus controller for enhanced interactivity:

- **Automatic Registration**: Controller is registered via `@reactic/base-ui` namespace
- **Scoped Behavior**: Each link instance has its own controller
- **Event Handling**: Prevents navigation on click and keyboard events (Enter/Space) when disabled
- **Reactive Values**: `disabled` state is automatically tracked via Stimulus values
- **Lifecycle Management**: Stimulus handles mounting/unmounting automatically

**Controller Actions**:
- `handleClick(event)` - Prevents navigation on mouse clicks
- `handleKeydown(event)` - Prevents navigation on Enter/Space keys

## Browser Support

- **Modern Browsers**: Full support (Chrome, Firefox, Safari, Edge)
- **Stimulus**: Requires modern browser with ES6 support
- **pointer-events**: Supported in all modern browsers

## Standards Compliance

This implementation follows:
- **WCAG 2.1** - Accessibility guidelines
- **W3C Standards** - Modern web standards
- **Symfony UX Best Practices** - Uses Stimulus for component behavior
- **CSP Compliant** - No inline JavaScript in HTML
- **Best Practices** - Avoids deprecated patterns like `javascript:void(0)`

## Performance

- **Minimal overhead**: Event delegation used for efficiency
- **No dependencies**: Pure vanilla JavaScript
- **Lightweight**: Combined CSS + JS < 2KB minified

## Customization

You can modify the behavior by editing these files:

1. **Change disabled styling**: Edit `link.css`
2. **Add custom event handlers**: Extend `link.js`
3. **Disable specific features**: Comment out sections in the files

Example - Disable external link indicator:

```css
/* In your custom CSS */
[data-component="link"][data-external="true"]::after {
    display: none;
}
```
