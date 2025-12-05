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
        Schema::create('store_user', function (Blueprint $table) {
            // Foreign Key ke tabel 'stores'
            $table->foreignId('store_id')->constrained()->cascadeOnDelete();

            // Foreign Key ke tabel 'users'
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();

            //check owner
            $table->tinyInteger('is_owner')->default(0);

            // Kombinasi ini harus unik (satu user hanya bisa terhubung sekali ke satu store)
            $table->primary(['store_id', 'user_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('store_user');
    }
};
