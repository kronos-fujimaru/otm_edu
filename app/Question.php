<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Question extends Model implements Status
{

    use SoftDeletes;

    use StatusTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['date', 'title', 'url', 'status', 'training_id'];

    public function users()
    {
        return $this->belongsToMany('App\User')->withTimestamps();
    }

    public function training()
    {
        return $this->belongsTo('App\Training');
    }

}
