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
    echo "Tabela de med foi criada! <br/>";

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
    echo "Tabela de pacientes foi criada! <br>";

    $sql_users = "CREATE TABLE users (
        login VARCHAR(80) NOT NULL,
        password VARCHAR(80) NOT NULL,
        PRIMARY KEY (login));";
    $conn->exec($sql_users);
    echo "Tabela de adms foi criada! <br>";

    $sql_admin = sprintf("INSERT INTO users
            VALUES ('%s', '%s');", $login, $password);
            $conn->exec($sql_admin);

    $sql_exames = "CREATE TABLE exames (
        id INT UNSIGNED NOT NUL AUTO_INCREMENT,
        nome VARCHAR(80) NOT NULL,
        cpf_paciente INT UNSIGNED NOT NULL,
        cnpj_lab INT UNSIGNED NOT NULL,
        data_exame VARCHAR(120) NOT NULL, 
        tipo_exame VARCHAR(250) NOT NULL,
        resultado VARCHAR(250) NOT NULL,        
        PRIMARY KEY(id))
        CONSTRAINT fk_ExamePaciente FOREIGN KEY (cpf_paciente) REFERENCES pacientes(cpf),
        CONSTRAINT fk_ExameLab FOREIGN KEY (cnpj_lab) REFERENCES medicos(cnpj);";
    $conn->exec($sql_exames);
    echo "Tabela de exames foi criada!";

    //  $sql_consultas = "CREATE TABLE consultas (
    //      id_consulta int NOT NULL AUTO_INCREMENT,
    //      nome VARCHAR(80) NOT NULL,
    //      cpf_paciente INT,
    //      crm_medico INT,
    //      data_consulta VARCHAR(120) NOT NULL, 
    //      receita VARCHAR(250) NOT NULL,
    //      obs VARCHAR(250) NOT NULL,        
    //      PRIMARY KEY(id_consulta),
    //      CONSTRAINT fk_ConsultaPaciente FOREIGN KEY (cpf_paciente) REFERENCES pacientes(cpf),
    //      CONSTRAINT fk_ConsultaMed FOREIGN KEY (crm_medico) REFERENCES medicos(crm));";
    //  $conn->exec($sql_consultas);
    //  echo "Tabela de consultas foi criada!";
    
}

catch(PDOException $e){
    echo $sql_lab . "<br" . $e->getMessage();
    echo $sql_med . "<br" . $e->getMessage();
    echo $sql_pac . "<br" . $e->getMessage();
    echo $sql_users . "<br" . $e->getMessage();
    echo $sql_exames . "<br" . $e->getMessage();
    //echo $sql_consultas . "<br" . $e->getMessage();        
}

$conn = null;

?>