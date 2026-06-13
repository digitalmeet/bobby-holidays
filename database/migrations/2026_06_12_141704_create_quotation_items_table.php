<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('quotation_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('quotation_id')
                ->constrained('quotations')
                ->cascadeOnDelete();
            $table->foreignId('section_id')
                ->nullable()
                ->constrained('quotation_sections')
                ->nullOnDelete();
            $table->integer('sort_order')->default(0);
            $table->string('type');
            $table->string('title');
            $table->text('description')->nullable();
            $table->unsignedTinyInteger('nights')->nullable();
            $table->decimal('unit_cost', 12, 2)->default(0);
            $table->decimal('quantity', 10, 2)->default(1);
            $table->decimal('total_cost', 12, 2)->default(0);
            $table->boolean('is_included_in_total')->default(true);
            $table->boolean('is_optional')->default(false);
            $table->softDeletes();
            $table->timestamps();

            // Indexes for performance
            $table->index('quotation_id');
            $table->index('section_id');
            $table->index('type');
            $table->index('sort_order');
            $table->index('is_included_in_total');
            $table->index('is_optional');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('quotation_items');
    }
};
