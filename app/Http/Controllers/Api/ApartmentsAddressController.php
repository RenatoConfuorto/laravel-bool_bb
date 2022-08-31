<?php

namespace App\Http\Controllers\Api;
use Illuminate\Support\Facades\Http;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ApartmentsAddressController extends Controller
{

    public static function index($prova) {
        $result = strstr($prova, ',', false);
        $url = Http::get('https://api.tomtom.com/search/2/geocode/'. $result.'.json?storeResult=true&language=it-IT&view=Unified&key=b4J1e7HlWzyGPehDTXwH8o0kl7zyTSuA');
        $coord = $url->getBody();
        // $coord = json_decode($url, true);
        if($coord = json_decode($url, true)){
        return $link=$coord['results'][0]['position'];;
        }else{
        $rest = truncateName($result);
        $url = Http::get('https://api.tomtom.com/search/2/geocode/'. $rest.'.json?storeResult=true&language=it-IT&view=Unified&key=b4J1e7HlWzyGPehDTXwH8o0kl7zyTSuA');
        $coord = $url->getBody();
        $coord = json_decode($url, true);
        return $link=$coord['results'][0]['position'];




        function truncateName($prova){
            $i=0;

            $bool=false;
            // while($bool=true){
            // while($i>3){
    
            // }
            // }

            $truncatearray = explode(" ",$prova);
            while($bool=true){
                if((is_numeric($truncatearray[$i]))){
                    $bool=true;
                    $assembarray[$i+1]=$truncatearray[$i+1];
                }else{
                    $i++;
                    $assembarray[$i]=$truncatearray[$i];
                }

            }
            return $finalmente=implode(" ",$assembarray);
        }
        }
    }

    // public function show($slug) {s
    //     $address = ;
    //     if ($address) {
    //         return response()->json([
    //             'success' => true,
    //             'results' => $address
    //         ]);
    //     }
    //     return response()->json([
    //         'success' => false,
    //         'error' => 'Nessun post trovato'
    //     ]);
    // }
}
