<?php

namespace App;

trait StatusTrait {
    public function statusString()
    {
        if ($this->status == 0) {
            return "<span class=\"label label-warning\">公開前</span>";
        }else if ($this->status == 1) {
            return  "<span class=\"label label-info\">公開中</span>";
        }
        return  "<span class=\"label label-default\">公開終了</span>";
    }

    public function isBefore()
    {
        return $this->status == self::STATUS_BEFORE;
    }


    public function isOpen()
    {
        return $this->status == self::STATUS_OPEN;
    }

    public function isAfter()
    {
        return $this->status == self::STATUS_AFTER;
    }

}
