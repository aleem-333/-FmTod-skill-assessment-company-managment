<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCompanyRequest;
use App\Http\Requests\UpdateCompanyRequest;
use App\Models\Company;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;

class CompanyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $companies = Company::paginate(10);
        if(request()->ajax()) {
            $data = Company::select('*')->get();
            return Datatables::of($data)->addIndexColumn()
                ->addColumn('action', function($row){
                    // $btn = '<button data-id="'.$row->id .'" class="btn btn-primary btn-sm viewCompany"><i class="fa fa-eye"></i></button>';
                    $btn = '<button data-id="'.$row->id .'"  data-name="'.$row->name .'"  data-email="'.$row->email .'"  data-website="'.$row->website .'" class="btn btn-primary btn-sm editCompany"><i class="fa fa-pencil"></i></button>';
                    $btn .= '<button data-id="'.$row->id .'" class="btn btn-danger btn-sm deleteCompany"><i class="fa fa-trash"></i></button>';
                    return $btn;
                })->addColumn('logo', function ($row) {
                    $url= Storage::disk('local')->url($row->logo);

                    return '<img src="'.$url.'" border="0" width="40" class="img-rounded" align="center" />';
                })
                ->rawColumns(['logo', 'action'])
                ->make(true);
        }
        return view('company.index');

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email',
            'website' => 'nullable',
        ]);
        if($validator->fails()) {
            return redirect()->back()->withErrors($validator->messages());
        }

        try {
            DB::beginTransaction();
            $path = $request->logo->store('logos', ['disk' => 'local']);
            $data = [
                'name' => $request->name,
                'email' => $request->email,
                'website' => $request->website,
                'logo' => $path,
            ];
            Company::create($data);
            DB::commit();
            return redirect()->back()->with(['success' => "Company Added SuccessFully"]);
        } catch (\Exception $th) {
            dd($th->getMessage());
            DB::rollBack();
            return redirect()->back()->withErrors($th->getMessage());
        }
       
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function show(Company $company)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        try {
            $company = Company::find($id);
            if (empty($company)) {
                return response()->json(['error' => "No company found"], 422);
            }
            return response()->json(['data' => $company], 200);
        } catch(Exception $e) {
            return response()->json(['error' => $e->getMessage()], 422);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateCompanyRequest  $request
     * @param  \App\Models\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email',
            'website' => 'nullable',
        ]);
        if($validator->fails()) {
            return redirect()->back()->withErrors($validator->messages());
        }
        
        try {
            $company = Company::find($id);
            if (empty($company)) {
                return redirect()->back()->withErrors(['error' => "Company not found"]);
            }
            $company->update([
                'name' => $request->name,
                'email' => $request->email,
                'website' => $request->website,
            ]);
            return redirect()->back()->with(['success' => "Company updated SuccessFully"]);
        } catch(Exception $e) {
            return response()->json(['error' => $e->getMessage()], 422);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $company = Company::find($id);
            if (empty($company)) {
                return response()->json(['error' => "No company found"], 422);
            }
            $company->delete();
            return response()->json(['message' => "Deleted Successfully"], 200);
        } catch(Exception $e) {
            return response()->json(['error' => $e->getMessage()], 422);
        }
    }
}
