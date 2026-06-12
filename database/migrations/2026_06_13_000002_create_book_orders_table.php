<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('book_orders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('book_id')->constrained()->cascadeOnDelete();
            $table->string('customer_email');
            $table->string('customer_name')->nullable();
            $table->string('stripe_session_id')->unique();
            $table->string('stripe_payment_intent')->nullable();
            $table->decimal('amount_paid', 8, 2);
            $table->string('currency', 3)->default('usd');
            $table->enum('status', ['pending', 'paid', 'failed'])->default('pending');
            $table->string('download_token', 64)->unique();
            $table->timestamp('downloaded_at')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('book_orders');
    }
};
