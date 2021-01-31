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

  <div class="show-favorite-wrapper mb-5">
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
      <p class="mt-2" style="color:red;">お気に入りにはログインが必要です。</p>
    @endif
  </div>

  <div class="row mt-2 mt-xl-3 no-gutters">
    <div class="col">
      <div class="shop-review my-5">
        <h2 class="show-shop-title">ショップレビュー</h2>

        <div class="mt-4 mb-4">
          <!-- ログインしているか -->
          @if( Auth::check() )
            <!-- 既にレビュー投稿しているか -->
            @if(empty($review_flg))
              <a href="{{ route('review.index', ['id' => $shop_data->id]) }}" class="btn btn-primary">
                レビューを投稿する
              </a>
            @else
              <a href="{{ route('review.index', ['id' => $shop_data->id]) }}" class="btn btn-secondary disabled">
                レビューを投稿する
              </a>
              <p class="mt-2" style="color:red;">既にレビュー投稿しています。</p>
            @endif
          @else
            <a href="{{ route('review.index', ['id' => $shop_data->id]) }}" class="btn btn-secondary disabled">
              レビューを投稿する
            </a>
            <p class="mt-2" style="color:red;">レビュー投稿にはログインが必要です。</p>
          @endif
        </div>

        <div class="mt-2 mt-xl-3 p-2 bg-light" style="border-style:solid; border-color:#d3d3d3; border-width:1px;">
          <div class="star-rating-wrapper">
            <span class="pt2 pl-2">総合評価：
              <span class="star-rating">
                <span class="star-rating-front" style="width: {{ $comprehensive_review_data_list['stars'] }}%">★★★★★</span>
                <span class="star-rating-back">★★★★★</span>
              </span>
              <span class="review-points">{{ $comprehensive_review_data_list['avg'] }}</span>
              <span class="text-secondary">（{{ $comprehensive_review_data_list['count'] }}件）</span>
            </span>
          </div>
          <div class="pt-2 pl-2">
            @foreach($review_data_list as $data)
              <div class="mb-3 p-3 bg-light" style="border-style:solid; border-color:#d3d3d3; border-width:1px;">
                <div class="row">
                  <div class="col-12 col-lg-2 col-xl-1 mb-2">
                    @if($data->users->image_path == null)
                      <img class="rounded-circle" src="{{ $default_image_path }}" alt="プロフィール画像" style="width:80px; height:80px;">
                    @else
                      <img class="rounded-circle" src="{{ $data->users->image_path }}" alt="プロフィール画像" style="width:80px; height:80px;">
                    @endif
                  </div>

                  <div class="col-12 col-lg-10 col-xl-11">
                    <p class="m-0"><span>{{ $data->users->name }}</span>さん</p>
                    <p class="m-0">投稿日：<span>{{ $data->updated_at->format('Y年m月d日') }}</span></p>
                  </div>
                </div>
                
                <p class="m-0">評価：
                  <span class="star-rating" style="font-size: 25px;">
                    <span class="star-rating-front" style="width: {{ $data->stars * 20 }}%">★★★★★</span>
                    <span class="star-rating-back">★★★★★</span>
                  </span>
                  <span class="review-points">{{ $data->stars }}</span>
                </p>
                @if ($data->user_id == Auth::id() )
                  <p class="m-0">コメント：<span>{{ $data->comment }}</span></p>
                  <div class="mt-2">
                    <a class="btn btn-primary btn-sm mr-2" href="{{ route('review.edit', ['id' => $shop_data->id]) }}">編集</a>
                    <form style="display: inline-block;" method="POST" action="{{ route('review.delete', ['id' => $shop_data->id]) }}">
                      @csrf
                      <button class="btn btn-danger btn-sm">削除</button>
                    </form>
                  </div>
                @else
                  <p class="m-0">コメント：<span>{{ $data->comment }}</span></p>
                @endif
              </div>
            @endforeach
          </div>
        </div>
        <!-- ぺージリンク -->
        <div class="d-flex justify-content-center mt-4 mb-4">
          {{ $review_data_list->appends(request()->input())->links() }}
        </div>
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