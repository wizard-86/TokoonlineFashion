<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        if (!Schema::hasTable('coupons')) {
            Schema::create('coupons', function (Blueprint $table) {
                $table->id();
                $table->string('code')->unique();
                $table->enum('type', ['percentage', 'nominal']);
                $table->decimal('value', 15, 2);
                $table->decimal('min_order', 15, 2)->default(0);
                $table->integer('quota')->default(100);
                $table->timestamps();
            });
        }

        if (!Schema::hasTable('bundles')) {
            Schema::create('bundles', function (Blueprint $table) {
                $table->id();
                $table->string('name');
                $table->decimal('bundle_price', 15, 2);
                $table->timestamps();
            });
        }

        if (!Schema::hasTable('bundle_product')) {
            Schema::create('bundle_product', function (Blueprint $table) {
                $table->id();
                $table->foreignId('bundle_id')->constrained()->onDelete('cascade');
                $table->foreignId('product_id')->constrained()->onDelete('cascade');
                $table->timestamps();
            });
        }
    }

    public function down()
    {
        Schema::dropIfExists('bundle_product');
        Schema::dropIfExists('bundles');
        Schema::dropIfExists('coupons');
    }
};
