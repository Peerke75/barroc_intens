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
        Schema::create('sales', function (Blueprint $table) {
            $table->id();
        $table->foreignId('customer_id');
        $table->foreignId('user_id');
        $table->foreignId('malfunction_id');
        $table->text('description');
        $table->string('priority');
        $table->string('location');
        $table->date('date');
        $table->string('status');
        $table->dateTime('start_appointment');
        $table->dateTime('end_appointment');
        $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sales');
    }
};
