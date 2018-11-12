<?php

namespace App\Http\Controllers\Manager;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Manager\ManagerAuthController;

class LiveCameraController extends ManagerAuthController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id = null)
    {
        $user = \Auth::user();
        $managers = $user->currentManagers();
        if ($managers == null || $managers->count() == 0) {
            $managers = collect([]);
        }

        // id指定で、該当する研修の動画を表示
        if ($id == null) {
            $manager = $managers->shift();
        } else {
            $manager = $managers->filter(function($manager) use ($id){
                 return $manager->training->id == $id;
            })->first();

            $managers = $managers->reject(function($manager) use ($id){
                 return $manager->training->id == $id;
            });
        }

        $videourl = "";
        if ($manager != null && $manager->training->videourl != null) {
            $videourl = $manager->training->videourl->url;
        }
        return view('manager/livecamera/index', compact('manager', 'videourl', 'managers'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
