<?php
include '../db/db_connect.php';

$error = false;
if(isset($_POST['cadastrar'])) {
    if (empty($_POST['login']) OR empty($_POST['password'])){
        header('Location: login.php');
    }
    $username = $_POST['login'];
    $password= $_POST['password'];

    $query = "SELECT * FROM admin WHERE username = '$username' AND password = '$password'";

    $result = mysqli_query($connect, $query);

    $row = mysqli_num_rows($result);

    if ($row == 1) {
        $_SESSION['login'] = $username;
        header('Location: index.php');
        exit();
    } else {
        header('Location: login.php');
        exit();
    }
    
    $error = true;
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport"s content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../public/css/tailwind.css">
    <title>Hospital</title>
</head>
<body>
    <div class='h-screen flex flex-row-reverse'>
        <div class="flex items-center justify-center bg-gray-700 w-2/6">
            <form class='flex p-10 flex-col w-3/4 bg-white rounded-lg' name="CadMed" method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
                <div class='flex justify-center mb-5'>
                    <img class='w-64' src="../public/images/logo2.png">
                </div>
                <label>Login</label>
                <input class='border mb-2 border-gray-200 text-gray-600 rounded focus:outline-none focus:ring-1 focus:ring-green-400 px-3 ph-1 h-9' type="text" name="login" id="login">

                <label>Senha</label>
                <input class='border mb-2 border-gray-200 text-gray-600 rounded focus:outline-none focus:ring-1 focus:ring-green-400 px-3 h-9' type="password" name="password" id="password">
                <div class='flex flex-col justify-center items-center'>
                    <input class='rounded-full w-32 h-9 mt-5 bg-green-400 text-white hover:bg-green-300 cursor-pointer' type="submit" value="Acessar" name="cadastrar">
                    <!-- <p>Cadastrar</p> -->
                </div>
                <?php
                    if ($error) {
                        echo '<p> Usuário ou senha inválida! </p>' ; 
                    }
                ?>
            </form>
        </div>
        <div class='h-full w-4/6 bg-center bg-cover bg-no-repeat' style="background-image: url('../public/images/admin.jpg')"></div>
    </div>
</body>
<script src="https://kit.fontawesome.com/563ca30d4b.js" crossorigin="anonymous"></script>
</html>