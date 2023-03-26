@extends('layouts.themewagon')

@section('section')

<section class="py-0" id="header">
  <div class="bg-holder d-none d-md-block" style="background-image:url({{ asset('themewagon/assets/img/illustrations/hero-header.png') }});background-position:right top;background-size:contain;">
  </div>
  <!--/.bg-holder-->

  <div class="bg-holder d-md-none" style="background-image:url({{ asset('themewagon/assets/img/illustrations/hero-bg.png') }});background-position:right top;background-size:contain;">
  </div>
  <!--/.bg-holder-->

  <div class="container">
    <div class="row align-items-center min-vh-75 min-vh-lg-100">
      <div class="col-md-7 col-lg-6 col-xxl-5 py-6 text-sm-start text-center">
        <h1 class="mt-6 mb-sm-4 fw-semi-bold lh-sm fs-4 fs-lg-5 fs-xl-6">Petani 4.0 <br class="d-block d-lg-block" />Petani Bawang Merah Indonesia</h1>
        <p class="mb-4 fs-1">Aplikasi Petani Bawang Merah Indonesia yang terkoneksi dengan Artificial Intelligence dan Internet of Things Pertama  di Indonesia</p><a class="btn btn-lg btn-success" href="{{ route('register') }}" role="button">Gabung Sekarang</a>
      </div>
    </div>
  </div>
</section>
<section class="py-5" id="Opportuanities">
  <div class="bg-holder d-none d-sm-block" style="background-image:url(assets/img/illustrations/bg.png);background-position:top left;background-size:225px 755px;margin-top:-17.5rem;">
  </div>
  <!--/.bg-holder-->

  
  </div>
</section>


<!-- ============================================-->
<!-- <section> begin ============================-->
<section class="py-5" id="invest">

  
  <!-- end of .container-->

</section>
<!-- <section> close ============================-->
<!-- ============================================-->


<section class="py-0">
  <div class="bg-holder" style="background-image:url(assets/img/illustrations/how-it-works.png);background-position:center bottom;background-size:cover;">
  </div>
  <!--/.bg-holder-->

  
    </div>
  </div>
</section>


<!-- ============================================-->
<!-- <section> begin ============================-->

<!-- <section> close ============================-->
<!-- ============================================-->


<section class="py-0" id="contact">
  <div class="bg-holder" style="background-image:url({{ asset('themewagon/assets/img/illustrations/footer-bg.png') }});background-position:center;background-size:cover;">
  </div>
  <!--/.bg-holder-->

  <div class="container">
    <hr class="text-300 mb-0" />
    <div class="row flex-center py-5">
      <div class="col-12 col-sm-8 col-md-6 text-center text-md-start"> <a class="text-decoration-none" href="#"><img class="d-inline-block align-top img-fluid" src="assets/img/gallery/logo-icon.png" alt="" width="40" /><span class="text-theme font-monospace fs-3 ps-2">Zou</span></a></div>
      <div class="col-12 col-sm-8 col-md-6">
        <p class="fs--1 text-dark my-2 text-center text-md-end">&copy; Dibuat Oleh Team &nbsp;
          <svg class="bi bi-suit-heart-fill" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="#76C279" viewBox="0 0 16 16">
            <path d="M4 1c2.21 0 4 1.755 4 3.92C8 2.755 9.79 1 12 1s4 1.755 4 3.92c0 3.263-3.234 4.414-7.608 9.608a.513.513 0 0 1-.784 0C3.234 9.334 0 8.183 0 4.92 0 2.755 1.79 1 4 1z"></path>
          </svg>&nbsp;by&nbsp;<a class="text-dark" href="https://themewagon.com/" target="_blank">Center Of Exccellence UDINUS</a>
        </p>
      </div>
    </div>
  </div>
</section>

@endsection
