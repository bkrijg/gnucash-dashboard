<?php
include('db_cr.php');
$con = mysqli_connect($host,$user,$passwd);
if(!$con)
{
  die("Could not connect: " . mysqli_error($con));
}
//$con = mysqli_select_db($con,"gnucash");
//if(!$con)
//{
//	echo "Database Not Connected";
//}

?>

