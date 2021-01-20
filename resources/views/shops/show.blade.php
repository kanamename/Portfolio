@extends('layouts.layout')

@section('content')
<div class="container">
  <div class="row no-gutters">
    <div class="col mt-2 mt-lg-5 mt-xl-5">
      <h2 class="show-shop-title">{{$shop_data->shop_name}}</h2>
    </div>
  </div>
  <div class="row mt-2 mt-xl-3 no-gutters">
    <div class="col-12 col-lg-6 col-xl-6 h-100">
      <table class="table table-bordered">
        <tbody>
          <tr>
            <th class="table-active align-middle text-nowrap" scope="row">価格帯</th>
            <td>{{$shop_data->price_range}}</td>
          </tr>
          <tr>
            <th class="table-active align-middle text-nowrap" scope="row">取り扱いブランド</th>
            <td>{{$brands}}</td>
          </tr>
          <tr>
            <th class="table-active align-middle text-nowrap" scope="row">郵便番号</th>
            <td>{{$shop_data->postal_code}}</td>
          </tr>
          <tr>
            <th class="table-active align-middle text-nowrap" scope="row">住所</th>
            <td>{{$shop_data->address}}</td>
          </tr>
          <tr>
            <th class="table-active align-middle text-nowrap" scope="row">電話番号</th>
            <td>{{$shop_data->tel}}</td>
          </tr>
          <tr>
            <th class="table-active align-middle text-nowrap" scope="row">URL</th>
            <td>{{$shop_data->url}}</td>
          </tr>
          <tr>
            <th class="table-active align-middle text-nowrap" scope="row">クレジットカード</th>
            @if($shop_data->tel)
              <td>利用可</td>
            @else
              <td>―</td>
            @endif
          </tr>
        </tbody>
      </table>
    </div>

    <div class="col-12 col-lg-6 col-xl-6 mt-2 mt-lg-0 d-flex align-items-center justify-content-center">
      <img class="show-shop-img img-thumbnail" src="{{ asset($shop_data->image_url) }}" alt="ショップ画像">
    </div>
  </div>

  <div class="mb-5">
    <!-- ログインしているか -->
    @if( Auth::check() )
      <!-- お気に入りしているか -->
      @if($shop_data->is_favorited_by_auth_user())
        <a href="{{ route('shop.unfavorite', ['id' => $shop_data->id]) }}" class="btn btn-success">お気に入り
      <span class="badge badge-light">×{{ $shop_data->favorites->count() }}人</span></a>
      @else
        <a href="{{ route('shop.favorite', ['id' => $shop_data->id]) }}" class="btn btn-secondary">お気に入り
      <span class="badge badge-light">×{{ $shop_data->favorites->count() }}人</span></a>
      @endif
    @else
      <a href="" class="btn btn-secondary disabled mr-2">お気に入り
      <span class="badge badge-light">×{{ $shop_data->favorites->count() }}人</span></a>
      <span style="color:red;">お気に入りにはログインが必要です。</span>
    @endif
  </div>

  <div class="shop-review my-5">
    <h2 class="show-shop-title">ショップレビュー</h2>
    <div class="p-2">
      <h5>総合評価</h5>
      <div class="pt-3 pl-3" style="border-style:solid; border-color:#817a7a; border-width:2px;">
        @foreach($shop_reviews as $shop_review)
          <div class="mb-3">
            <p class="m-0">投稿日：<span>{{ $shop_review->created_at->format('Y年m月d日') }}</span></p>
            <p class="m-0">投稿者：<span>{{ $shop_review->users->name }}</span>さん</p>
            <p class="m-0">評価：<span>{{ $shop_review->stars }}</span></p>
            <p class="m-0">コメント：<span>{{ $shop_review->comment }}</span></p>
          </div>
        @endforeach
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