<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Note extends Model
{

    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['date', 'time_from', 'time_to', 'hours', 'content', 'training_id'];

    public function training()
    {
        return $this->belongsTo('App\Training');
    }

}
