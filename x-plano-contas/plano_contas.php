<div class="card">
    <div class="row">
        <div class="col s12">
            <div class="font01">
                <h4>PLANO DE CONTAS</h4>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col s5">
            <div class="font01">GRUPOS</div>
        </div>
        <div class="col s7">
            <div class="font01">CONTAS DO GRUPO</div>
        </div>
    </div>

    <div class="row">
        <div class="col s5">
            <div class="card colunas">
                <div id="div_grupos"></div>
                <table id="table_grupos" class=""></table>
            </div>
        </div>
        <div class="col s7">
            <div class="card colunas">
                <div id="div_contas"></div>
                <table id="table_contas" class=""></table>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col s5">
            <div id="bt_grupo">
                <button id="bt_novo_grupo" class="btn-plano-contas">Novo Grupo</button>
                <button id="bt_editar_grupo" class="btn-plano-contas">Editar Grupo</button>
            </div>
        </div>
        <div class="col s7">
            <div id="bt_contas">
                <button id="bt_nova_conta" class="btn-plano-contas">Nova Conta</button>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col s12">
            <div class="font01">LANÇAMENTOS DA CONTA</div>
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
        <div class="col s12">
            <div id="bt_lancamentos">
                <button id="bt_novo_lancamento" class="btn-plano-contas">Novo Lançamento</button>
            </div>
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
    principal.carregarArquivo('x-plano-contas/plano_contas.css');
    principal.carregarArquivo('x-plano-contas/plano_contas.js');
</script>
