<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ApartmentSponsorship extends Model
{
    protected $fillable = [
        'sponsorship_id', 'apartment_id', 'start_date', 'end_date'
    ];
    //Conflitto updated_at/created_at
    public $timestamps = false;

    public function apartment()
    {
        return $this->belongsTo('App\Apartment');
    }

    public function sponsor()
    {
        return $this->belongsTo('App\Sponsor');
    }
}
