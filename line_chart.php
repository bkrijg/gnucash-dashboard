<?php
include('db.php');

$year = date("Y");
$month = date("m");
$week = date("W");

$qry = "select sum(if(post_year=$year,amount,0))amountcy,sum(if(post_year=$year-1,amount,0))amountpy,post_week from gnucash.vtransactions where category ='Boodschappen'
 and post_year in($year,$year-1) and post_week between 1 and $week-1 group by post_week order by post_week";

$result = mysqli_query($con,$qry);
mysqli_close($con);

$table = array();
$table["cols"] = array(
//Labels for the chart, these represent the column titles
array("id" => "", "label" => "PostWeek", "type" => "number"),
array("id" => "", "label" => "CurrentYear", "type" => "number"),
array("id" => "", "label" => "PriorYear", "type" => "number")

);

$rows = array();
foreach($result as $row){
$temp = array();

//Values
$temp[] = array("v" => (float) $row["post_week"]);
$temp[] = array("v" => (float) $row["amountcy"]);
$temp[] = array("v" => (float) $row["amountpy"]);
$rows[] = array("c" => $temp);
}

$result->free();

$table["rows"] = $rows;

$jsonTable = json_encode($table, true);
echo $jsonTable;
 
?>