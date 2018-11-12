<?php

namespace App\Http\Controllers\Manager;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Requests\Manager\TopicRequest;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Manager\ManagerAuthController;

use App\User;
use App\Topic;
use App\Company;
use Carbon\Carbon;

use App\Http\Controllers\TopicFileDownloadTrait;

class TopicsController extends ManagerAuthController
{

    use TopicFileDownloadTrait;


    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $userId = \Auth::user()->id;
        $user = User::find($userId);
        $managers = $user->currentManagers();
        if ($managers == null || $managers->count() == 0) {
            $managers = collect([]);
        }
        // TODO multi participants
        $manager = $managers->first();
        return view('manager/topics/index', compact('manager'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        $userId = \Auth::user()->id;
        $user = User::find($userId);
        $managers = $user->currentManagers();
        if ($managers == null || $managers->count() == 0) {
            $managers = collect([]);
        }
        // TODO multi participants
        $manager = $managers->first();

        $topic = new Topic();
        $topic->training_id = $manager->training_id;
        return view('manager/topics/create', compact('topic'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     * @return Response
     */
    public function store(TopicRequest $request)
    {
        $userId = \Auth::user()->id;
        $user = User::find($userId);

        $topic = new Topic();
        $topic->to_company_id = Company::kronos()->id;
        $topic->from_company_id = $user->company->id;
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
        return redirect("/manager/topics/{$topic->id}")
                ->with(['flash_message' => "問い合わせ登録が完了しました。"]);
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
            return view('manager/topics/show', compact('topic'));
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
            return redirect("/manager/topics")
                    ->with(['flash_message' => "問い合わせ削除が完了しました。"]);
        }
        abort(403);
    }
}
