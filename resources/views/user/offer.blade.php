@extends('layout.master')

@section('title')
العروض
@endsection

@section('css')
<style>
.offer_section {
  background-color: #ffffff;
  padding: 50px 0; /* مساحة حول القسم */
}

.offer_container .box {
  border: 1px solid #ddd; /* إطار خفيف */
  border-radius: 8px; /* زوايا مدورة */
  overflow: hidden; /* لمنع تجاوز المحتوى */
  background-color: #232235;
  color: #fff; /* لون النص أبيض للتباين */
  transition: transform 0.3s ease; /* حركة عند التحويم */
}

.offer_container .box:hover {
  transform: scale(1.05); /* تكبير عند التحويم */
}

.offer_container .img-box {
  display: flex;
  justify-content: center;
  align-items: center;
  margin: 20px 0; /* مسافة حول الصورة */
}

.offer_container .img-box img {
  width: 200px; /* حجم مخصص للصورة */
  height: 200px; /* حجم مخصص للصورة */
  border-radius: 50%; /* لجعل الصورة دائرية */
  object-fit: cover; /* لضمان احتواء الصورة بشكل جيد داخل العنصر */
}

.offer_container .detail-box {
  padding: 20px; /* مساحة داخلية للنص */
  text-align: center; /* محاذاة النص في الوسط */
}

.offer_container .detail-box h5 {
  font-size: 24px; /* حجم خط العنوان */
  margin-bottom: 10px; /* مسافة أسفل العنوان */
  color: #fff; /* لون النص أبيض */
}

.offer_container .detail-box h6 {
  font-size: 20px; /* حجم خط النسبة */
  color: #e74c3c; /* لون مميز للنسبة */
  margin-bottom: 20px; /* مسافة أسفل النسبة */
}

.offer_container .order-now {
  display: inline-block; /* محاذاة الزر */
  padding: 10px 20px; /* مساحة داخلية للزر */
  background-color: #3498db; /* لون خلفية الزر */
  color: #fff; /* لون النص للزر */
  border-radius: 4px; /* زوايا مدورة للزر */
  text-decoration: none; /* إزالة الخط تحت النص */
  transition: background-color 0.3s ease; /* حركة عند التحويم */
}

.offer_container .order-now:hover {
  background-color: #2980b9; /* لون عند التحويم */
}

.offer_container .order-now svg {
  width: 16px; /* حجم أيقونة السلة */
  height: 16px; /* حجم أيقونة السلة */
  margin-left: 8px; /* مسافة بين النص والأيقونة */
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
              <h6><span>{{ $offer->price  }} $</span></h6>
              <a href="{{ route('offer.show', $offer->id) }}" class="order-now">Order Now
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

@endsection

@section('js')

<script>
  function showSection(sectionName) {
    // إخفاء جميع عناصر البيانات
    var allProducts = document.querySelectorAll('.grid .col-sm-6');
    allProducts.forEach(function(product) {
      product.style.display = 'none';
    });

    // عرض بيانات القسم المحدد
    var selectedSectionProducts = document.querySelectorAll('.grid .col-sm-6.' + sectionName);
    selectedSectionProducts.forEach(function(product) {
      product.style.display = 'block';
    });
  }
</script>
@endsection