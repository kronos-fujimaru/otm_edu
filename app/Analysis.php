<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\StatusTrait;

class Analysis extends Model implements Status
{
    use SoftDeletes;

    use StatusTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['theme', 'date', 'status'];

    public function getDateTabYM()
    {
        return substr($this->date, 0, 7);
    }

    public function reports()
    {
        return $this->hasMany('App\Report');
    }

    public static function openAnalyses()
    {
        return Analysis::where('status', '=', Analysis::STATUS_OPEN);
    }

}
