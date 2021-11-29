<?php

$server="localhost";
$user="root";
$pass="";
$db = "BemEstarSaude";

try{
    $conn = new PDO("mysql:host=$server", $user, $pass);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $sql = "CREATE DATABASE $db";
    $conn->exec($sql);
    echo "Banco de dados $db foi criado!";
    }
catch(PDOException $e){
    echo $sql . "<br" . $e->getMessage();
}


$conn = null;

?>