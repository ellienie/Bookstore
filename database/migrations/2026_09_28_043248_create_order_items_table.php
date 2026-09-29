<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Membuat tabel detail item pesanan.
     */
    public function up(): void
    {
        Schema::create('order_items', function (Blueprint $table) {
            $table->id();

            $table->foreignId('order_id')
                ->constrained()
                ->cascadeOnDelete();

            $table->foreignId('book_id')
                ->nullable()
                ->constrained()
                ->nullOnDelete();

            $table->string('book_title');

            $table->unsignedInteger('quantity');

            $table->decimal('price', 12, 2);

            $table->decimal('subtotal', 12, 2);

            $table->timestamps();
        });
    }

    /**
     * Menghapus tabel order_items.
     */
    public function down(): void
    {
        Schema::dropIfExists('order_items');
    }
};