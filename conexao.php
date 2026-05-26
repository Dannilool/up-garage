<?php

$host = "upgarage.local";
$user = "root";
$pass = "";
$db   = "up_garage";

$conn = mysqli_connect($host, $user, $pass, $db);

if (!$conn) {
    die("Erro na conexão com o banco: " . mysqli_connect_error());
}
?>