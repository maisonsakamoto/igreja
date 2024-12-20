/**
 * @author: Maison K. Sakamoto - 17/09/2024 @description Classe para gerenciamento de lançamentos
 */
/// <reference path="../js/reference.js" />

var Lancamentos = class Lancamentos {
    col_altura = principal.altura_pagina-115;

    constructor() {
        this.eventos();
        this.carregarLancamentos();
        this.selectedLancamentoId = null;
        $(".colunas").css('height', principal.altura_pagina-110);
    }

    eventos() {
        const that = this;

        $('#bt_novo_lancamento').click((e) => {
            e.stopImmediatePropagation();
            that.telaNovoLancamento();
        });

        $('#bt_excluir_lancamento').click((e) => {
            e.stopImmediatePropagation();
            that.excluirLancamento();
        });
    }

    telaNovoLancamento() {
        const that = this;
        const $tela = $('#novoLancamentoForm').clone();

        $tela.find('#valor').setMask();
        $tela.dialog({ title: 'Novo Lançamento', modal: true, width: 550,
            open: function() {
                const $ajax = custom.ajaxAsync({ grupoTipo: 'R' }, 'getGruposTipo', 'x-plano-contas/col_plano_contas.php');
                $ajax.always(function(data, status) {
                    if (status == 'success') { that.renderizarGrupos($tela, data); }
                    else { custom.informe('Erro ao carregar grupos: ' + data.responseText); }
                });
            },
            buttons: {
                'Salvar': () => { that.inserirLancamento($tela); },
                'Cancelar': () => { $tela.dialog('close'); }
            },
            close: () => { $tela.dialog('destroy').remove(); }
        });
    }

    renderizarGrupos($tela, grupos) {
        const $grupoSelect = $tela.find('#grupoSelect');
        const $contaSelect = $tela.find('#contaSelect');

        $grupoSelect.empty();
        $grupoSelect.append('<option value="">Selecione um grupo</option>');
        grupos.forEach(grupo => {
            $grupoSelect.append(`<option value="${grupo.id_grupo}">${grupo.grupo_nome}</option>`);
        });

        $grupoSelect.change(function() {
            const grupoId = $(this).val();
            if (grupoId) {
                $.ajax({ url: 'x-plano-contas/col_plano_contas.php', data: { funcao: 'getContas', grupoId: grupoId }, type: 'POST', dataType: 'json',
                    success: (contas) => {
                        $contaSelect.empty();
                        $contaSelect.append('<option value="">Selecione uma conta</option>');
                        contas.forEach(conta => {
                            $contaSelect.append(`<option value="${conta.id_contas}">${conta.conta_nome}</option>`);
                        });
                    },
                    error: (err) => { custom.informe(err.responseText); }
                });
            } else {
                $contaSelect.empty().append('<option value="">Selecione uma conta</option>');
            }
        });
    }

    inserirLancamento($tela) {
        const that = this;
        const contaId = $tela.find('#contaSelect').val();
        const dataEmissao = $tela.find('#dataEmissao').val();
        const descricao = $tela.find('#descricao').val();
        const valor = custom.convertFloatNumber($tela.find('#valor').val());

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
        if (valor == 0) {
            custom.informe('Por favor, insira um valor');
            return;
        }

        var obj = { dataEmissao: dataEmissao, descricao: descricao, valor: valor, contaId: contaId };
        var $ajax = custom.ajaxAsync(obj, 'novoLancamento', 'x-receitas/col_receitas.php');
        $ajax.always(function(json, status) {
            if (status == 'success') { that.carregarLancamentos(); }
            else { custom.informe('Erro ao criar novo lançamento: ' + json.responseText); }
            $tela.dialog('close');
        });
    }

    carregarLancamentos() {
        const that = this;
        const $ajax = custom.ajaxAsync({}, 'getLancamentos', 'x-receitas/col_receitas.php');
        $ajax.always(function(data, status) {
            if (status == 'success') { that.renderizarLancamentos(data); }
            else { custom.informe('Erro ao carregar lançamentos: ' + data.responseText); }
        });
    }

    renderizarLancamentos(lancamentos) {
        const that = this;
        const $grid_lancamentos = $("#div_lancamentos");
        var datafields = [
            { name: 'lanc_id'         , type: 'number' },
            { name: 'lanc_dt_emissao' , type: 'date', format: 'yyyy-MM-dd'   }, // o formato de data do banco de dados é yyyy-MM-dd
            { name: 'lanc_descricao'  , type: 'string' },
            { name: 'lanc_valor'      , type: 'number' },
            { name: 'conta_nome'      , type: 'string' },
            { name: 'grupo_nome'      , type: 'string' }
        ];
        $grid_lancamentos.jqxGrid({
            width: '100%', source: new $.jqx.dataAdapter({ localdata: lancamentos, datafields: datafields }),
            height: that.col_altura,
            selectionmode: 'row', // MODO DE SELECAO 'singlecell', 'none', 'row' // TIPOS DE SELEÇÃO
            columnsresize: true,  // Habilitar redimensionamento de colunas
            sortable: true,       // Habilitar ordenação
            //columnsheight: 0,   // Altura do cabeçalho
            rowsheight: 20,       // Altura das linhas
            columns: [
                { text: 'ID'       , dataField: 'lanc_id'        , align: 'center', width: '5%'  , cellsalign:'center'},
                { text: 'Data'     , dataField: 'lanc_dt_emissao', align: 'center', width: '10%' , cellsalign:'center' , cellsformat: 'dd/MM/yyyy'}, // formato que será exibido
                { text: 'Descrição', dataField: 'lanc_descricao' , align: 'center', width: '35%' , cellsalign:'left'  },
                { text: 'Grupo'    , dataField: 'grupo_nome'     , align: 'center', width: '20%' , cellsalign:'left'  },
                { text: 'Conta'    , dataField: 'conta_nome'     , align: 'center', width: '20%' , cellsalign:'left'  },
                { text: 'Valor'    , dataField: 'lanc_valor'     , align: 'center', width: '10%' , cellsalign:'right'  , cellsformat: 'f2' }
            ]
        });

        $grid_lancamentos.jqxGrid('localizestrings', custom.localizestrings);
        $grid_lancamentos.jqxGrid('refresh');

        $grid_lancamentos.on('rowselect', function (event) {
            const rowData = event.args.row;
            that.selectedLancamentoId = rowData.lanc_id;
            $('#bt_excluir_lancamento').prop('disabled', false);
        });

        $grid_lancamentos.on('rowunselect', function (event) {
            that.selectedLancamentoId = null;
            $('#bt_excluir_lancamento').prop('disabled', true);
        });
    }

    excluirLancamento() {
        const that = this;
        if (!this.selectedLancamentoId) {
            custom.informe('Por favor, selecione um lançamento para excluir');
            return;
        }

        custom.confirme('Tem certeza que deseja excluir este lançamento?', function() {
            const obj = { lancamentoId: that.selectedLancamentoId };
            const $ajax = custom.ajaxAsync(obj, 'excluirLancamento', 'x-receitas/col_receitas.php');
            $ajax.always(function(json, status) {
                if (status == 'success') {
                    custom.informe('Lançamento excluído com sucesso');
                    that.carregarLancamentos();
                } else {
                    custom.informe('Erro ao excluir lançamento: ' + json.responseText);
                }
            });
        });
    }
}

var lancamentos = new Lancamentos();