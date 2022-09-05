<?php

namespace App\Http\Controllers\Api;

use App\Apartment;
use App\ExtraService;
use App\Http\Controllers\Controller;
use Dotenv\Result\Success;
use Illuminate\Http\Request;

class ApartmentController extends Controller
{
    public function index(Request $request) {
        $apartments = Apartment::all()->where('visibility', '=', 1);

        foreach ($apartments as $apartment) {
            if (!str_contains($apartment->image, 'picsum')) {
                $apartment->image = url('storage/' . $apartment->image);
            }
        }

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

    public function userSearch(Request $request){
        $data = $request->all();
        $keys = [
            // 'latitude', required
            // 'longitude', required
            'radius',
            'rooms',
            'beds',
        ];
        //controllare che ci siano lat e long e che siano corretti
        if(!isset($data['latitude']) ||
        !isset($data['longitude']) ||
        $data['latitude'] < -90 ||
        $data['latitude'] > 90 ||
        $data['longitude'] < -180 ||
        $data['longitude'] > 180
        ){
            return response()->json([
                'success' => false,
                'error' => 'Errore nella ricerca',
            ]);
        }
        $params = [];
        // controllare se ci sono servizi extra e se sono corretti
        if(isset($data['services'])){
            $params['services'] = json_decode($data['services']);

            $requestedServices = ExtraService::whereIn('id', $params['services'])->get();

            //controllare che i dati siano corretti
            if($requestedServices->count() !== count($params['services']))return response()->json([
                'success' => false,
                'error' => 'Uno dei servizi extra non è valido',
            ]);
        }

        //valori di default
        $params['radius'] = 20; //in Km
        $params['beds'] = 1;
        $params['rooms'] = 1;

        //controllare se i valori sono stati inseriti dall'utente
        foreach ($keys as $key) {
            if(isset($data[$key]))$params[$key] = $data[$key];
        }

        //controllare che i valori siano validi
        if($params['radius'] < 1 || $params['beds'] < 1 || $params['rooms'] < 1)return response()->json([
            'success' => false,
            'error' => "C'è stato un errore nella ricerca, riprovare",
        ]);
        
        //ricerca appartamenti per camere e posti letto
        $apartments = Apartment::where('rooms_number', '>', $params['rooms'])
        ->where('beds_number', '>', $params['beds'])
        ->with('services')
        ->get();

        //filtro per distanza
        $distanceFiltered = [];

        foreach ($apartments as $apartment) {
            //punto scelto dall'utente
            $coordinates = (object) [
                'latitude' => $data['latitude'],
                'longitude' => $data['longitude'],
            ];
            //calcolo della distanza dell'appartamento
            $distance = $apartment->getDistance($coordinates);

            if($distance <= $params['radius']){
                $apartment->distance = $distance;
                $distanceFiltered[] = $apartment;
            }
        }

        //oridnare i risultati per distanza
        usort($distanceFiltered, function($a, $b) {
            return $a->distance > $b->distance ? 1 : -1;
        });

        //togliere gli apprtamenti non visibili
        $distanceFiltered = array_filter($distanceFiltered, function($apartment){
            return $apartment->visibility;
        });

        //controllare i filtri per i servizi extra
        $filteredApartments = [];
        if(isset($params['services'])){
            //controllare ogni appartamento
            foreach($distanceFiltered as $apartment){
                $apartmentServices = $apartment->getServicesId();
                if ( $params['services'] == array_intersect($params['services'], $apartmentServices) ) {
                    $filteredApartments[] = $apartment;
                }
            }
        }else{
            $filteredApartments = $distanceFiltered;
        }

        return response()->json([
            'success' => true,
            'data'=> $filteredApartments,
        ]);
    }
}
