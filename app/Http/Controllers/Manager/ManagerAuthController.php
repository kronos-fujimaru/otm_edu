<?php

namespace App\Http\Controllers\Manager;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class ManagerAuthController extends Controller
{
  public function __construct()
  {
      $this->middleware('manager');
  }

}
