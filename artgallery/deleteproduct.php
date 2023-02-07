<?php
include 'db_connection/connection.php';
session_start();


	$productId = $_GET['pId'];

	$sqlquery = "DELETE FROM products WHERE id = '$productId'";
	$returnval = $dbcon->exec($sqlquery);


?>

<script>
    window.location.assign('productlist.php');
</script>