<link rel="stylesheet" href="x-plano-contas/plano_contas.css">
<link rel="stylesheet" href="css/ripple.css">

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
            <div class="row">
                <div class="font01">GRUPOS</div>
            </div>
        </div>
        <div class="col s7">
        <div class="row">
                <div class="font01">CONTAS DO GRUPO</div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col s5 colunas">
            <div class="row tabela">
                <table id="table_grupos" class=""></table>
            </div>
        </div>
        <div class="col s7 colunas">
            <div class="row">
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
    $(document).ready(function() {
        // Carrega o arquivo plano_contas.js com artifício para desativar o cache no navegador
        var scriptUrl = 'x-plano-contas/plano_contas.js';
        var timestamp = new Date().getTime();
        var scriptElement = document.createElement('script');
        scriptElement.src = scriptUrl + '?v=' + timestamp;
        document.body.appendChild(scriptElement);
    });
</script>