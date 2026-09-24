<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Membuat tabel untuk menyimpan catatan dari Admin
     * kepada User terkait data anak.
     */
    public function up(): void
    {
        Schema::create('admin_notes', function (Blueprint $table) {

            /*
            |--------------------------------------------------------------------------
            | ID
            |--------------------------------------------------------------------------
            */

            $table->id();


            /*
            |--------------------------------------------------------------------------
            | USER PENERIMA CATATAN
            |--------------------------------------------------------------------------
            |
            | Catatan ini ditujukan kepada user/orang tua.
            |
            */

            $table->foreignId('user_id')
                ->constrained('users')
                ->cascadeOnDelete();


            /*
            |--------------------------------------------------------------------------
            | ANAK
            |--------------------------------------------------------------------------
            |
            | Catatan dapat ditujukan kepada anak tertentu.
            |
            */

            $table->foreignId('child_id')
                ->constrained('children')
                ->cascadeOnDelete();


            /*
            |--------------------------------------------------------------------------
            | ADMIN PEMBUAT CATATAN
            |--------------------------------------------------------------------------
            |
            | Menyimpan ID admin yang memberikan catatan.
            |
            */

            $table->foreignId('admin_id')
                ->constrained('users')
                ->cascadeOnDelete();


            /*
            |--------------------------------------------------------------------------
            | ISI CATATAN
            |--------------------------------------------------------------------------
            */

            $table->text('note');


            /*
            |--------------------------------------------------------------------------
            | WAKTU
            |--------------------------------------------------------------------------
            */

            $table->timestamps();


            /*
            |--------------------------------------------------------------------------
            | INDEX
            |--------------------------------------------------------------------------
            |
            | Membantu pencarian catatan berdasarkan user dan anak.
            |
            */

            $table->index(
                ['user_id', 'child_id']
            );

        });
    }


    /**
     * Menghapus tabel admin_notes jika migration dibatalkan.
     */
    public function down(): void
    {
        Schema::dropIfExists('admin_notes');
    }
};