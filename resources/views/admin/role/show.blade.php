
@extends('layouts.app')
@section('content')                  
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                <div class="col-sm-6">
                <h2>Role Management</h2>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
                    <li class="breadcrumb-item active">Roles</li>
                    </ol>
                </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

    <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">All Roles</h3>
                                <br>
                                <br>
                        
                                <div class="card-header"> <a href="{{route('role.index')}}" class="btn btn-sm btn-info" style="float:right;"> Back </a> </div>
                               
                            </div>
                            <!-- /.card-header -->
                            
                            <div class="card-body">
                            
                                <table id="example1" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>Sl.</th>
                                            <th>Role Name</th>
                                            <th>Permissions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($roles as $key=>$row)
                                        <tr>
                                            <td>{{++$key}}</td>
                                            <td>{{$roles->rolename}}</td>
                                            <td>
                                                @if(!empty($rolePermissions))
                                                    @foreach($rolePermissions as $v)
                                                            <label class="label label-success">{{ $v->name }},</label>
                                                    @endforeach
                                                @endif
                                            </td>
                                        </tr>
                                     @endforeach
                                    </tbody>
                                    <tfoot>
                                    <tr>
                                        <th>Sl.</th>
                                        <th>Role Name</th>
                                        <th>Permissions</th>
                                    </tr>
                                    </tfoot>
                                </table>
                            </div>
                           
                        </div>
      
                    </div>
                </div>
            </div>
        </section>
@endsection