# Link Component Tests

## Test Cases

### Basic Functionality
- [ ] Test basic link renders with href
- [ ] Test link content is displayed correctly
- [ ] Test link accepts custom classes via attributes

### External Links
- [ ] Test external link adds `target="_blank"`
- [ ] Test external link adds `rel="noopener noreferrer"`
- [ ] Test external link sets `data-external="true"`

### Disabled State
- [ ] Test disabled link adds `aria-disabled="true"`
- [ ] Test disabled link prevents navigation (onclick preventDefault)
- [ ] Test disabled link sets `data-disabled="true"`
- [ ] Test disabled link maintains href for accessibility

### Active State
- [ ] Test active link adds `aria-current="page"`
- [ ] Test active link sets `data-active="true"`

### Underline Control
- [ ] Test underline="always" sets `data-underline="always"`
- [ ] Test underline="hover" sets `data-underline="hover"`
- [ ] Test underline="none" sets `data-underline="none"`

### Download Attribute
- [ ] Test download="true" adds download attribute
- [ ] Test download="filename.pdf" adds download attribute with filename

### Data Attributes
- [ ] Test `data-component="link"` is always present
- [ ] Test all data-attributes are correctly set based on props

### ARIA Attributes
- [ ] Test aria-disabled when disabled=true
- [ ] Test aria-current when active=true
- [ ] Test no unnecessary ARIA attributes on basic link

## Manual Testing Checklist

1. **Basic Link**
   ```twig
   <twig:BaseUI:Link href="/about">About</twig:BaseUI:Link>
   ```
   - Should render clickable link
   - Should navigate to /about

2. **External Link**
   ```twig
   <twig:BaseUI:Link href="https://example.com" external="true">Example</twig:BaseUI:Link>
   ```
   - Should open in new tab
   - Should have external icon (if CSS is applied)

3. **Disabled Link**
   ```twig
   <twig:BaseUI:Link href="/premium" disabled="true" title="Upgrade required">Premium</twig:BaseUI:Link>
   ```
   - Should NOT navigate when clicked
   - Should show disabled styling
   - Should show tooltip on hover

4. **Active Link**
   ```twig
   <twig:BaseUI:Link href="/current" active="true">Current Page</twig:BaseUI:Link>
   ```
   - Should have active styling
   - Screen reader should announce "current page"

5. **Download Link**
   ```twig
   <twig:BaseUI:Link href="/file.pdf" download="report.pdf">Download</twig:BaseUI:Link>
   ```
   - Should download file instead of navigating
   - Should use custom filename "report.pdf"
