<?php
include '../db/db_connect.php';    
           
if ($_SESSION['cnpj'] != '') {
    $confirmar = false;
    $error = false;

    if(isset($_POST['CadEx'])) {
        $cnpj = $_SESSION['cnpj'];
        $cpf = $_POST['cpf'];
        $nome = $_POST['nome'];
        $data = $_POST['data'];
        $date=date_create($data);
        $formated_data = date_format($date,"d/m/Y");
        $tipoexame = $_POST['tipoexame'];
        $resultado = $_POST['resultado'];
            
        $query  = "INSERT INTO exames(nome, cpf_paciente, cnpj_lab, data_exame, tipo_exame, resultado) VALUES('$nome', '$cpf', '$cnpj', '$formated_data', '$tipoexame', '$resultado');";

        $result = mysqli_query($connect, $query);

        if ($result) {
            header('Location: index.php');
            exit();
        } else {
            echo 'Error '.mysqli_error($connect);
            exit();
        }
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
                // else {
                //     if ($confirmar == true) {
                //         echo 'Cadastrado com sucesso!';
                //     }
                // }
                ?>
                
            </form>
        </div>
    </body>
</html>