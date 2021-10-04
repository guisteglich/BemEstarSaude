<?php
session_start();

$encontrado = false;
$error = false;

if(isset($_POST['BuscaExPac'])) {
    $cpf = $_POST['cpf'];
    echo "cpf do paciente: " . $cpf;
    $cnpj = $_SESSION['cnpj'];

    // if ($_SESSION['cnpj'] == $cnpj) {
        $xml=simplexml_load_file("./db/exames.xml") or die ("<br>Erro ao abrir arquivo de consultas!");

        foreach($xml->children() as $ch){
            if ($cpf == $ch->cpf) {
                if ($cnpj == $ch->cnpj){
                echo $encontrado=true;
                }
            }
        }    
        if (!$encontrado) {
            $error = true; 
        }
    // }
}

?>

<!DOCTYPE html>

<html>
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Busca exame do Paciente - Bem Estar Saúde</title>
    </head>
    <body>
        <h1>Buscar exames do paciente </h1>
        <form name="BusConPac" method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
        Insira o CPF do paciente: <input type="text" name="cpf" id="cpf">
        <br>
        <input type="submit" name="BuscaExPac" value="Buscar consultas">
        </form>

        <?php
        if ($error) {
            echo '<p> Nenhum paciente ou laboratório com os dados inseridos foi encontrado </p>' ; 
        }
        if ($encontrado) {
            foreach($xml->children() as $ch) {
                if ($ch->cpf == $cpf) {
                    if ($cnpj == $ch->cnpj){
                    echo '<table>';
                    echo "<tr><td> Data do exame: $ch->data </td></tr>";
                    echo "<tr><td> Tipo de exame: $ch->tipoexame </td></tr>";
                    echo "<tr><td> Resultado do exame: $ch->resultado </td></tr>";
                    echo "</table>";
                    echo "<br>";
                }
            } 
            }  
        }
        ?>
    </body>
</html>