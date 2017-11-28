<?php
require ("database.php");

$id = $_GET["id"];

$statement = $pdo->prepare("DELETE FROM songsammlung WHERE id='$id'");
$res = $statement->execute();

// BackwardPage
$page = "/songsammlung?theme=dark&delete";
$sec = "0";
header("Refresh: $sec; url=$page");

?>