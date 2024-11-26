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
        Schema::create('customer_services', function (Blueprint $table) {
            $table->id();
            $table->foreignId('customer_id');
            $table->foreignId('user_id');
            $table->foreignId('malfunction_id');
            $table->string('description');
            $table->boolean('priority')->default(false);
            $table->string('location');
            $table->dateTime('date');
            $table->string('status');
            $table->time('start_appointment')->nullable();
            $table->time('end_appointment')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('customer_services');
    }
};
