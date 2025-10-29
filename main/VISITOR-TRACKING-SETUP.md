# Visitor Tracking System - Setup Instructions

This system tracks unique visitors by date and stores their information in your database.

## Files Created

1. **main/api/visitors_table.sql** - SQL script to create the database table
2. **main/api/track-visitor.php** - Script that tracks visitors and stores data
3. **main/api/get-visitor-stats.php** - API endpoint that returns visitor statistics
4. **main/visitor-stats.html** - Admin dashboard to view statistics

## Setup Instructions

### Step 1: Create the Database Table

1. Log into your SiteWorks cPanel or phpMyAdmin
2. Select your database
3. Click on the "SQL" tab
4. Copy and paste the contents of `main/api/visitors_table.sql`
5. Click "Go" to execute the SQL
6. This will create the `visitors` table in your database

### Step 2: Update Database Configuration

1. Open `main/api/config.php` (if it doesn't exist, copy from `config.sample.php`)
2. Update these values with your actual database credentials:
   - `DB_HOST` - Usually "localhost"
   - `DB_NAME` - Your database name from cPanel
   - `DB_USER` - Your database username
   - `DB_PASS` - Your database password

### Step 3: Add Tracking to Your Pages

To track visitors on specific pages, add this line at the very top of your HTML files (before the `<!DOCTYPE html>` tag):

```php
<?php require_once 'api/track-visitor.php'; ?>
```

**Note:** If you want to track visitors on ALL pages automatically, you can add this to your main `index.html` or create a header/include file that gets loaded on every page.

#### Important:
- Files must have a `.php` extension for the tracking to work
- For static HTML pages, you'll need to either:
  - Rename them to `.php` (e.g., `index.html` → `index.php`)
  - Or use server-side includes to add the tracking script

### Step 4: View Statistics

1. Upload `main/visitor-stats.html` to your server
2. Access it via your browser: `https://yourdomain.com/visitor-stats.html`
3. The dashboard will show:
   - Total visits by date
   - Unique sessions
   - Unique IP addresses
   - Most visited pages
   - Daily visitor charts

## How It Works

1. **Tracking:** When a visitor loads a page with the tracking script, it records:
   - Session ID (unique to each browser session)
   - IP address
   - Visit date and time
   - User agent (browser info)
   - Referrer (where they came from)
   - Page URL

2. **Uniqueness:** The system tracks unique visitors by:
   - Session ID (same browser session)
   - Date (resets daily)
   - Can also track unique IPs

3. **Privacy:** This system does NOT track:
   - Personal information
   - Names or email addresses
   - Form data or user inputs

## Customization

### Change Date Range
In `visitor-stats.html`, modify the default range:
- Change `-30 days` in the JavaScript resetDates() function to your preferred range

### Add More Statistics
Edit `main/api/get-visitor-stats.php` to add:
- Hourly statistics
- Geographic data (if you add IP geolocation)
- Device/browser breakdowns

## Database Table Structure

The `visitors` table includes:
- `id` - Unique record ID
- `session_id` - Browser session identifier
- `ip_address` - Visitor's IP address
- `visit_date` - Date of visit (YYYY-MM-DD)
- `visit_time` - Timestamp of visit
- `user_agent` - Browser/device information
- `referrer` - Where visitor came from
- `page_url` - Which page was visited
- `is_unique_visitor` - Whether this is the first visit today

## Notes

- Tracking is silent - it won't affect your site's performance or user experience
- Data is stored in your SiteWorks database
- No external services required
- Fully GDPR-friendly (no personal data collected)

