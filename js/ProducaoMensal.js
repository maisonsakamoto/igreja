/******************************************************************************* 
 * Marcio L. Oliveira - 18/11/2014 Produção Mensal
 * Maison K. Sakamoto - 20/11/2014 - evento somarProducao gerar relatório
/*******************************************************************************/

pro = {};

pro.start = function(){
    this.eventos();
};

pro.eventos = function(){    
    $( '#sProducao' ).button().click(function(){ pro.somarProducao(); });
    $( '#dataInicial' ).datepicker().datepicker('setDate',new Date().addDays(-30)); 
    $( '#dataFinal' ).datepicker().datepicker('setDate',new Date().addDays()); 
    $('#iResumo').button().click(function(){ pro.imprimirCli(); });
    $('#iConhecimento').button().click(function(){ pro.imprimirCon(); });
};

pro.somarProducao = function(){
    var obj = new Object();
    obj.data_ini = custom.convertDatePortuguestoSql( $( '#dataInicial' ).val() );
    obj.data_fim = custom.convertDatePortuguestoSql( $( '#dataFinal' ).val() );
    var r = custom.ajax( obj, 'getProducao' , '../view/Financeiro/VProducaoMensal.php' );    
    var movimentacao = custom.ajax( obj, 'getMovimentacao' , '../view/Financeiro/VProducaoMensal.php' );
    pro.preencherTela(r, movimentacao);
};

pro.preencherTela = function(array, movimentacao){
    var totalPesoInterno = 0;
    var totalValorDolar = 0;
    
    for (var i=0; i < array.length; i++){
        var obj = array[i];
        obj.uni_id == 1 && obj.operacao == 'EXPORTACAO' ? $('#tFIReal').text(obj.valor_frete_real)   : false;
        obj.uni_id == 1 && obj.operacao == 'EXPORTACAO' ? $('#tFIDolar').text(obj.valor_frete_dolar) : false;
        obj.uni_id == 1 && obj.operacao == 'EXPORTACAO' ? $('#tFIPeso').text(custom.convertNumero(obj.peso_producao))      : false;
        obj.uni_id == 1 && obj.operacao == 'INTERNO'    ? $('#tFIInter').text(obj.valor_frete_real)  : false;
        
        obj.uni_id == 2 && obj.operacao == 'EXPORTACAO' ? $('#tPAReal').text(obj.valor_frete_real)   : false;
        obj.uni_id == 2 && obj.operacao == 'EXPORTACAO' ? $('#tPADolar').text(obj.valor_frete_dolar) : false;
        obj.uni_id == 2 && obj.operacao == 'EXPORTACAO' ? $('#tPAPeso').text(custom.convertNumero(obj.peso_producao))      : false;
        obj.uni_id == 2 && obj.operacao == 'INTERNO'    ? $('#tPAInter').text(obj.valor_frete_real)  : false;
        
        obj.uni_id == 3 && obj.operacao == 'EXPORTACAO' ? $('#tCReal').text(obj.valor_frete_real)    : false;
        obj.uni_id == 3 && obj.operacao == 'EXPORTACAO' ? $('#tCDolar').text(obj.valor_frete_dolar)  : false;
        obj.uni_id == 3 && obj.operacao == 'EXPORTACAO' ? $('#tCPeso').text(custom.convertNumero(obj.peso_producao))       : false;
        obj.uni_id == 3 && obj.operacao == 'INTERNO'    ? $('#tCInter').text(obj.valor_frete_real)   : false;
        
        obj.uni_id == 4 && obj.operacao == 'EXPORTACAO' ? $('#tSPReal').text(obj.valor_frete_real)   : false;
        obj.uni_id == 4 && obj.operacao == 'EXPORTACAO' ? $('#tSPDolar').text(obj.valor_frete_dolar) : false;
        obj.uni_id == 4 && obj.operacao == 'EXPORTACAO' ? $('#tSPPeso').text(custom.convertNumero(obj.peso_producao))      : false;
        obj.uni_id == 4 && obj.operacao == 'INTERNO'    ? $('#tSPInter').text(obj.valor_frete_real)  : false;
        
        obj.operacao=='IMPORTACAO' ? $('#tImReal').text(obj.valor_frete_real) :false;
        obj.operacao=='IMPORTACAO' ? $('#tImPeso').text(custom.convertNumero(obj.peso_producao)) :false;
        totalPesoInterno += obj.operacao=='INTERNO' ? parseFloat(obj.peso_producao) : false;
        //totalValorDolar += obj.operacao=='IMPORTACAO' ? parseFloat((obj.valor_frete_dolar)) : false;
        totalValorDolar += obj.operacao=='IMPORTACAO' ? custom.convertFloatNumber(obj.valor_frete_dolar ): false;
    }
    
    for(var i=0; i < movimentacao.length; i++){
        var objMov = movimentacao[i];
        objMov.TIPO == 'NACIONAL'   ?  $('#tdTInterno').text(objMov.FRETE)  : 0;
        objMov.TIPO == 'EXPORTACAO'   ? $('#tdTExportacao').text(objMov.FRETE) : 0;
        objMov.TIPO == 'IMPORTACAO'   ? $('#tdImpotacao').text(objMov.FRETE)  : 0;           
    }
       
        var gInter = custom.convertFloatNumber($('#tFIInter').text())+ ( custom.convertFloatNumber($('#tPAInter').text()))+(custom.convertFloatNumber($('#tCInter').text()))+(custom.convertFloatNumber($('#tSPInter').text()));
        var tReal = custom.convertFloatNumber($('#tFIReal').text())+ ( custom.convertFloatNumber($('#tPAReal').text()))+(custom.convertFloatNumber($('#tCReal').text()))+(custom.convertFloatNumber($('#tSPReal').text()));
        var tPeso = parseInt(custom.removeMascara($('#tFIPeso').text()))+ (parseInt(custom.removeMascara($('#tPAPeso').text())))+(parseInt(custom.removeMascara($('#tCPeso').text())))+(parseInt(custom.removeMascara($('#tSPPeso').text())));
        var tDolar = custom.convertFloatNumber($('#tFIDolar').text())+ ( custom.convertFloatNumber($('#tPADolar').text()))+(custom.convertFloatNumber($('#tCDolar').text()))+(custom.convertFloatNumber($('#tSPDolar').text()));
        var tImpR = custom.convertFloatNumber($('#tImReal').text());
        
        var tGeral = gInter+tReal+tImpR;
        gInter = gInter.toFixed(2);
        tReal = tReal.toFixed(2);
        tPeso = custom.convertNumero(tPeso);        
        tDolar = tDolar.toFixed(2);
        tGeral = tGeral.toFixed(2);
        var tGeralD = parseFloat(tDolar)+(parseFloat(totalValorDolar));
        tGeralD = tGeralD.toFixed(2);
        
        tReal = custom.convertFloatToMoeda(tReal);
        gInter = custom.convertFloatToMoeda(gInter);
        tDolar = custom.convertFloatToMoeda(tDolar);
        tGeral = custom.convertFloatToMoeda(tGeral);
        totalValorDolar = custom.convertFloatToMoeda(totalValorDolar);
        tGeralD = custom.convertFloatToMoeda(tGeralD);
        
        $('#tGReal').text(tReal);
        $('#tGInter').text(gInter) ;
        $('#tGPeso').text(tPeso);
        $('#tGDolar').text(tDolar);
        $('#tEReal').text(tReal);
        $('#tIReal').text(gInter);
        $('#tGeReal').text(tGeral);
        $('#tEPeso').text(tPeso);
        $('#tIPeso').text(custom.convertNumero(totalPesoInterno)); 

        var teste = custom.convertNumero(((parseInt(custom.removeMascara($('#tEPeso').text())))+(parseInt(custom.removeMascara($('#tImPeso').text()))))+(parseInt(custom.removeMascara($('#tIPeso').text()))));
        $('#tGePeso').text(teste);

        $('#iTExpor').val(tDolar);
        $('#iTImpo').val(totalValorDolar);
        $('#iTGeral').val(tGeralD);
        $('#producao').text(tGeral);                    

        objMov.TOTAL==null ? $('#sAnterior').text('0,00') : $('#sAnterior').text(objMov.TOTAL);
        objMov.BAIXADAS_COB==null ? $('#cBaixa').text('0,00') : $('#cBaixa').text(objMov.BAIXADAS_COB);
        objMov.BAIXADAS_CON==null ? $('#bConhecimento').text('0,00') : $('#bConhecimento').text(objMov.BAIXADAS_CON);
       
        var tdImpor = custom.convertFloatNumber($('#tdImpotacao').text());
        var tdExpor = custom.convertFloatNumber($('#tdTExportacao').text());
        var tdInter = custom.convertFloatNumber($('#tdTInterno').text());

        var tdGeralCob = tdExpor+tdImpor+tdInter;      

        tdGeralCob = tdGeralCob.toFixed(2);
        tdGeralCob = custom.convertFloatToMoeda(tdGeralCob);

        $('#tdTGeral').text(tdGeralCob);
        $('#sCobranca').text(objMov.SALDO_ANTERIOR);
      
};

