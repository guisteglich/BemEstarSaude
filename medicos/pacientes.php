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
                    <i class="fas fa-book-medical pr-3"></i>
                    <a href="../medicos/index.php">Consultas</a>
                </li>
                <li class='flex items-center cursor-pointer h-14 w-full text-gray-50 hover:bg-gray-600 pl-8'>
                    <i class="fas fa-user-friends pr-3"></i>
                    <a href="../medicos/pacientes.php">Pacientes</a>
                </li>
            </ul>
        </aside>
        <div class="flex flex-col mx-5 w-full h-screen">
            <header class="flex flex-row mt-3 items-center justify-between">
                <h1 class="text-2xl	font-semibold">Pacientes</h1>
                <div class="flex items-center">
                    <button class='rounded-md w-auto h-8 px-4 mr-4 bg-blue-400 hover:bg-blue-500 text-white hover:cursor-pointer'> <a href="../admin/cadastro_lab.php">Alterar cadastro</a></button>
                    <span class="mr-2">Médico</span>
                    <img src="../public/images/imgAdmin.jpg" class="rounded-full h-12 w-12 border-green-500 border-2">
                </div>
            </header>
            <div class="mt-3 mb-2 w-full h-full bg-white rounded-md p-6 overflow-auto">
                <div class="flex flex-row items-center justify-between">
                    <button class='rounded-md w-auto px-4 h-8 bg-green-400 hover:bg-green-500 text-white hover:cursor-pointer'> <a href="../admin/cadastro_lab.php">Histórico de Paciente</a></button>
                </div>
                <ul class="grid grid-cols-4 py-8 border-b-2">
                    <li>Nome</li>
                    <li>E-mail</li>
                    <li>Telefone</li>
                    <li>Gênero</li>
                </ul>
                <?php
                    $xml=simplexml_load_file("../db/pacientes.xml") or die ("<br>Erro ao abrir arquivo de consulta!");
                
                    foreach($xml->children() as $ch){
                        echo "<ul class='grid grid-cols-4 py-4 border-b-2'>";
                        echo "<li>$ch->nome</li>";
                        echo "<li>$ch->email</li>";
                        echo "<li>$ch->telefone</li>";
                        echo "<li>$ch->genero</li>";
                        echo "</ul>";
                    }
                ?>
        </div>
    </div>
</body>
<script src="https://kit.fontawesome.com/563ca30d4b.js" crossorigin="anonymous"></script>
</html>