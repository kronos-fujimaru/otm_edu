<?php

namespace App\Http\Controllers\Participant;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\User;
use App\DailyReport;
use App\DailyWork;
use App\Http\Requests\Participant\DailyReportRequest;
use Carbon\Carbon;
use DB;

class DailyReportController extends ParticipantAuthController
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

        return view('participant/dailyreport/index', compact('participant'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        $dailyReport = new DailyReport();
        $dailyReport->date = Carbon::now()->toDateString();

        return view('participant/dailyreport/create', compact('dailyReport'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     * @return Response
     */
    public function store(DailyReportRequest $request)
    {
        DB::beginTransaction();

        try{
            $user = \Auth::user();

            $dailyReport = new DailyReport();
            $dailyReport->participant_id = $user->participants()->first()->id;
            $dailyReport->date = $request->date;
            $dailyReport->content = $request->content;

            if($dailyReport->isDuplicated($dailyReport->date, $dailyReport->participant_id)) {
                return redirect()
                        ->back()
                        ->withInput()
                        ->withErrors("日付が重複しています。");
            }
            $dailyReport->save();

            // file
            if ($request->hasFile('file')) {
                $file = $request->file('file');
                $destFileName = $file->getClientOriginalName();
                $filePath = 'dailyreport/' . $dailyReport->id . "/" . Carbon::now()->format('Ymdhis') .  "/" . $destFileName;
                \Storage::put($filePath, file_get_contents($file->getRealPath()));

                $dailyWork = new DailyWork();
                $dailyWork->daily_report_id = $dailyReport->id;
                $dailyWork->file_url = $filePath;
                $dailyWork->file_name = $destFileName;
                $dailyWork->file_mime_type = $file->getClientMimeType();

                $dailyWork->save();
            }
            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            throw $e;
        }
        return redirect("/participant/dailyreport/")
                ->with(['flash_message' => "日報登録が完了しました。"]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        $user = \Auth::user();
        $dailyReport = DailyReport::findOrFail($id);

        if(!$user->hasReport($dailyReport)) {
            abort(403);
        }

        return view('participant/dailyreport/edit', compact('dailyReport'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Request  $request
     * @param  int  $id
     * @return Response
     */
    public function update(DailyReportRequest $request, $id)
    {
        DB::beginTransaction();

        try{
            $user = \Auth::user();
            $dailyReport = DailyReport::findOrFail($id);

            if(!$user->hasReport($dailyReport)) {
                abort(403);
            }

            if($dailyReport->isManagerApproved()) {
                return redirect("/participant/dailyreport/{$id}/edit")
                        ->withErrors(["担当者確認済みのため更新できません。"]);
            }

            if($dailyReport->isDuplicated($request->date, $dailyReport->participant_id)) {
                return redirect("/participant/dailyreport/{$id}/edit")
                        ->withErrors("日付が重複しています。");
            }

            $dailyReport->date = $request->date;
            $dailyReport->content = $request->content;
            $dailyReport->save();

            if ($request->hasFile('file')) {
                $file = $request->file('file');
                $destFileName = $file->getClientOriginalName();
                $filePath = 'dailyreport/' . $dailyReport->id . "/" . Carbon::now()->format('Ymdhis') .  "/" . $destFileName;
                \Storage::put($filePath, file_get_contents($file->getRealPath()));

                $dailyWork = $dailyReport->dailyWork;
                if($dailyWork == null) {
                    $dailyWork = new DailyWork();
                }
                $dailyWork->daily_report_id = $dailyReport->id;
                $dailyWork->file_url = $filePath;
                $dailyWork->file_name = $destFileName;
                $dailyWork->file_mime_type = $file->getClientMimeType();

                $dailyWork->save();
            }
            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            throw $e;
        }

        return redirect("/participant/dailyreport/")
                ->with(['flash_message' => "日報更新が完了しました。"]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
     public function destroy($id)
     {
          $user = \Auth::user();
          $dailyReport = DailyReport::findOrFail($id);

          if(!$user->hasReport($dailyReport)) {
              abort(403);
          }

          if(!$dailyReport->isManagerYet()) {
              return redirect("/participant/dailyreport/")
                      ->withErrors(["担当者確認済みのため削除できません。"]);
          }

          $dailyWork = $dailyReport->dailyWork;
          if($dailyWork != null) {
              $dailyWork->delete();
          }
          $dailyReport->delete();

          return redirect("/participant/dailyreport")
                  ->with(['flash_message' => "日報削除が完了しました。"]);
    }
}
