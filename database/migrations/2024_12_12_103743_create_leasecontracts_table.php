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
        Schema::create('leasecontracts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('customer_id')->constrained('customers')->onDelete('cascade');
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->date('start_date');
            $table->date('end_date');
            $table->enum('payment_method', ['creditcard', 'bank_transfer', 'cash']);
            $table->integer('machine_amount')->unsigned();
            $table->enum('notice_period', ['maandelijks', 'per kwartaal', 'per jaar'])->default('maandelijks');
            $table->enum('status', ['pending', 'active', 'terminated', 'completed'])->default('pending');
            $table->timestamps();
        });
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('leasecontracts');
    }
};
