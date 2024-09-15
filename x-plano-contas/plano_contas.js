/**
 * PlanoContas
 * @author: Maison K. Sakamoto - 15/09/2024
 */

var PlanoContas = class PlanoContas {
    constructor() {
        this.start();
    }

    start() {
        this.carregarGrupos();
        // this.eventos(); // carregar os eventos somente após carregar os grupos de contas
    }

    eventos() {
        $('#table_grupos tr').on('click', (e) => {
            e.stopImmediatePropagation();
            $('.cor-selecionado').removeClass('cor-selecionado');
            $(e.currentTarget).addClass('cor-selecionado');

            const idi = $(e.currentTarget).find('div').attr('nr-id');
            $('#bt_editar_grupo').attr('nr_id', idi);
            $('#bt_nova_conta').attr('nr_id', idi);
            $('#bt_novo_grupo').attr('nr_id', idi);
            this.carregarContas(idi);
        });

        $('#bt_editar_grupo').click((e) => {
            e.stopImmediatePropagation();
            const idi = $(e.currentTarget).attr('nr_id');
            const $grupoSelecionado = $('#table_grupos tr.cor-selecionado');
            const grupoNome = $grupoSelecionado.find('td:eq(1) div').text();

            const dialogContent = `
                <form id="editarGrupoForm">
                    <label for="grupoNome">Nome do Grupo:</label>
                    <input type="text" id="grupoNome" name="grupoNome" value="${grupoNome}" required>
                </form>
            `;

            const $tela = $('<div>').html(dialogContent);
            $tela.dialog({ title: 'Editar Grupo', modal: true, width: 400,
                buttons: {
                    'Salvar': () => {
                        const novoNome = $('#grupoNome').val();
                        $.ajax({
                            url: 'x-plano-contas/col_plano_contas.php',
                            type: 'POST',
                            dataType: 'json',
                            data: { funcao: 'editarGrupo', id: idi, nome: novoNome },
                            success: () => {
                                $grupoSelecionado.find('td:eq(1) div').text(novoNome);
                                $tela.dialog('close');
                            },
                            error: () => { alert('Erro ao comunicar com o servidor'); }
                        });
                    },
                    'Cancelar': function() { $(this).dialog('close'); }
                },
                close: function() { $(this).dialog('destroy').remove(); }
            });
        });

        $('#bt_novo_grupo').click((e) => {
            e.stopImmediatePropagation();

            const dialogContent = `
                <form id="novoGrupoForm">
                    <label for="grupoNome">Nome do Novo Grupo:</label>
                    <input type="text" id="grupoNome" name="grupoNome" required>
                </form>
            `;

            const $tela = $('<div>').html(dialogContent);
            $tela.dialog({ title: 'Novo Grupo', modal: true, width: 400,
                buttons: {
                    'Salvar': () => {
                        const novoNome = $('#grupoNome').val();

                        $.ajax({ url: 'x-plano-contas/col_plano_contas.php', type: 'POST', dataType: 'json',
                            data: { funcao: 'novoGrupo', nome: novoNome },
                            success: (response) => {
                                if (response.success) {
                                    this.carregarGrupos();
                                    $tela.dialog('close');
                                } else {
                                    alert('Erro ao criar novo grupo: ' + response.message);
                                }
                            },
                            error: () => { alert('Erro ao comunicar com o servidor'); }
                        });
                    },
                    'Cancelar': function() { $(this).dialog('close'); }
                },
                close: function() { $(this).dialog('destroy').remove(); }
            });
        });

        $('#bt_nova_conta').click((e) => {
            e.stopImmediatePropagation();
            console.info('Nova Conta');

            const grupoId = $(e.currentTarget).attr('nr_id');
            console.log('ID do grupo: ' + grupoId);

            const dialogContent = `
                <form id="novaContaForm">
                    <label for="contaNome">Nome da Nova Conta:</label>
                    <input type="text" id="contaNome" name="contaNome" required>
                </form>
            `;

            const $tela = $('<div>').html(dialogContent);
            $tela.dialog({ title: 'Nova Conta', modal: true, width: 400,
                buttons: {
                    'Salvar': () => {
                        const novoNome = $('#contaNome').val();

                        $.ajax({ url: 'x-plano-contas/col_plano_contas.php', type: 'POST', dataType: 'json',
                            data: { funcao: 'novaConta', nome: novoNome, grupoId: grupoId },
                            success: (response) => {
                                if (response.success) {
                                    this.carregarContas(grupoId);
                                    $tela.dialog('close');
                                } else {
                                    alert('Erro ao criar nova conta: ' + response.message);
                                }
                            },
                            error: () => { alert('Erro ao comunicar com o servidor'); }
                        });
                    },
                    'Cancelar': function() { $(this).dialog('close'); }
                },
                close: function() { $(this).dialog('destroy').remove(); }
            });
        });
    }

    carregarGrupos() {
        $.ajax({ url: 'x-plano-contas/col_plano_contas.php', type: 'POST', dataType: 'json',
            data: { funcao: 'getGrupos' },
            success: (data) => { this.renderizarGrupos(data); },
            error: (xhr, status, error) => { console.error('Erro ao carregar grupos:', error); }
        });
    }

    renderizarGrupos(grupos) {
        const $table = $('<table id="table_grupos"></table>');
        grupos.forEach((grupo) => {
            const $tr = $('<tr>').addClass('hover info botao aciona');
            const $tdId = $('<td>').css('width', '30%');
            const $tdNome = $('<td>').css('width', '70%');

            $('<div>').attr({'nr-id': grupo.id_grupo}).text(grupo.id_grupo).addClass('font02').appendTo($tdId);
            $('<div>').attr({'nr-id': grupo.id_grupo}).text(grupo.grupo_nome.substr(0, 50)).addClass('font02').appendTo($tdNome);

            $tr.append($tdId).append($tdNome);
            $table.append($tr);
        });

        $('#table_grupos').replaceWith($table);
        this.eventos();
    }

    carregarContas(grupoId) {
        $.ajax({ url: 'x-plano-contas/col_plano_contas.php', type: 'POST', dataType: 'json',
            data: { funcao: 'getContas', grupoId: grupoId },
            success: (data) => { this.renderizarContas(data); },
            error: (xhr, status, error) => { console.error('Erro ao carregar contas:', error); }
        });
    }

    renderizarContas(contas) {
        const $table = $('<table id="table_contas"></table>');

        contas.forEach((conta) => {
            const $tr = $('<tr>').addClass('hover info botao aciona');
            const $tdId = $('<td>').css('width', '35px');
            const $tdNome = $('<td>').css('width', '250px');

            const $divId = $('<div>');
            $divId.attr({'nr_id': conta.id_conta}).text(conta.id_contas);
            $divId.attr('class', 'font02');
            $divId.appendTo($tdId);
            const $divNome = $('<div>');
            conta.nome == null ? conta.nome = '' : conta.nome = conta.nome;
            $divNome.attr({'nr_id': conta.id_conta}).text(conta.nome.substr(0, 50));
            $divNome.attr('class', 'font02');
            $divNome.appendTo($tdNome);

            $tr.append($tdId).append($tdNome);
            $table.append($tr);
        });

        $('#table_contas').replaceWith($table);
    }
}

var planoContas = new PlanoContas();