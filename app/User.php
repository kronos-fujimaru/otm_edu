<?php

namespace App;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;
use Illuminate\Database\Eloquent\SoftDeletes;

use App\Training;

class User extends Model implements AuthenticatableContract, CanResetPasswordContract
{
    use Authenticatable, CanResetPassword;

    use SoftDeletes;

    const TYPE_ADMIN = 0;
    const TYPE_PARTICIPANT = 1;
    const TYPE_MANAGER = 2;

    const STATUS_CHANGE_PASSWORD = 0;
    const STATUS_NORMAL = 1;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'users';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'email', 'password', 'company_id'];

    public function currentTraining(){
        //TODO multi attend.

        $participant = $this->participants->filter(function($p){
            return $p->training->status == 0;
        })->first();

        if($participant == null){
            return null;
        }
        return $participant->training;
    }

    public function currentParticipants(){
        return $this->participants->filter(function($p){
            return $p->training->status == Training::STATUS_OPEN;
        });
    }

    public function currentManagers(){
        return $this->managers->filter(function($p){
            return $p->training->status == Training::STATUS_OPEN;
        });
    }

    public function prevManagers(){
        return $this->managers->filter(function($p){
            return $p->training->status == Training::STATUS_AFTER;
        });
    }

    public function findExam($exam_id){
        foreach ($this->exams as $exam) {
            if ($exam->id == $exam_id){
                return $exam;
            }
        }
        return null;
    }


    public function currentTrainingExams()
    {
        $training = $this->currentTraining();
        // TODO orderby
        return $this->exams->filter(function($e) use(&$training){
            return $e->training_id == $training->id;
        });
    }

    public function isParticipant(){
        return $this->type == self::TYPE_PARTICIPANT;
    }

    public function isManager(){
        return $this->type == self::TYPE_MANAGER;
    }

    public function isAdmin(){
        return $this->type == self::TYPE_ADMIN;
    }

    public function getDisplayString(){
        if($this->isParticipant()){
            return "受講者";
        }
        return "人事担当者";
    }

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = ['password', 'remember_token'];

    // public function cycles()
    // {
    //     return $this->hasMany('App\Cycle');
    // }

    public function exams()
    {
        return $this->belongsToMany('App\Exam')->withTimestamps()->withPivot('score');
    }

    public function questions()
    {
        return $this->belongsToMany('App\Question')->withTimestamps();
    }

    public function participants()
    {
        return $this->hasMany('App\Participant');
    }

    public function managers()
    {
        return $this->hasMany('App\Manager')->orderBy('id', 'desc');
    }

    public function topics()
    {
        return $this->hasMany('App\Topic');
    }


    // public function trainings()
    // {
    //
    //     return
    //     //$this->hasMany('App\Participant') //$this->belongsToMany('App\Training')->withTimestamps()->withPivot(['date_from', 'date_to']);
    // }
    //
    public function company()
    {
        return $this->belongsTo('App\Company');
    }


    public function isManagerFor($participant_id)
    {
        if(!$this->isManager()) {
            return false;
        }
        return !$this->company->users
        ->filter(function($u) {
            return $u->isParticipant();
        })
        ->filter(function($u) use($participant_id) {
            return $u->participants->first()->id == $participant_id;
        })->isEmpty();
    }

    public function hasReport($dailyReport)
    {
        if(!$this->isParticipant()) {
            return false;
        }
        return $this->participants->first()->id == $dailyReport->participant_id;
    }

    public function hasCommunication($communication)
    {
        return $this->id = $communication->user_id;
    }
}
