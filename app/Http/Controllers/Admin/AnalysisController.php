<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Analysis;
use Carbon\Carbon;

class AnalysisController extends AdminAuthController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $analyses = Analysis::all();
        return view('admin/analysis/index', compact(['analyses']));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $analysis = new Analysis;
        $analysis->date = Carbon::now()->toDateString();
        $analysis->status = Analysis::STATUS_BEFORE;
        return view('admin/analysis/create', compact(['analysis']));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules = [
            'theme' => 'required',
            'date' => 'required',
            'status' => 'required|integer|in:0,1,2',
        ];
        $this->validate($request, $rules);
        $analysis = Analysis::create($request->all());
        return redirect("/admin/analysis")
                ->with(['flash_message' => "テーマの登録が完了しました。"]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $analysis = Analysis::findOrFail($id);
        return view('admin/analysis/edit', compact(['analysis']));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $analysis = Analysis::find($id);
        $rules = [
            'theme' => 'required',
            'date' => 'required',
            'status' => 'required|integer|in:0,1,2',
        ];
        $this->validate($request, $rules);
        $analysis->update($request->all());
        return redirect("/admin/analysis")
                ->with(['flash_message' => "テーマの登録が完了しました。"]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $analysis = Analysis::find($id);
        $analysis->delete();
        return redirect("/admin/analysis")
                ->with(['flash_message' => "テーマの削除が完了しました。"]);
    }
}
