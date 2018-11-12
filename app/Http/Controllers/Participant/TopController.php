<?php

namespace App\Http\Controllers\Participant;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Participant\ParticipantAuthController;

use App\Cycle;
use App\User;

class TopController extends ParticipantAuthController
{

    // TODO session before filter

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $user = \Auth::user();

        if ($user->status == User::STATUS_CHANGE_PASSWORD) {
            return redirect("/participant/setting/password")
                        ->with(['flash_message' => "研修管理システムへようこそ。パスワードを変更してください。"]);
        }

        $participants = $user->currentParticipants();

        if ($participants == null || $participants->count() == 0) {
            $participants = collect([]);
        }

        // TODO multi participants
        $participant = $participants->first();
        return view('participant/top/index', compact('participant'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     * @return Response
     */
    public function store(Request $request)
    {

        $rules = [
            'date' => 'required',
            'participant_id' => 'required',
            'condition' => 'required',
            'motivation' => 'required',
              ];
        $this->validate($request, $rules);


        // insert or update
        $participant = User::find(\Auth::user()->id)->participants->find($request->participant_id);
        $date = $request->input('date');

        $cycle = Cycle::where('participant_id', '=', $participant->id)
              ->where('date', '=', $date)
              ->first();
        if ($cycle == null) {
            $cycle = new Cycle();
            $cycle->participant_id = $participant->id;
            $cycle->date = $date;
        }
        $cycle->condition = $request->input('condition');
        $cycle->motivation = $request->input('motivation');
        $cycle->save();

        return redirect('/participant')
                ->with(['flash_message' => "${date}の出席登録が完了しました。"])
                ->withInput();
    }


    // /**
    //  * Show the form for creating a new resource.
    //  *
    //  * @return Response
    //  */
    // public function create()
    // {
    //     //
    // }
    //
    //
    // /**
    //  * Display the specified resource.
    //  *
    //  * @param  int  $id
    //  * @return Response
    //  */
    // public function show($id)
    // {
    //     //
    // }
    //
    // /**
    //  * Show the form for editing the specified resource.
    //  *
    //  * @param  int  $id
    //  * @return Response
    //  */
    // public function edit($id)
    // {
    //     //
    // }
    //
    // /**
    //  * Update the specified resource in storage.
    //  *
    //  * @param  Request  $request
    //  * @param  int  $id
    //  * @return Response
    //  */
    // public function update(Request $request, $id)
    // {
    //     //
    // }
    //
    // /**
    //  * Remove the specified resource from storage.
    //  *
    //  * @param  int  $id
    //  * @return Response
    //  */
    // public function destroy($id)
    // {
    //     //
    // }
}
