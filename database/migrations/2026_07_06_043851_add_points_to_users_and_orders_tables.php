<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        // Tambah kolom koin di tabel users (untuk menyimpan saldo koin user)
        Schema::table('users', function (Blueprint $table) {
            if (!Schema::hasColumn('users', 'coins')) {
                $table->integer('coins')->default(0)->after('email');
            }
        });

        // Tambah kolom catatan diskon & poin di tabel orders (untuk riwayat transaksi)
        Schema::table('orders', function (Blueprint $table) {
            if (!Schema::hasColumn('orders', 'discount_amount')) {
                $table->decimal('discount_amount', 15, 2)->default(0)->after('total_harga');
            }

            if (!Schema::hasColumn('orders', 'coins_used')) {
                $table->integer('coins_used')->default(0)->after('discount_amount');
            }

            if (!Schema::hasColumn('orders', 'coins_earned')) {
                $table->integer('coins_earned')->default(0)->after('coins_used');
            }
        });
    }

    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('coins');
        });
        Schema::table('orders', function (Blueprint $table) {
            $table->dropColumn(['discount_amount', 'coins_used', 'coins_earned']);
        });
    }
};
