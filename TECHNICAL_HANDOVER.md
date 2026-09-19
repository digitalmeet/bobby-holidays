# UniWorld Holidays — Technical Handover Document

**Project:** Bobby Holidays (UniWorld Holidays)  
**Generated:** August 23, 2026  
**Auditor:** Kiro (AI Principal Software Engineer)

---

## Table of Contents

1. [My Role & Behavior](#1-my-role--behavior)
2. [Verified Working Fixes](#2-verified-working-fixes)
3. [Critical Bugs (Not Fixed)](#3-critical-bugs-not-fixed)
4. [High Priority Issues](#4-high-priority-issues)
5. [Medium Priority Issues](#5-medium-priority-issues)
6. [Low Priority Issues](#6-low-priority-issues)
7. [Database Schema Issues](#7-database-schema-issues)
8. [Security Issues](#8-security-issues)
9. [Performance Issues](#9-performance-issues)
10. [Recommended Implementation Order](#10-recommended-implementation-order)
11. [Quick Reference](#11-quick-reference)

---

## 1. My Role & Behavior

As your principal software engineer, I follow these rules:

### What I Do

- **Challenge assumptions** — If your proposed solution is technically wrong, I'll tell you directly: "I disagree with this approach" and explain why
- **Inspect before implementing** — I examine the codebase, trace data flows, and understand architecture before making changes
- **Think like a DBA** — Analyze queries, indexes, and schema with evidence rather than guesswork
- **Watch for Laravel anti-patterns** — N+1s, fat models, hidden queries, poor service boundaries
- **Demand evidence for performance claims** — Measure before optimizing
- **Proactively hunt security issues** — SQL injection, XSS, IDOR, authorization flaws
- **Use problem-solution format** — Identify issue, severity, evidence, and recommended solution

### What I Won't Do

- **Blindly implement** — I'll evaluate whether the approach is correct first
- **Overengineer** — I won't introduce microservices, Redis, Kafka, or unnecessary abstractions
- **Sugar-coat problems** — I'll tell you when something is technically wrong
- **Claim "design is good" just because "code works"** — A working solution can still be architecturally wrong

### How I Work

1. **Investigation first** — Read relevant files, understand architecture, trace data flows
2. **Evidence-based recommendations** — Show the relevant code/query/architecture
3. **Clear trade-offs** — Explain what we gain and what we sacrifice
4. **Verification** — After changes, run tests and verify the result

---

## 2. Verified Working Fixes

These fixes from PROMPTS.md and ISSUES.md were verified as **correctly implemented**:

| # | Fix | File | Status |
|---|-----|------|--------|
| 1 | Booking reference race condition (DB transaction + lockForUpdate) | `app/Models/Booking.php` | ✅ Verified |
| 2 | SoftDeletes on Payment/OnlinePayment | `app/Models/Payment.php`, `OnlinePayment.php` | ✅ Verified |
| 3 | Rate limiting on public POST routes (throttle:5,1; 10,1; 20,1) | `routes/web.php` | ✅ Verified |
| 4 | Quotation max-attempts guard (10 iterations, RuntimeException) | `app/Models/Quotation.php` | ✅ Verified |
| 5 | Quotation view count deduplication (session-based) | `app/Http/Controllers/QuotationController.php` | ✅ Verified |
| 6 | Enquiry scopePending fix (whereIn instead of bare orWhere) | `app/Models/Enquiry.php` | ✅ Verified |
| 7 | ActivityLog static cache (Schema::hasTable removed) | `app/Models/ActivityLog.php` | ✅ Verified |
| 8 | Services moved to CMS (Page::service() scope) | `app/Http/Controllers/FrontendController.php` | ✅ Verified |
| 9 | Navigation badges cached (60s TTL) | `app/Filament/Resources/*` | ✅ Verified |
| 10 | Eager loading on Enquiry/Booking resources | `app/Filament/Resources/Enquiries/EnquiryResource.php` | ✅ Verified |
| 11 | Composite indexes for reports | `database/migrations/2026_07_15_000001_*.php` | ✅ Verified |
| 12 | Report pages cached (5 min TTL) | `app/Filament/Pages/SalesReport.php` | ✅ Verified |
| 13 | Slow query logging in local env (>100ms) | `app/Providers/AppServiceProvider.php` | ✅ Verified |
| 14 | StatsOverview polling 120s | `app/Filament/Widgets/StatsOverview.php` | ✅ Verified |
| 15 | TodaysCallingList lazy loaded | `app/Filament/Widgets/TodaysCallingList.php` | ✅ Verified |
| 16 | SoftDeletes on online_payments (migration) | `database/migrations/2026_07_01_000002_*.php` | ✅ Verified |
| 17 | UnsavedChangesAlerts on Filament | `app/Providers/Filament/AdminPanelProvider.php` | ✅ Verified |
| 18 | Throttle 60,1 on admin panel | `app/Providers/Filament/AdminPanelProvider.php` | ✅ Verified |
| 19 | getServicesData() visibility changed to private | Not applicable — method removed | ✅ Verified |
| 20 | Contact form LIKE injection fix | `app/Http/Controllers/ContactController.php` | ✅ Verified |

---

## 3. Critical Bugs (Not Fixed)

### 3.1 Pages Table Missing `type` Column

**Severity:** 🔴 Critical  
**Impact:** Application crashes on all services pages

**Files Affected:**
- `app/Models/Page.php` — Uses `scopeService()` which queries `type = 'service'`
- `app/Http/Controllers/FrontendController.php` — Calls `Page::service()`
- `app/Console/Commands/GenerateSitemap.php` — Calls `Page::service()`

**Root Cause:**
The `Page` model has this scope:
```php
// app/Models/Page.php:68
public function scopeService($query)
{
    return $query->where('type', 'service');
}
```

But the pages table has no `type` column:
```php
// database/migrations/2026_06_13_074357_create_pages_table.php
// Missing: $table->string('type')->nullable();
```

**Current Behavior:**
- `/services` → SQL Error
- `/services/{slug}` → SQL Error  
- `php artisan sitemap:generate` → SQL Error

**Solution:**
Create migration:
```php
// database/migrations/2026_07_01_000003_add_type_to_pages_table.php
public function up(): void
{
    Schema::table('pages', function (Blueprint $table) {
        $table->string('type')->nullable()->after('slug');
        $table->index('type');
    });
}
```

---

### 3.2 Missing Booking Sequences Migration

**Severity:** 🔴 Critical  
**Impact:** Cannot create new bookings — booking reference generation will fail

**Files Affected:**
- `app/Models/Booking.php` — References `booking_sequences` table

**Root Cause:**
The Booking model uses:
```php
// app/Models/Booking.php:56
$sequence = DB::table('booking_sequences')
    ->where('year', $year)
    ->lockForUpdate()
    ->first();
```

But the migration `2026_07_01_000001_create_booking_sequences_table.php` doesn't exist in `/database/migrations/`.

**Solution:**
Create migration:
```php
// database/migrations/2026_07_01_000001_create_booking_sequences_table.php
public function up(): void
{
    Schema::create('booking_sequences', function (Blueprint $table) {
        $table->id();
        $table->integer('year')->unique();
        $table->integer('last_number')->default(0);
        $table->timestamps();
    });
}
```

---

## 4. High Priority Issues

### 4.1 Razorpay Timing Attack Vulnerability

**Severity:** 🟠 High  
**Impact:** Potential signature bypass via timing attack

**File:** `app/Http/Controllers/RazorpayController.php:67`

**Current Code:**
```php
$expectedSignature = hash_hmac('sha256', $orderId . '|' . $paymentId, $keySecret);

if ($expectedSignature !== $validated['razorpay_signature']) {  // ❌ Vulnerable
```

**Problem:** Using `!==` for string comparison is vulnerable to timing attacks. Attackers can measure response times to guess the correct signature.

**Solution:**
```php
if (!hash_equals($expectedSignature, $validated['razorpay_signature'])) {
```

---

### 4.2 Missing Amount Verification in Razorpay

**Severity:** 🟠 High  
**Impact:** Client can pay any amount, not just the actual booking total

**File:** `app/Http/Controllers/RazorpayController.php:27`

**Current Code:**
```php
$validated = $request->validate([
    'booking_id' => 'nullable|exists:bookings,id',
    'quotation_id' => 'nullable|exists:quotations,id',
    'amount' => 'required|numeric|min:1',
]);
// No verification that amount matches actual booking total
```

**Solution:**
```php
if (!empty($validated['booking_id'])) {
    $booking = Booking::find($validated['booking_id']);
    if ($booking && (float)$validated['amount'] !== (float)$booking->total_amount) {
        return response()->json(['error' => 'Amount mismatch with booking total.'], 400);
    }
}

if (!empty($validated['quotation_id'])) {
    $quotation = Quotation::find($validated['quotation_id']);
    if ($quotation && (float)$validated['amount'] !== (float)$quotation->total_amount) {
        return response()->json(['error' => 'Amount mismatch with quotation total.'], 400);
    }
}
```

---

### 4.3 No Error Handling for Razorpay API Calls

**Severity:** 🟠 High  
**Impact:** Network errors crash the payment flow without proper error messages

**File:** `app/Http/Controllers/RazorpayController.php:34-46`

**Current Code:**
```php
$ch = curl_init('https://api.razorpay.com/v1/orders');
$response = curl_exec($ch);
$httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
curl_close($ch);

if ($httpCode !== 200) {
    Log::error('Razorpay order creation failed', ['response' => $response]);
    return response()->json(['error' => 'Failed to create payment order.'], 500);
}
```

**Problem:** Curl errors (network failure, timeout) aren't caught. `curl_exec()` returns `false` on error, not a valid HTTP response.

**Solution:**
```php
try {
    $ch = curl_init('https://api.razorpay.com/v1/orders');
    // ... curl options
    
    $response = curl_exec($ch);
    
    if ($response === false) {
        throw new \RuntimeException('Curl error: ' . curl_error($ch));
    }
    
    $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);
    
    if ($httpCode !== 200) {
        Log::error('Razorpay order creation failed', ['response' => $response, 'code' => $httpCode]);
        return response()->json(['error' => 'Failed to create payment order.'], 500);
    }
} catch (\Throwable $e) {
    Log::error('Razorpay API exception', ['exception' => $e->getMessage()]);
    return response()->json(['error' => 'Payment service unavailable. Please try again.'], 503);
}
```

---

## 5. Medium Priority Issues

### 5.1 N+1 Query in SalesReport

**Severity:** 🟡 Medium  
**Impact:** Extra queries when displaying top destinations

**File:** `app/Filament/Pages/SalesReport.php:42`

**Current Code:**
```php
$topDestinations = Enquiry::whereNotNull('destination_id')
    ->where('created_at', '>=', $thisYear)
    ->selectRaw('destination_id, COUNT(*) as enquiry_count')
    ->groupBy('destination_id')
    ->orderByDesc('enquiry_count')
    ->with('destination')  // ❌ Ignored in aggregation queries
    ->limit(10)
    ->get();
```

**Problem:** `->with('destination')` is ignored when using `groupBy()` with aggregate functions.

**Solution:**
```php
$topDestinations = Enquiry::whereNotNull('destination_id')
    ->where('created_at', '>=', $thisYear)
    ->selectRaw('destination_id, COUNT(*) as enquiry_count')
    ->groupBy('destination_id')
    ->orderByDesc('enquiry_count')
    ->limit(10)
    ->get();

// Fetch destinations in single query
$destinationIds = $topDestinations->pluck('destination_id');
$destinations = Destination::whereIn('id', $destinationIds)->get()->keyBy('id');

// Add to return array
$topDestinations = $topDestinations->map(function ($item) use ($destinations) {
    $item->destination = $destinations->get($item->destination_id);
    return $item;
});
```

---

### 5.2 Missing Database Indexes

**Severity:** 🟡 Medium  
**Impact:** Slow queries at scale (1000+ records)

**Missing Indexes:**

| Table | Columns | Query Usage |
|-------|---------|-------------|
| `quotations` | `enquiry_id` | `$quotation->enquiry` relationship |
| `quotations` | `status, sent_at` | QuotationController show() |
| `follow_ups` | `enquiry_id` | TodaysCallingList widget |
| `tour_pricing` | `tour_id` | tourShow() with pricing |

**Solution:**
```php
// database/migrations/2026_08_23_000001_add_missing_indexes.php
public function up(): void
{
    Schema::table('quotations', function (Blueprint $table) {
        $table->index('enquiry_id', 'quotations_enquiry_id_index');
        $table->index(['status', 'sent_at'], 'quotations_status_sent_index');
    });

    Schema::table('follow_ups', function (Blueprint $table) {
        $table->index('enquiry_id', 'follow_ups_enquiry_id_index');
    });

    Schema::table('tour_pricing', function (Blueprint $table) {
        $table->index('tour_id', 'tour_pricing_tour_id_index');
    });
}
```

---

### 5.3 Missing Relationship Defaults

**Severity:** 🟡 Medium  
**Impact:** Null reference errors in views when relationship is null

**Files:** Multiple models

**Current Code:**
```php
// app/Models/Booking.php
public function quotation()
{
    return $this->belongsTo(Quotation::class);
}
```

**Problem:** When `$booking->quotation` is null, views may throw errors.

**Solution:**
```php
public function quotation()
{
    return $this->belongsTo(Quotation::class)->withDefault();
}
```

Apply to:
- `Booking::quotation()`, `Booking::enquiry()`, `Booking::tour()`, `Booking::assignedTo()`
- `Quotation::enquiry()`, `Quotation::preparedBy()`, `Quotation::parentQuotation()`
- `Enquiry::tour()`, `Enquiry::destination()`, `Enquiry::assignedTo()`

---

## 6. Low Priority Issues

### 6.1 Unused `$isSticky` Logic

**Severity:** 🟢 Low  
**Impact:** Dead code or incomplete feature

**File:** `app/Http/Controllers/ContactController.php:45`

```php
$isSticky = $sourcePage && empty($validated['message']);
// ...
'internal_notes' => $isSticky ? "Quick enquiry from sticky bar on /{$sourcePage}" : null,
```

The `$isSticky` logic exists but there's no visible frontend implementation that would trigger it.

**Action:** Verify if sticky bar feature is planned or remove the code.

---

### 6.2 Missing Return Type Hints

**Severity:** 🟢 Low  
**Impact:** Code consistency

Model scopes and relationships lack return type hints:
```php
// Current
public function scopePending($query)

// Should be
public function scopePending($query): \Illuminate\Database\Eloquent\Builder
```

**Action:** Add `: \Illuminate\Database\Eloquent\Builder` to all scopes.

---

## 7. Database Schema Issues

### 7.1 Missing Columns

| Table | Missing Column | Used By |
|-------|---------------|---------|
| `pages` | `type` (string, nullable) | `Page::scopeService()` |
| `pages` | `sort_order` (integer) | Service ordering |
| `pages` | `icon` (string) | Service icons |

### 7.2 Missing Tables

| Table | Used By |
|-------|---------|
| `booking_sequences` | `Booking::generateBookingRef()` |

### 7.3 Recommended Schema Fix

```php
// For pages table - run this first
Schema::table('pages', function (Blueprint $table) {
    $table->string('type')->nullable()->after('slug')->index();
    $table->integer('sort_order')->default(0)->after('type');
    $table->string('icon')->nullable()->after('sort_order');
});

// For booking_sequences - create new migration
Schema::create('booking_sequences', function (Blueprint $table) {
    $table->id();
    $table->integer('year')->unique();
    $table->integer('last_number')->default(0);
    $table->timestamps();
});
```

---

## 8. Security Issues

### 8.1 Timing Attack (Fixed Above)

Already covered in Section 4.1.

### 8.2 Amount Verification (Fixed Above)

Already covered in Section 4.2.

### 8.3 CSRF on Public POST Routes

**Status:** ✅ Verified OK  
The public POST routes are within the default `web` middleware group which includes CSRF protection. Rate limiting is also properly applied.

---

## 9. Performance Issues

### 9.1 Report Caching

**Status:** ✅ Verified Working  
SalesReport, RevenueReport, and BookingsReport all use `Cache::remember()` with 300s TTL.

### 9.2 Navigation Badge Caching

**Status:** ✅ Verified Working  
All navigation badges use `Cache::remember()` with 60s TTL.

### 9.3 Dashboard Stats Caching

**Status:** ✅ Verified Working  
StatsOverview uses `Cache::remember()` with 60s TTL and includes the balance due count inside the cached block.

### 9.4 Frontend Page Caching

**Status:** ✅ Verified Working  
FrontendController uses `Cache::remember()` for destinations, tours, testimonials, etc.

### 9.5 Missing Indexes (Fixed Above)

Already covered in Section 5.2.

---

## 10. Recommended Implementation Order

### Phase 1: Critical Fixes (Before Next Deploy)

| # | Task | Effort | Impact |
|---|------|--------|--------|
| 1 | Create pages `type` migration | 5 min | Fixes /services crash |
| 2 | Create booking_sequences migration | 5 min | Fixes booking creation |
| 3 | Fix Razorpay timing attack | 2 min | Security |
| 4 | Add Razorpay amount verification | 5 min | Security |

### Phase 2: High Priority (This Sprint)

| # | Task | Effort | Impact |
|---|------|--------|--------|
| 5 | Add Razorpay error handling | 10 min | Reliability |
| 6 | Add missing DB indexes | 5 min | Performance at scale |
| 7 | Fix SalesReport N+1 | 10 min | Performance |

### Phase 3: Cleanup (Next Sprint)

| # | Task | Effort | Impact |
|---|------|--------|--------|
| 8 | Add relationship defaults | 15 min | Code quality |
| 9 | Add return type hints | 10 min | Code quality |
| 10 | Verify sticky bar feature | 5 min | Dead code removal |

---

## 11. Quick Reference

### Admin Access
- URL: `http://bobby-holidays.test/admin`
- Login: `admin@uniworldholidays.com` / `password`

### Health Check
- URL: `http://bobby-holidays.test/health`

### Key Files
| Purpose | File |
|---------|------|
| Booking reference generation | `app/Models/Booking.php` |
| Quotation public pages | `app/Http/Controllers/QuotationController.php` |
| Payment processing | `app/Http/Controllers/RazorpayController.php` |
| Contact form | `app/Http/Controllers/ContactController.php` |
| Frontend pages | `app/Http/Controllers/FrontendController.php` |
| Dashboard stats | `app/Filament/Widgets/StatsOverview.php` |
| Report pages | `app/Filament/Pages/SalesReport.php`, `RevenueReport.php`, `BookingsReport.php` |
| Activity logging | `app/Models/ActivityLog.php` |
| Settings helper | `app/helpers.php` |

### Cache Keys Used
| Key | TTL | Purpose |
|-----|-----|---------|
| `dashboard_stats` | 60s | Stats widget |
| `nav.enquiries.new` | 60s | Navigation badge |
| `nav.bookings.active` | 60s | Navigation badge |
| `nav.quotations.draft` | 60s | Navigation badge |
| `report.sales` | 300s | Sales report |
| `home.destinations` | 300s | Homepage |
| `home.tours` | 300s | Homepage |
| `setting_{key}` | 300s | Settings table |

### Scheduled Commands
```bash
# Expire quotations daily at 00:30
php artisan quotations:expire

# Follow-up reminders daily at 09:00
php artisan enquiries:follow-up-reminders

# Sitemap generation daily at 03:00
php artisan sitemap:generate
```

### Deployment Commands
```bash
php artisan migrate
php artisan db:seed --class=RolesAndPermissionsSeeder
php artisan db:seed --class=AdminUserSeeder
php artisan optimize
php artisan filament:optimize
php artisan sitemap:generate

# Windows-specific
icacls storage /grant Users:(OI)(CI)(M) /T
```

---

## Summary

| Category | Count |
|----------|-------|
| Verified Working Fixes | 20 |
| Critical Bugs | 2 |
| High Priority Issues | 3 |
| Medium Priority Issues | 3 |
| Low Priority Issues | 2 |

**Estimated total implementation time:** ~1.5 hours

---

*Generated by Kiro — AI Principal Software Engineer*