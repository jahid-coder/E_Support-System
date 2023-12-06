@extends('layouts.app')
@section('content')
        <div class="container mt-4">
         <div class="row justify-content-center">
            <div class="col-md-12">
                <br>
                  <div class="card">
                     
                     <div class="card-header">{{__('Add new user')}}  <a href="{{route('user.index')}}" class="btn btn-sm btn-info" style="float:right;"> All user </a> </div>
                    
                        <div class="card-body">
                              <form action ="{{route('user.store')}}" method="post">
                                 @csrf
                                   
                                 <div class="form-group">
                                       <label for="exampleInputStudentName"> Choose Role</label>
                                       <select class="form-control" name="role_id">
                                            @foreach($roles as $row)
                                                <option value="{{$row->id}}">{{$row->rolename}}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="form-group">
                                       <label for="exampleInputStudentName"> User Id<span class="text-danger">*</span></label>
                                       <input type="text" name="userid" class="form-control @error('userid') is-invalid @enderror" placeholder="Enter user userid"
                                       value="{{old('userid')}}" required>
                                          @error('userid')
                                             <span class="invalid-feedback" role="alert">
                                                <strong>{{$message}}</strong>
                                             </span>
                                          @enderror
                                    </div>


                                    <div class="form-group">
                                       <label for="exampleInputStudentName"> User Name<span class="text-danger">*</span></label>
                                       <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" placeholder="Enter user Name"
                                       value="{{old('name')}}" required>
                                          @error('name')
                                             <span class="invalid-feedback" role="alert">
                                                <strong>{{$message}}</strong>
                                             </span>
                                          @enderror
                                    </div>

                                    <div class="form-group">
                                       <label for="exampleInputStudentName"> User Email<span class="text-danger">*</span></label>
                                       <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" placeholder="Enter user email"
                                       value="{{old('email')}}" required>
                                          @error('email')
                                             <span class="invalid-feedback" role="alert">
                                                <strong>{{$message}}</strong>
                                             </span>
                                          @enderror
                                    </div>

                                    <div  class="form-group">
                                       <label for="exampleInputStudentName"> Password<span class="text-danger">*</span></label>
                                       <input placeholder="Password" type="password" class="form-control @error('password') is-invalid @enderror"
                                                name="password" required autocomplete="new-password">
                                       @error('password')
                                             <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                             </span>
                                       @enderror
                                    </div>
                                    <div class="form-group">
                                       <label for="exampleInputStudentName"> Confirm Password<span class="text-danger">*</span></label>
                                       <input type="password"  placeholder="Confirm Password"  class="form-control"
                                                name="password_confirmation" required autocomplete="new-password">
                                    </div>

                                    <button type="submit" class="btn btn-primary">Submit</button>
                              </form>

                        </div>
                  </div>
               </div>
         </div>
      </div>

  
   @endsection

@push('script')
  
@endpush