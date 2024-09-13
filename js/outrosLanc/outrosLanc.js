 var tf = {};
        
        tf.start=function(){
            tf.eventos(); // EXECUTA A FUNCAO EVENTOS, CONFIGURA OQUE OS CLIQUES IRÁ FAZER
        };
        
        tf.eventos=function(){            
            datepickerBR(); // CONFIGURA O CALENDDARIO PARA PADRAO PT-BR, PATH NA PAGINA INDEX.PHP            
            var d = new Date();
            $("#datepicker").datepicker(); // CRIA O CALENDARIO DO JQUERY
            $("#datepicker02").datepicker(); // CRIA O CALENDARIO DO JQUERY
            $("#datepicker").val( '01/'+d.asString().substring(3,10) ); // SET DATA INICIAL NO LOAD DA PAGINA  PRIMEIRO DIA DO MES
            $("#datepicker02").val(new Date().asString()); // SET DATA INICIAL NO load DA PAGINA        
            $('#botaotf').click(function(){ tf.popUp(); });
            $("#ui-datepicker-div").click(function(){   // EVENDO CLICK NO CALENDARIO JQUERY
                var date = $( "#datepicker" ).val();    // PEGA O VALOR DA INPUT DO CALENDARIO
                var date1 = $( "#datepicker02" ).val();    // PEGA O VALOR DA INPUT DO CALENDARIO
                tf.dataInicial = custom.convertDatePortuguestoSql(date); // VARIAVEL GLOBAL PODERA SER CHAMADA POSTERIORMENTE
                tf.dataFinal = custom.convertDatePortuguestoSql(date1); // VARIAVEL GLOBAL PODERA SER CHAMADA POSTERIORMENTE
                console.info(tf.dataInicial+tf.dataFinal);        // LOG            
                console.log('tf.eventos()');
            }); 
            
            $('#botaogrid').click(function(){ tf.verLancamentos(); });
            $("#ui-datepicker-div").click(); // DISPARA O EVENTO CLICK, SIMULA O CLICK DO USUARIO             
            tf.inclusao();
        };

        tf.grid=function(p){
            $('#botaogrid').click(function(){      
                var p = 1;    // PEGA O VALOR DA INPUT DO CALENDARIO
                //console.info(p);
                $('#grid').load("outros_lanc_grid.php?p="+p);
            });
        };

        tf.popUp=function(parametro){
             //var p = $("#numero").val();
             var parametro = "outros_lanc_inclusao.php";

             var $tela = $("<div id='popUp' title='&nbsp;&nbsp;&nbsp;&nbsp;INCLUSÃO OUTROS LANÇAMENTOS'>")
                 .load(parametro,function(){                     
                     $tela.find("#retorno").click(function(){ $tela.remove(); });
                 }).dialog({ height: 550, width:730, modal: true,
                     show: { effect: "scale", duration: 300 },
                     hide: { effect: "scale", duration: 700 },
                     ready: function(e){},
                     close: function(){ $tela.remove(); }
                     //,     
                     // buttons:{ Sair:function(){ $tela.hide('scale',function(){ $tela.remove(); }); } }
                 });
             $('.ui-dialog .ui-dialog-buttonpane button')
                 .css('height','30px')
                 .css('color','black')
                 .css('font-size','11px')
                 .css('font-family','verdana')
                 .css('background','#B5B5B5')
                 .css('width','100px');   

             $('.ui-dialog .ui-dialog-titlebar')
                 //.css('height','20px')
                 .css('color','white')
                 .css('font-size','11px')
                 .css('font-family','verdana')
                 .css('background','#EE4000')
                 //.css('width','100px');       
            $('.ui-widget-content').css('background','white').css('font','10pt verdana').css('border','none');
         };
         
         tf.setObjeto=function(){
            var date = $( "#datepicker" ).val();    // PEGA O VALOR DA INPUT DO CALENDARIO
            var date1 = $( "#datepicker02" ).val();
            var moeda =  $('input[type=radio]:checked').val();
            var dataInicial = custom.convertDatePortuguestoSql(date); // VARIAVEL GLOBAL PODERA SER CHAMADA POSTERIORMENTE
            var dataFinal = custom.convertDatePortuguestoSql(date1);
            var obj =  new Object({ dataInicial:dataInicial, dataFinal: dataFinal, moedagrid: moeda });
            return obj;
         };
         
         tf.verLancamentos=function(){ 
            $("#grid-totais").empty();   ///   apagar tela quando iniciar
            var param = tf.setObjeto();
            //Comentario: custom.ajax(obj,funcao,url_destino); // obj=parametros, funcao=call_user_function(), url='../outros_lancamentos/outros_lanc_grid.php'
            var array_retorno = custom.ajax(param,'getTotais','../outros_lancamentos/outros_lanc_grid.php'); // FAZ A CONSULTA NA BASE
            
            //var obj=json_totais[totalmoedac];
            //$ttdolarentradas = $('<td>').text(obj.totalmoedac);
            //$table.append($ttdolarentradas);
            var cambio = array_retorno[0];
            var saida = array_retorno[1];
            var entrada = array_retorno[2];
                       
            
            
            var $table = $('<table>');
            var $tr = $('<tr>').addClass('resumo_outrosLanc_js');
            //var $trfim = $('</tr>');
            
            var $espaco = $('<td style="width: 80px; background: white;">').text('');  
            var $tt = $('<td style="width: 170px; text-align:left;padding-left: 10px;">').text('');
            var $td1 = $('<td style="width: 120px; text-align:center;">').text(entrada.moedagrid);
            var $td2 = $('<td style="width: 120px; text-align:center;">').text('TOTAL REAL');
            $tr.append($espaco);
            $tr.append($tt);
            $tr.append($td1);
            $tr.append($td2);
            $table.append($tr); 
            
            var $tr = $('<tr>').addClass('resumo_outrosLanc_js');
            $table.append($tr); 
            //$table.append($trfim); 
            
            var $espaco = $('<td style="width: 80px; background: white;">').text('');  
            var $tt = $('<td style="width: 170px; text-align:left;padding-left: 10px;">').text('TOTAL CAMBIOS');                        
            var $td_valor_moeda = $('<td style="width: 120px; text-align:right; padding-right: 10px;">').text(cambio.totalmoeda);
            var $td_valor_real  = $('<td style="width: 120px; text-align:right; padding-right: 10px;">').text(cambio.totalreal);
            
            $tr.append($espaco);
            $tr.append($tt);
            $tr.append($td_valor_moeda).append($td_valor_real)
            $table.append($tr);
            
             
            var $tr = $('<tr>').addClass('resumo_outrosLanc_js');
            $table.append($tr); 
            
            var $espaco = $('<td style="width: 80px; background: white;">').text('');  
            var $tt = $('<td style="width: 170px; text-align:left;padding-left: 10px;">').text('TOTAL SAÍDAS');                        
            var $td_valor_moeda = $('<td style="width: 120px; text-align:right; padding-right: 10px;">').text(saida.totalmoeda);
            var $td_valor_real  = $('<td style="width: 120px; text-align:right; padding-right: 10px;">').text(saida.totalreal);
            
            $tr.append($espaco);
            $tr.append($tt);
            $tr.append($td_valor_moeda).append($td_valor_real)
            $table.append($tr);
             

            var $tr = $('<tr>').addClass('resumo_outrosLanc_js');
            $table.append($tr); 
            
            var $espaco = $('<td style="width: 80px; background: white;">').text('');  
            var $tt = $('<td style="width: 170px; text-align:left;padding-left: 10px;">').text('TOTAL ENTRADAS');                        
            var $td_valor_moeda = $('<td style="width: 120px; text-align:right; padding-right: 10px;">').text(entrada.totalmoeda);
            var $td_valor_real  = $('<td style="width: 120px; text-align:right; padding-right: 10px;">').text(entrada.totalreal);
            //var $tablefim = $('</table>');
            
            $tr.append($espaco);
            $tr.append($tt);
            $tr.append($td_valor_moeda).append($td_valor_real)
            $table.append($tr);
            //$table.append($tablefim);
            
            var $table1 = $('<table>');
            var $tr5 = $('<tr>').addClass('resumo_outrosLanc_js1');
            $table1.append($tr5); 
            var $espaco5 = $('<td style="width: 604px; background: #DCDCDC; height: 2px;">').text('');
            $tr5.append($espaco5);
            $table1.append($tr5);          
            
            $("#grid-totais").append($table).append($table1);
            
            
            var json = custom.ajax(param,'getLancamentos','../outros_lancamentos/outros_lanc_grid.php'); // FAZ A CONSULTA NA BASE
            var dataAdapter = new $.jqx.dataAdapter({ localdata: json, datatype: "array"}); //ADAPTADOR PARA O PLUGIN JQXGRID
            $("#grid-lancamento").jqxGrid({ height: 742, width: '608px', source: dataAdapter, columnsresize: true, 
                sortable: true, editable: false, selectionmode: 'row', 
                columns: [                               
                  { text: 'EMISSAO',  datafield: 'out_emissao',     align: 'center', cellsalign: 'center',  width: '90' , cellclassname: 'gridFonte' },
                  { text: 'PAGADOR',  dataField: 'out_historico',   align: 'center', cellsalign: 'left',    width: '180', cellclassname: 'gridFonte' },
                  //{ text: 'MOEDA',    dataField: 'out_moeda',       align: 'center', cellsalign: 'center',  width: '50' , cellclassname: 'gridFonte' },
                  { text: 'VALOR',    dataField: 'out_valor_moeda', align: 'center', cellsalign: 'right',   width: '100', cellclassname: 'gridFonte' },
                  { text: 'VALOR R$', dataField: 'out_valor_real',  align: 'center', cellsalign: 'right',   width: '100', cellclassname: 'gridFonte' },
                  { text: 'TIPO',     datafield: 'out_tipo',        align: 'center', cellsalign: 'center',  width: '60' , cellclassname: 'gridFonte'},
                  { text: 'FLUXO',    datafield: 'out_fluxo',       align: 'center', cellsalign: 'center',  width: '50' , cellclassname: 'gridFonte'},
                  //{ text: 'LANC',     datafield: 'out_lancamento',  align: 'center', cellsalign: 'center', width: '60' , cellclassname: 'gridFonte'}
                ]
            });
            
        };
         
        tf.inclusao=function(){
            $("#calendario" ).datepicker({
                onSelect: function(dateText, inst) { 
                   var dateAsString = dateText; //the first parameter of this function
                   var date = $(this).datepicker( 'getDate' ); //the getDate method
                   $("#valor").val(date.asString());
                }
            });
            $('.botao').mouseover(function(){
                $(this).addClass("ui-state-hover");
            });

            $('.botao').mouseout(function(){
                $(this).removeClass("ui-state-hover");
            });
            //$("fieldset").hide();
            $("#pop-up").hide();
            $("fieldset").show('blind');   
            $('#histor').focus();


            $('.radio').click(function(){               
                var id = $(this).attr("id");
                var moeda = $(this).val();

                if(moeda === 'D'){ 
                    $("#valord").prop('alt','decimal');
                    $("#th_valor").text("VALOR DOLAR");
                }
                else{
                    $("#valord").prop('alt','integer');
                    $("#th_valor").text("VALOR GUARANI");
                }
                $("#valord").setMask();

                $(".td").css("background","#FFFFFF");
                $("#td"+id).css("background","#CAE1FF");

                var nome = $("#td"+id).text();
                $("#nome").val(nome);
                $("#idFornec").val(id);

            });
            var date = new Date();
            $("#valor").val(date.asString());

           /* $("#calendario").click(function(){
                var date = new Date($( "#calendario" ).datepicker("getDate"));
                $("#valor").val(date.asString());
                console.log('clique : ' + date.asString());                    
            });*/
            $('input:text').setMask();
            
        }; 
        tf.start();
