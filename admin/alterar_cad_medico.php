<?php
session_start();

if ($_SESSION['login'] != '') {
    $error = false;
    $sucesso = false;
    
    if(isset($_POST['AltCadMed'])) {
        $contador = 0;
        $posicao = 0;
        $crm = $_POST['crm'];
        $alterar = $_POST['novoValor'];
        $valor_novo = $_POST['valorNovo'];
    
        // $xml=simplexml_load_file("../db/medicos.xml") or die ("Erro ao abrir arquivo de médicos!");
        // foreach($xml->children() as $ch) {
        //     if ($ch->crm == $crm) {
                
        //         $posicao = $contador;
        //     }
        //     $contador= $contador+1;
        // }
        // $xml->medico[$posicao]->$alterar = $valor_novo;
        // $s = simplexml_import_dom($xml);
        // $s->saveXML ('../db/medicos.xml');
        // $sucesso = true;

        $server="localhost";
        $user="root";
        $pass="";
        $db = "BemEstarSaude";

        $conn = new PDO("mysql:host=$server;dbname=$db", $user, $pass);
        //$conn = new PDO("mysql:host=$server", $user, $pass);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        
        $sql = "UPDATE medicos SET $alterar = '$valor_novo' WHERE crm = $crm";
        $conn->query($sql);
        header('Location: medicos.php');
    }
} else {
    header('Location: login.php');
}
?>

<!DOCTYPE html>

<html>
    <head> 
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="../public/css/tailwind.css">
        <title>Alterar médico - Bem Estar Saúde</title>
        <script type="text/javascript" src="../public/js/validation.js"></script>
    </head>
    <body class='bg-gray-200'>
        <div class='flex justify-center items-center w-screen h-screen'>
            <form class='flex p-10 flex-col w-2/4 bg-white rounded-lg' name="AltCadMed" method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
                <div class='flex justify-center mb-5'>
                    <img class='w-64' src="../public/images/logo2.png">
                </div>
                <label> Digite o CRM: </label>
                <input class='border mb-2 border-gray-200 text-gray-600 rounded focus:outline-none focus:ring-1 focus:ring-green-400 px-3 h-9' type="text" name="crm" id= "crm">
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
                        Especialidade <input type="radio" name="novoValor" value="especialidade">
                    </label>
                    <label class='mr-4'>
                        CRM <input type="radio" name="novoValor" value="crm">
                    </label>
                </div>
                <label class='my-4'>Digite o novo valor da caixa marcada acima</label>
                <input class='border border-gray-200 text-gray-600 rounded focus:outline-none focus:ring-1 focus:ring-green-400 px-3 h-9' type="text" name="valorNovo" size="20" /></p> 
                <br>
                <input class='rounded-full w-auto h-9 mt-5 bg-green-400 text-white hover:bg-green-300 cursor-pointer' type="submit" name="AltCadMed" value="Alterar Dados" onclick="send_form()">
            </form>
        </div>
    </body>
</html>