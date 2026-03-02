<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Delivery;

class DashboardController extends Controller
{
    public function stats()
    {
        return response()->json([
            'total'=>Delivery::count(),
            'pending'=>Delivery::where('status','PENDING')->count(),
            'ready'=>Delivery::where('status','READY')->count(),
            'not_ready'=>Delivery::where('status','NOT_READY')->count()
        ]);
    }
}