<?php

namespace App\Http\Controllers\Api\Buy;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\SponsorType;
use App\Http\Resources\SponsorResource;

class BuySponsorController extends Controller
{
    public function index(Request $request) {
            $sponsor_types = SponsorType::all();
            return SponsorResource::collection($sponsor_types);
    
    }
}