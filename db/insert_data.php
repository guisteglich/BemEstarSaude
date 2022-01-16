<?php
include '../db/db_connect.php'; 

// Cadastro paciente

$nome = array('Mateus', 'Andrews', 'Guilherme', 'Maria', 'Robledo');
$cpf = array('15338260050', '47469441050', '88850783035', '78296304023', '17680046093');
$end = array(
    'Avenida Romario',
    'Rua Italiana',
    'Avenida Perimetral',
    'Bairro Ferrari',
    'Avenida 15 de Novembro'
);
$telefone = array('(36) 2935-2640', '(52) 5325-1155', '(63) 1623-1645', '(79) 7937-2750', '(21) 2435-2264');
$email = array('mateus@gmail.com', 'andrews@gmail.com', 'guilherme@gmail.com', 'joão@gmail.com', 'robledo@gmail.com');
$genero = array('masculino', 'masculino', 'masculino', 'femenino', 'masculino');
$idade = array('21', '13', '24', '44', '87');


$i = 0;
while ($i <= 4) {
    $query =  "INSERT INTO pacientes(cpf, nome, end, telefone, email, genero, idade) VALUES('$cpf[$i]', '$nome[$i]', '$end[$i]', '$telefone[$i]', '$email[$i]', '$genero[$i]', '$idade[$i]');";
    $result = mysqli_query($connect, $query);
    if ($result) {
        echo 'Paciente ' , $i , ' cadastrado com sucesso! <br>';
    }
    
    $i++;
}

// Cadastro Médico

$nome = array('Paulo', 'José', 'Marconi', 'Roberto', 'Tarciso');
$crm = array('111', '222', '333', '444', '555');
$end = array(
    'Avenida Uruguai',
    'Rua 15 de Outubro',
    'Bairo Bosque',
    'Bairro BGV',
    'Vila Veneza'
);
$telefone = array('(66) 2535-2540', '(22) 5122-1354', '(24) 4643-1444', '(75) 7535-2550', '(11) 2131-1214');
$email = array('paulo@gmail.com', 'jose@gmail.com', 'marconi@gmail.com', 'roberto@gmail.com', 'tarciso@gmail.com');
$especialidade = array('Cardiologista', 'Oftamologo', 'Nutricionista', 'Infectologista', 'Dermatologista');
$password= array('111', '222', '333', '444', '555');


$i = 0;
while ($i <= 4) {
    $query =  "INSERT INTO medicos(crm, nome, end, telefone, email, especialidade, password) VALUES('$crm[$i]', '$nome[$i]', '$end[$i]', '$telefone[$i]', '$email[$i]', '$especialidade[$i]', '$password[$i]');";
    $result = mysqli_query($connect, $query);
    if ($result) {
        echo 'Médico ' , $i , ' cadastrado com sucesso! <br>';
    }
    
    $i++;
}

// Cadastro laboratórios

$cnpj = array('98562258040355', '18262148506167', '38363128201124', '62562118405165', '92263556070835');
$nome = array('lab1', 'lab2', 'lab3', 'lab4', 'lab5');
$end = array(
    'Avenida Doutor Aurelio Catani',
    'Rua Conde de Porto Alegre',
    'Avenida Perimetral',
    'Bairro João Landell',
    'Avenida Portugal'
);
$telefone = array('(16) 2933-2140', '(32) 3322-1145', '(23) 1923-1445', '(99) 9933-2250', '(11) 2435-2560');
$tipo_exame = array('COVID', 'Gripe', 'Hipatite', 'Diarréia', 'Catapora');
$email = array('lab1@gmail.com', 'lab2@gmail.com', 'lab3@gmail.com', 'lab4@gmail.com', 'lab5@gmail.com');
$password = array('lab1', 'lab2', 'lab3', 'lab4', 'lab5');

$i = 0;
while ($i <= 4) {
    $query =  "INSERT INTO laboratorios(cnpj, nome, end, telefone, tipo_exame, email, password) VALUES('$cnpj[$i]', '$nome[$i]', '$end[$i]', '$telefone[$i]', '$tipo_exame[$i]', '$email[$i]', '$password[$i]');";
    $result = mysqli_query($connect, $query);
    if ($result) {
        echo 'Lab ' , $i , ' cadastrado com sucesso! <br>';
    }
    
    $i++;
}

// Cadastro consulta

$nome = array('Mateus', 'Andrews', 'Guilherme', 'João', 'Robledo');
$cpf = array('15338260050', '47469441050', '88850783035', '78296304023', '17680046093');
$crm = array('111', '222', '333', '444', '555');
$data = array('31/04/2021', '23/05/2021-', '22/02/2021', '22/02/2021', '31/04/2021');
$data_consulta_db = array('2021-04-31', '2021-05-23', '2021-02-22', '2021-05-22', '2022-01-02');
$receita = array('Diclofenaco', 'Proparoxina', 'Creatina', 'Analgesico', 'Vitamina D');
$obs = array('2 por dia', 'A cada 6 horas', '3  vezes na semana', '3 por dia', '4 por dia');

$i = 0;
while ($i <= 4) {
    $query =  "INSERT INTO consultas(nome, cpf_paciente, crm_medico, data_consulta, data_consulta_db, receita, obs) VALUES('$nome[$i]', '$cpf[$i]', '$crm[$i]','$data[$i]', '$data_consulta_db[$i]', '$receita[$i]', '$obs[$i]');";
    $result = mysqli_query($connect, $query);
    if ($result) {
        echo 'Consulta ' , $i , ' cadastrado com sucesso! <br>';
    }
    
    $i++;
}

// Cadastro exame

$nome = array('Mateus', 'Andrews', 'Guilherme', 'João', 'Robledo');
$cpf = array('15338260050', '47469441050', '88850783035', '78296304023', '17680046093');
$cnpj = array('98562258040355', '18262148506167', '38363128201124', '62562118405165', '92263556070835');
$data = array('31/04/2021', '23/05/2021', '22/02/2021', '22/02/2021', '31/04/2021');
$data_exame_db = array('2021-04-31', '2021-05-23', '2021-02-22', '2021-05-22', '2022-01-02');
$tipo = array('Colesterol ', 'Hemograma', 'Creatina', 'TGO', 'Exame de urina');
$resultado = array('Normal', 'Normal', 'Abaixo', 'Abaixo', 'Normal');

$i = 0;
while ($i <= 4) {
    $query =  "INSERT INTO exames(nome, cpf_paciente, cnpj_lab, data_exame, data_exame_db, tipo_exame, resultado) VALUES('$nome[$i]', '$cpf[$i]', '$cnpj[$i]', '$data[$i]', '$data_exame_db[$i]', '$tipo[$i]', '$resultado[$i]');";
    $result = mysqli_query($connect, $query);
    if ($result) {
        echo 'Exame ' , $i , ' cadastrado com sucesso! <br>';
    }
    
    $i++;
}

?>