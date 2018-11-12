<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Input;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\DailyReportRequest;
use App\ApprovalStatus;

use App\User;
use App\DailyReport;

class DailyReportController extends AdminAuthController
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

        return view('admin/dailyreport/edit', compact('dailyReport'));
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

        $dailyReport->admin_comment = $request->admin_comment;
        $dailyReport->admin_approval_user_id = $user->id;

        if(Input::get('approve')) {
            $dailyReport->admin_approval_status = ApprovalStatus::STATUS_APPROVED;
            $message = "日報を確認済みにしました。";
        } elseif(Input::get('reject')) {
            $dailyReport->admin_approval_status = ApprovalStatus::STATUS_REJECT;
            $message = "日報を再提出にしました";
        }

        $dailyReport->save();

        return redirect("admin/process/participants/{$dailyReport->participant_id}")
                ->with(['flash_message' => $message]);
    }
}
