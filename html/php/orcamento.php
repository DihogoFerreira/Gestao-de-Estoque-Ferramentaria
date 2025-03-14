<!DOCTYPE html>
<html lang="PT-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/footer.css">
    <link rel="stylesheet" href="css/header.css">
    <title>ORÇAMENTO</title>
</head>

<body>
    <?php
    session_start();
    date_default_timezone_set('America/Sao_Paulo');

    function getDiaSemana($data)
    {
        $diasSemana = array('Domingo', 'Segunda-feira', 'Terça-feira', 'Quarta-feira', 'Quinta-feira', 'Sexta-feira', 'Sábado');
        $numeroDiaSemana = date('w', strtotime($data));
        return $diasSemana[$numeroDiaSemana];
    }

    $dataAtual = date('Y-m-d H:i:s');
    $diaSemana = getDiaSemana($dataAtual);
    $dataHora = date('d/m/Y H:i:s');
    $horaAtual = date('H');

    if ($horaAtual >= 6 && $horaAtual < 12) {
        $saudacao = 'bom dia';
    } elseif ($horaAtual >= 12 && $horaAtual < 18) {
        $saudacao = 'boa tarde';
    } else {
        $saudacao = 'boa noite';
    }

    $localizacao = 'Juiz de Fora, Minas Gerais';
    $tituloPagina = "NOME DO PROGRAMA - MÓDULO DE COMPRAS - GESTÃO DE ORÇAMENTOS";
    ?>

    <div class="container">
        <?php include 'php/header.php'; ?>
    </div>
    <div class="saudacao">
        <?php if (isset($_SESSION['nome'])): ?>
            <p>
                Olá <?php echo htmlspecialchars($_SESSION['nome']); ?>     <?php echo $saudacao; ?>.
                Seja bem-vindo ao Gerenciador de Orçamentos, bom trabalho!! <br>
            </p>
        <?php else: ?>
            <p>Usuário não logado. <a href="index.html">Clique aqui para fazer login.</a></p>
        <?php endif; ?>
    </div>




    <body>
        <div id="botoes">
            <button id="criar-orcamento">Criar Orçamento</button>
            <button id="visualizar-historico">Visualizar Orçamentos</button>
            <button id="voltar">Voltar</button>
            <button id="btn-sair">Sair</button>
        </div>

        <section id="form-orcamento" style="display:none;">
            <h5>Formulário para inserir os itens.</h5>
            <form id="orcamento-form" action="../orc-main/php/save_orc.php" method="POST" enctype="multipart/form-data">
                <div id="form-campos">
                    <div style="display: flex; flex-direction: row; align-items: center;">
                        <div style="margin-right: 3px;">
                            <label for="descricao-item" class="form-label">Descrição do Item</label>
                            <input type="text" id="descricao-item" name="descricao_item" class="form-input"
                                placeholder="Digite a descrição do item">
                        </div>
                        <div style="margin-right: 3px;">
                            <label for="fornecedor-item" class="form-label">Fornecedor</label>
                            <input type="text" id="fornecedor-item" name="fornecedor_item" class="form-input"
                                placeholder="Digite o nome do fornecedor">
                        </div>
                        <div style="margin-right: 3px;">
                            <label for="quantidade-item" class="form-label">Qtdd.</label>
                            <input type="number" id="quantidade-item" name="quantidade_item" class="form-input"
                                placeholder="Qtdd.">
                        </div>
                        <div style="margin-right: 3px;">
                            <label for="valor-item" class="form-label">Valor</label>
                            <input type="valor" id="valor-item" name="valor_item" class="form-input"
                                placeholder="Valor ">
                        </div>
                        <div style="margin-right: 3px;">
                            <label for="forma-pag" class="form-label">Pagamento</label>
                            <input type="text" id="form-pag" name="forma_pagamento" class="form-input"
                                placeholder="Digite a forma de pagamento">
                        </div>
                        <div style="margin-right: 3px;">
                            <label for="foto-item" class="form-label">Foto</label>
                            <input type="file" id="foto-item" name="foto_item" class="form-input">
                        </div>
                        <div>
                            <button type="button" id="adicionar-item" class="btn-pequeno">Adicionar Item</button>
                        </div>
                    </div>
                </div>

                <h3>Itens Adicionados:</h3>
                <div id="lista-itens">
                    <div class="item-header">
                        <div>Descrição</div>
                        <div>Fornecedor</div>
                        <div>Quantidade</div>
                        <div>Valor</div>
                        <div>Pagamento</div>
                        <div>Foto</div>
                        <div>Ações</div>
                    </div>
                </div>

                <div id="botoes-container">
                    <div id="botoes2">
                        <button type="submit" id="finalizar-orcamento">Finalizar Orçamentos</button>
                        <button id="Imprimir">Imprimir</button>
                    </div>
                </div>
                <input type="hidden" id="itens-data" name="itens_data">
                <input type="hidden" id="numero-orcamento-input" name="numero_orcamento">
                <input type="hidden" id="usuario-id-input" name="usuario_id">
                <input type="hidden" id="data-hora-input" name="data_hora">
            </form>
        </section>

        <?php include 'php/footer.php'; ?>
        <script src="script.js"></script>
    </body>

</html>