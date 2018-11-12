<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Http\Controllers\DailyWorkDownloadTrait;

class DailyWorkController extends AdminAuthController
{
    use DailyWorkDownloadTrait;
}
