<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require('../config.php');
include(ABS_PATH . '/connection/index.php'); //prod
include(ABS_PATH . '/layouts/subs/header.php');

if (isset($_POST['submit']) && $_POST['submit'] !== 'Hantar') {
    //get form data
    $billref = $_POST['billref'];
    $fullname = $_POST['fullname'];
    $address1 = $_POST['address1'];
    $address2 = $_POST['address2'];
    $city = $_POST['city'];
    $state = $_POST['state'];
    $postcode = $_POST['postcode'];
    $icno = $_POST['icno'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];
    $type = $_POST['type'];
    $plate = $_POST['plate'];
    $sumCovered = $_POST['sumCovered'];
    $insComp = $_POST['insComp'];
    $carModel = $_POST['carModel'];
    $basicContrb = $_POST['basicContrb'];
    $basicContrbDisc = $_POST['basicContrbDisc'];
    $extraCovrg = $_POST['extraCovrg'];
    $stampDuty = $_POST['stampDuty'];
    $sst = $_POST['sst'];
    $carModel = $_POST['carModel'];
    $year = $_POST['year'];
    $engineCC = $_POST['engineCC'];
    $ncd = $_POST['ncd'];
    $ncdDate = $_POST['ncdDate'];
    $windscreen = $_POST['windscreen-selected'];
    $roadtax = $_POST['roadtax'];
    $perils = $_POST['perils'];
    $addperils = $_POST['addperils'];
    $tarikhBuka = $_POST['tarikhBuka'];
    $sahSehingga = $_POST['sahSehingga'];
    $total = $_POST['total'];

    $_SESSION['fullname'] = $fullname;
    $_SESSION['address1'] = $address1;
    $_SESSION['address2'] = $address2;
    $_SESSION['city'] = $city;

    if ($fullname !== '' && $address1 !== '' && $billref !== '') {
        $fname = $mysqli->real_escape_string($_SESSION['fullname']);
        $add1  = $mysqli->real_escape_string($_SESSION['address1']);
        $add2  = $mysqli->real_escape_string($_SESSION['address2']);
        $addcity  = $mysqli->real_escape_string($_SESSION['city']);
        $insert = $mysqli->query("UPDATE users SET address1='$add1', address2='$add2', city='$addcity' WHERE vkey='$billref'");
        $insert2 = $mysqli->query("UPDATE quotations SET windscreen='$windscreen', roadtax='$roadtax', add_perils='$addperils' WHERE vkey='$billref'");
        
    }
}

$previous = "javascript:history.go(-1)";
if (isset($_SERVER['HTTP_REFERER'])) {
    $previous = $_SERVER['HTTP_REFERER'];
}
?>

