# Bobby Holidays — Issues, Bugs & Recommendations

**Date:** July 2026
**Auditor:** Senior Engineering Review
**Stack:** Laravel 13.15 / Filament 5.6 / Livewire 4.3 / PHP 8.4 / MySQL 8

---

## 🔴 CRITICAL — Must Fix

### 1. View Cache Permission Error (FIXED ✅)

**Error:**
```
rename(storage\framework\views\8acB182.tmp, storage\framework\views/8ac788d2862e5e9d1b25d295993629e7.php): Access is denied (code: 5)
```

**Root Cause:** Windows file permissions on `storage/framework/views/` directory. The web server process (PHP) lacked write/modify permissions.

**Fix Applied:**
```cmd
icacls storage /grant Users:(OI)(CI)(M) /T
php artisan view:clear
php artisan optimize
```

**Prevention:** Add to deployment checklist — always run `icacls` or equivalent after fresh clone on Windows.

---

### 2. Admin Panel Slow Initial Load

**Root Cause (Multi-factor):**

| Factor | Impact | Status |
|---|---|---|
| Uncached Blade views (9s compilation) | First load after deploy is extremely slow | ✅ Fixed — `php artisan optimize` now caches views |
| Filament components not cached | Extra class resolution overhead | ✅ Fixed — `php artisan filament:optimize` |
| `TodaysCallingList` widget NOT lazy | Blocks dashboard render | ✅ Fixed |
| Navigation badges fire 3 uncached COUNT queries per page | Adds ~10ms per navigation | ✅ Fixed |
| `StatsOverview` polling every 30s | Unnecessary re-renders | ✅ Fixed |
| `Schema::hasTable()` calls in LogsActivity (39ms for 6 checks) | Fires on every model save | ✅ Fixed |

**Recommended Fixes:**

```php
// 1. Make TodaysCallingList lazy (add to class)
protected static bool $isLazy = true;

// 2. Increase polling interval on StatsOverview
protected string|null $pollingInterval = '120s'; // was 30s

// 3. Cache navigation badges (in each Resource)
public static function getNavigationBadge(): ?string
{
    return Cache::remember('nav.enquiries.new', 60, fn () =>
        static::getModel()::where('status', 'new')->count() ?: null
    );
}

// 4. Replace Schema::hasTable with config-based check in ActivityLog
// Pre-define known log tables instead of querying DB schema
private static array $knownTables = [
    'enquiry', 'booking', 'quotation', 'payment', 'online_payment', 'tour', 'page'
];
```

---

### 3. `StatsOverview` — Uncached Subquery Outside Cache Block (FIXED ✅)

**File:** `app/Filament/Widgets/StatsOverview.php`
**Line:** Inside `getStats()`, the "Balance Due" stat description runs a query OUTSIDE the `Cache::remember` block:

```php
->description(Booking::where('balance_amount', '>', 0)->whereNotIn('status', ['cancelled', 'refunded'])->count() . ' bookings')
```

This fires on every dashboard render regardless of cache. Move it inside the cached block.

---

## 🟡 IMPORTANT — Should Fix

### 4. Report Pages Fire 20+ Queries Without Caching (FIXED ✅)

**Files:**
- `app/Filament/Pages/SalesReport.php` — 23 queries → cached 5 min
- `app/Filament/Pages/RevenueReport.php` — 18 queries → cached 5 min
- `app/Filament/Pages/BookingsReport.php` — 15 queries → cached 5 min

**Current:** Every page load fires all queries fresh.
**Impact:** With growing data (1000+ enquiries, 500+ bookings), these will become slow.

**Recommendation:** Wrap `getViewData()` in `Cache::remember()` with 5-minute TTL:
```php
public function getViewData(): array
{
    return Cache::remember('report.sales', 300, function () {
        // ... existing query logic
    });
}
```

---

### 5. `LogsActivity` Trait — `Schema::hasTable()` Performance (FIXED ✅)

**File:** `app/Traits/LogsActivity.php` → `app/Models/ActivityLog.php`

**Issue:** `Schema::hasTable()` fires a `SHOW TABLES LIKE` query. Replaced with config-based lookup in `config/activity-log.php`.

**Better Alternative:** Use a config array of known log tables:
```php
// config/activity-log.php
return [
    'tables' => ['enquiry_logs', 'booking_logs', 'quotation_logs', 'payment_logs', 'online_payment_logs', 'tour_logs', 'page_logs'],
];

// In ActivityLog::log()
if (!in_array($table, config('activity-log.tables'))) {
    return null;
}
```

