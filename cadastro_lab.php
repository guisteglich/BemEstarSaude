<?php
session_start();

$error = false;

if(isset($_POST['CadLab'])) {
    $cnpj = $_POST['cnpj'];
    $nome = $_POST['nome'];
    $end = $_POST['endereco'];
    $email = $_POST['email'];
    $telefone = $_POST['telefone'];
    $tipoexame = $_POST['tipoexame'];
    $senha = $_POST['password'];
    
    $xml=simplexml_load_file("users/laboratorios.xml") or die ("Erro ao abrir arquivo!");
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
    $s->saveXML ('users/laboratorios.xml') or die ('Erro ao salvar');
    
    echo $xml->asXML();
    
}

?>

<!DOCTYPE html>

<html>
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Cadastro de laboratórios - Bem Estar Saúde</title>
        <script type="text/javascript" src="./public/js/validation.js"></script>
    </head>
    <body>
        <h1>Cadastro de laboratórios </h1>
        <form name="CadLab" method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
        <label>Nome: </label>
        <input type="text" id="nome" name="nome" onfocusout="is_valid_name()">
        <span id="name_error"></span>

        <label>Endereço: </label>
        <input type="text" id="endereco" name="endereco" onfocusout="is_valid_address()">
        <span id="address_error"></span>

        <label>Telefone: </label>
        <input type="tel" id="telefone" name="telefone" maxlength="15" onfocusout="is_empty(this)">
        <span id="phone_error"></span>

        <label>E-mail: </label>
        <input type="email" id="email" name="email" onfocusout="is_valid_email()">
        <span id="email_error"></span>

        <label>Tipo de exame: </label>
        <input type="text" id="tipoexame" name="tipoexame" onfocusout="is_empty(this)">

        <label>CNPJ: </label>
        <input type="number" id="cnpj" name="cnpj" onfocusout="is_cnpj()">

        <label>Senha de acesso: </label>
        <input type="text" id="password" name="password" onfocusout="is_empty(this)">
        <br>
        <input type="submit" name="CadLab" value="Cadastrar Laboratório" onclick="send_form()">
    </form>
    <?php
        if ($error  == true){
            echo '<p> Laboratório com esse CNPJ já cadastrado! </p>' ; 
        }
        ?>
    </body>
</html>