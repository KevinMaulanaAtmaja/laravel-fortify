@extends('layouts.app')
@section('content')
<div class="container">

    <div class="col-md-6 mx-auto">
        @if (session('status') == 'two-factor-authentication-enabled')
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ __('Please finish configuring two factor authentication below.') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @elseif (session('status') == 'two-factor-authentication-confirmed')
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ __('Two factor authentication confirmed and enabled successfully.') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @elseif (session('status') == 'two-factor-authentication-disabled')
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ __('Two factor authentication disabled successfully.') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
    </div>

    @if (Auth::user()->two_factor_secret)
        @if (Auth::user()->two_factor_confirmed_at == null)
            <div class="row">
                <h3 class="text-center mb-3">{{ __('Enter Google authenticator verif code to confirm Two-Factor Auth.') }}</h3>
                <div class="col-md-4 mx-auto">

                    {{-- if not confirm --}}
                    <form method="POST" action="{{ route('two-factor.confirm') }}">
                        @csrf
                        <div class="form-group mb-3">
                            <input type="text" id="code" name="code" class="form-control @error('code', 'confirmTwoFactorAuthentication') is-invalid @enderror"
                                required autofocus>
                            @error('code', 'confirmTwoFactorAuthentication')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <button type="submit" class="btn btn-primary mb-5">
                            Confirm 2FA
                        </button>
                    </form>
                </div>
            </div>
        @endif

        <hr>

        <div class="row">
            <!-- QR Code Section -->
            <div class="col-md-6">
                <h3 class="mb-4">QR Code:</h3>
                <div class="mb-4">
                    {!! auth()->user()->twoFactorQrCodeSvg() !!}
                </div>
            </div>

            <!-- Recovery Codes Section -->
            <div class="col-md-6">
                <h3 class="mb-4">Recovery Codes:</h3>
                <ul class="list-group">
                    @foreach (auth()->user()->recoveryCodes() as $code)
                    <li class="list-group-item">{{ $code }}</li>
                    @endforeach
                </ul>
            </div>
        </div>

    @else
        <form method="POST" action="{{ url('/user/two-factor-authentication') }}">
            @csrf

            <div class="mb-3">
                <button type="submit" class="btn btn-primary">Enable 2FA</button>
            </div>
        </form>
    @endif
</div>

@endsection
