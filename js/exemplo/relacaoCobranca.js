/*
 * Maison K. Sakamoto - 03/07/2015 - CRIAÇÃO DO ARQUIVO
 * Maison K. Sakamoto - 21/08/2018 - REFATORAÇÃO DO CODIGO PARA NOVO DESIGN PARTNER, VALIDAÇÃO: soma do FRETE no array_enviarRC igual ao valor de $("#total_resumar").text()
 **/

relCobPy = {
    totalResumar:0,
    total:0,
    flag1:0,
    flag2:0,
    conFat: new Array(),
    array_enviarRC: new Array(),
    
    start:function(){
        relCobPy.eventos();
        relCobPy.buscarConhecimentos();
    },
    
    eventos: function(){
        $('button').button();
        $('#btAtualizarFreteEmDolar').button("option", "disabled", true);
        $('#btEmitirFatura').button("option", "disabled", true);
        $('#btInternoAntecipar').click(function(){ relCobPy.enviarParaAntecipados(); });
        $('#btEnviarParaRc').click(function(){ relCobPy.enviarParaRC(); });
    },
    
    buscarConhecimentos: function(){ 
        relCobPy.totalResumar=0;                                                      // REINICIAR VARIAVEIS EM CASO DE RELOAD NA TELA
        relCobPy.total = 0;           
        relCobPy.flag1 = 0;           
        relCobPy.flag2 = 0;           
        $('#total_resumar').text('0,00');
        var r1 = custom.ajax({},'getConhecimentos','../view/cobranca/vRelacaoCobranca.php');
        r1.done(relCobPy.tableStyle);         

        var r2 = custom.ajax({},'getCte','../view/cobranca/vRelacaoCobranca.php');
        r2.done(relCobPy.tableStyle2);

        var r3 = custom.ajax({},'getFaturados','../view/cobranca/vRelacaoCobranca.php');
        r3.done(relCobPy.tableStyle3);
    },
    
    tableStyle: function(json){                                               // DEFINE AS TABLES DOS CRT'S        
        $('#saldo_dolar').text('U$- '+json.totDolar+'  -  '+json.array.length+' CRTs');
        $('#total_pagos').text(json.totFrete);

        relCobPy.total += custom.convertFloatNumber( json.totFrete );
        relCobPy.flag1 = 1 ;
        relCobPy.escreverTotal(); // irá verificar se as duas consultas foram concluídas e gerar o total

        json = json.array;
        var editedRows = new Array();
        var source = { // RECEBE O JSON
            localdata: json, datatype: "array",
            updaterow: function (rowid, rowdata, commit) {                 
                var array = new Array();                                                    // USADO ARRAY PARA A FUNCAO SE TORNAR GENÉRICA
                array.push(rowdata);
                relCobPy.atualizarGrid(rowdata,array,$("#jqxGrid-conhec"));                   // ATUALIZA AS SOMAS QUE ESTAO NA TELA
                var rowindex = $("#jqxGrid-conhec").jqxGrid('getrowboundindexbyid', rowid); // ATUALIZA AS CORES DA LINHA
                editedRows.push({ index: rowindex, data: rowdata });            
                commit(true);
            }
        };                                             
        var dataAdapter = new $.jqx.dataAdapter(source);                                    // CRIA UM ADAPTER PARA O JQX
        var array = new Array();                                                            // ARRAY PARA PEGAR O NOME DAS COLUNAS DO AJAX
        if(json == null ){ for(var i=0; i<=9; i++){ array.push(''+i); } }                   // ZERA AS COLUNAS SE O AJAX VIER VAZIO
        else{ var colunas = json[0]; for(var k in colunas) { array.push(k); } }             // PREENCHE AS COLUNAS COM O NOMES 

        var cellclass = function (row, datafield, value, rowdata) {                         // COLOCA UMA CLASS NA LINHA DO GRID
            var cor = '';
            if(rowdata.ESTATOS == 'N'){ cor = 'cor-azul';  }        
            for (var i = 0; i < editedRows.length; i++) {            
                if (editedRows[i].index == row ) {  
                    if(rowdata.ESTATOS == 'N'){ cor = 'cor-azul';  }    
                    if(rowdata.CHECKBOX == 1){ cor = 'cor-vermelho'; }                                
                }               
            }
            return cor;
        };    
        $("#jqxGrid-conhec").jqxGrid({ height: 325, width: '100%', source: dataAdapter, columnsresize: true, 
            sortable: true, editable: true, selectionmode: 'singlecell', 
            columns: [             
              { text: ''+array[0],    dataField: ''+array[0],    align: 'center', cellsalign: 'center', cellclassname: cellclass, hidden: true},
              { text: ''+array[1],    dataField: ''+array[1],    align: 'center', cellsalign: 'center', cellclassname: cellclass, hidden: true},
              { text: 'CONHEC',       datafield: 'CONHEC',       align: 'center', cellsalign: 'left',   width: '110',cellclassname: cellclass, editable: false},
              { text: 'PAGADOR',      dataField: 'PAGADOR',      align: 'center', cellsalign: 'left',   width: '180',cellclassname: cellclass, editable: false},
              { text: ''+array[2],    dataField: ''+array[2],    align: 'center', cellsalign: 'center', width: '90', cellclassname: cellclass, editable: false},
              { text: ''+array[3],    dataField: ''+array[3],    align: 'center', cellsalign: 'right',  width: '70', cellclassname: cellclass, editable: false},
              { text: ''+array[4],    dataField: ''+array[4],    align: 'center', cellsalign: 'right',  width: '70', cellclassname: cellclass, editable: false},              
              { text: 'MARC.',        datafield: ''+array[6],    align: 'center', cellsalign: 'center', width: '60', cellclassname: cellclass, columntype: 'checkbox'},              
              { text: 'cli_id',       dataField: 'cli_id',       align: 'center', hidden: true},
              { text: 'limite_saldo', dataField: 'limite_saldo', align: 'center', hidden: true},
              { text: 'UNI_ID',       dataField: 'UNI_ID',       align: 'center', hidden: true},
              { text: 'ESTATOS',      dataField: 'ESTATOS',      align: 'center', hidden: true}
            ]
        });        
        $("#jqxGrid-conhec").jqxGrid('localizestrings',{emptydatastring:"Nenhum Registro localizado"});
    },
    
    tableStyle2: function(json){                                                             // DEFINE AS TABLES DOS CRT'S
        var source = { localdata: json, datatype: "array"};                                 // RECEBE O JSON
        var dataAdapter = new $.jqx.dataAdapter(source);                                    // CRIA UM ADAPTER PARA O JQX
        var array = new Array();
        if(json == null ){        
            for(var i=0; i<=9; i++){ array.push(''+i); }        
        }
        else{                
            var colunas = json[0];
            for(var k in colunas) { array.push(k); }
        }
        $("#jqxGrid-cte").jqxGrid({ height: 360, width: '100%', source: dataAdapter, columnsresize: true, sortable: false,
            columns: [             
              { text: ''+array[0],     dataField: ''+array[0],  align: 'center', cellsalign: 'center', width: '20%'},
              { text: ''+array[1],     dataField: ''+array[1],  align: 'center', cellsalign: 'center', width: '33%'},
              { text: ''+array[2],     dataField: ''+array[2],  align: 'center', cellsalign: 'center', width: '33%'},
              { text: ''+array[3],     dataField: ''+array[3],  align: 'center', cellsalign: 'center', width: '33%',hidden: true},
              { text: ''+array[4],     dataField: ''+array[4],  align: 'center', cellsalign: 'center', width: '33%',hidden: true}          
            ]
        });
        $("#jqxGrid-cte").jqxGrid('localizestrings',{emptydatastring:"Nenhum Registro localizado"});
    },
    
    tableStyle3: function (obj) {
        $('#fatura_bancaria').text(obj.totFrete);

        relCobPy.total += custom.convertFloatNumber( obj.totFrete );
        relCobPy.flag2 = 1 ;
        relCobPy.escreverTotal(); // irá verificar se as duas consultas foram concluídas e gerar o total

        relCobPy.conFat = obj.con;
        var fat = obj.fat;
        var editedRows = new Array();
        var source = { // RECEBE O JSON
            localdata: fat, datatype: "array",
            updaterow: function (rowid, rowdata, commit) {    
                var array = new Array();
                for(var i=0; i < relCobPy.conFat.length; i++){ 
                    relCobPy.conFat[i].FATURA == rowdata.FATURA ? array.push(relCobPy.conFat[i]) : '';
                }
                relCobPy.atualizarGrid(rowdata,array,$("#jqxGrid-faturado"));         // ATUALIZA AS SOMAS QUE ESTAO NA TELA
                var rowindex = $("#jqxGrid-faturado").jqxGrid('getrowboundindexbyid', rowid);// ATUALIZA AS CORES DA LINHA          
                editedRows.push({ index: rowindex, data: rowdata });            
                commit(true);
            }
        };                                             
        var dataAdapter = new $.jqx.dataAdapter(source);                            // CRIA UM ADAPTER PARA O JQX
        var array = new Array();
        if(fat == null ){ for(var i=0; i<=9; i++){ array.push(''+i); } }
        else{ var colunas = fat[0]; for(var k in colunas) { array.push(k); } }

        var cellclass = function (row, datafield, value, rowdata) {
            for (var i = 0; i < editedRows.length; i++) {
                if (editedRows[i].index == row ) {                   
                    var cor = rowdata.CHECKBOX == 1 ? 'cor-azul' : 'cor-branco';                
                    return cor;
                }                        
            }        
        };
        var initrowdetails = relCobPy.initRowDetail;
        $('#jqxGrid-faturado').jqxGrid({ height: 300, width: '100%', source: dataAdapter, columnsresize: true, 
            sortable: false, editable: true, rowdetails: true, initrowdetails: initrowdetails,
            rowdetailstemplate: { rowdetails: "<div style='margin: 10px;'></div>", rowdetailsheight: 200 },
            columns: [             
              { text: ''+array[0],     dataField: ''+array[0],  align: 'center', cellsalign: 'center',               cellclassname: cellclass, editable: false},                      
              { text: 'MARCAR',        datafield: 'CHECKBOX',  align: 'center', cellsalign: 'center', width: '11%', cellclassname: cellclass, columntype: 'checkbox' },
              { text: 'FATURADO',      datafield: 'FATURADO',  hidden: true }
            ]               
        });        
        $('#jqxGrid-faturado').jqxGrid('localizestrings',{emptydatastring:"Nenhum Registro localizado"});
    },
    
    initRowDetail: function (index, parentElement, gridElement, datarecord) {
        var grid = $($(parentElement).children()[0]);
        var arr = new Array();
        for( var i=0; i< relCobPy.conFat.length; i++){
            var obj = relCobPy.conFat[i];
            if( datarecord.FATURA == obj.FATURA ){ arr.push(obj); }
        }

        var array = new Array();
        if(arr == null ){ for(var i=0; i<=9; i++){ array.push(''+i); } }
        else{ var colunas = arr[0]; for(var k in colunas) { array.push(k); } }

        var source = { localdata: arr, datatype: "array"};
        var dataAdapter = new $.jqx.dataAdapter(source);
        $(grid).jqxGrid({
            width: 530, height: 170, source: dataAdapter, columnsresize: true,
            columns: [          
              { text: ''+array[0],     dataField: ''+array[0],  align: 'center', cellsalign: 'center', width: '12%'},
              { text: ''+array[1],     dataField: ''+array[1],  align: 'center', cellsalign: 'center', width: '11%'},
              { text: ''+array[2],     dataField: ''+array[2],  align: 'center', cellsalign: 'center', width: '14%'},
              { text: ''+array[3],     dataField: ''+array[3],  align: 'center', cellsalign: 'center', width: '17%'},
              { text: ''+array[4],     dataField: ''+array[4],  align: 'center', cellsalign: 'right',  width: '15%'},
              { text: ''+array[5],     dataField: ''+array[5],  align: 'center', cellsalign: 'right',  width: '15%'},
              { text: ''+array[6],     dataField: ''+array[6],  align: 'center', cellsalign: 'right',  width: '14%'},
              { text: ''+array[8],     dataField: ''+array[8],  align: 'center', cellsalign: 'right',  hidden: true}
            ]
        });
    },
    
    escreverTotal: function(){
        if( relCobPy.flag1 === 1 && relCobPy.flag2 === 1){
            $('#total').text( custom.convertFloatToMoeda( relCobPy.total.toFixed(2) ) );
            $('#saldo_resumar').text( custom.convertFloatToMoeda( relCobPy.total.toFixed(2) ) );        
            relCobPy.flag1 = 0;
            relCobPy.flag2 = 0;
        }
    },
    
    validarCobranca: function(json_array,array,$grid){    // json_array=array do BD, array=array da tela ( que pode conter apenas 1 elemento )
        for(var i=0; i < array.length; i++){
            try {
                var j_valor = convertFloatNumber(json_array[i].cob_valor_rs);
                var r_valor = convertFloatNumber( array[i].FRETE );
                if( j_valor !== r_valor ){                                              // CASO NAO PASSAR NA VALIDACAO ENTAO...     
                    custom.informe('CONHECIMENTO '+array[i].NUMERO+' NÃO PASSOU NA VALIDAÇÃO,<br> COBRANÇA NO MYSQL='+j_valor+'<br> COBRANÇA NO FIREBIRD='+r_valor);            
                    relCobPy.desmarcar(array[i],$grid);                
                }
                else{ // SE ESTIVER TUDO OK ENTAO
                    array[i].cli_id = json_array[i].cli_id ;             // SETA O CLI_ID NO GRID DO FIREBIRD
                    array[i].limite_saldo = json_array[i].limite_saldo ; // SETA O limite_saldo NO GRID DO FIREBIRD                
                }
            } catch (e) {
                custom.informe('CONHECIMENTO '+array[i].NUMERO+' NÃO PASSOU NA VALIDAÇÃO,<br> COBRANÇA NO MYSQL='+j_valor+'<br> COBRANÇA NO FIREBIRD='+r_valor);            
                relCobPy.desmarcar(array[i],$grid);
                return false;
            }
        }
        return true;
    },
    
    /*
    * @param {Object} rowdata - Objeto da linha MARCADA
    * @param {Array} array - A linha marcada pode ser uma fatarua com vários CRTs, ou somente 1
    * @param {jQuery} $grid - grid Elemento 
    * @returns {void}
    */
   atualizarGrid: function(rowdata,array,$grid){    
       var totalFrete = 0;
       for(var i=0; i<array.length; i++){ totalFrete += custom.convertFloatNumber( array[i].FRETE ); }

       if(rowdata.CHECKBOX == 1){         
           relCobPy.totalResumar += totalFrete;        
           // Validar se o CRT selecionado existe a sua respectiva cobranca no producao ( não paga )
           var r = custom.ajax(array,'getCobranca','../view/cobranca/vRelacaoCobranca.php');        
           r.always(function(json,status){            
               if(status === 'success'){
                   if( relCobPy.validarCobranca(json,array,$grid) ){
                       relCobPy.array_enviarRC.push(rowdata);
                       if(!relCobPy.validaLimite(json[0]) && $grid.attr('id') === 'jqxGrid-conhec'){
                           custom.informe("CRT SELECIONADO ULTRAPASSA O LIMITE DE 30 MIL");
                           relCobPy.array_enviarRC.pop();                        
                           relCobPy.desmarcar(rowdata,$grid);
                       }                    
                   };            
               }else{ 
                   custom.informe(json.responseText);                  // CASO ERRO NA CONSULTA AO BD
                   relCobPy.desmarcar(rowdata,$grid);                
               }
           });
       }
       else{        
           for(var i=0; i< relCobPy.array_enviarRC.length; i++){                              // PERCORRER O ARRAY EM BUSCA DO ELEMENTO
               var obj = relCobPy.array_enviarRC[i];                                          // PEGAR OBJETO DO ARRAY
               if('FATURA' in obj){
                   if( obj.FATURA == rowdata.FATURA ){ relCobPy.array_enviarRC.splice(i,1); } // LOCALIZAR E REMOVER O ELEMENTO ENCONTRADO                       
               }
               else if('SERIE' in obj){
                   if( obj.SERIE == rowdata.SERIE && obj.NUMERO == rowdata.NUMERO){ relCobPy.array_enviarRC.splice(i,1); }
               }
           }
           relCobPy.totalResumar -= totalFrete;
           relCobPy.validaLimite(rowdata);        
       }    
       var totalResumar = relCobPy.totalResumar.toFixed(2);
       var total = relCobPy.total;
       $('#total_resumar').text( custom.convertFloatToMoeda( totalResumar ) );
       $('#saldo_resumar').text( custom.convertFloatToMoeda( (total - totalResumar).toFixed(2) ) );
    },
    
    desmarcar:function(rowdata,$grid){
        rowdata.CHECKBOX = 0 ;                              // DESMARCAR ELEMENTO
        $grid.jqxGrid('updaterow', rowdata.uid, rowdata);   // ATUALIZAR O GRID                
        $grid.jqxGrid('unselectrow', rowdata.uid);
    },
    
    enviarParaAntecipados: function(){ // PEGAR DA LISTA CTE E ENVIAR PARA A LISTA DE ANTECIPADOS
        var index = $("#jqxGrid-cte").jqxGrid('getselectedrowindex');
        if( index == -1){                                                           // SE UM CRT DA RELAÇÃO NÃO FOI SELECIONADO
            custom.informe("SELECIONE UM CRT NA RELAÇÃO PRIMEIRO");                 // MSG DE AVISO
            return 0;                                                               // RETORNA SEM FAZER NADA
        }

        var datarow = $("#jqxGrid-cte").jqxGrid('getrowdata', index);               // PEGA OS DADOS DA LINHA
        var ajax = custom.ajax(datarow,'enviarParaAntecipado','../view/cobranca/vRelacaoCobranca.php');
        ajax.done(function(json){ if( json != false){ relCobPy.buscarConhecimentos(); } });
    },
    
    enviarParaRC: function(){
        var array = relCobPy.ajustarFaturados();
        var totalResumar = $("#total_resumar").text();
        var totalFreteArray = relCobPy.totalArrayEnviar(array);
        if( totalFreteArray !== totalResumar ){ 
            custom.informe("ERRO relCob.array_enviarRC COM VALOR DIFERENTE DE "+totalResumar); 
            return false; 
        }
        console.log("TOTAL DE FRETE NO ARRAY: " + totalFreteArray);
        console.log("TOTAL DE FRETE aRESUMAR: " + totalResumar);
        if( array.length > 0 ){                
            var r = custom.ajax(array,'enviarParaRC','../view/cobranca/vRelacaoCobranca.php');
            r.error(function(){ custom.informe('ERRO INFORME A TI'); });            
            r.done(function(json){ 
                if( json == 1 ){ custom.informe('Finalizado!'); relCobPy.buscarConhecimentos(); }
                else{ custom.informe('ERRO INFORME A TI'); }            
            });
        }
        else{ custom.informe('MARQUE AO MENOS 1 CONHECIMENTO OU FATURA PARA CONTINUAR'); }
    },
    
    totalArrayEnviar: function(array){
        var totalFrete=0;
        for (var i = 0; i < array.length; i++) {
            var obj = array[i];
            totalFrete += custom.convertFloatNumber(obj.FRETE);
        }
        return custom.convertFloatToMoeda(totalFrete.toFixed(2));
    },
    
    ajustarFaturados: function(){
        var array = relCobPy.array_enviarRC;                                          // ARRAY DOS ANTECIPADOS
        var arFaturados = relCobPy.conFat;                                            // ARRAY DOS FATURADOS
        var arrayAux = new Array();
        for(var i=0; i< array.length; i++){                                         // PERCORRER O ARRAY EM BUSCA DO ELEMENTO
            var obj = array[i];                                                     // PEGAR OBJETO DO ARRAY
            if('FATURADO' in obj){                                                  // LOCALIZAR O OBJETO QUE CONTEM A REFERENCIA 
                for( var j=0; j<arFaturados.length; j++){                           // PERCORRER O ARRAY DOS FATURADOS
                    var obj2 = arFaturados[j];                                      // PEGA UM ELEMENTO DOS FATURADOS
                    if( obj.FATURA == obj2.FATURA){                                 // VERIFICA SE É IGUAL AO QUE ESTAMOS PROCURANDO                    
                        arrayAux.push(obj2);                                        // ADICIONAR O ELEMENTO QUE CONTEM TODA A INFORMACAO DO CRT
                    }
                }
                array.splice(i,1);                                                  // REMOVER OBJETO DE REFERENCIA ( INCOMPLETO )
                i--;                                                                // VOLTAR O CONTADOR POIS FOI REMOVIDO UM ELEMENTO DO ARRAY
            }
        }
        return array.concat(arrayAux);
    },
    
    validaLimite: function(row){ // ROW É A LINHA SELECIONADA        
        var ar = relCobPy.array_enviarRC;
        var saldo_tela = 0;    
        for(var i=0; i<ar.length; i++){
            var obj = ar[i];
            for(var k in obj){ // PARA LISTAR OS ATRIBUTOS DO OBJETO
                if(k === 'cli_id'){ // LOCALIZAR OBJ QUE CONTENHAM CLIENTE (os antecipados tem, por fatura não )
                    if(obj.cli_id === row.cli_id){ // CASO O CLIENTE SEJA O MESMO QUE O ROW
                        saldo_tela += custom.convertFloatNumber(obj.FRETE); // SOMAR O SALDO EM TELA
                    }
                }
            }        
        }    
        var total = new Number(saldo_tela) + new Number(row.limite_saldo) ;    
        total = $.isNumeric(total) ? total : 0; // CASO RETORNE ALGO NAO NUMERICO ELE ZERO O RESULTADO
        $('#limite_cliente').val(row.cliente);
        $('#limite_saldo').text('COBRADO NO MES: R$ '+ custom.convertFloatToMoeda(total.toFixed(2)) );
        if( total > 30000){ return false; }
        else{ return true; } 
    }    
};

relCobPy.start();