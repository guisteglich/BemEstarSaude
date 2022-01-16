<?php
include '../db/db_connect.php';

if ($_SESSION['cnpj'] != '') {
    $encontrado = false;
    $error = false;

    if(isset($_POST['BuscaExPac'])) {
        $cpf = $_POST['cpf'];
        $cnpj = $_SESSION['cnpj'];


        $sql = "SELECT * FROM `exames` WHERE cpf_paciente = $cpf";

        $result = mysqli_query($connect, $sql) or die("Erro ao retornar dados");

        $row = mysqli_num_rows($result);
        
        while($r=mysqli_fetch_object($result))
        {
            $res[]=$r;
        }

        if ($row >= 1) {
            $encontrado = true; 
        } else {
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
            <div class='flex p-10 flex-col
             w-2/4 bg-white rounded-lg'>
                <div class='flex justify-center mb-5'>
                    <img class='w-64' src="../public/images/logo2.png">
                </div>
                <div class='flex flex-col items-center'>
                    <form name="BusConPac" method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
                    <label>Insira o CPF do paciente:<label>
                        <input class='border mb-2 border-gray-200 text-gray-600 rounded focus:outline-none focus:ring-1 focus:ring-green-400 px-3 h-9' type="text" name="cpf" id="cpf">
                        <input class='rounded-md w-auto px-4 h-9 mt-5 bg-green-400 text-white hover:bg-green-300 cursor-pointer' type="submit" name="BuscaExPac" value="Buscar consultas">
                    </form>
                    <?php
                    if ($error) {
                        echo '<p> Nenhum paciente ou laboratório com os dados inseridos foi encontrado </p>' ; 
                    }
                    if ($encontrado) {
                        foreach($res as $ch) {
                            if ($ch->cpf_paciente == $cpf) {
                                echo "<br>";
                                echo '<table>';
                                echo "<tr><td> <b>Data:</b> $ch->data_exame </td></tr>";
                                echo "<tr><td> <b>Tipo de exame:</b> $ch->tipo_exame </td></tr>";
                                echo "<tr><td> <b>Resultado:</b> $ch->resultado </td></tr>";
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