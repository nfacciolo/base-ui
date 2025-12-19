# Accordion

A set of collapsible panels with headings. Allows users to expand and collapse sections of content.

## Anatomy

The Accordion is composed of multiple sub-components that work together:

```twig
<Accordion.Root>
    <Accordion.Item>
        <Accordion.Header>
            <Accordion.Trigger />
        </Accordion.Header>
        <Accordion.Panel />
    </Accordion.Item>
</Accordion.Root>
```

## Examples

### Basic Usage

```twig
<twig:BaseUI:Accordion>
    <twig:BaseUI:AccordionItem value="faq-1">
        <twig:BaseUI:AccordionHeader>
            <twig:BaseUI:AccordionTrigger>
                What payment methods do you accept?
            </twig:BaseUI:AccordionTrigger>
        </twig:BaseUI:AccordionHeader>
        <twig:BaseUI:AccordionPanel>
            We accept Visa, Mastercard, and PayPal.
        </twig:BaseUI:AccordionPanel>
    </twig:BaseUI:AccordionItem>

    <twig:BaseUI:AccordionItem value="faq-2">
        <twig:BaseUI:AccordionHeader>
            <twig:BaseUI:AccordionTrigger>
                How long does shipping take?
            </twig:BaseUI:AccordionTrigger>
        </twig:BaseUI:AccordionHeader>
        <twig:BaseUI:AccordionPanel>
            Standard shipping takes 3-5 business days.
        </twig:BaseUI:AccordionPanel>
    </twig:BaseUI:AccordionItem>
</twig:BaseUI:Accordion>
```

Style using data attributes:

```css
[data-component="accordion"] {
    border: 1px solid #e5e7eb;
}

[data-slot="accordion-item"] {
    border-bottom: 1px solid #e5e7eb;
}

[data-slot="accordion-trigger"] {
    width: 100%;
    padding: 1rem;
    text-align: left;
    background: none;
    border: none;
    cursor: pointer;
}

[data-slot="accordion-trigger"]:hover {
    background-color: #f9fafb;
}

[data-slot="accordion-panel"] {
    padding: 1rem;
}

[data-slot="accordion-panel"][data-state="closed"] {
    display: none;
}
```

### Multiple Panels Open

By default, only one panel can be open at a time. Use `multiple` to allow multiple panels:

```twig
<twig:BaseUI:Accordion multiple="true">
    <twig:BaseUI:AccordionItem value="item-1">
        {# ... #}
    </twig:BaseUI:AccordionItem>
    <twig:BaseUI:AccordionItem value="item-2">
        {# ... #}
    </twig:BaseUI:AccordionItem>
</twig:BaseUI:Accordion>
```

### Default Open Items

Specify which items should be open by default:

```twig
{# Single mode - opens item-1 #}
<twig:BaseUI:Accordion defaultValue="item-1">
    {# ... #}
</twig:BaseUI:Accordion>

{# Multiple mode - opens item-1 and item-2 #}
<twig:BaseUI:Accordion multiple="true" defaultValue="item-1,item-2">
    {# ... #}
</twig:BaseUI:Accordion>
```

### Disabled Items

Disable specific accordion items:

```twig
<twig:BaseUI:AccordionItem value="item-1" disabled="true">
    <twig:BaseUI:AccordionHeader>
        <twig:BaseUI:AccordionTrigger>
            Coming Soon
        </twig:BaseUI:AccordionTrigger>
    </twig:BaseUI:AccordionHeader>
    <twig:BaseUI:AccordionPanel>
        This content is not available yet.
    </twig:BaseUI:AccordionPanel>
</twig:BaseUI:AccordionItem>
```

### Keyboard Navigation

The Accordion supports full keyboard navigation:

- **Tab** - Move focus to the next trigger
- **Shift + Tab** - Move focus to the previous trigger
- **Enter / Space** - Toggle the focused panel
- **Arrow Down** - Move focus to the next trigger
- **Arrow Up** - Move focus to the previous trigger
- **Home** - Move focus to the first trigger
- **End** - Move focus to the last trigger

## API Reference

### Accordion.Root

The root component that manages state for all accordion items.

#### Props

| Prop | Type | Default | Description |
|------|------|---------|-------------|
| `multiple` | `bool` | `false` | Allow multiple panels to be open simultaneously |
| `defaultValue` | `string` | `null` | Default open item value(s). Use comma-separated for multiple mode |
| `disabled` | `bool` | `false` | Disable all accordion items |
| `orientation` | `string` | `'vertical'` | Orientation of the accordion (`vertical` or `horizontal`) |

#### Data Attributes

| Attribute | Values | Description |
|-----------|--------|-------------|
| `data-component` | `"accordion"` | Identifies the component type |
| `data-orientation` | `"vertical"` \| `"horizontal"` | Accordion orientation |
| `data-disabled` | `"true"` \| `"false"` | Whether accordion is disabled |

