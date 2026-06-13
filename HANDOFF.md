# UniWorld Holidays — Developer Handoff Document

---

## 1. PROJECT OVERVIEW

| Field | Details |
|---|---|
| Brand | UniWorld Holidays |
| Project Folder | `bobby-holidays` |
| Local URL | `http://bobby-holidays.test` |
| Admin Panel URL | `http://bobby-holidays.test/admin` |
| Theme Color | `#064f68` |
| Document Date | 2026-06-12 |

---

## 2. TECH STACK

| Layer | Technology | Version |
|---|---|---|
| Framework | Laravel | 13.x |
| Language | PHP | 8.4.12 |
| Admin Panel | Filament | 5.6+ |
| Reactive UI | Livewire | 4.3+ |
| Database | MySQL | 8.x (via Laragon) |
| Media Library | Spatie Laravel Medialibrary | Latest |
| Permissions | Spatie Laravel Permission | Latest |
| PDF | barryvdh/laravel-dompdf | Latest |
| Dev Server | Laragon | Local |

---

## 3. COMPLETED TASKS SUMMARY

| Task | Description | Status |
|---|---|---|
| Task 1 | Laravel project scaffold | ✅ Done |
| Task 2 | Filament admin foundation + dynamic permissions | ✅ Done |
| Task 3 | Core travel content migrations (destinations, tours, tour_pricing) | ✅ Done |
| Task 4 | Enquiries & quotations migrations (first pass) | ✅ Done |
| Task 5 | Enquiries & quotations migrations (final corrected) | ✅ Done |
| Task 6 | Bookings, travellers, payments migrations | ✅ Done |

---

## 4. ENVIRONMENT SETUP

### `.env` Key Settings
```env
APP_NAME="UniWorld Holidays"
APP_ENV=local
APP_URL=http://bobby-holidays.test

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=bobby_holidays
DB_USERNAME=root
DB_PASSWORD=
```

### Local Development Commands
```bash
# Run all migrations fresh
php artisan migrate:fresh

# Run seeders
php artisan db:seed

# Clear all caches
php artisan optimize:clear

# Start queue worker
php artisan queue:work
```

---

## 5. DIRECTORY STRUCTURE (Key Paths)

```
bobby-holidays/
├── app/
│   ├── Http/Controllers/
│   ├── Models/              ← Models to be created next
│   └── Providers/
│       └── Filament/        ← Filament panel providers
├── config/
│   └── admin-modules.php    ← Dynamic permission module config
├── database/
│   ├── migrations/          ← All migrations (see Section 7)
│   └── seeders/
│       ├── AdminUserSeeder.php
│       ├── DatabaseSeeder.php
│       └── RolesAndPermissionsSeeder.php
├── resources/views/
│   └── frontend/            ← Frontend Blade views
└── routes/
    └── web.php              ← Frontend routes
```


---

## 6. PERMISSION SYSTEM

Permissions are fully dynamic, driven by `config/admin-modules.php`.

### How It Works
- Permissions are auto-generated from `config/admin-modules.php` in the format `{action}_{module}`
- The seeder reads this config and creates all roles + permissions in one pass
- No hardcoded permission strings anywhere in the codebase

### Roles Defined

| Role | Access Level |
|---|---|
| `super_admin` | All permissions automatically |
| `sales` | Enquiries, quotations, bookings (view only), payments (view only) |
| `operations` | Bookings, travellers, payments, quotations (view/pdf only) |
| `content` | Destinations, tours, pricing, pages, posts, banners, testimonials, FAQs |

### Modules in `config/admin-modules.php`

