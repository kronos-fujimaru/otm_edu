<?php

namespace App\Http\Controllers\Participant;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Participant\ParticipantAuthController;

use App\User;
use App\ExaminationTraining;
use App\ExaminationScore;
use App\ExaminationProblem;
use App\ExaminationAnswer;


class ExamController extends ParticipantAuthController
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $userId = \Auth::user()->id;
        $participants = User::find($userId)->currentParticipants();

        if ($participants == null || $participants->count() == 0) {
            $participants = collect([]);
        }

        // TODO multi participants
        $participant = $participants->first();
        return view('participant/exam/index', compact(['participant']));
    }

    public function api_score()
    {
        $userId = \Auth::user()->id;
        $participants = User::find($userId)->currentParticipants();

        // TODO multi
        $participant = $participants->first();
        $scores = $participant->examinationScores;

        $dates = $scores->map(function($s){ return $s->examinationTraining->getDateMD();});
        $points = $scores->map(function($s){ return $s->score;});
        $avgs = $scores->map(function($s){ return $s->examinationTraining->avg();});
        return \Response::json(compact(['dates', 'points', 'avgs']));
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     * @return Response
     */
    public function store(Request $request)
    {
        // Scoreの計算
        $point = 100/ExaminationProblem::SIZE;
        $correct = 0;
        $answerRecords =[];
        $examination_training_id = $request->input('examination_training_id');
        $exam = ExaminationTraining::find($examination_training_id);
        $problems = ExaminationProblem::where('examination_id', $exam->examination_id)->get();
        $answers = $request->input('answers');
        foreach ($problems as $problem) {
            if ($problem->answer == $answers[$problem->id]) {
                $correct++;
            }
        }
        // Scoreレコードの保存
        $userId = \Auth::user()->id;
        $participants = User::find($userId)->currentParticipants();
        if ($participants == null || $participants->count() == 0) {
            $participants = collect([]);
        }
        // TODO multi participants
        $participant = $participants->first();
        $score = new ExaminationScore();
        $score->examination_training_id = $request->input('examination_training_id');
        $score->participant_id = $participant->id;
        $score->score = $correct*$point;
        $score->save();

        // Answerレコードの保存
        foreach ($answers as $problemId => $answer) {
            $answerRecord = new ExaminationAnswer();
            $answerRecord->examination_score_id = $score->id;
            $answerRecord->examination_problem_id = $problemId;
            $answerRecord->answer = $answer;
            $answerRecord->save();
        }

        return redirect("/participant/exam/${examination_training_id}");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        $exam = ExaminationTraining::find($id);

        $userId = \Auth::user()->id;
        $participants = User::find($userId)->currentParticipants();
        if ($participants == null || $participants->count() == 0) {
            $participants = collect([]);
        }
        // TODO multi participants
        $participant = $participants->first();

        $score = $participant->findScoreOrFail($exam);
        $problems = ExaminationProblem::where('examination_id', $exam->examination_id)->get();

        return view('participant/exam/show', compact(['exam', 'score', 'problems']));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Request  $request
     * @param  int  $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        //
    }
}
