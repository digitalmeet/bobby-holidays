# Bobby Holidays — Fix & Improvement Prompts
**Project:** UniWorld Holidays | **Last Updated:** 2026-07-01
**Usage:** Copy each prompt and paste into chat one at a time. Follow the priority order.

---

## PRIORITY ORDER

| # | Title | Priority | Type |
|---|---|---|---|
| 1 | Booking Reference Race Condition | 🔴 Critical | Bug Fix |
| 2 | Payment & OnlinePayment Audit Trail | 🔴 Critical | Bug Fix |
| 3 | Rate Limiting on Public POST Routes | 🔴 Critical | Security |
| 4 | Quotation public_id Infinite Loop Guard | 🟠 High | Bug Fix |
| 5 | Quotation View Count Deduplication | 🟠 High | Bug Fix |
| 6 | Broken scopePending on Enquiry | 🟠 High | Bug Fix |
| 7 | ActivityLog Schema::hasTable() Performance | 🟡 Medium | Performance |
| 8 | getServicesData() Visibility Fix | 🟡 Medium | Security |
| 9 | Move Services to CMS Pages | 🟡 Medium | Architecture |
| 10 | Tour Detail — Gallery Section | 🟢 Low | UI |
| 11 | Tour Detail — Mobile Sticky CTA Bar | 🟢 Low | UI |
| 12 | Tour Detail — Tabbed Content Navigation | 🟢 Low | UI |
| 13 | Destination Detail — Hero Image + Stats Bar | 🟢 Low | UI |
| 14 | Package Card Component — Visual Upgrade | 🟢 Low | UI |
| 15 | Packages Listing — Filter Bar | 🟢 Low | UI |

---

## BUG FIXES

---

### PROMPT 1 — Booking Reference Race Condition
**File:** `app/Models/Booking.php`
**Priority:** 🔴 Critical

```
In `app/Models/Booking.php`, fix the booking reference generation race condition in the `booted()` method. Replace the current `max(id)` approach with a database-level atomic solution using a dedicated `booking_sequences` table with a DB transaction and pessimistic lock (`lockForUpdate()`). Create the migration for `booking_sequences` table with `year` and `last_number` columns. The format must stay `UW-YYYY-000001`. Handle the case where no sequence exists for the current year yet.
```

---

### PROMPT 2 — Payment & OnlinePayment Audit Trail
**Files:** `app/Models/Payment.php`, `app/Models/OnlinePayment.php`, migrations
**Priority:** 🔴 Critical

```
In `app/Models/Payment.php` and `app/Models/OnlinePayment.php`, add the `SoftDeletes` trait and the `LogsActivity` trait (already exists at `app/Traits/LogsActivity.php`). Add `deleted_at` column to both migration files (`create_payments_table` and `create_online_payments_table`). Also add `softDeletes()` to the schema. These are financial records and must have audit trails and soft delete protection.
```

---

### PROMPT 3 — Rate Limiting on Public POST Routes
**File:** `routes/web.php`
**Priority:** 🔴 Critical

```
In `routes/web.php`, add `throttle:5,1` middleware to the quotation accept/reject routes (`/quote/{publicId}/accept` and `/quote/{publicId}/reject`). Add `throttle:10,1` to the contact form POST route (`/contact-us`). Add `throttle:20,1` to the Razorpay payment routes (`/pay/create-order` and `/pay/verify`). These are currently unprotected public POST endpoints.
```

---

### PROMPT 4 — Quotation public_id Infinite Loop Guard
**File:** `app/Models/Quotation.php`
**Priority:** 🟠 High

```
In `app/Models/Quotation.php`, the `booted()` method has two `do...while` loops for generating `public_id` and `access_token` with no escape condition. Add a max-attempts guard of 10 iterations to both loops. If max attempts are exceeded, throw a `RuntimeException` with a descriptive message instead of looping forever.
```

---

### PROMPT 5 — Quotation View Count Deduplication
**File:** `app/Http/Controllers/QuotationController.php`
**Priority:** 🟠 High

