<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport"s content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./public/css/tailwind.css">
    <title>Hospital</title>
</head>
<body>
    <div class='h-screen flex flex-row-reverse'>
        <div class="flex items-center justify-center bg-gray-700 w-2/6">
            <form class='flex p-10 flex-col w-3/4 bg-white rounded-lg' name="CadMed" method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
                <div class='flex justify-center mb-5'>
                    <img class='w-64' src="./public/images/logo2.png">
                </div>
                <label>Login</label>
                <input class='border mb-2 border-gray-200 text-gray-600 rounded focus:outline-none focus:ring-1 focus:ring-green-400 px-3 ph-1 h-9' type="text" name="nome" id="nome">

                <label>Senha</label>
                <input class='border mb-2 border-gray-200 text-gray-600 rounded focus:outline-none focus:ring-1 focus:ring-green-400 px-3 h-9' type="text" name="endereco" id="endereco">
                <div class='flex flex-col justify-center items-center'>
                    <input class='rounded-full w-32 h-9 mt-5 bg-green-400 text-white hover:bg-green-300 cursor-pointer' type="submit" value="Acessar" name="cadastrar">
                    <!-- <p>Cadastrar</p> -->
                </div>
            </form>
        </div>
        <div class='h-full w-4/6 bg-center bg-cover bg-no-repeat' style="background-image: url('./public/images/bg_login.jpg')"></div>
    </div>
</body>
<script src="https://kit.fontawesome.com/563ca30d4b.js" crossorigin="anonymous"></script>
</html>