---

### 6. No Database Query Logging / Slow Query Detection (FIXED ✅)

**Issue:** No way to identify N+1 queries or slow queries in production.

**Fix Applied:** Added `DB::listen()` in `AppServiceProvider::boot()` — logs queries >100ms in local environment.

---

### 7. Missing Composite Indexes for Report Queries (FIXED ✅)

**Migration:** `2026_07_15_000001_add_composite_indexes_for_reports.php`

**Indexes added:**
- `enquiries`: `(status, created_at)`
- `bookings`: `(status, created_at)`, `(status, balance_amount)`
- `payments`: `(status, payment_date)`

---

### 8. Filament SPA Mode — Trade-offs (FIXED ✅)

**File:** `app/Providers/Filament/AdminPanelProvider.php`

**Fix Applied:** Added `->unsavedChangesAlerts()` to prevent data loss on navigation. Added `throttle:60,1` middleware for brute force protection.

---

## 🟢 LOW PRIORITY — Nice to Have

### 9. Tour Form — No Image Optimization (FIXED ✅)

**File:** `app/Filament/Resources/Tours/Schemas/TourForm.php`

**Fix Applied:** Added `imageResizeMode('cover')`, `imageCropAspectRatio('16:9')`, `imageResizeTargetWidth('1200')`, `imageResizeTargetHeight('675')` to hero image upload. Gallery images resized to 1200×800.

---

### 10. No Backup Strategy

**Issue:** No automated database backup command or schedule.

**Recommendation:** Install `spatie/laravel-backup`:
```bash
composer require spatie/laravel-backup
```
Schedule daily: `Schedule::command('backup:run --only-db')->dailyAt('02:00');`

---

### 11. No Rate Limiting on Admin Panel (FIXED ✅)

**File:** `AdminPanelProvider.php`

**Fix Applied:** Added `'throttle:60,1'` to panel middleware stack — 60 requests/minute per IP across all admin routes including login.

---

### 12. Enquiry Resource — Missing `with()` Eager Loading (FIXED ✅)

**Fix Applied:** Added `getEloquentQuery()` with `->with(['destination', 'tour', 'assignedTo'])` to `EnquiryResource` and `->with(['tour', 'assignedTo'])` to `BookingResource`.

---

### 13. No Health Check Endpoint (FIXED ✅)

**Route:** `GET /health`
**Response:** JSON with `status`, `db`, `cache`, `timestamp` fields.

---

### 14. Frontend Performance — Remaining Items (FIXED ✅)

| Item | Effort | Impact | Status |
|---|---|---|---|
| Replace OwlCarousel with Swiper.js | Medium | Eliminates jQuery dependency, saves ~140KB | ✅ Done |
| jQuery removed — main.js rewritten to vanilla JS | Medium | ~90KB saved | ✅ Done |
| Font Awesome subsetting | Low | Reduce 100KB → ~40KB | ✅ Done |
| Replace AOS with IntersectionObserver | Low | Save 15KB JS | ✅ Done |
| Add `Cache-Control` response headers | Low | Browser caching for static pages | ✅ Done |
| Hero image preload on detail pages | Low | Faster LCP | ✅ Done |
| DNS prefetch for wa.me + Google | Low | Faster external requests | ✅ Done |

---

### 15. Missing Error Pages (FIXED ✅)

**Created:** `resources/views/errors/404.blade.php`, `403.blade.php`, `500.blade.php`, `503.blade.php` — all branded with UniWorld Holidays design.

---

## ✅ ALREADY FIXED (This Session)

