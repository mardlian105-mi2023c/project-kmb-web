<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('deliveries', function (Blueprint $table) {

            // Tambahan status agar bisa APPROVED / REJECTED
            $table->enum('status', [
                'PENDING',
                'READY',
                'NOT_READY',
                'APPROVED',
                'REJECTED'
            ])->default('PENDING')->change();

            // Tanggal tambahan dari customer
            $table->date('customer_ship_date')->nullable()
                  ->after('ship_date');

            // Catatan dari customer
            $table->text('customer_note')->nullable()
                  ->after('customer_ship_date');

            // Waktu customer konfirmasi
            $table->timestamp('confirmed_at')->nullable()
                  ->after('customer_note');
        });
    }

    public function down(): void
    {
        Schema::table('deliveries', function (Blueprint $table) {
            $table->dropColumn([
                'customer_ship_date',
                'customer_note',
                'confirmed_at'
            ]);
        });
    }
};