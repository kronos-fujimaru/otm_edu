<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Report extends Model
{
    use SoftDeletes;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['participant_id', 'analysis_id', 'content', 'date'];

    public function getDateTabYM()
    {
        return substr($this->date, 0, 7);
    }

    public function participant()
    {
        return $this->belongsTo('App\Participant');
    }

    public function analysis()
    {
        return $this->belongsTo('App\Analysis');
    }

}
