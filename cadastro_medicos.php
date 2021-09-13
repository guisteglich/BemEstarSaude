<?php
$error = false;

if(isset($_POST['CadMed'])) {

    $nome = $endereco = $telefone = $email = $especialidade = $crm = '';

    function input($data) {
        $data = trim($data);
        $data = stripslashes($data);
        // $data = htmlspecialchars($data);
        return $data;
    }

    $nome = input($_POST['nome']);
    $endereco = input($_POST['endereco']);
    $telefone = input($_POST['telefone']);
    $email = input($_POST['email']);
    $especialidade = input($_POST['especialidade']);
    $crm = input($_POST['crm']);
    
    $xml = simplexml_load_file("users/medicos.xml") or die ("Erro ao carregar arquivo de médicos!");

    foreach($xml->children() as $md) {
        if ($md->nome == $nome) {
            $error = true;
        }
    }


    // echo "Esse é o xml: " . $xml;

    $node = $xml->addChild("medico");
    $node->addChild("nome", $nome);
    $node->addChild("endereco", $endereco);
    $node->addChild("telefone", $telefone);
    $node->addChild("email", $email);
    $node->addChild("especialidade", $especialidade);
    $node->addChild("crm", $crm);

    $s = simplexml_import_dom($xml);
    $s->saveXML ('users/medicos.xml') or die ('Erro ao salvar');

    echo $xml->asXML();
}     

?>

<!DOCTYPE html>

<html>
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="./public/css/tailwind.css">
        <title>Cadastro de médicos - Bem Estar Saúde</title>
    </head>
    <body class='bg-gray-200'>
        <div class='flex justify-center items-center w-screen h-screen'>
            <form class='flex p-10 flex-col w-2/4 bg-white rounded-lg' name="CadMed" method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
                <div class='flex justify-center mb-5'>
                    <img class='w-64' src="./public/images/logo2.png">
                </div>
                <label>Nome:</label>
                <input class='border mb-2 border-gray-200 text-gray-600 rounded focus:outline-none focus:ring-1 focus:ring-green-400 px-3 ph-1 h-9' type="text" name="nome" id="nome">

                <label>Endereço:</label>
                <input class='border mb-2 border-gray-200 text-gray-600 rounded focus:outline-none focus:ring-1 focus:ring-green-400 px-3 h-9' type="text" name="endereco" id="endereco">

                <label>Telefone:</label>
                <input class='border mb-2 border-gray-200 text-gray-600 rounded focus:outline-none focus:ring-1 focus:ring-green-400 px-3 h-9' type="tel" name="telefone" id="telefone">

                <label>E-mail:</label>
                <input class='border mb-2 border-gray-200 text-gray-600 rounded focus:outline-none focus:ring-1 focus:ring-green-400 px-3 h-9' type="email" name="email" id="email">

                <label>Especialidade:</label>
                <input class='border mb-2 border-gray-200 text-gray-600 rounded focus:outline-none focus:ring-1 focus:ring-green-400 px-3 h-9' type="text" name="especialidade" id="especialidade">

                <label>CRM:</label>
                <input class='border mb-2 border-gray-200 text-gray-600 rounded focus:outline-none focus:ring-1 focus:ring-green-400 px-3 h-9' type="number" name="crm" id="crm">
                <div class='flex justify-center'>
                    <input class='rounded-full w-32 h-9 mt-5 bg-green-400 text-white hover:bg-green-300 cursor-pointer' type="submit" value="Cadastrar" name="CadLab">
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