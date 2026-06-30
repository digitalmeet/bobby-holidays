<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('online_payments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('booking_id')->nullable()->constrained('bookings')->nullOnDelete();
            $table->foreignId('quotation_id')->nullable()->constrained('quotations')->nullOnDelete();
            $table->string('gateway')->default('razorpay'); // razorpay, stripe, etc.
            $table->string('order_id')->nullable(); // razorpay order_id
            $table->string('payment_id')->nullable()->unique(); // razorpay payment_id
            $table->string('signature')->nullable(); // razorpay signature for verification
            $table->decimal('amount', 12, 2);
            $table->string('currency', 3)->default('INR');
            $table->string('status')->default('created'); // created, authorized, captured, failed, refunded
            $table->string('client_name')->nullable();
            $table->string('client_email')->nullable();
            $table->string('client_phone')->nullable();
            $table->text('notes')->nullable();
            $table->json('gateway_response')->nullable();
            $table->timestamp('paid_at')->nullable();
            $table->timestamps();

            $table->index('booking_id');
            $table->index('quotation_id');
            $table->index('order_id');
            $table->index('payment_id');
            $table->index('status');
            $table->index('created_at');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('online_payments');
    }
};
