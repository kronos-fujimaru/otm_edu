<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Requests\Admin\SupportRequest;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Admin\AdminAuthController;

use App\Support;
use Carbon\Carbon;

class SupportsController extends AdminAuthController
{
    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create(Request $request)
    {
        $support = new Support;
        $support->training_id = $request->input('training_id');
        $support->date = Carbon::now()->toDateString();
        $support->status = Support::STATUS_BEFORE;
        $support->type = Support::TYPE_TECH;
        return view('admin/supports/create', compact(['support']));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     * @return Response
     */
    public function store(SupportRequest $request)
    {
        $support = Support::create($request->all());
        return redirect("/admin/trainings/{$support->training_id}/edit")
                ->with(['flash_message' => "サポート資料登録が完了しました。"]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        $support = Support::findOrFail($id);
        return view('admin/supports/edit', compact(['support']));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Request  $request
     * @param  int  $id
     * @return Response
     */
    public function update(SupportRequest $request, $id)
    {
        $support = Support::find($id);
        $support->update($request->all());
        return redirect("/admin/trainings/{$support->training_id}/edit")
                ->with(['flash_message' => "サポート資料登録が完了しました。"]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        $support = Support::findOrFail($id);
        $support->delete();
        return redirect("/admin/trainings/{$support->training_id}/edit")
                ->with(['flash_message' => "サポート資料削除が完了しました。"]);
    }
}
