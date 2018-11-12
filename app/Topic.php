<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Mail;
use App\User;

class Topic extends Model
{
    use SoftDeletes;

    protected $dates = ["deleted_at"];

    public function training()
    {
        return $this->belongsTo('App\Training');
    }

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function messages()
    {
        return $this->hasMany('App\Message');
    }

    public function lastMessageUpdatedAt()
    {
        if ($this->messages->count() > 0) {
            return $this->messages->sortBy('updated_at')->last()->updated_at;
        }
        return $this->updated_at;
    }

    public function lastMessageUpdatedUserName()
    {
        if ($this->messages->count() > 0) {
            return $this->messages->sortBy('updated_at')->last()->user->name;
        }
        return $this->user->name;
    }

    public function fromCompany()
    {
        return $this->belongsTo('App\Company', 'from_company_id');
    }

    public function toCompany()
    {
        return $this->belongsTo('App\Company', 'to_company_id');
    }


    public function isOwnerTopic(User $user)
    {
        return $this->fromCompany->id == $user->company->id;
    }

    public function sendMailToToCompany($fromUser)
    {
        $this->toCompany->users
        ->filter(function($user){
            return $user->type == User::TYPE_ADMIN || $user->type == User::TYPE_MANAGER;
        })->each(function($toUser) use($fromUser){
            $this->sendMail($fromUser, $toUser);
        });
    }

    public function sendMailToFromCompany($fromUser)
    {
        $this->fromCompany->users
        ->filter(function($user){
            return $user->type == User::TYPE_ADMIN || $user->type == User::TYPE_MANAGER;
        })->each(function($toUser) use($fromUser){
            $this->sendMail($fromUser, $toUser);
        });
    }

    private function sendMail($fromUser, $toUser)
    {
        $topic = $this;
        $scheme = env('WEB_SCHEME', 'https');
        $domain = env('WEB_DOMAIN', '192.168.33.10:8000');
        $path = null;
        if ($toUser->isAdmin()) {
            $path = "admin/topics/{$topic->id}";
        }else{
            $path = "manager/topics/{$topic->id}";
        }
        $url = "$scheme://$domain/$path";

        Mail::send(['text' => 'emails.topic.created'],
         compact(['topic', 'url', 'fromUser', 'toUser']),
         function ($message) use($toUser){
            $message->subject('【オープン研修管理システム】未読メッセージがあります');
            $message->from(env('MAIL_FROM', 'open-learning@kronos-jp.net'));
            $message->to($toUser->email);
        });
    }

}
