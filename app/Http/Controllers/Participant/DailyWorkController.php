<?php

namespace App\Http\Controllers\Participant;

use Illuminate\Http\Request;

use App\User;
use App\DailyReport;
use App\DailyWork;
use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Http\Controllers\DailyWorkDownloadTrait;

class DailyWorkController extends ParticipantAuthController
{
    use DailyWorkDownloadTrait;

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
     public function destroy($id)
     {
         # TODO find user => where report.id = ?
         $user = \Auth::user();
         $dailyWork = DailyWork::findOrFail($id);
         $dailyReport = $dailyWork->dailyReport;

         if(!$user->hasReport($dailyReport)) {
            abort(403);
         }

         if($dailyReport->isManagerApproved()) {
             return redirect("/participant/dailyreport/" . $dailyReport->id . "/edit")
                     ->withErrors(["確認済みのため成果物を削除できません。"]);
         }

         $dailyWork->delete();

         return redirect("/participant/dailyreport/" . $dailyReport->id . "/edit")
                 ->with(['flash_message' => "成果物削除が完了しました。"]);
     }
}
