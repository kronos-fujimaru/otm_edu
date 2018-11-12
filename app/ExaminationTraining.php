<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\StatusTrait;

class ExaminationTraining extends Model implements Status   
{
    use SoftDeletes;

    use StatusTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['examination_id', 'training_id', 'date', 'status'];

    public function getDateMD()
    {
        return substr($this->date, 5); // ex 08/12
    }

    public function avg(){
        return $this->scores->sum(function($e){return $e->score;}) / $this->scores->count();
    }

    public function examination() {
        return $this->belongsTo('App\Examination');
    }

    public function training() {
        return $this->belongsTo('App\Training');
    }

    public function scores() {
        return $this->hasMany('App\ExaminationScore');
    }
}
