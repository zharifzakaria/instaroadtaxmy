<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require('./config.php');
include("./layouts/header.php");

// require("./email.php"); //dev
require(ABS_PATH . '/email.php'); //prod
?>

<body>
  <!-- Navigation -->
  <?php include("./layouts/nav.php"); ?>

  <!-- Hero -->
  <div id="hero" class="container-fluid">
    <div class="row flex-column flex-lg-row align-items-center justify-content-center">
      <div class="col-12 col-lg-6 col-xl-5 d-none d-lg-block">
        <img src="./img/img-hero.png" alt="img hero" class="img-fluid">
      </div>
      <div class="col-12 col-lg-4 col-xl-3 mt-50 p-25">
        <h1 class="pb-2 fw-bolder display-6">
          Dapatkan sebutharga insuran dan cukai jalan dalam 5 minit!*
        </h1>
        <p class="card-text py-1">Isikan maklumat kenderaan anda.</p>
        <?php include('./reqform.php'); ?>
      </div>
    </div>
    <div class="row d-block d-lg-none">
      <img class="p-0 pt-50 pt-lg-0" src="./img/img-hero.png" alt="img hero" style="object-fit: none; object-position: 85% 31%; width:100%;">
    </div>
  </div>

  <!-- <img src="./img/img-hero.png" alt="img hero" style="object-fit: none; object-position: 85% 31%; width:100%;"> -->


  <div id="panelInsuran" class="container text-center mb-25 mb-lg-50 mt-50 mt-lg-0 pt-15">
    <h4>Panel Insuran Bersama</h4>
    <img class="px-50 px-lg-50 img-fluid mt-25 mt-lg-0" width="400" src="./img/etiqa_logo.png" alt="etiqa takaful" />
    <img class="px-50 px-lg-50 img-fluid mt-4 mt-lg-0" width="600" src="./img/zurich.webp" alt="zurich insurance" />
  </div>

  <div class="feature container-fluid py-10 py-lg-50">
    <h2 class="fw-bold pt-3 text-center py-5 py-lg-25 text-customblue">Kelebihan InstaRoadtax</h2>
    <div class="container">
      <div class="row flex-wrap flex-lg-nowrap">
        <div class="box col-12 col-lg-4">
          <div class="card border-0 p-10 p-lg-30 mt-25 mt-lg-0">
            <img src="./img/icon-benefits-1.png" class="pb-4" alt="benefits1" width="90">
            <h6 class="fw-bold text-customblue fs-20">
              Harga terendah atau perlindungan menyeluruh.
            </h6>
            <p>
              <small>Dapatkan perlindungan dengan harga terendah atau menyeluruh,
                sesuai dengan pilihan anda.</small>
            </p>
          </div>
        </div>
        <div class="box col-12 col-lg-4">
          <div class="card border-0 p-10 p-lg-30 mt-25 mt-lg-0">
            <img src="./img/icon-benefits-2.png" class="pb-4" alt="benefits1" width="90">
            <h6 class="fw-bold text-customblue fs-20">
              Peringatan secara automatik.
            </h6>
            <p>
              <small>Tidak perlu menyimpan rekod pembaharuan insuran setiap tahun.
                Kami akan emel terus kepada anda.</small>
            </p>
          </div>
        </div>
        <div class="box col-12 col-lg-4">
          <div class="card border-0 p-10 p-lg-30 mt-25 mt-lg-0">
            <img src="./img/icon-benefits-1.png" class="pb-4" alt="benefits1" width="90">
            <h6 class="fw-bold text-customblue fs-20">
              Beli terus secara online atau melalui Whatsapp
            </h6>
            <p>
              <small>Perbaharui insuran hanya dari rumah. Buat sendiri atau dapatkan
                bantuan dari kami.</small>
            </p>
          </div>
        </div>
      </div>
      <div class="d-flex justify-content-center align-items-center">
        <a id="trynow" href="#cta2target"><button type="button" class="btn btn-warning btn-lg btn-block rounded-pill text-white fw-bold px-50 px-lg-150">
            Cuba Sekarang
          </button></a>
      </div>
    </div>
  </div>

  <div id="cta2target"></div>

  <div id="cta2" class="container my-25 my-lg-100">
    <div class="row justify-content-around">
      <div class="col-11 col-lg-4 bg-white p-4 mb-50 border border-1 border-gray rounded-3 order-1">
        <?php include('./reqform.php'); ?>
      </div>
      <div class="col-12 col-lg-6">
        <h2 class="fw-bold text-customblue">Apa yang ditunggu lagi? Dapatkan sebutharga insuran dan cukai jalan sekarang!</h2>
        <p class="py-15">Masih lagi tidak pasti apa yang perlu dilakukan atau anda mempunyai sebarang pertanyaan?</p>
        <p><a href="#faqs">Lihat Soalan Lazim</a> atau <a href="https://wa.me/60102317905">Hubungi Kami</a>.</p>
      </div>
    </div>

  </div>

  <!-- Soalan Lazim -->
  <?php include('./components/faqs.php'); ?>

  <!-- Footer -->
  <?php include("./layouts/footer.php"); ?>
</body>

<script>
  $(document).ready(function() {
    $("#submitReq").click(function() {
      if ($(".form-control:valid").length == 6) {
        $(this).text('');
        $(this).append('<div class="spinner-border spinner-border-sm"></div> Loading..');
      }
    });
  });

  //add white background to navbar after scrolling
  var scrollpos = window.scrollY;
  var header = document.getElementById("nav");

  function add_class_on_scroll() {
    header.classList.add("bg-white");
  }

  function remove_class_on_scroll() {
    header.classList.remove("bg-white");
  }

  window.addEventListener('scroll', function() {
    scrollpos = window.scrollY;
    if (scrollpos > 10) {
      add_class_on_scroll();
    } else {
      remove_class_on_scroll();
    }
  });
</script>

</html>