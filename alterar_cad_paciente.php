<!DOCTYPE html>

<html>
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Cadastro de pacientes - Bem Estar Saúde</title>
    </head>
    <body>
        <h1>Alterar cadastro de pacientes </h1>
        <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
        <label>
            Nome <input type="radio" name="nome" value="troca">
        </label>

        <label>
            Endereço <input type="radio" name="endereco" value="troca">
        </label>

        <label>
            Telefone <input type="radio" name="telefone" value="troca">
        </label>

        <label>
            E-mail <input type="radio" name="email" value="troca">
        </label>

        <label>
            Gênero <input type="radio" name="genero" value="troca">
        </label>

        <label>
            Idade <input type="radio" name="idade" value="troca">
        </label>

        <label>
            CPF <input type="radio" name="cpf" value="troca">
        </label>
        <br>
        <p>Digite o novo valor da caixa marcada acima <input type="text" name="novo" size="20" /></p> 
        <br>
        <input type="submit" name="AltMed" value="Alterar Dados">
    </form>