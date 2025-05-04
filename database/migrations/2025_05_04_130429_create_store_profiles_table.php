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
        Schema::create('store_profiles', function (Blueprint $table) {
            $table->id();

            // HAPUS ->after('id') dari sini
            $table->unsignedBigInteger('user_id')->nullable();

            $table->string('title');
            $table->text('header_description');
            $table->string('header_image')->nullable();
            $table->string('store_image');
            $table->text('main_description');
            $table->timestamps(); // Kolom created_at & updated_at akan ditambahkan di akhir

            // Foreign key constraint tetap sama
            $table->foreign('user_id')
                  ->references('id')
                  ->on('users')
                  ->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Opsional: Hapus foreign key sebelum drop untuk kebersihan
        Schema::table('store_profiles', function (Blueprint $table) {
            // Pastikan nama constraint benar jika Anda tidak menggunakan default
            // Nama default: store_profiles_user_id_foreign
             if (Schema::hasForeignKey('store_profiles', 'store_profiles_user_id_foreign')) {
                 $table->dropForeign('store_profiles_user_id_foreign');
            }
        });

        Schema::dropIfExists('store_profiles');
    }
};