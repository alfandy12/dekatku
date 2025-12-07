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
        Schema::table('model_has_roles', function (Blueprint $table) {
           if (Schema::hasColumn('model_has_roles', 'store_id')) {
                $table->unsignedBigInteger('store_id')->nullable()->change();
            }
        });

        Schema::table('role_has_permissions', function (Blueprint $table) {
            if (Schema::hasColumn('role_has_permissions', 'store_id')) {
                $table->unsignedBigInteger('store_id')->nullable()->change();
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('model_has_roles', function (Blueprint $table) {
            if (Schema::hasColumn('model_has_roles', 'store_id')) {
                $table->unsignedBigInteger('store_id')->nullable(false)->change();
            }
        });

        // 2. Balikkan tabel 'role_has_permissions'
        Schema::table('role_has_permissions', function (Blueprint $table) {
            if (Schema::hasColumn('role_has_permissions', 'store_id')) {
                $table->unsignedBigInteger('store_id')->nullable(false)->change();
            }
        });
    }
};
