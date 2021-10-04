<?php
session_start();

$error = false;

$nome = $endereco = $telefone = $email = $genero = $idade = $cpf = '';

function input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    return $data;
}

if(isset($_POST['CadPac'])) {
    $nome = input($_POST["nome"]);
    $endereco = input($_POST["endereco"]);
    $telefone = input($_POST["telefone"]);
    $email = input($_POST["email"]);
    $genero = input($_POST["genero"]);
    $idade = input($_POST["idade"]);
    $cpf = input($_POST["cpf"]);
    
    $xml=simplexml_load_file("users/pacientes.xml") or die ("Erro ao abrir o arquivo de pacientes!");

    foreach($xml->children() as $pa) {
        if ($pa->cpf == $cpf) {
            $error = true;
        }
    }
    if ($error == false){
    $node = $xml->addChild("paciente"); 
    $node->addChild("nome", $nome);
    $node->addChild("endereco", $endereco);
    $node->addChild("telefone", $telefone);
    $node->addChild("email", $email);
    $node->addChild("genero", $genero);
    $node->addChild("idade", $idade);
    $node->addChild("cpf", $cpf);
    
    $save = simplexml_import_dom($xml);    
    $save->saveXML ('users/pacientes.xml') or die ('Erro ao salvar');
    }
}

    
    // echo $xml->asXML();

    // foreach ($xml->children()  as $p){
    //     echo "<br>Nome do paciente: " . $p->nome;
    // }

?>

<!DOCTYPE html>

<html>
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Cadastro de pacientes - Bem Estar Saúde</title>
        <script type="text/javascript" src="./public/js/validation.js"></script>
    </head>
    <body>
        <h1>Cadastro de pacientes </h1>
        <form name="CadPacientes" method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
            <label>Nome:</label>
            <input type="text" name="nome" id="nome" onfocusout="is_valid_name()">
            <span id="name_error"></span>
            <label>Endereço:</label>
            <input type="text" name="endereco" id="endereco" onfocusout="is_valid_address()">
            <span id="address_error"></span>
            <label>Telefone:</label>
            <input type="tel" name="telefone" id="telefone" maxlength="15" onfocusout="is_empty(this)">
            <span id="phone_error"></span>
            <label>E-mail:</label>
            <input type="email" name="email" id="email" onfocusout="is_valid_email()">
            <span id="email_error"></span>
            <label>Gênero:</label>
            <input type="text" name="genero" id="genero" onfocusout="is_empty(this)">

            <label>Idade:</label>
            <input type="number" name="idade" id="idade" onfocusout="is_empty(this)">

            <label>CPF:</label>
            <input type="text" name="cpf" id="cpf" onfocusout="is_cpf()">
            <br>
            <input name="CadPac" type="submit" value="Cadastrar Paciente" onclick="send_form()">
    </form>
    <?php
    if ($error  == true){
        echo '<p> Paciente com esse CPF já está cadastrado! </p>' ; 
    }
    ?>
    </body>
</html>