# README Ideas - Symfony Base UI

## Core Concepts to Include

### 1. Headless Architecture - Data Attributes First

**Key principle:** Zero CSS classes by default, style via data-attributes

```twig
{# Component renders #}
<button data-component="button" data-disabled="true">
    Click me
</button>
```

**Why this approach:**
- ✅ No CSS pollution - completely unstyled by default
- ✅ Clear styling hooks via data-attributes
- ✅ User has full control - can use data-attributes OR add their own classes
- ✅ Semantic - data-attributes describe state, not style

**User styling options:**

```css
/* Option 1: Style via data-attributes */
[data-component="button"][data-disabled="true"] {
    opacity: 0.5;
    cursor: not-allowed;
}

/* Option 2: Add custom classes */
```

```twig
<twig:BaseUI:Button class="btn btn-primary" />
```

**Inspired by:** Radix UI, Base UI (modern approach)

---

## Other Important Points to Cover

### 2. Philosophy
- Headless = functionality without opinions
- Accessibility first (ARIA, keyboard navigation)
- Component state management handled internally
- Perfect foundation for custom design systems

### 3. Installation & Requirements
- Composer installation
- PHP 8.2+, Symfony 7.2+
- symfony/ux-twig-component dependency

### 4. Component API Pattern
Each component exposes:
- Props (configuration)
- Data attributes (styling hooks + state)
- ARIA attributes (accessibility)
- Slots (content injection)

### 5. Examples
- Basic usage with no styles
- Adding custom classes
- Styling via data-attributes
- Building a design system on top

---

## Notes
- Keep README concise and practical
- Show both styling approaches (data-attributes + classes)
- Emphasize "bring your own styles" philosophy
- Mention this works with any CSS methodology (BEM, Tailwind, CSS Modules, etc.)
