<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // 1. Tabel Utama Bundles
        Schema::create('bundles', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->integer('bundle_price');
            $table->timestamps();
        });

        // 2. Tabel Pivot Penghubung Banyak Produk ke Banyak Paket (Many-to-Many)
        Schema::create('bundle_product', function (Blueprint $table) {
            $table->id();
            $table->foreignId('bundle_id')->constrained()->onDelete('cascade');
            $table->foreignId('product_id')->constrained()->onDelete('cascade');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('bundle_product');
        Schema::dropIfExists('bundles');
    }
};
