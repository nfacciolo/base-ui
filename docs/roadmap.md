# Symfony Base UI - Component Roadmap

List of components to implement, inspired by Base UI and Radix UI.

## Status Legend
- ✅ **Implemented** - Component is ready
- 🚧 **In Progress** - Currently being developed
- 📋 **Planned** - Not started yet

---

## Components

### ✅ Button
Interactive button that can be rendered as different tags and focusable when disabled.

**Key features:**
- `disabled` prop
- `focusableWhenDisabled` for accessibility
- `tag` prop for custom rendering
- ARIA attributes and data attributes for styling

**Status:** ✅ Implemented
**Doc:** [button.md](./button.md)

---

### ✅ Separator (Divider)
Semantic content separator with customizable orientation.

**Key features:**
- Horizontal/vertical orientation
- Optional label
- ARIA separator role

**Status:** ✅ Implemented

---

### 📋 Accordion
Vertically stacked sections that can be expanded/collapsed.

**Key features:**
- Single or multiple items expanded
- Keyboard navigation (Arrow keys, Home/End)
- ARIA accordion pattern
- Controlled/uncontrolled state

**Inspired by:**
- Base UI: https://base-ui.com/react/components/accordion
- Radix UI: https://www.radix-ui.com/primitives/docs/components/accordion

**Components needed:**
- `Accordion` (root)
- `AccordionItem`
- `AccordionTrigger`
- `AccordionPanel`

---

### 📋 Alert Dialog
Modal dialog that interrupts user workflow to communicate important information.

**Key features:**
- Focus trap
- Escape key to close
- Click outside to close (optional)
- ARIA alertdialog role
- Portal rendering (outside DOM hierarchy)

**Inspired by:**
- Base UI: https://base-ui.com/react/components/alert-dialog
- Radix UI: https://www.radix-ui.com/primitives/docs/components/alert-dialog

**Components needed:**
- `AlertDialog` (root)
- `AlertDialogTrigger`
- `AlertDialogPortal`
- `AlertDialogOverlay`
- `AlertDialogContent`
- `AlertDialogTitle`
- `AlertDialogDescription`
- `AlertDialogAction`
- `AlertDialogCancel`

---

### 📋 Dialog
Modal dialog for presenting content that requires user interaction.

**Key features:**
- Focus trap
- Escape key to close
- Click outside to close (optional)
- ARIA dialog role
- Portal rendering
- Scroll lock on body

**Inspired by:**
- Base UI: https://base-ui.com/react/components/dialog
- Radix UI: https://www.radix-ui.com/primitives/docs/components/dialog

**Components needed:**
- `Dialog` (root)
- `DialogTrigger`
- `DialogPortal`
- `DialogOverlay`
- `DialogContent`
- `DialogTitle`
- `DialogDescription`
- `DialogClose`

---

### 📋 Switch
Toggle switch for binary states (on/off).

**Key features:**
- Checked/unchecked state
- Disabled state
- Keyboard navigation (Space to toggle)
- ARIA switch role
- Form integration (hidden input)

**Inspired by:**
- Base UI: https://base-ui.com/react/components/switch
- Radix UI: https://www.radix-ui.com/primitives/docs/components/switch

**Components needed:**
- `Switch` (single component)

---

## Implementation Priority

### Phase 1 - Essential Components
1. ✅ Button
2. ✅ Separator
3. 📋 Switch

### Phase 2 - Interactive Components
4. 📋 Accordion
5. 📋 Dialog

### Phase 3 - Advanced Modals
6. 📋 Alert Dialog

---

## Technical Considerations

### Symfony/Twig Challenges

Some React-specific patterns need adaptation:

**1. State Management**
- React: Internal state with hooks
- Twig: Stimulus controllers or Alpine.js for interactivity

**2. Portal Rendering**
- React: `createPortal` to render outside DOM
- Twig: Teleport with Stimulus or append to body with JS

**3. Focus Trap**
- Requires JavaScript implementation (Stimulus controller or external library)

**4. Event Handling**
- React: Synthetic events, callbacks
- Twig: Native events, Stimulus actions

### Recommended Stack for Interactive Components

```
Twig Component (PHP)  →  Renders HTML structure + data attributes
         ↓
Stimulus Controller   →  Handles interactivity, state, events
         ↓
CSS (user-provided)   →  Styling
```

---

## Notes

- All components follow **headless** principles (unstyled by default)
- Use **data attributes** for styling hooks
- Implement **ARIA attributes** for accessibility
- Provide **keyboard navigation** where applicable
- Keep components **composable** and **flexible**
