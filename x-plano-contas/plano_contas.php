<style>

    #bt_novo_grupo:hover, #bt_editar_grupo:hover, #bt_nova_conta:hover, #bt_editar_conta:hover {
        cursor: pointer;
        background: #CFCFCF;
        color: black;
    }
    #bt_novo_grupo, #bt_editar_grupo, #bt_nova_conta, #bt_editar_conta {
        background: #FFFFE0;
        width: 140px;
        font: 12px verdana;
        height: 30px;
        color: black;
        margin-bottom: 10px;
    }
    .cor_grid { color: red; font-weight: bold !important; }
    .cor_selecionado { background-color: #44983a !important; }

    #table_grupos {
        background-color: #e1f0e1;
    }
    .font01{
        background-color: black;
        height: 20px;
        border: 1px;
        font-family:verdana;
        font-size: 10px;
        color: white;
        font-weight:bold;
        list-style: none;
        line-height: 20px;
    }
    .font02{
        height: 20px;
        border: 1px;
        font-family:verdana;
        font-size: 10px;
        font-weight:bold;
        list-style: none;
        line-height: 20px;
    }
    .colunas {
        height: 500px;
        border: 1px solid black;
        background-color: bisque;
    }
    #pagina {
        background-color: white;
    }
    .line-height-1 {
        line-height: 20px;
    }
    .row .card{
        padding: 0px !important;
        color: white;
        background: black;
    }
    .btn-plano-contas {
        background: #FFFFE0;
        width: 140px;
        font: 12px verdana;
        height: 30px;
        color: black;
        margin-bottom: 10px;
        cursor: pointer;
        border: 1px solid #ccc;
        border-radius: 4px;
    }
    .btn-plano-contas:hover {
        background: #CFCFCF;
    }
    .colunas table {
        width: 100%;
        border-collapse: collapse;
    }
    th, td {
        text-align: left;
    }
    tr:hover {
        color: red !important;
        cursor: pointer;
    }
</style>

<link rel="stylesheet" href="css/ripple.css">

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
    <div class="col s5 colunas">
        <div class="row">
            <div class="font01">GRUPOS</div>
        </div>
        <div class="row">
            <table id="table_grupos" class=""></table>
        </div>
        <div class="row">
            <div id="bt_grupo">
                <button id="bt_novo_grupo" class="btn-plano-contas">Novo Grupo</button>
                <button id="bt_editar_grupo" class="btn-plano-contas">Editar Grupo</button>
            </div>
        </div>
    </div>
    <div class="col s7 colunas">
        <div class="row">
            <div class="font01">CONTAS DO GRUPO</div>
        </div>
        <div class="row">
            <table id="table_contas" class=""></table>
        </div>
        <div class="row">
            <div id="bt_contas">
                <button id="bt_nova_conta" class="btn-plano-contas">Nova Conta</button>
            </div>
        </div>
    </div>
</div>

<script src="x-plano-contas/plano_contas.js"></script>