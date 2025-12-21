# Reactic Base UI

A headless component library for Symfony and Twig, built on Base UI principles. This library provides unstyled, accessible UI components that give you complete control over styling while handling complex functionality, state management, and accessibility out of the box.

Perfect for building custom design systems without fighting against opinionated styles.

## Features

- **Headless Components**: Unstyled components with full control over appearance
- **Accessibility First**: ARIA attributes and keyboard navigation built-in
- **Symfony Integration**: Built with Symfony UX Twig Components
- **Stimulus Controllers**: JavaScript interactivity powered by Stimulus
- **Flexible Styling**: Use Tailwind, CSS, or any styling solution
- **Production Ready**: Type-safe, tested, and optimized

## Requirements

- PHP 8.2 or higher
- Symfony 7.4 or higher
- Symfony UX Twig Component ^2.31
- Symfony Stimulus Bundle ^2.0

## Installation

### 1. Clone the bundle into your project

First, create a `bundle` directory at the root of your Symfony project and clone the repository:

```bash
# Create bundle directory if it doesn't exist
mkdir -p bundle

# Clone the repository into bundle/base-ui
cd bundle
git clone https://github.com/reactic/base-ui.git base-ui

# Or if you already have it, pull latest changes
cd base-ui
git pull origin main
cd ../..
```

### 2. Install the bundle via Composer

For local development (from `bundle/` directory), add the repository to your `composer.json`:

```json
// composer.json
{
    "repositories": [
        {
            "type": "path",
            "url": "bundle/base-ui"
        }
    ],
    "require": {
        "reactic/base-ui": "@dev"
    }
}
```

Then install the bundle:

```bash
composer require reactic/base-ui:@dev
```

### 3. Add assets dependency

Add the following line to your `package.json` in the `dependencies` section:

```json
"@reactic/base-ui": "file:vendor/reactic/base-ui/assets"
```

**Complete example:**
```json
{
  "dependencies": {
    "@reactic/base-ui": "file:vendor/reactic/base-ui/assets",
    "other-package": "^1.0.0"
  }
}
```

Then install the assets:

```bash
npm install
```

### 4. Enable the bundle

The bundle should be automatically enabled via Symfony Flex. If not, add it manually:

```php
// config/bundles.php
return [
    // ...
    Reactic\BaseUi\BaseUiBundle::class => ['all' => true],
];
```

### 5. Install Stimulus controllers (for interactive components)

```bash
php bin/console importmap:require @hotwired/stimulus
```

The Accordion controller will be automatically registered via the bundle's `controllers.json`.

## Configuration

No configuration is required! The bundle works out of the box.

The bundle automatically:
- Registers Twig templates under the `@BaseUi` namespace
- Configures Twig Components under the `BaseUI:` prefix
- Loads Stimulus controllers for interactive components

## Available Components

### Button

A fully accessible button component with flexible rendering options.

**Props:**
- `disabled` (bool): Disable the button (default: `false`)
- `focusableWhenDisabled` (bool): Keep button focusable when disabled (default: `false`)
- `tag` (string): HTML tag to render (`button`, `a`, `div`, etc.) (default: `button`)
- `type` (string): Button type attribute (default: `button`)
- `label` (string): Button text (default: `click me`)

**Example:**

```twig
{# Basic button #}
<twig:BaseUI:Button label="Click me" />

{# Disabled button #}
<twig:BaseUI:Button label="Save" disabled />

{# Button with custom content #}
<twig:BaseUI:Button>
    <svg>...</svg>
    Save Changes
</twig:BaseUI:Button>

{# Render as link #}
<twig:BaseUI:Button tag="a" label="Learn More" />

{# With custom classes #}
<twig:BaseUI:Button
    label="Submit"
    class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded"
/>
```

### Accordion

A collapsible accordion component with full keyboard navigation and ARIA support.

**Components:**
- `BaseUI:Accordion` - Container
- `BaseUI:AccordionItem` - Individual accordion item
- `BaseUI:AccordionHeader` - Header wrapper
- `BaseUI:AccordionTrigger` - Clickable trigger
- `BaseUI:AccordionPanel` - Collapsible content

**Example:**

```twig
<twig:BaseUI:Accordion>
    <twig:BaseUI:AccordionItem value="item-1">
        <twig:BaseUI:AccordionHeader>
            <twig:BaseUI:AccordionTrigger>
                What is Base UI?
            </twig:BaseUI:AccordionTrigger>
        </twig:BaseUI:AccordionHeader>
        <twig:BaseUI:AccordionPanel>
            Base UI is a headless component library that provides
            unstyled, accessible components.
        </twig:BaseUI:AccordionPanel>
    </twig:BaseUI:AccordionItem>

    <twig:BaseUI:AccordionItem value="item-2">
        <twig:BaseUI:AccordionHeader>
            <twig:BaseUI:AccordionTrigger>
                How do I style it?
            </twig:BaseUI:AccordionTrigger>
        </twig:BaseUI:AccordionHeader>
        <twig:BaseUI:AccordionPanel>
            Use CSS classes, Tailwind, or any styling solution you prefer!
        </twig:BaseUI:AccordionPanel>
    </twig:BaseUI:AccordionItem>
</twig:BaseUI:Accordion>
```

