@extends('layouts.layout')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="card col-auto col-xs-6 col-md-6">
            <div class="row">
                <div class="card-header col">{{ __('ユーザー名変更') }}</div>
            </div>

            <div class="card-body">
              @if($errors->any())
                <div class="alert alert-danger">
                  @foreach($errors->all() as $message)
                    <p>{{ $message }}</p>
                  @endforeach
                </div>
              @endif

                <form method="POST" action="{{ route('updateUserName') }}">
                    @csrf
                    <div class="form-group">
                        <input id="username" type="text" value="{{ $user->name }}" class="form-control @error('username') is-invalid @enderror" name="username" autofocus>
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

@section('scripts')
  <!-- フラッシュメッセージ -->
  @if (session('flash_message'))
    $(function () {
      toastr.options = {
      "closeButton": true,
      "debug": false,
      "newestOnTop": false,
      "progressBar": false,
      "positionClass": "toast-top-center",
      "preventDuplicates": false,
      "onclick": null,
      "showDuration": "300",
      "hideDuration": "2000",
      "timeOut": "2000",
      "extendedTimeOut": "2000",
      "showEasing": "swing",
      "hideEasing": "linear",
      "showMethod": "fadeIn",
      "hideMethod": "fadeOut"
    }
      toastr.success('{{ session('flash_message') }}');
    });
  @endif
@endsection