| Module | Actions |
|---|---|
| destinations | view, create, edit, delete, restore, force_delete |
| tours | view, create, edit, delete, restore, force_delete, duplicate, publish |
| tour_pricing | view, create, edit, delete, restore |
| enquiries | view, create, edit, delete, restore, assign, mark_contacted, mark_lost, convert |
| quotations | view, create, edit, delete, restore, send, download_pdf, create_version, accept, reject, request_changes, copy_public_link |
| quotation_items | view, create, edit, delete, restore |
| bookings | view, create, edit, delete, restore, cancel, complete, confirm |
| payments | view, create, edit, delete, restore, refund |
| travellers | view, create, edit, delete, restore |
| pages | view, create, edit, delete, restore, publish |
| posts | view, create, edit, delete, restore, publish |
| banners | view, create, edit, delete, restore |
| testimonials | view, create, edit, delete, restore |
| faqs | view, create, edit, delete, restore |
| settings | view, edit |
| users | view, create, edit, delete, restore |
| roles | view, create, edit, delete |

### Using Permissions in Code
```php
// In Filament Resources
public static function canCreate(): bool
{
    return auth()->user()->can('create_tours');
}

// In Blade / Controllers
@can('edit_bookings')
    ...
@endcan

// Gate check
Gate::allows('delete_enquiries');
```

---

## 7. MIGRATION REGISTRY

All migrations are in `database/migrations/`. Listed in execution order.

| # | File | Table | Batch |
|---|---|---|---|
| 1 | `0001_01_01_000000_create_users_table.php` | users | 1 |
| 2 | `0001_01_01_000001_create_cache_table.php` | cache, cache_locks | 1 |
| 3 | `0001_01_01_000002_create_jobs_table.php` | jobs, job_batches, failed_jobs | 1 |
| 4 | `2026_06_12_000001_create_destinations_table.php` | destinations | 1 |
| 5 | `2026_06_12_125814_create_media_table.php` | media | 1 |
| 6 | `2026_06_12_130123_create_permission_tables.php` | permissions, roles, model_has_permissions, model_has_roles, role_has_permissions | 1 |
| 7 | `2026_06_12_141405_create_tours_table.php` | tours | 1 |
| 8 | `2026_06_12_141412_create_tour_pricing_table.php` | tour_pricing | 1 |
| 9 | `2026_06_12_141619_create_enquiries_table.php` | enquiries | 1 |
| 10 | `2026_06_12_141630_create_quotations_table.php` | quotations | 1 |
| 11 | `2026_06_12_141653_create_quotation_sections_table.php` | quotation_sections | 1 |
| 12 | `2026_06_12_141704_create_quotation_items_table.php` | quotation_items | 1 |
| 13 | `2026_06_12_141709_create_quotation_histories_table.php` | quotation_histories | 1 |
| 14 | `2026_06_12_142100_create_bookings_table.php` | bookings | 1 |
| 15 | `2026_06_12_142200_create_payments_table.php` | payments | 1 |
| 16 | `2026_06_12_142300_create_travellers_table.php` | travellers | 1 |
| 17 | `2026_06_12_142400_create_booking_status_histories_table.php` | booking_status_histories | 1 |
| 18 | `2026_06_12_142500_create_payment_histories_table.php` | payment_histories | 1 |

> IMPORTANT: Migration order matters. The bookings-related migrations were deliberately renamed to ensure correct FK resolution:
> - `bookings` (142100) must run before `payments` (142200), `travellers` (142300), `booking_status_histories` (142400), and `payment_histories` (142500)
> - `payments` (142200) must run before `payment_histories` (142500)


---

## 8. DATABASE SCHEMA REFERENCE

### Global Schema Rules Applied
- softDeletes on all main business tables (not history tables)
- Every foreign key has an index
- nullOnDelete where business history must be preserved
- cascadeOnDelete only for child records that cannot exist without parent
- No global activity_log — dedicated history tables per domain
- No integer IDs exposed publicly (public_id / booking_ref used instead)

---

### Table: `destinations`
| Column | Type | Notes |
|---|---|---|
| id | bigIncrements | PK |
| slug | string, unique | URL-friendly identifier |
| name | string | |
| country | string, nullable | |
| continent | string, nullable | |
| short_description | text, nullable | |
| description | longText, nullable | |
| highlights | json, nullable | |
| hero_image | string, nullable | |
| gallery | json, nullable | |
| meta_title | string, nullable | SEO |
| meta_description | text, nullable | SEO |
| og_image | string, nullable | SEO |
| is_featured | boolean, default false | |
| is_active | boolean, default true | |
| sort_order | integer, default 0 | |
| deleted_at | timestamp, nullable | softDeletes |
| created_at / updated_at | timestamps | |

