<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class DailyReport extends Model implements ApprovalStatus
{
  use SoftDeletes;
  use ApprovalStatusTrait;

  public function dailyWork()
  {
      return $this->hasOne('App\DailyWork');
  }

  public function checkedAdmin()
  {
      return $this->hasOne('App\User', 'id', 'admin_approval_user_id');
  }

  public function checkedManager()
  {
      return $this->hasOne('App\User', 'id', 'manager_approval_user_id');
  }

  public function adminCommentStatusString()
  {
      if($this->admin_comment == null) {
          return "<span> - </span>";
      }
      return  "<span class=\"label label-info\">コメントあり</span>";
  }

  public function managerCommentStatusString()
  {
      if($this->manager_comment == null) {
          return "<span> - </span>";
      }
      return  "<span class=\"label label-info\">コメントあり</span>";
  }

  public function isDuplicated($date, $participant_id)
  {
      return DailyReport::where('participant_id', $participant_id)
                        ->where('id', '!=', $this->id == null ? -1 : $this->id)
                        ->whereDate('date', '=', $date)
                        ->count() > 0;
  }
}
