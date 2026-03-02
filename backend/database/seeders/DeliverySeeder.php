<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Delivery;
use Illuminate\Support\Str;

class DeliverySeeder extends Seeder
{
    public function run(): void
    {
        $delivery1 = Delivery::create([
            'deliv_id' => 'DO-STEEL-001',
            'order_id' => 'SO-STEEL-001',
            'customer_id' => 'CUST-STEEL-001',
            'customer_name' => 'PT KENCANA MAJU BERSAMA',
            'customer_phone' => '081234567890',
            'address' => 'Jl. Industri Baja No.12, Gresik',
            'ship_date' => now()->addDays(2),
            'token' => Str::uuid(),
            'status' => 'PENDING'
        ]);

        $delivery1->items()->createMany([
            [
                'item_code' => 'HBEAM-200',
                'item_name' => 'H-Beam 200x200x8x12mm',
                'qty' => 120,
                'unit' => 'Batang',
                'remark' => 'Panjang 12 Meter'
            ],
            [
                'item_code' => 'WF-300',
                'item_name' => 'Wide Flange 300x150',
                'qty' => 80,
                'unit' => 'Batang',
                'remark' => 'Grade SS400'
            ],
            [
                'item_code' => 'PLATE-10MM',
                'item_name' => 'Plat Baja 10mm',
                'qty' => 50,
                'unit' => 'Lembar',
                'remark' => 'Ukuran 1.2m x 2.4m'
            ]
        ]);

        $delivery2 = Delivery::create([
            'deliv_id' => 'DO-STEEL-002',
            'order_id' => 'SO-STEEL-002',
            'customer_id' => 'CUST-STEEL-002',
            'customer_name' => 'PT MAKMUR KONSTRUKSI',
            'customer_phone' => '082233445566',
            'address' => 'Jl. Proyek Raya No.88, Surabaya',
            'ship_date' => now()->subDays(1),
            'token' => Str::uuid(),
            'status' => 'READY'
        ]);

        $delivery2->items()->createMany([
            [
                'item_code' => 'PIPA-6IN',
                'item_name' => 'Pipa Baja 6 Inch',
                'qty' => 200,
                'unit' => 'Batang',
                'remark' => 'Schedule 40'
            ],
            [
                'item_code' => 'BESI-BETON-16',
                'item_name' => 'Besi Beton Ulir 16mm',
                'qty' => 500,
                'unit' => 'Batang',
                'remark' => 'Panjang 12 Meter'
            ]
        ]);

        $delivery2->confirmation()->create([
            'is_ready' => true,
            'selected_date' => now(),
            'note' => 'Material siap diterima sesuai jadwal proyek'
        ]);

        $delivery3 = Delivery::create([
            'deliv_id' => 'DO-STEEL-003',
            'order_id' => 'SO-STEEL-003',
            'customer_id' => 'CUST-STEEL-003',
            'customer_name' => 'PT SENTOSA INFRASTRUKTUR',
            'customer_phone' => '083344556677',
            'address' => 'Jl. Pembangunan No.45, Malang',
            'ship_date' => now()->addDays(1),
            'token' => Str::uuid(),
            'status' => 'NOT_READY'
        ]);

        $delivery3->items()->createMany([
            [
                'item_code' => 'CNP-150',
                'item_name' => 'CNP 150x50x20x3.2mm',
                'qty' => 150,
                'unit' => 'Batang',
                'remark' => 'Galvanis'
            ]
        ]);

        $delivery3->confirmation()->create([
            'is_ready' => false,
            'selected_date' => now()->addDays(3),
            'note' => 'Area unloading belum siap, mohon kirim ulang minggu depan'
        ]);
    }
}