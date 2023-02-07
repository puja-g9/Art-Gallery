<?php
include 'db_connection/connection.php';
session_start();

	$id =  $_GET['id'];
	$pId = $_GET['pId'];

	$sqlquery = "DELETE FROM bid_products WHERE id = '$id'";
	$returnval1 = $dbcon->exec($sqlquery);
    
	$sqlquery = "UPDATE products SET bid_status = 0 WHERE id = '$pId'";
    $returnVal = $dbcon->exec($sqlquery);

?>

<script>
    window.location.assign('bidproductlist.php');
</script>