<?php
// app/Http/helper.php

use App\User;
use App\Exam;

function get_exam_link_or_score($participant, $exam)
{
    $examinationScore = $participant->findScoreOrFail($exam);
    if ($examinationScore != null) {
        $score = $examinationScore->score;

        if ($score >= 100) {
            return "<span class=\"label label-success\"><span class=\"glyphicon glyphicon-star\" aria-hidden=\"true\"></span>{$score}点</span>";
        } else if($score >= 80){
            return "<span class=\"label label-success\">{$score}点</span>";
        } else if($score >= 60){
            return "<span class=\"label label-warning\">{$score}点</span>";
        }
        return "<span class=\"label label-danger\">{$score}点</span>";
    }
    return "<a href=\"{$exam->url}\" class=\"btn btn-info btn-xs\" target=\"_blank\">テスト実施</a>";
}


function get_question_link($question)
{
    // 0・・・previous
    // 1・・・open
    // 2・・・close
    if ($question->status == 1) {
        return "<a href=\"{$question->url}\" class=\"btn btn-info btn-xs\" target=\"_blank\" >アンケート入力</a>";
    }
    return "<span class=\"label label-default\">受付終了</span>";
}

function get_time_label($time){
    $from = substr($time->time_from, 0, 5);
    $to = substr($time->time_to, 0, 5);
    return "{$from} -{$to}";
}

function newline_to_break($content){
    return str_replace("\n", "<br>", $content);
}

function get_score($participant, $exam)
{
    $scores = $participant->scores->filter(function($s) use($exam){
        return $s->exam->id == $exam->id;
    });

    if ($scores->count() == 0) {
        return "未登録";
    }

    return "{$scores->first()->point}点";
}


function is_active($selectMenuIndex, $menuIndex)
{
    if ($selectMenuIndex == $menuIndex) {
        return 'class="active"';
    }
    return '';
}
