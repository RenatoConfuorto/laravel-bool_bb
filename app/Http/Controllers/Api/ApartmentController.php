<?php

namespace App\Http\Controllers\Api;

use App\Apartment;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ApartmentController extends Controller
{
    public function index(Request $request) {
        $apartments = Apartment::all();

        return response()->json([
            'success' => true,
            'results' => $apartments,
        ]);
    }

    public function show($slug) {
        $apartment = Apartment::where('slug', '=', $slug)->first();

        if ($apartment) {

            return response()->json([
                'success' => true,
                'results' => $apartment
            ]);
        }
        return response()->json([
            'success' => false,
            'results' => 'Nessun appartamento trovato'
        ]);
    }
}
