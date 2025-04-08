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
        Schema::create('vehicles', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->string('thumbnail');
            $table->string('title');
            $table->integer('price');
            $table->string('description');
            $table->string('category');
            $table->string('modal');
            $table->string('location');
            $table->string('make');
            $table->integer('year');
            $table->string('manufacture_country');
            $table->integer('mileage');
            $table->string('exterior_color');
            $table->string('interior_color');
            $table->string('engine_type');
            $table->string('transmission');
            $table->string('engine_capacity');
            $table->json('additional_feature');
            $table->string('phone_number');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vehicles');
    }
};
