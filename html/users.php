<?php session_start(); ?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gerenciamento de Usuários</title>
    <link rel="stylesheet" type="text/css" href="../css/stylegeruser.css">
    <script>
        function openEditModal(id, nome, sobrenome, nmat, funcao, sexo) {
            document.getElementById('editId').value = id;
            document.getElementById('editNome').value = nome;
            document.getElementById('editSobrenome').value = sobrenome;
            document.getElementById('editNmat').value = nmat;
            document.getElementById('editFuncao').value = funcao;
            document.getElementById('editSexo').value = sexo;
            document.getElementById('editModal').style.display = 'block';
        }

        function closeEditModal() {
            document.getElementById('editModal').style.display = 'none';
        }
    </script>
</head>

<body>

    <div class="container">
        <h1>Gerenciamento de Usuários</h1>

        <!-- Tabela de usuários -->
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nome</th>
                    <th>Sobrenome</th>
                    <th>Número de Matrícula</th>
                    <th>Função</th>
                    <th>Sexo</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php
                include 'conexao.php'; // Certifique-se de incluir seu arquivo de conexão
                $result = $conn->query("SELECT * FROM caduser");
                while ($row = $result->fetch_assoc()): ?>
                <tr>
                    <td>
                        <?php echo $row['id']; ?>
                    </td>
                    <td>
                        <?php echo $row['nome']; ?>
                    </td>
                    <td>
                        <?php echo $row['sobrenome']; ?>
                    </td>
                    <td>
                        <?php echo $row['nmat']; ?>
                    </td>
                    <td>
                        <?php echo $row['funcao']; ?>
                    </td>
                    <td>
                        <?php echo $row['sexo']; ?>
                    </td>
                    <td>
                        <button
                            onclick="openEditModal(<?php echo $row['id']; ?>, '<?php echo $row['nome']; ?>', '<?php echo $row['sobrenome']; ?>', '<?php echo $row['nmat']; ?>', '<?php echo $row['funcao']; ?>', '<?php echo $row['sexo']; ?>')">Editar</button>
                        <a href="cadastrofuncionario.php?delete=<?php echo $row['id']; ?>"
                            onclick="return confirm('Tem certeza?')">Excluir</a>
                    </td>
                </tr>
                <?php endwhile; ?>
            </tbody>
        </table>

        <!-- Modal para edição -->
        <div id="editModal" style="display:none;">
            <div class="modal-content">
                <span onclick="closeEditModal()" style="cursor:pointer;">&times;</span>
                <h2>Editar Usuário</h2>
                <form action="atualizar_usuario.php" method="POST">
                    <input type="hidden" id="editId" name="id">
                    <label for="editNome">Nome:</label>
                    <input type="text" id="editNome" name="nome" required>
                    <label for="editSobrenome">Sobrenome:</label>
                    <input type="text" id="editSobrenome" name="sobrenome" required>
                    <label for="editNmat">Número de Matrícula:</label>
                    <input type="text" id="editNmat" name="nmat" required>
                    <label for="editFuncao">Função:</label>
                    <input type="text" id="editFuncao" name="funcao" required>
                    <label for="editSexo">Sexo:</label>
                    <select id="editSexo" name="sexo" required>
                        <option value="Masculino">Masculino</option>
                        <option value="Feminino">Feminino</option>
                    </select>
                    <input type="submit" value="Atualizar">
                </form>
            </div>
        </div>