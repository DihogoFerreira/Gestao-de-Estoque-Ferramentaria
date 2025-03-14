<?php
session_start();

?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="../css/styleestoque.css">
    <title>Estoque</title>

</head>

<body>
    <header>
        <div class="form-text">
            <div class="cabecalho>" <h1>Gestão de Estoque - Item em Estoque </h1>
            </div>

            <div class="container">

                <form class="search-form" method="POST" action="php/estoque.php">
                    <input type="text" name="codigo" placeholder="Digite o Código do Item">
                    <input type="text" name="nome" placeholder="Digite o Nome do Item">
                    <button type="submit">Pesquisar</button>
                </form>

                <table id="classes-table">
                    <thead>
                        <tr>
                            <th>Nome:</th>
                            <th>Código:</th>
                            <th>Quantidade:</th>
                            <th>Status:</th>
                        </tr>
                    </thead>

                    <!-- Adicione mais linhas conforme necessário -->

                    <tbody>
                        <!-- os itens serão inseridas aqui -->
                        <?php
                        if (isset($_SESSION['results'])) {
                            echo $_SESSION['results'];
                            unset($_SESSION['results']);//limpa ou destroi a variavel 
                        }


                        ?>
                    </tbody>
                </table>
                <div class="all-classes-button">
                    <form method="POST" action="php/estoque.php">
                        <button type="submit" name="all_classes">Consultar Estoque:</button>
                        <button type="button" class="home" onclick="window.location.href='home.php';">Voltar para
                            Home</button>

                    </form>
                </div>
            </div>
    </header>

</body>

</html>