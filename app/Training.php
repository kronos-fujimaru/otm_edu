<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use App\Support;
use App\Exam;
use App\Question;
use App\Company;
use App\StatusTrait;

class Training extends Model implements Status
{

    use SoftDeletes;

    use StatusTrait;

    public function openExams(){
        return $this->hasMany('App\ExaminationTraining')->where('status', '>', Exam::STATUS_BEFORE)->get();
    }

    public function openQuestions(){
        return $this->hasMany('App\Question')->where('status', '>', Question::STATUS_BEFORE)->get();
    }

    public function participantsBy(Company $company)
    {
        return $this->participants->filter(function($p) use($company){
            return $p->user->company_id == $company->id;
        });
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['title', 'place', 'date_from', 'date_to', 'instructor_id', 'status', 'videourl_id'];

    public function exams()
    {
        return $this->hasMany('App\Exam');
    }

    public function examinationTrainings()
    {
        return $this->hasMany('App\ExaminationTraining');
    }

    public function notes()
    {
        return $this->hasMany('App\Note');
    }

    public function questions()
    {
        return $this->hasMany('App\Question');
    }

    public function supports()
    {
        return $this->hasMany('App\Support');
    }

    public function techSupports()
    {
        return $this->typeFilter(Support::TYPE_TECH);
    }

    public function openTechSupports()
    {
        return $this->techSupports()->filter(function($s){
            return $s->status == Status::STATUS_OPEN;
        });
    }

    public function aidSupports()
    {
        return $this->typeFilter(Support::TYPE_AID);
    }

    public function openAidSupports()
    {
        return $this->aidSupports()->filter(function($s){
            return $s->status == Status::STATUS_OPEN;
        });
    }


    private function typeFilter($type)
    {
        return $this->supports()->get()->filter(function($e) use($type){
            return $e->type == $type;
        });
    }

    public function topics()
    {
        return $this->hasMany('App\Topic');
    }

    public function participants()
    {
        return $this->hasMany('App\Participant');
    }

    public function managers()
    {
        return $this->hasMany('App\Manager');
    }

    public function instructor()
    {
        return $this->belongsTo('App\Instructor');
    }

    public function videourl()
    {
        return $this->belongsTo('App\Videourl');
    }

    public function totalHours()
    {
        return $this->notes->reduce(function($sum, $n){return $sum + $n->hours;}, 0);
    }

    public function totalHoursBy($participant)
    {
        $p = $participant;
        return $this->notes->filter(function($n) use($p){
          return $p->date_from <= $n->date && $n->date <= $p->date_to;
        })->reduce(function($sum, $n){return $sum + $n->hours;}, 0);
    }


    public function totalActualHours($participant)
    {
        $p = $participant;
        $absences = $participant->absences;
        return $this->notes->filter(function($n) use($p){
          return $p->date_from <= $n->date && $n->date <= $p->date_to;
        })->reduce(function($sum, $n) use($absences){
            $absences = $absences->filter(function($a) use($n){
        		return $n->date == $a->date;
        	})->values();

            if($absences->count() == 1){
                return $sum + $absences[0]->hours;
            }
            return $sum + $n->hours;
        }, 0);
    }

}
