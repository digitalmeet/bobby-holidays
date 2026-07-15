<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Known Activity Log Tables
    |--------------------------------------------------------------------------
    |
    | List of module log tables that exist in the database. Used by ActivityLog
    | to avoid expensive Schema::hasTable() queries on every model save.
    |
    */
    'tables' => [
        'enquiry_logs',
        'booking_logs',
        'quotation_logs',
        'payment_logs',
        'online_payment_logs',
        'tour_logs',
        'page_logs',
    ],
];
