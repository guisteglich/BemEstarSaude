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

    $sql_lab = "CREATE TABLE laboratorios (
        cnpj INT UNSIGNED NOT NULL,
        nome VARCHAR(80) NOT NULL,
        end VARCHAR(120) NOT NULL,
        telefone INT NOT NULL,
        tipo_exame VARCHAR(250) NOT NULL, 
        password VARCHAR(80) NOT NULL,
        PRIMARY KEY(cnpj));";
    $conn->exec($sql_lab);
    echo "Tabela de lab foi criada!";


    $sql_med = "CREATE TABLE medicos (
        crm INT UNSIGNED NOT NULL,
        nome VARCHAR(80) NOT NULL,
        end VARCHAR(120) NOT NULL,
        telefone INT NOT NULL,
        email VARCHAR(250) NOT NULL, 
        especialidade VARCHAR(250) NOT NULL, 
        password VARCHAR(80) NOT NULL,
        PRIMARY KEY(crm));";
    $conn->exec($sql_med);
    echo "Tabela de med foi criada!";

    $sql_pac = "CREATE TABLE pacientes (
        cpf INT UNSIGNED NOT NULL,
        nome VARCHAR(80) NOT NULL,
        end VARCHAR(120) NOT NULL,
        telefone INT NOT NULL,
        email VARCHAR(250) NOT NULL, 
        genero VARCHAR(250) NOT NULL,
        idade INT NOT NULL, 
        password VARCHAR(80) NOT NULL,
        PRIMARY KEY(cpf));";
    $conn->exec($sql_paci);
    echo "Tabela de pacientes foi criada!";

    $sql_users = "CREATE TABLE users (
        login VARCHAR(80) NOT NULL,
        password VARCHAR(80) NOT NULL,
        PRIMARY KEY (login));";
    $conn->exec($sql_users);
    echo "Tabela de adms foi criada!";

    $sql_exames = "CREATE TABLE pacientes (
        id INT UNSIGNED NOT NUL AUTO_INCREMENT,
        nome VARCHAR(80) NOT NULL,
        cpf INT UNSIGNED NOT NULL,
        cnpj INT UNSIGNED NOT NULL,
        data_exame VARCHAR(120) NOT NULL, 
        tipo_exame VARCHAR(250) NOT NULL,
        resultado VARCHAR(250) NOT NULL,        
        PRIMARY KEY(id))
        FOREIGN KEY (cpf) REFERENCES pacientes(cpf),
        FOREIGN KEY (cnpj) REFERENCES medicos(cnpj);";
    $conn->exec($sql_exames);
    echo "Tabela de exames foi criada!";

    $sql_consultas = "CREATE TABLE pacientes (
        id INT UNSIGNED NOT NUL AUTO_INCREMENT,
        nome VARCHAR(80) NOT NULL,
        cpf INT UNSIGNED NOT NULL,
        crm INT UNSIGNED NOT NULL,
        data_consulta VARCHAR(120) NOT NULL, 
        receita VARCHAR(250) NOT NULL,
        obs VARCHAR(250) NOT NULL,        
        PRIMARY KEY(id)),
        FOREIGN KEY (cpf) REFERENCES pacientes(cpf),
        FOREIGN KEY (crm) REFERENCES medicos(crm);";
    $conn->exec($sql_consultas);
    echo "Tabela de consultas foi criada!";

    
}


catch(PDOException $e){
    echo $sql . "<br" . $e->getMessage();
}

$conn = null;

?>