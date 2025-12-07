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
                $table->dropPrimary();
                $table->unsignedBigInteger('store_id')->nullable()->change();
                $table->unique(['role_id', 'model_id', 'model_type', 'store_id'], 'model_has_roles_store_unique');
            }
        });

        Schema::table('role_has_permissions', function (Blueprint $table) {
            if (Schema::hasColumn('role_has_permissions', 'store_id')) {
                $table->dropPrimary();
                $table->unsignedBigInteger('store_id')->nullable()->change();
                $table->unique(['permission_id', 'role_id', 'store_id'], 'role_has_permissions_store_unique');
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
                $table->dropUnique('model_has_roles_store_unique');
                $table->unsignedBigInteger('store_id')->nullable(false)->change();
                $table->primary(['role_id', 'model_id', 'model_type', 'store_id']);
            }
        });

        Schema::table('role_has_permissions', function (Blueprint $table) {
            if (Schema::hasColumn('role_has_permissions', 'store_id')) {
                $table->dropUnique('role_has_permissions_store_unique');
                $table->unsignedBigInteger('store_id')->nullable(false)->change();
                $table->primary(['permission_id', 'role_id', 'store_id']);
            }
        });
    }
};
