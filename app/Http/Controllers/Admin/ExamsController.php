<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Requests\Admin\ExamRequest;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Admin\AdminAuthController;

use App\Exam;
use App\ExaminationTraining;
use App\Examination;
use Carbon\Carbon;

class ExamsController extends AdminAuthController
{

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create(Request $request)
    {
        $examinations = Examination::all();

        $examinationTraining = new ExaminationTraining;
        $examinationTraining->training_id = $request->input('training_id');
        $examinationTraining->date = Carbon::now()->toDateString();
        $examinationTraining->status = ExaminationTraining::STATUS_BEFORE;
        return view('admin/exams/create', compact(['examinationTraining','examinations']));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     * @return Response
     */
    public function store(ExamRequest $request)
    {
        $examinationTraining = ExaminationTraining::create($request->all());
        return redirect("/admin/trainings/{$examinationTraining->training_id}/edit")
                ->with(['flash_message' => "理解度テスト登録が完了しました。"]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        $examinations = Examination::all();
        $examinationTraining = ExaminationTraining::findOrFail($id);
        return view('admin/exams/edit', compact(['examinationTraining', 'examinations']));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Request  $request
     * @param  int  $id
     * @return Response
     */
    public function update(ExamRequest $request, $id)
    {
        $examinationTraining = ExaminationTraining::find($id);
        $examinationTraining->update($request->all());
        return redirect("/admin/trainings/{$examinationTraining->training_id}/edit")
                ->with(['flash_message' => "理解度テスト登録が完了しました。"]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        $examinationTraining = ExaminationTraining::findOrFail($id);
        $examinationTraining->delete();
        return redirect("/admin/trainings/{$examinationTraining->training_id}/edit")
                ->with(['flash_message' => "理解度テスト削除が完了しました。"]);
    }

}
