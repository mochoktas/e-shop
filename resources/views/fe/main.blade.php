<!DOCTYPE html>
<html>

<head>
  <!-- Basic -->
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <!-- Mobile Metas -->
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
  <!-- Site Metas -->
  <meta name="keywords" content="" />
  <meta name="description" content="" />
  <meta name="author" content="" />
  <link rel="shortcut icon" href="images/favicon.png" type="">

  <title> @yield('title_page') </title>

  <!-- bootstrap core css -->
  @include('fe/css_global')
  @yield('css_custom')


</head>

<body>

  <div class="hero_area">
    <div class="bg-box">
      <img src="{{asset('assets_front/images/hero-bg.jpg')}}" alt="">
    </div>
    <!-- header section strats -->
    @include('fe/header')
    <!-- end header section -->
    <section class="food_section layout_padding">
    <div class="container">
      <div class="heading_container heading_center">
        <h2>
          @yield('title')
        </h2>
      </div>
        @yield('content')
      
    </div>
  </section>
    
    

  <!-- footer section -->
  @include('fe/footer')
  <!-- footer section -->

  include('fe/js_global')
  @yield('js_custom')

</body>

</html>