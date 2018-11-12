<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Requests\Admin\ManagerRequest;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Admin\AdminAuthController;

use App\Manager;
use App\Training;
use App\Company;

class ManagersController extends AdminAuthController
{

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create(Request $request)
    {
        $companies = Company::all();
        $manager = new Manager;
        $manager->training_id = $request->input('training_id');
        return view('admin/managers/create', compact(['manager', 'companies']));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     * @return Response
     */
    public function store(ManagerRequest $request)
    {
        $rules = [
            'user_id' => 'required',
            'training_id' => 'required'
        ];
        $this->validate($request, $rules);
        $manager = Manager::create($request->all());
        return redirect("/admin/trainings/{$manager->training_id}/edit")
                ->with(['flash_message' => "人事担当者登録が完了しました。"]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        $companies = Company::all();
        $manager = Manager::findOrFail($id);
        return view('admin/managers/edit', compact(['manager', 'companies']));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Request  $request
     * @param  int  $id
     * @return Response
     */
    public function update(ManagerRequest $request, $id)
    {
        $rules = [
            'user_id' => 'required',
            'training_id' => 'required'
        ];
        $this->validate($request, $rules);
        $manager = Manager::find($id);
        $manager->update($request->all());
        return redirect("/admin/trainings/{$manager->training_id}/edit")
                ->with(['flash_message' => "人事担当者登録が完了しました。"]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        $manager = Manager::findOrFail($id);
        $manager->delete();
        return redirect("/admin/trainings/{$manager->training_id}/edit")
                ->with(['flash_message' => "人事担当者削除が完了しました。"]);
    }
}
