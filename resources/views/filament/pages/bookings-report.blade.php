<x-filament-panels::page>
    @include('filament.pages._report-styles')

    @php
        $statusTotal = max(array_sum($statusCounts), 1);
        $activeBookings = ($statusCounts['confirmed'] ?? 0) + ($statusCounts['partial_paid'] ?? 0) + ($statusCounts['fully_paid'] ?? 0);
        $completedBookings = $statusCounts['completed'] ?? 0;
        $cancelledBookings = $statusCounts['cancelled'] ?? 0;
        $cancellationRate = round(($cancelledBookings / $statusTotal) * 100, 1);
        $bookingTrendMax = max(collect($monthlyBookings)->max('total') ?? 0, 1);
        $portfolioValue = collect($monthlyBookings)->sum('value');
        $statusStyles = ['confirmed' => '', 'partial_paid' => 'is-warning', 'fully_paid' => 'is-success', 'completed' => 'is-success', 'cancelled' => 'is-danger', 'refunded' => 'is-muted'];
    @endphp

    <div class="enterprise-report">
        <section class="er-hero" aria-labelledby="bookings-report-title">
            <div class="er-hero-copy">
                <span class="er-eyebrow">Operations intelligence</span>
                <h2 id="bookings-report-title">Booking operations control tower</h2>
                <p>See booking volume, fulfillment status, upcoming departures, payment risk, and portfolio value at a glance.</p>
            </div>
            <div class="er-hero-meta">
                <span class="er-live-pill"><span class="er-live-dot" aria-hidden="true"></span> Operations snapshot</span>
                <span class="er-period">Rolling 6 months · refreshed every 5 minutes</span>
            </div>
        </section>

        <section class="er-kpi-grid" aria-label="Booking key performance indicators">
            <article class="er-kpi">
                <div class="er-kpi-top"><span class="er-kpi-label">Upcoming departures</span><span class="er-kpi-icon"><x-filament::icon icon="heroicon-o-paper-airplane" /></span></div>
                <div class="er-kpi-value">{{ number_format($upcomingCount) }}</div>
                <p class="er-kpi-note">Bookings traveling within the next 30 days</p>
            </article>
            <article class="er-kpi is-success">
                <div class="er-kpi-top"><span class="er-kpi-label">Active bookings</span><span class="er-kpi-icon"><x-filament::icon icon="heroicon-o-ticket" /></span></div>
                <div class="er-kpi-value">{{ number_format($activeBookings) }}</div>
                <p class="er-kpi-note">Confirmed, part-paid, and fully-paid files</p>
            </article>
            <article class="er-kpi is-danger">
                <div class="er-kpi-top"><span class="er-kpi-label">Payment attention</span><span class="er-kpi-icon"><x-filament::icon icon="heroicon-o-exclamation-circle" /></span></div>
                <div class="er-kpi-value">{{ number_format($overduePayments) }}</div>
                <p class="er-kpi-note">Balances due on travel within 15 days</p>
            </article>
            <article class="er-kpi is-warning">
                <div class="er-kpi-top"><span class="er-kpi-label">Cancellation rate</span><span class="er-kpi-icon"><x-filament::icon icon="heroicon-o-arrow-path" /></span></div>
                <div class="er-kpi-value">{{ number_format($cancellationRate, 1) }}%</div>
                <p class="er-kpi-note">{{ number_format($cancelledBookings) }} cancelled across the portfolio</p>
            </article>
        </section>

        <div class="er-grid-2">
            <section class="er-panel">
                <header class="er-panel-head">
                    <div><h3 class="er-panel-title">Booking status distribution</h3><p class="er-panel-description">Operational workload across lifecycle stages</p></div>
                    <span class="er-panel-tag">{{ number_format(array_sum($statusCounts)) }} total</span>
                </header>
                <div class="er-panel-body er-bar-list">
                    @forelse($statusCounts as $status => $count)
                        @php $percentage = round(($count / $statusTotal) * 100); @endphp
                        <div>
                            <div class="er-bar-meta"><span class="er-bar-label">{{ str_replace('_', ' ', $status) }}</span><span class="er-bar-value">{{ number_format($count) }} · {{ $percentage }}%</span></div>
                            <div class="er-track" role="progressbar" aria-label="{{ str_replace('_', ' ', ucfirst($status)) }} bookings" aria-valuenow="{{ $count }}" aria-valuemin="0" aria-valuemax="{{ $statusTotal }}"><div class="er-fill {{ $statusStyles[$status] ?? 'is-muted' }}" style="width: {{ $percentage }}%"></div></div>
                        </div>
                    @empty
                        <p class="er-empty">No booking status data is available yet.</p>
                    @endforelse
                </div>
            </section>

            <section class="er-panel">
                <header class="er-panel-head">
                    <div><h3 class="er-panel-title">Operations watchlist</h3><p class="er-panel-description">Items requiring timely team attention</p></div>
                    <span class="er-panel-tag">Live</span>
                </header>
                <div class="er-panel-body">
                    <div class="er-alert {{ $upcomingCount > 0 ? 'is-warning' : '' }}">
                        <span class="er-alert-icon"><x-filament::icon icon="heroicon-o-calendar-days" /></span>
                        <div><strong>Upcoming travel</strong><p>{{ $upcomingCount > 0 ? number_format($upcomingCount).' booking(s) depart within 30 days. Confirm vouchers and supplier readiness.' : 'No departures are scheduled within the next 30 days.' }}</p></div>
                    </div>
                    <div class="er-alert {{ $overduePayments > 0 ? 'is-danger' : '' }}">
                        <span class="er-alert-icon"><x-filament::icon icon="heroicon-o-credit-card" /></span>
                        <div><strong>Payment exposure</strong><p>{{ $overduePayments > 0 ? number_format($overduePayments).' near-term booking(s) still have an outstanding balance.' : 'No near-term booking balances require escalation.' }}</p></div>
                    </div>
                    <div class="er-stat-row" style="margin-top: .75rem">
                        <div class="er-mini-stat"><strong style="color: var(--er-success)">{{ number_format($completedBookings) }}</strong><span>Completed bookings</span></div>
                        <div class="er-mini-stat"><strong>₹{{ number_format($portfolioValue) }}</strong><span>Six-month booking value</span></div>
                    </div>
                </div>
            </section>
        </div>

        <section class="er-panel">
            <header class="er-panel-head">
                <div><h3 class="er-panel-title">Booking volume trend</h3><p class="er-panel-description">Created bookings compared with cancellations over six months</p></div>
                <span class="er-panel-tag">6 months</span>
            </header>
            <div class="er-panel-body">
                <div class="er-trend" aria-label="Six month booking and cancellation chart">
                    @foreach($monthlyBookings as $row)
                        <div class="er-trend-group" title="{{ $row['month'] }}: {{ $row['total'] }} bookings, {{ $row['cancelled'] }} cancelled">
                            <div class="er-trend-bars">
                                <div class="er-trend-bar" style="height: {{ max(round(($row['total'] / $bookingTrendMax) * 100), 2) }}%"></div>
                                <div class="er-trend-bar is-danger" style="height: {{ max(round(($row['cancelled'] / $bookingTrendMax) * 100), 2) }}%"></div>
                            </div>
                            <span class="er-trend-label">{{ str($row['month'])->before(' ') }}</span>
                        </div>
                    @endforeach
                </div>
                <div class="er-legend"><span class="er-legend-item"><span class="er-legend-swatch"></span>Bookings</span><span class="er-legend-item"><span class="er-legend-swatch is-danger"></span>Cancelled</span></div>
            </div>
        </section>

        <section class="er-panel">
            <header class="er-panel-head">
                <div><h3 class="er-panel-title">Monthly booking performance</h3><p class="er-panel-description">Volume, cancellation quality, and booked value</p></div>
                <span class="er-panel-tag">Portfolio</span>
            </header>
            <div class="er-table-wrap">
                <table class="er-table">
                    <thead><tr><th>Month</th><th class="is-center">Bookings</th><th class="is-center">Cancelled</th><th class="is-right">Cancellation rate</th><th class="is-right">Booking value</th></tr></thead>
                    <tbody>
                        @foreach($monthlyBookings as $row)
                            @php $rowCancellationRate = $row['total'] > 0 ? round(($row['cancelled'] / $row['total']) * 100, 1) : 0; @endphp
                            <tr>
                                <td class="er-table-primary">{{ $row['month'] }}</td>
                                <td class="is-center"><span class="er-badge">{{ number_format($row['total']) }}</span></td>
                                <td class="is-center">@if($row['cancelled'] > 0)<span class="er-badge is-danger">{{ number_format($row['cancelled']) }}</span>@else<span class="er-table-muted">0</span>@endif</td>
                                <td class="is-right er-table-muted">{{ number_format($rowCancellationRate, 1) }}%</td>
                                <td class="is-right er-table-primary">₹{{ number_format($row['value']) }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </section>
    </div>
</x-filament-panels::page>
