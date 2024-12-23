
<?php
session_start();

if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header("Location: index.php");
    exit;
}
?>
<div class="row">
    <div class="col s12">
        <div class="font01">LANÇAMENTOS DE DESPESAS</div>
    </div>
</div>

<div class="row">
    <div class="col s12">
        <div class="card colunas">
            <div id="div_lancamentos"></div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col s2 offset-s8">
        <button id="bt_excluir_lancamento" class="btn-plano-contas" disabled>Excluir Lançamento</button>
    </div>
    <div class="col s2">
        <div id="bt_lancamentos">
            <button id="bt_novo_lancamento" class="btn-plano-contas">Novo Lançamento</button>
        </div>
    </div>
</div>
<!-- Modal Novo Lançamento -->
<form id="novoLancamentoForm" class="hide">
    <div class="row">
        <div class="col s4">
            <label for="grupoSelect">Grupo:</label>
        </div>
        <div class="col s8">
            <div class="input-field">
                <select id="grupoSelect" name="grupoSelect" required>
                    <option value="" disabled selected>Escolha um grupo</option>
                </select>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col s4">
            <label for="contaSelect">Conta:</label>
        </div>
        <div class="col s8">
            <div class="input-field">
                <select id="contaSelect" name="contaSelect" required>
                    <option value="" disabled selected>Escolha uma conta</option>
                </select>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col s4">
            <label for="dataEmissao">Data de Emissão:</label>
        </div>
        <div class="col s8">
            <div class="input-field">
                <input type="date" id="dataEmissao" name="dataEmissao" required>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col s4">
            <label for="descricao">Descrição:</label>
        </div>
        <div class="col s8">
            <div class="input-field">
                <input type="text" id="descricao" name="descricao" required>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col s4">
            <label for="valor">Valor:</label>
        </div>
        <div class="col s8">
            <div class="input-field">
                <input id="valor" name="valor" alt="decimal" required>
            </div>
        </div>
    </div>
</form>

<script type="text/javascript">
    principal.carregarArquivo('x-despesas/despesas.css');
    principal.carregarArquivo('x-despesas/despesas.js');
</script>