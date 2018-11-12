<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\StatusTrait;

class Exam extends Model implements Status
{
    use SoftDeletes;

    use StatusTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['date', 'title', 'url', 'status', 'training_id'];

    // protected $dates = ['date']; // date type does not work. (datetime type only?)

    public function getDateMD()
    {
        return substr($this->date, 5); // ex 08/12
    }

    public function users()
    {
        return $this->belongsToMany('App\User')->withTimestamps()->withPivot('score');
    }

    public function training()
    {
        return $this->belongsTo('App\Training');
    }

    public function avg(){
        return $this->scores->sum(function($e){return $e->point;}) / $this->scores->count();
    }

    public function scores()
    {
        return $this->hasMany('App\Score');
    }

}
