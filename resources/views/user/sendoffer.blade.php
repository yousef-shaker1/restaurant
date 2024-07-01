@extends('layout.master')

@section('title')
شراء العرض
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
@if (session()->has('error'))
<div class="alert alert-danger alert-dismissible fade show" role="alert">
    <strong>{{ session()->get('error') }}</strong>
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
@endif
@if ($errors->any())
    <ul>
        @foreach ($errors->all() as $error)
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong>{{ $error }}</strong>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endforeach
    </ul>
@endif
<div class="container mt-5">
    <div class="row">
        <div class="col-md-8">
            <h2>Shopping Cart</h2>
            <div class="card mb-3">
                <div class="card-body">
                    <table class="table table-hover">
          <thead>
            <tr>
                <th>Image</th>
              <th>offer name</th>
              <th>description</th>
              <th>Price</th>
            </tr>
          </thead>
          <tbody>
            <tr>
                <td>
                  <a href='{{ Storage::url($prodect->image) }}'>
                      <img src="{{ Storage::url($prodect->image) }}" alt="صورة المنتج" class="product-img" style="width: 100px; height:100px auto;">
                  </a> 
               </td>
              <td>{{ $prodect->name }}</td>
              <td>{{ $prodect->description }}</td>
              <td>{{ $prodect->price }} $</td>
              
            </tr>
            <!-- End of product row -->
          </tbody>
        </table>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card mb-3">
                <div class="card-body">
                    <h5 class="card-title">Cart Summary</h5>
                    <form action="{{ route('okorderoffer') }}" method="POST" id="payment-form">
                        @csrf
                        <input type="hidden" id="id" name="id" value="{{ $prodect->id }}" >
                        <div class="form-group">
                            <label for="date">تاريخ وصول العرض</label>
                            <input type="date" class="form-control" id="date" name="date" value="{{ $prodect->date }}" >
                        </div>
                        <div class="form-group">
                            <label for="time">وقت وصول العرض</label>
                            <input type="time" class="form-control" id="time" name="time" value="{{ $prodect->time }}">
                        </div>
                        <div class="form-group">
                            <label for="quantity">عدد العروض</label>
                            <div class="form-group">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <button class="btn btn-outline-secondary" type="button" onclick="changeQuantity(-1)">-</button>
                                    </div>
                                    <span id="quantity" class="form-control quantity-value d-inline-block py-1 px-2">1</span>
                                    <div class="input-group-append">
                                        <button class="btn btn-outline-secondary" type="button" onclick="changeQuantity(1)">+</button>
                                    </div>
                                    <input type="hidden" id="count" name="count" value="1">
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div>اجمالي المبلغ : <span id="total">${{ $prodect->price }} </span></div>
                        </div>
                        <button type='submit' class="btn btn-primary btn-block">الدفع باستخدام سترايب</button>
                        <a class="btn btn-primary btn-block" href="{{ route('Basketall') }}">العودة الي الصفحة السابقة</a>
                    </form>
                    
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@section('js')
<script src="https://checkout.stripe.com/checkout.js"></script>
<script>
    function changeQuantity(amount) {
        const quantityElement = document.getElementById('quantity');
        let quantity = parseInt(quantityElement.textContent) + amount;
        if (quantity < 1) {
            quantity = 1;
        }
        quantityElement.textContent = quantity;

        const countInput = document.getElementById('count');
        countInput.value = quantity;

        updateTotal();
    }

    function updateTotal() {
        const quantity = parseInt(document.getElementById('quantity').textContent);
        const price = parseFloat("{{ $prodect->price }}"); // تحويل السعر إلى رقم عائم
        const total = quantity * price;
        document.getElementById('total').textContent = total;
        // تحديث قيمة data-amount
        document.querySelector('.stripe-button').setAttribute('data-amount', total * 100);
    }
</script>
@endsection


