<?php

namespace App\Http\Controllers\Api;

use App\Message;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class MessageController extends Controller
{
    public function store(Request $request) {

        $data = $request->all();
        // dd($request);
        $request->validate([
            'apartment_id' => 'required',
            'email' => 'required',
            'text' => 'required'
        ]);


        $message = new Message();

        $message->fill($data);

        $message->save();
    }
}
