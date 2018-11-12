<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Admin\AdminAuthController;

use App\User;

use App\Http\Requests\Admin\UserRequest;

class UsersController extends AdminAuthController
{

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create(Request $request)
    {
        // TODO type check, companyId
        $user = new User;
        $user->type = $request->input('type');
        $user->company_id = $request->input('companyId');

        return view('admin/users/create', compact(['user']));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     * @return Response
     */
    public function store(UserRequest $request)
    {

        if ($request->has('type') == false){
            // TODO Exception
        }

        $user = new User;
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->password = bcrypt(env('PASSWORD2', 'ops2015'));
        // TODO type check
        $user->type = $request->input('type');
        // TODO Session?
        $user->company_id = $request->input('company_id');
        $user->save();

        $messageTitle = $user->getDisplayString();
        return redirect("/admin/companies/{$user->company_id}/edit")
                ->with(['flash_message' => "{$messageTitle}登録が完了しました。"]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        // TODO type check, companyId
        $user = User::findOrFail($id);
        return view('admin/users/edit', compact(['user']));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Request  $request
     * @param  int  $id
     * @return Response
     */
    public function update(UserRequest $request, $id)
    {
        // TODO fix udate validtion for same email
        $user = User::findOrFail($id);
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->save();

        $messageTitle = $user->getDisplayString();
        return redirect("/admin/companies/{$user->company_id}/edit")
                ->with(['flash_message' => "{$messageTitle}登録が完了しました。"]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();
        $messageTitle = $user->getDisplayString();
        return redirect("/admin/companies/{$user->company_id}/edit")
                ->with(['flash_message' => "{$messageTitle}削除が完了しました。"]);
    }
}
