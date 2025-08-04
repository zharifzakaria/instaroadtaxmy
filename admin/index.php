<?php
require('../config.php');
include(ABS_PATH . '/connection/index.php'); //prod
include(ABS_PATH . '/layouts/subs/header.php');

if ($_SESSION['email'] !== $_ENV['ADMIN_EMAIL']) {
    header('Location: ../index.php');
}

$allCustomers = "SELECT * FROM users";
$result = mysqli_query($mysqli, $allCustomers);
$count = mysqli_num_rows($result);

$status = "SELECT COUNT(`status`) AS 'Baru' FROM `users` WHERE `status` = 0";
$result2 = mysqli_query($mysqli, $status);
$row = mysqli_fetch_assoc($result2);
$newCustomer = $row['Baru'];

$status = "SELECT COUNT(`status`) AS 'Telah Bayar' FROM `users` WHERE `status` = 3";
$result3 = mysqli_query($mysqli, $status);
$row = mysqli_fetch_assoc($result3);
$paid = $row['Telah Bayar'];

$status = "SELECT COUNT(`status`) AS 'Tukar' FROM `users` WHERE `status` = 2";
$result4 = mysqli_query($mysqli, $status);
$row = mysqli_fetch_assoc($result4);
$change = $row['Tukar'];

$status = "SELECT COUNT(`status`) AS 'Pending' FROM `users` WHERE `status` = 1";
$result5 = mysqli_query($mysqli, $status);
$row = mysqli_fetch_assoc($result5);
$pending = $row['Pending'];
?>

