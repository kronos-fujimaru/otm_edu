<?php

namespace App\Http\Controllers\Admin;

use Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Examination;
use App\ExaminationProblem;
use App\ExaminationOption;
use Carbon\Carbon;
use App\Http\Requests\Admin\ExaminationRequest;
use Illuminate\Support\Facades\DB;

class ExaminationsController extends AdminAuthController
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $examinations = Examination::all();
        return view('admin/examinations/index', compact(['examinations']));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        $examination = new Examination();

        for($a = 1; $a <= ExaminationProblem::SIZE; $a++) {
            $problem = new ExaminationProblem();
            $problem->no = $a;
            $problem->answer = 1;

            for($b = 1; $b <= ExaminationOption::SIZE; $b++) {
                $option = new ExaminationOption();
                $option->order = $b;
                $problem->examinationOptions[] = $option;
            }
            $examination->examinationProblems[] = $problem;
        }

        return view('admin/examinations/create', compact(['examination']));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     * @return Response
     */
    public function store(ExaminationRequest $request)
    {
        DB::beginTransaction();

        try{
            $examination = new Examination();
            $examination->title = $request->title;
            $examination->date = Carbon::now()->toDateString();
            $examination->save();

            for($a = 1; $a <= ExaminationProblem::SIZE; $a++) {
                $problem = new ExaminationProblem();
                $problem->examination_id = $examination->id;
                $problem->no = $a;
                $problem->problem = Request::input("problem$a");
                $problem->source = Request::input("source$a");
                $problem->answer = Request::input("answer$a");
                $problem->save();

                for($b = 1; $b <= ExaminationOption::SIZE; $b++) {
                    $option = new ExaminationOption();
                    $option->examination_problem_id = $problem->id;
                    $option->examination_option = Request::input("option$a$b");
                    $option->order = $b;
                    $option->save();
                }
            }
            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            throw $e;
        }
        return redirect("/admin/examinations/")
                ->with(['flash_message' => "理解度テストの登録が完了しました。"]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        $examination = Examination::findOrFail($id);
        return view('admin/examinations/edit', compact(['examination']));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Request  $request
     * @param  int  $id
     * @return Response
     */
    public function update(ExaminationRequest $request, $id)
    {
        DB::beginTransaction();

        try{
            $examination = Examination::find($id);
            $examination->title = $request->title;
            $examination->date = Carbon::now()->toDateString();
            $examination->save();

            foreach($examination->examinationProblems as $problem) {
                $problem->problem = Request::input("problem$problem->no");
                $problem->source = Request::input("source$problem->no");
                $problem->answer = Request::input("answer$problem->no");
                $problem->save();

                foreach($problem->examinationOptions as $option) {
                    $option->examination_option = Request::input("option$problem->no$option->order");
                    $option->save();
                }
            }
            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            throw $e;
        }

       return redirect("/admin/examinations/")
              ->with(['flash_message' => "理解度テストの更新が完了しました。"]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        DB::beginTransaction();

        try{
            $examination = Examination::find($id);
            foreach($examination->examinationProblems as $problem) {
                foreach($problem->examinationOptions as $option) {
                  $option->delete();
                }
                $problem->delete();
            }
            $examination->delete();
            DB::commit();
          } catch (\Exception $e) {
              DB::rollback();
              throw $e;
          }
          return redirect("/admin/examinations/")
                  ->with(['flash_message' => "理解度テストを削除しました。"]);
    }
}
