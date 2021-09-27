<?php
$error = false;
$sucesso = false;

if(isset($_POST['AltCadLab'])) {
    $contador = 0;
    $posicao = 0;
    $cnpj = $_POST['cnpj'];
    $alterar = $_POST['novoValor'];
    $valor_novo = $_POST['valorNovo'];
    
    if ($_SESSION['cnpj'] == $cnpj) {
        $xml=simplexml_load_file("users/laboratorios.xml") or die ("Erro ao abrir arquivo de laboratórios!");
        foreach($xml->children() as $ch) {
            if ($ch->cnpj == $cnpj) {
                // echo ("Achei a posicao no xml!"); //
                $posicao = $contador;
            }
            $contador= $contador+1;
        }
        $xml->lab[$posicao]->$alterar = $valor_novo;
        $s = simplexml_import_dom($xml);
        $s->saveXML ('users/laboratorios.xml');
        $sucesso = true;
    }else{
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
        <title>Cadastro de laboratórios - Bem Estar Saúde</title>
    </head>
    <body>
        <h1>Alterar cadastro de laboratórios </h1>
        <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
        <label> Digite o CNPJ do laboratório: </label>
        <input type="text" name="cnpj" id= "cnpj">
        <br>
        <p> Marque a opção que deseja atualizar </p>
        <label>
            Nome <input type="radio" name="novoValor" value="troca">
        </label>

        <label>
            Endereço <input type="radio" name="novoValor" value="troca">
        </label>

        <label>
            Telefone <input type="radio" name="novoValor" value="troca">
        </label>

        <label>
            E-mail <input type="radio" name="novoValor" value="troca">
        </label>

        <label>
            Tipo de Exames <input type="radio" name="novoValor" value="troca">
        </label>

        <label>
            CNPJ <input type="radio" name="cnpj" value="troca">
        </label>
        <br>
        <p>Digite o novo valor da caixa marcada acima <input type="text" name="valorNovo" size="20" /></p> 
        <br>
        <input type="submit" name="AltCadLab" value="Alterar Dados">
    </form>
    </body>
</html>