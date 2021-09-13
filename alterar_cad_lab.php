<?php
$error = false;
$sucesso = false;

if(isset($_POST['AltMed'])) {
    $contador = 0;
    $posicao = 0;
    $cnpj = $_POST['cnpj'];
    $alterar = $_POST['trocado'];
    $valor_novo = $_POST['valor_novo'];
    
    if ($_SESSION['cnpj'] == $cnpj) {
        $xml=simplexml_load_file("users/laboratiorios.xml") or die ("Erro ao abrir arquivo de laboratórios!");
        foreach($xml->children() as $sk) {
            if ($sk->cnpj == $cnpj) {
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
        <label>
            Nome <input type="radio" name="nome" value="troca">
        </label>

        <label>
            Endereço <input type="radio" name="endereco" value="troca">
        </label>

        <label>
            Telefone <input type="radio" name="telefone" value="troca">
        </label>

        <label>
            E-mail <input type="radio" name="email" value="troca">
        </label>

        <label>
            Tipo de Exames <input type="radio" name="tipoexames" value="troca">
        </label>

        <label>
            CNPJ <input type="radio" name="cnpj" value="troca">
        </label>
        <br>
        <p>Digite o novo valor da caixa marcada acima <input type="text" name="novo" size="20" /></p> 
        <br>
        <input type="submit" name="AltMed" value="Alterar Dados">
    </form>
    </body>
</html>