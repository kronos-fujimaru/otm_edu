<?php  // resources/lang/ja/validation.php
use App\ExaminationProblem;
use App\ExaminationOption;

  $validations = [

    /*
    |--------------------------------------------------------------------------
    | Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines contain the default error messages used by
    | the validator class. Some of these rules have multiple versions such
    | as the size rules. Feel free to tweak each of these messages here.
    |
    */

    'accepted'             => ':attributeを承認してください。',
    'active_url'           => ':attributeは正しいURLではありません。',
    'after'                => ':attributeは:date以降の日付にしてください。',
    'alpha'                => ':attributeは英字のみにしてください。',
    'alpha_dash'           => ':attributeは英数字とハイフンのみにしてください。',
    'alpha_num'            => ':attributeは英数字のみにしてください。',
    'array'                => ':attributeは配列にしてください。',
    'before'               => ':attributeは:date以前の日付にしてください。',
    'between'              => [
        'numeric' => 'The :attributeは:min〜:maxまでにしてください。',
        'file'    => 'The :attributeは:min〜:max KBまでのファイルにしてください。',
        'string'  => 'The :attributeは:min〜:max文字にしてください。',
        'array'   => 'The :attributeは:min〜:max個までにしてください。',
    ],
    'boolean'              => ':attributeはtrueかfalseにしてください。',
    'confirmed'            => ':attributeは確認用項目と一致していません。',
    'date'                 => ':attributeは正しい日付ではありません。',
    'date_format'          => ':attributeは":format"書式と一致していません。',
    'different'            => ':attributeは:otherと違うものにしてください。',
    'digits'               => ':attributeは:digits桁にしてください',
    'digits_between'       => ':attributeは:min〜:max桁にしてください。',
    'email'                => ':attributeを正しいメールアドレスにしてください。',
    'filled'               => ':attributeは必須です。',
    'exists'               => '選択された:attributeは正しくありません。',
    'image'                => ':attributeは画像ファイルにしてください。',
    'in'                   => '選択された:attributeは正しくありません。',
    'integer'              => ':attributeは整数にしてください。',
    'ip'                   => ':attributeを正しいIPアドレスにしてください。',
    'max'                  => [
        'numeric' => ':attributeは:max以下にしてください。',
        'file'    => ':attributeは:max KB以下のファイルにしてください。.',
        'string'  => ':attributeは:max文字以下にしてください。',
        'array'   => ':attributeは:max個以下にしてください。',
    ],
    'mimes'                => ':attributeは:valuesタイプのファイルにしてください。',
    'min'                  => [
        'numeric' => ':attributeは:min以上にしてください。',
        'file'    => ':attributeは:min KB以上のファイルにしてください。.',
        'string'  => ':attributeは:min文字以上にしてください。',
        'array'   => ':attributeは:min個以上にしてください。',
    ],
    'not_in'               => '選択された:attributeは正しくありません。',
    'numeric'              => ':attributeは数字にしてください。',
    'regex'                => ':attributeの書式が正しくありません。',
    'required'             => ':attributeは必須です。',
    'required_if'          => ':otherが:valueの時、:attributeは必須です。',
    'required_with'        => ':valuesが存在する時、:attributeは必須です。',
    'required_with_all'    => ':valuesが存在する時、:attributeは必須です。',
    'required_without'     => ':valuesが存在しない時、:attributeは必須です。',
    'required_without_all' => ':valuesが存在しない時、:attributeは必須です。',
    'same'                 => ':attributeと:otherは一致していません。',
    'size'                 => [
        'numeric' => ':attributeは:sizeにしてください。',
        'file'    => ':attributeは:size KBにしてください。.',
        'string'  => ':attribute:size文字にしてください。',
        'array'   => ':attributeは:size個にしてください。',
    ],
    'string'               => ':attributeは文字列にしてください。',
    'timezone'             => ':attributeは正しいタイムゾーンをしていしてください。',
    'unique'               => ':attributeは既に存在します。',
    'url'                  => ':attributeを正しい書式にしてください。',

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | Here you may specify custom validation messages for attributes using the
    | convention "attribute.rule" to name the lines. This makes it quick to
    | specify a specific custom language line for a given attribute rule.
    |
    */

    'custom' => [
        'attribute-name' => [
            'rule-name' => 'custom-message',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Attributes
    |--------------------------------------------------------------------------
    |
    | The following language lines are used to swap attribute place-holders
    | with something more reader friendly such as E-Mail Address instead
    | of "email". This simply helps us make messages a little cleaner.
    |
    */

    'attributes' => [
      'condition' => '体調',
      'motivation' => 'モチベーション',
      'date' => '日付',
      'email' => 'メールアドレス',
      'password1' => 'パスワード',
      'password2' => 'パスワード（確認用）',
      'name' => '名前',
      'icon' => '画像',
      'url' => 'URL',
      'company_id' => '企業ID',
      'title' => 'タイトル',
      'place' => '場所',
      'date_from' => '開始日',
      'date_to' => '終了日',
      'status' => 'ステータス',
      'instructor_id' => '講師ID',
      'user_id' => 'ユーザID',
      'training_id' => '研修ID',
      'type' => '種別',
      'comment' => '本文',
      'reason' => '理由',
      'theme' => 'テーマ',
      'content' => '内容',
      'manager_comment' => '人事コメント',
      'admin_comment' => '講師コメント',
      'file' => '成果物',
      'skill_a_comment' => 'コメント（1つ目）',
      'skill_b_comment' => 'コメント（2つ目）',
      'skill_c_comment' => 'コメント（3つ目）',
      'skill_d_comment' => 'コメント（4つ目）',
      'skill_e_comment' => 'コメント（5つ目）',
      'skill_f_comment' => 'コメント（6つ目）'
    ],
];

  $attributes = $validations['attributes'];
  for($a = 1; $a <= ExaminationProblem::SIZE; $a++) {
      $attributes["problem$a"] = "問題$a";
      $attributes["source$a"] = "問題$a" . "のソースコード";
      $attributes["answer$a"] = "問題$a" . "の解答";

      for($b = 1; $b <= ExaminationOption::SIZE; $b++) {
        $attributes["option$a$b"] = "問題$a" . "の解答$b";
      }
  }
  $validations['attributes'] = $attributes;

return $validations;
