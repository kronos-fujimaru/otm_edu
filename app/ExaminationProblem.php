<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ExaminationProblem extends Model
{
    use SoftDeletes;

    const SIZE =20;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['examination_id', 'problem', 'answer'];

    public function examinationOptions()
    {
        return $this->hasMany('App\ExaminationOption');
    }

    public function examinationAnswers()
    {
        return $this->hasMany('App\ExaminationAnswer');
    }

    public function examination()
    {
        return $this->belongsTo('App\Examination');
    }
}
