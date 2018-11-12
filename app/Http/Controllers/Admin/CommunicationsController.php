<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\CommunicationRequest;
use App\Participant;
use App\Communication;
use Carbon\Carbon;

class CommunicationsController extends AdminAuthController
{

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create(Request $request)
    {
        $participant = Participant::findOrFail($request->participant_id);

        return view('admin/communications/create', compact(['participant']));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     * @return Response
     */
    public function store(CommunicationRequest $request)
    {
        $user = \Auth::user();

        $communication = new Communication();
        $communication->participant_id = $request->participant_id;
        $communication->user_id = $user->id;
        $communication->comment = $request->comment;
        $communication->date = Carbon::now()->toDateString();
        $communication->save();

        return redirect("admin/communications/create?participant_id={$request->participant_id}")
                ->with(['flash_message' => "連絡事項を送信しました。"]);
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
  
         $communication = Communication::findOrFail($id);
         $participant_id = $communication->participant_id;

         if(!$user->hasCommunication($communication)) {
            abort(403);
         }

         $communication->delete();

         return redirect("admin/communications/create?participant_id={$participant_id}")
                 ->with(['flash_message' => "連絡事項を削除しました。"]);
    }
}
