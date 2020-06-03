<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    protected $fillable = [
        'date', 'time', 'description'
    ];
    public function User()
    {
        return $this->belongsTo('App\User');
    }
}
