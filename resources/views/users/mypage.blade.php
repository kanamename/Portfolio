@extends('layouts.layout')

@section('content')
<div class="container">
  <div class="row mx-auto" style="max-width:800px">
    <div class="col-12">
      <!-- タブ -->
      <ul class="nav nav-tabs">
        <li class="nav-item">
          <a class="nav-link active" href="#favorite" data-toggle="tab">お気に入り</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#account" data-toggle="tab">アカウント</a>
        </li>
      </ul>
    </div>
  </div>
</div>

<!-- タブの中身 -->
<div class="container tab-content mt-3">
  <!-- お気に入り -->
  <div id="favorite" class="tab-pane active mx-auto" style="max-width:500px; max-height:500px;">
    @if(!$shops->isEmpty())
      <div class="d-flex flex-wrap justify-content-center">
        @foreach($shops as $shop)
          <div class="col-12 flex-column">
            <a href="{{ route('show', ['id' => $shop->id]) }}" class="card-body text-dark">
              <div class="card border-secondary">
                <img class="card-img-top" width="30%" height="60%" src="{{ asset($shop->image_url) }}" alt="ショップ画像" style="max-height:380px;">
                <div class="card-content-wrap p-2">
                  <h3 class="card-title text-truncate">{{$shop->shop_name}}</h3>
                  <p class="card-text my-0 text-truncate">価格帯：{{$shop->price_range}}</p>
                  <p class="card-text my-0 text-truncate">住所：{{$shop->address}}</p>
                </div>
              </div>
            </a>
          </div>
        @endforeach
      </div>

      <div class="d-flex justify-content-center mt-4 mb-4">
        {{ $shops->links() }}
      </div>
    @else
      <div class="container-fluid">
        <div class="d-flex justify-content-center pt-5">
          <h5>お気に入りに登録しているショップがありません</h5>
        </div>
      </div>
    @endif
  </div>

  <!-- アカウント情報 -->
  <div id="account" class="tab-pane mx-auto" style="max-width:800px">
    <div class="col-12">
      <div class="border bg-white rounded p-3">
        <div style="line-height:1.5rem">
          <span class="font-weight-bold">ユーザー名</span>
          <a class="btn btn-link" href="{{ route('updateUserNameShow') }}">編集</a>
          <p>{{$user->name}}</p>
          <span class="font-weight-bold">メールアドレス</span>
          <a class="btn btn-link" href="{{ route('updateMailAddressShow') }}">編集</a>
          <p>{{$user->email}}</p>
          <span class="font-weight-bold">パスワード</span>
          <a class="btn btn-link" href="{{ route('updatePasswordShow') }}">編集</a>
          <p>パスワードは安全のため表示できません。</p>
        </div>
      </div>
    </div>
  </div>

</div>

@endsection