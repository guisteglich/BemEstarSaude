<?php
session_start();

if ($_SESSION['login'] != '') {
    $cnpj_url = $_GET['cnpj'];
    $server = "localhost";
    $user = "root";
    $pass = "";
    $db = "BemEstarSaude";
    $strcon = mysqli_connect($server, $user, $pass, $db); 
    $sql = "SELECT * FROM `laboratorios` WHERE cnpj = $cnpj_url";
    $result = mysqli_query($strcon,$sql) or die("Erro ao retornar dados");

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
        <title>Alterar laboratórios - Bem Estar Saúde</title>
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
                        // $xml=simplexml_load_file("../db/laboratorios.xml") or die ("<br>Erro ao abrir arquivo de laboratório!");
                    
                        foreach($res as $ch){
                            if ($ch->cnpj == $cnpj_url) {
                                echo "<div> <b>CNPJ:</b> <span> $ch->cnpj </span> </div>";
                                echo "<br>";
                                echo "<div> <b>Nome</b>: <span> $ch->nome </span> </div>";
                                echo "<br>";          
                                echo "<div> <b>Endereço:</b> <span> $ch->end </span> </div>";
                                echo "<br>";                            
                                echo "<div> <b>Teelfone:</b> <span> $ch->telefone </span> </div>";
                                echo "<br>";                           
                                echo "<div> <b>E-mail:</b> <span> $ch->email </span> </div>";
                                echo "<br>";
                                echo "<div> <b>Tipo de Exame:</b> <span> $ch->tipo_exame </span> </div>";
                                
                            } 
                        }
                    ?>  
                </div>
            </div>
        </div>
    </body>
</html>
