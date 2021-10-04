<?php
session_start();
if($_SESSION['crm'] != '') {
    $encontrado = false;
    $error = false;

    if(isset($_POST['BuscaConPac'])) {
        $cpf = $_POST['cpf'];

        $xml=simplexml_load_file("../db/consultas.xml") or die ("<br>Erro ao abrir arquivo de consultas!");

        foreach($xml->children() as $ch){
            if ($cpf == $ch->cpf) {
                $encontrado = true;
            }
        }    
        if (!$encontrado) {
            $error = true; 
        }
    }
} else {
    header('Location: login.php');
}

?>

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
            <div class='flex p-10 flex-col w-2/4 bg-white rounded-lg'>
                <div class='flex justify-center mb-5'>
                    <img class='w-64' src="../public/images/logo2.png">
                </div>
                <div class='flex flex-col items-center'>
                    <form name="BusConPac" method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
                        <label>Insira o CPF do paciente:<label>
                        <input class='border mb-2 border-gray-200 text-gray-600 rounded focus:outline-none focus:ring-1 focus:ring-green-400 px-3 h-9' type="text" name="cpf" id="cpf">
                        <input class='rounded-md w-auto px-4 h-9 mt-5 bg-green-400 text-white hover:bg-green-300 cursor-pointer' type="submit" name="BuscaConPac" value="Buscar consultas">
                    </form>
                    <?php
                    if ($error) {
                        echo "<p class='text-red-500'> Nenhum paciente com o CPF inserido foi encontrado </p>"; 
                    }
                    if ($encontrado) {
                        foreach($xml->children() as $ch) {
                            if ($ch->cpf == $cpf) {
                                echo "<br>";
                                echo '<table>';
                                echo "<tr><td> <b>CRM do seu médico:</b> $ch->crm </td></tr>";
                                echo "<tr><td> <b>Medicamento recomendado:</b> $ch->receita </td></tr>";
                                echo "<tr><td> <b>Dia que foi realizada a consulta:</b> $ch->data </td></tr>";
                                echo "</table>";
                                echo "<br>";
                                echo "<hr>";
                            } 
                        }  
                    }
                    ?>

                </div>
            </div>
        </div>
    </body>
</html>
