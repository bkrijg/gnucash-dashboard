<?php
include('db.php');

$year = date("Y");
$month = date("m");
$week = date("W");

$qry = "select sum(if(post_year=$year,amount,0))amountcy,sum(if(post_year=$year-1,amount,0))amountpy,post_month from gnucash.vtransactions where category ='Boodschappen'
 and post_year in($year,$year-1) and post_month between 1 and $week-1 group by post_month order by post_month";

$result = mysqli_query($con,$qry);
mysqli_close($con);

$table = array();
$table["cols"] = array(
//Labels for the chart, these represent the column titles
array("id" => "", "label" => "PostMonth", "type" => "number"),
array("id" => "", "label" => "PriorYear", "type" => "number"),
array("id" => "", "label" => "CurrentYear", "type" => "number")

);

$rows = array();
foreach($result as $row){
$temp = array();

//Values
$temp[] = array("v" => (integer) $row["post_month"]);
$temp[] = array("v" => (float) $row["amountpy"]);
$temp[] = array("v" => (float) $row["amountcy"]);
$rows[] = array("c" => $temp);
}

$result->free();

$table["rows"] = $rows;

$jsonTable = json_encode($table, true);
echo $jsonTable;
 
?>