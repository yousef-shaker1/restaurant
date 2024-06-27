
@extends('layout.master')

@section('title')
الرئيسية
@endsection
@section('css')

@livewireStyles
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
<div class="hero_area">
  <div class="bg-box">
    <img src="{{ asset('assets/images/hero-bg.jpg') }}" alt="">
  </div>

  <!-- end header section -->
  <!-- slider section -->
  <section class="slider_section ">
    <div id="customCarousel1" class="carousel slide" data-ride="carousel">
      <div class="carousel-inner">
        <div class="carousel-item active">
          <div class="container ">
            <div class="row">
              <div class="col-md-7 col-lg-6 ">
                <div class="detail-box">
                  <h1>
                    Fast Food Restaurant
                  </h1>
                  <p>
                    Doloremque, itaque aperiam facilis rerum, commodi, temporibus sapiente ad mollitia laborum quam quisquam esse error unde. Tempora ex doloremque, labore, sunt repellat dolore, iste magni quos nihil ducimus libero ipsam.
                  </p>
                  <div class="btn-box">
                    <a href="" class="btn1">
                      Order Now
                    </a>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="carousel-item ">
          <div class="container ">
            <div class="row">
              <div class="col-md-7 col-lg-6 ">
                <div class="detail-box">
                  <h1>
                    Fast Food Restaurant
                  </h1>
                  <p>
                    Doloremque, itaque aperiam facilis rerum, commodi, temporibus sapiente ad mollitia laborum quam quisquam esse error unde. Tempora ex doloremque, labore, sunt repellat dolore, iste magni quos nihil ducimus libero ipsam.
                  </p>
                  <div class="btn-box">
                    <a href="" class="btn1">
                      Order Now
                    </a>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="carousel-item">
          <div class="container ">
            <div class="row">
              <div class="col-md-7 col-lg-6 ">
                <div class="detail-box">
                  <h1>
                    Fast Food Restaurant
                  </h1>
                  <p>
                    Doloremque, itaque aperiam facilis rerum, commodi, temporibus sapiente ad mollitia laborum quam quisquam esse error unde. Tempora ex doloremque, labore, sunt repellat dolore, iste magni quos nihil ducimus libero ipsam.
                  </p>
                  <div class="btn-box">
                    <a href="" class="btn1">
                      Order Now
                    </a>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="container">
        <ol class="carousel-indicators">
          <li data-target="#customCarousel1" data-slide-to="0" class="active"></li>
          <li data-target="#customCarousel1" data-slide-to="1"></li>
          <li data-target="#customCarousel1" data-slide-to="2"></li>
        </ol>
      </div>
    </div>

  </section>
  <!-- end slider section -->
</div>

<!-- offer section -->

<section class="offer_section layout_padding-bottom">
  <div class="offer_container">
    <div class="container">
      <div class="row">
        @foreach($offers as $offer)
        <div class="col-md-6">
          <div class="box">
            <div class="img-box">
              <img src="{{ Storage::url($offer->image) }}" alt="{{ $offer->name }}">
            </div>
            <div class="detail-box">
              <h5>{{ $offer->name }}</h5>
              <h6><span>{{ $offer->price  }} EGP</span></h6>
              <a href="{{ route('offer.show', $offer->id) }}" class="order-now">
                Order Now 
                <svg version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 456.029 456.029" style="enable-background:new 0 0 456.029 456.029;" xml:space="preserve">
                  <g>
                    <g>
                      <path d="M345.6,338.862c-29.184,0-53.248,23.552-53.248,53.248c0,29.184,23.552,53.248,53.248,53.248
                       c29.184,0,53.248-23.552,53.248-53.248C398.336,362.926,374.784,338.862,345.6,338.862z" />
                    </g>
                  </g>
                  <g>
                    <g>
                      <path d="M439.296,84.91c-1.024,0-2.56-0.512-4.096-0.512H112.64l-5.12-34.304C104.448,27.566,84.992,10.67,61.952,10.67H20.48
                       C9.216,10.67,0,19.886,0,31.15c0,11.264,9.216,20.48,20.48,20.48h41.472c2.56,0,4.608,2.048,5.12,4.608l31.744,216.064
                       c4.096,27.136,27.648,47.616,55.296,47.616h212.992c26.624,0,49.664-18.944,55.296-45.056l33.28-166.4
                       C457.728,97.71,450.56,86.958,439.296,84.91z" />
                    </g>
                  </g>
                  <g>
                    <g>
                      <path d="M215.04,389.55c-1.024-28.16-24.576-50.688-52.736-50.688c-29.696,1.536-52.224,26.112-51.2,55.296
                       c1.024,28.16,24.064,50.688,52.224,50.688h1.024C193.536,443.31,216.576,418.734,215.04,389.55z" />
                    </g>
                  </g>
                  <g></g>
                  <g></g>
                  <g></g>
                  <g></g>
                  <g></g>
                  <g></g>
                  <g></g>
                  <g></g>
                  <g></g>
                  <g></g>
                  <g></g>
                  <g></g>
                  <g></g>
                  <g></g>
                  <g></g>
                  <g></g>
                </svg>
              </a>
            </div>
          </div>
        </div>
        @endforeach
      </div>
    </div>
  </div>
