<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class ErrorsController extends Controller
{
    /**
     *
     * @return Response
     */
    public function sessionExpired()
    {
        return view('errors/session/expired');
    }

}
