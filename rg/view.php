<?php
require('../config.php');
include(ABS_PATH . '/connection/index.php'); //prod
include(ABS_PATH . '/layouts/subs/header.php');
include(ABS_PATH . '/admin/utils/getState.php');

$vkey = $_GET['vkey'];

//get all data from table 'users'
$customerDetails = "SELECT * FROM users WHERE vkey = '$vkey'";
$result = mysqli_query($mysqli, $customerDetails);
$count = mysqli_num_rows($result);

if ($count > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        $plate = $row['plate'];
        $icno = $row['icno'];
        $type = $row['type'];
        $postcode = $row['postcode'];
        $email = $row['email'];
        $phone = $row['phone'];
    }
}

//get all data from table 'quotations'
$quotation = "SELECT * FROM quotations WHERE vkey = '$vkey'";
$result = mysqli_query($mysqli, $quotation);
$count = mysqli_num_rows($result);

if ($count > 0) {
    $isAvailable = true;
} else $isAvailable = false;

$quotation = [];

while ($row = mysqli_fetch_assoc($result)) {
    $quotation['datetime'] = $row['datetime'];
    $quotation['year'] = $row['year'];
    $quotation['carModel'] = $row['carModel'];
    $quotation['engineCC'] = $row['engineCC'];
    $quotation['rtprice'] = $row['rtprice'];
    $quotation['insComp'] = $row['insComp'];
    $quotation['sumCovered'] = $row['sumCovered'];
    $quotation['ncd'] = $row['ncd'];
    $quotation['expiryDate'] = $row['expiryDate'];
    $quotation['basicContrb'] = $row['basicContrb'];
    $quotation['perils'] = $row['perils'];
    $quotation['extraCovrg'] = $row['extraCovrg'];
    $quotation['sst'] = $row['sst'];
    $quotation['stampDuty'] = $row['stampDuty'];
}

if (isset($_SESSION['fullname']) && isset($_SESSION['address1']) && isset($_SESSION['city']) && isset($_SESSION['address2'])) {
    $fullname = $_SESSION['fullname'];
    $address1 = $_SESSION['address1'];
    $address2 = $_SESSION['address2'];
    $city = $_SESSION['city'];
}

$basicContrbDisc = number_format((float)$quotation['basicContrb'] * (1 - $quotation['ncd'] / 100), 2, '.', '');
$date = new DateTime($quotation['datetime']);
$tarikhBuka = $date->format('d M Y');
$date->add(new DateInterval('P14D'));
$sahSehingga = $date->format('d M Y');

$ncdDate = new DateTime($quotation['expiryDate']);
$ncdDate = $ncdDate->format('d M Y');
?>

<style>
    .whatsapp_float {
        bottom: 83px;
    }

    footer {
        display: none;
    }
</style>

