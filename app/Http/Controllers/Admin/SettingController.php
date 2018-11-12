<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Controllers\BaseSettingController;


class SettingController extends BaseSettingController
{
    protected $viewPathPrefix = "admin";

    public function __construct()
    {
        $this->middleware('admin');
    }

}
