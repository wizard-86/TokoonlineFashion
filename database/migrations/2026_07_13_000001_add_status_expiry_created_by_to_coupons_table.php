<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('coupons', function (Blueprint $table) {
            if (!Schema::hasColumn('coupons', 'status')) {
                $table->enum('status', ['active', 'inactive'])->default('active')->after('quota');
            }

            if (!Schema::hasColumn('coupons', 'expires_at')) {
                $table->dateTime('expires_at')->nullable()->after('status');
            }

            if (!Schema::hasColumn('coupons', 'created_by')) {
                $table->foreignId('created_by')->nullable()->after('expires_at')->constrained('users')->nullOnDelete();
            }
        });
    }

    public function down(): void
    {
        Schema::table('coupons', function (Blueprint $table) {
            if (Schema::hasColumn('coupons', 'created_by')) {
                $table->dropConstrainedForeignId('created_by');
            }

            if (Schema::hasColumn('coupons', 'expires_at')) {
                $table->dropColumn('expires_at');
            }

            if (Schema::hasColumn('coupons', 'status')) {
                $table->dropColumn('status');
            }
        });
    }
};
