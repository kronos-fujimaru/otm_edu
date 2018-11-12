<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Admin\AdminAuthController;

use App\Score;
use App\User;
use App\ExaminationScore;
use App\ExaminationTraining;
use App\ExaminationProblem;

class ScoresController extends AdminAuthController
{

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create(Request $request)
    {
        $score = new Score();
        $score->participant_id = $request->input('participant_id');
        $score->exam_id = $request->input('exam_id');
        return view('admin/scores/create', compact(['score']));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($scoreId)
    {
        $score = ExaminationScore::find($scoreId);
        $exam = $score->examinationTraining;
        $problems = ExaminationProblem::where('examination_id', $exam->examination_id)->get();
        $participantId = $score->participant->id;

        return view('admin/scores/show', compact(['exam', 'score', 'problems', 'participantId']));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     * @return Response
     */
    public function store(Request $request)
    {
        $rules = [
            'participant_id' => 'required',
            'exam_id' => 'required',
            'point' => 'required'
        ];
        $this->validate($request, $rules);
        $score = Score::create($request->all());
        return redirect("/admin/process/participants/{$score->participant_id}")
                ->with(['flash_message' => "理解度テスト結果登録が完了しました。"]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        $score = Score::findOrFail($id);
        return view('admin/scores/edit', compact(['score']));
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
        $rules = [
            'participant_id' => 'required',
            'exam_id' => 'required',
            'point' => 'required'
        ];
        $this->validate($request, $rules);

        $score = Score::findOrFail($id);
        $score->update($request->all());
        return redirect("/admin/process/participants/{$score->participant_id}")
                ->with(['flash_message' => "理解度テスト結果登録が完了しました。"]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        $score = Score::findOrFail($id);
        $score->delete();
        return redirect("/admin/process/participants/{$score->participant_id}")
                ->with(['flash_message' => "理解度テスト結果削除が完了しました。"]);
    }
}
