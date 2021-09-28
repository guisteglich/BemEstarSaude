<?php

$error = false;
$sucesso = false;
if(isset($_POST['AltCadPac'])) {
    $contador = 0;
    $posicao = 0;
    $cpf = $_POST['cpf'];
    $alterar = $_POST['novoValor'];
    $valor_novo = $_POST['valorNovo'];

    // Deu erro no $_SESSION
    // Warning: Undefined variable $_SESSION in C:\xampp\htdocs\BemEstarSaude\alterar_cad_paciente.php on line 12
    // Warning: Trying to access array offset on value of type null in C:\xampp\htdocs\BemEstarSaude\alterar_cad_paciente.php on line 12

    if ($_SESSION['cpf'] == $cpf) {
        $xml=simplexml_load_file("users/pacientes.xml") or die ("Erro ao abrir arquivo de pacientes!");
        foreach($xml->children() as $ch) {
            if ($ch->cpf == $cpf) {
                // echo ("Achei a posicao no xml!"); //
                $posicao = $contador;
            }
            $contador= $contador+1;
        }
        $xml->medico[$posicao]->$alterar = $valor_novo;
        $s = simplexml_import_dom($xml);
        $s->saveXML ('users/pacientes.xml');
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
        <title>Cadastro de pacientes - Bem Estar Saúde</title>
    </head>
    <body>
        <h1>Alterar cadastro de pacientes </h1>
        <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
        <label> Digite o CPF do paciente: </label>
        <input type="text" name="cpf" id= "cpf">
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
            Gênero <input type="radio" name="novoValor" value="troca">
        </label>

        <label>
            Idade <input type="radio" name="novoValor" value="troca">
        </label>

        <label>
            CPF <input type="radio" name="cpf" value="troca">
        </label>
        <br>
        <p>Digite o novo valor da caixa marcada acima <input type="text" name="valorNovo" size="20" /></p> 
        <br>
        <input type="submit" name="AltCadPac" value="Alterar Dados">
    </form>
    </body>
</html>