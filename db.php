<?php
include('db_cr.php');

$con = mysqli_connect($host,$user,$passwd);
if(!$con) {
  die("Could not connect: " . mysqli_error($con));
}
?>