<body>
    <?php include(ABS_PATH . '/layouts/subs/nav.php'); ?>

    <div id="newInsuredModal" class="modal" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Jumlah Perlindungan</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body p-4">
                    <div class="alert alert-primary d-flex align-items-start" role="alert">
                        <svg role="img" aria-label="Info:" class="bi flex-shrink-0 me-2" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <circle cx="12" cy="12" r="10"></circle>
                            <line x1="12" y1="8" x2="12" y2="12"></line>
                            <line x1="12" y1="16" x2="12.01" y2="16"></line>
                        </svg>
                        <div>
                            <p><small>Kami akan memproses jumlah permohonan yang anda mohon dengan segera. Sila semak emel anda untuk mendapatkan sebutharga yang baharu.</small></p>
                        </div>
                    </div>
                    <p>Sila isi jumlah perlindungan baharu untuk kenderaan anda.</p>
                    <form id="form1" method="POST" action="./newInsuredReq.php">
                        <div class="form-group row my-10 mt-5">
                            <div class="col-12">
                                <div class="input-group">
                                    <div class="input-group-text">RM</div>
                                    <input type="number" step="1000" class="form-control" name="newInsuredAmount" value="<?= (int)$quotation['sumCovered'] ?>">
                                    <input type="hidden" name="vkey" value="<?= $vkey ?>" />
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button form="form1" class="btn btn-primary">Hantar</button>
                </div>
            </div>
        </div>
    </div>


    <!-- Mobile view total -->
    <div class="mobile-checkout d-block d-lg-none container-fluid bg-white fixed-bottom text-end p-2">
        <div class="accordion accordion-flush" id="accordionFlushTop">
            <div class="accordion-item">
                <h2 class="accordion-header" id="flush-headingOne">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseTop" aria-expanded="false" aria-controls="flush-collapseTop">
                        <p class="m-0 fs-14" style="position:absolute; right:70px;">Jumlah<u class="text-primary"><span id="total2" class="fw-bold fs-24 primary-font text-primary ps-2">0.00</span></u></p>
                    </button>
                </h2>
                <div id="flush-collapseTop" class="accordion-collapse collapse" aria-labelledby="flush-headingOne" data-bs-parent="#accordionFlushTop">
                    <div class="accordion-body">
                        <table id="mobile-table" class="table table-sm table-borderless fs-14">
                            <thead>
                                <tr>
                                    <th scope="col" class="col-3"></th>
                                    <th scope="col" class="col-6"></th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td scope="row">Basic <span class="<?= $quotation['ncd'] > 0 ? "" : "d-none" ?>"><small><?= "(-" . (int)$quotation['ncd'] . "%)" ?></small></span> </td>
                                    <td class="text-end vertical-align: bottom;"><del class="text-danger pe-1 <?= $quotation['ncd'] > 0 ? "" : "d-none" ?>"><small><?php echo $quotation['basicContrb']  . "</del></small>" . $basicContrbDisc ?></td>
                                </tr>
                                <tr>
                                    <td scope="row">Extra Coverage</td>
                                    <td class="text-end vertical-align: bottom;"><?php echo $quotation['extraCovrg'];  ?></td>
                                </tr>
                                <tr>
                                    <td scope="row">Stamp Duty</td>
                                    <td class="text-end vertical-align: bottom;"><?php echo $quotation['stampDuty'];  ?></td>
                                </tr>
                                <tr>
                                    <td scope="row">SST</td>
                                    <td class="text-end vertical-align: bottom;"><?php echo $quotation['sst'];  ?></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <form id="form2" class="form needs-validation" method="POST" action="./confirmation.php" autocomplete="on" novalidate>
        <div class="container-fluid py-50 mt-50 mt-lg-80" style="background-color:#F8F9FB;">
            <div class="container">
                <h3 class="fw-bold mb-3 text-primary">Butiran insuran kenderaan anda..</h3>
                <div class="row justify-content-center">
                    <div class="col-lg-8">
                        <div class="order-1">
                            <!-- 1. MAKLUMAT KENDERAAN -->
                            <div class="mb-3 mt-4">
                                <h5 class="fs-6">Maklumat Insuran</h5>
                                <div class="rounded-3 p-3 bg-white">
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
                                                <td class="text-end"><?php echo $quotation['carModel'];  ?></td>
                                            </tr>
                                            <tr>
                                                <td scope="row">Tahun</td>
                                                <td class="text-end"><?php echo $quotation['year'];  ?></td>
                                            </tr>
                                            <tr>
                                                <td scope="row">Kapasiti Enjin</td>
                                                <td class="text-end"><?php echo $quotation['engineCC'] . "cc";  ?></td>
                                            </tr>
                                            <tr>
                                                <td scope="row">Diskaun Tanpa Tuntutan (NCD)</td>
                                                <td class="text-end"><?php echo $quotation['ncd'] . "%";  ?></td>
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
                                                    <?php echo "<strong>RM" . number_format($quotation['sumCovered'], 2, '.', ',') . "</strong>";  ?>
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
                                                <td class="text-end"><?php echo $quotation['insComp'] === 'Etiqa' ? "Etiqa General Takaful Berhad" : "Zurich Insurance Berhad";  ?></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <!-- 2. PERLINDUNGAN TAMBAHAN -->
                            <div class="mb-3 mt-4">
                                <h5 class="fs-6">Perlindungan Tambahan</h5>
                                <div class="bg-white rounded-3 p-3">
                                    <div class="d-flex flex-column justify-content-center col-12 col-md-6 offset-md-3">

                                        <div class="accordion accordion-flush my-2" id="wsOptions">
                                            <div class="accordion-item border radius-3">
                                                <div class="accordion-header" id="flush-headingTwo">
                                                    <button class="accordion-button collapsed ps-0" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseTwo" aria-expanded="false" aria-controls="flush-collapseTwo">
                                                        <svg class="ms-2 me-3 pb-2" style="z-index: 0;" xmlns="http://www.w3.org/2000/svg" width="70" height="80" viewBox="0 0 32 32" stroke="none" fill="rgb(51, 51, 51)">
                                                            <g id="car">
                                                                <path d="M6.64,15.39l.24,0a1,1,0,0,0,1-.76L8.78,11h5.4a1,1,0,0,0,0-2H8.78a2.06,2.06,0,0,0-2,1.52l-.9,3.66A1,1,0,0,0,6.64,15.39Z" />
                                                                <path d="M26.78,17l-.47-1.91a1,1,0,0,0-1.94.47L24.72,17H6a1.43,1.43,0,0,0-.22,0,1.55,1.55,0,0,0-.21,0H5a2,2,0,0,0-2,2v5a2,2,0,0,0,2,2H6v1.23A2.77,2.77,0,0,0,8.77,30h.46A2.77,2.77,0,0,0,12,27.23V26h5a1,1,0,0,0,0-2L5,24l0-5h.55a1.55,1.55,0,0,0,.21,0A1.43,1.43,0,0,0,6,19H26a1.42,1.42,0,0,0,.2,0,1.85,1.85,0,0,0,.23,0h.34a.23.23,0,0,1,.23.23v4.54a.23.23,0,0,1-.23.23H21a1,1,0,0,0-1,1v2.23A2.77,2.77,0,0,0,22.77,30h.46A2.77,2.77,0,0,0,26,27.23V26h.77A2.23,2.23,0,0,0,29,23.77V19.23A2.24,2.24,0,0,0,26.78,17ZM10,27.23a.76.76,0,0,1-.77.77H8.77A.76.76,0,0,1,8,27.23V26h2Zm14,0a.76.76,0,0,1-.77.77h-.46a.76.76,0,0,1-.77-.77V26h2Z" />
                                                                <path d="M8,20a1,1,0,0,0,0,2h4a1,1,0,0,0,0-2Z" />
                                                                <path d="M24,22a1,1,0,0,0,0-2H20a1,1,0,0,0,0,2Z" />
                                                                <path d="M21.36,15a.85.85,0,0,0,.23,0,.83.83,0,0,0,.22,0,6.67,6.67,0,0,0,3-1.49c2.16-1.91,2.93-5.21,2-8.63A1,1,0,0,0,26,4.13a6.5,6.5,0,0,1-2.2-.74,6.28,6.28,0,0,1-1.47-1.1,1,1,0,0,0-1.41,0,6.28,6.28,0,0,1-1.47,1.1,6.5,6.5,0,0,1-2.2.74,1,1,0,0,0-.82.72c-.94,3.42-.17,6.72,2,8.63A6.58,6.58,0,0,0,21.36,15ZM18.18,6a8.53,8.53,0,0,0,2.19-.83,9.22,9.22,0,0,0,1.22-.81,9.11,9.11,0,0,0,1.21.81A8.24,8.24,0,0,0,25,6c.5,2.45-.07,4.71-1.54,6a4.61,4.61,0,0,1-1.87,1,4.65,4.65,0,0,1-1.88-1A6.18,6.18,0,0,1,18.18,6Z" />
                                                                <path d="M21.59,11.19a.71.71,0,0,0,.2,0,1,1,0,0,0,.66-.48l1.7-3a1,1,0,0,0-.38-1.37,1,1,0,0,0-1.36.37l-1.13,2-.79-.59a1,1,0,1,0-1.2,1.6L21,11A1,1,0,0,0,21.59,11.19Z" />
                                                            </g>
                                                        </svg>
                                                        <div class="d-flex flex-column">
                                                            <h6 class="fs-16">Cermin Hadapan (Windscreen)</h6>
                                                            <p class="fs-6 lh-1 mb-2"><small>Perlindungan Cermin Hadapan</small></p>
                                                        </div>
                                                    </button>
                                                </div>
                                                <div id="flush-collapseTwo" class="accordion-collapse collapse" aria-labelledby="flush-headingTwo" data-bs-parent="#wsOptions">
                                                    <div class="accordion-body">
                                                        <div class="radiobtn">
                                                            <input type="radio" id="windscreen1" name="windscreen" value="79.50" />
                                                            <label for="windscreen1">RM79.50 <span class="badge fs-11 rounded-pill bg-primary text-white"><small>Maksimum RM500</small></span></label>
                                                        </div>
                                                        <div class="radiobtn">
                                                            <input type="radio" id="windscreen2" name="windscreen" value="111.30" />
                                                            <label for="windscreen2">RM111.30 <span class="badge fs-11 rounded-pill bg-primary text-white"><small>Maksimum RM700</small></span></label>
                                                        </div>
                                                        <div class="radiobtn">
                                                            <input type="radio" id="windscreen3" name="windscreen" value="127.20" />
                                                            <label for="windscreen3">RM127.20 <span class="badge fs-11 rounded-pill bg-primary text-white"><small>Maksimum RM800</small></span></label>
                                                        </div>
                                                        <div class="radiobtn">
                                                            <input type="radio" id="windscreen4" name="windscreen" value="159.00" />
                                                            <label for="windscreen4">RM159.00 <span class="badge fs-11 rounded-pill bg-primary text-white"><small>Maksimum RM1000</small></span></label>
                                                        </div>
                                                        <div class="radiobtn">
                                                            <input type="radio" id="windscreen5" name="windscreen" value="238.50" />
                                                            <label for="windscreen5">RM238.50 <span class="badge fs-11 rounded-pill bg-primary text-white"><small>Maksimum RM1500</small></span></label>
                                                        </div>
                                                        <div class="radiobtn">
                                                            <input type="radio" id="wsoptout" name="windscreen" value="0" checked />
                                                            <label for="wsoptout"><small>Tiada keperluan</small></label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <button type="button" onclick="handleAddOns(this)" class="btn btn-outline-info text-dark addons my-2 px-1 py-2" data-bs-toggle="button" autocomplete="off" data-name="addSpecial">
                                            <div class="d-flex flex-column">
                                                <div class="d-flex align-items-center">
                                                    <svg class="me-3 pb-2" xmlns="http://www.w3.org/2000/svg" width="90" height="80" viewBox="-3 0 32 32" stroke="none" fill="currentColor">
                                                        <g id="add_umbrella" data-name="add umbrella">
                                                            <path d="M17,4s0,0,0,0V3a1,1,0,0,0-2,0V4a1,1,0,0,0,.15.5A1,1,0,0,0,15,5a1,1,0,0,0,1,1,12.31,12.31,0,0,1,11.21,7.44A6.26,6.26,0,0,0,25,13a6,6,0,0,0-4.08,1.62A8.42,8.42,0,0,0,16,13a8.31,8.31,0,0,0-4.9,1.62A6.29,6.29,0,0,0,7,13a5.77,5.77,0,0,0-2.22.44A12.17,12.17,0,0,1,12.3,6.58a1,1,0,0,0-.61-1.91A14.17,14.17,0,0,0,2,15.83a1,1,0,0,0,1.79.77A4.2,4.2,0,0,1,7,15a4.18,4.18,0,0,1,3.2,1.6,1,1,0,0,0,1.49.12A6.49,6.49,0,0,1,15,15.09v3a6,6,0,1,0,5,1.48A1,1,0,1,0,18.7,21,4.06,4.06,0,0,1,20,24a4,4,0,1,1-4-4,1,1,0,0,0,1-1V15.09a6.24,6.24,0,0,1,3.31,1.63,1,1,0,0,0,1.49-.12,4,4,0,0,1,6.4,0,1,1,0,0,0,.8.4,1,1,0,0,0,.39-.08,1,1,0,0,0,.6-1.09A14.15,14.15,0,0,0,17,4Z" />
                                                            <path d="M16,27a1,1,0,0,0,1-1V25h1a1,1,0,0,0,0-2H17V22a1,1,0,0,0-2,0v1H14a1,1,0,0,0,0,2h1v1A1,1,0,0,0,16,27Z" />
                                                        </g>
                                                    </svg>
                                                    <div class="d-flex flex-column" style="position:relative;">
                                                        <div id="checked1" style="position: absolute; bottom:4px; right:8px;"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="#ffffff" stroke-width="3" stroke-linecap="round" stroke-linejoin="round">
                                                                <polyline points="20 6 9 17 4 12"></polyline>
                                                            </svg></div>
                                                        <h6 class="fs-16">Perlindungan Bencana Khas (Special Perils)</h6>
                                                        <p class="fs-6 lh-1 mb-2"><small>Perlindungan Bencana (Banjir, Bencana Alam dll.)</small></p>
                                                        <h4 class="fs-20">+ RM<?= $quotation['perils'] ?></h4>
                                                    </div>
                                                </div>
                                            </div>
                                        </button>
                                    </div>
                                </div>
                            </div>
                            <!-- 3. TAMBAH CUKAI JALAN -->
                            <div class="mb-3 mt-4">
                                <h5 class="fs-6">Tambah Cukai Jalan</h5>
                                <div class="bg-white rounded-3 p-3">
                                    <div class="d-flex flex-column col-12 col-md-6 offset-md-3" style="position:relative;">
                                        <div id="checked1" style="position: absolute; bottom:14px; right:14px;"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="#ffffff" stroke-width="3" stroke-linecap="round" stroke-linejoin="round">
                                                <polyline points="20 6 9 17 4 12"></polyline>
                                            </svg></div>
                                        <button id="addRoadtax" <?php echo $quotation['rtprice'] == 0 ? 'disabled' : '' ?> onclick="handleAddRoadtax()" type="button" class="btn btn-outline-info text-dark addons mb-1 px-1 py-2" data-bs-toggle="button" autocomplete="off">
                                            <div class="d-flex flex-column">
                                                <div class="d-flex align-items-center">
                                                    <svg class="me-3 pb-2" xmlns="http://www.w3.org/2000/svg" width="90" height="80" viewBox="0 0 32 32" stroke="none" fill="currentColor">
                                                        <g id="Layer_2" data-name="Layer 2">
                                                            <g id="roadtax">
                                                                <path d="M10.92,12.13a1,1,0,0,0,0-2h-4a1,1,0,0,0,0,2Z" />
                                                                <path d="M4.1,14.47v4.15a1,1,0,0,0,1,1H21.9a1,1,0,0,0,1-1V10.37a1,1,0,0,0-1-1H14.26a1,1,0,0,0-1,1v3.1H5.1A1,1,0,0,0,4.1,14.47Zm2,1h8.16a1,1,0,0,0,1-1v-3.1H20.9v6.25H6.1Z" />
                                                                <path d="M31.94,5.37a5.37,5.37,0,1,0-10.73,0s0,.06,0,.1H3.05A3.06,3.06,0,0,0,0,8.52V20.41a3.06,3.06,0,0,0,3.05,3.06H19.18a1,1,0,0,0,0-2H3.05a1.05,1.05,0,0,1-1-1.06V8.52a1,1,0,0,1,1-1H21.64a5.36,5.36,0,0,0,3.36,3v9.94A1.05,1.05,0,0,1,24,21.47H22.9a1,1,0,0,0,0,2H24A3.06,3.06,0,0,0,27,20.41V10.69A5.35,5.35,0,0,0,31.94,5.37ZM26.58,8.73a3.37,3.37,0,1,1,3.36-3.36A3.37,3.37,0,0,1,26.58,8.73Z" />
                                                                <path d="M26.37,7.69l.15,0a.72.72,0,0,0,.5-.36l1.56-2.73a.75.75,0,1,0-1.31-.75l-1.14,2-.87-.65a.74.74,0,0,0-1.06.15.76.76,0,0,0,.15,1.06l1.56,1.17A.75.75,0,0,0,26.37,7.69Z" />
                                                            </g>
                                                        </g>
                                                    </svg>
                                                    <div class="d-flex flex-column">
                                                        <h6 class="fs-16">Cukai Jalan (Roadtax)</h6>
                                                        <p class="fs-6 lh-1 mb-2"><small>Perbaharui cukai jalan. (Penghantaran RM20)</small></p>
                                                        <h4 class="fs-20">+ RM<?php echo $quotation['rtprice'];  ?></h4>
                                                    </div>
                                                </div>
                                            </div>
                                        </button>
                                    </div>
                                </div>
                            </div>
                            <!-- 4. ALAMAT PENGHANTARAN -->
                            <div class="mb-3 mt-4">
                                <h5 class="fs-6">Butiran Peribadi</h5>
                                <div class="bg-white rounded-3 p-3">
                                    <div class="form-group row my-10 mt-5">
                                        <div class="col-12 pos-rel">
                                            <label><small>Nama Penuh</small></label>
                                            <input type="text" name="fullname" class="form-control" value="<?= isset($_SESSION['fullname']) ? $fullname : ''; ?>" onblur="this.value = titleCase(this.value);" required />
                                            <div class="invalid-tooltip">
                                                <p class="mb-0">Isikan Nama Penuh</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row my-10 mt-5">
                                        <div class="col-12 pos-rel">
                                            <label><small>Alamat 1</small></label>
                                            <input type="text" name="address1" class="form-control" value="<?= isset($_SESSION['address1']) ? $address1 : ''; ?>" onblur="this.value = titleCase(this.value);" required />
                                            <div class="invalid-tooltip">
                                                <p class="mb-0">Isikan Alamat</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row my-10 mt-5">
                                        <div class="col-12">
                                            <label><small>Alamat 2</small></label>
                                            <input type="text" name="address2" class="form-control" value="<?= isset($_SESSION['address2']) ? $address2 : ''; ?>" onblur="this.value = titleCase(this.value);" />
                                        </div>
                                    </div>
                                    <div class="form-group row my-10">
                                        <div class="col-lg-4">
                                            <label><small>Bandar/Daerah</small></label>
                                            <div class="input-group">
                                                <input type="text" name="city" class="form-control" value="<?= isset($_SESSION['city']) ? $city : ''; ?>" onblur="this.value = titleCase(this.value);" required />
                                                <div class="invalid-tooltip">
                                                    <p class="mb-0">Isikan Bandar/Daerah</p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-4">
                                            <label><small>Poskod</small></label>
                                            <div class="input-group">
                                                <input type="text" name="postcode" class="form-control" value="<?php echo $postcode; ?>" oninput="maxLengthCheck(this,5)" readonly />
                                                <div class="invalid-tooltip">
                                                    <p class="mb-0">Isikan Poskod</p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-4">
                                            <label><small>Negeri</small></label>
                                            <div class="input-group">
                                                <input type="text" name="state" class="form-control" value="<?php echo getState($postcode); ?>" onblur="this.value = titleCase(this.value);" readonly />
                                                <div class="invalid-tooltip">
                                                    <p class="mb-0">Isikan Negeri</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row my-10">
                                        <div class="col-lg-4">
                                            <label><small>No Kad Pengenalan</small></label>
                                            <div class="input-group">
                                                <input type="text" name="icno" class="form-control" value="<?php echo $icno; ?>" readonly />
                                            </div>
                                        </div>
                                        <div class="col-lg-4">
                                            <label><small>Emel</small></label>
                                            <div class="input-group">
                                                <input type="text" name="email" class="form-control" value="<?php echo $email; ?>" readonly />
                                            </div>
                                        </div>
                                        <div class="col-lg-4">
                                            <label><small>No. Telefon</small></label>
                                            <div class="input-group">
                                                <input type="text" name="phone" class="form-control" value="<?php echo $phone; ?>" readonly />
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <input type="hidden" name="billref" value="<?= $vkey ?>" />
                                <input type="hidden" name="type" value="<?= $type ?>" />
                                <input type="hidden" name="plate" value="<?= $plate ?>" />
                                <input type="hidden" name="sumCovered" value="<?= $quotation['sumCovered'] ?>" />
                                <input type="hidden" name="insComp" value="<?= $quotation['insComp'] ?>" />
                                <input type="hidden" name="carModel" value="<?= $quotation['carModel'] ?>" />
                                <input type="hidden" name="year" value="<?= $quotation['year'] ?>" />
                                <input type="hidden" name="engineCC" value="<?= $quotation['engineCC'] ?>" />
                                <input type="hidden" name="ncd" value="<?= $quotation['ncd'] ?>" />
                                <input type="hidden" name="ncdDate" value="<?= $ncdDate ?>" />
                                <input type="hidden" name="basicContrb" value="<?= $quotation['basicContrb'] ?>" />
                                <input type="hidden" name="basicContrbDisc" value="<?= $basicContrbDisc ?>" />
                                <input type="hidden" name="extraCovrg" value="<?= $quotation['extraCovrg'] ?>" />
                                <input type="hidden" name="stampDuty" value="<?= $quotation['stampDuty'] ?>" />
                                <input type="hidden" name="sst" value="<?= $quotation['sst'] ?>" />
                                <input type="hidden" name="tarikhBuka" value="<?= $tarikhBuka ?>" />
                                <input type="hidden" name="sahSehingga" value="<?= $sahSehingga ?>" />
                                <input type="hidden" name="windscreen-selected" value="" />
                                <input type="hidden" name="perils" value="" />
                                <input type="hidden" name="addperils" id="addPerils" value="0" />
                                <input type="hidden" name="roadtax" value="" />
                                <input type="hidden" name="total" id="total3" value="" />

                                <!-- Submit Button -->
                                <div class="row justify-content-start py-25">
                                    <button form="form2" class="btn btn-primary btn-large col-12" type="submit" name="submit">Seterusnya</button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-4">
                        <div id="paymentBox" class="mb-3 mt-70 bg-white rounded-3 p-4" style="position:fixed;">
                            <div>
                                <h5 class="fs-6 fw-bold text-primary">Sebutharga #6172357</h5>

                                <div class="my-5">
                                    <p class="fs-12">
                                        Tarikh mohon: <?php echo $tarikhBuka; ?> <br />
                                        <strong>Sah sehingga: <?php echo $sahSehingga; ?></strong>
                                    </p>
                                </div>

                                <div>
                                    <table id="desktop-table" class="table table-sm table-borderless fs-14">
                                        <thead>
                                            <tr>
                                                <th scope="col" class="col-6"></th>
                                                <th scope="col" class="col-6"></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td scope="row">Basic <span class="<?= $quotation['ncd'] > 0 ? "" : "d-none" ?>"><small><?= "(-" . (int)$quotation['ncd'] . "%)" ?></small></span> </td>
                                                <td class="text-end vertical-align: bottom;"><del class="text-danger pe-1 <?= $quotation['ncd'] > 0 ? "" : "d-none" ?>"><small><?php echo $quotation['basicContrb']  . "</del></small>" . $basicContrbDisc ?></td>
                                            </tr>
                                            <tr>
                                                <td scope="row">Extra Coverage</td>
                                                <td class="text-end"><?php echo $quotation['extraCovrg'];  ?></td>
                                            </tr>
                                            <tr>
                                                <td scope="row">Stamp Duty</td>
                                                <td class="text-end"><?php echo $quotation['stampDuty'];  ?></td>
                                            </tr>
                                            <tr>
                                                <td scope="row">SST</td>
                                                <td class="text-end"><?php echo $quotation['sst'];  ?></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                    <hr class="my-15">
                                    <h4 id="total" class="fs-3 fw-bold lh-1 text-dark text-end">RM0.00</h4>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>

    <script>
        // Tooltip
        var ttip1 = document.getElementById('ttip1')
        var tooltip = new bootstrap.Tooltip(ttip1, {
            placement: 'right',
            customClass: 'fs-14',
            offset: '[0,4]'
        })

        var ncd = <?php echo $quotation['ncd'] ?>;
        var rtprice = <?php echo $quotation['rtprice'] ?>;
        var basicContrib = <?php echo $quotation['basicContrb'] ?>;
        var perils = <?php echo $quotation['perils'] ?>;
        var extraCovrg = <?php echo $quotation['extraCovrg'] ?>;
        var sst = <?php echo $quotation['sst'] ?>;
        var stampDuty = <?php echo $quotation['stampDuty'] ?>;
        var total = document.getElementById('total');
        var total2 = document.getElementById('total2');
        var total3 = document.getElementById('total3');
        var listContribDisc = document.getElementById('list-contribdisc');
        var addRoadtax = false;
        var addSpecial = false;
        var wsPrice = 0;

        // total up windscreen
        document.querySelectorAll('input[name="windscreen"]').forEach(x => {
            x.addEventListener('click', function(e) {
                wsPrice = e.target.value;
                summation();
                newTotalRow("+ Windscreen", e.target.value, "windscreen");
                document.querySelector('input[name=windscreen-selected]').value = e.target.value;
                if (e.target.id === 'wsoptout') {
                    deleteTotalRow('windscreen');
                    document.querySelector('input[name=windscreen-selected]').value = '';
                }
            })
        })

        function newTotalRow(col1, col2, classname) {
            var table = document.querySelector("#mobile-table");
            if (!document.querySelector(`#mobile-table > tbody > tr.${classname}`)) { //check if row with class="windscreen already existed"
                var row = table.insertRow(-1);
                row.classList.add(classname);
                var cell1 = row.insertCell(0);
                var cell2 = row.insertCell(1);
                cell1.innerHTML = col1;
                cell2.innerHTML = col2;
            } else { // if already created, update the value
                document.querySelector(`#mobile-table > tbody > tr.${classname} > td:last-child`).textContent = col2;
            }

            var table = document.querySelector("#desktop-table");
            if (!document.querySelector(`#desktop-table > tbody > tr.${classname}`)) { //check if row with class="windscreen already existed"
                var row = table.insertRow(-1);
                row.classList.add(classname);
                var cell1 = row.insertCell(0);
                var cell2 = row.insertCell(1);
                cell2.classList.add("text-end");
                cell1.innerHTML = col1;
                cell2.innerHTML = col2;
            } else { // if already created, update the value
                document.querySelector(`#desktop-table > tbody > tr.${classname} > td:last-child`).textContent = col2;
            }
        }

        function deleteTotalRow(classname) {
            document.querySelector(`#desktop-table > tbody > tr.${classname}`).remove();
            document.querySelector(`#mobile-table > tbody > tr.${classname}`).remove();
        }

        document.addEventListener('DOMContentLoaded', function(event) {
            summation();
        })

        function handleAddRoadtax() {
            if (!addRoadtax) {
                addRoadtax = true;
                newTotalRow("+Roadtax (incd. delivery)", parseFloat(rtprice+20.0).toFixed(2), "addRoadtax");
                document.querySelector('input[name=roadtax]').value = parseFloat(rtprice).toFixed(2);
            } else {
                addRoadtax = false;
                deleteTotalRow("addRoadtax");
                document.querySelector('input[name=roadtax]').value = '';
            }
            summation();
        }

        function handleAddOns(event) {
            if (event.dataset.name == 'addSpecial' && !addSpecial) {
                addSpecial = true;
                document.getElementById('addPerils').value = 1;
                newTotalRow("+ Perils", perils.toFixed(2), "addperils");
                document.querySelector('input[name=perils]').value = perils;
            } else if (event.dataset.name == 'addSpecial' && addSpecial) {
                addSpecial = false;
                deleteTotalRow("addperils");
                document.querySelector('input[name=perils]').value = '';
            }
            summation();
        }

        function summation(windshield) {
            [ncd, basicContrib, sst, stampDuty, extraCovrg].forEach(function(element) {
                parseInt(element);
            });

            sum = ((100 - ncd * 1) * basicContrib * 1 / 100) + extraCovrg * 1 + sst * 1 + stampDuty * 1;
            sum = sum * 1 + wsPrice * 1;
            sum = addRoadtax ? sum * 1 + rtprice * 1 + 20 : sum;
            sum = windshield > 0 ? parseFloat(sum * 1 + windshield * 1).toFixed(2) : sum;
            sum = addSpecial ? sum * 1 + perils : sum;
            sum = parseFloat(sum).toFixed(2);
            total.innerText = "";
            total.innerText = `RM${sum}`;
            total2.innerText = "";
            total2.innerText = `RM${sum}`;
            total3.value = `${sum}`;
            // totalBefore.innerText = "";
            // totalBefore.append("RM" + parseFloat(basicContrib.value * 1).toFixed(2));
            // totalBefore.setAttribute('value', "RM" + parseFloat(basicContrib.value * 1).toFixed(2));
            // totalAfter.innerText = "";
            // totalAfter.append("RM" + parseFloat((100 - ncd.value * 1) * basicContrib.value * 1 / 100).toFixed(2));
            // totalAfter.setAttribute('value', "RM" + parseFloat((100 - ncd.value * 1) * basicContrib.value * 1 / 100).toFixed(2));
        }


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

        function titleCase(str) {
            var splitStr = str.toLowerCase().split(' ');
            for (var i = 0; i < splitStr.length; i++) {
                splitStr[i] = splitStr[i].charAt(0).toUpperCase() + splitStr[i].substring(1);
            }
            return splitStr.join(' ');
        }
    </script>

    <?php include(ABS_PATH . "/layouts/subs/footer.php"); ?>
</body>



</html>