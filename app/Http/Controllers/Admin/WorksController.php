<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Admin\AdminAuthController;

use App\Work;
use Carbon\Carbon;


class WorksController extends AdminAuthController
{

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create(Request $request)
    {
        $work = new Work();
        $work->date = Carbon::now()->toDateString();
        $work->participant_id = $request->participant_id;
        return view('admin/works/create', compact(['work']));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     * @return Response
     */
    public function store(Request $request)
    {
        $rules = [
            'participant_id' => 'required',
            'date' => 'required',
            'file' => 'required'
        ];
        $this->validate($request, $rules);

        $file = $request->file('file');
        $destFileName = $this->toDestFileName($file->getClientOriginalName());
        $request->file('file')->move('./file', $destFileName);
        $work = Work::create([
            'date' => $request->date,
            'participant_id' => $request->participant_id,
            'file_name' => $destFileName,
            'file_url' => '/file/' . $destFileName,
            'file_mime_type' => $file->getClientMimeType()
        ]);

        return redirect("/admin/process/participants/{$work->participant_id}")
                ->with(['flash_message' => "成果物登録が完了しました。"]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        $work = Work::findOrFail($id);
        $work->date = str_replace('/', '-', $work->date);
        return view('admin/works/edit', compact(['work']));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Request  $request
     * @param  int  $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        $rules = [
            'participant_id' => 'required',
            'date' => 'required',
            'file' => 'required'
        ];
        $this->validate($request, $rules);
        $work = Work::findOrFail($id);

        $work->date = $request->date;
        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $destFileName = $this->toDestFileName($file->getClientOriginalName());
            $request->file('file')->move('./file', $destFileName);

            $work->file_name = $destFileName;
            $work->file_url = '/file/' . $destFileName;
            $work->file_mime_type = '/file/' . $file->getClientMimeType();
        }

        $work->save();
        return redirect("/admin/process/participants/{$work->participant_id}")
                ->with(['flash_message' => "成果物登録が完了しました。"]);
    }

    private function toDestFileName($fileName)
    {
        $dateStr = \Carbon\Carbon::now()->format('Ymdhis');
        $fileNameParts = explode('.', $fileName);
        if (count($fileNameParts) == 1) {
            return $fileName . "_" . $dateStr;
        }
        $fileNameParts[0] = $fileNameParts[0] . "_" . $dateStr;
        return implode($fileNameParts, '.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        $work = Work::findOrFail($id);
        $work->delete();
        return redirect("/admin/process/participants/{$work->participant_id}")
                ->with(['flash_message' => "成果物削除が完了しました。"]);
    }
}
