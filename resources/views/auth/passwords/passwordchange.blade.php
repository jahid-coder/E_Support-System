@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Change your Password') }}</div>

                <div class="card-body">
                    @if(session()->has('success'))
                        <strong class="text-success">{{session()->get('success')}}</strong>
                    @endif

                    @if(session()->has('error'))
                        <strong class="text-success">{{session()->get('error')}}</strong>
                    @endif


                    <form method="POST" action="{{route('update.password')}}">
                        @csrf

                        <div class="row mb-3">
                            <label>Curent Password</label>
                            <input  type="password"  name="current_password" class="form-control @error('current_password') is-invalid @enderror" placeholder="Current Password" required autocomplete="current_password">
                             @error('current_password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                             @enderror
                         </div>
                        <div class="row mb-3">
                            <label >New Password</label>
                            <input  type="password"  name="password" class="form-control @error('password') is-invalid @enderror" placeholder="New Password" required autocomplete="password">
                             @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                            
                        </div>
                        <div class="row mb-3">
                            <label >Confirm Password</label>
                            <input  type="password"  name="password_confirmation" class="form-control @error('password_confirmation') is-invalid @enderror" placeholder="Confirm Password" required autocomplete="current-password">
                            @error('password_confirmation')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <button type="submit" class="btn btn-primary" > Change Password</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
