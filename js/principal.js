/**
 * @author: Maison K. Sakamoto - 16/09/2024
 * Principal - Classe principal do sistema, funções primarias para inicialização do sistema e funções comuns para qualquer módulo
 */
/// <reference path="reference.js" />

var Principal = class Principal {
    altura_pagina = $(window).height() - 150;
    constructor() {
        this.abrirMenu();
        this.abrirPagina('home.php');
        setTimeout(() => {

        }, 300);
    }

    /**
     * Carrega o menu do sistema
     */
    abrirMenu(){
        $("#menu").load("menu/Menu.php");
    }

    /**
     * Carrega a pagina do sistema
     * @param {*} url
     */
    abrirPagina(url){
        var that = this;
        $('#pagina').slideUp("fast",function(){ // Efeito de sobe da pagina
            $('#pagina').load(url, function(){  // Carrega pagina
                that.ajustarAlturaPagina();     // Ajusta a altura da pagina
                $('#pagina').slideDown("fast"); // Efeito de desce da pagina
            });
        });

        $(".open").removeClass('open'); // Fecha o menu
    }

    /**
     * Carrega o arquivo plano_contas.js com artifício para desativar o cache no navegador
     * @param {*} patchArquivo caminho+nome do arquivo
     */
    carregarArquivo(patchArquivo) {
        var nocache = new Date().getTime();
        var extensao = patchArquivo.split('.').pop().toLowerCase();

        if (extensao === 'js') {
            var scriptElement = document.createElement('script');
            scriptElement.src = patchArquivo + '?v=' + nocache;
            document.body.appendChild(scriptElement);
        } else if (extensao === 'css') {
            var linkElement = document.createElement('link');
            linkElement.rel = 'stylesheet';
            linkElement.href = patchArquivo + '?v=' + nocache;
            document.head.appendChild(linkElement);
        }
    }

    /**
     * Ajusta a altura da pagina
     */
    ajustarAlturaPagina(){
        $("#pagina").css('height', this.altura_pagina);
    }
}

var principal = new Principal();
