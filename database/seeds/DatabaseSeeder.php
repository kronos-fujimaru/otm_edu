<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

use Faker\Factory as Faker;
use App\User;
use App\Cycle;
use App\Exam;
use App\Question;
use App\Instructor;
use App\Training;
use App\Company;
use App\Support;
use App\Note;
use App\Participant;
use App\Manager;
use App\Raiting;
use App\Score;
use App\Feedback;
use App\Absence;
use App\Topic;
use App\Videourl;

use App\Examination;
use App\ExaminationTraining;
use App\ExaminationScore;
use App\ExaminationProblem;
use App\ExaminationOption;
use App\ExaminationAnswer;

use App\Report;
use App\Analysis;


class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        $this->call(CompaniesTableSeeder::class);
        $this->call(UsersTableSeeder::class);
        $this->call(CyclesTableSeeder::class);
        $this->call(InstructorsTableSeeder::class);
        $this->call(TrainingsTableSeeder::class);
        $this->call(ExamsTableSeeder::class);
        $this->call(QuestionsTableSeeder::class);
        $this->call(SupportsTableSeeder::class);
        $this->call(NotesTableSeeder::class);
        $this->call(ParticipantsTableSeeder::class);
        $this->call(ManagersTableSeeder::class);
        $this->call(RaitingsTableSeeder::class);
        $this->call(ScoresTableSeeder::class);
        $this->call(FeedbacksTableSeeder::class);
        $this->call(AbsencesTableSeeder::class);
        $this->call(TopicsTableSeeder::class);
        $this->call(VideourlTableSeeder::class);

        $this->call(ExaminationTableSeeder::class);
        $this->call(ExaminationTrainingTableSeeder::class);
        $this->call(ExaminationScoreTableSeeder::class);
        $this->call(ExaminationProblemTableSeeder::class);
        $this->call(ExaminationAnswerTableSeeder::class);
        $this->call(ExaminationOptionTableSeeder::class);

        $this->call(ReportTableSeeder::class);
        $this->call(AnalysisTableSeeder::class);


        Model::reguard();
    }
}


class CompaniesTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('companies')->delete();
        Company::create([
            'id' => 1,
            'name' => "株式会社クロノス",
            'url' => 'http://www.kronos-jp.net',
            'kronos' => 1,
        ]);

        Company::create([
            'id' => 2,
            'name' => "株式会社ムラノス",
            'url' => 'http://yahoo.co.jp',
            'kronos' => 0,
        ]);
        Company::create([
            'id' => 3,
            'name' => "株式会社ヤマノス",
            'url' => 'http://yahoo.co.jp',
            'kronos' => 0,
        ]);
    }
}

class UsersTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('users')->delete();

        User::create([
            'id' => 1,
            'name' => '村山雅彦',
            'email' => 'murayama@kronos-jp.net',
            'type' => User::TYPE_ADMIN,
            'company_id' => 1,
            'password' => bcrypt(env('PASSWORD1')),
            'status' => User::STATUS_NORMAL
        ]);

        User::create([
            'id' => 2,
            'name' => '山野寛',
            'email' => 'yamano@kronos-jp.net',
            'type' => User::TYPE_ADMIN,
            'company_id' => 1,
            'password' => bcrypt(env('PASSWORD1')),
            'status' => User::STATUS_NORMAL
        ]);

        User::create([
            'id' => 3,
            'name' => '田中征二',
            'email' => 'tanaka@kronos-jp.net',
            'type' => User::TYPE_ADMIN,
            'company_id' => 1,
            'password' => bcrypt(env('PASSWORD1')),
            'status' => User::STATUS_NORMAL
        ]);

        User::create([
            'id' => 4,
            'name' => '谷本達也',
            'email' => 'tatsuya_tanimoto@kronos-jp.net',
            'type' => User::TYPE_ADMIN,
            'company_id' => 1,
            'password' => bcrypt(env('PASSWORD1')),
            'status' => User::STATUS_NORMAL
        ]);

        User::create([
            'id' => 5,
            'name' => '大石宏一',
            'email' => 'oishi@kronos-jp.net',
            'type' => User::TYPE_ADMIN,
            'company_id' => 1,
            'password' => bcrypt(env('PASSWORD1')),
            'status' => User::STATUS_NORMAL
        ]);

        User::create([
            'id' => 6,
            'name' => '土居政雄',
            'email' => 'masao_doi@kronos-jp.net',
            'type' => User::TYPE_ADMIN,
            'company_id' => 1,
            'password' => bcrypt(env('PASSWORD1')),
            'status' => User::STATUS_NORMAL
        ]);

        User::create([
            'id' => 7,
            'name' => '土居（参加者）',
            'email' => 'test@kronos-jp.net',
            'type' => User::TYPE_PARTICIPANT,
            'company_id' => 2,
            'password' => bcrypt(env('PASSWORD1')),
            'status' => User::STATUS_NORMAL
        ]);

        User::create([
            'id' => 8,
            'name' => '土居（人事）',
            'email' => 'test2@kronos-jp.net',
            'type' => User::TYPE_MANAGER,
            'company_id' => 2,
            'password' => bcrypt(env('PASSWORD1')),
            'status' => User::STATUS_NORMAL
        ]);

        User::create([
            'id' => 9,
            'name' => 'どい（参加者）',
            'email' => 'test3@kronos-jp.net',
            'type' => User::TYPE_PARTICIPANT,
            'company_id' => 2,
            'password' => bcrypt(env('PASSWORD1')),
            'status' => User::STATUS_NORMAL
        ]);

        User::create([
            'id' => 10,
            'name' => '参加者4',
            'email' => 'test4@kronos-jp.net',
            'type' => User::TYPE_PARTICIPANT,
            'company_id' => 2,
            'password' => bcrypt(env('PASSWORD1')),
            'status' => User::STATUS_NORMAL
        ]);

        User::create([
            'id' => 11,
            'name' => '参加者5',
            'email' => 'test5@kronos-jp.net',
            'type' => User::TYPE_PARTICIPANT,
            'company_id' => 2,
            'password' => bcrypt(env('PASSWORD1')),
            'status' => User::STATUS_NORMAL
        ]);


/*
        User::create([
            'id' => 6,
            'name' => '村山受講者１',
            'email' => 'murayama+p1@kronos-jp.net',
            'type' => User::TYPE_PARTICIPANT,
            'company_id' => 2,
            'password' => bcrypt(env('PASSWORD1'))
        ]);

        User::create([
            'id' => 7,
            'name' => '村山受講者２',
            'email' => 'murayama+p2@kronos-jp.net',
            'type' => User::TYPE_PARTICIPANT,
            'company_id' => 2,
            'password' => bcrypt(env('PASSWORD1'))
        ]);

        User::create([
            'id' => 8,
            'name' => '村山担当者１',
            'email' => 'murayama+m1@kronos-jp.net',
            'type' => User::TYPE_MANAGER,
            'company_id' => 2,
            'password' => bcrypt(env('PASSWORD1'))
        ]);

        User::create([
            'id' => 9,
            'name' => '山野受講者１',
            'email' => 'yamano+p1@kronos-jp.net',
            'type' => User::TYPE_PARTICIPANT,
            'company_id' => 3,
            'password' => bcrypt(env('PASSWORD1'))
        ]);

        User::create([
            'id' => 10,
            'name' => '山野受講者２',
            'email' => 'yamano+p2@kronos-jp.net',
            'type' => User::TYPE_PARTICIPANT,
            'company_id' => 3,
            'password' => bcrypt(env('PASSWORD1'))
        ]);

        User::create([
            'id' => 11,
            'name' => '山野担当者１',
            'email' => 'yamano+m1@kronos-jp.net',
            'type' => User::TYPE_MANAGER,
            'company_id' => 3,
            'password' => bcrypt(env('PASSWORD1'))
        ]);
*/
    }
}


class InstructorsTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('instructors')->delete();

        Instructor::create([
            'id' => 1,
            'name' => '村山雅彦',
            'icon_url' => 'https://mug0.assets-yammer.com/mugshot/images/75x75/pgspgMGNgHNZXj1-nvjTfJwzlXVDJZWc',
            'icon_mime_type' => 'img/png'
        ]);

        Instructor::create([
            'id' => 2,
            'name' => '大石宏一',
            'icon_url' => 'https://mug0.assets-yammer.com/mugshot/images/75x75/lL9k9K1ggR6hKd5H2dkThpFP54WtQ854',
            'icon_mime_type' => 'img/png'
        ]);

        // $faker = Faker::create('en_US');
        //
        // for ($i = 0; $i < 10; $i++) {
        //     User::create([
        //         'id' => $i + 1,
        //         'name' => $faker->name,
        //         'email' => $faker->email,
        //         'password' => $faker->password
        //     ]);
        // }
    }
}

class TrainingsTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('trainings')->delete();

        Training::create([
            'id' => 1,
            'title' => 'Javaプログラミング研修',
            'place' => 'クロノス大阪事務所',
            'date_from' => '2015-10-02',
            'date_to' => '2015-11-30',
            'status' => 1,
            'instructor_id' => 1,
            'videourl_id' => 1,
        ]);

        Training::create([
            'id' => 2,
            'title' => 'Javaプログラミング研修（東京）',
            'place' => '東京都中央区xxx',
            'date_from' => '2015-04-01',
            'date_to' => '2015-06-30',
            'status' => 1,
            'instructor_id' => 2,
            'videourl_id' => 2,
        ]);

    }
}


class ExamsTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('exams')->delete();

/*
        Exam::create([
            'id' => $i,
            'title' => "IT基礎",
            'url' => 'http://www.kronos-jp.net',
            'date' => "2015-10-06",
            'status' => 0,
            'training_id' => 1
        ]);
*/
    }
}

class QuestionsTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('questions')->delete();
        DB::table('question_user')->delete();

        // for ($i = 1; $i <= 3; $i++) {
        //     Question::create([
        //         'id' => $i,
        //         'title' => "研修事後アンケート{$i}",
        //         'url' => 'http://www.kronos-jp.net',
        //         'date' => "2015-08-{$i}0",
        //         'status' => 0,
        //         'training_id' => 1
        //     ]);
        //     User::find(1)->questions()->attach($i);
        // }
    }
}

class SupportsTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('supports')->delete();

        Support::create([
            'id' => 1,
            'title' => "キャリアアップ助成金のサポートページ",
            'url' => 'http://www.mhlw.go.jp/stf/seisakunitsuite/bunya/koyou_roudou/part_haken/jigyounushi/career.html',
            'status' => 1,
            'type' => 1,
            'training_id' => 1
        ]);

        Support::create([
            'id' => 2,
            'title' => "キャリア形成促進助成金",
            'url' => 'http://www.mhlw.go.jp/stf/seisakunitsuite/bunya/koyou_roudou/koyou/kyufukin/d01-1.html',
            'status' => 1,
            'type' => 1,
            'training_id' => 1
        ]);

        Support::create([
            'id' => 3,
            'title' => "2015年10月_11月教育訓練カリキュラム詳細.zip",
            'url' => env('WEB_SCHEME', 'https') . '://'. env('WEB_DOMAIN', 'opt-edu.kronos-jp.net') . '/2015%E5%B9%B410%E6%9C%88_11%E6%9C%88%E6%95%99%E8%82%B2%E8%A8%93%E7%B7%B4%E3%82%AB%E3%83%AA%E3%82%AD%E3%83%A5%E3%83%A9%E3%83%A0%E8%A9%B3%E7%B4%B0.zip',
            'status' => 1,
            'type' => 0,
            'training_id' => 1
        ]);


    }
}

class NotesTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('notes')->delete();

//         Note::create([
//             'id' => 1,
//             'date' => '2015-04-01',
//             'time_from' => '09:00',
//             'time_to' => '18:00',
//             'hours' => 8.0,
//             'content' => 'プログラミングを学ぶにあたって知っておくべきITの基礎知識を学習
// ・2進数、8進数、16進数
// ・C/S型システム
// ・Webシステムの構成
// ・サーバの種類と役割',
//             'training_id' => 1
//         ]);
    }
}

class ParticipantsTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('participants')->delete();

        Participant::create([
            'id' => 1,
            'user_id' => 7,
            'training_id' => 1,
            'date_from' => '2015-10-02',
            'date_to' => '2015-11-30'
        ]);

        Participant::create([
            'id' => 2,
            'user_id' => 9,
            'training_id' => 2,
            'date_from' => '2015-10-02',
            'date_to' => '2015-11-30'
        ]);

        Participant::create([
            'id' => 3,
            'user_id' => 10,
            'training_id' => 1,
            'date_from' => '2015-10-02',
            'date_to' => '2015-11-30'
        ]);

        Participant::create([
            'id' => 4,
            'user_id' => 11,
            'training_id' => 1,
            'date_from' => '2015-10-02',
            'date_to' => '2015-11-30'
        ]);
    }
}

class ManagersTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('managers')->delete();

        Manager::create([
            'id' => 1,
            'user_id' => 8,
            'training_id' => 1,
        ]);
        Manager::create([
            'id' => 2,
            'user_id' => 8,
            'training_id' => 2,
        ]);
    }
}



class RaitingsTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('raitings')->delete();
        // Raiting::create([
        //     'id' => 1,
        //     'participant_id' => 1,
        //     'skill_a' => 4,
        //     'skill_b' => 3,
        //     'skill_c' => 2,
        //     'skill_d' => 4,
        //     'skill_e' => 3,
        //     'skill_f' => 1
        // ]);
    }
}

class ScoresTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('scores')->delete();
        // Score::create([
        //     'id' => 1,
        //     'participant_id' => 1,
        //     'exam_id' => 1,
        //     'point' => 80
        // ]);
    }
}


class FeedbacksTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('feedbacks')->delete();
        // Feedback::create([
        //     'id' => 1,
        //     'participant_id' => 1,
        //     'date' => '2015-06-30',
        //     'title' => 'Javaプログラミング - テクニカルスキル',
        //     'comment' => 'プログラミングほぼ未経験とのことでしたが、この1ヶ月でJavaプログラミングの基礎（if、for、配列など）は十分習得できています。一方で、理解度テストの結果からも見てとれるように、JDBC、JSP/Servletなど、高度なトピックになると理解の足りていない部分があります。研修の後半は覚えることが多くて苦労していたようですので、テキストを読んで覚えようとせずに、実際にプログラミングしながら繰り返し反復するトレーニングが必要です。'
        // ]);
    }
}

class AbsencesTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('absences')->delete();
        // Absence::create([
        //     'id' => 1,
        //     'participant_id' => 1,
        //     'type' => 1,
        //     'date' => '2015-06-30',
        //     'time' => 8,
        //     'reason' => '会社都合のため'
        // ]);
    }
}

class TopicsTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('topics')->delete();
//         Topic::create([
//             'id' => 1,
//             'to_company_id' => 1,
//             'from_company_id' => 2,
//             'user_id' => 6,
//             'datetime' => '2015-06-30 09:00:00',
//             'title' => '助成金の申請について',
//             'comment' => '株式会社xxx　xxさま
// いつも大変お世話になっております。
// XYZのxxです。
//
// こちらこそ、昨日まで長きにわたりご指導いただきありがとうございました。
// 来週お越しいただけるとのこと、日程目処立ちましたらご案内いただけますと幸いです。
// なお、恐縮ではございますが、8日（水）以降でご予定いただけますでしょうか。
//
// また、助成金申請書類送付いただきありがとうございました。
// 参考にさせていただきます。
//
// 引き続きよろしくお願い申し上げます。'
//         ]);
    }
}


class CyclesTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('cycles')->delete();

        // $faker = Faker::create('en_US');
        //
        // for ($i = 1; $i <= 10; $i++) {
        //     for ($j = 1; $j <= 10; $j++) {
        //         Cycle::create([
        //             'user_id' => $i,
        //             'date' => (new Carbon\Carbon())->addDay($j),
        //             'motivation' => $j % 4,
        //             'condition' => $j % 4
        //         ]);
        //     }
        // }
    }

}

class VideourlTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('videourls')->delete();
        Videourl::create([
            'id' => 1,
            'url' => 'http://www.ustream.tv/embed/22996560?html5ui&volume=0',
            'url_password' => 'k9ZmTEWH2u',
            'url_user_id' => 'learning+osk01',
        ]);

        Videourl::create([
            'id' => 2,
            'url' => 'http://www.ustream.tv/embed/22996682?html5ui&volume=0',
            'url_password' => 'k9ZmTEWH2u',
            'url_user_id' => 'learning+osk02',
        ]);

        Videourl::create([
            'id' => 3,
            'url' => 'http://www.ustream.tv/embed/22996693?html5ui&volume=0',
            'url_password' => 'k9ZmTEWH2u',
            'url_user_id' => 'learning+tky01',
        ]);

        Videourl::create([
            'id' => 4,
            'url' => 'http://www.ustream.tv/embed/22996704?html5ui&volume=0',
            'url_password' => 'k9ZmTEWH2u',
            'url_user_id' => 'learning+tky02',
        ]);
    }
}

class ExaminationTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('examinations')->delete();
        Examination::create([
            'id' => 1,
            'title' => 'Javaプログラミング 基本',
            'date' => '2018-04-06'
        ]);

        Examination::create([
            'id' => 2,
            'title' => 'Javaプログラミング 応用',
            'date' => '2018-04-07'
        ]);

        Examination::create([
            'id' => 3,
            'title' => 'JSP・Servlet',
            'date' => '2018-04-08'
        ]);
    }
}

class ExaminationTrainingTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('examination_trainings')->delete();
        ExaminationTraining::create([
            'id' => 1,
            'training_id' => 1,
            'examination_id' => 1,
            'date' => '2018-04-06',
            'status' => 1,
        ]);

        ExaminationTraining::create([
            'id' => 2,
            'training_id' => 1,
            'examination_id' => 2,
            'date' => '2018-04-07',
            'status' => 1,
        ]);

        ExaminationTraining::create([
            'id' => 3,
            'training_id' => 1,
            'examination_id' => 3,
            'date' => '2018-05-06',
            'status' => 1,
        ]);
    }
}

class ExaminationScoreTableSeeder extends Seeder
{
    public function run()
    {
        // DB::table('examination_scores')->delete();
        // ExaminationScore::create([
        //     'id' => 1,
        //     'examination_training_id' => 1,
        //     'participant_id' => 1,
        //     'score' => 70
        // ]);
        //
        // ExaminationScore::create([
        //     'id' => 2,
        //     'examination_training_id' => 2,
        //     'participant_id' => 1,
        //     'score' => 60
        // ]);

    }
}

class ExaminationProblemTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('examination_problems')->delete();
        ExaminationProblem::create([
            'id' => 1,
            'examination_id' => 1,
            'problem' => '1. Java言語の説明として不適切なものを選択肢から選べ。',
            'answer' => '2'
        ]);

        ExaminationProblem::create([
            'id' => 2,
            'examination_id' => 1,
            'problem' => '2. Javaのエディションの説明として適切なものを選択肢から選べ。',
            'answer' => '1'
        ]);

        ExaminationProblem::create([
            'id' => 3,
            'examination_id' => 2,
            'problem' => '1. Javaのエディションの説明として適切なものを選択肢から選べ。',
            'answer' => '3'
        ]);

        ExaminationProblem::create([
            'id' => 4,
            'examination_id' => 3,
            'problem' => '1. Javaのエディションの説明として適切なものを選択肢から選べ。',
            'answer' => '3'
        ]);

        ExaminationProblem::create([
            'id' => 5,
            'examination_id' => 1,
            'problem' => '3. テスト問題次の選択肢から正しいものを選べ',
            'answer' => '4'
        ]);

    }
}

class ExaminationOptionTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('examination_options')->delete();
        ExaminationOption::create([
            'id' => 1,
            'examination_problem_id' => 1,
            'examination_option' => 'オブジェクト指向プログラミング言語である',
            'order' => 1
        ]);

        ExaminationOption::create([
            'id' => 2,
            'examination_problem_id' => 1,
            'examination_option' => 'ブラウザ上で実行するスクリプト言語である',
            'order' => 2
        ]);

        ExaminationOption::create([
            'id' => 3,
            'examination_problem_id' => 2,
            'examination_option' => 'Java EEは企業向けのアプリケーションを開発するためのものである',
            'order' => 1
        ]);

        ExaminationOption::create([
            'id' => 4,
            'examination_problem_id' => 4,
            'examination_option' => 'Java EEは企業向けのアプリケーションを開発するためのものである',
            'order' => 1
        ]);

        ExaminationOption::create([
            'id' => 5,
            'examination_problem_id' => 1,
            'examination_option' => '選択肢３',
            'order' => 3
        ]);

        ExaminationOption::create([
            'id' => 6,
            'examination_problem_id' => 1,
            'examination_option' => '選択肢４',
            'order' => 4
        ]);

        ExaminationOption::create([
            'id' => 7,
            'examination_problem_id' => 2,
            'examination_option' => '選択肢2',
            'order' => 2
        ]);

        ExaminationOption::create([
            'id' => 8,
            'examination_problem_id' => 2,
            'examination_option' => '選択肢3',
            'order' => 3
        ]);

        ExaminationOption::create([
            'id' => 9,
            'examination_problem_id' => 2,
            'examination_option' => '選択肢4',
            'order' => 4
        ]);

        ExaminationOption::create([
            'id' => 10,
            'examination_problem_id' => 5,
            'examination_option' => '選択肢1',
            'order' => 1
        ]);

        ExaminationOption::create([
            'id' => 11,
            'examination_problem_id' => 5,
            'examination_option' => '選択肢2',
            'order' => 2
        ]);

        ExaminationOption::create([
            'id' => 12,
            'examination_problem_id' => 5,
            'examination_option' => '選択肢3',
            'order' => 3
        ]);

        ExaminationOption::create([
            'id' => 13,
            'examination_problem_id' => 5,
            'examination_option' => '選択肢4',
            'order' => 4
        ]);

    }
}

class ExaminationAnswerTableSeeder extends Seeder
{
    public function run()
    {
        // DB::table('examination_answers')->delete();
        // ExaminationAnswer::create([
        //     'id' => 1,
        //     'examination_score_id' => 1,
        //     'examination_problem_id' => 1,
        //     'answer' => '1',
        // ]);
        //
        // ExaminationAnswer::create([
        //     'id' => 2,
        //     'examination_score_id' => 1,
        //     'examination_problem_id' => 2,
        //     'answer' => '1',
        // ]);
        //
        // ExaminationAnswer::create([
        //     'id' => 3,
        //     'examination_score_id' => 2,
        //     'examination_problem_id' => 3,
        //     'answer' => '1',
        // ]);
    }
}


class ReportTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('reports')->delete();
        Report::create([
            'id' => 1,
            'participant_id' => '1',
            'analysis_id' => '1',
            'content' => '振り返りの内容を入力してもらいます。',
            'date' => '2018-05-30',
        ]);

        Report::create([
            'id' => 2,
            'participant_id' => '1',
            'analysis_id' => '1',
            'content' => '同じテーマで複数回答可能',
            'date' => '2018-04-30',
        ]);

        Report::create([
            'id' => 3,
            'participant_id' => '1',
            'analysis_id' => '2',
            'content' => '違うテーマの回答',
            'date' => '2018-04-30',
        ]);

    }
}

class AnalysisTableSeeder extends Seeder
{
    public function run()
    {
      DB::table('analyses')->delete();
      Analysis::create([
          'id' => 1,
          'theme' => 'エンジニアの仕事',
          'date' => '2018-04-06',
          'status' => 1,
      ]);

      Analysis::create([
          'id' => 2,
          'theme' => 'テーマ2',
          'date' => '2018-04-07',
          'status' => 1,
      ]);

      Analysis::create([
          'id' => 3,
          'theme' => 'テーマ3',
          'date' => '2018-04-08',
          'status' => 0,
      ]);
    }
}
