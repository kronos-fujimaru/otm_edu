<?php

namespace App\Http\Controllers\Manager;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Http\Controllers\DailyWorkDownloadTrait;

class DailyWorkController extends ManagerAuthController
{
    use DailyWorkDownloadTrait;
}
