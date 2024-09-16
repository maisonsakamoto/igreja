
<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <title>IGREJA BATISTA</title>
        <meta charset="UTF-8"/>
        <style>
            @import url("css/menuBarra.css");
            @import url("css/ui-lightness/jquery-ui-1.8.17.custom.css");
            @import url("js/jqwidgets-ver3.4.0/styles/jqx.base.css");
            @import url("css/ripple.css?v=3");
        </style>
        <link href="imagens/ibr_logo.ico" rel='icon' />
        <script src="js/plugin/LAB.min.js" type="text/javascript"></script> <!-- PARA CARREGAR ARQUIVOS JS EM ORDEM E DE FORMA ASSINCRONA -->
    </head>

    <body>
        <div class="row">
            <div class="col s8 offset-s2">
                <div class="row">
                    <div class="col s12">
                        <div class="card">
                            <div id="menu"></div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col s12">
                        <div class="card">
                            <div id="pagina"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>
    <script>
        $LAB
            .script('js/js/jquery-1.7.1.min.js').wait()
            .script('js/js/jquery-ui-1.8.17.custom.min.js').wait()
            .script('js/custom_jquery.js').wait()                                   // PARA FORMATAÇOES CONVERCÓES ETC. API DA BTR
            .script('js/js/date.js').wait()                                         // PARA FAZER O NEW Date().asString()
            .script('js/js/dataBr.js').wait()                                       // PARA FAZER O CALENDARIO EM PT-BR
            .script('js/jquery-meiomask.js').wait()
            .script('js/jqwidgets-ver3.4.0/jqwidgets/jqxcore.js').wait()
            .script('js/jqwidgets-ver3.4.0/jqwidgets/jqxgrid.js').wait()
            .script('js/jqwidgets-ver3.4.0/jqwidgets/jqxdata.js').wait()
            .script('js/jqwidgets-ver3.4.0/jqwidgets/jqxscrollbar.js').wait()
            .script('js/jqwidgets-ver3.4.0/jqwidgets/jqxbuttons.js').wait()
            .script('js/jqwidgets-ver3.4.0/jqwidgets/jqxgrid.selection.js').wait()
            .script('js/jqwidgets-ver3.4.0/jqwidgets/jqxgrid.filter.js').wait()
            .script('x_controle_botoes.js?nocache=1.1').wait()
            .script('js/principal.js').wait()
    </script>
</html>