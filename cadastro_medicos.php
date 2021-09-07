<?php
$error = false;

if(isset($_POST['cadastrar'])) {

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
    $s->saveXML ('users/medicos.xml');

    echo $xml->asXML();
}     

?>

<!DOCTYPE html>

<html>
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Cadastro de médicos - Bem Estar Saúde</title>
    </head>
    <body>
        <h1>Cadastro de médicos </h1>
        <form name="CadMed" method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
            <label>Nome:</label>
            <input type="text" name="nome" id="nome">

            <label>Endereço:</label>
            <input type="text" name="endereco" id="endereco">

            <label>Telefone:</label>
            <input type="tel" name="telefone" id="telefone">

            <label>E-mail:</label>
            <input type="email" name="email" id="email">

            <label>Especialidade:</label>
            <input type="text" name="especialidade" id="especialidade">

            <label>CRM:</label>
            <input type="number" name="crm" id="crm">
            <br>
            <input type="submit" value="Cadastrar" name="cadastrar">
        </form>
        <?php
            if ($error  == true){
                echo '<p> Médico com esse nome já cadastrado! </p>' ; 
            }
        ?>
    </body>
</html>