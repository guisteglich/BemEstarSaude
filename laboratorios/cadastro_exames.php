<?php
session_start();

if ($_SESSION['cnpj'] != '') {
    $error = false;
    $confirmar = false;

    if(isset($_POST['CadEx'])) {
        $cnpj = $_SESSION['cnpj'];
        $cpf = $_POST['cpf'];
        $nome = $_POST['nome'];
        $data = $_POST['data'];
        $tipoexame = $_POST['tipoexame'];
        $resultado = $_POST['resultado'];
    
    //     $xml=simplexml_load_file("../db/exames.xml") or die ("Erro ao abrir arquivo de exames!");

    //     foreach($xml->children() as $ch) {
    //         if ($ch->cnpj == $cnpj){
    //             if ($ch->cpf == $cpf) {
    //                 if ($ch->data == $data) {
    //                     $error = true;    
    //                 }
    //             }
    //         }
    // }

    // if ($error == false){
    //     $add = $xml->addChild("exame"); 
    //     $add -> addChild("nome", $nome);
    //     $add -> addChild("cpf", $cpf);
    //     $add -> addChild("cnpj", $cnpj);
    //     $add -> addChild("data", $data);
    //     $add -> addChild("tipoexame", $tipoexame);
    //     $add -> addChild("resultado", $resultado);

    //     $s = simplexml_import_dom($xml);
    //     $s->saveXML('../db/exames.xml') or die ('Erro ao salvar exame');
    //     header('Location: index.php');
    //     $confirmar = true;
        
    //     }
    try{
        $conn = new PDO("mysql:host=$server;dbname=$db", $user, $pass);
        //$conn = new PDO("mysql:host=$server", $user, $pass);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
        $sql = sprintf("INSERT INTO exames
        VALUES ('%s', '%s', '%s', '%s', '%s', '%s');", $nome, $cpf, $cnpj, $data, $tipoexame, $resultado);
        $conn->exec($sql);
    
        }
        catch(PDOException $e){
            echo $sql . "<br" . $e->getMessage();
        }
        
        $conn = null;
        header('Location: info_exames.php');
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
        <title>Cadastrar exames - Bem Estar Saúde</title>
        <script type="text/javascript" src="../public/js/validation.js"></script>
    </head>
    <body class='bg-gray-200'>
        <div class='flex justify-center items-center w-screen h-screen'>
            <form class='flex p-10 flex-col w-2/4 bg-white rounded-lg' name="CadEx" method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
                <div class='flex justify-center mb-5'>
                    <img class='w-64' src="../public/images/logo2.png">
                </div>
        <label>Insira o CPF do paciente:</label>
        <input class='border mb-2 border-gray-200 text-gray-600 rounded focus:outline-none focus:ring-1 focus:ring-green-400 px-3 h-9' type="text" id="cpf" name="cpf"  onfocusout="is_cpf()">

        <label>Insira o nome do paciente:</label>
        <input class='border mb-2 border-gray-200 text-gray-600 rounded focus:outline-none focus:ring-1 focus:ring-green-400 px-3 h-9' type="text" id="nome" name="nome" onfocusout="is_valid_name()">

        <label>Data do exame:</label>
        <input class='border mb-2 border-gray-200 text-gray-600 rounded focus:outline-none focus:ring-1 focus:ring-green-400 px-3 h-9' type="date" id="data" name="data" onfocusout="is_empty(this)">

        <label>Tipo de exame:</label>
        <input class='border mb-2 border-gray-200 text-gray-600 rounded focus:outline-none focus:ring-1 focus:ring-green-400 px-3 h-9' type="text" id="tipoexame" name="tipoexame" onfocusout="is_empty(this)">

        <label>Resultado:</label>
        <input class='border mb-2 border-gray-200 text-gray-600 rounded focus:outline-none focus:ring-1 focus:ring-green-400 px-3 h-9' type="text" id="resultado" name="resultado" onfocusout="is_empty(this)">
        <br>
        <input class='rounded-full w-auto h-9 mt-5 bg-green-400 text-white hover:bg-green-300 cursor-pointer' type="submit" name="CadEx" value="Cadastrar Exame" onclick="send_form()">
        <?php
            if ($error) {
                echo '<p> Exame com esse paciente já está cadastrado para esse dia </p>' ; 
            }
            else {
                if ($confirmar == true) {
                    echo 'Cadastrado com sucesso!';
                }
            }
            ?>
            
        </form>
    </body>
</html>