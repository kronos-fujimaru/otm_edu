<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Requests\Admin\ParticipantRequest;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Admin\AdminAuthController;


use App\Participant;
use App\Training;
use App\Company;

class ParticipantsController extends AdminAuthController
{

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create(Request $request)
    {
        $companies = Company::all();
        $training = Training::find($request->input('training_id'));
        $participant = new Participant;
        $participant->training_id = $training->id;
        $participant->date_from = str_replace('/', '-', $training->date_from);
        $participant->date_to = str_replace('/', '-', $training->date_to);
        return view('admin/participants/create', compact(['participant', 'companies']));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     * @return Response
     */
    public function store(ParticipantRequest $request)
    {
        $participant = Participant::create($request->all());
        return redirect("/admin/trainings/{$participant->training_id}/edit")
                ->with(['flash_message' => "受講者登録が完了しました。"]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        $companies = Company::all();
        $participant = Participant::findOrFail($id);
        return view('admin/participants/edit', compact(['participant', 'companies']));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Request  $request
     * @param  int  $id
     * @return Response
     */
    public function update(ParticipantRequest $request, $id)
    {
        $participant = Participant::findOrFail($id);
        $participant->update($request->all());
        return redirect("/admin/trainings/{$participant->training_id}/edit")
                ->with(['flash_message' => "受講者登録が完了しました。"]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        $participant = Participant::findOrFail($id);
        $participant->delete();
        return redirect("/admin/trainings/{$participant->training_id}/edit")
                ->with(['flash_message' => "受講者削除が完了しました。"]);
    }

    public function api_scores($id)
    {
        // TODO check session
        if(\Auth::user()->isAdmin() == false){
            throw new \Exception();
        }

        $participant = Participant::findOrFail($id);
        $scores = $participant->examinationScores->sort(function($s1, $s2){
        	if($s1->examinationTraining->date > $s2->examinationTraining->date){
        		return 1;
        	}else if($s1->examinationTraining->date == $s2->examinationTraining->date){
        		return 0;
        	}
        	return -1;
        })->values();

        /* JSON Sample
        {
          'dates': ['2015/01/01', '2015/02/02', 2015/03/03],
          'points': [80, 90, 100],
          'avgs': [80, 70, 80]
        }
        */
        $dates = $scores->map(function($s){ return $s->examinationTraining->getDateMD();});
        $points = $scores->map(function($s){ return $s->score;});
        $avgs = $scores->map(function($s){ return $s->examinationTraining->avg();});
        return \Response::json(compact(['dates', 'points', 'avgs']));
    }


    public function api_cycles($id)
    {
        // TODO check session
        if(\Auth::user()->isAdmin() == false){
            throw new \Exception();
        }

        $participant = Participant::findOrFail($id);
        $cycles = $participant->cycles()->orderBy('date')->get();
        $dates = $cycles->map(function($c){
            return $c->getDateMD();
        });
        $motivations = $cycles->map(function($c){
            return $c->motivation;
        });
        $conditions = $cycles->map(function($c){
            return $c->condition;
        });
        return \Response::json(compact(['dates', 'motivations', 'conditions']));
    }
}