pro.imprimirCli= function(){
    var obj1 = new Object();        
        var dataIni = custom.convertDatePortuguestoSql( $('#dataFinal').val() );
       var dataLabel = $('#dataFinal').val();
               
        obj1.parametros = new Array({"dataLabel":dataLabel , "pDATA" : dataIni});
        obj1.ireport = "/reports/samples/relCobPenCliente";
  
        var arqImp = "../relatorios/imprimir.php";
        $.ajax({type: "POST",url: arqImp, dataType:"json",
            data: { 'obj' : obj1 , 'funcao' : 'registrar'},                      //REGISTRAR O OBJ EM SESSÃO PHP
            success: function(json){
                if(json.info == 'ok'){ 
                    custom.informe("impressão gerada com sucesso!");             //CHAMAR O ARQUIVO EM NOVA PAGINA PARA IMPRESSAO
                    window.open(arqImp);
                }
                else{ custon.informe("falha ao inserir!"); }                
            },error: function(json){ custom.informe("erro ao imprimir"); console.debug(json) }
        });
};

pro.imprimirCon= function(){
    var obj1 = new Object();        
        var dataIni = custom.convertDatePortuguestoSql( $('#dataFinal').val() );
        var dataLabel = $('#dataFinal').val();
               
        obj1.parametros = new Array({"dataLabel":dataLabel , "pDATA" : dataIni});
        obj1.ireport = "/reports/samples/relCobPenCon";
  
        var arqImp = "../relatorios/imprimir.php";
        $.ajax({type: "POST",url: arqImp, dataType:"json",
            data: { 'obj' : obj1 , 'funcao' : 'registrar'},                      //REGISTRAR O OBJ EM SESSÃO PHP
            success: function(json){
                if(json.info == 'ok'){ 
                    custom.informe("impressão gerada com sucesso!");             //CHAMAR O ARQUIVO EM NOVA PAGINA PARA IMPRESSAO
                    window.open(arqImp);
                }
                else{ custon.informe("falha ao inserir!"); }                
            },error: function(json){ custom.informe("erro ao imprimir"); console.debug(json) }
        });
};

pro.start();