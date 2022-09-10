<?php

namespace App\Http\Controllers\User;

use App\Apartment;
use App\View;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use LengthException;

class ApartmentsViewController extends Controller
{
    public function create($id){

        $c = View::select(DB::raw("Year(date) as year"))
        ->where('apartment_id','=',$id)
        ->groupBy('year')
        ->get();
        $data = [];
 
        foreach($c as $row) {
           $data['anno'][] = $row->year;
         }
        dd($data);
         $prova=$data['anno'];
        
        return view('user.visual.views',compact('prova'));
    }









    public function anni($id,$date){
        $c = View::select(DB::raw("(COUNT(*)) as count"),DB::raw("MONTHNAME(date) as monthname"))
        ->where('apartment_id','=',$id)
        ->whereYear('date', date($date))
        ->groupBy('monthname')
        ->get();
        dd($c);
        $data = [];
 
        foreach($c as $row) {
           $data['label'][] = $row->monthname;
           $data['data'][] = (int) $row->count;
         }
    
       $data['chart_data'] = json_encode($data);
       return view('user.visual.views',$data);
    }
}
