<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Request extends Model
{
    protected $table = 'requests';
    public function requestee()
    {
        return $this->belongsTo('App\User', 'requestee');
    }
    public function illustrator()
    {
        return $this->belongsTo('App\User', 'illustrator');
    }
}
