@once
    <style>
        .enterprise-report {
            --er-ink: #0f172a;
            --er-muted: #64748b;
            --er-line: #e2e8f0;
            --er-surface: #ffffff;
            --er-subtle: #f8fafc;
            --er-primary: #2563eb;
            --er-primary-soft: #eff6ff;
            --er-success: #059669;
            --er-success-soft: #ecfdf5;
            --er-warning: #d97706;
            --er-warning-soft: #fffbeb;
            --er-danger: #dc2626;
            --er-danger-soft: #fef2f2;
            color: var(--er-ink);
            display: grid;
            gap: 1.5rem;
        }

        .dark .enterprise-report {
            --er-ink: #f8fafc;
            --er-muted: #94a3b8;
            --er-line: rgba(148, 163, 184, .2);
            --er-surface: #111827;
            --er-subtle: rgba(255, 255, 255, .035);
            --er-primary: #60a5fa;
            --er-primary-soft: rgba(37, 99, 235, .14);
            --er-success: #34d399;
            --er-success-soft: rgba(5, 150, 105, .14);
            --er-warning: #fbbf24;
            --er-warning-soft: rgba(217, 119, 6, .14);
            --er-danger: #f87171;
            --er-danger-soft: rgba(220, 38, 38, .14);
        }

        .er-hero {
            background: linear-gradient(125deg, #0f172a 0%, #172554 58%, #1d4ed8 140%);
            border-radius: 1.25rem;
            box-shadow: 0 18px 45px rgba(15, 23, 42, .18);
            color: #fff;
            display: flex;
            gap: 1.5rem;
            justify-content: space-between;
            overflow: hidden;
            padding: 1.75rem;
            position: relative;
        }

        .er-hero::after {
            background: radial-gradient(circle, rgba(255,255,255,.17), transparent 65%);
            content: '';
            height: 18rem;
            pointer-events: none;
            position: absolute;
            right: -5rem;
            top: -8rem;
            width: 18rem;
        }

        .er-hero-copy { max-width: 48rem; position: relative; z-index: 1; }
        .er-eyebrow { color: #93c5fd; font-size: .7rem; font-weight: 800; letter-spacing: .14em; text-transform: uppercase; }
        .er-hero h2 { font-size: clamp(1.35rem, 2.4vw, 2rem); font-weight: 750; letter-spacing: -.025em; line-height: 1.2; margin-top: .45rem; }
        .er-hero p { color: #cbd5e1; font-size: .9rem; line-height: 1.65; margin-top: .55rem; }
        .er-hero-meta { align-items: flex-end; display: flex; flex-direction: column; gap: .55rem; justify-content: center; min-width: 11rem; position: relative; z-index: 1; }
        .er-live-pill { align-items: center; background: rgba(255,255,255,.1); border: 1px solid rgba(255,255,255,.18); border-radius: 999px; display: inline-flex; font-size: .72rem; font-weight: 700; gap: .45rem; padding: .45rem .75rem; }
        .er-live-dot { background: #34d399; border-radius: 50%; box-shadow: 0 0 0 4px rgba(52,211,153,.13); height: .45rem; width: .45rem; }
        .er-period { color: #bfdbfe; font-size: .72rem; text-align: right; }

        .er-kpi-grid { display: grid; gap: 1rem; grid-template-columns: repeat(4, minmax(0, 1fr)); }
        .er-kpi { background: var(--er-surface); border: 1px solid var(--er-line); border-radius: 1rem; box-shadow: 0 6px 18px rgba(15,23,42,.055); min-height: 9rem; padding: 1.15rem; position: relative; }
        .er-kpi-top { align-items: center; display: flex; gap: .75rem; justify-content: space-between; }
        .er-kpi-label { color: var(--er-muted); font-size: .7rem; font-weight: 800; letter-spacing: .075em; text-transform: uppercase; }
        .er-kpi-icon { align-items: center; background: var(--er-primary-soft); border-radius: .7rem; color: var(--er-primary); display: inline-flex; height: 2rem; justify-content: center; width: 2rem; }
        .er-kpi-icon svg { height: 1rem; width: 1rem; }
        .er-kpi.is-success .er-kpi-icon { background: var(--er-success-soft); color: var(--er-success); }
        .er-kpi.is-warning .er-kpi-icon { background: var(--er-warning-soft); color: var(--er-warning); }
        .er-kpi.is-danger .er-kpi-icon { background: var(--er-danger-soft); color: var(--er-danger); }
        .er-kpi-value { font-size: clamp(1.45rem, 2.5vw, 2rem); font-weight: 780; letter-spacing: -.035em; line-height: 1.1; margin-top: 1rem; }
        .er-kpi-note { color: var(--er-muted); font-size: .74rem; line-height: 1.45; margin-top: .45rem; }

        .er-grid-2 { display: grid; gap: 1.25rem; grid-template-columns: repeat(2, minmax(0, 1fr)); }
        .er-panel { background: var(--er-surface); border: 1px solid var(--er-line); border-radius: 1rem; box-shadow: 0 6px 18px rgba(15,23,42,.045); overflow: hidden; }
        .er-panel-head { align-items: flex-start; border-bottom: 1px solid var(--er-line); display: flex; gap: 1rem; justify-content: space-between; padding: 1.15rem 1.25rem; }
        .er-panel-title { font-size: .95rem; font-weight: 750; letter-spacing: -.01em; }
        .er-panel-description { color: var(--er-muted); font-size: .75rem; line-height: 1.5; margin-top: .25rem; }
        .er-panel-tag { background: var(--er-primary-soft); border-radius: 999px; color: var(--er-primary); flex: none; font-size: .65rem; font-weight: 800; letter-spacing: .05em; padding: .35rem .55rem; text-transform: uppercase; }
        .er-panel-body { padding: 1.25rem; }

        .er-bar-list { display: grid; gap: 1rem; }
        .er-bar-meta { align-items: baseline; display: flex; gap: 1rem; justify-content: space-between; margin-bottom: .35rem; }
        .er-bar-label { font-size: .78rem; font-weight: 650; text-transform: capitalize; }
        .er-bar-value { color: var(--er-muted); font-size: .72rem; font-variant-numeric: tabular-nums; }
        .er-track { background: var(--er-subtle); border: 1px solid var(--er-line); border-radius: 999px; height: .62rem; overflow: hidden; }
        .er-fill { background: linear-gradient(90deg, #2563eb, #60a5fa); border-radius: inherit; height: 100%; min-width: .2rem; }
        .er-fill.is-success { background: linear-gradient(90deg, #059669, #34d399); }
        .er-fill.is-warning { background: linear-gradient(90deg, #d97706, #fbbf24); }
        .er-fill.is-danger { background: linear-gradient(90deg, #dc2626, #fb7185); }
        .er-fill.is-muted { background: linear-gradient(90deg, #64748b, #94a3b8); }

        .er-trend { align-items: end; display: grid; gap: .8rem; grid-template-columns: repeat(6, minmax(2.8rem, 1fr)); min-height: 14rem; overflow-x: auto; padding-top: 1rem; }
        .er-trend-group { align-items: center; display: flex; flex-direction: column; gap: .55rem; min-width: 2.8rem; }
        .er-trend-bars { align-items: end; display: flex; gap: .25rem; height: 9.5rem; }
        .er-trend-bar { background: linear-gradient(180deg, #60a5fa, #2563eb); border-radius: .35rem .35rem .1rem .1rem; min-height: .2rem; width: 1rem; }
        .er-trend-bar.is-secondary { background: linear-gradient(180deg, #6ee7b7, #059669); }
        .er-trend-bar.is-danger { background: linear-gradient(180deg, #fda4af, #dc2626); }
        .er-trend-label { color: var(--er-muted); font-size: .67rem; font-weight: 700; white-space: nowrap; }
        .er-legend { align-items: center; display: flex; flex-wrap: wrap; gap: .9rem; margin-top: 1rem; }
        .er-legend-item { align-items: center; color: var(--er-muted); display: inline-flex; font-size: .7rem; gap: .35rem; }
        .er-legend-swatch { background: #2563eb; border-radius: .15rem; height: .5rem; width: .5rem; }
        .er-legend-swatch.is-success { background: #059669; }
        .er-legend-swatch.is-danger { background: #dc2626; }

        .er-stat-row { display: grid; gap: .75rem; grid-template-columns: repeat(2, minmax(0, 1fr)); }
        .er-mini-stat { background: var(--er-subtle); border: 1px solid var(--er-line); border-radius: .8rem; padding: .9rem; }
        .er-mini-stat strong { display: block; font-size: 1.15rem; line-height: 1.2; }
        .er-mini-stat span { color: var(--er-muted); display: block; font-size: .7rem; margin-top: .3rem; }

        .er-alert { align-items: flex-start; background: var(--er-subtle); border: 1px solid var(--er-line); border-radius: .8rem; display: flex; gap: .8rem; padding: .9rem; }
        .er-alert + .er-alert { margin-top: .75rem; }
        .er-alert-icon { align-items: center; background: var(--er-primary-soft); border-radius: .55rem; color: var(--er-primary); display: flex; flex: none; height: 2rem; justify-content: center; width: 2rem; }
        .er-alert-icon svg { height: 1rem; width: 1rem; }
        .er-alert.is-warning .er-alert-icon { background: var(--er-warning-soft); color: var(--er-warning); }
        .er-alert.is-danger .er-alert-icon { background: var(--er-danger-soft); color: var(--er-danger); }
        .er-alert strong { display: block; font-size: .8rem; }
        .er-alert p { color: var(--er-muted); font-size: .72rem; line-height: 1.5; margin-top: .15rem; }

        .er-table-wrap { overflow-x: auto; }
        .er-table { border-collapse: collapse; font-size: .78rem; min-width: 38rem; width: 100%; }
        .er-table th { background: var(--er-subtle); color: var(--er-muted); font-size: .65rem; font-weight: 800; letter-spacing: .065em; padding: .8rem 1rem; text-align: left; text-transform: uppercase; }
        .er-table th.is-center, .er-table td.is-center { text-align: center; }
        .er-table th.is-right, .er-table td.is-right { text-align: right; }
        .er-table td { border-top: 1px solid var(--er-line); padding: .9rem 1rem; }
        .er-table tbody tr { transition: background-color .15s ease; }
        .er-table tbody tr:hover { background: var(--er-subtle); }
        .er-table-primary { font-weight: 700; }
        .er-table-muted { color: var(--er-muted); }
        .er-badge { background: var(--er-primary-soft); border-radius: 999px; color: var(--er-primary); display: inline-flex; font-size: .68rem; font-weight: 800; padding: .3rem .55rem; }
        .er-badge.is-success { background: var(--er-success-soft); color: var(--er-success); }
        .er-badge.is-danger { background: var(--er-danger-soft); color: var(--er-danger); }
        .er-empty { color: var(--er-muted); font-size: .8rem; padding: 2rem; text-align: center; }

        @media (max-width: 1023px) {
            .er-kpi-grid { grid-template-columns: repeat(2, minmax(0, 1fr)); }
            .er-grid-2 { grid-template-columns: 1fr; }
        }

        @media (max-width: 639px) {
            .enterprise-report { gap: 1rem; }
            .er-hero { display: block; padding: 1.3rem; }
            .er-hero-meta { align-items: flex-start; margin-top: 1rem; }
            .er-period { text-align: left; }
            .er-kpi-grid { grid-template-columns: 1fr; }
            .er-kpi { min-height: auto; }
            .er-panel-head { padding: 1rem; }
            .er-panel-body { padding: 1rem; }
            .er-stat-row { grid-template-columns: 1fr; }
        }

        @media (prefers-reduced-motion: reduce) {
            .enterprise-report *, .enterprise-report *::before, .enterprise-report *::after { scroll-behavior: auto !important; transition: none !important; }
        }
    </style>
@endonce
