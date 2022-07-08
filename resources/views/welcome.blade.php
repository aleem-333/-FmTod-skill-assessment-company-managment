@extends('layout.app')
@section('breadcrumb')
<nav aria-label="breadcrumb">
    <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
    <li class="breadcrumb-item text-sm"><a class="opacity-5 text-white" href="javascript:;">Pages</a></li>
    <li class="breadcrumb-item text-sm text-white active" aria-current="page">Dashboard</li>
    </ol>
    <h6 class="font-weight-bolder text-white mb-0">Dashboard</h6>
</nav>
@endsection
@section('content')
<div class="container-fluid py-4">
    <div class="row">
    <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
        <div class="card">
        <div class="card-body p-3">
            <div class="row">
            <div class="col-8">
                <div class="numbers">
                <p class="text-sm mb-0 text-uppercase font-weight-bold">Companies</p>
                <h5 class="font-weight-bolder">
                    {{ \App\Models\Company::all()->count();}}
                </h5>
                </div>
            </div>
            <div class="col-4 text-end">
                <div class="icon icon-shape bg-gradient-primary shadow-primary text-center rounded-circle">
                <i class="ni ni-money-coins text-lg opacity-10" aria-hidden="true"></i>
                </div>
            </div>
            </div>
        </div>
        </div>
    </div>
    <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
        <div class="card">
        <div class="card-body p-3">
            <div class="row">
            <div class="col-8">
                <div class="numbers">
                <p class="text-sm mb-0 text-uppercase font-weight-bold">Employees</p>
                <h5 class="font-weight-bolder">
                    {{ \App\Models\Employee::all()->count();}}
                </h5>
                </div>
            </div>
            <div class="col-4 text-end">
                <div class="icon icon-shape bg-gradient-danger shadow-danger text-center rounded-circle">
                <i class="ni ni-world text-lg opacity-10" aria-hidden="true"></i>
                </div>
            </div>
            </div>
        </div>
        </div>
    </div>
    </div>
    
    <div class="row mt-4">
    <div class="col-lg-10 mb-lg-0 mb-4">
        <div class="card ">
        <div class="card-header pb-0 p-3">
            <div class="d-flex justify-content-between">
            <h6 class="mb-2">Companies</h6>
            </div>
        </div>
        <div class="table-responsive">
            <table class="table align-items-center ">
                <thead>
                    <th>name</th>
                    <th>email</th>
                    <th>website</th>
                </thead>
            <tbody>
                @php $companies =  \App\Models\Company::all();@endphp
                @foreach ($companies as $company)
                
                <tr>
                    <td>
                        <div class="">
                        <p class="text-xs font-weight-bold mb-0">{{$company->name}}</p>
                        </div>
                    </td>
                    <td>
                        <div class="">
                        <p class="text-xs font-weight-bold mb-0">{{$company->email}}</p>
                        </div>
                    </td>
                    <td>
                        <div class="">
                        <p class="text-xs font-weight-bold mb-0">{{$company->website}}</p>
                        </div>
                    </td>
                </tr>
                @endforeach
                <tr>
                </tr>
            </tbody>
            </table>
        </div>
        </div>
    </div>
    </div>
    
</div>
@endsection