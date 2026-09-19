# UniWorld Holidays — System Handoff Document

**Last Updated:** July 2026 | **Project:** bobby-holidays | **Brand:** UniWorld Holidays

---

## QUICK REFERENCE

| Item | Value |
|---|---|
| Admin URL | http://bobby-holidays.test/admin |
| Admin Login | admin@uniworldholidays.com / password |
| Frontend URL | http://bobby-holidays.test |
| Health Check | http://bobby-holidays.test/health |
| Laravel | 13.15.0 |
| PHP | 8.4.12 |
| Filament | 5.6.7 |
| Livewire | 4.3.1 |
| Database | MySQL 8.x, DB: bobby_holidays |
| Tables | 43 |
| Routes | 78 GET + 8 POST |
| Filament Resources | 14 |
| Dashboard Widgets | 4 |
| Report Pages | 3 |
| Custom Pages | 2 (Dashboard, ManageSettings) |
| Brand Color | #064f68 |
| Cache/Session Driver | database |

---

## ARCHITECTURE OVERVIEW

```
bobby-holidays/
├── app/
│   ├── Console/Commands/          # 3 commands (ExpireQuotations, GenerateSitemap, SendFollowUpReminders)
│   ├── Filament/
│   │   ├── Pages/                 # Dashboard, ManageSettings, SalesReport, RevenueReport, BookingsReport
│   │   ├── Resources/            # 14 resources (Banners, Bookings, CmsPages, Destinations, Enquiries, Faqs, FollowUps, Posts, Quotations, Roles, Settings, Testimonials, Tours, Users)
│   │   └── Widgets/              # 4 widgets (StatsOverview, TodaysCallingList, RecentEnquiries, RecentPayments)
│   ├── Http/
│   │   ├── Controllers/          # FrontendController, ContactController, QuotationController, PaymentController
│   │   └── Middleware/           # AdminPanelAccess, CacheHeaders
│   ├── Models/                   # All Eloquent models
│   ├── Observers/                # CacheBustObserver, EnquiryObserver, PaymentObserver, QuotationObserver
│   ├── Policies/                 # Per-resource authorization
│   ├── Providers/                # AppServiceProvider, Filament/AdminPanelProvider
│   └── Traits/                   # LogsActivity
├── config/
│   ├── activity-log.php          # Known log tables array (replaces Schema::hasTable)
│   └── admin-modules.php         # Permission module definitions
├── database/
│   ├── migrations/               # All migrations including composite indexes
│   └── seeders/                  # RolesAndPermissions, AdminUser, DemoData, Services
├── public/
│   ├── assets/frontend/
│   │   ├── css/                  # style.css, responsive.css
│   │   ├── js/                   # main.js (vanilla JS, zero jQuery)
│   │   └── images/              # SVG placeholders, logo
│   ├── robots.txt               # Disallows /admin, /livewire, /pay, /quote
│   └── sitemap.xml              # Auto-generated daily at 03:00
├── resources/views/
│   ├── errors/                   # 403, 404, 500, 503 branded pages
│   └── frontend/                # All public-facing Blade views
├── routes/
│   ├── web.php                  # Frontend + quotation + payment routes
│   └── console.php             # 3 scheduled commands
├── HANDOFF.md                   # This file
├── ISSUES.md                    # Audit findings + fix tracker (35 fixes applied)
├── PROMPTS.md                   # 15 prompts used for initial fixes
└── PAGESPEED_SEO.md            # Performance audit + implementation status
```

---

## CODING STANDARDS (Filament 5.x / Laravel 13.x)

```
LAYOUT components → Filament\Schemas\Components\*
  Section, Tabs, Tab, Fieldset

INPUT components → Filament\Forms\Components\*
  TextInput, Select, Toggle, RichEditor, FileUpload, Repeater, Placeholder

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
  Use @section('name', $value) for inline sections (no @endsection needed)

FRONTEND JS:
  Vanilla JS only — NO jQuery
  Swiper.js for carousels
  IntersectionObserver for scroll animations (data-animate attribute)
  GLightbox for lightboxes
  Flatpickr for date pickers
```

---

## DATABASE (43 tables)

### Core Business
destinations, tours, tour_pricing, enquiries, follow_ups, quotations, quotation_sections, quotation_items, quotation_histories, bookings, booking_sequences, travellers, payments, booking_status_histories, payment_histories, online_payments

### CMS
pages, posts, banners, testimonials, faqs, settings

### Activity Logs (per-module)
enquiry_logs, booking_logs, quotation_logs, tour_logs, page_logs, payment_logs, online_payment_logs

### System
users, permissions, roles, model_has_permissions, model_has_roles, role_has_permissions, media, notifications, cache, cache_locks, jobs, job_batches, failed_jobs, sessions, migrations, password_reset_tokens

### Composite Indexes (performance)
- `enquiries(status, created_at)`
- `bookings(status, created_at)`
- `bookings(status, balance_amount)`
- `payments(status, payment_date)`

---

## ADMIN PANEL NAVIGATION

