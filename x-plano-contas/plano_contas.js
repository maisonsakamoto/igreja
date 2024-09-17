/**
 * PlanoContas
 * @author: Maison K. Sakamoto - 15/09/2024
 */
/// <reference path="../js/reference.js" />

var PlanoContas = class PlanoContas {
    constructor() {
        this.start();
    }

    start() {
        this.carregarGrupos();
        this.eventos();
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
            const $grid_grupos = $("#div_grupos");
            const idx = $grid_grupos.jqxGrid('getselectedrowindex');
            const row = $grid_grupos.jqxGrid('getrowdata', idx);
            const idi = row.id_grupo;
            const grupoNome = row.grupo_nome;

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
                        $.ajax({ url: 'x-plano-contas/col_plano_contas.php', type: 'POST', dataType: 'json',
                            data: { funcao: 'editarGrupo', id: idi, nome: novoNome },
                            success: () => {
                                $grid_grupos.jqxGrid('setcellvalue', idx, 'grupo_nome', novoNome);
                                $tela.dialog('close');
                            },
                            error: () => { custom.informe('Erro ao comunicar com o servidor'); }
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
                                    custom.informe('Erro ao criar novo grupo: ' + response.message);
                                }
                            },
                            error: () => { custom.informe('Erro ao comunicar com o servidor'); }
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
                                    custom.informe('Erro ao criar nova conta: ' + response.message);
                                }
                            },
                            error: () => { custom.informe('Erro ao comunicar com o servidor'); }
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
        const $grid_grupos = $("#div_grupos");
        const that = this;
        $grid_grupos.jqxGrid({ width: '100%', height: '100%', source: new $.jqx.dataAdapter({ localdata: grupos }),
            //columnsheight: 0,   // Altura do Cabecalho
            rowsheight: 20,      // Altura das linhas
            columns: [
                { text: 'ID'  , dataField: 'id_grupo'  , width: '15%', align: 'center', cellsalign:'center'},
                { text: 'Grupo Nome', dataField: 'grupo_nome', width: '85%', align: 'center', cellsalign:'left' }
            ]
        });

        $grid_grupos.on('rowselect', function(event){
            const idx = event.args.rowindex;
            const obj = $grid_grupos.jqxGrid('getrowdata', idx);
            that.carregarContas(obj.id_grupo);
        });
    }

    carregarContas(grupoId) {
        $.ajax({ url: 'x-plano-contas/col_plano_contas.php', type: 'POST', dataType: 'json',
            data: { funcao: 'getContas', grupoId: grupoId },
            success: (data) => { this.renderizarContas(data); },
            error: (xhr, status, error) => { console.error('Erro ao carregar contas:', error); }
        });
    }

    renderizarContas(contas) {
        const $grid_contas = $("#div_contas");
        $grid_contas.jqxGrid({ width: '100%', height: '100%', source: new $.jqx.dataAdapter({ localdata: contas }),
            //columnsheight: 0,   // Altura do Cabeçalho
            rowsheight: 20,      // Altura das linhas
            columns: [
                { text: 'ID', dataField: 'id_contas', width: '15%', align: 'center', cellsalign:'center'},
                { text: 'Conta Nome', dataField: 'conta_nome', width: '85%', align: 'center', cellsalign:'left' }
            ]
        });
    }
}

var planoContas = new PlanoContas();