Indexes: `slug`, `is_active`, `is_featured`, `country`, `continent`, `sort_order`

---

### Table: `tours`
| Column | Type | Notes |
|---|---|---|
| id | bigIncrements | PK |
| destination_id | FK → destinations, nullOnDelete, nullable | |
| slug | string, unique | |
| title | string | |
| subtitle | string, nullable | |
| duration_days | unsignedSmallInt, default 1 | |
| duration_nights | unsignedSmallInt, default 0 | |
| overview | longText, nullable | |
| highlights | json, nullable | |
| inclusions | json, nullable | |
| exclusions | json, nullable | |
| itinerary | json, nullable | |
| hero_image | string, nullable | |
| gallery | json, nullable | |
| starting_price | decimal(12,2), nullable | |
| price_type | string, default 'per_person' | |
| min_group_size | unsignedSmallInt, default 1 | |
| max_group_size | unsignedSmallInt, nullable | |
| difficulty_level | string, nullable | |
| category | string, nullable | |
| is_featured | boolean, default false | |
| is_active | boolean, default true | |
| sort_order | integer, default 0 | |
| meta_title | string, nullable | SEO |
| meta_description | text, nullable | SEO |
| og_image | string, nullable | SEO |
| published_at | timestamp, nullable | |
| deleted_at | timestamp, nullable | softDeletes |
| created_at / updated_at | timestamps | |

Indexes: `destination_id`, `slug`, `category`, `is_featured`, `is_active`, `published_at`, `sort_order`

---

### Table: `tour_pricing`
| Column | Type | Notes |
|---|---|---|
| id | bigIncrements | PK |
| tour_id | FK → tours, cascadeOnDelete | |
| label | string | e.g. "Peak Season", "Early Bird" |
| price_per_person | decimal(12,2) | |
| child_price | decimal(12,2), nullable | |
| infant_price | decimal(12,2), nullable | |
| currency | string(3), default 'INR' | |
| valid_from | date, nullable | |
| valid_until | date, nullable | |
| is_active | boolean, default true | |
| sort_order | integer, default 0 | |
| deleted_at | timestamp, nullable | softDeletes |
| created_at / updated_at | timestamps | |

Indexes: `tour_id`, `is_active`, `valid_from`, `valid_until`

---

### Table: `enquiries`
| Column | Type | Notes |
|---|---|---|
| id | bigIncrements | PK |
| tour_id | FK → tours, nullOnDelete, nullable | |
| destination_id | FK → destinations, nullOnDelete, nullable | |
| name | string | |
| email | string, nullable | |
| phone | string | |
| country | string, nullable | |
| travel_date | date, nullable | |
| flexible_dates | boolean, default false | |
| duration_days | unsignedSmallInt, nullable | |
| adults | unsignedTinyInt, default 1 | |
| children | unsignedTinyInt, default 0 | |
| infants | unsignedTinyInt, default 0 | |
| budget_range | string, nullable | |
| message | text, nullable | |
| status | string, default 'new' | new, contacted, quoted, converted, lost |
| source | string, default 'website' | website, whatsapp, referral, walkin, instagram, facebook |
| assigned_to | FK → users, nullOnDelete, nullable | |
| last_contacted_at | timestamp, nullable | |
| follow_up_at | timestamp, nullable | |
| internal_notes | text, nullable | |
| ip_address | string, nullable | |
| user_agent | text, nullable | |
| deleted_at | timestamp, nullable | softDeletes |
| created_at / updated_at | timestamps | |

Indexes: `tour_id`, `destination_id`, `assigned_to`, `status`, `source`, `travel_date`, `follow_up_at`, `created_at`

---

