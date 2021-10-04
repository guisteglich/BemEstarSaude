<?php
session_start();

$error = false;
$sucesso = false;

if(isset($_POST['AltCadLab'])) {
    $contador = 0;
    $posicao = 0;
    $cnpj = $_SESSION['cnpj'];
    $alterar = $_POST['novoValor'];
    $valor_novo = $_POST['valorNovo'];

    if ($_SESSION['cnpj'] == $cnpj) { 
        $xml=simplexml_load_file("../db/laboratorios.xml") or die ("Erro ao abrir arquivo de laboratórios!");
        foreach($xml->children() as $ch) {
            if ($ch->cnpj == $cnpj) {
                // echo ("Achei a posicao no xml!"); //
                $posicao = $contador;
            }
            $contador= $contador+1;
        }
        $xml->laboratorio[$posicao]->$alterar = $valor_novo;
        $s = simplexml_import_dom($xml);
        $s->saveXML ('../db/laboratorios.xml');
        // echo "<script> alert('Dados Atualizados') </script>";
        header('Location: index.php');
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
        <link rel="stylesheet" href="../public/css/tailwind.css">
        <title>Alterar laboratórios - Bem Estar Saúde</title>
    </head>
    <body class='bg-gray-200'>
        <div class='flex justify-center items-center w-screen h-screen'>
            <form class='flex p-10 flex-col w-2/4 bg-white rounded-lg' name="CadLab" method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
                <div class='flex justify-center mb-5'>
                    <img class='w-64' src="../public/images/logo2.png">
                </div>
                <div>
                    <p class='my-4'> Marque a opção que deseja atualizar </p>
                    <label class='mr-4'>
                        Nome <input type="radio" name="novoValor" value="nome">
                    </label>

                    <label class='mr-4'>
                        Endereço <input type="radio" name="novoValor" value="endereco">
                    </label>

                    <label class='mr-4'>
                        Telefone <input type="radio" name="novoValor" value="telefone">
                    </label>

                    <label class='mr-4'>
                        Tipo de exame <input type="radio" name="novoValor" value="tiposexame">
                    </label>
                    <label class='mr-4'>
                        E-mail <input type="radio" name="novoValor" value="email">
                    </label>
                    <label class='mr-4'>
                        cnpj <input type="radio" name="novoValor" value="cnpj">
                    </label>
                </div>
                <label class='my-4'>Digite o novo valor da caixa marcada acima</label>
                <input class='border border-gray-200 text-gray-600 rounded focus:outline-none focus:ring-1 focus:ring-green-400 px-3 h-9' type="text" name="valorNovo" size="20" /></p> 
                <br>
                <input class='rounded-full w-auto h-9 mt-5 bg-green-400 text-white hover:bg-green-300 cursor-pointer' type="submit" name="AltCadLab" value="Alterar Dados">
            </form>
        </div>
    </body>
</html>