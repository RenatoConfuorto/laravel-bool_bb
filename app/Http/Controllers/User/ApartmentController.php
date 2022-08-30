<?php

namespace App\Http\Controllers\User;

use App\Apartment;
use App\ApartmentSponsorType;
use App\ExtraService;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ApartmentController extends Controller
{
    public function __construct()
    {
        $this->middleware('has_apartments')->except('create', 'store');
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
        
        $request->validate($this->getValidationRules());
        dd($request->all());
        $data['visibility'] = isset($data['visibility']) ? 1 : 0;

        $new_apartment = new Apartment();
        $new_apartment->user_id = $user->id;
        $new_apartment->latitude = 15; //ricavare con TomTom
        $new_apartment->longitude = 15;//ricavare con TomTom
        $new_apartment->visibility = $data['visibility'];
        $data['image'] = Storage::put('img', $data['image-cover']);
        $new_apartment->fill($data);
        $new_apartment->slug = Apartment::generateUniqueSlug($new_apartment->title);

        $new_apartment->save();

        $new_apartment->services()->sync($data['extra_services']);
        
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
        $request->validate($this->getValidationRules());

        $data = $request->all();
        $data['visibility'] = isset($data['visibility']) ? 1 : 0;

        
        $apartment = Apartment::findOrFail($id);
        
        $data['slug'] = Apartment::generateUniqueSlug($data['title']);
        
        if(isset($data['image-cover'])){
            if($apartment->image){
                Storage::delete($apartment->image);
            }
            $data['image'] = Storage::put('img', $data['image-cover']);
        }
        
        $apartment->visibility = $data['visibility'];
        $apartment->update($data);

        if (isset($data['extra_services'])) {
            $apartment->services()->sync($data['extra_services']);
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
        $apartment = Apartment::findOrFail($id);
        $apartment->services()->sync([]);

        $apartment->messages()->delete();
        $apartment->sponsorTypes()->delete();
        $apartment->views()->delete();
        $apartment->delete();

        return redirect()->route('user.apartment.index');
    }

    private function getValidationRules() {
        return [
            'title' => 'required|min:4|max:255',
            'price' => 'required|min:0|max:9999.99',
            'description' => 'nullable|max:20000',
            'rooms_number' => 'required|min:1|max:255',
            'bathrooms_number' => 'required|min:1|max:255',
            'beds_number' => 'required|min:1|max:255',
            'mqs' => 'required|integer|min:10|max:65535',
            'address' => 'required|min:4|max:255',
            'image' => 'mimes:jpg,jpeg,png,bmp,gif,svg,webp|max:1024',
            'extra_services' => 'required|exists:extra_services,id',
            'visibility' => 'nullable'
        ];
    }
}
