<?php include("../layouts/subs/header.php"); ?>

<body>
    <!-- Navigation -->
    <?php include("../layouts/subs/nav.php"); ?>

    <div class="container py-4 mt-50 mt-lg-100" style="min-height:62vh;">
        <div class="row align-items-center justify-content-start gap-25">
            <div class="col-12 col-lg-6" style="max-height:600px;">
                <img src="../img/img-hero.png" class="img-fluid" alt="" style="filter:saturate(0);">
            </div>
            <div class="col-12 col-lg-4 mt-25 mt-lg-0">
                <h2><svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" viewBox="0 0 24 24" fill="none" stroke="red" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <circle cx="12" cy="12" r="10"></circle>
                        <line x1="4.93" y1="4.93" x2="19.07" y2="19.07"></line>
                    </svg> Masalah Teknikal</h2>
                <p class="py-10">Harap maaf. Sila cuba lagi melalui link yang telah diemelkan.</p>

                <p>atau</p>
                <a href="../"><svg class="mb-1" xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M20 9v11a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2V9" />
                        <path d="M9 22V12h6v10M2 10.6L12 2l10 8.6" />
                    </svg> Kembali ke Laman Utama</a>
            </div>
        </div>
    </div>
    <div class="mt-lg-150"></div>
    <?php include("../layouts/subs/footer.php"); ?>

    <script>
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
</body>

</html>