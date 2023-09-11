<head>
  @laravelPWA
</head>
<body>

 
  @include('layouts.frontend.app')
  <!-- End Header -->

  <!-- ======= Hero Section ======= -->
  <section id="hero" class="hero">
    <div class="container position-relative">
      <div class="row gy-5" data-aos="fade-in">
        <div class="col-lg-6 order-2 order-lg-1 d-flex flex-column justify-content-center text-center text-lg-start">
          <h2>Selamat Datang di SimpanKas<span class="orange-dot">.</span></h2>

<style>
  .orange-dot {
    color: #f96f59;
  }
  body {
        height: 100vh;
        }
</style>


      {{-- <div class="card mb-3" style="background-color: #00ff33)">
        <div class="card-body">
          Kas Masuk
        </div>
      </div>

      <div class="card mb-3" style="background-color: #CC3A3D">
        <div class="card-body" >
          Kas Keluar
        </div>
      </div>

      <div class="card mb-3" style="background-color: #8AB8A2">
        <div class="card-body" >
          Total Pendapatan
        </div>
      </div> --}}
     
          <div class="d-flex justify-content-center justify-content-lg-start">
           
          </div>
        </div>
        <div class="col-lg-6 order-1 order-lg-2">
          <img src="assets/img/hero-img.png" class="img-fluid" alt="" data-aos="zoom-out" data-aos-delay="100">
        </div>
      </div>
    </div>

    <div class="icon-boxes position-relative mt-5" style="background-color: rgb(255, 255, 255);">
      <div class="container position-relative">
        <div class="row gy-4 mt-5 justify-content-center">
          
          <div class="col-xl-3 col-md-6" data-aos="fade-up" data-aos-delay="500">
            <div class="icon-box">
              <div class="icon"><i class="bi bi-upc"></i></div>
              <h4 class="title"><a href="/account" class="stretched-link">Kelola Kode Akun</a></h4>
            </div>
          </div><!--End Icon Box -->

          <div class="col-xl-3 col-md-6" data-aos="fade-up" data-aos-delay="100">
            <div class="icon-box">
              <div class="icon"><i class="bi bi-house-add"></i></div>
              <h4 class="title"><a href="/asset" class="stretched-link">Aset</a></h4>
            </div>
          </div><!--End Icon Box -->
    
    
          <div class="col-xl-3 col-md-6" data-aos="fade-up" data-aos-delay="300">
            <div class="icon-box">
              <div class="icon"><i class="bi bi-cash-coin"></i></div>
              <h4 class="title"><a href="/income" class="stretched-link">Pendapatan</a></h4>
            </div>
          </div><!--End Icon Box -->
    
          <div class="col-xl-3 col-md-6" data-aos="fade-up" data-aos-delay="500">
            <div class="icon-box">
              <div class="icon"><i class="bi bi-cash"></i></div>
              <h4 class="title"><a href="/expenditure" class="stretched-link">Pengeluaran</a></h4>
            </div>
          </div><!--End Icon Box -->
    
    
          <div class="col-xl-3 col-md-6" data-aos="fade-up" data-aos-delay="500">
            <div class="icon-box">
              <div class="icon"><i class="bi bi-credit-card"></i></div>
              <h4 class="title"><a href="/debt" class="stretched-link">Catatan Hutang</a></h4>
            </div>
          </div><!--End Icon Box -->
          
          <div class="col-xl-3 col-md-6" data-aos="fade-up" data-aos-delay="500">
            <div class="icon-box">
              <div class="icon"><i class="bi bi-receipt"></i></div>
              <h4 class="title"><a href="/receivables" class="stretched-link">Catatan Piutang</a></h4>
            </div>
          </div><!--End Icon Box -->
          
        </div><!--End row-->
      </div><!--End container-->
    </div><!--End icon-boxes-->
    
    
    </div>

    </div>
  </section>

<!-- End Hero Section -->

</body>

</html>
<script>
  if (!navigator.serviceWorker.controller) {
      navigator.serviceWorker.register("/sw.js").then(function (reg) {
          console.log("Service worker has been registered for scope: " + reg.scope);
      });
  }
</script>