<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    public function apartments() {
        return $this->belongsTo('App\Apartment');
    }
}
