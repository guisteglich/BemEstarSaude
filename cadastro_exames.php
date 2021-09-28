<?php
session_start();

$error = false;
$confirmar = false;

if(isset($_POST['CadEx'])) {
    // $cnpj = $_SESSION['cnpj'];
    $cpf = $_POST['cpf'];
    $data = $_POST['data'];
    $tipoexame = $_POST['tipoexame'];
    $resultado = $_POST['resultado'];
   
    $xml=simplexml_load_file("users/exames.xml") or die ("Erro ao abrir arquivo de exames!");

    foreach($xml->children() as $ex) {
        if ($ex->cnpj == $cnpj){
            if ($ex->cpf == $cpf) {
                if ($ex->data == $data) {
                    $error = true;    
                }
            }
        }
}

if ($error == false){
    $add = $xml->addChild("exame"); 
    $add -> addChild("cpf", $cpf);
    // $add -> addChild("cnpj", $cnpj);
    $add -> addChild("data", $data);
    $add -> addChild("tipoexame", $tipoexame);
    $add -> addChild("resultado", $resultado);

    $s = simplexml_import_dom($xml);
    $s->saveXML ('users/exames.xml') or die ('Erro ao salvar');
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
        <title>Cadastro de Exames - Bem Estar Saúde</title>
    </head>
    <body>
        <h1>Cadastro de exame </h1>
        <form name="CadCon" method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
        <label>CPF do paciente:</label>
        <input type="number" id="cpf" name="cpf">

        <label>Data da consulta:</label>
        <input type="date" id="data" name="data">

        <label>Tipo de exame:</label>
        <input type="text" id="tipoexame" name="tipoexame">

        <label>Resultado:</label>
        <input type="text" id="resultado" name="resultado">
        <br>
        <input type="submit" name="CadEx" value="Cadastrar Exame">
        <?php
            if ($error) {
                echo '<p> Exame com esse paciente ja cadastrada neste dia </p>' ; 
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