```
In `app/Http/Controllers/QuotationController.php`, the `show()` method increments `view_count` on every page load including refreshes and bots. Fix this by deduplicating view counts using a session key per `public_id`. Only increment `view_count` if the session key `viewed_quote_{publicId}` does not exist, then set it. The `viewed_at` and status update logic should remain tied to the first-ever view (current behavior is correct for that part).
```

---

### PROMPT 6 — Broken scopePending on Enquiry
**File:** `app/Models/Enquiry.php`
**Priority:** 🟠 High

```
In `app/Models/Enquiry.php`, the `scopePending()` method uses bare `orWhere()` which breaks query chaining. Replace it with `whereIn('status', ['new', 'contacted'])`. Also audit all other scopes in this file for the same bare `orWhere` pattern and fix any found.
```

---

## PERFORMANCE & SECURITY

---

### PROMPT 7 — ActivityLog Schema::hasTable() Performance Fix
**File:** `app/Models/ActivityLog.php`
**Priority:** 🟡 Medium

```
In `app/Models/ActivityLog.php`, the `log()` static method calls `Schema::hasTable($table)` on every single write operation. This is a database query on every model create/update/delete. Replace it with a static in-memory cache using a `private static array $checkedTables = []` property. Only call `Schema::hasTable()` once per table name per request lifecycle, then cache the boolean result in that static array.
```

---

### PROMPT 8 — getServicesData() Visibility Fix
**File:** `app/Http/Controllers/FrontendController.php`
**Priority:** 🟡 Medium

```
In `app/Http/Controllers/FrontendController.php`, change the `getServicesData()` method visibility from `public` to `private`. It is only called internally within the controller and should never be publicly accessible or routable.
```

---

## ARCHITECTURE

---

### PROMPT 9 — Move Services to CMS Pages
**Files:** `app/Http/Controllers/FrontendController.php`, `app/Filament/Resources/PageResource.php`, new migration, new seeder
**Priority:** 🟡 Medium

```
In `app/Http/Controllers/FrontendController.php`, refactor `services()` and `serviceShow()` to load from the `pages` table instead of the hardcoded `getServicesData()` array. Add a `type` column (string, nullable, default null) to the `pages` table via a new migration. Services pages will have `type = 'service'`. Update `services()` to query `Page::where('type', 'service')->published()->orderBy('sort_order')->get()` and `serviceShow()` to query by slug with `type = 'service'`. Remove the `getServicesData()` method entirely. Update the `PageResource` in Filament to include a `type` select field with options: null (Standard) and service. Seed the 7 existing services as pages with `type = 'service'` in a new seeder `ServicesSeeder`.
```

---

## UI IMPROVEMENTS

---

### PROMPT 10 — Tour Detail Page: Gallery Section
**File:** `resources/views/frontend/tour-detail.blade.php`
**Priority:** 🟢 Low

```
In `resources/views/frontend/tour-detail.blade.php`, add a photo gallery section after the Quick Info Badges card and before the Overview card. Use the `$tour->gallery` array (already cast as array in the model). Display images in a responsive CSS grid (3 columns on desktop, 2 on tablet, 1 on mobile). The first image should span 2 rows (featured). Each image should open in a lightbox using GLightbox (already loaded in the layout). If `$tour->gallery` is empty or null, skip the section entirely. Use `asset('storage/' . $image)` for image paths.
```

---

### PROMPT 11 — Tour Detail Page: Mobile Sticky CTA Bar
**File:** `resources/views/frontend/tour-detail.blade.php`
**Priority:** 🟢 Low

