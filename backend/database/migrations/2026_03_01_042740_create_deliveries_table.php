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
        Schema::create('deliveries', function (Blueprint $table) {
            $table->id();
            $table->string('deliv_id');
            $table->string('order_id')->nullable();
            $table->string('customer_id');
            $table->string('customer_name');
            $table->string('customer_phone')->nullable();
            $table->text('address');
            $table->date('ship_date')->nullable();
            $table->string('token')->unique();
            $table->enum('status', ['PENDING','READY','NOT_READY'])->default('PENDING');
            $table->boolean('wa_sent')->default(false);
            $table->text('wa_message')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('deliveries');
    }
};