<?php

namespace App\Http\Controllers\Company;

use App\Events\CompanyCreated;
use App\Http\Controllers\Controller;
use App\Models\Company;
use Illuminate\Http\Request;

class CompanyController extends Controller
{
    public function create(){
        return view('company.create');
    }

    public function store(Request $request){

        $inputs = $request->validate([
            'name'=>'required',
            'email'=>'required',
            'url'=>'url',
//            'logo'=>'dimensions:width=250,height=250',
            'logo'=>'required'
        ]);
        $company = new Company();

        if ($request->file('logo')) {

            $image = $request->file('logo');
            $imageName = $image->getClientOriginalName();
            $imagePath = $image->storeAs('public/uploads', $imageName);
            $inputs['logo'] = 'uploads/'.$imageName;
//            dd($inputs['logo']);
        }
        $company->name = $request['name'];
        $company->email = $request['email'];
        $company->website_url = $request['url'];
        $company->logo = $inputs['logo'];
        $company->save();

        $data =  ['company_name'=>$request['name'],'company_email'=>$request['email']];
        event(new CompanyCreated($data));

        return redirect()->route('company.view');
    }

    public function view(){
        $companies = Company::paginate(10);
        return view('company.view',['companies'=>$companies]);
    }

    public function edit(Company $company){
        return view('company.edit',['company'=>$company]);
    }

    public function update(Request $request, Company $company){
        $inputs = $request->validate([
            'name'=>'required',
            'email'=>'required',
            'url'=>'url',
            'logo'=>'required'
        ]);
        if ($request->file('logo')) {
            $image = $request->file('logo');
            $imageName = $image->getClientOriginalName();
            $imagePath = $image->storeAs('public/uploads', $imageName);
            $inputs['logo'] = 'uploads/'.$imageName;
        }

        $company->name = $request['name'];
        $company->email = $request['email'];
        $company->website_url = $request['url'];
        $company->logo = $inputs['logo'];
        $company->save();
        return redirect()->route('company.view');
    }

    public function destroy(Request $request){
        $com_id = $request['delete_company_id'];
        $company = Company::find($com_id);
        $company->delete();
        return back();
    }
}
