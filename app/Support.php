<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Support extends Model implements Status
{

    use SoftDeletes;

    use StatusTrait;

    const TYPE_TECH = 0;
    const TYPE_AID = 1;

    public function typeString()
    {
        if ($this->type == 1) {
            return "助成金資料";
        }
        return "研修資料";
    }

    public function training()
    {
        return $this->belongsTo('App\Training');
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['title', 'url', 'status', 'type', 'training_id'];

}
