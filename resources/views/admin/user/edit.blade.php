@extends('layouts.admin')
@section('title')
    Edit User
@endsection
@section('css')
@endsection
@section('content')
    <div class="row page-title">
        <div class="col-md-12">
            <nav aria-label="breadcrumb" class="float-right mt-1">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{URL::to('admin/dashboard')}}">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="{{URL::to('admin/users')}}">User</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Edit User</li>
                </ol>
            </nav>
            <h4 class="mb-1 mt-0">Edit User</h4>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="header-title mt-0 mb-1">Edit User Form</h4>

                    <hr/>

                  {{Form::open(array('url'=>'admin/users/'.$data['id'],'method'=>'PUT','name'=>'Edit-category','files'=>'true','class'=>'needs-validation','novalidate'))}}
                    <div class="row">
                        <div class="col-lg-4">
                            <div class="form-group mb-3">
                                <label for="validationCustom01">First name</label>
                                {{Form::text('name',$data['name'],array('class'=>'form-control','id'=>'validationCustom01','placeholder'=>'Name','required'))}}

                            </div>
                        </div>

                        <div class="col-lg-4">
                            <div class="form-group mb-3">
                                <label for="validationCustom01">Email</label>
                                {{Form::text('email',$data['email'],array('class'=>'form-control','id'=>'validationCustom03','placeholder'=>'Email','required'))}}

                            </div>
                        </div>

                            <div class="col-sm-4">
                                <label>Profile Pic</label>
                                <div class="custom-file">
                                    {{Form::file('profile_pic',array('class'=>$errors->has('profile_pic') ?'custom-file-input is-invalid' : 'custom-file-input','id'=>'customFile'))}}
                                    <label class="custom-file-label" for="customFile">Choose file</label>

                                </div>
                                @error('profile_pic')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                                @if(!empty($data['profile_picture']))
                                    <img src="{{URL::to('storage/app/public/user/'.$data['profile_picture'])}}"
                                         class="rounded avatar-sm mt-2"
                                         alt="user">
                                @endif
                            </div>

                    </div>
                    <div class="row">
                        <div class="col-lg-4">

                            <div class="form-group mb-3">
                                   <label for="validationCustom01">Roles</label>
                                {{Form::select('roles',array(''=>'Select Role','1'=>'Admin','2'=>'User'),$data->role_id,array('class'=>'form-control','id'=>'validationCustom04','required'))}}

                            </div>
                        </div>

                        <div class="col-lg-4">

                            <div class="form-group mb-3">
                                <label for="validationCustom01">Status</label>
                                {{Form::select('status',array(''=>'Select Status','active'=>'Active','inactive'=>'Inactive'),$data['status'],array('class'=>'form-control','id'=>'validationCustom04','required'))}}

                            </div>
                        </div>

                    </div>



                    {{Form::submit('Update',array('class'=>'btn btn-primary'))}}
                    <a href="{{URL::to('guru-admin/user')}}" class="btn btn-danger" >Cancel</a>
                    {{Form::close()}}

                </div> <!-- end card-body-->
            </div> <!-- end card-->
        </div> <!-- end col-->
    </div>
@endsection

@section('plugin')
    <!-- Plugin js-->
    <script src="{{URL::to('storage/app/public/Adminassets/libs/parsleyjs/parsley.min.js')}}"></script>
@endsection
@section('js')
    <!-- Validation init js-->
    <script src="{{URL::to('storage/app/public/Adminassets/js/pages/form-validation.init.js')}}"></script>
    <script>
        $('input[type="file"]'). change(function(e){

            var fileName = e. target. files[0]. name;
            $('.custom-file-label').text(fileName);

        });

    </script>
@endsection

