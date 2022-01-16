<?php
include '../db/db_connect.php';

if ($_SESSION['cnpj'] != '') {
    $id_url = $_GET['id'];
    $sql = "SELECT * FROM `exames` WHERE id_exame = $id_url";
    $result = mysqli_query($connect,$sql) or die("Erro ao retornar dados");
    $num_rows = mysqli_num_rows($result);
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
                        foreach($res as $ch){
                            if ($ch->id_exame == $id_url) {
                                echo "<br>";
                                echo "<div> <b>Nome:</b> <span> $ch->nome </span> </div>";
                                echo "<br>";
                                echo "<div> <b>CPF:</b> <span> $ch->cpf_paciente </span> </div>";
                                echo "<br>";
                                echo "<div> <b>CNPJ</b>: <span> $ch->cnpj_lab </span> </div>";
                                echo "<br>";          
                                echo "<div> <b>Data:</b> <span> $ch->data_exame </span> </div>";
                                echo "<br>";                            
                                echo "<div> <b>Tipo de Exame:</b> <span> $ch->tipo_exame </span> </div>";
                                echo "<br>";                           
                                echo "<div> <b>Resultado:</b> <span> $ch->resultado </span> </div>";   
                                echo "<br>";                           
                            } 
                        }
                    ?>  
                </div>
            </div>
        </div>
    </body>
</html>
