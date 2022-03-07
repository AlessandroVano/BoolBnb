<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{

    protected $fillable = [
        'apartment_id',
        'name',
        'email',
        'message',
    ];

    public function apartments() {
        return $this->belongsTo('App\Apartment');
    }
}
