<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sponsorship extends Model
{
    public function apartments() {
        return $this->belongsToMany('App\Apartment')
                    ->withPivot('start_date', 'end_date')
                    ->withTimestamps();
    }
}