<body>
    <?php include(ABS_PATH . '/layouts/subs/nav.php'); ?>

    <div class="container-fluid" style="background-color:#F8F9FB;">
        <div class="container py-50 mt-50 mt-lg-80" style="min-height:800px;">
            <h1 class="fs-24 text-dark"><svg class="mb-1" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <rect x="3" y="3" width="18" height="18" rx="2" />
                    <path d="M3 9h18M9 21V9" />
                </svg> Dashboard</h1>

            <div class="col-12">
                <div class="row row-cols-12">
                    <div class="col-6 col-lg-2 mt-15 mt-lg-0">
                        <div class="card" style="height:100%;">
                            <div class="card-header" style="background-color: #faf8ff;">
                                <h3 class="fs-14 text-center p-0 m-0 text-muted">Baru</h3>
                            </div>
                            <p class="fs-24 m-auto"><?php echo $newCustomer; ?></p>
                        </div>
                    </div>
                    <div class="col-6 col-lg-2 mt-15 mt-lg-0">
                        <div class="card" style="height:100%;">
                            <div class="card-header" style="background-color: #faf8ff;">
                                <h3 class="fs-14 text-center p-0 m-0 text-muted">Tukar Sebutharga</h3>
                            </div>
                            <p class="fs-24 m-auto"><?php echo $change; ?></p>
                        </div>
                    </div>
                    <div class="col-6 col-lg-2 mt-15 mt-lg-0">
                        <div class="card" style="height:100%;">
                            <div class="card-header" style="background-color: #faf8ff;">
                                <h3 class="fs-14 text-center p-0 m-0 text-muted">Telah Diproses</h3>
                            </div>
                            <p class="fs-24 m-auto"><?php echo $pending; ?></p>
                        </div>
                    </div>
                    <div class="col-6 col-lg-2 mt-15 mt-lg-0">
                        <div class="card" style="height:100%;">
                            <div class="card-header" style="background-color: #faf8ff;">
                                <h3 class="fs-14 text-center p-0 m-0 text-muted">Telah Bayar</h3>
                            </div>
                            <p class="fs-24 m-auto"><?php echo $paid; ?></p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- List Group -->
            <div class="mt-15">
                <?php
                if ($count > 0) {
                    while ($row = mysqli_fetch_assoc($result)) {
                        $i = 0;
                        $email = $row['email'];
                        $plate = $row['plate'];
                        $phone = $row['phone'];
                        $type = $row['type'];
                        $vkey = $row['vkey'];

                        if ($row['status'] == 1) {
                            $status = "<span class=\"badge rounded-pill bg-warning\">Telah diproses</span>";
                            $actionBtn = "<button class=\"btn rounded-pill py-0 px-1\"><a href=\"../rg/view.php?vkey=" . $vkey  . "\"><svg xmlns=\"http://www.w3.org/2000/svg\" width=\"20\" height=\"20\" viewBox=\"0 0 24 24\" fill=\"none\" stroke=\"#212529\" stroke-width=\"2\" stroke-linecap=\"round\" stroke-linejoin=\"round\"><path d=\"M20 14.66V20a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V6a2 2 0 0 1 2-2h5.34\"></path><polygon points=\"18 2 22 6 12 16 8 16 8 12 18 2\"></polygon></svg></a></button>";
                        } else if ($row['status'] == 2) {
                            $status = "<span class=\"badge rounded-pill bg-danger\">Tukar Sebutharga</span>";
                            $actionBtn = "<button class=\"btn rounded-pill py-0 px-1\"><a href=\"./editquotation.php?vkey=" . $vkey  . "\"><svg xmlns=\"http://www.w3.org/2000/svg\" width=\"20\" height=\"20\" viewBox=\"0 0 24 24\" fill=\"none\" stroke=\"#212529\" stroke-width=\"2\" stroke-linecap=\"round\" stroke-linejoin=\"round\"><line x1=\"12\" y1=\"5\" x2=\"12\" y2=\"19\"></line><line x1=\"5\" y1=\"12\" x2=\"19\" y2=\"12\"></line></svg></a></button>";
                        } else if ($row['status'] == 3) {
                            $status = "<span class=\"badge rounded-pill bg-success\">Pembayaran Selesai</span>";
                            $actionBtn = "<button class=\"btn rounded-pill py-0 px-1\"><a href=\"../order/view.php?ref=" . $vkey  . "\"><svg xmlns=\"http://www.w3.org/2000/svg\" width=\"19\" height=\"19\" viewBox=\"0 0 24 24\" fill=\"none\" stroke=\"#212529\" stroke-width=\"2\" stroke-linecap=\"round\" stroke-linejoin=\"round\"><polyline points=\"6 9 6 2 18 2 18 9\"></polyline><path d=\"M6 18H4a2 2 0 0 1-2-2v-5a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v5a2 2 0 0 1-2 2h-2\"></path><rect x=\"6\" y=\"14\" width=\"12\" height=\"8\"></rect></svg></a></button>";
                        } else {
                            $status = "<span class=\"badge rounded-pill bg-primary\">Baru</span>";
                            $actionBtn = "<button class=\"btn rounded-pill py-0 px-1\"><a href=\"./editquotation.php?vkey=" . $vkey  . "\"><svg xmlns=\"http://www.w3.org/2000/svg\" width=\"20\" height=\"20\" viewBox=\"0 0 24 24\" fill=\"none\" stroke=\"#212529\" stroke-width=\"2\" stroke-linecap=\"round\" stroke-linejoin=\"round\"><line x1=\"12\" y1=\"5\" x2=\"12\" y2=\"19\"></line><line x1=\"5\" y1=\"12\" x2=\"19\" y2=\"12\"></line></svg></a></button>";
                        }
                        echo "<li class=\"list-group-item d-flex justify-content-between align-items-start\">
                    <div class=\"ms-2 me-auto\">
                        <div class=\"fw-bold\">" . $email . "</div>"
                            . $status . " " . $plate . "<div class=\"d-flex flex-nowrap\">" . $actionBtn . "<button data-id=\"" . $vkey . "\" class=\"btn rounded-pill delete py-0 px-1\"><svg xmlns=\"http://www.w3.org/2000/svg\" width=\"20\" height=\"20\" viewBox=\"0 0 24 24\" fill=\"none\" stroke=\"currentColor\" stroke-width=\"2\" stroke-linecap=\"round\" stroke-linejoin=\"round\"><polyline points=\"3 6 5 6 21 6\"></polyline><path d=\"M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2\"></path><line x1=\"10\" y1=\"11\" x2=\"10\" y2=\"17\"></line><line x1=\"14\" y1=\"11\" x2=\"14\" y2=\"17\"></line></svg></button></div>
                    </div>
                </li>";
                        $i++;
                    }
                }
                ?>
            </div>
            <!-- pagination for list-group -->
            <!-- <nav aria-label="pagination">
                <ul class="pagination justify-content-end mt-15">
                    <li class="page-item disabled">
                        <a class="page-link">Previous</a>
                    </li>
                    <li class="page-item"><a class="page-link" href="#">1</a></li>
                    <li class="page-item active" aria-current="page">
                        <a class="page-link" href="#">2</a>
                    </li>
                    <li class="page-item"><a class="page-link" href="#">3</a></li>
                    <li class="page-item">
                        <a class="page-link" href="#">Next</a>
                    </li>
                </ul>
            </nav> -->
        </div>
    </div>

    <?php include(ABS_PATH . "/layouts/subs/footer.php"); ?>
</body>

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
    $(document).ready(function() {

        // Delete 
        $('.delete').click(function() {
            var el = this;

            // Delete id
            var deleteid = $(this).data('id');

            var confirmalert = confirm("Are you sure?");
            if (confirmalert == true) {
                // AJAX Request
                $.ajax({
                    url: `deleteUser.php`,
                    type: 'POST',
                    data: {
                        id: deleteid
                    },
                    success: function(response) {
                        $(el).closest('li').css('background', 'white');
                        $(el).closest('li').fadeOut(800, function() {
                            $(this).remove();
                        });
                    }
                })
            }
        });
    });
</script>

</html>