### Table: `quotations`
| Column | Type | Notes |
|---|---|---|
| id | bigIncrements | PK (internal only) |
| public_id | string(12), unique | Used in public URLs |
| access_token | string(64), unique, nullable | Future secure link support |
| enquiry_id | FK → enquiries, nullOnDelete, nullable | |
| version | unsignedSmallInt, default 1 | Revision tracking |
| parent_quotation_id | FK → quotations, nullOnDelete, nullable | Self-referential |
| client_name | string | |
| client_email | string, nullable | |
| client_phone | string, nullable | |
| title | string | |
| travel_date | date, nullable | |
| return_date | date, nullable | |
| adults | unsignedTinyInt, default 1 | |
| children | unsignedTinyInt, default 0 | |
| infants | unsignedTinyInt, default 0 | |
| currency | string(3), default 'INR' | |
| subtotal_amount | decimal(12,2), default 0 | |
| discount_amount | decimal(12,2), default 0 | |
| tax_amount | decimal(12,2), default 0 | |
| total_amount | decimal(12,2), default 0 | |
| validity_date | date, nullable | |
| status | string, default 'draft' | draft, sent, viewed, accepted, rejected, expired, revised |
| personalised_message | text, nullable | |
| internal_notes | text, nullable | |
| terms_and_conditions | text, nullable | |
| prepared_by | FK → users, nullOnDelete, nullable | |
| sent_at | timestamp, nullable | |
| viewed_at | timestamp, nullable | |
| view_count | unsignedInt, default 0 | |
| accepted_at | timestamp, nullable | |
| rejected_at | timestamp, nullable | |
| rejection_reason | text, nullable | |
| deleted_at | timestamp, nullable | softDeletes |
| created_at / updated_at | timestamps | |

Indexes: `enquiry_id`, `parent_quotation_id`, `prepared_by`, `status`, `travel_date`, `validity_date`, `created_at`
Note: `public_id` and `access_token` are auto-indexed via unique constraint.

---

### Table: `quotation_sections`
| Column | Type | Notes |
|---|---|---|
| id | bigIncrements | PK |
| quotation_id | FK → quotations, cascadeOnDelete | |
| title | string | |
| description | text, nullable | |
| sort_order | integer, default 0 | |
| deleted_at | timestamp, nullable | softDeletes |
| created_at / updated_at | timestamps | |

Indexes: `quotation_id`, `sort_order`

---

### Table: `quotation_items`
| Column | Type | Notes |
|---|---|---|
| id | bigIncrements | PK |
| quotation_id | FK → quotations, cascadeOnDelete | |
| section_id | FK → quotation_sections, nullOnDelete, nullable | |
| sort_order | integer, default 0 | |
| type | string | accommodation, flight, transfer, activity, meal, visa, insurance, other |
| title | string | |
| description | text, nullable | |
| nights | unsignedTinyInt, nullable | |
| unit_cost | decimal(12,2), default 0 | |
| quantity | decimal(10,2), default 1 | |
| total_cost | decimal(12,2), default 0 | |
| is_included_in_total | boolean, default true | |
| is_optional | boolean, default false | |
| deleted_at | timestamp, nullable | softDeletes |
| created_at / updated_at | timestamps | |

Indexes: `quotation_id`, `section_id`, `type`, `sort_order`, `is_included_in_total`, `is_optional`

---

### Table: `quotation_histories`
| Column | Type | Notes |
|---|---|---|
| id | bigIncrements | PK |
| quotation_id | FK → quotations, nullOnDelete, nullable | |
| changed_by | FK → users, nullOnDelete, nullable | |
| event | string | created, sent, viewed, accepted, rejected, revised, total_changed, status_changed |
| old_status | string, nullable | |
| new_status | string, nullable | |
| old_total | decimal(12,2), nullable | |
| new_total | decimal(12,2), nullable | |
| notes | text, nullable | |
| meta | json, nullable | |
| created_at | timestamp, nullable | No updated_at — immutable audit log |

Indexes: `quotation_id`, `changed_by`, `event`, `created_at`

---

