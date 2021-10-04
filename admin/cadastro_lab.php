<?php
session_start();

if ($_SESSION['login'] != '') {

    $error = false;

    if(isset($_POST['CadLab'])) {
        $cnpj = $_POST['cnpj'];
        $nome = $_POST['nome'];
        $end = $_POST['endereco'];
        $email = $_POST['email'];
        $telefone = $_POST['telefone'];
        $tipoexame = $_POST['tipoexame'];
        $senha = $_POST['password'];
        
        $xml=simplexml_load_file("../db/laboratorios.xml") or die ("Erro ao abrir arquivo!");
        foreach($xml->children() as $lab) {
            if ($lab->cnpj == $cnpj) {
                $error = true;
            }
        }

        $add = $xml->addChild("laboratorio"); 
        $add -> addChild("cnpj", $cnpj);
        $add -> addChild("nome", $nome);
        $add -> addChild("end", $end);
        $add -> addChild("telefone", $telefone);
        $add -> addChild("email", $email);
        $add -> addChild("tipoexame", $tipoexame);
        $add->addChild("password", $senha);

        $s = simplexml_import_dom($xml);
        $s->saveXML('../db/laboratorios.xml') or die ('Erro ao salvar');
        
        header('Location: index.php');
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
        <title>Cadastro de laboratórios - Bem Estar Saúde</title>
        <script type="text/javascript" src="../public/js/validation.js"></script>
    </head>
    <body class='bg-gray-200'>
        <div class='flex justify-center items-center w-screen h-screen'>
            <form class='flex p-10 flex-col w-2/4 bg-white rounded-lg' name="CadLab" method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
                <div class='flex justify-center mb-5'>
                    <img class='w-64' src="../public/images/logo2.png">
                </div>
                <label>Nome: </label>
                <input class='border mb-2 border-gray-200 text-gray-600 rounded focus:outline-none focus:ring-1 focus:ring-green-400 px-3 ph-1 h-9' type="text" id="nome" name="nome" onfocusout="is_valid_name()">
                <span id="name_error"></span>

                <label>Endereço: </label>
                <input class='border mb-2 border-gray-200 text-gray-600 rounded focus:outline-none focus:ring-1 focus:ring-green-400 px-3 h-9' type="text" id="endereco" name="endereco" onfocusout="is_valid_address()">
                <span id="address_error"></span>

                <label>Telefone: </label>
                <input class='border mb-2 border-gray-200 text-gray-600 rounded focus:outline-none focus:ring-1 focus:ring-green-400 px-3 h-9' type="tel" id="telefone" name="telefone" maxlength="15" onfocusout="is_empty(this)">
                <span id="phone_error"></span>

                <label>E-mail: </label>
                <input class='border mb-2 border-gray-200 text-gray-600 rounded focus:outline-none focus:ring-1 focus:ring-green-400 px-3 h-9' type="email" id="email" name="email" onfocusout="is_valid_email()">
                <span id="email_error"></span>

                <label>Tipo de exame: </label>
                <input class='border mb-2 border-gray-200 text-gray-600 rounded focus:outline-none focus:ring-1 focus:ring-green-400 px-3 h-9' type="text" id="tipoexame" name="tipoexame" onfocusout="is_empty(this)">

                <label>CNPJ: </label>
                <input class='border mb-2 border-gray-200 text-gray-600 rounded focus:outline-none focus:ring-1 focus:ring-green-400 px-3 h-9' type="number" id="cnpj" name="cnpj" onfocusout="is_cnpj()">

                <label>Senha de acesso: </label>
                <input class='border mb-2 border-gray-200 text-gray-600 rounded focus:outline-none focus:ring-1 focus:ring-green-400 px-3 h-9' type="text" id="password" name="password" onfocusout="is_empty(this)">
                <br>
                <input class='rounded-full w-auto h-9 mt-5 bg-green-400 text-white hover:bg-green-300 cursor-pointer' type="submit" name="CadLab" value="Cadastrar Laboratório" onclick="send_form()">
            </form>
            <?php
            if ($error  == true){
                echo "<script> alert('Laboratório com esse CNPJ já cadastrado!') </script>" ; 
            }
            ?>
        </div>
    </body>
</html>