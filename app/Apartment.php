<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Apartment extends Model
{
    protected $table = 'Apartments';
    protected $fillable = [
         'user_id',
         'name',
         'slug',
         'price',
         'description',
         'rooms',
         'max_people',
         'bathrooms',
         'square_meters',
         'address',
         'latitude',
         'longitude',
         'image',
         'visibility'
         

    ];

    // RELAZIONE 
    // apartment - message

    public function messages() {
        return $this->hasMany('App\Message');
    }

     // RELAZIONE 
    // apartment - users

    public function users() {
        return $this->belongsTo('App\User');
    }

      // RELAZIONE 
     // apartment - service

    public function services() {
        return $this->belongsToMany('App\Service');
    }

    // RELAZIONE pivot
    // apartment - sponsorships

    public function sponsorships() {
        return $this->belongsToMany('App\Sponsorship', 'apartment_sponsorship')->withPivot('start_date', 'end_date');;
    }
}
