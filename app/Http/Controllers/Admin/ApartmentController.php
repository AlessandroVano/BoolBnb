<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

use App\Apartment;
use App\Service;
use App\Sponsorship;


class ApartmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $apartments = Apartment::all();

        return view('admin.apartments.index' , compact('apartments'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $services = Service::all();
        return view('admin.apartments.create', compact('services'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate($this->validation_rules(), $this->validation_messages());

        $data = $request->all();

        //Add apartment image
        if (array_key_exists('image', $data)) {
            $img_path = Storage::put('img-apartments', $data['image']);
            $data['image'] = $img_path;
        }

        $new_apartment = new Apartment();

        $slug = Str::slug($data['name'], '-');
        $count = 1;

        while (Apartment::where('slug', $slug)->first()) {
            $slug .= '-' . $count;
            $count++;
        }
        $data['slug'] = $slug;

        $new_apartment->fill($data);
        $new_apartment->save();

        if (array_key_exists('services', $data)) {
            $new_apartment->services()->attach($data['services']);
        }

        return redirect()->route('admin.apartments.show', $new_apartment->slug);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
        //Show apartment details
        $apartment = Apartment::where('slug', $slug)->first();

        if (!$apartment) {
            abort(404);
        }

        return view('admin.apartments.show', compact('apartment'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Apartment $apartment)
    {
        $services = Service::all();
       if(! $apartment) {
        abort(404);
       }
       return view('admin.apartments.edit', compact('apartment', 'services'));
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Apartment $apartment)
    {
         // richiamo funzione validazione
         $request->validate($this->validation_rules(), $this->validation_messages());

         $data = $request->all();

        //Viasibility
        if (array_key_exists('visibility', $data)) {
            $data['visibility'] = 1;
        } else {
            $data['visibility'] = 0;
        }

        //Update apartment image
        if (array_key_exists('image', $data)) {
            if ($apartment->image) {
                Storage::delete($apartment->image);
            }

            $data['image'] = Storage::put('img-apartments', $data['image']);
        }

         // update slug solo se il titolo cambia
         if($data['name'] != $apartment->name ) {
             $slug = Str::slug($data['name'], '-');
             $count = 1;
             //titolo apartment
             $base_slug = $slug;

             // ESECUZIONE CICLO SE TROVO UN POST CON LO SLUG ATTUALE
             while(Apartment::where('slug', $slug)->first()) {
                 //generazione nuovo slug con il suo contatore annesso

                 $slug = $base_slug . '_' . $count;
                 $count ++;
             }
             $data['slug'] = $slug;
         } 
         else {
             $data['slug'] = $apartment->slug;
         }
         $apartment->update($data);

         // UPDATE DELLE RELAZIONI DELLA PIVOT TRA APARTMENT E SERVICE
         if(array_key_exists('services', $data)) {
             // aggiunta di nuovi servizi (righe nella pivot) : aggiunta/ rimozione
             // aggiungo o rimuovo tutti i service che ho selezionato nalla form
             $apartment->services()->sync($data['services']);
         }
          else {
             // nessun checkbox x service selezioanti pulliamo tutto
             $apartment->services()->detach();
         }

         return redirect()->route('admin.apartments.show', $apartment->slug);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Apartment $apartment)
    {

        //Remouve local image if already exists
        if ($apartment->image) {
            Storage::delete($apartment->image);
        }

        $apartment->delete();

        return redirect()->route('admin.apartments.index')->with('deleted', $apartment->name);
    }

    // Validation rules
    private function validation_rules() {
        return [
            'name' => 'required',
            'slug' => 'nullable|max:80',
            'price' => 'nullable',
            'description' => 'nullable',
            'rooms' => 'nullable',
            'max_people' => 'nullable',
            'bathrooms' => 'nullable',
            'square_meters' => 'nullable',
            'latitude' => 'nullable',
            'longitude' => 'nullable',
            'visibility' => 'nullable',
            'image' => 'nullable|file|mimes:jpg,jpeg,bmp,png,webp',
        ];
    }

    // Validation Messages
    private function validation_messages() {
        return [
            'required' => 'This :attribute is a required field, be careful!',
            'max' => 'Max :max characters allowed for the :attributes'
        ];
    }
}
