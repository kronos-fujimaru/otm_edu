<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Score extends Model
{

    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['participant_id', 'exam_id', 'point'];

    public function participant()
    {
        return $this->belongsTo('App\Participant');
    }

    public function exam()
    {
        return $this->belongsTo('App\Exam');
    }

}
