<?php
session_start();

$error = false;
$sucesso = false;

if(isset($_POST['AltCadMed'])) {
    $contador = 0;
    $posicao = 0;
    $crm = $_POST['crm'];
    $alterar = $_POST['novoValor'];
    $valor_novo = $_POST['valorNovo'];

    // if ($_SESSION['crm'] == $crm) {
        $xml=simplexml_load_file("users/medicos.xml") or die ("Erro ao abrir arquivo de médicos!");
        foreach($xml->children() as $ch) {
            if ($ch->crm == $crm) {
                // echo ("Achei a posicao no xml!"); //
                $posicao = $contador;
            }
            $contador= $contador+1;
        }
        $xml->medico[$posicao]->$alterar = $valor_novo;
        $s = simplexml_import_dom($xml);
        $s->saveXML ('users/medicos.xml');
        $sucesso = true;
    // }
    // else{
        // $error = true;
    // }
    
}
?>

<!DOCTYPE html>

<html>
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Cadastro de laboratórios - Bem Estar Saúde</title>
    </head>
    <body>
        <h1>Alterar cadastro de médicos </h1>
        <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
        <label> Digite o seu CRM: </label>
        <input type="text" name="crm" id= "crm">
        <br>
        <p> Marque a opção que deseja atualizar </p>
        <label>
            Nome <input type="radio" name="novoValor" value="nome">
        </label>

        <label>
            Endereço <input type="radio" name="novoValor" value="endereco">
        </label>

        <label>
            Telefone <input type="radio" name="novoValor" value="telefone">
        </label>

        <label>
            Especialidade <input type="radio" name="novoValor" value="especialidade">
        </label>

        <label>
            CRM <input type="radio" name="novoValor" value="crm">
        </label>   
        <br>
        <p>Digite o novo valor da caixa marcada acima <input type="text" name="valorNovo" size="20" /></p> 
        <br>
                <input type="submit" name="AltCadMed" value="Alterar Dados">
    </form>
    </body>
</html>