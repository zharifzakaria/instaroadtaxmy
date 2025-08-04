<?php 
require('../config.php');
include(ABS_PATH . '/connection/index.php'); //prod
include(ABS_PATH . '/layouts/subs/header.php');

$id = 0;
if(isset($_POST['id'])){
   $id = mysqli_real_escape_string($mysqli,$_POST['id']);
}
if($id > 0){

  // Check record exists
  $checkRecord = mysqli_query($mysqli,"SELECT * FROM `users` WHERE vkey=\"".$id."\"");
  $totalrows = mysqli_num_rows($checkRecord);

  if($totalrows > 0){
    // Delete record
    $query = "DELETE FROM `users` WHERE vkey=\"".$id."\"";
    mysqli_query($mysqli,$query);
    return 1;
  }else{
    return 0;
  }
}

return 0;