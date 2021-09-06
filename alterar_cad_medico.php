<!DOCTYPE html>

<html>
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Cadastro de laboratórios - Bem Estar Saúde</title>
    </head>
    <body>
        <h1>Alterar cadastro de médicos </h1>
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
            Especialidade <input type="radio" name="especialidade" value="troca">
        </label>

        <label>
            CRM <input type="radio" name="crm" value="troca">
        </label>
        <br>
        <p>Digite o novo valor da caixa marcada acima <input type="text" name="novo" size="20" /></p> 
        <br>
        <input type="submit" name="AltMed" value="Alterar Dados">
    </form>
    </body>
</html>