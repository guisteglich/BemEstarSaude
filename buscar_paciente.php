<?php

$encontrado = false;
$error = false;

if(isset($_POST['BuscaPac'])) {
    $nome = $_POST['nome'];
    // $crm = $_SESSION['crm'];

    echo "nome: " . $nome;

    $xml=simplexml_load_file("users/pacientes.xml") or die ("Erro ao abrir arquivo de pacientes!");

    foreach($xml->children() as $ch) {
        if ($nome == $ch->nome){
            $encontrado=true;
        }
    }

    if (!$encontrado) {
        $error = true; 
    }     
}
?>

<!DOCTYPE html>

<html>
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Busca Pacientes - Bem Estar Saúde</title>
    </head>
    <body>
        <h1>Buscar Paciente </h1>
        <form name="BusPac" method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
        <p>Insira o nome do paciente: <input type="text" name="nome" id="nome"></p>
        <br>
        <input type="submit" name="BuscaPac" value="Buscar Paciente">
        </form>

        <?php
        if ($error) {
            echo '<p> Nenhum paciente com o nome inserido foi encontrado </p>' ; 
        }
        if ($encontrado) {
            foreach($xml->children() as $ch) {
                if ($ch->nome == $nome) {
                    echo "<tr><td> $ch->cpf </td> ";
                    echo "<td> $ch->nome </td></tr>";
                    echo "<br>";
                } 
            }  
        }
        ?>
    </body>
</html>