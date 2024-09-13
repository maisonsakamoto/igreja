
    idBanco = new Number(idRadio); // variavel global
    //$( "#dialog-extrato" ).hide();
    //$.noConflict();
    
    function start(){        
        styles();
        maskaras();
        var date = new Date();
        $("#dataextrato").val(datePortugues(date));        
    }
    
    function abrirPopUp(){
        $( "#dialog-extrato" ).dialog( "open" );
        $('#dataextrato').focus();
    }

    function styles(){
        $('.finalizaextrato').mouseover(function(){ $(this).addClass("ui-state-hover"); });
        $('.finalizaextrato').mouseout(function(){ $(this).removeClass("ui-state-hover"); });        
        $('.cancelaextrato').mouseover(function(){ $(this).addClass("ui-state-hover"); });
        $('.cancelaextrato').mouseout(function(){ $(this).removeClass("ui-state-hover"); });              
        $('.finalizaextrato').click(function(){ finalizar(); });
        $('.cancelaextrato').click(function(){ $('.botaoextrato').click() });    
        $('.botaoextrato').click(function(){ extrato(); });
        $('.radio').change(function(){ calcTela(this); });
        //$( "#dialog-extrato" ).dialog({ autoOpen: false, height: 340, width: 280, modal: true});          
        $("#datepicker").datepicker( { altField: "#dataextrato" });
        $("#datepicker").click(function(){ setarDate(); });
        $('#update1').focus( function() { $(this).css('background','#DDDDDD');});
        $('#update1').blur( function() { $( this).css('background','url("../css/images/ui-bg_highlight-hard_100_eeeeee_1x100.png") repeat-x scroll 50% 50% #EEEEEE'); });
        $('#update1').mouseover(function(){ $(this).css('background','#DDDDDD'); });
        $('#update1').mouseout(function(){ $(this).css('background','url("../css/images/ui-bg_highlight-hard_100_eeeeee_1x100.png") repeat-x scroll 50% 50% #EEEEEE');  });
        $.Shortcuts.add({type: 'down',mask: 'ENTER',enableInInput: true, handler: function(){$('#update1').click();},list:'tclAtalho'});
        $.Shortcuts.start('tclAtalho');
    }    
    
    function abrirPagina(url){
        $(".aguarde").show();
        $('#grid2').slideUp("slow",
            function(){//efeito de sobe e desce o footer                        
                $('#grid2').load(url, function(){
                $('#grid2').slideDown("slow");});                        
                $(".aguarde").hide();
            }                            
        );
    }
    
    function finalizar(){
        var dataextrato = $('#dataextrato').val();
    
        var obj = new Object();
        obj.nome_banco = idBanco;
        obj.data_extrato = dataextrato;
        
        var id = new Array();
        $("input[type=checkbox]:checked").each(function(){
                id.push( $(this).attr('id') );
        });
        obj.lancamento = id;
        $.ajax({
            type: "POST",
            url: "bancos/bancosextratograva.php",
            dataType:"json",
            data: {'obj': obj},
            beforeSend: function(){},
            success: function(json){
                alert("Lançamentos Concluídos");
                //abrirPagina("bancos/bancosextratoinfo.php"); isso aqui não exite arquivo criado sem nada dentro
                $('.botaoextrato').click();
            },
            error: function(){},
            complete: function(){}
        });
    }  
    
    function extrato(){
        var saldo = $('#saldoextrato').val();
        var saldo1 = $('#extratoanterior').val();
        saldo = convertFloatNumber(saldo);
        saldo1 = convertFloatNumber(saldo1);
        var saldoconci = saldo-saldo1;  
        //$( "#dialog-extrato" ).dialog( "close" );
        $( "#dialog-extrato" ).hide();
        //$('#extratoatual').text("Extrato Atual " + saldo);

        $('#saldoconciliacao').text(convertFloatToMoeda(saldoconci.toFixed(2)));
        ttcre = convertFloatNumber($('#ttcreditos').val());
        ttdeb = convertFloatNumber($('#ttdebitos').val());
        $("#totalcreditos").empty();
        $("#totaldebitos").empty();
        $('#extratoatual').empty();
        $("#totalcreditos").append(
            "<div id='totCredi01' style='float: left; margin-left: 5px;'>CR à Compensar</div><div id='totCredi02' style='float: right; margin-right: 5px'>"+convertFloatToMoeda(ttcre.toFixed(2))+"</div>" 
        );
        $("#totaldebitos").append(
            "<div id='totDebi01' style='float: left; margin-left: 5px;'>DB à Compensar</div><div id='totDebi02' style='float: right; margin-right: 5px'>"+convertFloatToMoeda(ttdeb.toFixed(2))+"</div>"
        );
        $('#extratoatual').append(
            "<div style='float: left; margin-left: 5px;'>Extrato Atual</div><div style='float: right; margin-right: 5px'>" + convertFloatToMoeda(saldo.toFixed(2))+"</div>"
        );
        saldoconci1 = saldoconci;
    }
    
    function calcTela(id){
        var idRadio = $(id).attr("id");
            check = $(id).attr("checked");
            var v = $("#credeb"+idRadio+"").val();
            var valor = removeMaskNumber($("#valor"+idRadio).text());
            if( check == "checked"){
                $(".td"+idRadio).css("background","#CAE1FF");                    
                if(v == 'x'){
                    ttcre = ttcre - valor;
                    saldoconci1 = saldoconci1 - valor;
                }
                else{
                    ttdeb = ttdeb - valor;
                    saldoconci1 = saldoconci1 + valor;
                }
            }
            else{
                $(".td"+idRadio).css("background","#FFFFFF");    
                if(v == 'x'){
                    ttcre = ttcre + valor; 
                    saldoconci1 = saldoconci1 + valor;
                }
                else{
                    ttdeb = ttdeb + valor;     
                    saldoconci1 = saldoconci1 - valor;
                }
            }     
            $('#saldoconciliacao').text(convertFloatToMoeda(saldoconci1.toFixed(2)));            
            $("#totCredi01").text("CR à Compensar "); $("#totCredi02").text(convertFloatToMoeda(ttcre.toFixed(2)));
            $("#totDebi01").text("DB à Compensar "); $("#totDebi02").text(convertFloatToMoeda(ttdeb.toFixed(2)));
    }
        
    function setarDate(){        
        var date = new Date($( "#datepicker" ).datepicker("getDate"));
        $("#dataextrato").val(datePortugues(date));           
    }
    
    function datePortugues(date){
        var dia = date.getDate();
        var mes = date.getMonth("MM") + 1; //months are zero based
        var ano = date.getFullYear();
        dia <= 9 ? dia="0"+dia : dia=dia;
        mes <= 9 ? mes="0"+mes : mes=mes;
        return dia + "/" + mes + "/" + ano;
    }         
    
    function maskaras(){
        (function($){
            $(function(){
                $('input:text').setMask();
            });
        })(jQuery);  
    }
    
    start();