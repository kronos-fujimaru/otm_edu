<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Admin\AdminAuthController;

use App\Feedback;
use Carbon\Carbon;

class FeedbacksController extends AdminAuthController
{

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create(Request $request)
    {
        $feedback = new Feedback();
        $feedback->date = Carbon::now()->toDateString();
        $feedback->participant_id = $request->participant_id;
        return view('admin/feedbacks/create', compact(['feedback']));
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
            'title' => 'required',
            'date' => 'required',
            'comment' => 'required'
        ];
        $this->validate($request, $rules);
        $feedback = Feedback::create($request->all());

        $feedback->sendMailToManager();

        return redirect("/admin/process/participants/{$feedback->participant_id}")
                ->with(['flash_message' => "フィードバック登録が完了しました。"]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        $feedback = Feedback::findOrFail($id);
        return view('admin/feedbacks/edit', compact(['feedback']));
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
            'title' => 'required',
            'date' => 'required',
            'comment' => 'required'
        ];
        $this->validate($request, $rules);
        $feedback = Feedback::findOrFail($id);
        $feedback->update($request->all());
        return redirect("/admin/process/participants/{$feedback->participant_id}")
                ->with(['flash_message' => "フィードバック登録が完了しました。"]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        $feedback = Feedback::findOrFail($id);
        $feedback->delete();
        return redirect("/admin/process/participants/{$feedback->participant_id}")
                ->with(['flash_message' => "フィードバック削除が完了しました。"]);
    }
}
