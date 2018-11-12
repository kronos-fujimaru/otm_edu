<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Participant extends Model
{

    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['user_id', 'training_id', 'date_from', 'date_to'];

    public function hasScore($examinationTraining)
    {
        return $this->examinationScores->filter(function($s) use($examinationTraining){
            return $s->examination_training_id == $examinationTraining->id;
        })->count() > 0;
    }

    public function findScoreOrFail($exam)
    {
        $scores = $this->examinationScores->filter(function($s) use($exam){
            return $s->examination_training_id == $exam->id;
        });
        if($scores->count() == 0){
            // TODO 例外
        }
        return $scores->first();
    }

    public function myNotes()
    {

        $absences = $this->absences;
        $p = $this;
        return $this->training->notes->filter(function($n) use($p){
            return $p->date_from <= $n->date && $n->date <= $p->date_to;
          })->map(function($n) use($absences){
        	$absences = $absences->filter(function($a) use($n){
        		return $n->date == $a->date;
        	})->values();

        	if($absences->count() == 1){
        		$absence = $absences[0];

                $from = substr($n->time_from, 0, 5);
                $to = substr($n->time_to, 0, 5);
                $exam_time = "{$from} -{$to}";

                $examExcludeHours = $n->time_to - $n->time_from - $n->hours;

                $actualTime = "";
        		if($absence->type == Absence::TYPE_ABSENCE){
                    $actualTime = "0:00";
        		}else{
                    $actualTime = $this->toHourNotation($absence->hours);
                }
        		return ['date' => $n->date,
        				'type' => $absence->typeNameWithHtmlTag(),
        				'exam_time' => $exam_time,
                        'exam_exclude_hours' => $this->toHourNotation($examExcludeHours, 2),
        				'exam_actual_hours' => $this->toHourNotation($n->hours),
                        'actual_hours' => $actualTime,
        				'content' => $n->content];
        	}else{
                $from = substr($n->time_from, 0, 5);
                $to = substr($n->time_to, 0, 5);
                $exam_time = "{$from} -{$to}";

                $examExcludeHours = $n->time_to - $n->time_from - $n->hours;
        		return ['date' => $n->date,
        				'type' => '<span class="label label-info">出席</span>',
        				'exam_time' => $exam_time,
                        'exam_exclude_hours' => $this->toHourNotation($examExcludeHours, 2),
        				'exam_actual_hours' => $this->toHourNotation($n->hours),
                        'actual_hours' => $this->toHourNotation($n->hours),
        				'content' => $n->content];
        	}
        });
    }

    public function getPresence($date)
    {

        $cycle = $this->cycles()->where('date', '=', $date)->first();
        if ($cycle == null) {
            return '<span class="label label-warning">未登録</span>';
        }
        return '<span class="label label-success">出席</span>';
    }

    public function getCondition($date)
    {
        $cycle = $this->cycles()->where('date', '=', $date)->first();
        if ($cycle == null) {
            return '<span class="label label-warning">未登録</span>';
        }
        if ($cycle->isHighCondition()) {
            return "◎";
        }else if($cycle->isMidCondition()) {
            return "◯";
        }else if($cycle->isLowCondition()) {
            return "△";
        }
        return "×";
    }

    public function getMotication($date)
    {
        $cycle = $this->cycles()->where('date', '=', $date)->first();
        if ($cycle == null) {
            return '<span class="label label-warning">未登録</span>';
        }
        if ($cycle->isHighMotivation()) {
            return "◎";
        }else if($cycle->isMidMotivation()) {
            return "◯";
        }else if($cycle->isLowMotivation()) {
            return "△";
        }
        return "×";
    }

    private function toHourNotation($h){
        $minNotation = $h * 60;
        $hour = intval($minNotation / 60);
        $min = str_pad($minNotation % 60, 2, '0');
        return "$hour:$min";
    }

    public function getDateTabYM()
    {
        $reports = $this->reports->sort(function($f, $s)
        {
            return $f->analysis->date < $s->analysis->date ? 1 : -1;
        });
        $tabYM = collect([]);
        $dateYM = null;

        foreach ($reports as $report) {
            if ($report->analysis->getDateTabYM() != $dateYM)
            {
                $tabYM[] = $report->analysis->getDateTabYM();
            }
            $dateYM = $report->analysis->getDateTabYM();
        }
        return $tabYM;
    }

    public function getReportContentYM()
    {
        $reports = $this->reports->sort(function($f, $s)
        {
            return $f->analysis->date < $s->analysis->date ? 1 : -1;
        });
        $reportsYM = [];

        foreach ($reports as $report) {
            $reportsYM[$report->analysis->getDateTabYM()][] = $report;
        }
        return collect($reportsYM);
    }

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function training()
    {
        return $this->belongsTo('App\Training');
    }

    public function raitings()
    {
        return $this->hasMany('App\Raiting');
    }

    public function cycles()
    {
        return $this->hasMany('App\Cycle');
    }

    public function scores()
    {
        // return $this->hasMany('App\ExaminationScore');
        return $this->hasMany('App\Score');
    }

    public function examinationScores()
    {
        return $this->hasMany('App\ExaminationScore');
    }

    public function feedbacks()
    {
        return $this->hasMany('App\Feedback');
    }

    public function works()
    {
        return $this->hasMany('App\Work');
    }

    public function absences()
    {
        return $this->hasMany('App\Absence');
    }

    public function reports()
    {
        return $this->hasMany('App\Report');
    }

    public function dailyReports()
    {
        return $this->hasMany('App\DailyReport');
    }

    public function communications()
    {
        return $this->hasMany('App\Communication');
    }

    public function last2Communications()
    {
        $num = $this->hasMany('App\Communication')->count();
        $take = 2;
        $skip = $num - $take;
        return $this->hasMany('App\Communication')->orderBy('id')->skip($skip)->take($take);
    }
}
