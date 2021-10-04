<?php
session_start();

$encontrado = false;
$error = false;

if(isset($_POST['BuscaConPac'])) {
    $cpf = $_POST['cpf'];
    echo "cpf do paciente: " . $cpf;
    // $Scpf = $_SESSION['cpf'];

    // if ($_SESSION['cpf'] == $Scpf) {
        $xml=simplexml_load_file("./db/consultas.xml") or die ("<br>Erro ao abrir arquivo de consultas!");

        foreach($xml->children() as $ch){
            if ($cpf == $ch->cpf) {
                echo $encontrado=true;
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
        <title>Busca consulta do Paciente - Bem Estar Saúde</title>
    </head>
    <body>
        <h1>Buscar consultas do paciente </h1>
        <form name="BusConPac" method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
        Insira o CPF do paciente: <input type="text" name="cpf" id="cpf">
        <br>
        <input type="submit" name="BuscaConPac" value="Buscar consultas">
        </form>

        <?php
        if ($error) {
            echo '<p> Nenhum paciente com o CPF inserido foi encontrado </p>' ; 
        }
        if ($encontrado) {
            foreach($xml->children() as $ch) {
                if ($ch->cpf == $cpf) {
                    echo '<table>';
                    echo "<tr><td> CRM do seu médico: $ch->crm </td></tr>";
                    echo "<tr><td> Medicamento recomendado: $ch->receita </td></tr>";
                    echo "<tr><td> Dia que foi realizada a consulta: $ch->data </td></tr>";
                    echo "</table>";
                    echo "<br>";
                } 
            }  
        }
        ?>
    </body>
</html>