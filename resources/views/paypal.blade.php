<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <title>Document</title>
</head>

<body>
  <form action="{{ route('poststripe') }}" method="post" id="payment-form">
    @csrf
    {{-- <script 
        src="https://checkout.stripe.com/checkout.js" 
        class="stripe-button"
        data-key="{{ env('STRIPE_KEY') }}"
        data-amount="100"
        data-name="Demo Site"
        data-description="Payment for demo"
        data-image="../../storage/app/public/photo/3cUaz4V2iKcQQdcUJY87bZHnCSzPvp0NuXMRXUf7.png"
        data-locale="auto"
        data-currency="usd">
    </script> --}}
    <button type='submit'>Checkout</button>
</form>
</body>

</html>
