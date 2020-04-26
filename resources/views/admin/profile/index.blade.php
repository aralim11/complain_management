@extends('layouts.backEnd.app')

@section('title', 'Edit Profile')

@section('content')
    <div class="card">
        <div class="card-header">@yield('title')
            @if(session()->has('success_msg'))<span class="badge badge-success float-right" style="margin-top: 1px; margin-right: 8px; padding: 8px; font-size: 11px;">{{ Session('success_msg') }}</span> @endif
            @if(session()->has('delete_msg'))<span class="badge badge-danger float-right" style="margin-top: 1px; margin-right: 8px; padding: 8px; font-size: 11px;">{{ Session('delete_msg') }}</span> @endif</div>

        <div class="card-body">
            <form method="POST" action="{{ route('admin.profile.update', Auth::id()) }}">
                @csrf
                @method('PUT')
                <div class="form-group row">
                    <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>

                    <div class="col-md-6">
                        <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ $profile->name }}" required autocomplete="name" autofocus>

                        @error('name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    <label for="department" class="col-md-4 col-form-label text-md-right">{{ __('Department') }}</label>

                    <div class="col-md-6">
                        <input id="department" type="text" class="form-control" name="department" value="@if($profile->user_group_for_admin->name == '') {{ 'All Department' }} @endif" autofocus readonly>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="user_role" class="col-md-4 col-form-label text-md-right">{{ __('User Role') }}</label>

                    <div class="col-md-6">
                        <input id="user_role" type="text" class="form-control" name="user_role" value="{{ $profile->role->role }}" autofocus readonly>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                    <div class="col-md-6">
                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ $profile->email }}" required autocomplete="email">

                        @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    <label for="phone" class="col-md-4 col-form-label text-md-right">{{ __('Phone') }}</label>

                    <div class="col-md-6">
                        <input id="phone" type="phone" value="{{ $profile->phone }}" class="form-control @error('phone') is-invalid @enderror" name="phone">

                        @error('phone')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    <label for="old_password" class="col-md-4 col-form-label text-md-right">{{ __('Old Password') }}</label>

                    <div class="col-md-6">
                        <input id="old_password" readonly type="password" class="form-control @if(session()->has('pass_msg')) is-invalid @endif" name="old_password" autocomplete="old-password" placeholder="Old Password">

                        @if(session()->has('pass_msg'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ Session('pass_msg') }}</strong>
                        </span>
                        @endif
                    </div>
                </div>

                <div class="form-group row">
                    <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                    <div class="col-md-6">
                        <input id="password" readonly type="password" class="form-control @error('password') is-invalid @enderror" name="password" autocomplete="new-password" placeholder="New Password">

                        @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label>

                    <div class="col-md-6">
                        <input id="password-confirm" readonly type="password" class="form-control" name="password_confirmation" autocomplete="new-password" placeholder="Re Type New Password">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Update</button>
                </div>
            </form>
        </div>
    </div>
@endsection

