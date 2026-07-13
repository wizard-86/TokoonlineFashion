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
        if (!Schema::hasColumn('cart_detail', 'size')) {
            Schema::table('cart_detail', function (Blueprint $table) {
                $table->string('size')->nullable()->after('quantity');
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        if (Schema::hasColumn('cart_detail', 'size')) {
            Schema::table('cart_detail', function (Blueprint $table) {
                $table->dropColumn('size');
            });
        }
    }
};
