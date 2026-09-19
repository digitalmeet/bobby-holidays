<x-filament-panels::page>
    @include('filament.pages._report-styles')

    @php
        $pipelineTotal = max(array_sum($pipeline), 1);
        $openPipeline = ($pipeline['new'] ?? 0) + ($pipeline['contacted'] ?? 0) + ($pipeline['quoted'] ?? 0);
        $yearOutcomes = ($pipeline['converted'] ?? 0) + ($pipeline['lost'] ?? 0);
        $conversionRate = $yearOutcomes > 0 ? round((($pipeline['converted'] ?? 0) / $yearOutcomes) * 100, 1) : 0;
        $quoteWinRate = $quotationStats['total_sent'] > 0 ? round(($quotationStats['accepted'] / $quotationStats['total_sent']) * 100, 1) : 0;
        $monthEnquiries = collect($monthlyEnquiries)->last()['count'] ?? 0;
        $trendMax = max(collect($monthlyEnquiries)->max('count') ?? 0, 1);
        $sourceTotal = max(array_sum($sources), 1);
        $pipelineStyles = ['new' => '', 'contacted' => 'is-warning', 'quoted' => '', 'converted' => 'is-success', 'lost' => 'is-danger'];
        $sourceLabels = ['website' => 'Website', 'whatsapp' => 'WhatsApp', 'referral' => 'Referral', 'walkin' => 'Walk-in', 'instagram' => 'Instagram', 'facebook' => 'Facebook'];
    @endphp

    <div class="enterprise-report">
        <section class="er-hero" aria-labelledby="sales-report-title">
            <div class="er-hero-copy">
                <span class="er-eyebrow">Commercial intelligence</span>
                <h2 id="sales-report-title">Sales performance command center</h2>
                <p>Monitor enquiry velocity, pipeline health, quotation outcomes, and destination demand from one executive view.</p>
            </div>
            <div class="er-hero-meta">
                <span class="er-live-pill"><span class="er-live-dot" aria-hidden="true"></span> Operational data</span>
                <span class="er-period">Rolling 6 months · refreshed every 5 minutes</span>
            </div>
        </section>

        <section class="er-kpi-grid" aria-label="Sales key performance indicators">
            <article class="er-kpi">
                <div class="er-kpi-top"><span class="er-kpi-label">Enquiries this month</span><span class="er-kpi-icon"><x-filament::icon icon="heroicon-o-user-group" /></span></div>
                <div class="er-kpi-value">{{ number_format($monthEnquiries) }}</div>
                <p class="er-kpi-note">New demand captured in the current month</p>
            </article>
            <article class="er-kpi is-warning">
                <div class="er-kpi-top"><span class="er-kpi-label">Open pipeline</span><span class="er-kpi-icon"><x-filament::icon icon="heroicon-o-funnel" /></span></div>
                <div class="er-kpi-value">{{ number_format($openPipeline) }}</div>
                <p class="er-kpi-note">New, contacted, and quoted opportunities</p>
            </article>
            <article class="er-kpi is-success">
                <div class="er-kpi-top"><span class="er-kpi-label">Lead conversion</span><span class="er-kpi-icon"><x-filament::icon icon="heroicon-o-arrow-trending-up" /></span></div>
                <div class="er-kpi-value">{{ number_format($conversionRate, 1) }}%</div>
                <p class="er-kpi-note">Converted share of closed enquiry outcomes</p>
            </article>
            <article class="er-kpi">
                <div class="er-kpi-top"><span class="er-kpi-label">Quotation win rate</span><span class="er-kpi-icon"><x-filament::icon icon="heroicon-o-document-check" /></span></div>
                <div class="er-kpi-value">{{ number_format($quoteWinRate, 1) }}%</div>
                <p class="er-kpi-note">{{ number_format($quotationStats['accepted']) }} accepted of {{ number_format($quotationStats['total_sent']) }} sent</p>
            </article>
        </section>

        <div class="er-grid-2">
            <section class="er-panel">
                <header class="er-panel-head">
                    <div><h3 class="er-panel-title">Pipeline health</h3><p class="er-panel-description">Current enquiry distribution by sales stage</p></div>
                    <span class="er-panel-tag">{{ number_format(array_sum($pipeline)) }} leads</span>
                </header>
                <div class="er-panel-body er-bar-list">
                    @foreach($pipeline as $status => $count)
                        @php $percentage = round(($count / $pipelineTotal) * 100); @endphp
                        <div>
                            <div class="er-bar-meta"><span class="er-bar-label">{{ str_replace('_', ' ', $status) }}</span><span class="er-bar-value">{{ number_format($count) }} · {{ $percentage }}%</span></div>
                            <div class="er-track" role="progressbar" aria-label="{{ ucfirst($status) }} enquiries" aria-valuenow="{{ $count }}" aria-valuemin="0" aria-valuemax="{{ $pipelineTotal }}">
                                <div class="er-fill {{ $pipelineStyles[$status] ?? 'is-muted' }}" style="width: {{ $percentage }}%"></div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </section>

            <section class="er-panel">
                <header class="er-panel-head">
                    <div><h3 class="er-panel-title">Acquisition trend</h3><p class="er-panel-description">Monthly enquiries compared with successful conversions</p></div>
                    <span class="er-panel-tag">6 months</span>
                </header>
                <div class="er-panel-body">
                    <div class="er-trend" aria-label="Six month enquiry and conversion chart">
                        @foreach($monthlyEnquiries as $row)
                            <div class="er-trend-group" title="{{ $row['month'] }}: {{ $row['count'] }} enquiries, {{ $row['converted'] }} converted">
                                <div class="er-trend-bars">
                                    <div class="er-trend-bar" style="height: {{ max(round(($row['count'] / $trendMax) * 100), 2) }}%"></div>
                                    <div class="er-trend-bar is-secondary" style="height: {{ max(round(($row['converted'] / $trendMax) * 100), 2) }}%"></div>
                                </div>
                                <span class="er-trend-label">{{ $row['month'] }}</span>
                            </div>
                        @endforeach
                    </div>
                    <div class="er-legend"><span class="er-legend-item"><span class="er-legend-swatch"></span>Enquiries</span><span class="er-legend-item"><span class="er-legend-swatch is-success"></span>Converted</span></div>
                </div>
            </section>
        </div>

        <div class="er-grid-2">
            <section class="er-panel">
                <header class="er-panel-head">
                    <div><h3 class="er-panel-title">Lead source mix</h3><p class="er-panel-description">Where this month's demand originated</p></div>
                    <span class="er-panel-tag">This month</span>
                </header>
                <div class="er-panel-body er-bar-list">
                    @forelse($sources as $source => $count)
                        @php $percentage = round(($count / $sourceTotal) * 100); @endphp
                        <div>
                            <div class="er-bar-meta"><span class="er-bar-label">{{ $sourceLabels[$source] ?? ucfirst((string) $source) }}</span><span class="er-bar-value">{{ $count }} · {{ $percentage }}%</span></div>
                            <div class="er-track"><div class="er-fill" style="width: {{ $percentage }}%"></div></div>
                        </div>
                    @empty
                        <p class="er-empty">No enquiry source data is available for this month.</p>
                    @endforelse
                </div>
            </section>

            <section class="er-panel">
                <header class="er-panel-head">
                    <div><h3 class="er-panel-title">Quotation performance</h3><p class="er-panel-description">Year-to-date proposal outcomes and value quality</p></div>
                    <span class="er-panel-tag">YTD</span>
                </header>
                <div class="er-panel-body">
                    <div class="er-stat-row">
                        <div class="er-mini-stat"><strong>{{ number_format($quotationStats['total_sent']) }}</strong><span>Quotations sent</span></div>
                        <div class="er-mini-stat"><strong style="color: var(--er-success)">{{ number_format($quotationStats['accepted']) }}</strong><span>Accepted</span></div>
                        <div class="er-mini-stat"><strong style="color: var(--er-danger)">{{ number_format($quotationStats['rejected']) }}</strong><span>Rejected</span></div>
                        <div class="er-mini-stat"><strong>₹{{ number_format($quotationStats['avg_value']) }}</strong><span>Average accepted value</span></div>
                    </div>
                </div>
            </section>
        </div>

        <section class="er-panel">
            <header class="er-panel-head">
                <div><h3 class="er-panel-title">Destination demand ranking</h3><p class="er-panel-description">Top destinations by enquiry volume this year</p></div>
                <span class="er-panel-tag">Top 10</span>
            </header>
            <div class="er-table-wrap">
                <table class="er-table">
                    <thead><tr><th>Rank</th><th>Destination</th><th class="is-right">Enquiries</th><th class="is-right">Demand share</th></tr></thead>
                    <tbody>
                        @forelse($topDestinations as $item)
                            @php $share = round(($item->enquiry_count / max($topDestinations->sum('enquiry_count'), 1)) * 100, 1); @endphp
                            <tr><td class="er-table-muted">#{{ $loop->iteration }}</td><td class="er-table-primary">{{ $item->destination?->name ?? 'Unknown destination' }}</td><td class="is-right">{{ number_format($item->enquiry_count) }}</td><td class="is-right"><span class="er-badge">{{ $share }}%</span></td></tr>
                        @empty
                            <tr><td colspan="4" class="er-empty">No destination demand data is available yet.</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </section>
    </div>
</x-filament-panels::page>
