<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Http\Requests\SettingEmailRequest;
use App\Http\Requests\SettingPasswordRequest;

use App\User;
class BaseSettingController extends Controller
{

    protected $viewPathPrefix;

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        return view("{$this->viewPathPrefix}/setting/index");
    }

    public function showEmail()
    {
        return view("{$this->viewPathPrefix}/setting/show_email");
    }

    public function showPassword()
    {
        return view("{$this->viewPathPrefix}/setting/show_password");
    }

    public function updateEmail(SettingEmailRequest $request)
    {
        $user = \Auth::user();
        if ($user == null) {
            // TODO システムエラー
        }
        $user->email = $request->input('email');
        $user->save();

        return redirect("/{$this->viewPathPrefix}/setting/email")
                ->with(['flash_message' => "メールアドレス変更が完了しました。"])
                ->withInput();
    }

    public function updatePassword(SettingPasswordRequest $request)
    {

      $user = \Auth::user();
      if ($user == null) {
          // TODO システムエラー
      }

      $prevStatus = $user->status;

      $user->password = bcrypt($request->input('password1'));
      $user->status = User::STATUS_NORMAL;
      $user->save();

      if ($prevStatus == User::STATUS_CHANGE_PASSWORD) {
          return redirect("/{$this->viewPathPrefix}");
      }

      return redirect("/{$this->viewPathPrefix}/setting/password")
              ->with(['flash_message' => "パスワード変更が完了しました。"])
              ->withInput();
    }
}
