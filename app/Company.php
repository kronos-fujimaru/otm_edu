<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Company extends Model
{
    use SoftDeletes;

    public static function kronos()
    {
        $kronos = Company::where('kronos', '=', '1')->get();
        if ($kronos->count() > 1) {
            abort(500, 'Company table is ivalid. kronos record is duplicate.');
        }
        return $kronos->first();
    }

    public static function exceptKronos()
    {
        return Company::where('kronos', '=', '0')->get();
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'url'];

    public function users()
    {
        return $this->hasMany('App\User');
    }

    public function participants()
    {
        $obj = $this->filterByUserType(User::TYPE_PARTICIPANT);
        return $obj;
    }

    public function managers()
    {
        return $this->filterByUserType(User::TYPE_MANAGER);
    }

    public function admins()
    {
        return $this->filterByUserType(User::TYPE_ADMIN);
    }

    protected function filterByUserType($type)
    {
        // ->values()
        // http://stackoverflow.com/questions/21974402/filtering-eloquent-collection-data-with-collection-filter
        return $this->users()->get()->filter(function ($e) use($type)
        {
            return $e->type == $type;
        })->values();

    }

    public function fromTopics()
    {
        return $this->hasMany('App\Topic', 'from_company_id');
    }

    public function toTopics()
    {
        return $this->hasMany('App\Topic', 'to_company_id');
    }

}
