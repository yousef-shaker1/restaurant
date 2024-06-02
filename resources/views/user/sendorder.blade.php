<!DOCTYPE html>
<html lang="ar">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>صفحة عرض المنتج</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <style>
        body {
            font-family: 'Arial', sans-serif;
            direction: rtl;
            text-align: right;
            background-color: #000;
            /* اللون الأسود */
            color: #fff;
            /* النص الأبيض لتحسين القراءة على الخلفية السوداء */
            margin: 0;
            padding: 0;
        }

        .container {
            margin-top: 50px;
        }

        .product-img {
            max-width: 100%;
            height: auto;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.3);
        }

        .product-form,
        .product-details {
            background-color: #ff8c00;
            /* اللون البرتقالي */
            padding: 20px;
            border-radius: 20px;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.2);
            margin-top: 20px;
        }

        .product-form h2,
        .product-details h2 {
            font-size: 24px;
            margin-bottom: 15px;
        }

        .product-form .form-group,
        .product-details p {
            margin-bottom: 15px;
        }

        .btn-primary {
            background-color: #0056b3;
            border: none;
            padding: 10px 20px;
            font-size: 16px;
            border-radius: 4px;
            transition: background-color 0.3s;
        }

        .btn-primary:hover {
            background-color: #004494;
        }

        #customButton {
        background-color: #6772e5;
        color: white;
        padding: 10px 20px;
        font-size: 16px;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        transition: background-color 0.3s ease;
        }

        #customButton:hover {
            background-color: #5469d4;
        }
    </style>
</head>

<body>
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
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <img src="{{ Storage::url($prodect->image) }}" alt="صورة المنتج" class="product-img">
                <div class="product-details mt-4">
                    <h2>اسم المنتج: {{ $prodect->name }}</h2>
                    <p>تفاصيل المنتج: هذا المنتج هو عبارة عن {{ $prodect->description }}</p>
                    <p>السعر: EGP{{ $prodect->price }}</p>
                    <a href="{{ route('Basketall') }}" class="btn btn-primary">عودة الي الصفحة السابقة</a>
                    <a href="{{ route('showuseroffer') }}" class="btn btn-primary">عودة الي صفحة جميع العروض</a>
                </div>
            </div>
            <div class="col-md-6">
                <div class="product-form">
                    <h2>طلب اوردر</h2>
                    <form action="{{ route('poststripe') }}" method="POST" id="payment-form">
                        @csrf
                        <div class="form-group">
                            <input type="hidden" id="id" name="id" value="{{ $prodect->id }}">
                            <label for="date">تاريخ المنتج</label>
                            <input type="date" class="form-control" id="date" name="date" value="{{ $prodect->date }}">
                        </div>
                        <div class="form-group">
                            <label for="time">وقت المنتج</label>
                            <input type="time" class="form-control" id="time" name="time" value="{{ $prodect->time }}">
                        </div>
                        <div class="form-group">
                            <label for="quantity">عدد المنتجات</label>
                            <button type="button" onclick="changeQuantity(-1)">-</button>
                            <span id="quantity" class="quantity-value">1</span>
                            <button type="button" onclick="changeQuantity(1)">+</button>
                            <input type="hidden" id="count" name="count" value="1">
                        </div>
                        <div class="form-group">
                            <div>الإجمالي المبلغ : EGP <span id="total">{{ $prodect->price }} </span></div>
                        </div>
                        <button type='submit' class="btn btn-primary">pay with stripe</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script src="https://checkout.stripe.com/checkout.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

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
</body>

</html>
