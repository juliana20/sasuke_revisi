<?php
$dbUser="root";
$dbPass="";
$dbName="db_surat";
$dbHost="localhost";

$conn=mysqli_connect($dbHost,$dbUser,$dbPass) or die ("Server tidak ditemukan");
mysqli_select_db($conn,$dbName) or die ("database Tidak ditemukan");
?>