<style>
    :root {
        --uw-admin-line: rgba(148, 163, 184, .22);
        --uw-admin-shadow: 0 10px 30px rgba(15, 23, 42, .055);
    }

    .fi-body {
        background:
            radial-gradient(circle at 85% 0%, rgba(8, 118, 147, .07), transparent 24rem),
            #f7f9fc;
    }

    .dark .fi-body {
        background:
            radial-gradient(circle at 85% 0%, rgba(37, 99, 235, .1), transparent 26rem),
            #070b14;
    }

    .fi-topbar > nav {
        border-bottom-color: var(--uw-admin-line);
        box-shadow: 0 1px 0 rgba(15, 23, 42, .03);
    }

    .fi-sidebar {
        border-inline-end: 1px solid var(--uw-admin-line);
        --sidebar-width: 15rem;
    }

    .fi-sidebar-header .fi-logo { min-height: 3.25rem; }

    .fi-sidebar-item-button {
        border-radius: .7rem;
        transition: background-color .18s ease, color .18s ease, box-shadow .18s ease;
    }

    .fi-sidebar-item.fi-active .fi-sidebar-item-button {
        box-shadow: inset 3px 0 0 rgb(8, 118, 147);
    }

    .fi-header-heading {
        letter-spacing: -.025em;
    }

    .fi-header-subheading {
        max-width: 52rem;
    }

    .fi-section,
    .fi-ta-ctn,
    .fi-wi-stats-overview-stat {
        border-color: var(--uw-admin-line);
        border-radius: 1rem;
        box-shadow: var(--uw-admin-shadow);
    }

    .fi-section-header {
        border-bottom: 1px solid var(--uw-admin-line);
    }

    .fi-ta-header-ctn {
        border-bottom-color: var(--uw-admin-line);
    }

    .fi-ta-table thead {
        background: rgba(241, 245, 249, .72);
    }

    .dark .fi-ta-table thead {
        background: rgba(255, 255, 255, .025);
    }

    .fi-ta-table tbody tr {
        transition: background-color .16s ease;
    }

    .fi-ta-table tbody tr:hover {
        background: rgba(8, 118, 147, .035);
    }

    .dark .fi-ta-table tbody tr:hover {
        background: rgba(56, 189, 248, .045);
    }

    .fi-input-wrp,
    .fi-select-input,
    .fi-fo-file-upload {
        border-radius: .75rem;
    }

    .fi-btn {
        border-radius: .7rem;
        transition: background-color .18s ease, border-color .18s ease, box-shadow .18s ease, color .18s ease;
    }

    .fi-btn:not(:disabled):hover {
        box-shadow: 0 7px 18px rgba(15, 23, 42, .1);
    }

    .fi-badge {
        border-radius: 999px;
    }

    @media (max-width: 767px) {
        .fi-main {
            padding-inline: .85rem;
        }

        .fi-section-header,
        .fi-section-content-ctn > .fi-section-content {
            padding-inline: 1rem;
        }
    }

    @media (prefers-reduced-motion: reduce) {
        .fi-body *, .fi-body *::before, .fi-body *::after {
            transition-duration: .01ms !important;
        }
    }
</style>
