@extends('layout.master')
@section('title')
عنا
@endsection
@section('css')
<style>
  .header_section {
    background-color: black;
  }
</style>
@endsection

@section('content')

<!-- about section -->

<section class="about_section layout_padding">
  <div class="container  ">
    @if (session()->has('login'))
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <strong>{{ session()->get('login') }}</strong>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    @endif

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


@endsection

@section('js')

@endsection