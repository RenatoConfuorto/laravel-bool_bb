<?php

namespace App\Http\Controllers\User;

use App\Apartment;
use App\ExtraService;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ApartmentController extends Controller
{
    public function __construct()
    {
        $this->middleware('has_apartments')->except('create');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::user();
        $apartments = Apartment::where('user_id', $user->id)->get();
        return view('user.apartment.index', compact('apartments'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $extra_services = ExtraService::all();
        return view('user.apartment.create', compact('extra_services'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user = Auth::user();

        $data = $request->all();

        $new_apartment = new Apartment();
        $new_apartment->user_id = $user->id;
        $new_apartment->latitude = 15; //ricavare con TomTom
        $new_apartment->longitude = 15;//ricavare con TomTom
        $new_apartment->fill($data);
        $new_apartment->slug = Apartment::generateUniqueSlug($new_apartment->title);

        $new_apartment->save();

        if (isset($data['extra_services'])) {
            $new_apartment->services()->sync($data['extra_services']);
        }
        
        return redirect()->route('user.apartment.show', ['apartment' => $new_apartment->id]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $apartment = Apartment::findOrFail($id);
        // dd($apartment);
        return view('user.apartment.show', compact('apartment'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $apartment = Apartment::findOrFail($id);
        $extra_services = ExtraService::all();
        // dd($apartment);
        return view('user.apartment.edit', compact('apartment','extra_services'));
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
        $data = $request->all();

        $apartment = Apartment::findOrFail($id);

        $data['slug'] = Apartment::generateUniqueSlug($data['title']);

        $apartment->update($data);

        if (isset($data['extra_services'])) {
            $apartment->services()->sync($data['extra_services']);
        } else {
            $apartment->services()->sync([]);
        }

        return redirect()->route('user.apartment.show', ['apartment' => $apartment->id]);
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
