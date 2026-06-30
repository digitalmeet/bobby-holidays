# UniWorld Holidays — System Handoff Document
**Last Updated:** 2026-07-01 | **Project:** bobby-holidays | **Brand:** UniWorld Holidays

---

## QUICK REFERENCE

| Item | Value |
|---|---|
| Admin URL | http://bobby-holidays.test/admin |
| Admin Login | admin@uniworldholidays.com / password |
| Frontend URL | http://bobby-holidays.test |
| Laravel | 13.15.0 |
| PHP | 8.4.12 |
| Filament | 5.6.7 |
| Livewire | 4.3.1 |
| Database | MySQL 8.x, DB: bobby_holidays |
| Tables | 32 |
| Routes | 62 GET + POST |
| Filament Resources | 13 |
| Dashboard Widgets | 4 |
| Report Pages | 3 |

---

## CODING STANDARDS (Filament 5.x)

```
LAYOUT components → Filament\Schemas\Components\*
  Section, Tabs, Tab, Fieldset

INPUT components → Filament\Forms\Components\*
  TextInput, Select, Toggle, RichEditor, FileUpload, Repeater, Placeholder, etc.

ACTIONS → Filament\Actions\*
  Action, EditAction, DeleteAction, CreateAction (unified namespace)

PROPERTIES:
  Page::$view → NON-STATIC (protected string $view)
  ChartWidget::$heading → NON-STATIC
  TableWidget::$heading → STATIC
  StatsOverviewWidget::$pollingInterval → NON-STATIC
  Widget::$sort → STATIC

BLADE:
  JSON-LD @context/@type → use @@context/@@type (escape @ for Blade)
  Never use @if(...)@section(...)@endif on same line
  Never use @hasSection with $__env->yieldContent
  Use @section('name', $value) for inline sections (no @endsection needed)
```

---

## DATABASE (32 tables in bobby_holidays)

### Core Business
destinations, tours, tour_pricing, enquiries, follow_ups, quotations, quotation_sections, quotation_items, quotation_histories, bookings, travellers, payments, booking_status_histories, payment_histories, online_payments

### CMS
pages, posts, banners, testimonials, faqs, settings

### Activity Logs (per-module)
enquiry_logs, booking_logs, quotation_logs, tour_logs, page_logs

### System
users, permissions, roles, model_has_permissions, model_has_roles, role_has_permissions, media, notifications, cache, cache_locks, jobs, job_batches, failed_jobs, sessions, migrations, password_reset_tokens

---

## ADMIN PANEL NAVIGATION

```
Dashboard (4 widgets: Stats, Calling List, Recent Enquiries, Recent Payments)

Sales Pipeline
├── Enquiries (+ Interaction History tab)
├── Quotations (+ Items relation manager)
└── Follow-ups & Calls

Operations
└── Bookings (+ Travellers + Payments tabs)

Content Management
├── Destinations
└── Tours (+ Pricing tab)

CMS
├── Posts (Blog)
├── Pages
├── Testimonials
├── Banners
└── FAQs

User Management
├── Users
├── Roles (module-based permission checkboxes)
└── Site Settings (Company, Social, Quotation Defaults, SEO, Payment Gateway)

Reports
├── Sales Report
├── Revenue Report
└── Bookings Report
```

---

## KEY FEATURES

1. Dynamic permission system (config/admin-modules.php → seeder → policies)
2. Enquiry → Quotation → Booking pipeline with one-click conversion
3. Quotation builder with sections, items, PDF, public link, versioning
4. Follow-up module with calling list, interaction history, auto-status updates
5. Payment recording with auto-balance calculation
6. Razorpay integration (feature-flagged via settings)
7. CMS pages, blog, FAQs, testimonials, banners
8. Activity logging per module (separate tables)
9. Email on quotation send
10. Repeat client detection
11. Export to Excel (enquiries, bookings)
12. SEO meta on all dynamic pages (admin-editable)
13. InstantClick for SPA-like frontend speed
14. Scheduled commands (auto-expiry, follow-up reminders)
15. In-app notifications (new enquiry, quote viewed/accepted, payment received)
16. Individual service pages with sidebar navigation
17. Contact form + sticky enquiry bar (AJAX, source tracking)
18. Role-based dashboard widgets
19. WhatsApp integration on enquiries, bookings, follow-ups

---

## SCHEDULED COMMANDS

| Command | Schedule | Purpose |
|---|---|---|
| quotations:expire | Daily 00:30 | Auto-expire past-validity quotations |
| enquiries:follow-up-reminders | Daily 09:00 | Notify assigned users of overdue follow-ups |

---

## OBSERVERS (AppServiceProvider)

| Model | Triggers |
|---|---|
| Enquiry | Notifies sales+admin on new enquiry |
| Quotation | Notifies on viewed/accepted/rejected |
| Payment | Notifies on payment received |

---

## TRAITS

| Trait | Applied To | Purpose |
|---|---|---|
| LogsActivity | Enquiry, Quotation, Booking, Tour, Page | Auto-logs create/update/delete to per-module tables |

---

## HELPER FUNCTIONS

| Function | Location | Purpose |
|---|---|---|
| setting($key, $default) | app/helpers.php | Read from settings table (cached 5 min) |

---

## RAZORPAY (Feature-Flagged)

- Disabled by default (razorpay_enabled = 'false' in settings)
- Enable via Admin → Site Settings → Payment Gateway tab
- Routes: /pay/{publicId}, /pay/create-order, /pay/verify
- "Pay Online" button appears on quotation public page only when enabled
- Auto-records payment in bookings table on successful capture

---

## FRONTEND PERFORMANCE

- InstantClick.js for SPA-like prefetch on hover
- Deferred CSS (flatpickr, glightbox) via media="print" onload
- Deferred JS (flatpickr, glightbox) via defer attribute
- Removed AOS.js and Select2 from global load
- Google Analytics loads only if configured in settings
- JSON-LD structured data for SEO
- Canonical URLs on all pages
- Open Graph + Twitter Card meta tags

---

## DEPLOYMENT

```bash
php artisan migrate --force
php artisan db:seed --class=RolesAndPermissionsSeeder
php artisan db:seed --class=AdminUserSeeder
php artisan storage:link
php artisan config:cache
php artisan route:cache
php artisan event:cache
php artisan view:cache
php artisan filament:optimize
# Cron: * * * * * php artisan schedule:run
```

---

## LOGIN CREDENTIALS

| User | Email | Password | Role |
|---|---|---|---|
| Super Admin | admin@uniworldholidays.com | password | super_admin |
| Sales | ravi@uniworldholidays.com | password | sales |
| Operations | meena@uniworldholidays.com | password | operations |
| Content | priya@uniworldholidays.com | password | content |
