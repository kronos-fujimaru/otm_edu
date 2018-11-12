<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Requests\Admin\MessageRequest;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Admin\AdminAuthController;

use App\User;
use App\Topic;
use App\Message;

use Carbon\Carbon;

use App\Http\Controllers\MessageFileDownloadTrait;

class MessagesController extends AdminAuthController
{

    use MessageFileDownloadTrait;

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     * @return Response
     */
    public function store(MessageRequest $request)
    {
        $user = \Auth::user();
        $topic = Topic::findOrFail($request->topic_id);
        if ($topic->fromCompany->id == $user->company->id
            || $topic->toCompany->id == $user->company->id ) {
            $message = new Message();
            $message->topic_id = $topic->id;
            $message->comment = $request->comment;
            $message->datetime = Carbon::now();
            $message->user_id = $user->id;

            // file
            if ($request->hasFile('file')) {
                $file = $request->file('file');
                $destFileName = $file->getClientOriginalName();
                $filePath = 'messages/' . $user->id . "/" . $message->datetime->format('Ymdhis') .  "/" . $destFileName;
                \Storage::put($filePath, file_get_contents($file->getRealPath()));

                $message->file_name = $destFileName;
                $message->file_path = $filePath;
                $message->file_mime_type = $file->getClientMimeType();
            }

            $message->save();

            if($message->topic->isOwnerTopic($user)){
                $message->topic->sendMailToToCompany($user);
            }else{
                $message->topic->sendMailToFromCompany($user);
            }
            return redirect("/admin/topics/{$message->topic_id}")
                    ->with(['flash_message' => "返信登録が完了しました。"]);
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
        $message = Message::findOrFail($id);
        if ($message->user->company->id == $user->company->id)
        {
            $message->delete();
            return redirect("/admin/topics/{$message->topic_id}")
                    ->with(['flash_message' => "返信削除が完了しました。"]);
        }
        abort(403);
    }
}
