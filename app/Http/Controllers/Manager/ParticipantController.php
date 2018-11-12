<?php

namespace App\Http\Controllers\Manager;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Manager\ManagerAuthController;


use App\Participant;
use App\User;

class ParticipantController extends ManagerAuthController
{

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        $user = \Auth::user();

        $currentManagers = $user->currentManagers();
        if ($currentManagers == null || $currentManagers->count() == 0) {
            $currentManagers = collect([]);
        }

        $prevManagers = $user->prevManagers();
        if ($prevManagers == null || $prevManagers->count() == 0) {
            $prevManagers = collect([]);
        }

        $managers = $currentManagers->merge($prevManagers);

        $managers = $managers->filter(function($m) use ($user, $id) {
          $participant = $m->training->participants->find($id);
          return ($participant != null
              && $participant->user->company_id == $user->company_id);
        });

        if ($managers->count() == 0) {
          abort(403);
        }

        $participant = Participant::find($id);
        return view('manager/participant/show', compact('participant'));
    }

    public function api_score($id)
    {
        // TODO check session
        $user = \Auth::user();
        if($user->isManager() == false){
            abort(403);
        }

        $participant = Participant::findOrFail($id);
        if($participant->user->company_id != $user->company_id){
            abort(403);
        }

        $scores = $participant->examinationScores->sort(function($s1, $s2){
        	if($s1->examinationTraining->date > $s2->examinationTraining->date){
        		return 1;
        	}else if($s1->examinationTraining->date == $s2->examinationTraining->date){
        		return 0;
        	}
        	return -1;
        })->values();

        $dates = $scores->map(function($s){ return $s->examinationTraining->getDateMD();});
        $points = $scores->map(function($s){ return $s->score;});
        $avgs = $scores->map(function($s){ return $s->examinationTraining->avg();});
        return \Response::json(compact(['dates', 'points', 'avgs']));
    }


    public function api_cycle($id)
    {
        $user = \Auth::user();
        if($user->isManager() == false){
            abort(403);
        }

        $participant = Participant::findOrFail($id);
        if($participant->user->company_id != $user->company_id){
            abort(403);
        }

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
