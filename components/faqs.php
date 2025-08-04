<?php

$faqs =
    [
        ['Q' => 'Bagaimana cara untuk memperbaharui insuran/cukai jalan dengan InstaRoadtax?', 'A' => 'Hanya dengan mengemukakan beberapa butiran:
    <ul><li>No. Plat, MyKad/Pasport, Emel serta poskod kawasan anda.</li>
    <li>Lihat emel daripada kami dengan beberapa sebutharga mengikut harga serta tawaran perlindungan berbeza.</li>
    <li>Pilih satu dan buat pembayaran.</li></ul> Cukai jalan akan dihantar ke alamat anda dalam beberapa hari.'],
        ['Q' => 'Bolehkah saya memperbaharui lesen memandu dengan InstaRoadtax?', 'A' => 'Ya. InstaRoadtax menyediakan perkhidmatan memperbaharui lesen memandu kelas B2/B/D/DA. Buat pilihan \'Perbaharui Lesen\' di laman utama InstaRoadtax.'],
        ['Q' => 'Apakah insuran yang ditawarkan oleh Instaroadtax?', 'A' => 'Terkini, kami menawarkan insuran daripada empat (2) syarikat insuran:
    <ul><li>Etiqa General Takaful Berhad</li><li>Zurich General Takaful Malaysia Berhad</li></ul>']
    ]

?>

<div id="faqs" class="container-fluid py-50 py-lg-100">
    <div class="container d-flex flex-column flex-lg-row flex-xl-row justify-content-between">
        <div id="faq-title" class="col-12 col-lg-5 px-3 px-lg-5 pb-sm-4 pb-md-4 order-1">
            <img src="./img/img-faq.png" alt="img-faq" width="590" class="img-fluid">
        </div>
        <div id="faq-list" class="col-12 col-lg-7">
            <h2 class="heading-bold pb-2 pt-lg-5" style="line-height:1;">Kami bersedia untuk menjawab <span class="text-primary">pertanyaan anda</span>.</h2>
            <div class="accordion accordion-flush" id="accordionFlushExample">
                <?php foreach ($faqs as $i => $faq) {
                    echo "
                    <div class='accordion-item'>
                            <h2 class='accordion-header' id='flush-heading" . $i . "'>
                                <button class='accordion-button collapsed' type='button' data-bs-toggle='collapse' data-bs-target='#flush-collapse" . $i . "' aria-expanded='false' aria-controls='flush-collapse" . $i . "'>" .
                        "<strong>" . $faq['Q'] . "</strong>"
                        . "</button>
                            </h2>
                            <div id='flush-collapse" . $i . "' class='accordion-collapse collapse' aria-labelledby='flush-heading" . $i . "' data-bs-parent='#accordionFlushExample'>
                                <div class='accordion-body'>" . $faq['A'] . "</div>
                            </div>
                    </div>";
                }
                ?>
            </div>
        </div>
    </div>
</div>