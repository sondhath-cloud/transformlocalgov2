# Common Header Integration Guide

## Overview
This guide explains how to use the common header system to ensure consistent navigation and analytics tracking across all pages.

## Files Created

1. **`includes/header.html`** - Common navigation HTML (can be manually copied or loaded dynamically)
2. **`includes/load-header.js`** - JavaScript loader for dynamic header injection
3. **`analytics-tracker.js`** - Analytics tracking script (already in root)

## Option 1: Simple JavaScript Injection (Recommended)

Add this single line to each page's `<head>` or before closing `</body>`:

```html
<script src="includes/load-header.js"></script>
```

This script will:
- Automatically inject the common header
- Set the active nav link based on current page
- Ensure analytics-tracker.js is loaded

### Usage Example

In any `.html` file, add before closing `</body>`:

```html
<body>
    <!-- Your existing content -->
    
    <!-- Common Header Loader -->
    <script src="includes/load-header.js"></script>
    
    <!-- Your existing scripts -->
    <script src="script.js"></script>
</body>
```

## Option 2: Manual Copy (Simplest)

Simply copy the navigation HTML from `includes/header.html` and paste it into each page where the `<nav>` currently exists.

Then manually add this in the `<head>` section of each page:

```html
<script src="/main/analytics-tracker.js"></script>
```

## Option 3: Direct Analytics Only (If you just want analytics consistency)

If you've already updated headers manually and just want to ensure analytics is consistent, add this to the `<head>` of each page:

```html
<script src="/main/analytics-tracker.js"></script>
```

## Updating All Pages

### Quick Find/Replace Method:

1. **Find existing nav section** in each page (usually looks like):
```html
<nav class="navbar">
    <!-- navigation content -->
</nav>
```

2. **Replace with** the content from `includes/header.html`

3. **Ensure analytics script** is in `<head>`:
```html
<script src="/main/analytics-tracker.js"></script>
```

## Testing

After updating pages:

1. Check that navigation appears correctly
2. Verify active nav link highlights the current page
3. Check browser console for analytics tracker loading
4. Test navigation links work correctly

## Notes

- The analytics tracker path is `/main/analytics-tracker.js` (absolute from root)
- Make sure the path matches your server structure
- If pages are in a subdirectory, adjust paths accordingly
- The `load-header.js` script handles active state automatically

## Next Steps

1. Choose an integration method (Option 1 recommended)
2. Update all HTML pages with chosen method
3. Test navigation and analytics on each page
4. Verify active states work correctly

