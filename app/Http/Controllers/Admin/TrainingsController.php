<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Admin\AdminAuthController;

use App\Training;
use App\Http\Requests\Admin\TrainingRequest;
use App\Instructor;
use App\Videourl;
use Carbon\Carbon;

class TrainingsController extends AdminAuthController
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $trainings = Training::all();
        return view('admin/trainings/index', compact(['trainings']));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        $instructors = Instructor::all();
        $training = new Training();
        $videourls = Videourl::all();

        $date = Carbon::now();
        $date->month += 1;
        $date->day = 1;
        $training->date_from = $date->toDateString();
        $date->month += 1;
        $training->date_to = $date->toDateString();

        $training->status = 0;
        return view('admin/trainings/create', compact(['training', 'instructors', 'videourls']));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     * @return Response
     */
    public function store(TrainingRequest $request)
    {
        $training = Training::create($request->all());
        return redirect("/admin/trainings/{$training->id}/edit")
                ->with(['flash_message' => "研修登録が完了しました。"])
                ->withInput();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        $instructors = Instructor::all();
        $training = Training::find($id);
        $videourls = Videourl::all();

        // TODO setting?
        $training->date_from = str_replace("/", "-", $training->date_from);
        $training->date_to = str_replace("/", "-", $training->date_to);

        return view('admin/trainings/edit', compact(['training', 'instructors', 'videourls']));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Request  $request
     * @param  int  $id
     * @return Response
     */
    public function update(TrainingRequest $request, $id)
    {
        $training = Training::findOrFail($id);
        $training->update($request->all());
        return redirect("/admin/trainings/$id/edit")
                ->with(['flash_message' => "研修登録が完了しました。"])
                ->withInput();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        $training = Training::findOrFail($id);
        $training->delete();
        return redirect("/admin/trainings")
                ->with(['flash_message' => "研修削除が完了しました。"])
                ->withInput();
    }
}
