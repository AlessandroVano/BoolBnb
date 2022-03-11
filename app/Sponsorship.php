<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sponsorship extends Model
{
    protected $fillable = [
        'name', 'price', 'duration'
    ];

    public function ApartmentSponsorship()
    {
        return $this->hasMany('App\ApartmentSponsorship');
    }
}
