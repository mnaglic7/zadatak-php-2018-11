<?php
$servername = "localhost";
$username = "root";
$password = "";


$dbc1 = new mysqli($servername, $username, $password);

if ($dbc1->connect_error) {
    die("Connection failed: " . $dbc1->connect_error);
} 

$dbc1->query("CREATE DATABASE IF NOT EXISTS euroart");

$dbc1->select_db('euroart');
$sql = "CREATE TABLE IF NOT EXISTS zadatak_php ( email varchar(40) NOT NULL, php_verzija varchar(10) NOT NULL, kratak_opis varchar(200) NOT NULL, vrijeme_prijave varchar(20) NOT NULL, kod varchar(10) NOT NULL ) ENGINE=InnoDB DEFAULT CHARSET=utf8;";


if ($dbc1->query($sql) === TRUE) {
    // echo "Tablica uspješno kreirana!";
} else {
    // echo "Tablica nije kreirana: " . $dbc1->error;
}


$dbc = new mysqli($servername, $username, $password,'euroart');

mysqli_close($dbc1);
?>