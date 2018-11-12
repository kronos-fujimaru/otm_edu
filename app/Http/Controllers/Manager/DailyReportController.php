<?php

namespace App\Http\Controllers\Manager;

use Illuminate\Http\Request;
use Input;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Requests\Manager\DailyReportRequest;
use App\ApprovalStatus;

use App\User;
use App\DailyReport;


class DailyReportController extends ManagerAuthController
{
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

        if(!$user->isManagerFor($dailyReport->participant_id)) {
            abort(403);
        }

        return view('manager/dailyreport/edit', compact('dailyReport'));
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
        $user = \Auth::user();
        $dailyReport = DailyReport::findOrFail($id);

        if(!$user->isManagerFor($dailyReport->participant_id)) {
            abort(403);
        }

        $dailyReport->manager_comment = $request->manager_comment;
        $dailyReport->manager_approval_user_id = $user->id;

        if(Input::get('approve')) {
            $dailyReport->manager_approval_status = ApprovalStatus::STATUS_APPROVED;
            $message = "日報を確認済みにしました。";
        } elseif(Input::get('reject')) {
            $dailyReport->manager_approval_status = ApprovalStatus::STATUS_REJECT;
            $message = "日報を再提出にしました";
        }

        $dailyReport->save();

        return redirect("manager/participant/{$dailyReport->participant_id}")
                ->with(['flash_message' => $message]);
    }
}
