<?php

namespace App;

trait ApprovalStatusTrait {
    public function adminStatusString()
    {
        if ($this->isAdminYet()) {
            return "<span class=\"label label-warning\">未確認</span>";
        }else if ($this->isAdminApproved()) {
            return  "<span class=\"label label-info\">確認済み</span>";
        }
        return  "<span class=\"label label-danger\">再提出</span>";
    }

    public function managerStatusString()
    {
        if ($this->isManagerYet()) {
            return "<span class=\"label label-warning\">未確認</span>";
        }else if ($this->isManagerApproved()) {
            return  "<span class=\"label label-info\">確認済み</span>";
        }
        return  "<span class=\"label label-danger\">再提出</span>";
    }

    public function isAdminYet()
    {
        return $this->admin_approval_status == self::STATUS_YET;
    }

    public function isAdminApproved()
    {
        return $this->admin_approval_status == self::STATUS_APPROVED;
    }

    public function isAdminReject()
    {
        return $this->admin_approval_status == self::STATUS_REJECT;
    }

    public function isManagerYet()
    {
        return $this->manager_approval_status == self::STATUS_YET;
    }

    public function isManagerApproved()
    {
        return $this->manager_approval_status == self::STATUS_APPROVED;
    }

    public function isManagerReject()
    {
        return $this->manager_approval_status == self::STATUS_REJECT;
    }

}
