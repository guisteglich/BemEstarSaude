<?php
session_start();

if ($_SESSION['crm'] != '') {
    $error = false;
    $confirmar = false;

    if(isset($_POST['CadCon'])) {
        $crm = $_SESSION['crm'];
        $nome = $_POST['nome'];
        $cpf = $_POST['cpf'];
        $obs = $_POST['obs'];
        $receita = $_POST['receita'];
        $data = $_POST['data'];

        $xml=simplexml_load_file("../db/consultas.xml") or die ("Erro ao abrir arquivo de consultas!");

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
            $add -> addChild("nome", $nome);
            $add -> addChild("cpf", $cpf);
            $add -> addChild("crm", $crm);
            $add -> addChild("data", $data);
            $add -> addChild("receita", $receita);
            $add -> addChild("obs", $obs);

            $s = simplexml_import_dom($xml);
            $s->saveXML ('../db/consultas.xml');
            header('Location: index.php');
            $confirmar = true;
        }
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
        <title>Cadastro de consultas - Bem Estar Saúde</title>
    </head>
    <body class='bg-gray-200'>
        <div class='flex justify-center items-center w-screen h-screen'>
            <form class='flex p-10 flex-col w-2/4 bg-white rounded-lg' name="CadLab" method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
                <div class='flex justify-center mb-5'>
                    <img class='w-64' src="../public/images/logo2.png">
                </div>
                <label>Insira o CPF do paciente: </label>
                <input class='border mb-2 border-gray-200 text-gray-600 rounded focus:outline-none focus:ring-1 focus:ring-green-400 px-3 h-9' type="text" name="cpf" id="cpf">
                <label>Insira o nome do paciente: </label>
                <input class='border mb-2 border-gray-200 text-gray-600 rounded focus:outline-none focus:ring-1 focus:ring-green-400 px-3 h-9' type="text" name="nome" id="nome">
                <label>Data da consulta: </label>
                <input class='border mb-2 border-gray-200 text-gray-600 rounded focus:outline-none focus:ring-1 focus:ring-green-400 px-3 h-9' type="date" name="data" id="data">
                <label>Receita: </label>
                <input class='border mb-2 border-gray-200 text-gray-600 rounded focus:outline-none focus:ring-1 focus:ring-green-400 px-3 h-9' type="text" name="receita" id="receita">
                <label>Observações: </label>
                <input class='border mb-2 border-gray-200 text-gray-600 rounded focus:outline-none focus:ring-1 focus:ring-green-400 px-3 h-9' type="text" name="obs" id="obs">
                <input class='rounded-full w-auto h-9 mt-5 bg-green-400 text-white hover:bg-green-300 cursor-pointer' type="submit" name="CadCon" value="Confirmar Consulta">
                <?php
                    if ($error) {
                        echo '<p> Consulta com esse paciente já está cadastrada neste dia </p>' ; 
                    }
                    else {
                        if ($confirmar == true) {
                            echo "<script> alert('Cadastrado com sucesso!')</script>:";
                        }
                    }
                    ?>
            </form>
        </div>
    </body>
</html>