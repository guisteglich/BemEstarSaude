<?php
session_start();

$error = false;
$confirmar = false;

if(isset($_POST['CadCon'])) {
    $crm = $_SESSION['crm'];
    $cpf = $_POST['cpf'];
    $obs = $_POST['obs'];
    $receita = $_POST['receita'];
    $data = $_POST['data'];

    $xml=simplexml_load_file("users/consultas.xml") or die ("Erro ao abrir arquivo de consultas!");

    foreach($xml->children() as $ch) {
        if ($ch->crm == $crm){
            if ($ch->cpf == $cpf) {
                if ($ch->data == $data) {
                    $error = true;    
                }
            }
        }
    }

    if ($error == false){
        $add = $xml->addChild("consulta"); 
        $add -> addChild("cpf", $cpf);
        $add -> addChild("crm", $crm);
        $add -> addChild("data", $data);
        $add -> addChild("receita", $receita);
        $add -> addChild("obs", $obs);

        $s = simplexml_import_dom($xml);
        $s->saveXML ('users/consultas.xml');
        
        $confirmar = true;
        
        }
}
?>

<!DOCTYPE html>

<html>
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Cadastro de Consultas - Bem Estar Saúde</title>
    </head>
    <body>
        <h1>Cadastro de consulta </h1>
        <form name="CadCon" method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
        <label>Insira o CPF do paciente: </label>
        <input type="text" name="cpf" id="cpf">
        <br>
        <label>Data da consulta: </label>
        <input type="text" name="data" id="data">
        <br>
        <label>Receita: </label>
        <input type="text" name="receita" id="receita">
        <br>
        <label>Observações: </label>
        <input type="text" name="obs" id="obs">

        <br>
        <input type="submit" name="CadCon" value="Confirmar Consulta">

        <?php
            if ($error) {
                echo '<p> Consulta com esse paciente já está cadastrada neste dia </p>' ; 
            }
            else {
                if ($confirmar == true) {
                    echo 'Cadastrado com sucesso!';
                }
            }
            ?>
        </form>
    </body>
</html>