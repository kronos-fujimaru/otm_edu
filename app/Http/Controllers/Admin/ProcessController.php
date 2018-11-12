<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Admin\AdminAuthController;


use App\Training;
use App\Participant;

class ProcessController extends AdminAuthController
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $trainings = Training::withTrashed()->orderby('id', 'desc')->get();
        return view('admin/process/index', compact(['trainings']));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function trainings($id)
    {
        $training = Training::findOrFail($id);
        return view('admin/process/trainings', compact(['training']));
    }


    public function participants($id)
    {
        $participant = Participant::findOrFail($id);
        return view('admin/process/participants', compact(['participant', 'companies']));
    }

}
