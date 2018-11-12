<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Requests\Admin\QuestionRequest;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Admin\AdminAuthController;


use App\Question;
use Carbon\Carbon;

class QuestionsController extends AdminAuthController
{

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create(Request $request)
    {
        $question = new Question;
        $question->training_id = $request->input('training_id');
        $question->date = Carbon::now()->toDateString();
        $question->status = Question::STATUS_BEFORE;
        return view('admin/questions/create', compact(['question']));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     * @return Response
     */
    public function store(QuestionRequest $request)
    {
        $question = Question::create($request->all());
        return redirect("/admin/trainings/{$question->training_id}/edit")
                ->with(['flash_message' => "アンケート登録が完了しました。"]);

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        $question = Question::findOrFail($id);
        return view('admin/questions/edit', compact(['question']));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Request  $request
     * @param  int  $id
     * @return Response
     */
    public function update(QuestionRequest $request, $id)
    {
        $question = Question::find($id);
        $question->update($request->all());
        return redirect("/admin/trainings/{$question->training_id}/edit")
                ->with(['flash_message' => "アンケート登録が完了しました。"]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        $question = Question::findOrFail($id);
        $question->delete();
        return redirect("/admin/trainings/{$question->training_id}/edit")
                ->with(['flash_message' => "アンケート削除が完了しました。"]);
    }
}
