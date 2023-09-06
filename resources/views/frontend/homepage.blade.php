@extends('layouts.frontend')

@section('content')
    <!-- Breadcrumb Section Begin -->
    <section class="mb-5">
      <div class="container">
          <div class="hero__item set-bg" data-setbg="{{ asset('frontend/img/hero/banner.jpg') }}">
              <div class="hero__text">
                  <span>Eco-Greens</span>
                  <h2>Bringing Nature to <br/>Your Doorstep.</h2>
                  <p>Delivery all over Nepal at just 100</p> 
                  <a href="{{ route('shop.index') }}" class="primary-btn">SHOP NOW</a>
              </div>
          </div>
      </div>
    </section>
      <!-- Breadcrumb Section End -->

    <!-- Categories Section Begin -->
    <section class="categories">
      <div class="container">
        <div class="row">
          <div class="categories__slider owl-carousel">
            @foreach($menu_categories as $menu_category)
              <div class="col-lg-3">
                <div
                  class="categories__item set-bg"
                  data-setbg="{{ $menu_category->photo->getUrl() }}"
                >
                  <h5><a href="{{ route('shop.index', $menu_category->slug) }}">{{ $menu_category->name }}</a></h5>
                </div>
              </div>
            @endforeach
          </div>
        </div>
      </div>
    </section>
    <!-- Categories Section End -->

    <!-- Featured Section Begin -->
    <section class="featured spad">
      <div class="container">
        <div class="row">
          <div class="col-lg-12">
            <div class="section-title">
              <h2>Featured Product</h2>
            </div>
          </div>
        </div>
        <div class="row featured__filter" id="product-list">
        </div>
      </div>
    </section>
    <!-- Featured Section End -->

    <!-- Banner Begin -->
    {{-- <div class="banner">
      <div class="container">
        <div class="row">
          <div class="col-lg-6 col-md-6 col-sm-6">
            <div class="banner__pic">
              <img src="{{ asset('frontend/img/banner/banner-1.jpg') }}" alt="" />
            </div>
          </div>
          <div class="col-lg-6 col-md-6 col-sm-6">
            <div class="banner__pic">
              <img src="{{ asset('frontend/img/banner/banner-2.jpg') }}" alt="" />
            </div>
          </div>
        </div>
      </div>
    </div> --}}
    <!-- Banner End -->
@endsection
