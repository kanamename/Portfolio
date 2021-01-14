@extends('layouts.layout')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="card col-auto col-xs-6 col-md-6">
            <div class="row">
                <div class="card-header col">{{ __('会員登録') }}</div>
            </div>

            <div class="card-body">
              @if($errors->any())
                <div class="alert alert-danger">
                  @foreach($errors->all() as $message)
                    <p>{{ $message }}</p>
                  @endforeach
                </div>
              @endif

                <form method="POST" action="{{ route('register') }}">
                    @csrf
                    <div class="form-group">
                        <input id="email" type="email" placeholder="メールアドレス" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                    </div>

                    <div class="form-group">
                        <input id="username" type="text" placeholder="ユーザ名" class="form-control @error('username') is-invalid @enderror" name="username" value="{{ old('email') }}">
                    </div>

                    <div class="form-group">
                        <input id="password" type="password" placeholder="パスワード" class="form-control @error('password') is-invalid @enderror" name="password">
                    </div>

                    <div class="form-group">
                        <input id="password-confirm" type="password" placeholder="パスワード（確認）" class="form-control @error('password') is-invalid @enderror" name="password_confirmation">
                    </div>

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