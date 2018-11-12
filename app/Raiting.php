<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Training;

class Raiting extends Model
{
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['participant_id', 'title', 'skill_a', 'skill_a_comment', 'skill_b', 'skill_b_comment', 'skill_c', 'skill_c_comment', 'skill_d', 'skill_d_comment', 'skill_e', 'skill_e_comment', 'skill_f', 'skill_f_comment', 'comment'];

    public function participant()
    {
        return $this->belongsTo('App\Participant');
    }

}
