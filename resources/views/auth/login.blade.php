@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Login') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>
                            <input type="hidden" name="latitude" id="latitude" value="">
                            <input type="hidden" name="longitude" id="longitude" value="">
                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-6 offset-md-4">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                    <label class="form-check-label" for="remember">
                                        {{ __('Remember Me') }}
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary" onclick="click();">
                                    {{ __('Login') }}
                                </button>

                                @if (Route::has('password.request'))
                                    <a class="btn btn-link" href="{{ route('password.request') }}">
                                        {{ __('Forgot Your Password?') }}
                                    </a>
                                @endif
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="container" style="margin-top: 17px;">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <!-- <div class="card-header">{{ __('Login Information') }}</div>-->

                <div class="card-body">
                    <table class="table table-bordered">
						<thead>
						<tr>
							<th scope="col">Role</th>
							<th scope="col">Email</th>
							<th scope="col">Password</th>
						</tr>
						</thead>
						<tbody>
							<tr>
								<th>Super Admin</th>
								<td>admin@gmail.com</td>
								<td>1234</td>
							</tr>
							<tr>
								<th scope="row">Supervisor</th>
								<td>super@gmail.com</td>
								<td>1234</td>
							</tr>
							<tr>
								<th scope="row">User</th>
								<td>user@gmail.com</td>
								<td>1234</td>
							</tr>
							<tr>
								<th scope="row">Client</th>
								<td>client@gmail.com</td>
								<td>1234</td>
							</tr>
						</tbody>
					</table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@push('js')

    <script>
        $( document ).ready(function() {
            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(showPosition);
            }

            function showPosition(position) {
                $('#latitude').val(position.coords.latitude);
                $('#longitude').val(position.coords.longitude);
            }
        });
    </script>

@endpush

