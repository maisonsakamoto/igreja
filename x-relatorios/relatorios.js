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
            { name: 'data_inicial', type: 'string' },
            { name: 'data_final', type: 'string' },
            { name: 'tipo_lancamento', type: 'string' },
            { name: 'lancamentos', type: 'string' }
        ];

        const $grid = $("#div_lancamentos");
        $grid.jqxGrid('clear');
        $grid.jqxGrid({
            width: '100%',
            height: '100%',
            source: new $.jqx.dataAdapter({ localdata: data, datafields: datafields }),
            columns: [
                { text: 'Data Inicial', datafield: 'data_inicial', width: '10%' },
                { text: 'Data Final', datafield: 'data_final', width: '10%' },
                { text: 'Tipo Lancamento', datafield: 'tipo_lancamento', width: '10%' },
                { text: 'Lancamentos', datafield: 'lancamentos', width: '70%' }
            ]
        });
        $grid.jqxGrid('localizestrings', custom.localizestrings);
        $grid.jqxGrid('refresh');
    }


}

var relatorios = new Relatorios();