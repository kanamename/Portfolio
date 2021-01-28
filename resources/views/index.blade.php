@extends('layouts.layout')

@section('content')
<!-- サイト概要 -->
<div class="container">
  <div class="row d-flex align-items-center">
    <div class="col text-center mb-4">
      <p class="index-title">Select  Shop  TOKYO</p>
      <div class="index-description" style="letter-spacing:0.2em;">
        <p>東京のおしゃれなセレクトショップを検索できるサイト</p>
        <p>一緒にあなた好みのショップを見つけませんか？</p>
       </div>
    </div>
  </div>
</div>

<!-- 検索フォーム -->
<div class="container">
	<div class="row justify-content-center ml-2 mr-2">
		<div class="card bg-light col-xs-12 col-sm-10 col-md-8 col-lg-8 col-xl-7 mb-5">
			<div class="card-body">
				<form method="get" action="/search">
					@csrf
					<div class="form-row justify-content-center">
						<!-- 値段 -->
						<div class="form-group col-xl-4">
							<select name="price_range" class="form-control">
								<option value="">価格帯</option>
								@foreach(config('const.const.price_range') as $key => $price)
                  <option value="{{ $price }}">{{ $price }}</option>
								@endforeach
							</select>
						</div>
						<!-- エリア -->
						<div class="form-group col-xl-3">
							<select name="area" class="form-control">
								<option value="" selected>エリア</option>
								@foreach(config('const.const.area') as $key => $area)
                  <option value="{{ $area }}">{{ $area }}</option>
								@endforeach
							</select>
						</div>
						<!-- キーワード -->
						<div class="form-group col-xl-5">
							<input type="text" name="keyword" placeholder="キーワード" class="form-control">
						</div>
					</div>
					<!-- 検索ボタン -->
					<div class="form-row justify-content-center">
						<div class="col-4 text-center">
							<input type="submit" name="search" class="btn btn-outline-primary form-control" value="検索">
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>

<!-- コンテンツ表示 -->
<div class="container">
	<div class="col-12">
		<div class="mx-auto" style="max-width:1200px">
			<div class="d-flex flex-row flex-wrap">
        @foreach($shops as $shop)
          <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xl-4 mb-3">
					<a href="{{ action('ShopsController@show', $shop->id) }}" class="shop-link card-body text-dark">
              <div class="card border-secondary">
								<div class="card-img-wrap">
									<img class="card-img-top" width="30%" height="60%" src="{{ asset($shop->image_url) }}" alt="ショップ画像" style="max-height:220px;">
								</div>
                <div class="card-content-wrap p-2">
                  <h3 class="card-title text-truncate">{{$shop->shop_name}}</h3>
									<p class="card-text my-0 text-truncate">
										<span class="star-rating">
											<span class="star-rating-front" style="width: {{ $shop->shop_review_stars }}%">★★★★★</span>
											<span class="star-rating-back">★★★★★</span>
										</span>
										<span class="review-points">{{ $shop->shop_review_avg }}</span>
										<span class="text-secondary">（{{ $shop->shop_review_count }}件）</span>
									</p>
                  <p class="card-text my-0 text-truncate">価格帯：{{$shop->price_range}}</p>
                  <p class="card-text my-0 text-truncate">住所：{{$shop->address}}</p>
                </div>
              </div>
            </a>
          </div>
        @endforeach
			</div>
		</div>
	</div>
</div>

<div class="d-flex justify-content-center mt-4 mb-4">
  {{ $shops->links() }}
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