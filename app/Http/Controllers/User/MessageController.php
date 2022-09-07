<?php

namespace App\Http\Controllers\User;

use App\Apartment;
use App\Http\Controllers\Controller;
use App\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class MessageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::user();
        $user_apartments = Apartment::where('user_id', $user->id)->get();
        $user_apartments_id = DB::table('apartments')->where('user_id', $user->id)->pluck('id')->toArray();

        foreach ($user_apartments_id as $id => $index) {
            $user_messages[] = Message::where('apartment_id', [$id => $index])->get();
        }

        return view('user.message.index', compact('user_messages', 'user_apartments'));
    }
    // -----------------------------------------------------------------------
    static function setIndexQuery($apartment_id)
    {
        $user_messages = Message::where('apartment_id', $apartment_id)->get();
        // dd($user_messages);
        return $user_messages;
        
    }
    // -----------------------------------------------------------------------

    /**
     * Display messages for a single apartment.
     *
     * @return \Illuminate\Http\Response
     */
    public function apartmentMessages($id)
    {
        $messages = Message::where('apartment_id', $id)->get();

        return view('user.message.apartment-messages', compact('messages'));
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

        $message = Message::findOrFail($id);

        $this->authorize('show', $message);

        return view('user.message.show', compact('message'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
