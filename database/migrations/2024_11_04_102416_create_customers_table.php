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
        Schema::create('customers', function (Blueprint $table) {
            $table->id();
            $table->foreignId('contract_id');
            $table->foreignId('contact_persons_id');
            $table->string('company_name');
            $table->string('name');
            $table->string('mail');
            $table->boolean('BKR_check')->default(False);
            $table->string('order_status')->nullable();
            $table->timestamp('archived_at')->nullable()->after('updated_at');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('customers');
    }
};
