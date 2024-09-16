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
        this.carregarLancamentos();7
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

        $('#bt_novo_lancamento').click((e) => {
            e.stopImmediatePropagation();

            const $tela = $('#novoLancamentoForm').clone();
            $tela.find('#valor').setMask();
            $tela.dialog({ title: 'Novo Lançamento', modal: true, width: 500,
                open: function() {
                    $.ajax({ url: 'x-plano-contas/col_plano_contas.php', type: 'POST', dataType: 'json',  data: { funcao: 'getGrupos' },
                        success: (grupos) => {
                            const $grupoSelect = $tela.find('#grupoSelect');
                            $grupoSelect.empty();
                            $grupoSelect.append('<option value="">Selecione um grupo</option>');
                            grupos.forEach(grupo => {
                                $grupoSelect.append(`<option value="${grupo.id_grupo}">${grupo.grupo_nome}</option>`);
                            });

                            $grupoSelect.change(function() {
                                const grupoId = $(this).val();
                                if (grupoId) {
                                    $.ajax({  url: 'x-plano-contas/col_plano_contas.php', type: 'POST', dataType: 'json', data: { funcao: 'getContas', grupoId: grupoId },
                                        success: (contas) => {
                                            const $contaSelect = $tela.find('#contaSelect');
                                            $contaSelect.empty();
                                            $contaSelect.append('<option value="">Selecione uma conta</option>');
                                            contas.forEach(conta => {
                                                $contaSelect.append(`<option value="${conta.id_contas}">${conta.nome}</option>`);
                                            });
                                        },
                                        error: () => { custom.informe('Erro ao carregar contas'); }
                                    });
                                } else {
                                    $('#contaSelect').empty().append('<option value="">Selecione uma conta</option>');
                                }
                            });
                        },
                        error: () => { custom.informe('Erro ao carregar grupos'); }
                    });
                },
                buttons: {
                    'Salvar': () => {
                        const contaId = $tela.find('#contaSelect').val();
                        const dataEmissao = $tela.find('#dataEmissao').val();
                        const descricao = $tela.find('#descricao').val();
                        const valor = custom.convertNumero($tela.find('#valor').val());


                        if (!contaId) {
                            custom.informe('Por favor, selecione uma conta');
                            return;
                        }
                        if (!dataEmissao) {
                            custom.informe('Por favor, selecione uma data de emissão');
                            return;
                        }
                        if (!descricao) {
                            custom.informe('Por favor, insira uma descrição');
                            return;
                        }
                        if (!valor) {
                            custom.informe('Por favor, insira um valor');
                            return;
                        }

                        $.ajax({ url: 'x-plano-contas/col_plano_contas.php', type: 'POST', dataType: 'json', dataType: 'json',
                            data: { funcao: 'novoLancamento',
                                dataEmissao: dataEmissao, descricao: descricao, valor: valor, contaId: contaId
                            },
                            success: (response) => {
                                if (response.success) {
                                    this.carregarLancamentos();
                                    $tela.dialog('close');
                                } else {
                                    custom.informe('Erro ao criar novo lançamento: ' + response.message);
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
            columnsheight: 0,   // Altura do Cabecalho
            rowsheight: 20,      // Altura das linhas
            columns: [
                { text: 'ID'  , dataField: 'id_grupo'  , width: '15%', align: 'center', cellsalign:'center'},
                { text: 'Nome', dataField: 'grupo_nome', width: '85%', align: 'center', cellsalign:'left' }
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
            columnsheight: 0,   // Altura do Cabeçalho
            rowsheight: 20,      // Altura das linhas
            columns: [
                { text: 'ID', dataField: 'id_contas', width: '15%', align: 'center', cellsalign:'center'},
                { text: 'Nome', dataField: 'nome', width: '85%', align: 'center', cellsalign:'left' }
            ]
        });
    }

    carregarLancamentos(contaId) {
        $.ajax({ url: 'x-plano-contas/col_plano_contas.php', type: 'POST', dataType: 'json', data: { funcao: 'getLancamentos' },
            success: (data) => { this.renderizarLancamentos(data); },
            error: (xhr, status, error) => { console.error('Erro ao carregar lançamentos:', error); }
        });
    }

    renderizarLancamentos(lancamentos) {
        const $grid_lancamentos = $("#div_lancamentos");
        $grid_lancamentos.jqxGrid({ width: '100%', height: '100%', source: new $.jqx.dataAdapter({ localdata: lancamentos }),
            columnsheight: 0,
            rowsheight: 20,
            columns: [
                { text: 'ID', dataField: 'lanc_id', width: '10%', align: 'center', cellsalign:'center'},
                { text: 'Data', dataField: 'lanc_dt_emissao', width: '20%', align: 'center', cellsalign:'center'},
                { text: 'Descrição', dataField: 'lanc_descricao', width: '50%', align: 'center', cellsalign:'left'},
                { text: 'Valor', dataField: 'lanc_valor', width: '20%', align: 'center', cellsalign:'right'}
            ]
        });
    }
}

var planoContas = new PlanoContas();