```
Dashboard (4 widgets: Stats, Calling List, Recent Enquiries, Recent Payments)

Sales Pipeline
├── Enquiries (+ Interaction History tab) [badge: new count, cached 60s]
├── Quotations (+ Items relation manager) [badge: draft count, cached 60s]
└── Follow-ups & Calls

Operations
└── Bookings (+ Travellers + Payments tabs) [badge: active count, cached 60s]

Content Management
├── Destinations
└── Tours (+ Pricing tab)

CMS
├── Posts (Blog)
├── Pages (includes service pages with type='service')
├── Testimonials
├── Banners
└── FAQs

User Management
├── Users
├── Roles (module-based permission checkboxes)
└── Site Settings (Company, Social, Quotation Defaults, SEO, Payment Gateway)

Reports
├── Sales Report [cached 5 min]
├── Revenue Report [cached 5 min]
└── Bookings Report [cached 5 min]
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
8. Activity logging per module (separate tables, config-based)
9. Email on quotation send
10. Repeat client detection
11. Export to Excel (enquiries, bookings)
12. SEO meta on all dynamic pages (admin-editable)
13. Scheduled commands (auto-expiry, follow-up reminders, sitemap)
14. In-app notifications (new enquiry, quote viewed/accepted, payment received)
15. Individual service pages with sidebar navigation (CMS-driven)
16. Contact form + sticky enquiry bar (AJAX, source tracking)
17. Role-based dashboard widgets
18. WhatsApp integration on enquiries, bookings, follow-ups
19. Booking reference atomic generation (UW-YYYY-000001 format)
20. Soft deletes + audit trail on financial records (payments)

---

## FRONTEND PERFORMANCE STACK

| Feature | Implementation |
|---|---|
| Carousels | Swiper.js 11 (vanilla JS) |
| Animations | IntersectionObserver (`data-animate` attribute) |
| Lightbox | GLightbox |
| Date picker | Flatpickr |
| Icons | Font Awesome 6.5.2 (solid + brands subsets only) |
| CSS Framework | Bootstrap 5.3.3 |
| JS Framework | None (vanilla JS, zero jQuery) |
| Page caching | FrontendController Cache::remember (5-min TTL) |
| Browser caching | CacheHeaders middleware (300s public, 600s s-maxage) |
| Link prefetch | Hover-based prefetch (vanilla JS) |
| Image loading | lazy + decoding=async + width/height on all cards |
| Hero images | preload link on detail pages |
| SEO | JSON-LD, sitemap, robots.txt, canonical, OG/Twitter meta |

### JS/CSS Savings vs Original

| Removed | Size |
|---|---|
| jQuery 3.7.1 | ~90 KB |
| OwlCarousel JS + CSS | ~50 KB |
| Font Awesome full → subset | ~60 KB |
| AOS library | ~15 KB |
| **Total saved** | **~215 KB per page** |

---

## OBSERVERS

| Observer | Models | Purpose |
|---|---|---|
| EnquiryObserver | Enquiry | Notifies sales+admin on new enquiry |
| QuotationObserver | Quotation | Notifies on viewed/accepted/rejected |
| PaymentObserver | Payment | Notifies on payment received |
| CacheBustObserver | Tour, Destination, Post, Testimonial, Faq, Page, Booking, Quotation | Invalidates frontend + admin caches on create/update/delete |

---

## CACHING STRATEGY

| Cache Key | TTL | Invalidated By |
|---|---|---|
| home.tours | 300s | CacheBustObserver (Tour) |
| home.destinations | 300s | CacheBustObserver (Destination) |
| home.testimonials | 300s | CacheBustObserver (Testimonial) |
| home.posts | 300s | CacheBustObserver (Post) |
| frontend.destinations | 300s | CacheBustObserver (Destination) |
| frontend.faq | 300s | CacheBustObserver (Faq) |
| frontend.services | 300s | CacheBustObserver (Page) |
| nav.enquiries.new | 60s | CacheBustObserver (Enquiry) |
| nav.bookings.active | 60s | CacheBustObserver (Booking) |
| nav.quotations.draft | 60s | CacheBustObserver (Quotation) |
| dashboard_stats | 60s | CacheBustObserver (Booking, Quotation) |
| report.sales | 300s | Manual (TTL expiry) |
| report.revenue | 300s | Manual (TTL expiry) |
| report.bookings | 300s | Manual (TTL expiry) |

---

## SCHEDULED COMMANDS

| Command | Schedule | Purpose |
|---|---|---|
| quotations:expire | Daily 00:30 | Auto-expire past-validity quotations |
| enquiries:follow-up-reminders | Daily 09:00 | Notify assigned users of overdue follow-ups |
| sitemap:generate | Daily 03:00 | Regenerate public/sitemap.xml |

---

## MIDDLEWARE

| Middleware | Scope | Purpose |
|---|---|---|
| AdminPanelAccess | Admin panel | Role-based access control |
| CacheHeaders | Global (appended) | Sets Cache-Control headers for guest GET requests |
| throttle:60,1 | Admin panel | Rate limiting on admin routes |
| throttle:5,1 | Quotation accept/reject | Prevents abuse of public POST |
| throttle:10,1 | Contact form POST | Prevents spam submissions |
| throttle:20,1 | Razorpay payment routes | Prevents payment abuse |

---

## RAZORPAY (Feature-Flagged)

- Disabled by default (razorpay_enabled = 'false' in settings)
- Enable via Admin → Site Settings → Payment Gateway tab
- Routes: /pay/{publicId}, /pay/create-order, /pay/verify
- "Pay Online" button appears on quotation public page only when enabled
- Auto-records payment in bookings table on successful capture

---

## HELPER FUNCTIONS

| Function | Location | Purpose |
|---|---|---|
| setting($key, $default) | app/helpers.php | Read from settings table (cached 5 min) |

---

## TRAITS

| Trait | Applied To | Purpose |
|---|---|---|
| LogsActivity | Enquiry, Quotation, Booking, Tour, Page, Payment, OnlinePayment | Auto-logs create/update/delete to per-module tables |
| SoftDeletes | Payment, OnlinePayment | Financial record protection |

---

## DEMO DATA

| Entity | Count | Details |
|---|---|---|
| Tours | 13 | All active, 8 highlights, full itineraries, 8 inclusions, difficulty levels, meta |
| Destinations | 10 | Rich descriptions, 8 highlights each |
| Pricing Tiers | 39 | Standard + Deluxe + Premium per tour |
| Users | 4 | super_admin, sales, operations, content |

---

## LOGIN CREDENTIALS

| User | Email | Password | Role |
|---|---|---|---|
| Super Admin | admin@uniworldholidays.com | password | super_admin |
| Sales | ravi@uniworldholidays.com | password | sales |
| Operations | meena@uniworldholidays.com | password | operations |
| Content | priya@uniworldholidays.com | password | content |

---

## DEPLOYMENT

Production deployment is Docker-based. The full, maintained procedure is in [DEPLOYMENT_EC2.md](DEPLOYMENT_EC2.md), including two-client isolation, Cloudflare records, Nginx reverse proxying, TLS, backups, and launch checks.

For `meet-shah.online`, use a separate directory and `.env.production` per client:

| Domain | Compose project | Local-only app port |
|---|---|---:|
| `uniworld-holidays.meet-shah.online` | `uniworld-holidays` | `127.0.0.1:8081` |
| `travel-agency.meet-shah.online` | `travel-agency` | `127.0.0.1:8082` |

Each client needs distinct `APP_KEY`, database name and credentials, Redis password, storage volume, and Docker Compose project. Host Nginx terminates HTTPS on `:443` and proxies to the local port; Docker must never expose MySQL, Redis, or the application ports publicly. Use Cloudflare **Full (strict)** with its wildcard Origin Certificate at `/etc/ssl/cloudflare/meet-shah.online.pem` and private key at `/etc/ssl/cloudflare/meet-shah.online.key` (`0600`, root-owned).

```bash
# Deploy or update one client only, from its own server directory
cd /opt/clients/uniworld-holidays
git pull --ff-only
./deploy-ec2.sh
```

### Windows (Laragon) Specific

```cmd
icacls storage /grant Users:(OI)(CI)(M) /T
icacls bootstrap\cache /grant Users:(OI)(CI)(M) /T
```

### Environment Variables (key ones)

```env
APP_ENV=production
APP_DEBUG=false
APP_URL=https://uniworld-holidays.meet-shah.online
COMPOSE_PROJECT_NAME=uniworld-holidays
APP_PORT=127.0.0.1:8081
DB_DATABASE=uniworld_holidays
CACHE_STORE=redis
SESSION_DRIVER=redis
QUEUE_CONNECTION=redis
```

---

## REMAINING ITEMS (Only 1)

| # | Item | Effort | Notes |
|---|---|---|---|
| 1 | Install spatie/laravel-backup | 5 min | Requires `composer require spatie/laravel-backup` + schedule `backup:run --only-db` daily |

Everything else is complete. All 15 PROMPTS.md fixes, all ISSUES.md items (35 fixes), and all PAGESPEED_SEO.md high/medium impact items are implemented.

---

## PRODUCTION READINESS CHECKLIST

- [x] All critical bugs fixed (race conditions, infinite loops, injection)
- [x] Rate limiting on all public POST endpoints
- [x] Soft deletes on financial records
- [x] Composite indexes for report queries at scale
- [x] Cached navigation badges + report pages + frontend pages
- [x] Slow query logging in development
- [x] Health check endpoint (/health)
- [x] Custom branded error pages
- [x] SEO: sitemap, robots.txt, JSON-LD, canonical, OG meta
- [x] Frontend: ~215KB JS/CSS removed, browser caching, image optimization
- [x] Admin: unsaved changes alerts, throttle protection
- [x] Scheduled commands: quotation expiry, follow-up reminders, sitemap
- [ ] Install spatie/laravel-backup for automated DB backups
- [ ] Configure production mail driver (for notifications)
- [ ] Set up cron on production server
- [x] EC2/Cloudflare/Nginx two-client deployment procedure documented
- [ ] Install Cloudflare origin certificate and force HTTPS on the EC2 host
- [ ] Set APP_DEBUG=false, APP_ENV=production
