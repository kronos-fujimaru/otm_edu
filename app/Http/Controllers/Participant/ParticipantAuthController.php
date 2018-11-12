<?php

namespace App\Http\Controllers\Participant;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;


class ParticipantAuthController extends Controller
{
  public function __construct()
  {
      $this->middleware('participant');
  }
}