</section>


<!-- end offer section -->

<!-- food section -->
@if (session()->has('login'))
<div class="alert alert-danger alert-dismissible fade show" role="alert">
    <strong>{{ session()->get('login') }}</strong>
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
@endif

<!-- food section -->
<<<<<<< HEAD
<section class="food_section layout_padding-bottom">
  <div class="container">
    <div class="heading_container heading_center">
      <h2>كل الوجبات</h2>
    </div>
    <ul class="filters_menu">
      <li class="active" data-filter="*" onclick="showSection('all')">All</li>
      @foreach ($sections as $section)
      <li data-filter=".{{ $section->name }}" onclick="showSection('{{ $section->name }}')">{{ $section->name }}</li>
      @endforeach
    </ul>
    <div class="filters-content">
      <div class="row grid">
        @foreach ($prodects as $prodect)
        <div class="col-sm-6 col-lg-4 all {{ $prodect->section->name }}">
          <div class="box">
            <div class="img-box">
              <img src="{{ Storage::url($prodect->image) }}" style="width: 200px; height:200px; auto;">
            </div>
            <div class="detail-box">
              <h5>{{ $prodect->name }}</h5>
              <p>{{ $prodect->description }}</p>
              <div class="options">
                <h6>{{ $prodect->price }} EGP</h6>
                <a href="{{ route('order.show', $prodect->id) }}">
                  <svg version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 456.029 456.029" style="enable-background:new 0 0 456.029 456.029;" xml:space="preserve">
                    <g>
                      <g>
                        <path d="M345.6,338.862c-29.184,0-53.248,23.552-53.248,53.248c0,29.184,23.552,53.248,53.248,53.248 c29.184,0,53.248-23.552,53.248-53.248C398.336,362.926,374.784,338.862,345.6,338.862z" />
                      </g>
                    </g>
                    <g>
                      <g>
                        <path d="M439.296,84.91c-1.024,0-2.56-0.512-4.096-0.512H112.64l-5.12-34.304C104.448,27.566,84.992,10.67,61.952,10.67H20.48 C9.216,10.67,0,19.886,0,31.15c0,11.264,9.216,20.48,20.48,20.48h41.472c2.56,0,4.608,2.048,5.12,4.608l31.744,216.064 c4.096,27.136,27.648,47.616,55.296,47.616h212.992c26.624,0,49.664-18.944,55.296-45.056l33.28-166.4 C457.728,97.71,450.56,86.958,439.296,84.91z" />
                      </g>
                    </g>
                    <g>
                      <g>
                        <path d="M215.04,389.55c-1.024-28.16-24.576-50.688-52.736-50.688c-29.696,1.536-52.224,26.112-51.2,55.296 c1.024,28.16,24.064,50.688,52.224,50.688h1.024C193.536,443.31,216.576,418.734,215.04,389.55z" />
                      </g>
                    </g>
                  </svg>
                </a>
              </div>
            </div>
          </div>
        </div>
        @endforeach
      </div>
      <div class="pagination-wrapper mt-4">
        <ul class="pagination justify-content-center">
          <!-- زر الصفحة السابقة -->
          @if ($prodects->onFirstPage())
              <li class="page-item disabled"><span class="page-link">السابق</span></li>
          @else
              <li class="page-item"><a href="{{ $prodects->previousPageUrl() }}" class="page-link" rel="prev">السابق</a></li>
          @endif
  
          <!-- أرقام الصفحات -->
          @foreach(range(1, $prodects->lastPage()) as $page)
              <li class="page-item {{ $page == $prodects->currentPage() ? 'active' : '' }}">
                  <a href="{{ $prodects->url($page) }}" class="page-link">{{ $page }}</a>
              </li>
          @endforeach
  
          <!-- زر الصفحة التالية -->
          @if ($prodects->hasMorePages())
              <li class="page-item"><a href="{{ $prodects->nextPageUrl() }}" class="page-link" rel="next">التالي</a></li>
          @else
              <li class="page-item disabled"><span class="page-link">التالي</span></li>
          @endif
      </ul>
      </div>
    </div>
  </div>
