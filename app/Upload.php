<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Upload extends Model
{
    public function msgboard()
    {
        return $this->belongsTo('App\Msgboard');
    }
}
