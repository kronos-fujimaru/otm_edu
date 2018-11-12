<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Admin\AdminAuthController;

use App\Instructor;

use App\Http\Requests\Admin\InstructorRequest;
use App\Http\Requests\Admin\InstructorForUpdateRequest;

class InstructorsController extends AdminAuthController
{

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $instructors = Instructor::all();
        return view('admin/instructors/index', compact(['instructors']));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        $instructor = new Instructor();
        return view('admin/instructors/create', compact(['instructor']));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     * @return Response
     */
    public function store(InstructorRequest $request)
    {
        $file = $request->file('icon');
        $destFileName = $this->toDestFileName($file->getClientOriginalName());

        $request->file('icon')->move('./icon', $destFileName);
        // // insert or update
        $instructor = Instructor::create([
            'name' => $request->name,
            'icon_url' => '/icon/' . $destFileName,
            'icon_mime_type' => $file->getClientMimeType()
        ]);
        return redirect("/admin/instructors/{$instructor->id}/edit")
                ->with(['flash_message' => "講師登録が完了しました。"])
                ->withInput();
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
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        $instructor = Instructor::find($id);
        return view('admin/instructors/edit', compact(['instructor']));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Request  $request
     * @param  int  $id
     * @return Response
     */
    public function update(InstructorForUpdateRequest $request, $id)
    {

        $instructor = Instructor::findOrFail($id);
        $instructor->name = $request->input('name');
        if ($request->hasFile('icon')) {
            $file = $request->file('icon');
            $destFileName = $this->toDestFileName($file->getClientOriginalName());
            $request->file('icon')->move('./icon', $destFileName);

            $instructor->icon_url = '/icon/' . $destFileName;
            $instructor->icon_mime_type = '/icon/' . $file->getClientMimeType();
        }

        $instructor->save();
        return redirect("/admin/instructors/$id/edit")
                ->with(['flash_message' => "講師登録が完了しました。"])
                ->withInput();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        $instructor = Instructor::findOrFail($id);
        $instructor->delete();
        return redirect("/admin/instructors")
                ->with(['flash_message' => "講師削除が完了しました。"])
                ->withInput();
    }
}
