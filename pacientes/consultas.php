<?php
include '../db/db_connect.php';

if(isset($_POST['BuscaConPac'])) {
    $cpf = $_POST['cpf'];
    $sql = "SELECT * FROM `consultas` WHERE cpf_paciente = $cpf";
    $result = mysqli_query($connect,$sql) or die("Erro ao retornar dados");
    $num_rows = mysqli_num_rows($result);
    while($r=mysqli_fetch_object($result))
    {
        $res[]=$r;
    }
}

if(isset($_POST['count_consultas'])) {
    $data_start = $_POST['data_start'];
    $date_start = date_create($data_start);
    $formated_data_start = date_format($date_start,"d/m/Y");
    $cpf = $_POST['cpf'];

    $data_end = $_POST['data_end'];
    $date_end = date_create($data_end);
    $formated_data_end = date_format($date_end,"d/m/Y");

    $query = "SELECT * FROM consultas WHERE (data_consulta_db BETWEEN '$data_start' AND '$data_end') AND cpf_paciente = $cpf";

    $results = mysqli_query($connect, $query);
    $num_rows_consultas = mysqli_num_rows($results);
    while($r=mysqli_fetch_object($results))
    {
        $resultados[]=$r;
    }
}

if(isset($_POST['count_consultas_anual'])) {
    $data_year = $_POST['year'];
    $cpf = $_POST['cpf'];

    $query_anual = "SELECT * FROM consultas WHERE YEAR(data_consulta_db) = $data_year AND cpf_paciente = $cpf";
    $results_year = mysqli_query($connect, $query_anual);
    $num_rows_consultas_anuais = mysqli_num_rows($results_year);
    $media_num_rows_consultas_anuais = round(($num_rows_consultas_anuais)/12, 2);
}


?>

<html>
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="../public/css/tailwind.css">
        <title>Consultas - Bem Estar Saúde</title>
    </head>
    <body class='bg-gray-200'>
        <div class='flex justify-center items-center w-screen h-screen overflow-auto'>
            <div class='flex p-10 flex-col w-2/4 bg-white rounded-lg'>
                <div class='flex justify-center mb-5'>
                    <img class='w-64' src="../public/images/logo2.png">
                </div>
                <div class='flex flex-col items-center'>
                    <form name="BusConPac" method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
                        <label>Insira o seu CPF:<label>
                        <input class='border mb-2 border-gray-200 text-gray-600 rounded focus:outline-none focus:ring-1 focus:ring-green-400 px-3 h-9' type="text" name="cpf" id="cpf">
                        <input class='rounded-md w-auto px-4 h-9 mt-5 bg-green-400 text-white hover:bg-green-300 cursor-pointer' type="submit" name="BuscaConPac" value="Buscar consultas">
                    </form>
                    <?php
                    if (isset($num_rows) and $num_rows > 0) {
                        foreach($res as $ch) {
                            if ($ch->cpf_paciente == $cpf) {
                                echo "<br>";
                                echo '<table>';
                                echo "<tr><td> <b>CRM do seu médico:</b> $ch->crm_medico </td></tr>";
                                echo "<tr><td> <b>Medicamento recomendado:</b> $ch->receita </td></tr>";
                                echo "<tr><td> <b>Dia que foi realizada a consulta:</b> $ch->data_consulta </td></tr>";
                                echo "</table>";
                                echo "<br>";
                                echo "<hr>";
                            } 
                        }  
                    }else{
                        echo "<p class='text-red-500'> Nenhum paciente com o CPF inserido foi encontrado </p>"; 
                    }
                    ?>

                </div>

                <div class='flex w-full'>
                    <div class='w-1/2 px-5 shadow-lg'>
                        <div style="text-align: center;"> Consultas por período </div>
                        <form class='flex p-5 flex-col w-2/4 bg-white rounded-lg w-full' name="count_consultas" method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
                            <label>Insira o seu CPF:<label>
                            <input class='border mb-2 border-gray-200 text-gray-600 rounded focus:outline-none focus:ring-1 focus:ring-green-400 px-3 h-9' type="text" name="cpf" id="cpf">
                            
                            <label>Data inicio: </label>
                            <input class='border mb-2 border-gray-200 text-gray-600 rounded focus:outline-none focus:ring-1 focus:ring-green-400 px-3 h-9' type="date" name="data_start" id="data" onfocusout="is_empty(this)">
                            

                            <label>Data fim: </label>
                            <input class='border mb-2 border-gray-200 text-gray-600 rounded focus:outline-none focus:ring-1 focus:ring-green-400 px-3 h-9' type="date" name="data_end" id="data" onfocusout="is_empty(this)">
                            <input class='rounded-full px-2 h-9 mt-5 bg-green-400 text-white hover:bg-green-300 cursor-pointer' type="submit" name="count_consultas" value="Visualizar" onclick="send_form()">
                            
                        </form>
                        
                        <?php
                            if (isset($formated_data_start)){
                                echo "<div>O total de consultas no período de $formated_data_start até $formated_data_end foi de $num_rows_consultas consulta(s)</div>";
                            }
                        ?>

                    </div>

                    <div class='w-1/2 px-5 shadow-lg'>
                        <div style="text-align: center;"> Consultas anual </div>
                        <form class='flex p-10 flex-col w-2/4 bg-white rounded-lg w-full' name="count_consultas_anual" method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
                            
                            <label>Insira o seu CPF:<label>
                            <input class='border mb-2 border-gray-200 text-gray-600 rounded focus:outline-none focus:ring-1 focus:ring-green-400 px-3 h-9' type="text" name="cpf" id="cpf">

                            <label>Ano: </label>
                            <input class='border mb-2 border-gray-200 text-gray-600 rounded focus:outline-none focus:ring-1 focus:ring-green-400 px-3 h-9' type="text" name="year" id="data" onfocusout="is_empty(this)">
                        
                            <input class='rounded-full px-2 h-9 mt-5 bg-green-400 text-white hover:bg-green-300 cursor-pointer' type="submit" name="count_consultas_anual" value="Visualizar" onclick="send_form()">
                            
                        </form>
                        
                        <?php
                            if (isset($data_year)){
                                echo "<div>O total de consultas no ano de $data_year foi de $num_rows_consultas_anuais consulta(s)</div>";
                                echo "<div>A média de consultas no ano de $data_year foi de $media_num_rows_consultas_anuais consulta(s)</div>";
                            }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </body>
    <script type="text/javascript" src="../public/js/validation.js"></script>
</html>
