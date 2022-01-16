<?php
// session_start();
include '../db/db_connect.php';
if ($_SESSION['cnpj'] == '') {
    header('Location: login.php');
} else {
    $cnpj = $_SESSION['cnpj'];
    $sql = "SELECT * FROM `exames` WHERE cnpj_lab = $cnpj";
    $result = mysqli_query($connect,$sql) or die("Erro ao retornar dados");
    $num_rows = mysqli_num_rows($result);
    while($r=mysqli_fetch_object($result))
    {
        $res[]=$r;
    }

    if(isset($_POST['count_exames'])) {
        $data_start = $_POST['data_start'];
        $date_start = date_create($data_start);
        $formated_data_start = date_format($date_start,"d/m/Y");

        $data_end = $_POST['data_end'];
        $date_end = date_create($data_end);
        $formated_data_end = date_format($date_end,"d/m/Y");

        $query = "SELECT * FROM exames WHERE cnpj_lab = $cnpj AND (data_exame_db BETWEEN '$data_start' AND '$data_end')";

        $results = mysqli_query($connect, $query);
        $num_rows_consultas = mysqli_num_rows($results);
        while($r=mysqli_fetch_object($results))
        {
            $resultados[]=$r;
        }
    }

    if(isset($_POST['count_exames_anual'])) {
        $data_year = $_POST['year'];
        $query_anual = "SELECT * FROM exames WHERE cnpj_lab = $cnpj AND YEAR(data_exame_db) = $data_year";

        $results_year = mysqli_query($connect, $query_anual);
        $num_rows_consultas_anuais = mysqli_num_rows($results_year);
        $media_num_rows_consultas_anuais = round(($num_rows_consultas_anuais)/12, 2);
    }
}
?>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport"s content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../public/css/tailwind.css">
    <title>Laboratórios</title>