**With Tailwind styling:**

```twig
<twig:BaseUI:Accordion class="space-y-2">
    <twig:BaseUI:AccordionItem value="faq-1" class="border rounded-lg">
        <twig:BaseUI:AccordionHeader>
            <twig:BaseUI:AccordionTrigger class="w-full px-4 py-3 text-left font-medium hover:bg-gray-50">
                Question 1
            </twig:BaseUI:AccordionTrigger>
        </twig:BaseUI:AccordionHeader>
        <twig:BaseUI:AccordionPanel class="px-4 py-3 text-gray-600">
            Answer 1
        </twig:BaseUI:AccordionPanel>
    </twig:BaseUI:AccordionItem>
</twig:BaseUI:Accordion>
```

### Separator

A semantic separator/divider component.

**Example:**

```twig
{# Horizontal separator #}
<twig:BaseUI:Separator />

{# With custom styling #}
<twig:BaseUI:Separator class="my-8 border-gray-300" />
```

## Styling Components

All components are **completely unstyled** by default. This gives you full control over the appearance.

### Using CSS Classes

```twig
<twig:BaseUI:Button
    label="Click me"
    class="btn btn-primary"
/>
```

### Using Tailwind CSS

```twig
<twig:BaseUI:Button
    label="Submit"
    class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded"
/>
```

### Using Data Attributes

Components expose data attributes for styling hooks:

```twig
<twig:BaseUI:Button label="Click me" />
{# Renders: <button data-component="button" data-disabled="false">...</button> #}
```

```css
/* Style via data attributes */
[data-component="button"] {
    padding: 0.5rem 1rem;
    border-radius: 0.25rem;
}

[data-component="button"][data-disabled="true"] {
    opacity: 0.5;
    cursor: not-allowed;
}
```

## Advanced Usage

### Custom Component Content

All components support custom content via blocks:

```twig
<twig:BaseUI:Button>
    {% block content %}
        <svg class="w-4 h-4 mr-2">...</svg>
        <span>Save</span>
    {% endblock %}
</twig:BaseUI:Button>
```

### Passing Additional Attributes

Use the `attributes` object to pass any HTML attribute:

```twig
<twig:BaseUI:Button
    label="Click"
    id="my-button"
    data-action="click->modal#open"
    aria-label="Open modal"
/>
```

## Development

### Project Structure

```
bundle/base-ui/
├── assets/
│   ├── controllers/          # Stimulus controllers
│   │   └── accordion_controller.js
│   └── styles/              # Optional CSS examples
│       ├── accordion.css
│       └── separator.css
├── config/
│   └── services.php         # Service configuration
├── src/
│   ├── BaseUiBundle.php     # Bundle class
│   └── Component/           # PHP component classes
│       ├── Accordion/
│       ├── Button/
│       └── Separator/
├── templates/
│   ├── components/BaseUI/   # Twig templates
│   └── exemple/             # Usage examples
└── composer.json
```

### Adding New Components

1. Create PHP component class:

```php
// src/Component/MyComponent/MyComponent.php
namespace Reactic\BaseUi\Component\MyComponent;

use Symfony\UX\TwigComponent\Attribute\AsTwigComponent;

#[AsTwigComponent(
    name: 'BaseUI:MyComponent',
    template: '@BaseUi/components/BaseUI/MyComponent/MyComponent.html.twig'
)]
class MyComponent
{
    public string $myProp = 'default value';
}
```

2. Create Twig template:

```twig
{# templates/components/BaseUI/MyComponent/MyComponent.html.twig #}
<div {{ attributes }}>
    {{ myProp }}
</div>
```

3. Use in your templates:

```twig
<twig:BaseUI:MyComponent myProp="Hello!" />
```

## Accessibility

All components follow WAI-ARIA best practices:

- **Button**: Proper ARIA attributes, keyboard support, focus management
- **Accordion**: ARIA expanded/collapsed states, keyboard navigation (Arrow Up/Down, Home/End)
- **Separator**: Semantic `<hr>` with proper ARIA role

## License

MIT License - see LICENSE file for details

## Author

**Nicolas Facciolo**
Email: nicolas@reactic.io

## Contributing

Contributions are welcome! Please feel free to submit a Pull Request.

## Support

For issues, questions, or suggestions, please open an issue on the project repository.
