<?php
session_start();

if ($_SESSION['login'] != '') {
    $error = false;

    $nome = $endereco = $telefone = $email = $especialidade = $crm = '';

    function input($data) {
        $data = trim($data);
        $data = stripslashes($data);
        return $data;
    }

    if(isset($_POST['CadMed'])) {
        $nome = input($_POST["nome"]);
        $endereco = input($_POST["endereco"]);
        $telefone = input($_POST["telefone"]);
        $email = input($_POST["email"]);
        $especialidade = input($_POST["especialidade"]);
        $crm = input($_POST["crm"]);
        $senha = input($_POST["password"]);
        
        // $xml = simplexml_load_file("../db/medicos.xml") or die ("Erro ao carregar arquivo de médicos!");

        // foreach($xml->children() as $ch) {
        //     if ($ch->nome == $nome) {
        //         $error = true;
        //     }
        // }
        // if ($error == false){
        //     $node = $xml->addChild("medico");
        //     $node->addChild("nome", $nome);
        //     $node->addChild("endereco", $endereco);
        //     $node->addChild("telefone", $telefone);
        //     $node->addChild("email", $email);
        //     $node->addChild("especialidade", $especialidade);
        //     $node->addChild("crm", $crm);
        //     $node->addChild("password", $senha);

        //     $s = simplexml_import_dom($xml);
        //     $s->saveXML ('../db/medicos.xml') or die ('Erro ao salvar');  
            
        // }
        
        $server="localhost";
        $user="root";
        $pass="";
        $db = "BemEstarSaude";

        try{
            $conn = new PDO("mysql:host=$server;dbname=$db", $user, $pass);
            //$conn = new PDO("mysql:host=$server", $user, $pass);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        
            $sql = sprintf("INSERT INTO medicos
            VALUES ('%s', '%s', '%s', '%s', '%s', '%s', '%s');", $crm, $nome, $end, $telefone, $email, $especialidade, $senha);
            $conn->exec($sql);
        
            }
        catch(PDOException $e){
            echo $sql . "<br" . $e->getMessage();
        }
        
        $conn = null;
        header('Location: medicos.php');
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
        <title>Cadastro de médicos - Bem Estar Saúde</title>
        <script type="text/javascript" src="../public/js/validation.js"></script>
    </head>
    <body class='bg-gray-200'>
        <div class='flex justify-center items-center w-screen h-screen'>
            <form class='flex p-10 flex-col w-2/4 bg-white rounded-lg' name="CadMed" method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
                <div class='flex justify-center mb-5'>
                    <img class='w-64' src="../public/images/logo2.png">
                </div>
                <label>Nome:</label>
                <input class='border mb-2 border-gray-200 text-gray-600 rounded focus:outline-none focus:ring-1 focus:ring-green-400 px-3 ph-1 h-9' type="text" name="nome" id="nome" onfocusout="is_valid_name()">
                <span id="name_error" class="text-xs pb-2 text-red-600"></span>

                <label>Endereço:</label>
                <input class='border mb-2 border-gray-200 text-gray-600 rounded focus:outline-none focus:ring-1 focus:ring-green-400 px-3 h-9' type="text" name="endereco" id="endereco" onfocusout="is_valid_address()">
                <span id="address_error" class="text-xs pb-2 text-red-600"></span>

                <label>Telefone:</label>
                <input class='border mb-2 border-gray-200 text-gray-600 rounded focus:outline-none focus:ring-1 focus:ring-green-400 px-3 h-9' type="tel" name="telefone" id="telefone" maxlength="15" onfocusout="is_empty(this)">

                <label>E-mail:</label>
                <input class='border mb-2 border-gray-200 text-gray-600 rounded focus:outline-none focus:ring-1 focus:ring-green-400 px-3 h-9' type="email" name="email" id="email" onfocusout="is_valid_email()">
                <span id="email_error" class="text-xs pb-2 text-red-600"></span>

                <label>Especialidade:</label>
                <input class='border mb-2 border-gray-200 text-gray-600 rounded focus:outline-none focus:ring-1 focus:ring-green-400 px-3 h-9' type="text" name="especialidade" id="especialidade" onfocusout="is_empty(this)">

                <label>CRM:</label>
                <input class='border mb-2 border-gray-200 text-gray-600 rounded focus:outline-none focus:ring-1 focus:ring-green-400 px-3 h-9' type="number" name="crm" id="crm" onfocusout="is_empty(this)">
                
                <label>Senha de acesso: </label>
                <input class='border mb-2 border-gray-200 text-gray-600 rounded focus:outline-none focus:ring-1 focus:ring-green-400 px-3 h-9' type="text" id="password" name="password" onfocusout="is_empty(this)">
                <div class='flex justify-center'>
                    <input class='rounded-full w-32 h-9 mt-5 bg-green-400 text-white hover:bg-green-300 cursor-pointer' type="submit" value="Cadastrar" name="CadMed" onclick="send_form()">
                </div>
            </form>
        </div>
        <?php
            if ($error  == true){
                echo '<p> Médico com esse nome já cadastrado! </p>' ; 
            }
        ?>
    </body>
</html>