<body>
    <?php include(ABS_PATH . '/layouts/subs/nav.php'); ?>

    <div class="container-fluid py-50 mt-50 mt-lg-80" style="background-color:#F8F9FB;">
        <div class="container">
            <h3 class="fw-bold mb-3 text-primary">Ringkasan Pesanan</h3>
            <div class="row justify-content-start">
                <div class="col-lg-8">
                    <div class="order-1">
                        <!-- 1. MAKLUMAT KENDERAAN -->
                        <div class="mb-3 mt-4">
                            <h5 class="fs-6">Anda telah membuat pilihan seperti berikut:</h5>
                            <div class="rounded-3 p-3 bg-white">

                                <!-- Mobile Total -->
                                <div class="d-inline d-lg-none mt-10">
                                    <div class="my-5 text-end">
                                        <p class="fs-12">
                                            Tarikh mohon: <?php echo $tarikhBuka; ?> <br />
                                            <strong>Sah sehingga: <?php echo $sahSehingga; ?></strong>
                                        </p>
                                    </div>

                                    <div class="text-end">
                                        <span>Jumlah Keseluruhan</span>
                                        <h4 id="total" class="fs-3 fw-bold lh-1 text-dark text-end my-10"><?= 'RM' . $total ?></h4>
                                    </div>
                                </div>
                                <hr class="d-block d-lg-none">

                                <table class="table table-sm table-borderless fs-14">
                                    <thead>
                                        <tr>
                                            <th scope="col" class="col-6"></th>
                                            <th scope="col" class="col-6"></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td scope="row">Jenis Kenderaan</td>
                                            <td class="text-end"><?php echo $type;  ?></td>
                                        </tr>
                                        <tr>
                                            <td scope="row">No. Pendaftaran Kenderaan</td>
                                            <td class="text-end"><?php echo $plate;  ?></td>
                                        </tr>
                                        <tr>
                                            <td scope="row">Model/Varian Kenderaan</td>
                                            <td class="text-end"><?php echo $carModel;  ?></td>
                                        </tr>
                                        <tr>
                                            <td scope="row">Tahun</td>
                                            <td class="text-end"><?php echo $year;  ?></td>
                                        </tr>
                                        <tr>
                                            <td scope="row">Kapasiti Enjin</td>
                                            <td class="text-end"><?php echo $engineCC . "cc";  ?></td>
                                        </tr>
                                        <tr>
                                            <td scope="row">Diskaun Tanpa Tuntutan (NCD)</td>
                                            <td class="text-end"><?php echo $ncd . "%";  ?></td>
                                        </tr>
                                        <tr>
                                            <td scope="row">Perlindungan Dari</td>
                                            <td class="text-end"><?php echo $ncdDate;  ?></td>
                                        </tr>
                                        <tr>
                                            <td scope="row">Jumlah Perlindungan
                                                <span id="ttip1" class="badge rounded-pill btn btn-sm btn-secondary text-dark" data-bs-toggle="tooltip" title="Jumlah yang dicadangkan. Tekan Edit untuk tukar jumlah perlindungan.">
                                                    ?
                                                </span>
                                            </td>
                                            <td class="text-end">
                                                <?php echo "<strong>RM" . number_format($sumCovered, 2, '.', ',') . "</strong>";  ?>
                                                <!-- Edit price -->
                                                <button type="button" class="btn btn-sm px-1 mb-1 py-0" data-bs-toggle="modal" data-bs-target="#newInsuredModal">
                                                    <svg class="text-primary" xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                                        <path d="M20 14.66V20a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V6a2 2 0 0 1 2-2h5.34"></path>
                                                        <polygon points="18 2 22 6 12 16 8 16 8 12 18 2"></polygon>
                                                    </svg>
                                                </button>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td scope="row">Panel Insuran</td>
                                            <td class="text-end"><?php echo $insComp === 'Etiqa' ? "Etiqa General Takaful Berhad" : "Zurich Insurance Berhad";  ?></td>
                                        </tr>
                                    </tbody>
                                </table>
                                <hr />

                                <table class="table table-sm table-borderless fs-14">
                                    <thead>
                                        <tr>
                                            <th scope="col" class="col-6"></th>
                                            <th scope="col" class="col-6"></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td scope="row">Basic <span class="<?= $ncd !== '0.00' ? "" : "d-none" ?>"><small><?= "(-" . (int)$ncd . "%)" ?></small></span> </td>
                                            <td class="text-end text-lg-start vertical-align: bottom;"><del class="text-danger pe-1 <?= $ncd !== '0.00' ? "" : "d-none" ?>"><small><?php echo $basicContrb  . "</del></small>" . $basicContrbDisc ?></td>
                                        </tr>
                                        <tr>
                                            <td scope="row">Extra Coverage</td>
                                            <td class="text-end text-lg-start"><?= $extraCovrg ?></td>
                                        </tr>
                                        <tr>
                                            <td scope="row">Stamp Duty</td>
                                            <td class="text-end text-lg-start"><?= $stampDuty ?></td>
                                        </tr>
                                        <tr>
                                            <td scope="row">SST</td>
                                            <td class="text-end text-lg-start"><?= $sst ?></td>
                                        </tr>
                                        <tr class="<?= $windscreen !== '0' ? '' : 'd-none'; ?>">
                                            <td scope="row">Windscreen</td>
                                            <td class="text-end text-lg-start"><?= number_format((float)$windscreen, 2, '.', '') ?></td>
                                        </tr>
                                        <tr class="<?= $perils !== '' ? '' : 'd-none' ?>">
                                            <td scope="row">Special Perils</td>
                                            <td class="text-end text-lg-start"><?= number_format((float)$perils, 2, '.', '') ?></td>
                                        </tr>
                                        <tr class="<?= $roadtax !== '' ? '' : 'd-none' ?>">
                                            <td scope="row">Roadtax (incld. delivery)</td>
                                            <td class="text-end text-lg-start"><?= number_format((float)$roadtax, 2, '.', '') ?></td>
                                        </tr>
                                    </tbody>
                                </table>
                                <hr />
                                <table class="table table-sm table-borderless fs-14">
                                    <thead>
                                        <tr>
                                            <th scope="col" class="col-6"></th>
                                            <th scope="col" class="col-6"></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td scope="row">Nama Penuh</td>
                                            <td class="text-end text-lg-start"><?= $fullname ?></td>
                                        </tr>
                                        <tr>
                                            <td scope="row">Alamat</td>
                                            <td class="text-end text-lg-start"><?= $address1 . ", " . $address2; ?></td>
                                        </tr>
                                        <tr>
                                            <td scope="row">Bandar</td>
                                            <td class="text-end text-lg-start"><?= $city ?></td>
                                        </tr>
                                        <tr>
                                            <td scope="row">Poskod</td>
                                            <td class="text-end text-lg-start"><?= $postcode ?></td>
                                        </tr>
                                        <tr>
                                            <td scope="row">Negeri</td>
                                            <td class="text-end text-lg-start"><?= $state ?></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <div class="fs-14">
                            <p class="fs-14 mb-0">Terma:</p>
                            <ol class="ps-25">
                                <li>Harga yang dipaparkan adalah muktamad. </li>
                                <li>Sekiranya terdapat peningkatan harga akibat perubahan dari syarikat pengeluar insuran, Instaroadtax.my berhak untuk membuat perubahan harga tertakluk kepada persetujuan pembeli.</li>
                                <li>Harga yang dipaparkan hanya sah dalam tempoh masa 7 hari dari tarikh yang tertera.</li>
                            </ol>
                        </div>

                        <div class="form-check fs-14">
                            <input onclick="togglePaymentBtn()" class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                            <label class="form-check-label" for="flexCheckDefault">
                                Saya bersetuju dengan terma yang dikemukakan di atas.
                            </label>
                        </div>

                        <form id="payment" method="POST" action="../processpmt.php">
                            <!-- billplz template -->
                            <input type="hidden" name='name' required value="<?= $fullname ?>">
                            <input type="hidden" name='email' required value="<?= $email ?>">
                            <input type="hidden" name="mobile" value="<?= $phone ?>">
                            <input type="hidden" name="amount" value="<?= $total * 100 ?>">
                            <input type="hidden" name="reference_1_label" value="Ref 1">
                            <input type="hidden" name="reference_1" value="<?= $icno ?>">
                            <input type="hidden" name="reference_2_label" value="Ref 2">
                            <input type="hidden" name="reference_2" value="<?= $billref ?>">
                            <input type="hidden" name="collection_id" value="">
                            <input type="hidden" name="windscreen" value="<?= $windscreen ?>">
                            <input type="hidden" name="roadtax" value="<?= $roadtax ?>">
                            <!-- billplz template -->


                            <!-- Payment Button -->
                            <div class="row justify-content-start py-25 ms-1">
                                <!-- <button class="btn btn-primary btn-large col-11 col-lg-4" type="submit" name="submit"><img class="me-2 pb-1" src="../img/lock.svg" alt="lock">Buat Pembayaran</button> -->
                                <button class="btn btn-primary btn-large col-12" type="submit" name="submit" id="paymentBtn" disabled><img class="me-2 pb-1" src="../img/lock.svg" alt="lock">Buat Pembayaran</button>
                            </div>
                        </form>
                    </div>
                </div>

                <div class="col-lg-4">

                    <!-- Kembali ke Sebutharga -->
                    <div class="mb-5 mt-5 mt-lg-50 ps-2">
                        <a href="<?php echo $previous; ?>" style="text-decoration: none;" class="text-danger">
                            <span class="pe-1">
                                <svg xmlns="http://www.w3.org/2000/svg" width="21" height="21" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M19 12H6M12 5l-7 7 7 7" />
                                </svg>
                            </span><small>Kembali ke Sebutharga</small>
                        </a>
                    </div>

                    <div id="paymentBox" class="mb-3 mt-4 mt-lg-15 bg-white rounded-3 p-4 d-none d-lg-block" style="position:fixed; min-height:200px; min-width: 300px;">
                        <div>
                            <h5 class="fs-6 fw-bold text-primary">Sebutharga #6172357</h5>

                            <div class="my-5 text-end">
                                <p class="fs-12">
                                    Tarikh mohon: <?php echo $tarikhBuka; ?> <br />
                                    <strong>Sah sehingga: <?php echo $sahSehingga; ?></strong>
                                </p>
                            </div>

                            <div class="text-end">
                                <span>Jumlah Keseluruhan</span>
                                <h4 id="total" class="fs-3 fw-bold lh-1 text-dark text-end my-10"><?= 'RM' . $total ?></h4>
                            </div>
                        </div>
                        <div class="pt-10"><img src="../img/accept_payment.png" width="310px" alt="payment services"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        //add white background to navbar after scrolling
        var scrollpos = window.scrollY;
        var header = document.getElementById("nav");

        var paymentBox = document.querySelector("#paymentBox").parentElement;

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

        function togglePaymentBtn() {
            var paymentBtn = document.querySelector("#paymentBtn");
            paymentBtn.toggleAttribute('disabled');
        }
    </script>

</body>