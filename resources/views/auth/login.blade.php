<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - resturant</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/login_style.css') }}" />
    @livewireStyles
</head>
<body>
    <div id="loader" class="loader"></div>
    @livewire('login')
    @livewireScripts
    <script>
        window.addEventListener('load', function() {
    const loader = document.getElementById('loader');
    const content = document.querySelector('.content');
    
    // إخفاء علامة التحميل عند انتهاء التحميل
    loader.style.display = 'none';
    content.style.display = 'block';
});
    </script>
</body>
</html>