#### ARIA Attributes

No specific ARIA attributes.

### Accordion.Item

Individual collapsible section within the accordion.

#### Props

| Prop | Type | Default | Description |
|------|------|---------|-------------|
| `value` | `string` | **required** | Unique identifier for this item |
| `disabled` | `bool` | `false` | Disable this specific item |

#### Data Attributes

| Attribute | Values | Description |
|-----------|--------|-------------|
| `data-slot` | `"accordion-item"` | Identifies the component slot |
| `data-state` | `"open"` \| `"closed"` | Current state of the item |
| `data-disabled` | `"true"` \| `"false"` | Whether item is disabled |

#### ARIA Attributes

No specific ARIA attributes.

### Accordion.Header

Wrapper for the trigger. Required for proper ARIA structure.

#### Props

No specific props - acts as a semantic container.

#### Data Attributes

| Attribute | Values | Description |
|-----------|--------|-------------|
| `data-slot` | `"accordion-header"` | Identifies the component slot |

#### ARIA Attributes

| Attribute | Values | Description |
|-----------|--------|-------------|
| `role` | `"heading"` | Identifies as heading |
| `aria-level` | `"3"` | Heading level (configurable) |

### Accordion.Trigger

Button that toggles the accordion panel.

#### Props

No specific props - automatically handles click and keyboard events.

#### Data Attributes

| Attribute | Values | Description |
|-----------|--------|-------------|
| `data-slot` | `"accordion-trigger"` | Identifies the component slot |
| `data-state` | `"open"` \| `"closed"` | Current state of associated panel |
| `data-disabled` | `"true"` \| `"false"` | Whether trigger is disabled |

#### ARIA Attributes

| Attribute | Values | Description |
|-----------|--------|-------------|
| `aria-expanded` | `"true"` \| `"false"` | Indicates if panel is expanded |
| `aria-controls` | `string` | ID of the controlled panel |
| `aria-disabled` | `"true"` | When trigger is disabled |

### Accordion.Panel

Collapsible content area.

#### Props

No specific props - visibility is controlled by the accordion state.

#### Data Attributes

| Attribute | Values | Description |
|-----------|--------|-------------|
| `data-slot` | `"accordion-panel"` | Identifies the component slot |
| `data-state` | `"open"` \| `"closed"` | Current visibility state |

#### ARIA Attributes

| Attribute | Values | Description |
|-----------|--------|-------------|
| `role` | `"region"` | Identifies as content region |
| `aria-labelledby` | `string` | ID of the trigger heading |
| `hidden` | - | When panel is closed (if not using CSS display:none) |

## Styling Examples

### Basic Styling

```css
/* Container */
[data-component="accordion"] {
    border: 1px solid #e5e7eb;
    border-radius: 0.5rem;
}

/* Item separator */
[data-slot="accordion-item"]:not(:last-child) {
    border-bottom: 1px solid #e5e7eb;
}

/* Trigger button */
[data-slot="accordion-trigger"] {
    width: 100%;
    padding: 1rem 1.5rem;
    text-align: left;
    background: white;
    border: none;
    font-weight: 500;
    cursor: pointer;
    transition: background-color 0.2s;
}

[data-slot="accordion-trigger"]:hover:not([data-disabled="true"]) {
    background-color: #f9fafb;
}

[data-slot="accordion-trigger"][data-disabled="true"] {
    opacity: 0.5;
    cursor: not-allowed;
}

/* Panel content */
[data-slot="accordion-panel"] {
    padding: 1rem 1.5rem;
}

[data-slot="accordion-panel"][data-state="closed"] {
    display: none;
}
```

### Animated Accordion

```css
[data-slot="accordion-panel"] {
    overflow: hidden;
    transition: max-height 0.3s ease-out;
}

[data-slot="accordion-panel"][data-state="closed"] {
    max-height: 0;
}

[data-slot="accordion-panel"][data-state="open"] {
    max-height: 500px; /* Adjust based on content */
}
```

### Icon Rotation on Open

```css
[data-slot="accordion-trigger"]::after {
    content: "▼";
    float: right;
    transition: transform 0.2s;
}

[data-slot="accordion-trigger"][data-state="open"]::after {
    transform: rotate(180deg);
}
```

## Implementation Notes

**State Management:**
The Accordion component uses a Stimulus controller for state management (expanding/collapsing panels). The controller handles user interactions, keyboard navigation, and updates the appropriate data attributes.

**Unique Values:**
Each `AccordionItem` must have a unique `value` prop. This is used to track which items are open.

**Accessibility:**
The component structure ensures proper ARIA attributes are applied. The Header > Trigger hierarchy is required for screen readers to properly announce the accordion structure.

**Animation:**
Smooth animations can be added via CSS transitions on the `data-state` attribute. For height animations, consider using CSS `max-height` or JavaScript-based solutions.
