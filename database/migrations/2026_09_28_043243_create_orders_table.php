<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Membuat tabel orders untuk menyimpan data pesanan user.
     */
    public function up(): void
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();

            $table->foreignId('user_id')
                ->constrained()
                ->cascadeOnDelete();

            $table->string('order_number')->unique();

            $table->decimal('total_amount', 12, 2);

            $table->text('address');

            $table->string('payment_method')
                ->default('cod');

            $table->string('status')
                ->default('pending');

            $table->timestamps();
        });
    }

    /**
     * Menghapus tabel orders.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};