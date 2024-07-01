@extends('layout.master')

@section('title')
المنيو
@endsection

@section('css')
<style>
.btn-orange {
    background-color: #ff9800; 
    color: white;
    border: none; 
    padding: 6px 23px;
    font-size: 21px;
    border-radius: 14px;
    transition: background-color 0.3s, transform 0.3s; 
    text-transform: uppercase;
    text-decoration: none;
    white-space: nowrap;
}
.custom-button {
        margin-left: auto;
        float: right;
    }
</style>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

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
                <h6>{{ $basket->prodect->price }} $</h6>
                <div class="btn-box">
                </div>
              </div>
              <a href="{{ route('sendorder', $basket->prodect->id) }}" class="btn btn-orange mr-2">اطلب الآن</a>
              <a href="{{ route('delbascetprodect', $basket->prodect->id) }}" class="btn btn-danger float-right">
                <i class="fas fa-trash-alt"></i> 
            </a>
            </div>
          </div>
        </div>
        @endforeach
        
        @foreach ($basketsoffer as $basket)
        <div class="col-sm-6 col-lg-4 all {{ $basket->offer->name }}">
          <div class="box">
            <div class="img-box">
              <img src="{{ Storage::url($basket->offer->image) }}" style="width: 200px; height:200px; auto;">
            </div>
            <div class="detail-box">
              <h5>{{ $basket->offer->name }}</h5>
              <p>{{ $basket->offer->description }}</p>
              <div class="options d-flex justify-content-between align-items-center">
                <h6>{{ $basket->offer->price }} $</h6>
              </div>
              <a href="{{ route('sendoffer', $basket->offer->id) }}" class="btn btn-orange mr-2">اطلب الآن</a>
              <a href="{{ route('delbascet', $basket->offer->id) }}" class="btn btn-danger float-right">
                <i class="fas fa-trash-alt"></i> 
            </a>
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