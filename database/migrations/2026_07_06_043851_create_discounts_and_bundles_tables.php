<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        // 1. Tabel Kupon / Voucher Diskon
        Schema::create('coupons', function (Blueprint $table) {
            $table->id();
            $table->string('code')->unique(); // Contoh: URBAN10, POTONG20
            $table->enum('type', ['percentage', 'nominal']); // Tipe diskon
            $table->decimal('value', 15, 2); // Nilai diskon (misal: 10 untuk persen, 20000 untuk nominal)
            $table->decimal('min_order', 15, 2)->default(0); // Minimal belanja
            $table->integer('quota')->default(100); // Kuota pemakaian
            $table->timestamps();
        });

        // 2. Tabel Utama Paket Bundle
        Schema::create('bundles', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // Contoh: "Paket Urban Casual"
            $table->decimal('bundle_price', 15, 2); // Harga paket (misal: 80000)
            $table->timestamps();
        });

        // 3. Tabel Relasi Pivot (Produk apa saja yang ada di dalam bundle tersebut)
        Schema::create('bundle_product', function (Blueprint $table) {
            $table->id();
            $table->foreignId('bundle_id')->constrained()->onDelete('cascade');
            $table->foreignId('product_id')->constrained()->onDelete('cascade');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('bundle_product');
        Schema::dropIfExists('bundles');
        Schema::dropIfExists('coupons');
    }
};
