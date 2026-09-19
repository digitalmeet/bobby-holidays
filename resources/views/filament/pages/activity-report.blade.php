<x-filament-panels::page>
    @include('filament.pages._report-styles')

    @php
        $trendMax = max(collect($dailyActivity)->max('count') ?? 0, 1);
        $moduleMax = max(collect($moduleStats)->max('week') ?? 0, 1);
        $workflowTotal = array_sum($workflow);
    @endphp

    <div class="enterprise-report">
        <section class="er-hero" aria-labelledby="activity-report-title">
            <div class="er-hero-copy">
                <span class="er-eyebrow">Governance intelligence</span>
                <h2 id="activity-report-title">Audit and operational activity</h2>
                <p>Review administrative changes, sensitive events, workflow transitions, and accountable user activity across the platform.</p>
            </div>
            <div class="er-hero-meta">
                <span class="er-live-pill"><span class="er-live-dot" aria-hidden="true"></span> Audit monitoring</span>
                <span class="er-period">30-day governance view · refreshed every minute</span>
            </div>
        </section>

        <section class="er-kpi-grid" aria-label="Audit key performance indicators">
            <article class="er-kpi">
                <div class="er-kpi-top"><span class="er-kpi-label">Activity today</span><span class="er-kpi-icon"><x-filament::icon icon="heroicon-o-bolt" /></span></div>
                <div class="er-kpi-value">{{ number_format($summary['today']) }}</div>
                <p class="er-kpi-note">Recorded changes across monitored modules</p>
            </article>
            <article class="er-kpi is-success">
                <div class="er-kpi-top"><span class="er-kpi-label">Seven-day activity</span><span class="er-kpi-icon"><x-filament::icon icon="heroicon-o-chart-bar" /></span></div>
                <div class="er-kpi-value">{{ number_format($summary['week']) }}</div>
                <p class="er-kpi-note">Complete audit events from the last seven days</p>
            </article>
            <article class="er-kpi">
                <div class="er-kpi-top"><span class="er-kpi-label">Active administrators</span><span class="er-kpi-icon"><x-filament::icon icon="heroicon-o-users" /></span></div>
                <div class="er-kpi-value">{{ number_format($summary['active_users']) }}</div>
                <p class="er-kpi-note">Distinct accountable users in recent activity</p>
            </article>
            <article class="er-kpi {{ $summary['risk_events'] > 0 ? 'is-danger' : 'is-success' }}">
                <div class="er-kpi-top"><span class="er-kpi-label">Sensitive events</span><span class="er-kpi-icon"><x-filament::icon icon="heroicon-o-shield-exclamation" /></span></div>
                <div class="er-kpi-value">{{ number_format($summary['risk_events']) }}</div>
                <p class="er-kpi-note">Deletes, refunds, cancellations, and force deletes in 30 days</p>
            </article>
        </section>

        <div class="er-grid-2">
            <section class="er-panel">
                <header class="er-panel-head"><div><h3 class="er-panel-title">Audit activity trend</h3><p class="er-panel-description">Recorded change volume over the last seven days</p></div><span class="er-panel-tag">7 days</span></header>
                <div class="er-panel-body">
                    <div class="er-trend" style="grid-template-columns: repeat(7, minmax(2.8rem, 1fr))" aria-label="Seven day audit activity chart">
                        @foreach($dailyActivity as $row)
                            <div class="er-trend-group" title="{{ $row['label'] }}: {{ $row['count'] }} events">
                                <div class="er-trend-bars"><div class="er-trend-bar" style="height: {{ max(round(($row['count'] / $trendMax) * 100), 2) }}%"></div></div>
                                <span class="er-trend-label">{{ $row['label'] }}</span>
                            </div>
                        @endforeach
                    </div>
                    <div class="er-legend"><span class="er-legend-item"><span class="er-legend-swatch"></span>Recorded changes</span></div>
                </div>
            </section>

            <section class="er-panel">
                <header class="er-panel-head"><div><h3 class="er-panel-title">Workflow controls</h3><p class="er-panel-description">Lifecycle events recorded during the last 30 days</p></div><span class="er-panel-tag">{{ number_format($workflowTotal) }} events</span></header>
                <div class="er-panel-body">
                    <div class="er-stat-row">
                        <div class="er-mini-stat"><strong>{{ number_format($workflow['booking_changes']) }}</strong><span>Booking status changes</span></div>
                        <div class="er-mini-stat"><strong>{{ number_format($workflow['quotation_events']) }}</strong><span>Quotation events</span></div>
                        <div class="er-mini-stat"><strong>{{ number_format($workflow['payment_events']) }}</strong><span>Payment events</span></div>
                        <div class="er-mini-stat"><strong style="color: var(--er-danger)">{{ number_format($summary['risk_events']) }}</strong><span>Sensitive audit events</span></div>
                    </div>
                </div>
            </section>
        </div>

        <section class="er-panel">
            <header class="er-panel-head"><div><h3 class="er-panel-title">Module activity coverage</h3><p class="er-panel-description">Change volume by monitored business area</p></div><span class="er-panel-tag">Audit scope</span></header>
            <div class="er-panel-body er-bar-list">
                @forelse($moduleStats as $module)
                    @php $percentage = round(($module['week'] / $moduleMax) * 100); @endphp
                    <div>
                        <div class="er-bar-meta"><span class="er-bar-label">{{ $module['module'] }}</span><span class="er-bar-value">{{ number_format($module['today']) }} today · {{ number_format($module['week']) }} this week</span></div>
                        <div class="er-track"><div class="er-fill" style="width: {{ $percentage }}%"></div></div>
                    </div>
                @empty
                    <p class="er-empty">No audit tables are currently available.</p>
                @endforelse
            </div>
        </section>

        <section class="er-panel">
            <header class="er-panel-head"><div><h3 class="er-panel-title">Recent administrative activity</h3><p class="er-panel-description">Latest recorded changes with actor and source context</p></div><span class="er-panel-tag">Latest 25</span></header>
            <div class="er-table-wrap">
                <table class="er-table">
                    <thead><tr><th>Time</th><th>Module</th><th>Action</th><th>Actor</th><th>Description</th><th>Source IP</th></tr></thead>
                    <tbody>
                        @forelse($recentActivity as $activity)
                            <tr>
                                <td class="er-table-muted">{{ $activity['created_at'] ? \Illuminate\Support\Carbon::parse($activity['created_at'])->diffForHumans() : '—' }}</td>
                                <td class="er-table-primary">{{ $activity['module'] }}</td>
                                <td><span class="er-badge {{ in_array($activity['action'], ['deleted', 'force_deleted', 'refunded', 'cancelled']) ? 'is-danger' : '' }}">{{ str($activity['action'])->replace('_', ' ')->title() }}</span></td>
                                <td>{{ $activity['actor'] }}</td>
                                <td class="er-table-muted">{{ $activity['description'] ?: 'Record #'.$activity['record_id'].' was '.str($activity['action'])->replace('_', ' ') }}</td>
                                <td class="er-table-muted">{{ $activity['ip_address'] ?: 'System' }}</td>
                            </tr>
                        @empty
                            <tr><td colspan="6" class="er-empty">No administrative activity has been recorded yet.</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </section>
    </div>
</x-filament-panels::page>
