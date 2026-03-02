<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Delivery;
use App\Models\WhatsappTemplate;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Http;

class DeliveryController extends Controller
{
    public function index()
    {
        return Delivery::with('confirmation')->get();
    }

    public function store(Request $request)
    {
        $delivery = Delivery::create([
            ...$request->only([
                'deliv_id',
                'order_id',
                'customer_id',
                'customer_name',
                'customer_phone',
                'address',
                'ship_date'
            ]),
            'token'=>Str::uuid()
        ]);

        foreach($request->items as $item){
            $delivery->items()->create($item);
        }

        return response()->json(['status'=>'created']);
    }

    public function sendWa($id)
    {
        $delivery = Delivery::findOrFail($id);
        $template = WhatsappTemplate::first();

        $link = env('FRONTEND_URL')."/confirm/".$delivery->token;

        $message = str_replace(
            ['{customer}','{deliv_id}','{ship_date}','{link}'],
            [
                $delivery->customer_name,
                $delivery->deliv_id,
                $delivery->ship_date,
                $link
            ],
            $template->message
        );

        Http::post('https://api.fonnte.com/send',[
            'target'=>$delivery->customer_phone,
            'message'=>$message
        ]);

        $delivery->update([
            'wa_sent'=>true,
            'wa_message'=>$message
        ]);

        return response()->json(['status'=>'wa_sent']);
    }
}