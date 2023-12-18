@extends('layouts.app')
@section('content')
        <div class="container mt-4">
         <div class="row justify-content-center">
            <div class="col-md-12">
                <br>
                  <div class="card">
                     
                     <div class="card-header">{{__('Add new Role')}}  <a href="{{route('role.index')}}" class="btn btn-sm btn-info" style="float:right;"> Back </a> </div>
                    
                        <div class="card-body">
                              <form action ="{{route('role.store')}}" method="post">
                                 @csrf
                                    <div class="form-group">
                                          <label for="exampleInputStudentName">Role Name<span class="text-danger">*</span></label>
                                          <input type="text" name="rolename" class="form-control @error('rolename') is-invalid @enderror" placeholder="Enter role Name"
                                          value="{{old('rolename')}}" required>
                                             @error('rolename')
                                                <span class="invalid-feedback" role="alert">
                                                   <strong>{{$message}}</strong>
                                                </span>
                                             @enderror
                                    </div>
                                    <div class="form-group">
                                          <label for="exampleInputStudentName">Permission<span class="text-danger">*</span></label>
                                          <br/>
                                          @foreach($permission as $value)
                                                   <label>{{ Form::checkbox('permission[]', $value->id, false, array('class' => 'name')) }}
                                                   {{ $value->name }}</label>
                                          <br/>
                                           @endforeach
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
   <script type="text/javascript">
      $(document).ready(function(){
         console.log('hello world!');
      });
   </script>
@endpush