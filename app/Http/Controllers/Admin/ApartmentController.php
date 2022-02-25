<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
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
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.apartments.create');
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

        $new_apartment = new Apartment();

        $slug = Str::slug($data['name'], '-');
        $count = 1;

        while (Apartment::where('slug', $slug)->first()) {
            $slug .= '-' . $count;
            $count++;
        }
        $data['slug'] = $slug;

        $new_apartment->fill($data);
        $new_apartment->save;

        if (array_key_exists('services', $data)) {
            $new_apartment->tags()->attach($data['services']);
        }

        return redirect()->route('admin.apartments.show', $new_apartment->slug);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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

    // Validation rules
    private function validation_rules() {
        return [
            'name' => 'required',
            'slug' => 'nullable|max:80',
            'price' => 'required',
            'description' => 'required',
            'rooms' => 'required',
            'max_people' => 'required',
            'bathrooms' => 'required',
            'square_meters' => 'required',
            'latitude' => 'nullable',
            'longitude' => 'nullable',
            'visibility' => 'nullable'
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
