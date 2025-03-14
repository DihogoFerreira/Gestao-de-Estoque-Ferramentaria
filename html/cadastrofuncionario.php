<?php
session_start();
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" type="text/css" href="../css/stylescaduser.css">
    <title>Cadastro de Funcionário</title>
</head>

<body>
    <div class="container">
        <div class="form-container">
            <h2>Cadastro de Funcionário</h2>

            <div id="messageBox" style="display: none;"></div>
            <form method="post" action="PHP/caduser.php">

                <div class="form-group">
                    <label for="nome">Nome:</label>
                    <input type="text" name="nome" required id="idNome" placeholder="Digite seu nome"
                        value="<?php echo isset($_SESSION['nome']) ? $_SESSION['nome'] : ''; ?>">

                </div>

                <div class="form-group">
                    <label for="sobrenome">Sobrenome:</label>
                    <input type="text" name="sobrenome" required id="idSobrenome" placeholder="Digite seu Sobrenome"
                        value="<?php echo isset($_SESSION['sobrenome']) ? $_SESSION['sobrenome'] : ''; ?>">

                </div>

                <div class="form-group">
                    <label for="matrícula">Número de Matrícula:</label>
                    <input type="int" name="nmat" class="form-control" id="idNmat"
                        placeholder="Digite seu N° de Matrícula"
                        value="<?php echo isset($_SESSION['nmat']) ? $_SESSION['nmat'] : ''; ?>">

                </div>

                <div class="form-group">
                    <label for="profissao">Função:</label>
                    <input type="text" name="funcao" class="form-control" id="idFuncao" placeholder="Digite sua função"
                        value="<?php echo isset($_SESSION['funcao']) ? $_SESSION['funcao'] : ''; ?>">
                </div>

                <div class="form-group">
                    <label for="sexo">Sexo</label>
                    <select name="sexo" class="form-control" id="idSexo" required>
                        <option value="masculino" <?php if (isset($_SESSION['sexo']) && $_SESSION['sexo'] == 'masculino')
                            echo 'selected'; ?>>Masculino</option>
                        <option value="feminino" <?php if (isset($_SESSION['sexo']) && $_SESSION['sexo'] == 'feminino')
                            echo 'selected'; ?>>Feminino</option>
                        <option value="outro">Outro</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="senha">Senha:</label>
                    <input name="senha" type="password" class="form-control" id="idSenha" placeholder="Senha"
                        value="<?php echo isset($_SESSION['senha']) ? $_SESSION['senha'] : ''; ?>">
                </div>

                <div class="form-group">
                    <label for="exampleInputConfirmPassword">Senha:</label>
                    <input type="password" class="form-control" id="exampleInputConfirmPassword"
                        placeholder="Confirme sua senha"
                        value="<?php echo isset($_SESSION['senha']) ? $_SESSION['senha'] : ''; ?>">
                </div><br>

                <button type="submit" name="cadastrofuncionario"
                    class="btn btn-primary btn-block mt-3">Cadastrar</button>
                <a href="home.php" class="btn btn-secondary btn-block mt-3">Voltar</a>

            </form>
        </div>
    </div>

</body>

</html>