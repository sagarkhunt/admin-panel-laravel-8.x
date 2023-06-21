@extends('layouts.admin')
@section('title')
    User
@endsection
@section('css')
    <!-- plugin css -->
    <link href="{{URL::to('storage/app/public/Adminassets/libs/datatables/dataTables.bootstrap4.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{URL::to('storage/app/public/Adminassets/libs/datatables/responsive.bootstrap4.min.css')}}" rel="stylesheet" type="text/css" />
@endsection
@section('content')
    <div class="row page-title">
        <div class="col-md-12">
            <nav aria-label="breadcrumb" class="float-right">
                <a href="{{URL::to('admin/users/create')}}" class="btn btn-primary text-white">+ Create User</a>
            </nav>
            <h4 class="mb-1 mt-1">User</h4>
        </div>
    </div>
    <div class="row">
                <div class="col-md-12">
                    @if(Session::has('message'))
                        {!! Session::get('message') !!}
                    @endif
                </div>
            </div>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="header-title mt-0 mb-1">User</h4>


                    <table id="basic-datatable" class="table dt-responsive nowrap">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Profile Pic</th>
                            <th>Role</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                        </thead>


                        <tbody>

                            @foreach($data as $row)
                            <tr>
                                <td>{{$row->id}}</td>
                                <td>{{$row->name}}</td>
                                <td>{{$row->email}}</td>
                                <td>
                                    @if($row->user_image_path && $row->profile_picture != '')
                                        <img src="{{$row->user_image_path}}" class="rounded avatar-sm"
                                             alt="user">
                                    @else
                                        <img src="{{$row->user_image_path}}" class="rounded avatar-sm"
                                             alt="user">
                                    @endif
                                </td>
                                <td>{{@$row->id == 1 ? 'Admin' : 'User'}}</td>
                                <td>
                                    <a href="{{URL::to('admin/users/'.$row->id.'/status')}}"> <label
                                        class="badge badge-soft-{{$row->status == 'active' ? 'success' : 'danger'}}">{{$row->status}}</label>
                                </a>
                                </td>

                                <td>
                                    <a class="" href="{{URL::to('admin/users/'.$row->id.'/edit')}}"> <i class="uil-pen"></i></a>
                                    <a class="" href="{{URL::to('admin/users/'.$row->id.'/destroy')}}"><i class="uil-trash-alt"></i></a>
                                </td>
                            </tr>
                            @endforeach

                        </tbody>
                    </table>

                </div> <!-- end card body-->
            </div> <!-- end card -->
        </div><!-- end col-->
    </div>
@endsection

@section('plugin')
    <!-- datatable js -->
    <script src="{{URL::to('storage/app/public/Adminassets/libs/datatables/jquery.dataTables.min.js')}}"></script>
    <script src="{{URL::to('storage/app/public/Adminassets/libs/datatables/dataTables.bootstrap4.min.js')}}"></script>
    <script src="{{URL::to('storage/app/public/Adminassets/libs/datatables/dataTables.responsive.min.js')}}"></script>
    <script src="{{URL::to('storage/app/public/Adminassets/libs/datatables/responsive.bootstrap4.min.js')}}"></script>


@endsection
@section('js')
    <!-- Datatables init -->
    <script src="{{URL::to('storage/app/public/Adminassets/js/pages/datatables.init.js')}}"></script>
@endsection
