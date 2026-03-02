<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\WhatsappTemplate;

class WhatsappTemplateSeeder extends Seeder
{
    public function run(): void
    {
        WhatsappTemplate::create([
            'name' => 'Default Template',
            'message' =>
                "Yth {customer},

                Pengiriman dengan No DO {deliv_id}
                akan dikirim pada tanggal {ship_date}.

                Silakan konfirmasi melalui link berikut:
                {link}

                Terima kasih."
        ]);
    }
}