<?php
session_start();
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link rel="stylesheet" type="text/css" href="../css/stylehome.css">
  <title>Home</title>

<body>

  <header>
    <h1>Home Logfer.</h1>
    <nav>
      <ul>
        <li>
          <a href="#" onclick="toggleDropdown('registrationDropdown')">Cadastro</a>
          <div class="dropdown-content" id="registrationDropdown">
            <a href="cadastrofuncionario.php">Cadastrar Usuário</a>
            <a href="cadastraritem.php">Cadastrar Item</a>
            <a href="orcamento.php">ORÇAMENTO</a>
          </div>
        </li>

        <li>
          <a href="#" onclick="toggleDropdown('stockDropdown')">Painel do Estoque</a>
          <div class="dropdown-content" id="stockDropdown">
            <a href="estoque.php">Estoque</a>
            <a href="user.php">Usuários</a>
            <a href="php/requisitaritem.php">Requisição</a>
            <a href="php/gerenciarrequisicoes.php">Devolução</a>

          </div>
        </li>

        <li><a href="index.html">Sair</a></li>
      </ul>
    </nav>
  </header>

  <footer>
    <p>&#174; 2024 Logfer. - Todos os direitos reservados.</p>
    <ul>
      <li><a href="#">Instagram</a></li>
      <li><a href="#">X</a></li>
    </ul>
    <p>Curso Desenvolvimento de Sistemas PROZ.</p>
  </footer>

  <script>
    function toggleDropdown(dropdownId) {
      const dropdowns = document.querySelectorAll('.dropdown-content');
      dropdowns.forEach(dropdown => {
        // Se o ID do dropdown atual for o que queremos abrir, alternamos a visibilidade
        if (dropdown.id === dropdownId) {
          dropdown.style.display = dropdown.style.display === 'block' ? 'none' : 'block';
        } else {
          dropdown.style.display = 'none'; // Fecha outros dropdowns
        }
      });
    }

    // Fecha dropdowns se clicar fora deles
    window.onclick = function (event) {
      if (!event.target.matches('a')) {
        const dropdowns = document.querySelectorAll('.dropdown-content');
        dropdowns.forEach(dropdown => {
          dropdown.style.display = 'none';
        });
      }
    }
  </script>

</body>

</html>