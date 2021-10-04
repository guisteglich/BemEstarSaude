<?php
session_start();

if ($_SESSION['crm'] != '') {
    $cpf_url = $_GET['cpf'];
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
        <div class='flex justify-center items-center w-screen h-screen'>
            <div class='flex p-10 flex-col
             w-2/4 bg-white rounded-lg'>
                <div class='flex justify-center mb-5'>
                    <img class='w-64' src="../public/images/logo2.png">
                </div>
                <div class='flex flex-col items-center'>
                    <?php
                        $xml=simplexml_load_file("../db/consultas.xml") or die ("<br>Erro ao abrir arquivo de laboratório!");
                    
                        foreach($xml->children() as $ch){
                            if ($ch->cpf == $cpf_url) {
                                echo "<br>";
                                echo "<div> <b>Nome:</b> <span> $ch->nome </span> </div>";
                                echo "<br>";
                                echo "<div> <b>CPF:</b> <span> $ch->cpf </span> </div>";
                                echo "<br>";
                                echo "<div> <b>CRM</b>: <span> $ch->crm </span> </div>";
                                echo "<br>";          
                                echo "<div> <b>Data:</b> <span> $ch->data </span> </div>";
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
