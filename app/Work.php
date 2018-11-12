<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Work extends Model
{

    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['date', 'participant_id', 'file_url', 'file_mime_type', 'file_name'];

    public function participant()
    {
        return $this->belongsTo('App\Participant');
    }
}
