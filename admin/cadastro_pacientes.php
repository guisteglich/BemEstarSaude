<?php
session_start();

if ($_SESSION['login'] != '') {
    $error = false;

    $nome = $endereco = $telefone = $email = $genero = $idade = $cpf = '';

    function input($data) {
        $data = trim($data);
        $data = stripslashes($data);
        return $data;
    }

    if(isset($_POST['CadPac'])) {
        $nome = input($_POST["nome"]);
        $end = input($_POST["endereco"]);
        $telefone = input($_POST["telefone"]);
        $email = input($_POST["email"]);
        $genero = input($_POST["genero"]);
        $idade = input($_POST["idade"]);
        $cpf = input($_POST["cpf"]);

        $server="localhost";
        $user="root";
        $pass="";
        $db = "BemEstarSaude";

        try{
            $conn = new PDO("mysql:host=$server;dbname=$db", $user, $pass);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        
            $sql = sprintf("INSERT INTO pacientes
            VALUES ('%s', '%s', '%s', '%s', '%s', '%s', '%s');", $cpf, $nome, $end, $telefone, $email, $genero, $idade);
            $conn->exec($sql);
        
            }
        catch(PDOException $e){
            echo $sql . "<br" . $e->getMessage();
        }
        
        $conn = null;
        header('Location: pacientes.php');
    }
} else {
    header('Location: login.php');
}
?>

<!DOCTYPE html>

<html>
<head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="../public/css/tailwind.css">
        <title>Cadastro de Paciente - Bem Estar Saúde</title>
        <script type="text/javascript" src="../public/js/validation.js"></script>
    </head>
    <body class='bg-gray-200'>
        <div class='flex justify-center items-center w-screen h-screen'>
            <form class='flex p-10 flex-col w-2/4 bg-white rounded-lg' name="CadMed" method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
                <div class='flex justify-center mb-5'>
                    <img class='w-64' src="../public/images/logo2.png">
                </div>
                <label>Nome</label>
                <input class='border mb-2 border-gray-200 text-gray-600 rounded focus:outline-none focus:ring-1 focus:ring-green-400 px-3 ph-1 h-9' type="text" name="nome" id="nome" onfocusout="is_valid_name()">
                <span id="name_error" class="text-xs pb-2 text-red-600"></span>

                <label>Endereço</label>
                <input class='border mb-2 border-gray-200 text-gray-600 rounded focus:outline-none focus:ring-1 focus:ring-green-400 px-3 h-9' type="text" name="endereco" id="endereco" onfocusout="is_valid_address()">
                <span id="address_error" class="text-xs pb-2 text-red-600"></span>

                <label>Telefone</label>
                <input class='border mb-2 border-gray-200 text-gray-600 rounded focus:outline-none focus:ring-1 focus:ring-green-400 px-3 h-9' type="tel" name="telefone" id="telefone" onfocusout="is_empty(this)">

                <label>E-mail</label>
                <input class='border mb-2 border-gray-200 text-gray-600 rounded focus:outline-none focus:ring-1 focus:ring-green-400 px-3 h-9' type="email" name="email" id="email" onfocusout="is_valid_email()">
                <span id="email_error" class="text-xs pb-2 text-red-600"></span>

                <label>Gênero</label>
                <input class='border mb-2 border-gray-200 text-gray-600 rounded focus:outline-none focus:ring-1 focus:ring-green-400 px-3 h-9' type="text" name="genero" id="genero" onfocusout="is_empty(this)">

                <label>Idade</label>
                <input class='border mb-2 border-gray-200 text-gray-600 rounded focus:outline-none focus:ring-1 focus:ring-green-400 px-3 h-9' type="number" name="idade" id="idade" onfocusout="is_empty(this)">
                
                <label>CPF</label>
                <input class='border mb-2 border-gray-200 text-gray-600 rounded focus:outline-none focus:ring-1 focus:ring-green-400 px-3 h-9' type="text" id="cpf" name="cpf" onfocusout="is_cpf()">
                <div class='flex justify-center'>
                    <input class='rounded-full w-full h-9 mt-5 bg-green-400 text-white hover:bg-green-300 cursor-pointer' type="submit" value="Cadastrar Paciente" name="CadPac" onclick="send_form()">
                </div>
            </form>
        </div>
        <?php
            if ($error  == true){
                echo '<p> Paciente com esse CPF já cadastrado! </p>' ; 
            }
        ?>
    </body>
</html>