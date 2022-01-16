<?php

$server="localhost";
$user="root";
$pass="";
$db = "BemEstarSaude";

$login = "admin";
$password = "adminpass";

try{
    // $conn = new PDO("mysql:host=localhost", $user, $pass);
    $conn = new PDO("mysql:host=$server;dbname=$db", $user, $pass);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo "Conectado! <br/>";

    $sql_admin = "CREATE TABLE admin (
        id_admin INT UNSIGNED NOT NULL AUTO_INCREMENT,
        username VARCHAR(80) NOT NULL,
        password VARCHAR(80) NOT NULL,
        PRIMARY KEY(id_admin));";
    $conn->exec($sql_admin);
    echo "Tabela de admin foi criada! <br>";

    $username = 'admin';
    $password = 'admin123';
    $sql_cadastro_admin  = "INSERT INTO admin(username, password) VALUES('$username', '$password');";
    $conn->exec($sql_cadastro_admin);
    echo "Admin cadastrado com sucesso! <br>";

    $sql_lab = "CREATE TABLE laboratorios (
        cnpj INT UNSIGNED NOT NULL,
        nome VARCHAR(80) NOT NULL,
        end VARCHAR(120) NOT NULL,
        telefone INT NOT NULL,
        tipo_exame VARCHAR(250) NOT NULL, 
        password VARCHAR(80) NOT NULL,
        PRIMARY KEY(cnpj));";
    $conn->exec($sql_lab);
    echo "Tabela de lab foi criada! <br>";


    $sql_med = "CREATE TABLE medicos (
        crm INT UNSIGNED NOT NULL,
        nome VARCHAR(80) NOT NULL,
        end VARCHAR(120) NOT NULL,
        telefone VARCHAR(20) NOT NULL,
        email VARCHAR(250) NOT NULL, 
        especialidade VARCHAR(250) NOT NULL, 
        password VARCHAR(80) NOT NULL,
        PRIMARY KEY(crm));";
    $conn->exec($sql_med);
    echo "Tabela de med foi criada! <br/>";

    $sql_pac = "CREATE TABLE pacientes (
        cpf INT UNSIGNED NOT NULL,
        nome VARCHAR(80) NOT NULL,
        end VARCHAR(120) NOT NULL,
        telefone VARCHAR(20) NOT NULL,
        email VARCHAR(250) NOT NULL, 
        genero VARCHAR(250) NOT NULL,
        idade INT NOT NULL, 
        password VARCHAR(80) NOT NULL,
        PRIMARY KEY(cpf));";
    $conn->exec($sql_pac);
    echo "Tabela de pacientes foi criada! <br>";

    $sql_users = "CREATE TABLE users (
        login VARCHAR(80) NOT NULL,
        password VARCHAR(80) NOT NULL,
        PRIMARY KEY (login));";
    $conn->exec($sql_users);
    echo "Tabela de usuarios foi criada! <br>";

    $sql_exames = "CREATE TABLE exames (
        id_exame INT UNSIGNED NOT NULL AUTO_INCREMENT,
        nome VARCHAR(80) NOT NULL,
        cpf_paciente INT UNSIGNED NOT NULL,
        cnpj_lab INT UNSIGNED NOT NULL,
        data_exame VARCHAR(120) NOT NULL,
        tipo_exame VARCHAR(250) NOT NULL,
        resultado VARCHAR(250) NOT NULL,
        PRIMARY KEY(id_exame),
        FOREIGN KEY fk_ExamePaciente (cpf_paciente) REFERENCES pacientes(cpf),
        FOREIGN KEY fk_ExameLab (cnpj_lab) REFERENCES laboratorios(cnpj));";
    $conn->exec($sql_exames);
    echo "Tabela de exames foi criada! <br>";
        
    $sql_consultas = "CREATE TABLE consultas (
        id_consulta INT UNSIGNED NOT NULL AUTO_INCREMENT,
        nome VARCHAR(80) NOT NULL,
        cpf_paciente INT UNSIGNED NOT NULL,
        crm_medico INT UNSIGNED NOT NULL,
        data_consulta VARCHAR(120) NOT NULL,
        receita VARCHAR(250) NOT NULL,
        obs VARCHAR(250) NOT NULL,
        PRIMARY KEY(id_consulta),
        FOREIGN KEY fk_ConsultaPaciente (cpf_paciente) REFERENCES pacientes(cpf),
        FOREIGN KEY fk_ConsultaMed (crm_medico) REFERENCES medicos(crm));";
    $conn->exec($sql_consultas);
    echo "Tabela de consultas foi criada!";
}

catch(PDOException $e){
    echo $sql_admin . "<br>" . $e->getMessage();
    echo $sql_lab . "<br>" . $e->getMessage();
    echo $sql_med . "<br>" . $e->getMessage();
    echo $sql_pac . "<br>" . $e->getMessage();
    echo $sql_users . "<br>" . $e->getMessage();
    echo $sql_exames . "<br>" . $e->getMessage();
    echo $sql_consultas . "<br>" . $e->getMessage();        
}

$conn = null;
?>