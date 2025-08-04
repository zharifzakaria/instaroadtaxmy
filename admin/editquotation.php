<?php
require('../config.php');
require('./utils/getState.php');
include(ABS_PATH . '/connection/index.php'); //prod
include(ABS_PATH . '/layouts/subs/header.php');

$vkey = $_GET['vkey'];

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
        $state = getState($postcode);
    }
}

$allCarsDetail = "SELECT `carModel`, `capacity`, `westMsia`, `eastMsia` FROM cars";
$result = mysqli_query($mysqli, $allCarsDetail);
$count = mysqli_num_rows($result);

if ($count > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        $car_model[] = $row['carModel'];
        $engine_capacity[] = $row['capacity'];
        $west_Msia[] = $row['westMsia'];
        $east_Msia[] = $row['eastMsia'];
    }
}

?>

<body>
    <?php include(ABS_PATH . '/layouts/subs/nav.php'); ?>

    <div class="container-fluid" style="background-color:#F8F9FB;">
        <div class="container py-50 mt-50 mt-lg-80">
            <div class="mt-4"><a href="./">← Back</a></div>
            <div class="col-12 mb-4">
                <div class="card mt-4 mb-4">
                    <div class="card-body">
                        <h4 class="card-title fs-4 text-info">Butiran Pelanggan</h4>
                        <p class="card-text">
                            Jenis Kenderaan: <?php echo ucwords($type); ?><br />
                            No. Plat Kenderaan: <?php echo "$plate"; ?><br />
                            No. Kad Pengenalan: <?php echo "$icno"; ?><br />
                            Poskod: <?php echo "$postcode"; ?><br />
                            No. Telefon: <?php echo "$phone"; ?><br />
                    </div>
                </div>
            </div>

            <!-- Start FORM -->
            <form id="quote" method="POST" action="./generateQuote.php" class="needs-validation" novalidate>
                <input type="hidden" name="plate" value="<?php echo $plate; ?>" />
                <input type="hidden" name="icno" value="<?php echo $icno; ?>" />
                <input type="hidden" name="type" value="<?php echo $type; ?>" />
                <input type="hidden" name="postcode" value="<?php echo $postcode; ?>" />
                <input type="hidden" name="email" value="<?php echo $email; ?>" />
                <input type="hidden" name="phone" value="<?php echo $phone; ?>" />
                <input type="hidden" name="state" value="<?php echo $state; ?>" />
                <input type="hidden" name="vkey" value="<?php echo $vkey; ?>" />
                <div class="row d-flex justify-content-between mb-5">
                    <div class="col-12 col-md-9">
                        <div class="card">
                            <div class="card-body" style="position: relative;">
                                <h4 class="mt-2 fs-4 text-info">Maklumat Kenderaan</h4>

                                <?php 
                                
                                if($type === "KERETA") {
                                    include "./carform.php";
                                } else include "./mcycleform.php";

                                ?>


                                <h4 class="mt-4 fs-4 text-info">Pilihan Insuran</h4>
                                <div class="row mt-3">
                                    <label class="col-sm-4 col-form-label">Pilihan Insuran:</label>
                                    <div class="col-sm-4">
                                        <select class="form-select form-select-sm" aria-label=".form-select-sm example" name="insComp" required>
                                            <option selected>Pilih satu</option>
                                            <option value="Zurich">Zurich Insurance</option>
                                            <option value="Etiqa">Etiqa Takaful</option>
                                        </select>
                                    </div>
                                    <div class="col-sm-4">
                                        <p class="fs-6 lh-1 text-secondary"><span class="text-dark badge rounded-pill bg-warning" style="cursor: pointer;" onClick="myopen('https://egms.zurich.com.my/zTakaful/')"> Semak Amaun</span></p>
                                    </div>
                                </div>

                                <h4 class="mt-5 fs-4 text-info">Contribution Detail</h4>
                                <div class="row">
                                    <label class="col-sm-4 col-form-label">Sum Covered (RM):</label>
                                    <div class="col-sm-4">
                                        <div class="input-group mb-3">
                                            <span class="input-group-text">RM</span>
                                            <input type="text" class="form-control" name="sumCovered" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <label class="col-sm-4 col-form-label">Diskaun Tanpa Tuntutan <small><span class="text-dark badge rounded-pill bg-warning" style="cursor: pointer;" onClick="myopen('https://www.mycarinfo.com.my/NCDCheck/Online')">2. Semak NCD</span></small></label>
                                    <div class="col-sm-4">
                                        <div class="input-group mb-3">
                                            <input id="ncd" type="text" class="form-control col-2" name="ncd" required>
                                            <span class="input-group-text">%</span>
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <p class="fs-6 lh-1 text-secondary"><small>Vehicle Registration Number: <?php echo "$plate"; ?><br /> ID Number: <?php echo "$icno"; ?></small></p>
                                    </div>
                                </div>
                                <div class="row">
                                    <label class="col-sm-4 col-form-label">Expiry date</label>
                                    <div class="col-sm-4 mb-3">
                                        <input type="date" class="form-control" name="expiryDate" required>
                                    </div>
                                </div>
                                <div class="row">
                                    <label class="col-sm-4 col-form-label">Basic Contribution</label>
                                    <div class="col-sm-4">
                                        <div class="input-group mb-3">
                                            <span class="input-group-text">RM</span>
                                            <input id="basicContrib" type="text" class="form-control" name="basicContrb" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <label class="col-sm-4 col-form-label">Special Perils</label>
                                    <div class="col-sm-4">
                                        <div class="input-group mb-3">
                                            <span class="input-group-text">RM</span>
                                            <input id="perils" type="text" class="form-control" name="perils" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <label class="col-sm-4 col-form-label">Motor Extra Coverage</label>
                                    <div class="col-sm-4">
                                        <div class="input-group mb-3">
                                            <span class="input-group-text">RM</span>
                                            <input id="motoXCov" type="text" class="form-control" name="extraCovrg">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <label class="col-sm-4 col-form-label">SST</label>
                                    <div class="col-sm-4">
                                        <div class="input-group mb-3">
                                            <span class="input-group-text">RM</span>
                                            <input id="sst" type="text" class="form-control" name="sst" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <label class="col-sm-4 col-form-label">Stamp Duty</label>
                                    <div class="col-sm-4">
                                        <div class="input-group mb-3">
                                            <span class="input-group-text">RM</span>
                                            <input id="stampDuty" type="text" class="form-control" name="stampDuty" value="10" required>
                                        </div>
                                    </div>
                                </div>
                                <!-- <div class="selection d-flex col-12">
                                <div class="card col-4 border-primary" style="margin-right:20px !important;cursor:pointer;">
                                    <div class="card-body">
                                        ✅ 1st party insured: RM 10K
                                        ( Market Value ) <br />
                                        NCD 25% : RM584.27
                                    </div>
                                </div>

                                <div class="card col-4 bg-light" style="margin-right:20px !important;cursor:pointer;">
                                    <div class="card-body">
                                        ✅ Under-insured: RM 8K
                                        ( Market Value ) <br />
                                        NCD 25% : RM433.92
                                    </div>
                                </div>
                            </div> -->


                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-md-3 d-flex flex-column mt-4 mt-md-0">
                        <div class="card p-4">
                            <div class="card-body">
                                <ul class="list-unstyled">
                                    <li><small>After NCD (<span id="ncdTotal">0%</span>) : </small>
                                        <h4><span id="totalAfter">RM0.00</span> <s class="fs-6 text-secondary"><small><span id="totalBefore">RM0.00</span></small></s></h4>
                                    </li>
                                    <li><small>Total: </small>
                                        <h3>RM<span id="total" class="fs-1">0.00</span></h3>
                                    </li>
                                </ul>
                            </div>
                        </div>

                        <div class="pt-5 text-center">
                            <button id="submitQuote" type="submit" name="submit" class="btn btn-lg btn-success">Generate</button>
                            <button class="btn btn-lg btn-warning">Delete</button>
                        </div>

                    </div>
                </div>
            </form>
        </div>
    </div>

    <?php include(ABS_PATH . "/layouts/subs/footer.php"); ?>

    <script language="JavaScript" type="text/javascript">
        function myopen(url) {
            window.open(url, 'links', 'toolbar=0,location=1,directories=0,status=0,menubar=0,scrollbars=auto,resizable=yes,dependent=yes,width=800,height=600');

            window.blur();
        }
        var links; //to avoid "undefined" message
        function clean() {
            if (links != null) {
                links.close()
            };
        }
    </script>

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

    <script>
        var carselect = document.getElementById('selectCar');
        carselect.addEventListener('change', function() {
            var carModel = this.value;
            var state = "<?php echo $state; ?>";
            var xhr = new XMLHttpRequest();
            xhr.onload = function() {
                if (this.status == 200) {
                    document.getElementById("rtpResult").innerHTML = "";
                    document.getElementById("rtpResult").innerHTML = this.responseText;
                    document.getElementById("rtpResult").setAttribute('value', this.responseText);
                }
            }
            xhr.onerror = function() {
                document.getElementById("rtpResult").innerHTML = "Error getting results. Please reload.";
            }
            xhr.open("GET", "./get-rtp.php?query=" + carModel + "&state=" + state, true);
            xhr.send();
        }, false);
    </script>

    <script>
        var ncd = document.getElementById("ncd");
        var basicContrib = document.getElementById("basicContrib");
        var motoXCov = document.getElementById("motoXCov");
        var sst = document.getElementById("sst");
        var stampDuty = document.getElementById("stampDuty");
        var total = document.getElementById("total");
        var ncdTotal = document.getElementById("ncdTotal");
        var totalBefore = document.getElementById("totalBefore");
        var totalAfter = document.getElementById("totalAfter");

        [ncd, basicContrib, sst, stampDuty, motoXCov].forEach(function(element) {
            element.addEventListener("blur", summation);
        });

        function summation() {
            sum = parseFloat(((100 - ncd.value * 1) * basicContrib.value * 1 / 100) + motoXCov.value * 1 + sst.value * 1 + stampDuty.value * 1).toFixed(2);
            total.innerText = "";
            total.append(sum);
            total.setAttribute('value', sum);
            ncdTotal.innerText = "";
            ncdTotal.append(ncd.value + '%');
            ncdTotal.setAttribute('value', ncd.value + '%');
            totalBefore.innerText = "";
            totalBefore.append("RM" + parseFloat(basicContrib.value * 1).toFixed(2));
            totalBefore.setAttribute('value', "RM" + parseFloat(basicContrib.value * 1).toFixed(2));
            totalAfter.innerText = "";
            totalAfter.append("RM" + parseFloat((100 - ncd.value * 1) * basicContrib.value * 1 / 100).toFixed(2));
            totalAfter.setAttribute('value', "RM" + parseFloat((100 - ncd.value * 1) * basicContrib.value * 1 / 100).toFixed(2));
        }
    </script>

</body>

</html>