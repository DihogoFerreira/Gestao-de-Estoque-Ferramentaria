<?php
session_start();
include 'conexao.php';

if (isset($_POST['logar'])) {
    $nmat = filter_input(INPUT_POST, 'nmat', FILTER_SANITIZE_NUMBER_INT);
    $senha = filter_input(INPUT_POST, 'senha', FILTER_SANITIZE_STRING);


    // Prepara e executa a consulta
    $stmt = $conexao->prepare("SELECT idcaduser, nome FROM caduser WHERE senha = ? AND nmat = ?");
    $stmt->bind_param("si", $senha, $nmat);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows >= 1) {
        $usuario = $result->fetch_assoc();
        $_SESSION['idcaduser'] = $usuario['idcaduser']; // Corrigido o nome da coluna
        $_SESSION['nome'] = $usuario['nome']; // Corrigido o nome da variável
        echo "<script>
                    alert('Usuário verificado com sucesso. Seja bem-vindo, " . ($usuario['nome']) . "!');
                    window.location.href = '../home.php';
                </script>";
        exit;
    } else {
        echo "<script>
                    alert('Usuário não encontrado ou senha incorreta!');
                    window.location.href = '../index.html';
                </script>";
        exit;
    }
} else {
    echo "<script>
                alert('Usuário não encontrado ou senha incorreta!');
                window.location.href = '../index.html';
            </script>";
    exit;
}


?>