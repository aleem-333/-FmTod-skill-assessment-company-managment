<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreEmployeeRequest;
use App\Http\Requests\UpdateEmployeeRequest;
use App\Models\Company;
use App\Models\Employee;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $companies = Company::select('*')->get();
        if(request()->ajax()) {
            $data = Employee::with(['company'])->get();
            return DataTables::of($data)->addIndexColumn()
                ->addColumn('action', function($row){
                    // $btn = '<button data-id="'.$row->id .'" class="btn btn-primary btn-sm viewCompany"><i class="fa fa-eye"></i></button>';
                    $btn = '<button data-id="'.$row->id .'"  data-first_name="'.$row->first_name .'"  data-last_name="'.$row->last_name .'" data-email="'.$row->email .'"  data-phone="'.$row->phone .'" data-company_id="'.$row->company_id .'"  class="btn btn-primary btn-sm editCompany"><i class="fa fa-pencil"></i></button>';
                    $btn .= '<button data-id="'.$row->id .'" class="btn btn-danger btn-sm deleteCompany"><i class="fa fa-trash"></i></button>';
                    return $btn;
                })->addColumn('company', function ($row) {
                    return $row->company->name;
                })
                ->rawColumns(['company', 'action'])
                ->make(true);
        }
        return view('employee.index', compact('companies'));

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
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required|email',
            'phone' => 'nullable',
            'company_id' => 'required',
        ]);
        if($validator->fails()) {
            return redirect()->back()->withErrors($validator->messages());
        }

        try {
            DB::beginTransaction();
            $data = [
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'email' => $request->email,
                'phone' => $request->phone,
                'company_id' => $request->company_id,
            ];
            Employee::create($data);
            DB::commit();
            return redirect()->back()->with(['success' => "Employee Added SuccessFully"]);
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
            $employee = Employee::find($id);
            if (empty($company)) {
                return response()->json(['error' => "No company found"], 422);
            }
            return response()->json(['data' => $employee], 200);
        } catch(Exception $e) {
            return response()->json(['error' => $e->getMessage()], 422);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required|email',
            'phone' => 'nullable',
            'company_id' => 'required',
        ]);
        if($validator->fails()) {
            return redirect()->back()->withErrors($validator->messages());
        }
        
        try {
            $employee = Employee::find($id);
            if (empty($employee)) {
                return redirect()->back()->withErrors(['error' => "employee not found"]);
            }
            $employee->update([
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'email' => $request->email,
                'phone' => $request->phone,
                'company_id' => $request->company_id,
            ]);
            return redirect()->back()->with(['success' => "employee updated SuccessFully"]);
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
            $employee = Employee::find($id);
            if (empty($employee)) {
                return response()->json(['error' => "No employee found"], 422);
            }
            $employee->delete();
            return response()->json(['message' => "employee Deleted Successfully"], 200);
        } catch(Exception $e) {
            return response()->json(['error' => $e->getMessage()], 422);
        }
    }
}
