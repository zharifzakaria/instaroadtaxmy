<!-- https://instaroadtax.my/rg/success.php?ref=5da5f0e32997381945600c508609c212 -->

<?php
require('../config.php');
include(ABS_PATH . '/connection/index.php'); //prod
include(ABS_PATH . '/layouts/subs/header.php');
include(ABS_PATH . '/admin/utils/getState.php');

$vkey = $_GET['ref'];

//get all data from table 'paid_orders'
$customerDetails = "SELECT * FROM paid_orders WHERE vkey = '$vkey'";
$result = mysqli_query($mysqli, $customerDetails);
$count = mysqli_num_rows($result);

if ($count > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        $bill_id = $row['bill_id'];
        $status = $row['status'];
        $amount = $row['amount'];
        $name = $row['name'];
        $bill_url = $row['bill_url'];
        $transaction_date = $row['transaction_date'];
    }
}

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
        $add1 = $row['address1'];
        $add2 = $row['address2'];
        $city = $row['city'];
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
    $quotation['perils'] = $row['perils'];
    $quotation['windscreen'] = $row['windscreen'];
    $quotation['roadtax'] = $row['roadtax'];
    $quotation['extraCovrg'] = $row['extraCovrg'];
    $quotation['sst'] = $row['sst'];
    $quotation['stampDuty'] = $row['stampDuty'];

    if ($row['ncd'] > 0) {
        $quotation['basicContrb'] = $row['basicContrb'] * (1 - $row['ncd'] / 100);
    }

    if ($row['add_perils'] !== 1) {
        $quotation['perils'] = 0.00;
    }
}
?>

<body>
    <div class="container-fluid py-50 mt-25 mt-lg-30">
        <div class="container">
            <h3 class="fw-bold mb-3">Order #<?= substr($vkey, 0, 12) ?></h3>
            <div class="row justify-content-center">
                <div class="col-12">
                    <div class="order-1">
                        <div class="mb-3">
                            <h5 class="fs-6">Maklumat Pembayaran</h5>
                            <!-- MAKLUMAT PEMBAYARAN -->
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
                                            <td scope="row">Status Pembayaran</td>
                                            <td class="text-end"><strong><?php echo ucwords($status);  ?></strong></td>
                                        </tr>
                                        <tr>
                                            <td scope="row">Masa Transaksi</td>
                                            <td class="text-end"><?php echo $transaction_date;  ?></td>
                                        </tr>
                                        <tr>
                                            <td scope="row">Amaun Pembayaran</td>
                                            <td class="text-end"><?php echo "RM" . $amount;  ?></td>
                                        </tr>
                                        <tr>
                                            <td scope="row">Resit</td>
                                            <td class="text-end"><a href="<?php echo $bill_url;  ?>" target="_blank"><?php echo $bill_url;  ?></a></td>
                                        </tr>
                                    </tbody>
                                </table>

                                <table class="table table-sm table-borderless fs-14">
                                    <thead>
                                        <tr>
                                            <th scope="col" class="col-6"></th>
                                            <th scope="col" class="col-6"></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td scope="row">Perlindungan Asas</td>
                                            <td class="text-end"><?php echo "RM" . number_format((float)$quotation['basicContrb'], 2, '.', '');  ?></td>
                                        </tr>
                                        <tr>
                                            <td scope="row">Motor Extra Coverage</td>
                                            <td class="text-end"><?php echo "RM" . $quotation['extraCovrg'];  ?></td>
                                        </tr>
                                        <tr>
                                            <td scope="row">Perlindungan Cermin Hadapan</td>
                                            <td class="text-end"><?php echo "RM" . $quotation['windscreen'];  ?></td>
                                        </tr>
                                        <tr>
                                            <td scope="row">Perlindungan Bencana Khas</td>
                                            <td class="text-end"><?php echo "RM" . number_format((float)$quotation['perils'], 2, '.', '');  ?></td>
                                        </tr>
                                        <tr>
                                            <td scope="row">Cukai Jalan (+RM20 penghantaran)</td>
                                            <td class="text-end"><?php echo "RM" . $quotation['roadtax'];  ?></td>
                                        </tr>
                                        <tr>
                                            <td scope="row">SST</td>
                                            <td class="text-end"><?php echo "RM" . $quotation['sst'];  ?></td>
                                        </tr>
                                        <tr>
                                            <td scope="row">Setem Duti</td>
                                            <td class="text-end"><?php echo "RM" . $quotation['stampDuty'];  ?></td>
                                        </tr>
                                        <tr>
                                            <td scope="row"><strong>JUMLAH</strong></td>
                                            <td class="text-end"><?php echo "<strong>RM" . $amount . "</strong>";  ?></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="mb-3">
                            <h5 class="fs-6">Alamat Penghantaran</h5>
                            <!-- Alamat Penghantaran -->
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
                                            <td scope="row">Nama</td>
                                            <td class="text-end"><?php echo $name;  ?></td>
                                        </tr>
                                        <tr>
                                            <td scope="row">Alamat</td>
                                            <td class="text-end"><?php echo $add1 . ", " . $add2;  ?></td>
                                        </tr>
                                        <tr>
                                            <td scope="row">Bandar</td>
                                            <td class="text-end"><?php echo $city;  ?></td>
                                        </tr>
                                        <tr>
                                            <td scope="row">Poskod</td>
                                            <td class="text-end"><?php echo $postcode;  ?></td>
                                        </tr>
                                        <tr>
                                            <td scope="row">No Telefon</td>
                                            <td class="text-end"><?php echo $phone;  ?></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <!-- MAKLUMAT INSURAN -->
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
                                            <td class="text-end"><?php echo $quotation['expiryDate'];  ?></td>
                                        </tr>
                                        <tr>
                                            <td scope="row">Jumlah Perlindungan
                                            </td>
                                            <td class="text-end">
                                                <?php echo "<strong>RM" . number_format($quotation['sumCovered'], 2, '.', ',') . "</strong>";  ?>
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
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>



</html>