<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use Mail;
use App\Http\Requests;
use App\Http\Requests\Admin\TopicRequest;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Admin\AdminAuthController;

use App\Topic;
use App\Company;
use App\User;
use Carbon\Carbon;

use App\Http\Controllers\TopicFileDownloadTrait;


class TopicsController extends AdminAuthController
{
    use TopicFileDownloadTrait;

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $kronos = Company::kronos();
        return view('admin/topics/index', compact('kronos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        $topic = new Topic();
        $companies = Company::exceptKronos();
        return view('admin/topics/create', compact('topic', 'companies'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     * @return Response
     */
    public function store(TopicRequest $request)
    {

        $user = \Auth::user();

        $topic = new Topic();
        $topic->to_company_id = $request->company_id;
        $topic->from_company_id = Company::kronos()->id;
        $topic->user_id = $user->id;
        $topic->title = $request->title;
        $topic->comment = $request->comment;
        $topic->datetime = Carbon::now();

        // file
        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $destFileName = $file->getClientOriginalName();
            $filePath = 'topics/' . $user->id . "/" . $topic->datetime->format('Ymdhis') .  "/" . $destFileName;
            \Storage::put($filePath, file_get_contents($file->getRealPath()));

            $topic->file_name = $destFileName;
            $topic->file_path = $filePath;
            $topic->file_mime_type = $file->getClientMimeType();
        }
        $topic->save();
        $topic->sendMailToToCompany($user);
        return redirect("/admin/topics/{$topic->id}")
                ->with(['flash_message' => "お知らせ登録が完了しました。"]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        $user = \Auth::user();
        $topic = Topic::findOrFail($id);
        if ($topic->fromCompany->id == $user->company->id
            || $topic->toCompany->id == $user->company->id ) {
            return view('admin/topics/show', compact('topic'));
        }
        abort(403);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        $user = \Auth::user();
        $topic = Topic::findOrFail($id);
        if ($topic->fromCompany->id == $user->company->id) {
            $topic->delete();
            return redirect("/admin/topics")
                    ->with(['flash_message' => "お知らせ削除が完了しました。"]);
        }
        abort(403);
    }
}
