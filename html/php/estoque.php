<?php
session_start();
ob_start(); // Para evitar erros de cabeçalhos já enviados
include 'conexao.php'; // Conexão com o banco de dados

// Função para redirecionar com mensagem de sessão
function redirect_with_message($location, $message)
{
    $_SESSION['msg'] = $message;
    header("Location: $location");
    exit();
}

// Deletar um item
if (isset($_POST['delete_id'])) {
    $id = $_POST['delete_id'];

    // Verificar se o ID é válido
    if (!filter_var($id, FILTER_VALIDATE_INT)) {
        redirect_with_message("../estoque.php", "ID inválido.");
    }

    $declaracao = $conexao->prepare("DELETE FROM `estoque` WHERE iditem = ?");
    $declaracao->bind_param("i", $id);

    if ($declaracao->execute()) {
        redirect_with_message("../estoque.php", "Item deletado com sucesso.");
    } else {
        redirect_with_message("../estoque.php", "Erro ao deletar item.");
    }
}

// Editar um item
if (isset($_POST['editar_id'])) {
    $id = $_POST['editar_id'];

    // Verificar se o ID é válido
    if (!filter_var($id, FILTER_VALIDATE_INT)) {
        redirect_with_message("../estoque.php", "ID inválido.");
    }

    $_SESSION['edit_id'] = $id;
    header("Location: editaritem.php?id=$id");
    exit();
}

// Consultar itens
$sql = "SELECT * FROM estoque";
$parametros = [];

// Filtrar itens por nome ou código
if (isset($_POST['nome']) || isset($_POST['codigo'])) {
    $nome = $_POST['nome'] ?? '';
    $codigo = $_POST['codigo'] ?? '';

    $sql .= " WHERE 1=1";
    if (!empty($nome)) {
        $sql .= " AND nome LIKE ?";
        $parametros[] = "%$nome%";
    }
    if (!empty($codigo)) {
        $sql .= " AND codigo LIKE ?";
        $parametros[] = "%$codigo%";
    }
}

$stmt = $conexao->prepare($sql);
if ($stmt) {
    if (!empty($parametros)) {
        $types = str_repeat('s', count($parametros));
        $stmt->bind_param($types, ...$parametros);
    }
    $stmt->execute();
    $resultado = $stmt->get_result();
    $results = '';

    if ($resultado->num_rows > 0) {
        while ($linha = $resultado->fetch_assoc()) {
            $results .= "<tr>
                <td>{$linha['nome']}</td>
                <td>{$linha['codigo']}</td>
                <td>{$linha['quantidade']}</td>
                <td>
                    <form action='php/estoque.php' method='post' style='display:inline;' onsubmit=\"return confirm('Deseja deletar este item?');\">
                        <input type='hidden' name='delete_id' value='{$linha['iditem']}'>
                        <button type='submit' name='delete'>Deletar</button>
                    </form>
                    <form action='php/estoque.php' method='post' style='display:inline;'>
                        <input type='hidden' name='editar_id' value='{$linha['iditem']}'>
                        <button type='submit' name='editar'>Editar</button>
                    </form>
                </td>
            </tr>";
        }
    } else {
        $results = "<tr><td colspan='4'>Nenhum item encontrado</td></tr>";
    }

    $_SESSION['results'] = $results;
    $stmt->close();
} else {
    $_SESSION['results'] = "<tr><td colspan='4'>Erro na preparação da consulta</td></tr>";
}

$conexao->close();
header("Location: ../estoque.php");
exit();
?>
