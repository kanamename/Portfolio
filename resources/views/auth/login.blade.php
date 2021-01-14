@extends('layouts.layout')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="card col-auto col-xs-6 col-md-6">
            <div class="row">
                <div class="card-header col">{{ __('ログイン') }}</div>
            </div>

            <div class="card-body">
                <form method="POST" action="{{ route('login') }}">
                    @csrf

                    <div class="form-group">
                            <input id="email" type="email" placeholder="メールアドレス" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                    </div>

                    <div class="form-group">
                        <input id="password" type="password" placeholder="パスワード" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                            <label class="form-check-label" for="remember">
                                {{ __('ログイン状態を保持する') }}
                            </label>
                        </div>
                    </div>

                    @if (Route::has('password.request'))
                        <div class="form-group row no-gutters">
                            <a class="btn btn-link col text-left" href="{{ route('password.request') }}">
                                {{ __('パスワードを忘れた方') }}
                            </a>
                        </div>
                    @endif

                    <div class="form-group">
                        <div class="text-center">
                            <button type="submit" class="btn btn-primary">
                                {{ __('送信') }}
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection