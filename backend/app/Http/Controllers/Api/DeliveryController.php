<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Delivery;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class DeliveryController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | ADMIN CRUD
    |--------------------------------------------------------------------------
    */

    public function index()
    {
        return response()->json(Delivery::latest()->get());
    }

    public function store(Request $request)
    {
        $delivery = Delivery::create([
            'deliv_id'       => $request->deliv_id,
            'customer_name'  => $request->customer_name,
            'customer_phone' => $request->customer_phone,
            'ship_date'      => $request->ship_date,
            'note'           => $request->note,
            'token'          => Str::uuid(),
            'status'         => 'PENDING'
        ]);

        return response()->json($delivery);
    }

    public function update(Request $request, $id)
    {
        $delivery = Delivery::findOrFail($id);

        $delivery->update([
            'deliv_id'       => $request->deliv_id,
            'customer_name'  => $request->customer_name,
            'customer_phone' => $request->customer_phone,
            'ship_date'      => $request->ship_date,
            'note'           => $request->note,
        ]);

        return response()->json($delivery);
    }

    public function destroy($id)
    {
        Delivery::findOrFail($id)->delete();
        return response()->json(['message' => 'Deleted']);
    }

    /*
    |--------------------------------------------------------------------------
    | CUSTOMER PAGE
    |--------------------------------------------------------------------------
    */

    public function showByToken($token)
    {
        $delivery = Delivery::where('token', $token)->firstOrFail();
        return response()->json($delivery);
    }

    public function confirm(Request $request, $token)
    {
        $delivery = Delivery::where('token', $token)->firstOrFail();

        $delivery->update([
            'status' => $request->status,
            'customer_ship_date' => $request->customer_ship_date,
            'customer_note' => $request->customer_note,
            'confirmed_at' => now()
        ]);

        return response()->json(['message' => 'Confirmation saved']);
    }

    /*
    |--------------------------------------------------------------------------
    | WHATSAPP CLICK TO CHAT
    |--------------------------------------------------------------------------
    */

    public function generateWaLink($id)
    {
        $delivery = Delivery::findOrFail($id);

        $phone = $delivery->customer_phone;

        if (substr($phone, 0, 1) == "0") {
            $phone = "62" . substr($phone, 1);
        }

        $confirmLink = env('FRONTEND_URL') . "/confirm/" . $delivery->token;

        $message = urlencode(
            "Halo {$delivery->customer_name}\n\n" .
            "Delivery ID: {$delivery->deliv_id}\n" .
            "Tanggal Kirim: {$delivery->ship_date}\n" .
            "Note: {$delivery->note}\n\n" .
            "Silakan konfirmasi di link berikut:\n$confirmLink"
        );

        $waLink = "https://wa.me/$phone?text=$message";

        return response()->json([
            'wa_link' => $waLink
        ]);
    }
}