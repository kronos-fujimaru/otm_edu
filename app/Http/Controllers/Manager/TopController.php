<?php

namespace App\Http\Controllers\Manager;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Manager\ManagerAuthController;


use App\User;
use Carbon\Carbon;

class TopController extends ManagerAuthController
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {

        $user = \Auth::user();

        if ($user->status == User::STATUS_CHANGE_PASSWORD) {
            return redirect("/manager/setting/password")
                        ->with(['flash_message' => "研修管理システムへようこそ。パスワードを変更してください。"]);
        }

        // $managers = $user->currentManagers();
        // if ($managers == null || $managers->count() == 0) {
        //     $managers = collect([]);
        // }
        //
        // // TODO multi participants
        // $currentManagers = $managers;
        // $prevManagers = $user->prevManagers();


        $date = Carbon::now()->toDateString();
        return view('manager/top/index', compact('date', 'user'));
    }
}
