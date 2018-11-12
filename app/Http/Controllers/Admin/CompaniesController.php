<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Admin\AdminAuthController;

use App\Company;

use App\Http\Requests\Admin\CompanyRequest;

class CompaniesController extends AdminAuthController
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $companies = Company::all();
        return view('admin/companies/index', compact(['companies']));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        $company = new Company();
        return view('admin/companies/create', compact(['company']));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     * @return Response
     */
    public function store(CompanyRequest $request)
    {
        $company = Company::create($request->all());
        return redirect("/admin/companies/{$company->id}/edit")
                ->with(['flash_message' => "受講企業登録が完了しました。"])
                ->withInput();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        $company = Company::find($id);
        return view('admin/companies/edit', compact(['company']));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Request  $request
     * @param  int  $id
     * @return Response
     */
    public function update(CompanyRequest $request, $id)
    {
        $rules = [
            'name' => 'required',
            'url' => 'required'
              ];
        $this->validate($request, $rules);

        $company = Company::findOrFail($id);
        $company->name = $request->input('name');
        $company->url = $request->input('url');

        $company->save();
        return redirect("/admin/companies/$id/edit")
                ->with(['flash_message' => "受講企業登録が完了しました。"])
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
        $company = Company::findOrFail($id);
        $company->delete();
        return redirect("/admin/companies")
                ->with(['flash_message' => "受講企業削除が完了しました。"])
                ->withInput();
    }

    public function apiParticipants(Request $request)
    {
        $companyId = $request->input('company_id');
        $participants = Company::find($companyId)->participants()->toArray();
        return \Response::json($participants);
    }

    public function apiManagers(Request $request)
    {
        $companyId = $request->input('company_id');
        $managers = Company::find($companyId)->managers()->toArray();
        return \Response::json($managers);
    }
}
