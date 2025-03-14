<?php
session_start();
include 'conexao.php';

if (isset($_POST['cadastrofuncionario'])) {
    $nome = filter_input(INPUT_POST, 'nome', FILTER_SANITIZE_STRING);
    $sobrenome = filter_input(INPUT_POST, 'sobrenome', FILTER_SANITIZE_STRING);
    $nmat = filter_input(INPUT_POST, 'nmat', FILTER_SANITIZE_NUMBER_INT);
    $funcao = filter_input(INPUT_POST, 'funcao', FILTER_SANITIZE_STRING);
    $sexo = filter_input(INPUT_POST, 'sexo', FILTER_SANITIZE_STRING);
    $senha = filter_input(INPUT_POST, 'senha', FILTER_SANITIZE_STRING);

    if (empty($nome) || empty($sobrenome) || empty($nmat) || empty($funcao) || empty($sexo) || empty($senha)) {
        echo "<script> 
            alert('Preencha todos os campos !!');
            window.location.href = '../cadastrofuncionario.php';
            </script>";
        exit;
    }

    // Verificar se o nmat já está cadastrado
    $declaracao = $conexao->prepare("SELECT nmat FROM caduser WHERE nmat = ?");
    $declaracao->bind_param("i", $nmat);
    $declaracao->execute();
    $declaracao->store_result();

    if ($declaracao->num_rows > 0) {
        echo "<script>
            alert('O Usuário já está cadastrado');
            window.location.href = '../cadastrofuncionario.php';
            </script>";
    } else {
        // Inserir novo usuário
        $declaracao = $conexao->prepare("INSERT INTO caduser (nome, sobrenome, nmat, funcao, sexo, senha) VALUES (?, ?, ?, ?, ?, ?)");
        $declaracao->bind_param("ssissi", $nome, $sobrenome, $nmat, $funcao, $sexo, $senha);

        if ($declaracao->execute()) {
            echo "<script>
                alert('Cadastrado com sucesso');
                window.location.href = '../cadastrofuncionario.php';
                </script>";
        } else {
            echo "Erro ao cadastrar Usuário: " . $declaracao->error;
        }
    }

    $declaracao->close();
    $conexao->close();
}
?>