<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Requests\Admin\AbsenceRequest;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Admin\AdminAuthController;


use App\Absence;
use Carbon\Carbon;

class AbsencesController extends AdminAuthController
{

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create(Request $request)
    {
        $absence = new Absence();
        $absence->date = Carbon::now()->toDateString();
        $absence->participant_id = $request->participant_id;
        return view('admin/absences/create', compact(['absence']));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     * @return Response
     */
    public function store(AbsenceRequest $request)
    {
        $absence = Absence::create($request->all());
        return redirect("/admin/process/participants/{$absence->participant_id}")
                ->with(['flash_message' => "遅刻・欠席・早退登録が完了しました。"]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        $absence = Absence::findOrFail($id);
        $absence->date = str_replace('/', '-', $absence->date);
        return view('admin/absences/edit', compact(['absence']));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Request  $request
     * @param  int  $id
     * @return Response
     */
    public function update(AbsenceRequest $request, $id)
    {
        $absence = Absence::findOrFail($id);
        $absence->update($request->all());
        return redirect("/admin/process/participants/{$absence->participant_id}")
                ->with(['flash_message' => "遅刻・欠席・早退登録が完了しました。"]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        $absence = Absence::findOrFail($id);
        $absence->delete();
        return redirect("/admin/process/participants/{$absence->participant_id}")
                ->with(['flash_message' => "遅刻・欠席・早退削除が完了しました。"]);
    }
}
