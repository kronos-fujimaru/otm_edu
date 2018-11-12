<?php

namespace App\Http\Controllers\Manager;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Controllers\BaseSettingController;


class SettingController extends BaseSettingController
{
    protected $viewPathPrefix = "manager";

    public function __construct()
    {
        $this->middleware('manager');
    }

}
