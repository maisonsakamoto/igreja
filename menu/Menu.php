<div class="row">
    <div class="col s1">
        <div>
            <ul class="menu">
                <li title="Menu Barrinha"><a href="javascript:void(0);" class="menu-button home">menu</a></li>
            </ul>

            <ul class="menu-bar">
                <!--<li><a href="#" class="menu-button">Esconder Menu</a></li>   -->
                <li><b>Inicio</b></li>
                <li><a href="javascript:principal.abrirPagina('home.php');">Home</a></li>
                <li><a href="javascript:principal.abrirPagina('x-membresia/membresia.php');">Membresia Ativos</a></li>
                <li><a href="javascript:principal.abrirPagina('x-membresia/membresia_desligados.php');">Membresia Desligados</a></li>
                <li><a href="javascript:principal.abrirPagina('home_com_calendario.php');">Calendario</a></li>
                <li><b>Financeiro</b></li>
                <li><a href="javascript:principal.abrirPagina('x-plano-contas/plano_contas.php');">Plano de Contas</a></li>
                <li><a href="javascript:principal.abrirPagina('x-despesas/despesas.php');">Despesas</a></li>
                <li><a href="javascript:principal.abrirPagina('x-receitas/receitas.php');">Receitas</a></li>
                <li><a href="javascript:principal.abrirPagina('x-relatorios/relatorios.php');">Relatórios</a></li>
                <!--<li><a href="javascript:principal.abrirPagina('testes.php');">T E S T E S</a></li>-->
            </ul>
        </div>
    </div>
    <div class="col s2">
        <div class="logo">
            <img src="imagens/ibr_logo_2024.png" style="width: 100%; height: 100%; object-fit: contain;" />
        </div>
    </div>
    <div class="col s4">
        <input id="relogio" type="text" name="relogio" size="10" >
    </div>
</div>

<script type="text/javascript">
    principal.carregarArquivo('menu/Menu.css');
    principal.carregarArquivo('menu/Menu.js');
</script>
