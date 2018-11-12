<?php

namespace App\Http\Controllers\Participant;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\BaseSettingController;

class SettingController extends BaseSettingController
{
    protected $viewPathPrefix = "participant";

    public function __construct()
    {
        $this->middleware('participant');
    }

}
