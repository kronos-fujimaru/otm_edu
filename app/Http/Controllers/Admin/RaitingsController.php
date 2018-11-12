<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Requests\Admin\RaitingRequest;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Admin\AdminAuthController;

use App\Participant;
use App\Raiting;

class RaitingsController extends AdminAuthController
{

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create(Request $request)
    {
        $raiting = new Raiting();
        $raiting->participant_id = $request->participant_id;
        return view('admin/raiting/create', compact(['raiting']));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     * @return Response
     */
    public function store(RaitingRequest $request)
    {
        $rules = [
            'participant_id' => 'required',
        ];
        $this->validate($request, $rules);
        $raiting = Raiting::create($request->all());
        return redirect("/admin/process/participants/{$raiting->participant_id}")
                ->with(['flash_message' => "総合評価登録が完了しました。"]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        $raiting = Raiting::findOrFail($id);
        return view('admin/raiting/edit', compact(['raiting']));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Request  $request
     * @param  int  $id
     * @return Response
     */
    public function update(RaitingRequest $request, $id)
    {
        $rules = [
            'participant_id' => 'required',
        ];
        $this->validate($request, $rules);
        $raiting = Raiting::findOrFail($id);
        $raiting->update($request->all());
        return redirect("/admin/process/participants/{$raiting->participant_id}")
                ->with(['flash_message' => "総合評価登録が完了しました。"]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        $raiting = Raiting::findOrFail($id);
        $raiting->delete();
        return redirect("/admin/process/participants/{$raiting->participant_id}")
                ->with(['flash_message' => "総合評価削除が完了しました。"]);
    }
}
