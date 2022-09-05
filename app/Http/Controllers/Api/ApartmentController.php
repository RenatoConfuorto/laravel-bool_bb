<?php

namespace App\Http\Controllers\Api;

use App\Apartment;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ApartmentController extends Controller
{
    public function index(Request $request) {
        $apartments = Apartment::all()->where('visibility', '=', 1);

        return response()->json([
            'success' => true,
            'results' => $apartments,
        ]);
    }

    public function show($slug) {
        $apartment = Apartment::where('slug', '=', $slug)->with(['services'])->first();

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
