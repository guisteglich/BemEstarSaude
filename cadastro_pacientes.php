<?php

 $nome = $endereco = $telefone = $email = $genero = $idade = $cpf = '';

 if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nome = input($_POST["nome"]);
    $endereco = input($_POST["endereco"]);
    $telefone = input($_POST["telefone"]);
    $email = input($_POST["email"]);
    $genero = input($_POST["genero"]);
    $idade = input($_POST["idade"]);
    $cpf = input($_POST["cpf"]);
     
 }

 function input($data) {
     $data = trim($data);
     $data = stripslashes($data);
     // $data = htmlspecialchars($data);
     return $data;
 }
    
    $xml=simplexml_load_file("./users/pacientes.xml") or die ("Erro ao abrir o arquivo!");

    $node = $xml->addChild("paciente"); 
    $node->addChild("nome", $nome);
    $node->addChild("endereco", $endereco);
    $node->addChild("email", $email);
    $node->addChild("telefone", $telefone);
    $node->addChild("genero", $genero);
    $node->addChild("idade", $idade);
    $node->addChild("cpf", $cpf);


    $save = simplexml_import_dom($xml);
    
    echo $save->saveXML("users/pacientes.xml");
    

    echo "<h2>Saída dos resultados:</h2>";
    echo $nome;
    echo "<br>";
    echo $idade;
    echo "<br>";
    echo $senha;
    echo "<br>";
    echo $email;
    echo "<br>";
    echo $genero;
    echo "<br>";
    echo $idade;
    echo "<br>";
    echo $cpf;
    echo "<br>";

?>

<!DOCTYPE html>

<html>
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Cadastro de pacientes - Bem Estar Saúde</title>
    </head>
    <body>
        <h1>Cadastro de pacientes </h1>
        <form name="CadPacientes" method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
            <label>Nome:</label>
            <input type="text" name="nome" id="nome">

            <label>Endereço:</label>
            <input type="text" name="endereco" id="endereco">

            <label>Telefone:</label>
            <input type="tel" name="telefone" id="telefone">

            <label>E-mail:</label>
            <input type="email" name="email" id="email">

            <label>Gênero:</label>
            <input type="text" name="genero" id="genero">

            <label>Idade:</label>
            <input type="number" name="idade" id="idade">

            <label>CPF:</label>
            <input type="number" name="cpf" id="cpf">
            <br>
            <input type="submit" name="cadastrar" value="Cadastrar Paciente">
    </form>