### Table: `bookings`
| Column | Type | Notes |
|---|---|---|
| id | bigIncrements | PK (internal only) |
| booking_ref | string, unique | Format: UW-YYYY-000001 (generated in model/service) |
| quotation_id | FK → quotations, nullOnDelete, nullable | |
| enquiry_id | FK → enquiries, nullOnDelete, nullable | |
| tour_id | FK → tours, nullOnDelete, nullable | |
| client_name | string | |
| client_email | string, nullable | |
| client_phone | string, nullable | |
| travel_date | date, nullable | |
| return_date | date, nullable | |
| adults | unsignedTinyInt, default 1 | |
| children | unsignedTinyInt, default 0 | |
| infants | unsignedTinyInt, default 0 | |
| total_amount | decimal(12,2), default 0 | |
| paid_amount | decimal(12,2), default 0 | |
| balance_amount | decimal(12,2), default 0 | |
| currency | string(3), default 'INR' | |
| status | string, default 'confirmed' | confirmed, partial_paid, fully_paid, completed, cancelled, refunded |
| cancellation_reason | text, nullable | |
| cancelled_at | timestamp, nullable | |
| special_requests | text, nullable | |
| internal_notes | text, nullable | |
| assigned_to | FK → users, nullOnDelete, nullable | |
| gst_number | string, nullable | |
| gst_amount | decimal(12,2), default 0 | |
| deleted_at | timestamp, nullable | softDeletes |
| created_at / updated_at | timestamps | |

Indexes: `booking_ref` (unique), `quotation_id`, `enquiry_id`, `tour_id`, `assigned_to`, `status`, `travel_date`, `created_at`

---

### Table: `payments`
| Column | Type | Notes |
|---|---|---|
| id | bigIncrements | PK |
| booking_id | FK → bookings, nullOnDelete, nullable | |
| amount | decimal(12,2) | |
| currency | string(3), default 'INR' | |
| method | string | cash, bank_transfer, upi, credit_card, cheque, online |
| reference_number | string, nullable | |
| payment_date | date | |
| status | string, default 'received' | pending, received, failed, refunded |
| notes | text, nullable | |
| receipt_path | string, nullable | |
| recorded_by | FK → users, nullOnDelete, nullable | |
| deleted_at | timestamp, nullable | softDeletes |
| created_at / updated_at | timestamps | |

Indexes: `booking_id`, `recorded_by`, `status`, `method`, `payment_date`, `reference_number`

---

### Table: `travellers`
| Column | Type | Notes |
|---|---|---|
| id | bigIncrements | PK |
| booking_id | FK → bookings, cascadeOnDelete | |
| type | string | adult, child, infant |
| title | string, nullable | Mr, Mrs, Ms, Master, Miss |
| first_name | string | |
| last_name | string | |
| email | string, nullable | |
| phone | string, nullable | |
| date_of_birth | date, nullable | |
| passport_number | string, nullable | |
| passport_expiry | date, nullable | |
| nationality | string, nullable | |
| notes | text, nullable | |
| deleted_at | timestamp, nullable | softDeletes |
| created_at / updated_at | timestamps | |

Indexes: `booking_id`, `type`, `passport_number`

---

### Table: `booking_status_histories`
| Column | Type | Notes |
|---|---|---|
| id | bigIncrements | PK |
| booking_id | FK → bookings, nullOnDelete, nullable | |
| changed_by | FK → users, nullOnDelete, nullable | |
| old_status | string, nullable | |
| new_status | string, nullable | |
| notes | text, nullable | |
| meta | json, nullable | |
| created_at | timestamp, nullable | No updated_at — immutable audit log |

Indexes: `booking_id`, `changed_by`, `old_status`, `new_status`, `created_at`

---

### Table: `payment_histories`
| Column | Type | Notes |
|---|---|---|
| id | bigIncrements | PK |
| payment_id | FK → payments, nullOnDelete, nullable | |
| booking_id | FK → bookings, nullOnDelete, nullable | |
| changed_by | FK → users, nullOnDelete, nullable | |
| event | string | created, received, failed, refunded, amount_changed, status_changed |
| old_status | string, nullable | |
| new_status | string, nullable | |
| old_amount | decimal(12,2), nullable | |
| new_amount | decimal(12,2), nullable | |
| notes | text, nullable | |
| meta | json, nullable | |
| created_at | timestamp, nullable | No updated_at — immutable audit log |

