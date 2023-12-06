@extends('layouts.app')
@section('content')
   <div class="container mt-4" >
   <div class="row justify-content-center" >
      <div class="col-md-12">
            <br>
            <div class="card">
               <div class="card-header">{{__('Update User')}} <a href="{{route('user.index')}}" class="btn btn-sm btn-info" style="float:right;"> All user </a> </div>
                  <div class="card-body">
            
                        <form action ="{{route('user.update',$data->id)}}" method="post">
                           @csrf
                           <div class="form-group">
                                <label for="exampleInputStudentName"> Choose Role</label>
                                <select class="form-control" name="role_id">
                                    @foreach($roles as $row)
                                        <option value="{{$row->id}}" @if( $row->id==$data->role_id) selected @endif>{{$row->rolename}}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="exampleInputStudentName">user Id<span class="text-danger">*</span></label>
                                <input type="text" name="userid" class="form-control @error('userid') is-invalid @enderror" placeholder="Enter user id"
                                value="{{ $data->userid }}" required>
                                @error('userid')
                                    <span class="invalid-feedback" role="alert">
                                    <strong>{{$message}}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="exampleInputStudentName">User Name<span class="text-danger">*</span></label>
                                <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" placeholder="Enter user Name"
                                value="{{ $data->name }}" required>
                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                    <strong>{{$message}}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="exampleInputStudentName">Email<span class="text-danger">*</span></label>
                                <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" placeholder="Enter user email"
                                value="{{ $data->email }}" required>
                                @error('email')
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