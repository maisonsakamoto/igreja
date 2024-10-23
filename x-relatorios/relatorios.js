/**
 * @author: Maison K. Sakamoto - 17/09/2024 @description Classe para gerenciamento de lançamentos
 */
/// <reference path="../js/reference.js" />

var Relatorios = class Relatorios {

    constructor() {
        this.eventos();
        $(".colunas").css('height', principal.altura_pagina-140);
    }

    eventos() {
        const that = this;
        $("#btn_buscar").click( ()=> {
            that.buscar();
        })
    }

    buscar() {
        const that = this;
        const data_inicial = $("#data_inicial").val();
        const data_final = $("#data_final").val();
        const tipo_lancamento = $("#tipo_lancamento").val();
        const obj = {
            'data_inicial': data_inicial,
            'data_final': data_final,
            'tipo_lancamento': tipo_lancamento
        };
        const $ajax = custom.ajaxAsync(obj, 'getRelatorios', 'x-relatorios/col_relatorios.php');
        $ajax.always(function(data, status) {
            if(status == 'success') {
                that.renderizarRelatorios(data);
            } else {
                custom.informe('Erro ao buscar relatórios: ' + data.responseText);
            }
        });
    }

    renderizarRelatorios(data) {
        const datafields = [
            { name: 'lanc_id'        , type: 'number' },
            { name: 'lanc_dt_emissao', type: 'date'    , format: 'yyyy-MM-dd'},
            { name: 'lanc_tipo'      , type: 'string' },
            { name: 'grupo_nome'     , type: 'string' },
            { name: 'conta_nome'     , type: 'string' },
            { name: 'lanc_valor'     , type: 'number' },
            { name: 'lanc_descricao' , type: 'string' }
        ];

        const $grid = $("#div_lancamentos");
        $grid.jqxGrid('clear');
        $grid.jqxGrid({
            width: '100%',
            height: '100%',
            columnsresize: true,  // Habilitar redimensionamento de colunas
            sortable: true,       // Habilitar ordenação
            source: new $.jqx.dataAdapter({ localdata: data, datafields: datafields }),
            columns: [
                { text: 'ID'          , datafield: 'lanc_id'        , align: 'center', cellsalign:'right' , width: '10%' },
                { text: 'Emissão'     , datafield: 'lanc_dt_emissao', align: 'center', cellsalign:'center', width: '10%'  , cellsformat: 'dd/MM/yyyy' },
                { text: 'Tipo'        , datafield: 'lanc_tipo'      , align: 'center', cellsalign:'center', width: '10%' },
                { text: 'Grupo'       , datafield: 'grupo_nome'     , align: 'center', cellsalign:'left'  , width: '10%' },
                { text: 'Conta'       , datafield: 'conta_nome'     , align: 'center', cellsalign:'left'  , width: '20%' },
                { text: 'Descricao'   , datafield: 'lanc_descricao' , align: 'center', cellsalign:'left'  , width: '20%' },
                { text: 'Valor'       , datafield: 'lanc_valor'     , align: 'center', cellsalign:'right' , width: '20%', cellsformat: 'f2' }
            ]
        });
        $grid.jqxGrid('localizestrings', custom.localizestrings);
        $grid.jqxGrid('refresh');
    }


}

var relatorios = new Relatorios();