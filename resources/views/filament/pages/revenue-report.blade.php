<x-filament-panels::page>
    @include('filament.pages._report-styles')

    @php
        $revenueMax = max(collect($monthlyRevenue)->max('revenue') ?? 0, 1);
        $collectionRate = $revenueSummary['total_bookings_value'] > 0
            ? min(round(($revenueSummary['total_collected'] / $revenueSummary['total_bookings_value']) * 100, 1), 100)
            : 0;
        $paymentMethodTotal = max($paymentMethods->sum('total'), 1);
        $currentMonth = collect($monthlyRevenue)->last()['revenue'] ?? 0;
        $previousMonth = collect($monthlyRevenue)->slice(-2, 1)->first()['revenue'] ?? 0;
        $monthGrowth = $previousMonth > 0 ? round((($currentMonth - $previousMonth) / $previousMonth) * 100, 1) : null;
    @endphp

    <div class="enterprise-report">
        <section class="er-hero" aria-labelledby="revenue-report-title">
            <div class="er-hero-copy">
                <span class="er-eyebrow">Financial intelligence</span>
                <h2 id="revenue-report-title">Revenue and collection overview</h2>
                <p>Track cash realization, outstanding exposure, monthly revenue movement, and payment channel performance.</p>
            </div>
            <div class="er-hero-meta">
                <span class="er-live-pill"><span class="er-live-dot" aria-hidden="true"></span> Finance snapshot</span>
                <span class="er-period">Rolling 6 months · refreshed every 5 minutes</span>
            </div>
        </section>

        <section class="er-kpi-grid" aria-label="Revenue key performance indicators">
            <article class="er-kpi is-success">
                <div class="er-kpi-top"><span class="er-kpi-label">Revenue this month</span><span class="er-kpi-icon"><x-filament::icon icon="heroicon-o-banknotes" /></span></div>
                <div class="er-kpi-value">₹{{ number_format($revenueSummary['this_month']) }}</div>
                <p class="er-kpi-note">@if($monthGrowth !== null){{ $monthGrowth >= 0 ? '+' : '' }}{{ number_format($monthGrowth, 1) }}% versus prior month @else Baseline month; no prior comparison @endif</p>
            </article>
            <article class="er-kpi">
                <div class="er-kpi-top"><span class="er-kpi-label">Year-to-date revenue</span><span class="er-kpi-icon"><x-filament::icon icon="heroicon-o-chart-bar" /></span></div>
                <div class="er-kpi-value">₹{{ number_format($revenueSummary['this_year']) }}</div>
                <p class="er-kpi-note">Received payments recorded this financial view</p>
            </article>
            <article class="er-kpi is-success">
                <div class="er-kpi-top"><span class="er-kpi-label">Collection efficiency</span><span class="er-kpi-icon"><x-filament::icon icon="heroicon-o-shield-check" /></span></div>
                <div class="er-kpi-value">{{ number_format($collectionRate, 1) }}%</div>
                <p class="er-kpi-note">Collected against non-cancelled booking value</p>
            </article>
            <article class="er-kpi is-danger">
                <div class="er-kpi-top"><span class="er-kpi-label">Outstanding balance</span><span class="er-kpi-icon"><x-filament::icon icon="heroicon-o-exclamation-triangle" /></span></div>
                <div class="er-kpi-value">₹{{ number_format($revenueSummary['total_pending']) }}</div>
                <p class="er-kpi-note">Balance due on confirmed and part-paid bookings</p>
            </article>
        </section>

        <div class="er-grid-2">
            <section class="er-panel">
                <header class="er-panel-head">
                    <div><h3 class="er-panel-title">Revenue momentum</h3><p class="er-panel-description">Cash received during each of the last six months</p></div>
                    <span class="er-panel-tag">₹{{ number_format(collect($monthlyRevenue)->sum('revenue')) }}</span>
                </header>
                <div class="er-panel-body">
                    <div class="er-trend" aria-label="Six month revenue chart">
                        @foreach($monthlyRevenue as $row)
                            <div class="er-trend-group" title="{{ $row['month'] }}: ₹{{ number_format($row['revenue']) }}">
                                <div class="er-trend-bars"><div class="er-trend-bar is-secondary" style="height: {{ max(round(($row['revenue'] / $revenueMax) * 100), 2) }}%"></div></div>
                                <span class="er-trend-label">{{ str($row['month'])->before(' ') }}</span>
                            </div>
                        @endforeach
                    </div>
                    <div class="er-legend"><span class="er-legend-item"><span class="er-legend-swatch is-success"></span>Payments received</span></div>
                </div>
            </section>

            <section class="er-panel">
                <header class="er-panel-head">
                    <div><h3 class="er-panel-title">Collection position</h3><p class="er-panel-description">Portfolio value compared with realized cash</p></div>
                    <span class="er-panel-tag">All time</span>
                </header>
                <div class="er-panel-body">
                    <div class="er-stat-row">
                        <div class="er-mini-stat"><strong>₹{{ number_format($revenueSummary['total_bookings_value']) }}</strong><span>Active booking value</span></div>
                        <div class="er-mini-stat"><strong style="color: var(--er-success)">₹{{ number_format($revenueSummary['total_collected']) }}</strong><span>Total cash collected</span></div>
                    </div>
                    <div style="margin-top: 1.15rem">
                        <div class="er-bar-meta"><span class="er-bar-label">Collection progress</span><span class="er-bar-value">{{ number_format($collectionRate, 1) }}%</span></div>
                        <div class="er-track" role="progressbar" aria-label="Collection progress" aria-valuenow="{{ $collectionRate }}" aria-valuemin="0" aria-valuemax="100"><div class="er-fill is-success" style="width: {{ $collectionRate }}%"></div></div>
                    </div>
                    <div class="er-alert {{ $revenueSummary['total_pending'] > 0 ? 'is-warning' : '' }}" style="margin-top: 1.15rem">
                        <span class="er-alert-icon"><x-filament::icon icon="heroicon-o-clock" /></span>
                        <div><strong>Receivables watch</strong><p>{{ $revenueSummary['total_pending'] > 0 ? 'Prioritize follow-up on ₹'.number_format($revenueSummary['total_pending']).' currently outstanding.' : 'No outstanding balance is recorded for active bookings.' }}</p></div>
                    </div>
                </div>
            </section>
        </div>

        <section class="er-panel">
            <header class="er-panel-head">
                <div><h3 class="er-panel-title">Monthly financial performance</h3><p class="er-panel-description">Bookings, cancellations, and realized revenue by month</p></div>
                <span class="er-panel-tag">6 months</span>
            </header>
            <div class="er-table-wrap">
                <table class="er-table">
                    <thead><tr><th>Month</th><th class="is-center">Bookings</th><th class="is-center">Cancelled</th><th class="is-right">Revenue</th><th class="is-right">Revenue / booking</th></tr></thead>
                    <tbody>
                        @foreach($monthlyRevenue as $row)
                            <tr>
                                <td class="er-table-primary">{{ $row['month'] }}</td>
                                <td class="is-center">{{ number_format($row['bookings']) }}</td>
                                <td class="is-center">@if($row['cancelled'] > 0)<span class="er-badge is-danger">{{ $row['cancelled'] }}</span>@else<span class="er-table-muted">0</span>@endif</td>
                                <td class="is-right er-table-primary" style="color: var(--er-success)">₹{{ number_format($row['revenue']) }}</td>
                                <td class="is-right er-table-muted">₹{{ number_format($row['bookings'] > 0 ? $row['revenue'] / $row['bookings'] : 0) }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </section>

        <section class="er-panel">
            <header class="er-panel-head">
                <div><h3 class="er-panel-title">Payment channel mix</h3><p class="er-panel-description">Year-to-date collection by payment method</p></div>
                <span class="er-panel-tag">YTD</span>
            </header>
            <div class="er-table-wrap">
                <table class="er-table">
                    <thead><tr><th>Method</th><th class="is-center">Transactions</th><th class="is-right">Amount</th><th class="is-right">Collection share</th></tr></thead>
                    <tbody>
                        @forelse($paymentMethods as $method)
                            @php $share = round(($method->total / $paymentMethodTotal) * 100, 1); @endphp
                            <tr><td class="er-table-primary">{{ str($method->method)->replace('_', ' ')->title() }}</td><td class="is-center">{{ number_format($method->count) }}</td><td class="is-right er-table-primary">₹{{ number_format($method->total) }}</td><td class="is-right"><span class="er-badge is-success">{{ $share }}%</span></td></tr>
                        @empty
                            <tr><td colspan="4" class="er-empty">No received payment data is available for this year.</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </section>
    </div>
</x-filament-panels::page>
