/**
 * PlanoContas
 * @author: Maison K. Sakamoto - 15/09/2024
 */
/// <reference path="../js/reference.js" />

var $grid_grupos = $('#div_grupos');
var $grid_contas = $('#div_contas');

var PlanoContas = class PlanoContas {
    constructor() {
        this.start();
    }

    start() {
        this.carregarGrupos();
        this.eventos();
    }

    eventos() {
        $('#bt_editar_grupo').click((e) => {
            e.stopImmediatePropagation();
            const idx = $grid_grupos.jqxGrid('getselectedrowindex');
            const row = $grid_grupos.jqxGrid('getrowdata', idx);
            const idi = row.id_grupo;
            const grupoNome = row.grupo_nome;
            const grupoTipo = row.grupo_tipo;

            const dialogContent = `
                <form id="editarGrupoForm">
                    <label for="grupoNome">Nome do Grupo:</label>
                    <input type="text" id="grupoNome" name="grupoNome" value="${grupoNome}" required>
                    <br><br>
                    <label for="grupoTipo">Tipo de Grupo:</label>
                    <select id="grupoTipo" name="grupoTipo" required>
                        <option value="D" ${grupoTipo === 'D' ? 'selected' : ''}>Despesas</option>
                        <option value="R" ${grupoTipo === 'R' ? 'selected' : ''}>Receitas</option>
                    </select>
                </form>
            `;

            const $tela = $('<div>').html(dialogContent);
            $tela.dialog({ title: 'Editar Grupo', modal: true, width: 400,
                buttons: {
                    'Salvar': () => {
                        const novoNome = $('#grupoNome').val();
                        const novoTipo = $('#grupoTipo').val();
                        $.ajax({ url: 'x-plano-contas/col_plano_contas.php', type: 'POST', dataType: 'json',
                            data: { funcao: 'editarGrupo', id: idi, nome: novoNome, grupoTipo: novoTipo },
                            success: () => {
                                $grid_grupos.jqxGrid('setcellvalue', idx, 'grupo_nome', novoNome);
                                $grid_grupos.jqxGrid('setcellvalue', idx, 'grupo_tipo', novoTipo);
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
                    <br><br>
                    <label for="grupoTipo">Tipo de Grupo:</label>
                    <select id="grupoTipo" name="grupoTipo" required>
                        <option value="D">Despesas</option>
                        <option value="R">Receitas</option>
                    </select>
                </form>
            `;

            const $tela = $('<div>').html(dialogContent);
            $tela.dialog({ title: 'Novo Grupo', modal: true, width: 400,
                buttons: {
                    'Salvar': () => {
                        const novoNome = $('#grupoNome').val();
                        const novoTipo = $('#grupoTipo').val();

                        $.ajax({ url: 'x-plano-contas/col_plano_contas.php', type: 'POST', dataType: 'json',
                            data: { funcao: 'novoGrupo', nome: novoNome, grupoTipo: novoTipo },
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

            const idx = $grid_grupos.jqxGrid('getselectedrowindex');
            const row = $grid_grupos.jqxGrid('getrowdata', idx);
            const grupoId = row.id_grupo;
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
        const that = this;
        $grid_grupos.jqxGrid({ width: '99.6%', height: '525px', source: new $.jqx.dataAdapter({ localdata: grupos }),
            rowsheight: 20,
            columns: [
                { text: 'ID'  , dataField: 'id_grupo'  , width: '10%', align: 'center', cellsalign:'center'},
                { text: 'Grupo Nome', dataField: 'grupo_nome', width: '75%', align: 'center', cellsalign:'left' },
                { text: 'Tipo', dataField: 'grupo_tipo', width: '15%', align: 'center', cellsalign:'center',
                  cellsrenderer: (row, column, value) => { return value === 'D' ? 'DESPESAS' : 'RECEITAS'; }
                }
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
        $grid_contas.jqxGrid({ width: '99.8%', height: '525px', source: new $.jqx.dataAdapter({ localdata: contas }),
            rowsheight: 20,
            columns: [
                { text: 'ID', dataField: 'id_contas', width: '15%', align: 'center', cellsalign:'center'},
                { text: 'Conta Nome', dataField: 'conta_nome', width: '85%', align: 'center', cellsalign:'left' }
            ]
        });
    }
}

var planoContas = new PlanoContas();