Indexes: `payment_id`, `booking_id`, `changed_by`, `event`, `created_at`


---

## 9. ENTITY RELATIONSHIP DIAGRAM (Text)

```
users
 ├── assigned_to ←── enquiries ──→ destinations
 │                       │         tours
 │                       ↓
 │                   quotations ──→ parent_quotation_id (self)
 │                       │
 │               ┌───────┴──────────┐
 │               ↓                  ↓
 │   quotation_sections     quotation_items
 │               │
 │               └──→ quotation_histories
 │
 └── assigned_to ←── bookings ──→ quotations
                         │         enquiries
                         │         tours
                     ┌───┴──────────────┐────────────────┐
                     ↓                  ↓                ↓
                 travellers         payments    booking_status_histories
                                       │
                               payment_histories
```

---

## 10. FOREIGN KEY DEPENDENCY MAP

```
users                               (no FK dependencies)
destinations                        (no FK dependencies)
tours              → destinations
tour_pricing       → tours
enquiries          → tours, destinations, users
quotations         → enquiries, quotations (self), users
quotation_sections → quotations
quotation_items    → quotations, quotation_sections
quotation_histories→ quotations, users
bookings           → quotations, enquiries, tours, users
payments           → bookings, users
travellers         → bookings
booking_status_histories → bookings, users
payment_histories  → payments, bookings, users
```

### Delete Behaviour Summary

| Parent Table | Child Table | Behaviour |
|---|---|---|
| destinations | tours | nullOnDelete |
| tours | tour_pricing | cascadeOnDelete |
| tours | enquiries | nullOnDelete |
| tours | bookings | nullOnDelete |
| destinations | enquiries | nullOnDelete |
| enquiries | quotations | nullOnDelete |
| enquiries | bookings | nullOnDelete |
| quotations | quotation_sections | cascadeOnDelete |
| quotations | quotation_items | cascadeOnDelete |
| quotations | quotation_histories | nullOnDelete |
| quotations | bookings | nullOnDelete |
| quotation_sections | quotation_items | nullOnDelete |
| users | enquiries (assigned_to) | nullOnDelete |
| users | quotations (prepared_by) | nullOnDelete |
| users | bookings (assigned_to) | nullOnDelete |
| users | payments (recorded_by) | nullOnDelete |
| users | quotation_histories (changed_by) | nullOnDelete |
| users | booking_status_histories (changed_by) | nullOnDelete |
| users | payment_histories (changed_by) | nullOnDelete |
| bookings | travellers | cascadeOnDelete |
| bookings | payments | nullOnDelete |
| bookings | booking_status_histories | nullOnDelete |
| bookings | payment_histories | nullOnDelete |
| payments | payment_histories | nullOnDelete |

---

## 11. KNOWN ISSUES & FIXES APPLIED

### Issue 1: `payment_histories` FK to `payments` — Table Not Found
- **Root cause**: Laravel runs migrations in alphabetical order by filename. `payment_histories` (142357) ran before `payments` (142537), so the FK constraint failed.
- **Fix applied**: Renamed `payments` migration from `142537` → `142200` so it runs before `payment_histories`.
- **Lesson**: Always ensure parent table migrations have earlier timestamps than child table migrations.

### Issue 2: `payments` FK to `bookings` — Table Not Found
- **Root cause**: Same ordering issue. `payments` was renamed to `142200` but `bookings` was at `142247`, which still runs after.
- **Fix applied**: Renamed `bookings` from `142247` → `142100`.

### Final Correct Migration Order for Task 6 Tables
```
142100  bookings              (parent of all below)
142200  payments              (→ bookings)
142300  travellers            (→ bookings)
142400  booking_status_histories (→ bookings)
142500  payment_histories     (→ payments, bookings)
```

---

## 12. BOOKING REFERENCE FORMAT

The `booking_ref` field stores a human-readable, unique reference number. It is NOT auto-generated by the migration — it must be generated in a model boot method or a dedicated service.

