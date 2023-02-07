<?php
include 'db_connection/connection.php';
session_start();

	$id =  $_GET['id'];
	$time = $_GET['t'];
	
	$start_at = date("Y-m-d H:i:s");
	$end_at = date("Y-m-d H:i:s", strtotime($start_at)+(3600 * $time));

	$sqlquery = "UPDATE bid_products SET start_at = '$start_at', end_at = '$end_at' WHERE id = '$id'";
	$returnval1 = $dbcon->exec($sqlquery);
    
?>

<script>
    window.location.assign('bidproductlist.php');
</script>