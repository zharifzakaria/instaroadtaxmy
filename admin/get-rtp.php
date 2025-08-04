<?php
require('../config.php');
include(ABS_PATH . '/connection/index.php'); //prod

$state = $_GET['state'];
if (isset($_GET['query'])) {
    $query = "SELECT * FROM `cars` WHERE `carModel` = '" . $_GET['query'] . "'";
}

$result = mysqli_query($mysqli, $query);
$count = mysqli_num_rows($result);

if ($count > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        $carModel = $row['carModel'];
        $capacity = $row['capacity'];
        $westMsia = $row['westMsia'];
        $eastMsia = $row['eastMsia'];
    }
}

?>


<div class="input-group mb-3">
    <span class="input-group-text">RM</span>
    <input type="text" value="<?php echo ($state == 'Labuan' || $state == 'Sabah' || $state == 'Sarawak') ? $eastMsia : $westMsia; ?>" class="form-control" name="rtPrice">
    <span class="input-group-text"><?php echo $state ?></span>
</div>