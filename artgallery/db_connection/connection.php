<?php

	$dbcon = new PDO("mysql:host=localhost:3306;dbname=artgeek_db;","root","");
    $dbcon->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

?>