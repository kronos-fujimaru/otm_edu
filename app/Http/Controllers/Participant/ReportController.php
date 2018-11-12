<?php

namespace App\Http\Controllers\Participant;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\User;
use App\Report;
use App\Analysis;
use Carbon\Carbon;
class ReportController extends ParticipantAuthController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
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
        return view('participant/report/index', compact(['participant']));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $userId = \Auth::user()->id;
        $participants = User::find($userId)->currentParticipants();

        if ($participants == null || $participants->count() == 0) {
            $participants = collect([]);
        }

        // TODO multi participants
        $participant = $participants->first();

        $report = new Report;
        $report->participant_id = $participant->id;
        $report->date = Carbon::now()->toDateString();
        $analyses = Analysis::openAnalyses()->get();
        return view('participant/report/create', compact(['report', 'analyses']));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules = [
            'analysis_id' => 'required',
            'content' => 'required|min:800|max:2000',
        ];
        $this->validate($request, $rules);
        $report = Report::create($request->all());
        return redirect("/participant/report")
                ->with(['flash_message' => "振り返りの登録が完了しました。"]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $report = Report::find($id);
        $report->date = Carbon::now()->toDateString();
        $analyses = Analysis::openAnalyses()->get();
        return view('participant/report/edit', compact(['report', 'analyses']));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $rules = [
            'analysis_id' => 'required',
            'content' => 'required|min:800|max:2000',
            'date' => 'required',
        ];
        $this->validate($request, $rules);
        $report = Report::find($id);
        $report->update($request->all());
        return redirect("/participant/report")
                ->with(['flash_message' => "振り返りの登録が完了しました。"]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $report = Report::find($id);
        $report->delete();
        return redirect("/participant/report")
                ->with(['flash_message' => "振り返りの削除が完了しました。"]);
    }
}
