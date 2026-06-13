<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Admin Modules Configuration
    |--------------------------------------------------------------------------
    |
    | This file defines the modules and their available actions for the
    | UniWorld Holidays admin panel. Permissions are generated dynamically
    | from this configuration using the format: {action}_{module}
    |
    */

    'destinations' => [
        'label' => 'Destinations',
        'actions' => [
            'view' => 'View Destinations',
            'create' => 'Create Destinations',
            'edit' => 'Edit Destinations',
            'delete' => 'Delete Destinations',
            'restore' => 'Restore Destinations',
            'force_delete' => 'Force Delete Destinations',
        ],
    ],

    'tours' => [
        'label' => 'Tours',
        'actions' => [
            'view' => 'View Tours',
            'create' => 'Create Tours',
            'edit' => 'Edit Tours',
            'delete' => 'Delete Tours',
            'restore' => 'Restore Tours',
            'force_delete' => 'Force Delete Tours',
            'duplicate' => 'Duplicate Tours',
            'publish' => 'Publish Tours',
        ],
    ],

    'tour_pricing' => [
        'label' => 'Tour Pricing',
        'actions' => [
            'view' => 'View Tour Pricing',
            'create' => 'Create Tour Pricing',
            'edit' => 'Edit Tour Pricing',
            'delete' => 'Delete Tour Pricing',
            'restore' => 'Restore Tour Pricing',
        ],
    ],

    'enquiries' => [
        'label' => 'Enquiries',
        'actions' => [
            'view' => 'View Enquiries',
            'create' => 'Create Enquiries',
            'edit' => 'Edit Enquiries',
            'delete' => 'Delete Enquiries',
            'restore' => 'Restore Enquiries',
            'assign' => 'Assign Enquiries',
            'mark_contacted' => 'Mark Enquiries as Contacted',
            'mark_lost' => 'Mark Enquiries as Lost',
            'convert' => 'Convert Enquiries',
        ],
    ],

    'quotations' => [
        'label' => 'Quotations',
        'actions' => [
            'view' => 'View Quotations',
            'create' => 'Create Quotations',
            'edit' => 'Edit Quotations',
            'delete' => 'Delete Quotations',
            'restore' => 'Restore Quotations',
            'send' => 'Send Quotations',
            'download_pdf' => 'Download Quotation PDF',
            'create_version' => 'Create Quotation Version',
            'accept' => 'Accept Quotations',
            'reject' => 'Reject Quotations',
            'request_changes' => 'Request Quotation Changes',
            'copy_public_link' => 'Copy Public Quotation Link',
        ],
    ],

    'quotation_items' => [
        'label' => 'Quotation Items',
        'actions' => [
            'view' => 'View Quotation Items',
            'create' => 'Create Quotation Items',
            'edit' => 'Edit Quotation Items',
            'delete' => 'Delete Quotation Items',
            'restore' => 'Restore Quotation Items',
        ],
    ],

    'bookings' => [
        'label' => 'Bookings',
        'actions' => [
            'view' => 'View Bookings',
            'create' => 'Create Bookings',
            'edit' => 'Edit Bookings',
            'delete' => 'Delete Bookings',
            'restore' => 'Restore Bookings',
            'cancel' => 'Cancel Bookings',
            'complete' => 'Complete Bookings',
            'confirm' => 'Confirm Bookings',
        ],
    ],

    'payments' => [
        'label' => 'Payments',
        'actions' => [
            'view' => 'View Payments',
            'create' => 'Create Payments',
            'edit' => 'Edit Payments',
            'delete' => 'Delete Payments',
            'restore' => 'Restore Payments',
            'refund' => 'Refund Payments',
        ],
    ],

    'travellers' => [
        'label' => 'Travellers',
        'actions' => [
            'view' => 'View Travellers',
            'create' => 'Create Travellers',
            'edit' => 'Edit Travellers',
            'delete' => 'Delete Travellers',
            'restore' => 'Restore Travellers',
        ],
    ],

    'pages' => [
        'label' => 'Pages',
        'actions' => [
            'view' => 'View Pages',
            'create' => 'Create Pages',
            'edit' => 'Edit Pages',
            'delete' => 'Delete Pages',
            'restore' => 'Restore Pages',
            'publish' => 'Publish Pages',
        ],
    ],

    'posts' => [
        'label' => 'Posts',
        'actions' => [
            'view' => 'View Posts',
            'create' => 'Create Posts',
            'edit' => 'Edit Posts',
            'delete' => 'Delete Posts',
            'restore' => 'Restore Posts',
            'publish' => 'Publish Posts',
        ],
    ],

    'banners' => [
        'label' => 'Banners',
        'actions' => [
            'view' => 'View Banners',
            'create' => 'Create Banners',
            'edit' => 'Edit Banners',
            'delete' => 'Delete Banners',
            'restore' => 'Restore Banners',
        ],
    ],

    'testimonials' => [
        'label' => 'Testimonials',
        'actions' => [
            'view' => 'View Testimonials',
            'create' => 'Create Testimonials',
            'edit' => 'Edit Testimonials',
            'delete' => 'Delete Testimonials',
            'restore' => 'Restore Testimonials',
        ],
    ],

    'faqs' => [
        'label' => 'FAQs',
        'actions' => [
            'view' => 'View FAQs',
            'create' => 'Create FAQs',
            'edit' => 'Edit FAQs',
            'delete' => 'Delete FAQs',
            'restore' => 'Restore FAQs',
        ],
    ],

    'settings' => [
        'label' => 'Settings',
        'actions' => [
            'view' => 'View Settings',
            'edit' => 'Edit Settings',
        ],
    ],

    'users' => [
        'label' => 'Users',
        'actions' => [
            'view' => 'View Users',
            'create' => 'Create Users',
            'edit' => 'Edit Users',
            'delete' => 'Delete Users',
            'restore' => 'Restore Users',
        ],
    ],

    'roles' => [
        'label' => 'Roles',
        'actions' => [
            'view' => 'View Roles',
            'create' => 'Create Roles',
            'edit' => 'Edit Roles',
            'delete' => 'Delete Roles',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Role Permissions Configuration
    |--------------------------------------------------------------------------
    |
    | Define which permissions each role should have. This is used by the
    | seeder to automatically assign permissions to roles.
    |
    */
    'role_permissions' => [
        'super_admin' => 'all', // Gets all permissions automatically

        'sales' => [
            'enquiries' => ['view', 'create', 'edit', 'assign', 'mark_contacted', 'mark_lost', 'convert'],
            'quotations' => ['view', 'create', 'edit', 'send', 'download_pdf', 'create_version', 'copy_public_link'],
            'bookings' => ['view', 'create', 'edit'],
            'payments' => ['view'],
            'travellers' => ['view'],
        ],

        'operations' => [
            'bookings' => ['view', 'create', 'edit', 'cancel', 'complete', 'confirm'],
            'travellers' => ['view', 'create', 'edit'],
            'payments' => ['view', 'create', 'edit'],
            'quotations' => ['view', 'download_pdf'],
        ],

        'content' => [
            'destinations' => ['view', 'create', 'edit', 'delete', 'restore'],
            'tours' => ['view', 'create', 'edit', 'delete', 'restore', 'duplicate', 'publish'],
            'tour_pricing' => ['view', 'create', 'edit', 'delete', 'restore'],
            'pages' => ['view', 'create', 'edit', 'delete', 'restore', 'publish'],
            'posts' => ['view', 'create', 'edit', 'delete', 'restore', 'publish'],
            'banners' => ['view', 'create', 'edit', 'delete', 'restore'],
            'testimonials' => ['view', 'create', 'edit', 'delete', 'restore'],
            'faqs' => ['view', 'create', 'edit', 'delete', 'restore'],
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Admin Access Roles
    |--------------------------------------------------------------------------
    |
    | Define which roles can access the admin panel
    |
    */
    'admin_access_roles' => [
        'super_admin',
        'sales',
        'operations',
        'content',
    ],
];