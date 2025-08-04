<?php include("./layouts/header.php"); ?>

<body>
    <!-- Navigation -->
    <?php include("./layouts/nav.php"); ?>

    <div class="container py-4 mt-50 mt-lg-100" style="min-height:62vh;">
        <div class="row align-items-end justify-content-start gap-25">
            <div class="col-12 col-lg-6" style="max-height:600px;">
                <img src="./img/img-hero.png" class="img-fluid" alt="">
            </div>
            <div class="col-12 col-lg-4 mt-25 mt-lg-0">
                <h1><svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" viewBox="0 0 24 24" fill="none" stroke="#21d338" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path>
                        <polyline points="22 4 12 14.01 9 11.01"></polyline>
                    </svg> Permohonan anda telah diterima!</h1>
                <p class="py-10">Kami telah menerima permohonan sebutharga insuran kenderaan anda.</p>
                <div class="card">
                    <div class="card-body">
                        <ol>
                            <li class="pb-15">Anda akan menerima emel dari kami. Klik capaian seperti yang tertera di dalam emel.</li>
                            <li class="pb-15">Sekiranya anda tidak menerima sebarang emel kami, semak di dalam kandungan 'spam' emel anda. Tambahkan yana@instaroadtax.my ke senarai kontak anda.</li>
                        </ol>
                    </div>
                    <div class="card-footer" style="text-align:center;">
                        <a href="./"><svg class="mb-1" xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M20 9v11a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2V9"/><path d="M9 22V12h6v10M2 10.6L12 2l10 8.6"/></svg> Kembali ke Laman Utama</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php include("./layouts/footer.php"); ?>
</body>

</html>