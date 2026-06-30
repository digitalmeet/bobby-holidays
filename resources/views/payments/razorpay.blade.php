<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pay — {{ setting('company_name', 'UniWorld Holidays') }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://checkout.razorpay.com/v1/checkout.js"></script>
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>
<body class="bg-gray-50 min-h-screen flex items-center justify-center p-4">
    <div class="w-full max-w-md">
        <div class="bg-white rounded-2xl shadow-lg overflow-hidden">
            <div class="bg-[#064f68] text-white p-6 text-center">
                <h1 class="text-xl font-bold">{{ setting('company_name', 'UniWorld Holidays') }}</h1>
                <p class="text-sm opacity-80 mt-1">Secure Payment</p>
            </div>

            <div class="p-6">
                <div class="mb-6">
                    <h2 class="font-semibold text-gray-900">{{ $quotation->title }}</h2>
                    <p class="text-sm text-gray-500 mt-1">Quote #{{ $quotation->public_id }}</p>
                </div>

                <div class="bg-gray-50 rounded-lg p-4 mb-6">
                    <div class="flex justify-between items-center">
                        <span class="text-gray-600">Amount</span>
                        <span class="text-2xl font-bold text-[#064f68]">₹{{ number_format($amount, 2) }}</span>
                    </div>
                </div>

                <div id="paymentSuccess" class="hidden bg-green-50 border border-green-200 text-green-800 rounded-lg p-4 mb-4 text-center">
                    <p class="font-semibold">✅ Payment Successful!</p>
                    <p class="text-sm mt-1">Thank you. Your payment has been received.</p>
                </div>

                <div id="paymentError" class="hidden bg-red-50 border border-red-200 text-red-800 rounded-lg p-4 mb-4 text-center">
                    <p class="font-semibold">❌ Payment Failed</p>
                    <p class="text-sm mt-1" id="errorMessage">Please try again or contact us.</p>
                </div>

                <button id="payBtn" onclick="initiatePayment()" class="w-full bg-[#064f68] hover:bg-[#053d52] text-white font-semibold py-3 px-6 rounded-lg transition">
                    Pay ₹{{ number_format($amount, 2) }}
                </button>

                <p class="text-xs text-gray-400 text-center mt-4">Secured by Razorpay. Your payment details are encrypted.</p>
            </div>
        </div>
    </div>

    <script>
    function initiatePayment() {
        const btn = document.getElementById('payBtn');
        btn.disabled = true;
        btn.textContent = 'Processing...';

        fetch('{{ route("payment.create-order") }}', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
            },
            body: JSON.stringify({
                quotation_id: {{ $quotation->id }},
                amount: {{ $amount }},
                client_name: '{{ $quotation->client_name }}',
                client_email: '{{ $quotation->client_email }}',
                client_phone: '{{ $quotation->client_phone }}',
            })
        })
        .then(res => res.json())
        .then(data => {
            if (data.error) {
                showError(data.error);
                btn.disabled = false;
                btn.textContent = 'Pay ₹{{ number_format($amount, 2) }}';
                return;
            }

            const options = {
                key: data.key_id,
                amount: data.amount,
                currency: data.currency,
                name: '{{ setting("company_name", "UniWorld Holidays") }}',
                description: '{{ $quotation->title }}',
                order_id: data.order_id,
                prefill: {
                    name: '{{ $quotation->client_name }}',
                    email: '{{ $quotation->client_email ?? "" }}',
                    contact: '{{ $quotation->client_phone ?? "" }}'
                },
                theme: { color: '#064f68' },
                handler: function(response) {
                    verifyPayment(response);
                },
                modal: {
                    ondismiss: function() {
                        btn.disabled = false;
                        btn.textContent = 'Pay ₹{{ number_format($amount, 2) }}';
                    }
                }
            };

            const rzp = new Razorpay(options);
            rzp.open();
        })
        .catch(() => {
            showError('Unable to connect. Please try again.');
            btn.disabled = false;
            btn.textContent = 'Pay ₹{{ number_format($amount, 2) }}';
        });
    }

    function verifyPayment(response) {
        fetch('{{ route("payment.verify") }}', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
            },
            body: JSON.stringify({
                razorpay_order_id: response.razorpay_order_id,
                razorpay_payment_id: response.razorpay_payment_id,
                razorpay_signature: response.razorpay_signature,
            })
        })
        .then(res => res.json())
        .then(data => {
            if (data.success) {
                document.getElementById('payBtn').classList.add('hidden');
                document.getElementById('paymentSuccess').classList.remove('hidden');
            } else {
                showError(data.error || 'Verification failed.');
            }
        })
        .catch(() => showError('Verification failed. Contact support.'));
    }

    function showError(msg) {
        document.getElementById('errorMessage').textContent = msg;
        document.getElementById('paymentError').classList.remove('hidden');
    }
    </script>
</body>
</html>
