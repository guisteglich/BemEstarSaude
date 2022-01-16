<?php
include '../db/db_connect.php';

if ($_SESSION['crm'] != '') {
    $cpf_url = $_GET['cpf'];

    $sql = "SELECT * FROM `consultas` WHERE cpf_paciente = $cpf_url";

    $result = mysqli_query($connect, $sql) or die("Erro ao retornar dados");
    
    while($r=mysqli_fetch_object($result))
    {
        $res[]=$r;
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
        <title>Informações de consultas - Bem Estar Saúde</title>
    </head>
    <body class='bg-gray-200'>
        <div class='flex justify-center items-center'>
            <div class='flex p-10 flex-col
             w-2/4 bg-white rounded-lg'>
                <div class='flex justify-center mb-5'>
                    <img class='w-64' src="../public/images/logo2.png">
                </div>
                <div class='flex flex-col items-center'>
                    <?php
                        $xml=simplexml_load_file("../db/consultas.xml") or die ("<br>Erro ao abrir arquivo de laboratório!");
                    
                        foreach($res as $ch){
                            if ($ch->cpf_paciente == $cpf_url) {
                                echo "<br>";
                                echo "<div> <b>Nome:</b> <span> $ch->nome </span> </div>";
                                echo "<br>";
                                echo "<div> <b>CPF:</b> <span> $ch->cpf_paciente </span> </div>";
                                echo "<br>";
                                echo "<div> <b>CRM</b>: <span> $ch->crm_medico </span> </div>";
                                echo "<br>";          
                                echo "<div> <b>Data:</b> <span> $ch->data_consulta </span> </div>";
                                echo "<br>";                            
                                echo "<div> <b>Receita:</b> <span> $ch->receita </span> </div>";
                                echo "<br>";                           
                                echo "<div> <b>Observação:</b> <span> $ch->obs </span> </div>";   
                                echo "<br>";
                                echo "===================================";                           
                            } 
                        }
                    ?>  
                </div>
            </div>
        </div>
    </body>
</html>
