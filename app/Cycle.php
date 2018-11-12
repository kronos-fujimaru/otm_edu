<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Cycle extends Model
{

    use SoftDeletes;

    const CONDITION_HIGH = 4;
    const CONDITION_MID = 3;
    const CONDITION_LOW = 2;
    const CONDITION_WORST = 1;

    const MOTIVATION_HIGH = 4;
    const MOTIVATION_MID = 3;
    const MOTIVATION_LOW = 2;
    const MOTIVATION_WORST = 1;

    public function isHighCondition(){
        return $this->condition == self::CONDITION_HIGH;
    }

    public function isMidCondition(){
        return $this->condition == self::CONDITION_MID;
    }

    public function isLowCondition(){
        return $this->condition == self::CONDITION_LOW;
    }

    public function isWorstCondition(){
        return $this->condition == self::CONDITION_WORST;
    }

    public function isHighMotivation(){
        return $this->motivation == self::MOTIVATION_HIGH;
    }

    public function isMidMotivation(){
        return $this->motivation == self::MOTIVATION_MID;
    }

    public function isLowMotivation(){
        return $this->motivation == self::MOTIVATION_LOW;
    }

    public function isWorstMotivation(){
        return $this->motivation == self::MOTIVATION_WORST;
    }


    public function participant()
    {
        return $this->belongsTo('App\Participant');
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['date', 'condition', 'motivation', 'participant_id'];

    public function getDateMD()
    {
        return substr($this->date, 5); // ex 08/12
    }


}
