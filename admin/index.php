<?php
session_start();
if ($_SESSION['login'] != '') {
    $server = "localhost";
    $user = "root";
    $pass = "";
    $db = "BemEstarSaude";
    $strcon = mysqli_connect($server, $user, $pass, $db); 
    $sql = "SELECT * FROM `laboratorios`";
    $result = mysqli_query($strcon,$sql) or die("Erro ao retornar dados");
    $num_rows = mysqli_num_rows($result);
    while($r=mysqli_fetch_object($result))
    {
        $res[]=$r;
    }

        
}else{
    header("Location: login.php");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport"s content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../public/css/tailwind.css">
    <title>Laboratórios</title>
</head>
<body class='bg-gray-200'>
    <div class="flex">
        <aside class='h-screen w-72 bg-gray-700'>
            <img src="../public/images/logo.png" class="pl-8 pt-4 pb-4 w-44">
            <ul class="w-full">
                <li class='flex items-center cursor-pointer h-14 w-full text-gray-50 hover:bg-gray-600 pl-8'>
                    <i class="fas fa-vials pr-3"></i>
                    <a href="../admin/index.php">Laboratórios</a>
                </li>
                <li class='flex items-center cursor-pointer h-14 w-full text-gray-50 hover:bg-gray-600 pl-8'>
                    <i class="fas fa-notes-medical pr-3"></i>
                    <a href="../admin/medicos.php">Médicos</a>
                </li>
                <li class='flex items-center cursor-pointer h-14 w-full text-gray-50 hover:bg-gray-600 pl-8'>
                    <i class="fas fa-user-friends pr-3"></i>
                    <a href="../admin/pacientes.php">Pacientes</a>
                </li>
                <li class='flex items-center cursor-pointer h-14 w-full text-gray-50 bg-red-800 pl-8 hover:bg-red-700 pl-8'>
                    <i class="fas fa-sign-out-alt pr-3"></i>
                    <a href="../logout.php">Logout</a>
                </li>
            </ul>
        </aside>
        <div class="flex flex-col mx-5 w-full h-screen">
            <header class="flex flex-row mt-3 items-center justify-between">
                <h1 class="text-2xl	font-semibold">Laboratórios</h1>
                <div class="flex items-center">
                    <span class="mr-2">Admin</span>
                    <img src="../public/images/imgAdmin.jpg" class="rounded-full h-12 w-12 border-green-500 border-2">
                </div>
            </header>
            <div class="mt-3 mb-2 w-full h-full bg-white rounded-md p-6 overflow-auto">
                <div class="flex flex-row items-center">
                    <button class='rounded-md w-auto px-4 h-8 bg-green-400 hover:bg-green-500 text-white hover:cursor-pointer'> <a href="../admin/cadastro_lab.php">Cadastrar</a></button>
                    <button class='ml-2 w-auto h-8 px-4 bg-yellow-400 hover:bg-yellow-500 rounded-md text-white'><a href='../admin/alterar_cad_lab.php'>Alterar laboratório</a></button>
                </div>
                <ul class="grid grid-cols-4 py-8 border-b-2">
                    <li>Nome</li>
                    <li>E-mail</li>
                    <li>CNPJ</li>
                    <li>Opções</li>
                </ul>
                <?php
                    if ($num_rows > 0) {
                        foreach($res as $ch){
                            echo "<ul class='grid grid-cols-4 py-4 border-b-2'>";
                            echo "<li>$ch->nome</li>";
                            echo "<li>$ch->email</li>";
                            echo "<li>$ch->cnpj</li>";
                            echo "<li>";
                            echo "<button class='bg-green-400 hover:bg-green-500 w-auto h-8 px-4 rounded-md text-white'><a href='../admin/info_lab.php?cnpj=$ch->cnpj'>Ver mais</a></button>";
                            echo "</li>";
                            echo "</ul>";
                        }
                    }  else{
                        echo '<div class="text-center m-2"> Não há médicos cadastrados </div>';
                    } 
                ?>
        </div>
    </div>
</body>
<script src="https://kit.fontawesome.com/563ca30d4b.js" crossorigin="anonymous"></script>
</html>