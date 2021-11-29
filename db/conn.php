<?php

$server="localhost";
$user="root";
$pass="";
$db = "BemEstarSaude";

try{
    $conn = new PDO("mysql:host=localhost", $user, $pass);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo "Conectado!";

    $sql = "CREATE DATABASE $db";
    $conn->exec($sql);
    echo "Banco de dados $db foi criado!";

    // $sql = "CREATE TABLE laboratorios (
    //     cnpj INT UNSIGNED NOT NULL,
    //     nome VARCHAR(80) NOT NULL,
    //     end VARCHAR(120) NOT NULL,
    //     telefone INT NOT NULL,
    //     tipoexame VARCHAR(250) NOT NULL, 
    //     password VARCHAR(80) NOT NULL,
    //     PRIMARY KEY(cnpj));";
    // $conn->exec($sql);
    // echo "Tabela de lab foi criada!";
}


catch(PDOException $e){
    echo $sql . "<br" . $e->getMessage();
}

$conn = null;

?>