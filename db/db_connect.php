<?php
session_start();

$server="localhost";
$user="root";
$password="";
$db = "BemEstarSaude";

$connect = new mysqli($server, $user, $password, $db) or die('Não foi possível conectar com o servidor.');
?>