### Recommended Implementation (to be built in model phase)
```php
// In App\Models\Booking boot():
protected static function booted(): void
{
    static::creating(function (Booking $booking) {
        $booking->booking_ref = 'UW-' . now()->format('Y') . '-' . str_pad(
            Booking::withTrashed()->count() + 1,
            6, '0', STR_PAD_LEFT
        );
    });
}
```

---

## 13. PUBLIC QUOTATION URL DESIGN

Public-facing quotation pages must never expose the integer `id`.

| Field | Purpose | Example |
|---|---|---|
| `public_id` | 12-char public lookup key | `XK9M2P4R7TQA` |
| `access_token` | 64-char secure token for private links | `a3f9...` |

### Recommended URL Patterns
```
/quote/XK9M2P4R7TQA              ← Public view (no auth)
/quote/XK9M2P4R7TQA?token=...   ← Secure link (future)
```

### Generation (to be built in model phase)
```php
static::creating(function (Quotation $quotation) {
    $quotation->public_id = strtoupper(Str::random(12));
    $quotation->access_token = Str::random(64);
});
```

---

## 14. FRONTEND ROUTES (Current)

Defined in `routes/web.php`:

| Route | View | Name |
|---|---|---|
| `/` | frontend.home | frontend.home |
| `/about-us` | frontend.about | frontend.about |
| `/domestic-packages` | frontend.packages-domestic | frontend.domestic |
| `/international-packages` | frontend.packages-international | frontend.international |
| `/services` | frontend.services | frontend.services |
| `/gallery` | frontend.gallery | frontend.gallery |
| `/faq` | frontend.faq | frontend.faq |
| `/blog` | frontend.blog | frontend.blog |
| `/packages/kashmir-delight` | frontend.package-detail | frontend.package.show |
| `/blog/family-holiday-planning` | frontend.blog-detail | frontend.blog.show |
| `/contact-us` | frontend.contact | frontend.contact |
| `/privacy-policy` | frontend.privacy | frontend.privacy |
| `/terms-conditions` | frontend.terms | frontend.terms |

> Note: All static for now. Dynamic routes for tours, destinations, packages, and quotations to be added when models and controllers are built.

---

## 15. WHAT'S NEXT (Recommended Task Order)

| Priority | Task | Description |
|---|---|---|
| 1 | Eloquent Models | Create models for all 15 tables with relationships, casts, fillable, softDeletes |
| 2 | Booking Ref Service | Implement `UW-YYYY-000001` booking reference generation |
| 3 | Public ID Generation | Implement `public_id` and `access_token` auto-generation in Quotation model |
| 4 | Filament Resources | Build Filament admin resources for all modules |
| 5 | Enquiry Resource | List, create, edit, assign, follow-up, convert to quotation |
| 6 | Quotation Builder | Section/item builder, PDF export, public view page |
| 7 | Booking Resource | Create from quotation, traveller management, status tracking |
| 8 | Payment Resource | Record payments, auto-update booking paid/balance amounts |
| 9 | Dashboard | KPI widgets (enquiries today, bookings this month, revenue) |
| 10 | Frontend Dynamic Routes | Tour/destination detail, package listing, contact form submission |
| 11 | Seeders | Test data seeders for development |
| 12 | PDF Templates | Quotation PDF template using dompdf |

---

## 16. USEFUL COMMANDS

```bash
# Full fresh migration
php artisan migrate:fresh

# Fresh + seed
php artisan migrate:fresh --seed

# Check migration status
php artisan migrate:status

# Rollback last batch
php artisan migrate:rollback

# Rollback N batches
php artisan migrate:rollback --step=3

# Clear config cache
php artisan config:clear

# Clear all caches
php artisan optimize:clear

# Generate Filament resource (when ready)
php artisan make:filament-resource Tour --generate

# Run seeders only
php artisan db:seed
php artisan db:seed --class=RolesAndPermissionsSeeder
php artisan db:seed --class=AdminUserSeeder
```

---

*Document generated: 2026-06-12 | Project: UniWorld Holidays | bobby-holidays*
