<?php
session_start();

?>
<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tela de Cadastro</title>
    <link rel="stylesheet" href="../css/stylescad.css">
</head>

<body>

    <div class="container">
        <div class="form-container">
            <form method="post" action="php/caditem.php">
                <h1>Cadastro de Item</h1>
                <!--criar campo de captura do id -->
                <div class="form-group">
                    <label for="nome">Nome:</label>
                    <input type="text" name="nome" required id="iditem" placeholder="Digite o nome do item"
                        value="<?php echo isset($_SESSION['nome']) ? $_SESSION['nome'] : ''; ?>">
                </div>

                <div class="form-group">
                    <label for="codigo">Código:</label>
                    <input type="text" name="codigo" required id="idCod" placeholder="Digite o código do item"
                        value="<?php echo isset($_SESSION['codigo']) ? $_SESSION['codigo'] : ''; ?>">
                </div>

                <div class="form-group">
                    <label for="quantidade">Quantidade:</label>
                    <input type="int" name="quantidade" required id="idQnt" placeholder="Digite a quantidade"
                        value="<?php echo isset($_SESSION['quantidade']) ? $_SESSION['quantidade'] : ''; ?>">
                </div>

                <div class="button-container">
                    <button type="submit" name="Cadastraritem" class="btn btn-primary btn-block mt-3">Cadastrar</button>
                    <a href="home.php" class="btn btn-secondary btn-block mt-3">Voltar</a>

                </div>

            </form>
        </div>

        <?php
        /*unset($_SESSION['nome']);
        unset($_SESSION['codigo']);
        unset($_SESSION['quantidade']);*/

        ?>
</body>

</html>