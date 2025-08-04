<?php
require('../config.php');
include(ABS_PATH . '/connection/index.php'); //prod
include(ABS_PATH . '/layouts/subs/header.php');
?>

<body>
    <?php include(ABS_PATH . '/layouts/subs/nav.php'); ?>

    <div class="container py-50 mt-50 mt-lg-80" style="min-height:35vh;">
        <h1 class="text-left text-lg-center fs-24 pb-5">Log Masuk</h1>

        <div class="card my-2 col-12 col-md-6 mx-auto">
            <div class="card-body">
                <form method="POST" action="../includes/login.inc.php">
                        <div class="mb-3">
                            <label for="InputEmail1" class="form-label fs-6" >Email address</label>
                            <input type="email" name="emel" placeholder="name@email.com" class="form-control" id="InputEmail1" aria-describedby="emailHelp">
                        </div>
                        <div class="mb-3">
                            <label for="InputPassword1" class="form-label fs-6" >Password</label>
                            <input type="password" name="pwd" placeholder="password" class="form-control" id="InputPassword1">
                        </div>
                        <button type="submit" name="login-submit" class="rounded-pill btn btn-warning btn-lg btn-block w-100">Log Masuk</button>
                </form>
            </div>
        </div>
    </div>

    <?php include(ABS_PATH . "/layouts/subs/footer.php"); ?>

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