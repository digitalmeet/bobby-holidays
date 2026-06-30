<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>UniWorld Holidays — Quotation {{ $quotation->public_id }}</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: 'DejaVu Sans', sans-serif; font-size: 11px; color: #333; line-height: 1.5; }
        .header { background: #064f68; color: #fff; padding: 25px 30px; }
        .header h1 { font-size: 20px; margin-bottom: 3px; }
        .header p { font-size: 11px; opacity: 0.85; }
        .container { padding: 25px 30px; }
        .meta-grid { display: table; width: 100%; margin-bottom: 20px; }
        .meta-left, .meta-right { display: table-cell; width: 50%; vertical-align: top; }
        .meta-right { text-align: right; }
        .label { font-size: 9px; text-transform: uppercase; letter-spacing: 0.5px; color: #666; margin-bottom: 2px; }
        .value { font-size: 12px; font-weight: bold; margin-bottom: 8px; }
        .message-box { background: #f8fafb; border-left: 3px solid #064f68; padding: 12px 15px; margin-bottom: 20px; font-style: italic; }
        table.items { width: 100%; border-collapse: collapse; margin-bottom: 20px; }
        table.items th { background: #064f68; color: #fff; padding: 8px 10px; text-align: left; font-size: 10px; text-transform: uppercase; }
        table.items td { padding: 8px 10px; border-bottom: 1px solid #e5e7eb; }
        table.items tr:last-child td { border-bottom: none; }
        table.items .type-badge { background: #e5e7eb; padding: 2px 6px; border-radius: 3px; font-size: 9px; }
        .totals { float: right; width: 250px; margin-top: 10px; }
        .totals table { width: 100%; }
        .totals td { padding: 5px 0; }
        .totals .total-row { font-size: 14px; font-weight: bold; border-top: 2px solid #064f68; padding-top: 8px; }
        .terms { margin-top: 30px; padding-top: 15px; border-top: 1px solid #e5e7eb; }
        .terms h3 { font-size: 11px; margin-bottom: 8px; color: #064f68; }
        .terms p { font-size: 9px; color: #666; white-space: pre-line; }
        .footer { margin-top: 30px; text-align: center; font-size: 9px; color: #999; padding-top: 15px; border-top: 1px solid #e5e7eb; }
        .validity { background: #fef3c7; padding: 8px 12px; border-radius: 4px; margin-bottom: 15px; font-size: 10px; }
        .clearfix::after { content: ""; display: table; clear: both; }
    </style>
</head>
<body>
    <div class="header">
        <h1>UniWorld Holidays</h1>
        <p>Your Journey, Our Passion</p>
    </div>

    <div class="container">
        <div style="margin-bottom: 15px;">
            <h2 style="font-size: 16px; color: #064f68;">{{ $quotation->title }}</h2>
            <p style="font-size: 10px; color: #666;">Quotation #{{ $quotation->public_id }} &middot; Version {{ $quotation->version }}</p>
        </div>

        <div class="meta-grid">
            <div class="meta-left">
                <div class="label">Prepared For</div>
                <div class="value">{{ $quotation->client_name }}</div>
                @if($quotation->client_email)
                    <div style="font-size: 10px; color: #666;">{{ $quotation->client_email }}</div>
                @endif
                @if($quotation->client_phone)
                    <div style="font-size: 10px; color: #666;">{{ $quotation->client_phone }}</div>
                @endif
            </div>
            <div class="meta-right">
                <div class="label">Travel Date</div>
                <div class="value">{{ $quotation->travel_date?->format('d M Y') ?? 'To be confirmed' }}</div>
                @if($quotation->return_date)
                    <div class="label">Return Date</div>
                    <div class="value">{{ $quotation->return_date->format('d M Y') }}</div>
                @endif
                <div class="label">Travellers</div>
                <div class="value">{{ $quotation->adults }} Adult(s){{ $quotation->children ? ", {$quotation->children} Child(ren)" : '' }}{{ $quotation->infants ? ", {$quotation->infants} Infant(s)" : '' }}</div>
            </div>
        </div>

        @if($quotation->validity_date)
            <div class="validity">
                ⏰ This quotation is valid until <strong>{{ $quotation->validity_date->format('d M Y') }}</strong>.
            </div>
        @endif

        @if($quotation->personalised_message)
            <div class="message-box">
                {{ $quotation->personalised_message }}
            </div>
        @endif

        @if($quotation->items->count())
            <table class="items">
                <thead>
                    <tr>
                        <th style="width: 12%;">Type</th>
                        <th>Description</th>
                        <th style="width: 10%; text-align: center;">Nights</th>
                        <th style="width: 12%; text-align: right;">Unit Cost</th>
                        <th style="width: 8%; text-align: center;">Qty</th>
                        <th style="width: 12%; text-align: right;">Total</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($quotation->items->sortBy('sort_order') as $item)
                        <tr>
                            <td><span class="type-badge">{{ ucfirst($item->type) }}</span></td>
                            <td>
                                <strong>{{ $item->title }}</strong>
                                @if($item->description)
                                    <br><span style="font-size: 9px; color: #666;">{{ $item->description }}</span>
                                @endif
                                @if($item->is_optional)
                                    <br><span style="font-size: 9px; color: #b45309;">(Optional)</span>
                                @endif
                            </td>
                            <td style="text-align: center;">{{ $item->nights ?? '—' }}</td>
                            <td style="text-align: right;">₹{{ number_format($item->unit_cost, 2) }}</td>
                            <td style="text-align: center;">{{ $item->quantity }}</td>
                            <td style="text-align: right;">₹{{ number_format($item->total_cost, 2) }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif

        <div class="clearfix">
            <div class="totals">
                <table>
                    <tr>
                        <td>Subtotal:</td>
                        <td style="text-align: right;">₹{{ number_format($quotation->subtotal_amount, 2) }}</td>
                    </tr>
                    @if($quotation->discount_amount > 0)
                        <tr>
                            <td>Discount:</td>
                            <td style="text-align: right; color: #059669;">- ₹{{ number_format($quotation->discount_amount, 2) }}</td>
                        </tr>
                    @endif
                    @if($quotation->tax_amount > 0)
                        <tr>
                            <td>Tax / GST:</td>
                            <td style="text-align: right;">₹{{ number_format($quotation->tax_amount, 2) }}</td>
                        </tr>
                    @endif
                    <tr class="total-row">
                        <td>Total ({{ $quotation->currency }}):</td>
                        <td style="text-align: right;">₹{{ number_format($quotation->total_amount, 2) }}</td>
                    </tr>
                </table>
            </div>
        </div>

        @if($quotation->terms_and_conditions)
            <div class="terms">
                <h3>Terms & Conditions</h3>
                <p>{{ $quotation->terms_and_conditions }}</p>
            </div>
        @endif

        <div class="footer">
            <p>UniWorld Holidays | Contact: +91-XXXXX-XXXXX | Email: info@uniworldholidays.com</p>
            <p>Generated on {{ now()->format('d M Y') }}</p>
        </div>
    </div>
</body>
</html>
