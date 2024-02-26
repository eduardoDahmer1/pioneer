@extends('front.themes.' . env('THEME', 'theme-01') . '.layout')
@section('content')
<!-- Breadcrumb Area Start -->
<div class="breadcrumb-area mt-0">
  <div class="container">
    <div class="row">
      <div class="col-lg-12">
        <ul class="pages">
          <li>
            <a href="{{route('front.index')}}">{{ __("Home") }}</a>
          </li>
          <li>
            <a href="{{route('front.brands')}}">{{ __("Brands") }}</a>
          </li>
          <li>
            <a href="{{route('front.brand', $brand->slug)}}">{{ $brand->name }}</a>
          </li>
        </ul>
      </div>
    </div>
  </div>
</div>
<!-- Breadcrumb Area End -->
<!-- SubCategori Area Start -->
@if($brand->banner)
<div class="row m-auto" style="background-color: #fff">
  <div class="col-lg-12 text-center m-auto">
    <div class="intro-content ">
      <img src="{{asset('storage/images/brands/banners/'.$brand->banner)}}" style="max-width: 250px !important;">
    </div>
  </div>
</div>
@endif
<section class="sub-categori">
  <div class="container-fluid">
    <div class="row w-90 mx-auto">
      <div class="col-lg-8 col-xl-9 mx-auto order-first order-lg-last ajax-loader-parent">
        <div class="right-area" id="app">
          @include('includes.filter')
          <div class="categori-item-area mt-2">
            <div class="row mt-2 justify-content-center justify-content-lg-center brands-row" id="ajaxContent">
                <div class="col-12 remove-padding mx-auto w-100 d-flex justify-content-center justify-content-lg-start flex-wrap ">
                  @if (env('THEME') === 'theme-09')
                    @include('front.themes.theme-09.components.filtered-products')
                  @else
                      @include('includes.product.filtered-products')
                  @endif
              </div> 
            </div>
            <div id="ajaxLoader" class="ajax-loader"
              style="background: url({{asset('storage/images/'.$gs->loader)}}) no-repeat scroll center center rgba(0,0,0,.6);">
            </div>
          </div>

        </div>
      </div>
    </div>
  </div>
</section>
<!-- SubCategori Area End -->
@endsection

@section('scripts')
<script>
  $(document).ready(function() {
    addToPagination();

    $("#qty").on('change', function(){
        $("#ajaxLoader").show();
        filter();
      });

// when dynamic attribute changes
$("#sortby").on('change', function() {
  filter();
});

// when price changed & clicked in search button
$(".filter-btn").on('click', function(e) {
  e.preventDefault();
  $("#ajaxLoader").show();
  filter();
});
});

  function filter() {
    let filterlink = '';

    if( $("#qty").val() != ''){
      if (filterlink == '') {
        filterlink += '{{route('front.brand', [Request::route('brand')])}}' + '?'+$("#qty").attr('name')+'='+$("#qty").val();
      } else {
        filterlink += '&'+$("#qty").attr('name')+'='+$("#qty").val();
      }
    }

    if ($("#sortby").val() != '') {
      if (filterlink == '') {
        filterlink += '{{route('front.brand', $brand->slug)}}' + '?'+$("#sortby").attr('name')+'='+$("#sortby").val();
      } else {
        filterlink += '&'+$("#sortby").attr('name')+'='+$("#sortby").val();
      }
    }


    window.location.href = encodeURI(filterlink);
  }

  function addToPagination() {
    // add to attributes in pagination links
    $('ul.pagination li a').each(function() {
      let url = $(this).attr('href');
      let queryString = '?' + url.split('?')[1]; // "?page=1234...."

      let urlParams = new URLSearchParams(queryString);
      let page = urlParams.get('page'); // value of 'page' parameter

      let fullUrl = '{{route('front.brand', $brand->slug)}}?page='+page;

      if($("#qty").val() != ''){
        fullUrl += '&qty='+encodeURI($("#qty").val());
      }
      if ($("#sortby").val() != '') {
        fullUrl += '&sort='+encodeURI($("#sortby").val());
      }

      $(this).attr('href', fullUrl);
    });
  }
</script>
@endsection
