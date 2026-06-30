<!DOCTYPE html>
<html>
<head><meta charset="utf-8"><meta name="viewport" content="width=device-width, initial-scale=1"></head>
<body style="font-family: Arial, sans-serif; line-height: 1.6; color: #333; max-width: 600px; margin: 0 auto; padding: 20px;">
    <div style="background: #064f68; color: #fff; padding: 20px 25px; border-radius: 8px 8px 0 0;">
        <h1 style="margin: 0; font-size: 20px;">{{ setting('company_name', 'UniWorld Holidays') }}</h1>
        <p style="margin: 5px 0 0; opacity: 0.8; font-size: 13px;">{{ setting('company_tagline', 'Your Journey, Our Passion') }}</p>
    </div>

    <div style="background: #fff; border: 1px solid #e5e7eb; border-top: none; padding: 25px; border-radius: 0 0 8px 8px;">
        <p>Dear <strong>{{ $quotation->client_name }}</strong>,</p>

        <p>Thank you for your interest in travelling with us! We have prepared a personalised quotation for you:</p>

        <div style="background: #f8fafb; border-left: 4px solid #064f68; padding: 15px; margin: 20px 0; border-radius: 0 4px 4px 0;">
            <h3 style="margin: 0 0 5px; color: #064f68;">{{ $quotation->title }}</h3>
            <p style="margin: 0; font-size: 14px; color: #666;">
                @if($quotation->travel_date)Travel Date: {{ $quotation->travel_date->format('d M Y') }} · @endif
                {{ $quotation->adults }} Adult(s){{ $quotation->children ? ", {$quotation->children} Child(ren)" : '' }}
            </p>
            <p style="margin: 10px 0 0; font-size: 18px; font-weight: bold; color: #064f68;">
                Total: ₹{{ number_format($quotation->total_amount, 2) }}
            </p>
        </div>

        <p>View your complete quotation, download PDF, or accept/decline it online:</p>

        <div style="text-align: center; margin: 25px 0;">
            <a href="{{ $publicUrl }}" style="background: #064f68; color: #fff; padding: 12px 30px; border-radius: 6px; text-decoration: none; font-weight: bold; display: inline-block;">
                View Quotation →
            </a>
        </div>

        @if($quotation->validity_date)
            <p style="font-size: 13px; color: #666; text-align: center;">
                ⏰ This quotation is valid until <strong>{{ $quotation->validity_date->format('d M Y') }}</strong>.
            </p>
        @endif

        <hr style="border: none; border-top: 1px solid #e5e7eb; margin: 25px 0;">

        <p style="font-size: 13px; color: #666;">
            Have questions? Reply to this email or call us at {{ setting('company_phone', '+91 98765 43210') }}.<br>
            WhatsApp: <a href="https://wa.me/{{ setting('company_whatsapp', '919876543210') }}">Chat with us</a>
        </p>

        <p style="font-size: 12px; color: #999; margin-top: 20px;">
            {{ setting('company_name', 'UniWorld Holidays') }} · {{ setting('company_address', '') }} · {{ setting('company_city', 'Ahmedabad, Gujarat') }}
        </p>
    </div>
</body>
</html>
