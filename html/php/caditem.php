<?php
session_start();
include 'conexao.php';

if (isset($_POST['Cadastraritem'])) {
    $nome = filter_input(INPUT_POST, 'nome', FILTER_SANITIZE_STRING);
    $codigo = filter_input(INPUT_POST, 'codigo', FILTER_SANITIZE_STRING);
    $quantidade = filter_input(INPUT_POST, 'quantidade', FILTER_SANITIZE_NUMBER_INT);

    if (empty($nome) || empty($codigo) || empty($quantidade)) {
        echo "<script> 
            alert('Preencha todos os campos !!');
            window.location.href = '../cadastraritem.php';
            </script>";
        // exit;
    }

    $declaracao = $conexao->prepare("select nome from estoque where nome = ?");
    $declaracao->bind_param("s", $nome);
    $declaracao->execute();
    $declaracao->store_result();
    if ($declaracao->num_rows > 0) {
        echo " <script>
        alert('O item já cadastrado!!!');
        window.location.href = '../cadastraritem.php';
      </script>";
        $declaracao->close();
    }
    //$stmt
    $declaracao = $conexao->prepare(" 
    INSERT INTO estoque (nome, codigo, quantidade) VALUES (?, ?, ?)");

    $declaracao->bind_param
    ("ssi", $nome, $codigo, $quantidade);
    if ($declaracao->execute()) {
        echo " <script>
        alert('O item foi cadastrado com sucesso');
        window.location.href = '../cadastraritem.php';
      </script>";

    } else {
        echo "Erro ao cadastrar item: " . $declaracao->error;
    }

}

if (isset($_POST['buscar'])) {
    $buscar_id = $_POST['id'];

    $stmt = $conexao->prepare("SELECT nome, codigo, quantidade, 
        categoria FROM estoque WHERE id = ?");
    $stmt->bind_param("s", $buscar_id);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        $stmt->bind_result(
            $nome,
            $codigo,
            $quantidade
        );
        $stmt->fetch();
        unset($_SESSION['nome']);
        unset($_SESSION['codigo']);
        unset($_SESSION['quantidade']);
        header("Location: ../cadastraritem.php");

    } else {
        echo "<script>
                alert('Item não encontrado');
                window.location.href = '../cadastraritem.php';
              </script>";
        // exit;
    }

    // Fecha a declaração e a conexão
    $stmt->close();
    $conexao->close();
}

exit;


?>