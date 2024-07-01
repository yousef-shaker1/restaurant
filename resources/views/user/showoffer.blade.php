@extends('layout.master')

@section('title')
عرض المنتج 
@endsection
@section('css')

@endsection

@section('content')
@if (session()->has('Add'))
<div class="alert alert-success alert-dismissible fade show" role="alert">
    <strong>{{ session()->get('Add') }}</strong>
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
@endif
@if (session()->has('login'))
<div class="alert alert-danger alert-dismissible fade show" role="alert">
  <strong>{{ session()->get('login') }}</strong>
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
      <span aria-hidden="true">&times;</span>
  </button>
</div>
@endif
<div class="container mt-5">
    <h2 class="mb-4">show product</h2>
    <div class="row">
      <div class="col-md-8">
        <table class="table table-hover">
          <thead>
            <tr>
              <th>Product name</th>
              <th>Image</th>
              <th>description</th>
              <th>Price</th>
            </tr>
          </thead>
          <tbody>
            <!-- Repeat this row for each product in the cart -->
            <tr>
              <td>{{ $offer->name }}</td>
              <td>
                <a href='{{ Storage::url($offer->image) }}'>
                    <img src="{{ Storage::url($offer->image) }}" alt="صورة المنتج" class="product-img" style="width: 100px; height:100px auto;">
                </a> 
             </td>
              <td>{{ $offer->description }}</td>
              <td>{{ $offer->price }} $</td>
            </tr>
            <!-- End of product row -->
          </tbody>
        </table>
      </div>
      <div class="col-md-4">
        <div class="mt-5 mb-5"> <!-- Added margin-top and margin-bottom to move the buttons down -->
            @if(!empty(Auth::user()->name))
            <div class="mb-3">
                <a class="btn btn-primary btn-block mb-2" href="{{ route('Basketoffer', $offer->id) }}">إضافة إلى السلة</a>
            </div>
            <div>
                <a href="{{ route('showuseroffer') }}" class="btn btn-primary btn-block mb-2">عودة الى الصفحة السابقة</a>
            </div>
            @else
            <div class="mb-3">
                <a class="btn btn-primary btn-block mb-2" href="{{ route('login') }}">من فضلك سجل الدخول</a>
            </div>
            <div>
                <a href="{{ route('showuseroffer') }}" class="btn btn-primary btn-block mb-2">عودة الى الصفحة السابقة</a>
            </div>
            @endif
        </div>
    </div>
    
    </div>
  </div>
@endsection

@section('js')
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
@endsection