</head>
<body class='bg-gray-200'>
    <div class="flex">
        <aside class='h-screen w-72 bg-gray-700'>
            <img src="../public/images/logo.png" class="pl-8 pt-4 pb-4 w-44">
            <ul class="w-full">
                <li class='flex items-center cursor-pointer h-14 w-full text-gray-50 hover:bg-gray-600 pl-8'>
                    <i class="fas fa-stethoscope pr-3"></i>
                    <a href="../laboratorios/index.php">Exames</a>
                </li>
                <li class='flex items-center cursor-pointer h-14 w-full text-gray-50 bg-red-800 pl-8 hover:bg-red-700 pl-8'>
                    <i class="fas fa-sign-out-alt pr-3"></i>
                    <a href="../logout.php">Logout</a>
                </li>
            </ul>
        </aside>
        <div class="flex flex-col mx-5 w-full h-screen overflow-auto">
            <header class="flex flex-row mt-3 items-center justify-between">
                <h1 class="text-2xl	font-semibold">Laboratórios</h1>
                <div class="flex items-center">
                    <button class='rounded-md w-auto h-8 px-4 mr-4 bg-blue-400 hover:bg-blue-500 text-white hover:cursor-pointer'> <a href="../laboratorios/alterar_cad_lab.php">Alterar cadastro</a></button>
                    <span class="mr-2">Laboratório - CNPJ:
                            <span>
                                <?php
                                    echo "$cnpj";

                                ?>
                                
                            </span>
                        </span>
                    <img src="../public/images/imgAdmin.jpg" class="rounded-full h-12 w-12 border-green-500 border-2">
                </div>
            </header>
            <div class="mt-3 mb-2 w-full h-full bg-white rounded-md p-6 overflow-auto">
                <div class="flex flex-row items-center">
                    <!-- Cadastro e busca -->
                    <button class='rounded-md w-auto h-8 px-4 bg-green-400 hover:bg-green-500 text-white hover:cursor-pointer'> <a href="../laboratorios/cadastro_exames.php">Cadastrar exame</a></button>
                    <button class='rounded-md w-auto h-8 px-4 ml-2 bg-yellow-400 hover:bg-yellow-500 text-white hover:cursor-pointer'> <a href="../laboratorios/buscar_exames_Pac.php">Histórico/Exames de Paciente</a></button>
                </div>
                <ul class="grid grid-cols-4 py-8 border-b-2">
                    <li>CPF</li>
                    <li>Nome</li>
                    <li>Tipo</li>
                    <li>Opções</li>
                </ul>
                <!-- A partir daqui -->
                <?php
                    if (isset($num_rows) and $num_rows > 0) {
                        foreach($res as $ch){
                            if ($ch->cnpj_lab == $cnpj) {
                                echo "<ul class='grid grid-cols-4 py-4 border-b-2'>";
                                echo "<li>$ch->cpf_paciente</li>";
                                echo "<li>$ch->nome</li>";
                                echo "<li>$ch->tipo_exame</li>";
                                echo "<li>";
                                echo "<button class='bg-green-400 hover:bg-green-500 w-auto h-8 px-4 rounded-md text-white'><a href='../laboratorios/info_exames.php?id=$ch->id_exame'>Ver mais</a></button>";
                                echo "</li>";
                                echo "</ul>";                        
                            } 
                            
                        }
                    }else{
                        echo "<div class='text-center m-2'> Não há exames registrados </div>"; 
                    }
                ?>
        </div>
        <div class='flex w-ful justify'>
            <div class='w-1/2 px-5'>
                <div> Consultas por período </div>
                <form class='flex p-10 flex-col w-2/4 bg-white rounded-lg w-full' name="count_exames" method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
                    
                    <label>Data inicio: </label>
                    <input class='border mb-2 border-gray-200 text-gray-600 rounded focus:outline-none focus:ring-1 focus:ring-green-400 px-3 h-9' type="date" name="data_start" id="data" onfocusout="is_empty(this)">
                    

                    <label>Data fim: </label>
                    <input class='border mb-2 border-gray-200 text-gray-600 rounded focus:outline-none focus:ring-1 focus:ring-green-400 px-3 h-9' type="date" name="data_end" id="data" onfocusout="is_empty(this)">
                    <input class='rounded-full w-auto h-9 mt-5 bg-green-400 text-white hover:bg-green-300 cursor-pointer' type="submit" name="count_exames" value="Visualizar número de consultas" onclick="send_form()">
                    
                </form>
                
                <?php
                    if (isset($formated_data_start)){
                        echo "<div class='my-2'>O total de exames no período de $formated_data_start até $formated_data_end foi de $num_rows_consultas exame(s)</div>";
                    }
                    
                ?>
            </div>

            <div class='w-1/2 px-5'>
                <div> Consultas anual </div>
                <form class='flex p-10 flex-col w-2/4 bg-white rounded-lg w-full' name="count_exames_anual" method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
                    
                    <label>Ano: </label>
                    <input class='border mb-2 border-gray-200 text-gray-600 rounded focus:outline-none focus:ring-1 focus:ring-green-400 px-3 h-9' type="text" name="year" id="data" onfocusout="is_empty(this)">
                    
                    <input class='rounded-full w-auto h-9 mt-5 bg-green-400 text-white hover:bg-green-300 cursor-pointer' type="submit" name="count_exames_anual" value="Visualizar número de consultas anuais" onclick="send_form()">
                    
                </form>
                
                <?php
                    if (isset($data_year)){
                        echo "<div class='my-2'>O total de exames no ano de $data_year foi de $num_rows_consultas_anuais exame(s)</div>";
                        echo "<div class='my-2'>A média de exames no ano de $data_year foi de $media_num_rows_consultas_anuais exame(s)</div>";
                    }
                ?>
            </div>
        </div>
    </div>
</body>
<script src="https://kit.fontawesome.com/563ca30d4b.js" crossorigin="anonymous"></script>
</html>