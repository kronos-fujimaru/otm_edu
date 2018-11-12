<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Admin\AdminAuthController;

use App\Note;
use Carbon\Carbon;

class NotesController extends AdminAuthController
{

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create(Request $request)
    {
        $note = new Note();
        $note->date = Carbon::now()->toDateString();
        $note->time_from = "09:00";
        $note->time_to = "18:00";
        $note->hours = 8.0;
        $note->training_id = $request->input('training_id');
//        $participant->date_from = str_replace('/', '-', $training->date_from);
        return view('admin/notes/create', compact(['note']));
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
            'training_id' => 'required',
            'date' => 'required',
            'time_from' => 'required',
            'time_to' => 'required',
            'content' => 'required',
        ];
        $this->validate($request, $rules);
        $note = Note::create($request->all());
        return redirect("/admin/process/trainings/{$note->training_id}")
                ->with(['flash_message' => "受講記録登録が完了しました。"]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        $note = Note::findOrFail($id);
        $note->date = str_replace('/', '-', $note->date);
        return view('admin/notes/edit', compact(['note']));
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
            'training_id' => 'required',
            'date' => 'required',
            'time_from' => 'required',
            'time_to' => 'required',
            'content' => 'required',
        ];
        $this->validate($request, $rules);
        $note = Note::findOrFail($id);
        $note->update($request->all());
        return redirect("/admin/process/trainings/{$note->training_id}")
                ->with(['flash_message' => "受講記録登録が完了しました。"]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        $note = Note::findOrFail($id);
        $note->delete();
        return redirect("/admin/process/trainings/{$note->training_id}")
                ->with(['flash_message' => "受講記録削除が完了しました。"]);
    }
}
