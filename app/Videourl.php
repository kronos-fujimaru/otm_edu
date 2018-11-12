<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Videourl extends Model
{
    protected $fillable = ['id', 'url', 'url_password', 'url_user_id'];
    public function videourls()
    {
        return $this->hasMany('App\Training');
    }
}
