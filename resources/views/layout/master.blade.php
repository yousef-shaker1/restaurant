@include('layout.header')
@include('layout.main-header')
</head>

<body>
  @yield('img')
  {{-- @can('userpage') --}}
  @include('layout.nav')
  {{-- @endcan --}}

    <!-- end header section -->
  @yield('content')
  <!-- end client section -->
  
  
  {{-- @can('userpage') --}}
 <!-- footer section -->
 @include('layout.footer')
 {{-- @endcan --}}

  <!-- footer section -->

@include('layout.main-footer')

</body>

</html>