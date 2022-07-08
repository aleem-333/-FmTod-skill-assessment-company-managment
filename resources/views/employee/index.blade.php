@extends('layout.app')
@section('breadcrumb')
<nav aria-label="breadcrumb">
    <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
    <li class="breadcrumb-item text-sm"><a class="opacity-5 text-white" href="javascript:;">Dashboard</a></li>
    <li class="breadcrumb-item text-sm text-white active" aria-current="page">Employee</li>
    </ol>
</nav>
@endsection
@section('content')
<div class="container-fluid py-4">
    <div class="row">
      <div class="col-12">
        <div class="card mb-4">
          <div class="card-header pb-0">
            <h6>Employee</h6>
            <button type="button" class="btn bg-gradient-primary" id="add_company" style="float: right;" data-bs-toggle="modal" data-bs-target="#exampleModal">
                Add Employee
              </button>
          </div>
          <div class="card-body p-4">
            <div class="table-responsive p-0">
              <table class="table align-items-center mb-0 company_datatable ">
                <thead>
                  <tr>
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">First Name</th>
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Last Name</th>
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">email</th>
                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">company</th>
                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">phone</th>
                    <th class="text-secondary opacity-7">Actions</th>
                  </tr>
                </thead>
                <tbody>
                  
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- Button trigger modal -->
  <!-- Modal -->
  <div class="modal fade" id="company_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Add Employee</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form method="post" id="add_company_form" action="{{ route('employees.store')}}" enctype="multipart/form-data">
            <div class="modal-body">
                @csrf
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>First Name</label>
                            <input type="text" name="first_name" placeholder="First Name" class="form-control" />
                        </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                          <label>Last Name</label>
                          <input type="text" name="last_name" placeholder="Last Name" class="form-control" />
                      </div>
                  </div>
                    
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Phone</label>
                            <input class="form-control" name="phone" type="text">
                        </div>
                    </div>
                </div>
                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group">
                        <label>Email</label>
                        <input type="email" name="email" class="form-control" id="exampleFormControlInput1" placeholder="name@example.com">
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                        <label>Company</label>
                        <select class="form-control" name="company_id">
                          @foreach ($companies as $company)
                            <option value="{{ $company->id}}"> {{ $company->name}}</option>
                          @endforeach
                        </select>
                    </div>
                  </div>
                </div>
            </div>
            <div class="modal-footer">
            <button type="button" class="btn bg-gradient-secondary" data-bs-dismiss="modal">Close</button>
            <button type="submit" class="btn bg-gradient-primary">Save changes</button>
            </div>
        </form>
      </div>
    </div>
  </div>

  <div class="modal fade" id="edit_company_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Employee</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form method="post" id="edit_company_form" action="" enctype="multipart/form-data">
            <div class="modal-body">
                {{ method_field('PUT') }}

                @csrf
                <div class="row">
                  <div class="col-md-6">
                      <div class="form-group">
                          <label>First Name</label>
                          <input type="text" id="first_name" name="first_name" placeholder="First Name" class="form-control" />
                      </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                        <label>Last Name</label>
                        <input type="text" id="last_name" name="last_name" placeholder="Last Name" class="form-control" />
                    </div>
                </div>
                  
              </div>
              <div class="row">
                  <div class="col-md-6">
                      <div class="form-group">
                          <label>Phone</label>
                          <input class="form-control" id="phone"  name="phone" type="text">
                      </div>
                  </div>
              </div>
              <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
                      <label>Email</label>
                      <input type="email" id="email" name="email" class="form-control" id="exampleFormControlInput1" placeholder="name@example.com">
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                      <label>Company</label>
                      <select class="form-control" name="company_id" id="company_id">
                        @foreach ($companies as $company)
                          <option value="{{ $company->id}}"> {{ $company->name}}</option>
                        @endforeach
                      </select>
                  </div>
                </div>
              </div>
            </div>
            <div class="modal-footer">
            <button type="button" class="btn bg-gradient-secondary" data-bs-dismiss="modal">Close</button>
            <button type="submit" class="btn bg-gradient-primary">Save changes</button>
            </div>
        </form>
      </div>
    </div>
  </div>

  <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js" integrity="sha512-AA1Bzp5Q0K1KanKKmvN/4d3IRKVlv9PYgwFPvm32nPO6QS8yH1HO7LbgB1pgiOxPtfeg5zEn2ba64MUcqJx6CA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
  <script type="text/javascript">
  
    $(function () {
        var table = $('.company_datatable').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('employees.index') }}",
            columns: [
                {data: 'first_name', name: 'first_name'},
                {data: 'last_name', name: 'last_name'},
                {data: 'email', name: 'email'},
                {data: 'company', name: 'company'},
                {data: 'phone', name: 'phone'},
                {data: 'action', name: 'action', orderable: false, searchable: false},
            ]
        });

        
    });

    $('#add_company').click(function() {
        $('#company_modal').modal('show');
    });
    $(document).ready(function() {
        setInterval(() => {
            $('.deleteCompany').on('click', function() {
                let id = $(this).data('id');
                swal({
                    title: "Are you sure?",
                    text: "Once deleted, you will not be able to recover the record!",
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                    })
                    .then((willDelete) => {
                    if (willDelete) {
                        var token = "{{ csrf_token()}}";
                        let url  = "{{ url('employees')}}";
                        $.ajax({
                            url: url+"/"+id,
                            type: 'DELETE',
                            data: {
                                _token: token
                            },
                            success: function(response) {
                                console.log(response);
                                swal("Poof! Your record has been deleted!", {
                                icon: "success",
                                });
                            },
                            error: function(result){
                                swal("Some Error Occured", {
                                    icon: "error",
                                });
                            }
                        });
                    
                    } else {
                        swal("Your record is safe!");
                    }
                });
        });
        $('.editCompany').click(function() {
            let id = $(this).data('id');
            let first_name = $(this).data('first_name');
            let last_name = $(this).data('last_name');
            let email = $(this).data('email');
            let phone = $(this).data('phone');
            let company_id = $(this).data('company_id');
            let url = "{{ url('employees')}}" + '/' + id;
            $('#edit_company_form').attr('action', url)
            $('#first_name').val(first_name);
            $('#last_name').val(last_name);
            $('#email').val(email);
            $('#phone').val(phone);
            $('#company').val(company_id)
            $('#edit_company_modal').modal('show');
        });
        }, 1000);
        

    });
    
    
   
  </script>
@endsection