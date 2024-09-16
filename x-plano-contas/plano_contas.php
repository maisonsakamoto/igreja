<div class="card">
    <div class="row">
        <div class="col s12">
            <div class="card">
                <div class="font01">
                    <h4>PLANO DE CONTAS</h4>
                </div>
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
</div>
<script type="text/javascript">
    principal.carregarArquivo('x-plano-contas/plano_contas.css');
    principal.carregarArquivo('x-plano-contas/plano_contas.js');
</script>
