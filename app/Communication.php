<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use Carbon\Carbon;

class Communication extends Model
{
    use SoftDeletes;

    function user()
    {
        return $this->belongsTo('App\User');
    }

    function isNew()
    {
        return $this->created_at > Carbon::yesterday();
    }
}
