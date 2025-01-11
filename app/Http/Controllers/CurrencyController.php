<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;

class CurrencyController extends Controller
{
    public function setCurrency(Request $request)
    {
        $request->validate(['currency' => 'required|string']);
        Session::put('currency', $request->currency);
        return response()->json(['message' => 'Currency saved'], 200);
    }
}
