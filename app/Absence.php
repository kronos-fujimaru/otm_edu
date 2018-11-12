<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Absence extends Model
{
    use SoftDeletes;

    const TYPE_ABSENCE = 0;
    const TYPE_LATE = 1;
    const TYPE_EARLY = 2;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['participant_id', 'type', 'date', 'hours', 'reason'];

    public function participant()
    {
        return $this->belongsTo('App\Participant');
    }

    public function typeName()
    {
        if ($this->type == self::TYPE_ABSENCE){
            return "欠席";
        }else if($this->type == self::TYPE_LATE){
            return "遅刻";
        }else if($this->type == self::TYPE_EARLY){
            return "早退";
        }
        abort(500);
    }

    public function typeNameWithHtmlTag()
    {
        if ($this->type == self::TYPE_ABSENCE){
            return '<span class="label label-danger" data-toggle="tooltip" data-placement="top" title="' . $this->reason . '">欠席 <span class="glyphicon glyphicon-comment" aria-hidden="true"></span></span>';
        }else if($this->type == self::TYPE_LATE){
            return '<span class="label label-warning" data-toggle="tooltip" data-placement="top" title="' . $this->reason . '">遅刻 <span class="glyphicon glyphicon-comment" aria-hidden="true"></span></span>';
        }else if($this->type == self::TYPE_EARLY){
            return '<span class="label label-warning" data-toggle="tooltip" data-placement="top" title="' . $this->reason . '">早退 <span class="glyphicon glyphicon-comment" aria-hidden="true"></span></span>';
        }
        abort(500);
    }

}
