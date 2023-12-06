@extends('layouts.app')
@section('content')
   <div class="container mt-4" >
   <div class="row justify-content-center" >
      <div class="col-md-12">
            <br>
            <div class="card">
               
               <div class="card-header">{{__('Update role')}}  <a href="{{route('role.index')}}" class="btn btn-sm btn-info" style="float:right;"> All role </a></div>
               
                  <div class="card-body">
                     @if(session()->has('success'))
                        <div class="alert alert-success" role ="alert">
                              {{session()->get('success')}}
                        </div>
                     @endif
                        <form action ="{{route('role.update',$data->id)}}" method="post">
                           @csrf
                              
                              <div class="form-group">
                                 <label for="exampleInputStudentName">Role Name<span class="text-danger">*</span></label>
                                 <input type="text" name="rolename" class="form-control @error('rolename') is-invalid @enderror" 
                                 value="{{$data->rolename}}" required>
                                    @error('rolename')
                                       <span class="invalid-feedback" role="alert">
                                          <strong>{{$message}}</strong>
                                       </span>
                                    @enderror
                              </div>
                              <button type="submit" class="btn btn-primary">Update</button>
                        </form>

                  </div>
            </div>
         </div>
   </div>
   </div>
@endsection