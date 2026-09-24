<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('growth_standards', function (Blueprint $table) {
            $table->string('index_type', 10)->change();
        });
    }

    public function down(): void
    {
        Schema::table('growth_standards', function (Blueprint $table) {
            $table->enum('index_type', [
                'wfa',
                'hfa',
                'bmiu'
            ])->change();
        });
    }
};