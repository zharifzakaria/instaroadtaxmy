<nav id="nav" class="navbar navbar-expand-lg navbar-light fixed-top">
  <div class="container">
    <a class="navbar-brand primary-font" href="../"><img width="28" src="../img/irm_logo.svg" alt=""> <strong>InstaRoadtax<span style="color:#554df0;">.my</span></strong></a>
    <button id="navbarBtn" class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarToggler" aria-controls="navbarToggler" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse justify-content-around mt-4 mt-md-0" id="navbarToggler">
      <ul class="navbar-nav">
        <li class="nav-item pt-2">
          <a class="nav-link active" aria-current="page" href="https://instaroadtax.my/">Utama</a>
        </li>
        <li class="nav-item pt-2">
          <a class="nav-link" href="https://instaroadtax.my/#faq-list">Soalan Lazim</a>
        </li>
        <li class="nav-item pt-2">
          <a disabled class="nav-link" href="#">Blog</a>
        </li>
        <li class="nav-item pt-2 dropdown">
          <a disabled class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Tentang Instaroadtax
          </a>
          <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
            <li><a class="dropdown-item" href="#">Latarbelakang</a></li>
            <li><a class="dropdown-item" href="#">Pasukan</a></li>
            <li>
              <a class="dropdown-item" href="#">Hubungi Kami</a>
            </li>
          </ul>
        </li>
      </ul>
      <ul class="navbar-nav align-items-start align-items-lg-center">
        <?php
        if (isset($_SESSION['email'])) {
          echo "<li class=\"nav-item\"><small><a href=\"../admin\"><p class=\"p-0 m-0\">Dashboard</p></a></small></li><li class=\"nav-item py-2 px-3 mt-2\"><small><form action=\"../includes/logout.inc.php\" method=\"POST\"><button type=\"submit\" name=\"logout-submit\" class=\"btn btn-primary\">Logout</button></form></small></li>";
        } else {
          echo "<li class=\"nav-item py-2 px-3 mt-2\">
                <a class=\"nav-link\" href=\"../login\"><svg xmlns=\"http://www.w3.org/2000/svg\" width=\"16\" height=\"16\" viewBox=\"0 0 24 24\" fill=\"none\" stroke=\"currentColor\" stroke-width=\"1.5\" stroke-linecap=\"round\" stroke-linejoin=\"round\"><rect x=\"3\" y=\"11\" width=\"18\" height=\"11\" rx=\"2\" ry=\"2\"/><path d=\"M7 11V7a5 5 0 0 1 10 0v4\"/></svg> Log Masuk</a>
                </li>";
        }
        ?>
        <li class="nav-item pt-1 d-flex align-items-start mb-2">
          <img width="48" src="https://instaroadtax.my/img/telephone.svg"" alt=" tel">
          <div>
            <span style="font-size:14px;line-height:0.1;"><small>Hubungi Agen Kami</small></span>
            <p style="line-height:0.1;" class="pt-2"><strong>010 231 7905</strong></p>
          </div>
        </li>
      </ul>
    </div>
  </div>
</nav>

<script>
  document.getElementById("navbarBtn").addEventListener('click', function() {
    document.getElementById("navbarToggler").style.zIndex="10000";
    document.getElementById("navbarToggler").classList.add('bg-white');
  })
</script>