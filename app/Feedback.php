<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use Mail;

class Feedback extends Model
{
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['participant_id', 'title', 'date', 'comment'];

    public function participant()
    {
        return $this->belongsTo('App\Participant');
    }

    public function sendMailToManager()
    {
        $this->participant->user->company->managers()->each(function($manager){
            $feedback = $this;
            $scheme = env('WEB_SCHEME', 'https');
            $domain = env('WEB_DOMAIN', '192.168.33.10:8000');
            $path = "manager/participant/{$feedback->participant->id}";
            $url = "$scheme://$domain/$path";

            Mail::send(['text' => 'emails.feedback.created'],
             compact(['feedback', 'url']),
             function ($message) use($manager){
                $message->subject('【オープン研修管理システム】フィードバックコメントが登録されました');
                $message->from(env('MAIL_FROM', 'open-learning@kronos-jp.net'));
                $message->to($manager->email);
            });
        });
    }

}
