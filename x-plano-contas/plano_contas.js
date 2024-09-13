var principal = {};

principal.start = function() {
    principal.eventos();
    principal.carregarGrupos();
};

principal.eventos = function() {
    $('#table_grupos tr').on('click', function(e) {
        e.stopImmediatePropagation();
        $('.cor-selecionado').removeClass('cor-selecionado');
        $(this).addClass('cor-selecionado');

        window.mostra_botoes();
        var idi = $(this).find('div').attr('nr-id');
        $('#bt_editar_grupo').attr('nr_id', idi);
        $('#bt_nova_conta').attr('nr_id', idi);
        $('#bt_novo_grupo').attr('nr_id', idi);
        principal.carregarContas(idi);
    });

    $('#bt_editar_grupo').click(function() {
        console.info('Editar Grupo');
        var idi = $(this).attr('nr_id');
        console.log(idi);
        var url = ("x-plano-contas/grupo_edita.php?nrid=" + idi);
        $('#itens').load(url);
        window.esconde_botoes();
    });

    $('#bt_novo_grupo').click(function() {
        console.info('Novo Grupo');
        window.esconde_botoes();
        var idi = $('#bt_editar_grupo').attr('nr_id');
        console.log('numero idi' + idi);
        var url = ("x-plano-contas/grupo_novo.php?nrid=" + idi);
        $('#itens').load(url);
    });

    $('#bt_nova_conta').click(function() {
        console.info('Nova Conta');
        window.esconde_botoes();
        var idi = $(this).attr('nr_id');
        console.log('numero do idi  ' + idi);
        var url = ("x-plano-contas/contas_nova.php?nrid=" + idi);
        $('#itens').load(url);
    });
};

principal.carregarGrupos = function() {
    $.ajax({
        url: 'x-plano-contas/col_plano_contas.php',
        method: 'GET',
        dataType: 'json',
        data: { funcao: 'getGrupos' },
        success: function(data) {
            principal.renderizarGrupos(data);
        },
        error: function(xhr, status, error) {
            console.error('Erro ao carregar grupos:', error);
        }
    });
};

principal.renderizarGrupos = function(grupos) {
    var $table = $('<table id="table_grupos"></table>');
    var primeiro = 0;

    grupos.forEach(function(grupo) {
        if (primeiro === 0) {
            primeiro = 1;
            $('<div>').attr({
                id: 'nr_id',
                'data-value': grupo.id_grupo
            }).css('display', 'none').appendTo('body');
        }

        var $tr = $('<tr>').addClass('hover info botao aciona');
        var $tdId = $('<td>').css('width', '30%');
        var $tdNome = $('<td>').css('width', '70%');

        $('<div>').attr({'nr-id': grupo.id_grupo}).text(grupo.id_grupo).addClass('font02').appendTo($tdId);

        $('<div>').attr({'nr-id': grupo.id_grupo}).text(grupo.grupo_nome.substr(0, 50)).addClass('font02').appendTo($tdNome);

        $tr.append($tdId).append($tdNome);
        $table.append($tr);
    });

    $('#table_grupos').replaceWith($table);
    principal.eventos();
};

principal.carregarContas = function(grupoId) {
    $.ajax({
        url: 'x-plano-contas/col_plano_contas.php',
        method: 'GET',
        dataType: 'json',
        data: { funcao: 'getContas', grupoId: grupoId },
        success: function(data) {
            principal.renderizarContas(data);
        },
        error: function(xhr, status, error) {
            console.error('Erro ao carregar contas:', error);
        }
    });
};

principal.renderizarContas = function(contas) {
    var $table = $('<table id="table_contas"></table>');

    contas.forEach(function(conta) {
        var $tr = $('<tr>').addClass('hover info botao aciona');
        var $tdId = $('<td>').css('width', '35px');
        var $tdNome = $('<td>').css('width', '250px');

        $('<div>').attr({'nr_id': conta.id_conta}).text(conta.id_conta).addClass('font02').appendTo($tdId);

        $('<div>').attr({'nr_id': conta.id_conta}).text(conta.nome.substr(0, 50)).addClass('font02').appendTo($tdNome);

        $tr.append($tdId).append($tdNome);
        $table.append($tr);
    });

    $('#table_contas').replaceWith($table);
};

principal.start();