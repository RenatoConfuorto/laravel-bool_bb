<?php

namespace App\Http\Controllers\Api;

use App\Message;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class MessaageController extends Controller
{
    public function post($data) {
        return response()->json([
            'success' => true ,
            'results' => $data,
        ]);
    }
}