| # | Fix | Impact |
|---|---|---|
| 1 | View cache permissions (`icacls`) | Eliminates Access Denied error |
| 2 | `php artisan optimize` (config, routes, views, events cached) | ~9s faster first load |
| 3 | `php artisan filament:optimize` (components + icons cached) | Faster Filament render |
| 4 | Privacy/Terms routing bug — dedicated blade files now render | Pages were showing wrong template |
| 5 | Image lazy loading + dimensions on all card components | Better CLS + LCP scores |
| 6 | Logo `fetchpriority="high"` + dimensions | Faster LCP |
| 7 | `robots.txt` created | Proper crawl control |
| 8 | Sitemap generator command + daily schedule | SEO crawlability |
| 9 | Tour JSON-LD (`TouristTrip` + `BreadcrumbList`) | Rich snippets in search |
| 10 | Blog JSON-LD (`Article` + `BreadcrumbList`) | Rich snippets in search |
| 11 | Page-level caching on FrontendController (5-min TTL) | Reduced DB load |
| 12 | `CacheBustObserver` for auto-invalidation | Cache stays fresh |
| 13 | All JS scripts deferred | Non-render-blocking |
| 14 | CDN preconnect/dns-prefetch | Faster resource loading |
| 15 | LIKE wildcard injection fix in ContactController | Security hardening |
| 16 | `TodaysCallingList` lazy + `StatsOverview` polling 120s | Faster dashboard |
| 17 | Balance Due subquery moved inside cache | Eliminates uncached query |
| 18 | Navigation badges cached (60s) | 3 fewer queries per page |
| 19 | Eager loading on Enquiry + Booking resources | Eliminates N+1 |
| 20 | `Schema::hasTable` → config-based lookup | 39ms saved per model save |
| 21 | Report pages cached (5-min TTL) | 56 fewer queries on reports |
| 22 | Composite indexes on enquiries/bookings/payments | Faster report queries at scale |
| 23 | Slow query logging (>100ms) in local env | Debug visibility |
| 24 | `unsavedChangesAlerts()` on admin panel | Prevents data loss |
| 25 | Admin panel throttle (60 req/min) | Brute force protection |
| 26 | Tour image auto-resize on upload (1200×675) | Optimized images served |
| 27 | Health check endpoint (`/health`) | Monitoring ready |
| 28 | Custom error pages (404, 403, 500, 503) | Branded error experience |
| 29 | OwlCarousel → Swiper.js | ~140KB saved (jQuery + OwlCarousel removed) |
| 30 | jQuery removed — main.js rewritten to vanilla JS | Zero jQuery dependency |
| 31 | Font Awesome subsetting (solid + brands only) | ~60KB saved |
| 32 | AOS → IntersectionObserver | 15KB saved, no reflow |
| 33 | Cache-Control middleware (300s public, 600s s-maxage) | Browser caching for guests |
| 34 | Hero image preload on destination-detail | Faster LCP |
| 35 | DNS prefetch for wa.me + googletagmanager | Faster external requests |

---

## 📋 Deployment Checklist

After every deploy, run:
```bash
php artisan optimize
php artisan filament:optimize
php artisan sitemap:generate
php artisan view:clear && php artisan optimize
```

For Windows (Laragon):
```cmd
icacls storage /grant Users:(OI)(CI)(M) /T
```

---

## 📊 Current Performance Baseline

| Metric | Value | Notes |
|---|---|---|
| Dashboard stats query | 37ms | Cached for 60s |
| Calling list widget | 36ms | Should be lazy |
| Table widgets | 25ms | Already lazy |
| Nav badge queries | 9ms | Fires every page, should cache |
| Schema::hasTable (6 calls) | 39ms | Should use config |
| Revenue report | 23ms | Should cache |
| Sales report | 47ms | Should cache |
| Total DB tables | 43 | |
| Total records (all tables) | ~130 | Small dataset — perf issues are framework overhead, not data |

---

## Priority Implementation Order

1. ~~⚡ Make `TodaysCallingList` lazy + increase `StatsOverview` polling to 120s~~ ✅
2. ~~⚡ Move Balance Due subquery inside cache block~~ ✅
3. ~~⚡ Add eager loading to Enquiry and Booking resources~~ ✅
4. ~~🔧 Cache navigation badges~~ ✅
5. ~~🔧 Replace `Schema::hasTable` with config array~~ ✅
6. ~~🔧 Cache report page data~~ ✅
7. ~~🔧 Add composite indexes migration~~ ✅
8. 📦 Install `spatie/laravel-backup` (requires `composer require spatie/laravel-backup`)
9. ~~🎨 Add custom error pages~~ ✅
10. ~~🚀 Replace OwlCarousel with Swiper~~ ✅
11. ~~🚀 Remove jQuery, rewrite main.js to vanilla JS~~ ✅
12. ~~🚀 Font Awesome subsetting~~ ✅
13. ~~🚀 AOS → IntersectionObserver~~ ✅
14. ~~🚀 Cache-Control middleware~~ ✅
15. ~~🚀 Hero image preload + DNS prefetch~~ ✅
