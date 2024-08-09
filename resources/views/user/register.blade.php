<!DOCTYPE html>
<html lang="en">
<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register-restaurant</title>
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/register_style.css') }}" />
    @livewireStyles
</head>
<body>
    <div id="loader" class="loader"></div>
    @livewire('Register')
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