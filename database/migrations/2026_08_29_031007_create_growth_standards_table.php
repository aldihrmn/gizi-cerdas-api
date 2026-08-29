<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('growth_standards', function (Blueprint $table) {
            $table->id();

            $table->enum('gender', ['male', 'female']);

            $table->unsignedInteger('age_month');

            $table->decimal('weight_sd3_min', 5, 2);
            $table->decimal('weight_sd2_min', 5, 2);
            $table->decimal('weight_sd1_min', 5, 2);
            $table->decimal('weight_median', 5, 2);
            $table->decimal('weight_sd1_max', 5, 2);
            $table->decimal('weight_sd2_max', 5, 2);
            $table->decimal('weight_sd3_max', 5, 2);

            $table->decimal('height_sd3_min', 5, 2);
            $table->decimal('height_sd2_min', 5, 2);
            $table->decimal('height_sd1_min', 5, 2);
            $table->decimal('height_median', 5, 2);
            $table->decimal('height_sd1_max', 5, 2);
            $table->decimal('height_sd2_max', 5, 2);
            $table->decimal('height_sd3_max', 5, 2);

            $table->timestamps();

            $table->unique(['gender', 'age_month']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('growth_standards');
    }
};