```
In `resources/views/frontend/tour-detail.blade.php`, add a sticky bottom bar visible only on mobile (`d-lg-none`). It should show the starting price on the left and two buttons on the right: "Get Quote" (links to contact page with tour slug pre-filled) and a WhatsApp icon button. This bar should appear fixed at the bottom of the screen on mobile so users don't have to scroll to the sidebar. Use inline styles consistent with the existing brand color `#064f68`.
```

---

### PROMPT 12 — Tour Detail Page: Tabbed Content Navigation
**File:** `resources/views/frontend/tour-detail.blade.php`
**Priority:** 🟢 Low

```
In `resources/views/frontend/tour-detail.blade.php`, add a sticky tab navigation bar below the page banner (above the main content row) that links to the main content sections: Overview, Highlights, Itinerary, Inclusions, and Pricing. Use simple anchor links with smooth scroll. Each section card should have a corresponding `id` attribute (`#overview`, `#highlights`, `#itinerary`, `#inclusions`, `#pricing`). The tab bar should stick below the header on scroll using `position: sticky; top: 70px;` with a white background and bottom border. Only show tabs for sections that have content.
```

---

### PROMPT 13 — Destination Detail Page: Hero Image + Stats Bar
**File:** `resources/views/frontend/destination-detail.blade.php`
**Priority:** 🟢 Low

```
In `resources/views/frontend/destination-detail.blade.php`, replace the plain `page-banner` component include with a full-width hero section that uses `$destination->hero_image` as a background image with a dark overlay. Below the hero title and subtitle, add a stats bar showing: number of available tours (`$tours->total()`), the destination country/continent, and a "Get Custom Quote" CTA button. If no hero image exists, fall back to the existing page-banner component. Keep all existing description and highlights content below.
```

---

### PROMPT 14 — Package Card Component: Visual Upgrade
**File:** `resources/views/frontend/components/package-card.blade.php`
**Priority:** 🟢 Low

```
Upgrade `resources/views/frontend/components/package-card.blade.php`. Current state: basic image, meta, title, description, price, button. Required changes: (1) Add a destination/location badge overlaid on the bottom-left of the image. (2) Add a subtle "Featured" ribbon on the top-right if a `$featured` variable is passed as true. (3) Make the price display more prominent — larger font, brand color. (4) Add a hover effect where the image scales slightly (CSS transform scale on hover). (5) Add a small star rating display if a `$rating` variable is passed. All new variables should be optional with safe defaults so existing usages don't break.
```

---

### PROMPT 15 — Packages Listing Pages: Filter Bar
**Files:** `resources/views/frontend/packages-domestic.blade.php`, `resources/views/frontend/packages-international.blade.php`, `app/Http/Controllers/FrontendController.php`
**Priority:** 🟢 Low

```
In `resources/views/frontend/packages-domestic.blade.php` and `packages-international.blade.php`, add a filter bar above the package grid. Filters: Duration (dropdown: Any, 1-3 Days, 4-6 Days, 7+ Days), Budget (dropdown: Any, Under ₹15k, ₹15k-₹30k, ₹30k-₹60k, ₹60k+), Category (dropdown: Any, Family, Couple, Group, Solo, Adventure). Implement filtering as a GET form so filters are bookmarkable URLs. Update the corresponding controller methods (`toursDomestic()` and `toursInternational()`) in `FrontendController.php` to accept and apply these query parameters to the Eloquent query. Show active filter count as a badge on a "Filters" label.
```

---

## COMPLETION TRACKER

Mark each prompt as done when completed.

| # | Prompt | Status |
|---|---|---|
| 1 | Booking Reference Race Condition | ✅ Done |
| 2 | Payment & OnlinePayment Audit Trail | ✅ Done |
| 3 | Rate Limiting on Public POST Routes | ✅ Done |
| 4 | Quotation public_id Infinite Loop Guard | ✅ Done |
| 5 | Quotation View Count Deduplication | ✅ Done |
| 6 | Broken scopePending on Enquiry | ✅ Done |
| 7 | ActivityLog Schema::hasTable() Performance | ✅ Done |
| 8 | getServicesData() Visibility Fix | ✅ Done |
| 9 | Move Services to CMS Pages | ✅ Done |
| 10 | Tour Detail — Gallery Section | ✅ Done |
| 11 | Tour Detail — Mobile Sticky CTA Bar | ✅ Done |
| 12 | Tour Detail — Tabbed Content Navigation | ✅ Done |
| 13 | Destination Detail — Hero + Stats Bar | ✅ Done |
| 14 | Package Card — Visual Upgrade | ✅ Done |
| 15 | Packages Listing — Filter Bar | ✅ Done |
