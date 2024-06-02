@extends('layout.master')

@section('title')
المنيو
@endsection

@section('css')
<style>
.btn-orange {
    background-color: #ff9800; /* لون برتقالي */
    color: white; /* لون النص */
    border: none; /* إزالة الحدود */
    padding: 15px 30px; /* مسافات داخلية للزر */
    font-size: 20px; /* حجم الخط */
    border-radius: 5px; /* زوايا مستديرة */
    transition: background-color 0.3s, transform 0.3s; /* تأثيرات انتقالية */
    text-transform: uppercase; /* تحويل النص إلى أحرف كبيرة */
    text-decoration: none; /* إزالة الخط السفلي من الرابط */
    white-space: nowrap; /* لمنع النص من الانقسام إلى سطرين */
}
</style>
<style>
  .btn-orange {
      background-color: #ff8800;
      border-color: #ff8800;
      color: white;
  }

  .btn-orange:hover {
      background-color: #e67600;
      border-color: #e67600;
  }
  .food_section .box .options a {
    width: 144px;
  }
</style>
@endsection

@section('content')

@if (session()->has('login'))
<div class="alert alert-danger alert-dismissible fade show" role="alert">
    <strong>{{ session()->get('login') }}</strong>
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
@endif
@if (session()->has('delete'))
<div class="alert alert-danger alert-dismissible fade show" role="alert">
    <strong>{{ session()->get('delete') }}</strong>
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
@endif
<!-- food section -->
<section class="food_section layout_padding-bottom">
  <div class="container">
    <div class="heading_container heading_center">
      <h2>
        basket
      </h2>
    </div>
  
    <div class="filters-content">
      <div class="row grid">
        @foreach ($baskets as $basket)
        <div class="col-sm-6 col-lg-4 all {{ $basket->prodect->name  }}">
          <div class="box">
            <div class="img-box">
              <img src="{{ Storage::url($basket->prodect->image) }}" style="width: 200px; height:200px; auto;">
            </div>
            <div class="detail-box">
              <h5>{{ $basket->prodect->name }}</h5>
              <p>{{ $basket->prodect->description }}</p>
              <div class="options">
                <h6>{{ $basket->prodect->price }} EGP</h6>
                <div class="btn-box">
                  <a href="{{ route('delbascetprodect', $basket->prodect->id) }}" class="btn btn-orange">حذف من السلة</a>
              </div>
              </div>
              <a href="{{ route('sendorder', $basket->prodect->id) }}" class="btn btn-orange">اطلب الآن</a>
            </div>
          </div>
        </div>
        @endforeach
        @foreach ($basketsoffer as $basket)
        <div class="col-sm-6 col-lg-4 all {{ $basket->offer->name  }}">
          <div class="box">
            <div class="img-box">
              <img src="{{ Storage::url($basket->offer->image) }}" style="width: 200px; height:200px; auto;">
            </div>
            <div class="detail-box">
              <h5>{{ $basket->offer->name }}</h5>
              <p>{{ $basket->offer->description }}</p>
              <div class="options">
                <h6>{{ $basket->offer->price }} EGP</h6>
                <div class="btn-box">
                  <a href="{{ route('delbascet', $basket->offer->id) }}" class="btn btn-orange">حذف من السلة</a>
                </div>
              </div>
              <a href="{{ route('sendoffer', $basket->offer->id) }}" class="btn btn-orange">اطلب الآن</a>
            </div>
          </div>
        </div>
        @endforeach
      </div>
    </div>

    <div class="btn-box">
      <a href="#">View More</a>
    </div>
  </div>
</section>

@endsection

@section('js')
@endsection