<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class DailyWork extends Model
{
    use SoftDeletes;

    public function dailyReport()
    {
        return $this->belongsTo('App\DailyReport');
    }
}