</section>

=======
<livewire:productsPaginate  /> 
>>>>>>> test


<!-- end food section -->

<!-- about section -->

<section class="about_section layout_padding">
  <div class="container  ">

    <div class="row">
      <div class="col-md-6 ">
        <div class="img-box">
          <img src="{{ asset('assets/images/about-img.png') }}" alt="">
        </div>
      </div>
      <div class="col-md-6">
        <div class="detail-box">
          <div class="heading_container">
            <h2>
              We Are Feane
            </h2>
          </div>
          <p>
            There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration
            in some form, by injected humour, or randomised words which don't look even slightly believable. If you
            are going to use a passage of Lorem Ipsum, you need to be sure there isn't anything embarrassing hidden in
            the middle of text. All
          </p>
          <a href="">
            Read More
          </a>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- end about section -->

<!-- book section -->
<section class="book_section layout_padding">
  <div class="container">
    <div class="heading_container">
      <h2>
        Book A Table
      </h2>
    </div>
    <div class="row">
      <div class="col-md-6">
        <div class="form_container">
          <form action="">
            <div>
              <input type="text" class="form-control" placeholder="Your Name" />
            </div>
            <div>
              <input type="text" class="form-control" placeholder="Phone Number" />
            </div>
            <div>
              <input type="email" class="form-control" placeholder="Your Email" />
            </div>
            <div>
              <select class="form-control nice-select wide">
                <option value="" disabled selected>
                  How many persons?
                </option>
                <option value="">
                  2
                </option>
                <option value="">
                  3
                </option>
                <option value="">
                  4
                </option>
                <option value="">
                  5
                </option>
              </select>
            </div>
            <div>
              <input type="date" class="form-control">
            </div>
            <div class="btn_box">
              <button>
                Book Now
              </button>
            </div>
          </form>
        </div>
      </div>
      <div class="col-md-6">
        <div class="map_container ">
          <div id="googleMap"></div>
        </div>
      </div>
    </div>
  </div>
</section>  <!-- end book section -->

  <!-- client section -->

  <section class="client_section layout_padding-bottom">
    <div class="container">
      <div class="heading_container heading_center psudo_white_primary mb_45">
        <h2>
          What Says Our Customers
        </h2>
      </div>
      <div class="carousel-wrap row ">
        <div class="owl-carousel client_owl-carousel">
          <div class="item">
            <div class="box">
              <div class="detail-box">
                <p>
                  Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam
                </p>
                <h6>
                  Moana Michell
                </h6>
                <p>
                  magna aliqua
                </p>
              </div>
              <div class="img-box">
                <img src="{{ asset('assets/images/client1.jpg') }}" alt="" class="box-img">
              </div>
            </div>
          </div>
          <div class="item">
            <div class="box">
              <div class="detail-box">
                <p>
                  Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam
                </p>
                <h6>
                  Mike Hamell
                </h6>
                <p>
                  magna aliqua
                </p>
              </div>
              <div class="img-box">
                <img src="{{ asset('assets/images/client2.jpg') }}" alt="" class="box-img">
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  
  @endsection
  
  
  @section('js')
<<<<<<< HEAD
  <script>
    function showSection(sectionName) {
    // إخفاء جميع عناصر البيانات
    var allProducts = document.querySelectorAll('.grid .col-sm-6');
    allProducts.forEach(function(product) {
      product.style.display = 'none';
    });
=======
  @livewireScripts
  
>>>>>>> test

    // عرض بيانات القسم المحدد
    var selectedSectionProducts = document.querySelectorAll('.grid .col-sm-6.' + sectionName);
    selectedSectionProducts.forEach(function(product) {
      product.style.display = 'block';
    });

    // تحديث حالة التصفية النشطة
    var filters = document.querySelectorAll('.filters_menu li');
    filters.forEach(function(filter) {
      filter.classList.remove('active');
    });

    document.querySelector('.filters_menu li[data-filter=".' + sectionName + '"]').classList.add('active');
  }

  // عرض جميع المنتجات عند تحميل الصفحة لأول مرة
  document.addEventListener('DOMContentLoaded', function() {
    showSection('all');
  });
  </script>
  
  @endsection


