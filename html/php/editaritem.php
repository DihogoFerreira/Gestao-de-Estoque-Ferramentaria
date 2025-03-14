<?php
session_start();
ob_start();
include 'conexao.php';

// Função para redirecionar com mensagem de sessão
function redirect_with_message($location, $message)
{
    $_SESSION['msg'] = $message;
    header("Location: $location");
    exit();
}

// Verifique se o ID do item foi passado
if (!isset($_GET['id']) || !filter_var($_GET['id'], FILTER_VALIDATE_INT)) {
    redirect_with_message("estoque.php", "ID inválido.");
}

$id = $_GET['id'];
$sql = "SELECT * FROM estoque WHERE iditem = ?";

$stmt = $conexao->prepare($sql);
if ($stmt) {
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $resultado = $stmt->get_result();

    if ($resultado->num_rows > 0) {
        $item = $resultado->fetch_assoc();
    } else {
        redirect_with_message("estoque.php", "Item não encontrado.");
    }

    $stmt->close();
} else {
    redirect_with_message("estoque.php", "Erro na preparação da consulta.");
}

// Se o formulário for enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nome = filter_input(INPUT_POST, 'nome', FILTER_SANITIZE_STRING);
    $codigo = filter_input(INPUT_POST, 'codigo', FILTER_SANITIZE_STRING);
    $quantidade = filter_input(INPUT_POST, 'quantidade', FILTER_VALIDATE_INT);

    if (empty($nome) || empty($codigo) || $quantidade === false || $quantidade < 0) {
        redirect_with_message("estoque.php", "Preencha todos os campos corretamente.");
    }

    $update_sql = "UPDATE estoque SET nome = ?, codigo = ?, quantidade = ? WHERE iditem = ?";
    $stmt = $conexao->prepare($update_sql);

    if ($stmt) {
        $stmt->bind_param("ssii", $nome, $codigo, $quantidade, $id);
        if ($stmt->execute()) {
            redirect_with_message("estoque.php", "Item atualizado com sucesso.");
        } else {
            redirect_with_message("estoque.php", "Erro ao atualizar item.");
        }
        $stmt->close();
    } else {
        redirect_with_message("estoque.php", "Erro na preparação da consulta.");
    }
}

$conexao->close();
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Editar Item</title>

</head>
<body>

<div class="container">
    <div class="form-container">
    <h1>Editar Item</h1>
    <form action="editaritem.php?id=<?php echo $id; ?>" method="post">
        <label>Nome:</label>
        <input type="text" name="nome" value="<?php echo htmlspecialchars($item['nome'], ENT_QUOTES, 'UTF-8'); ?>" required><br>

        <label>Código:</label>
        <input type="text" name="codigo" value="<?php echo htmlspecialchars($item['codigo'], ENT_QUOTES, 'UTF-8'); ?>" required><br>

        <label>Quantidade:</label>
        <input type="number" name="quantidade" value="<?php echo $item['quantidade']; ?>" required><br>

        <button type="submit">Salvar</button>
        <a href="estoque.php">Voltar</a>
    </form>
    </div>
</div>    
</body>
</html>
