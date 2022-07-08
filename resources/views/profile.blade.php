@extends('layout.app')
@section('content')
<div class="container-fluid p-4">
    <div class="row">
        <div class="card">
            <div class="card-header pb-0">
              <div class="d-flex align-items-center">
                <p class="mb-0">Edit Profile</p>
              </div>
            </div>
            <div class="card-body">
              <p class="text-uppercase text-sm">User Information</p>
              <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="example-text-input" class="form-control-label">Name</label>
                    <input class="form-control" type="text" value="{{ $user->name}}" onfocus="focused(this)" onfocusout="defocused(this)">
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="example-text-input" class="form-control-label">Email address</label>
                    <input class="form-control" type="email" value="{{ $user->email }}" onfocus="focused(this)" onfocusout="defocused(this)">
                  </div>
                </div>
              </div>
            </div>
          </div>
        
    </div>
</div>
@endsection()