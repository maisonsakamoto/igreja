    
    //variavel global lancTipo usado para saber se o lancamento é debito ou credito
    lancTipo = "c"; //padrao é credito
    item = 0;    
    var arraySalvar = [];
    var headers = [];
    
    var outros = {};
    
    function start(){
        $("input[type=radio]").change(function(){lancTipo = $(this).attr("id");});
        var date = new Date();
        $("#datalancamento").val(datePortugues(date));
        $('#datalancamento').focus();
        
        $("#datepicker" ).datepicker({altField: "#datalancamento"});
       
        $("#update").click(function(){atualizar();});
        $("#adicionar").click(function(){adicionar();});
        $('#btVoltar').button().click(function(){ zoomOut(); });        
        
        $('#adicionar').focus( function() { $(this).css('background','#DDDDDD');});
        $('#adicionar').blur( function() { $( this).css('background','url("../css/images/ui-bg_highlight-hard_100_eeeeee_1x100.png") repeat-x scroll 50% 50% #EEEEEE'); });
        $('#adicionar').mouseover(function(){ $(this).css('background','#DDDDDD'); });
        $('#adicionar').mouseout(function(){ $(this).css('background','url("../css/images/ui-bg_highlight-hard_100_eeeeee_1x100.png") repeat-x scroll 50% 50% #EEEEEE');  });        
        
        $('input:text').setMask();
        
        setTimeout(function(){$("#valor").focus()},200);
        setTimeout(function(){ zoomIn(); },300);
    } 
    
    function zoomIn(){
        $("#grid2").zoomTo({targetsize:1.0});        
        setTimeout(function(){ $("body").css('overflow', 'hidden'); },500);
        $('#bMenuOpcoes').css('display','none');
    }
    
    function zoomOut(){
        $("body").css('overflow', 'auto');
        $('#bMenuOpcoes').css('display','block');
        $('#grid2').html('');
        setTimeout(function(){ $("body").zoomTo({targetsize:1.0}); },300);                        
    }
    
    function adicionar(){
        item++;               
        var obj = new Object();
        obj.data = $("#datalancamento").val();
        obj.valor = $("#valor").val();
        /*obj.valor = obj.valor.replaceAll(',', '.');*/
        obj.historico = $("#historico").val();
        obj.lancTipo = lancTipo;
        obj.conta_id = $("#conta_id").val();
        var linha="<tr id='linha"+item+"'>"+
                        "<td id='item"+item+"Data' style='text-align: center; width:100px'>"+obj.data+"</td>"+
                        "<td id='item"+item+"Historico' style='text-align: left; width:130px'>"+obj.historico+"</td>"+
                        "<td id='item"+item+"LancTipo' style='text-align: center; width:100px'>"+obj.lancTipo+"</td>"+
                        "<td id='item"+item+"Valor' style='padding-left:20px; text-align: right; '>"+obj.valor+"</td>"+
                        "<td id='x' onclick=\"outros.remove("+item+");\" style='float: right; margin-right:28px; cursor:pointer;'>X</td>"+
                    "</tr>"
        $("#tab_lanc01 > tbody").append(linha);
        $('#valor').focus(); 
        calculaTotais(); // CALCULA CREDITO E DEBITO1
    }
    
    function calculaTotais(){
        var credito=0, debito=0;
        var array = getArraySalvar();
        for(var i=0; i <array.length; i++){
            var obj = array[i];            
            var tipo  =  obj.Credito_Debito;
            var valor = convertFloatNumber( obj.Valor );
            tipo =='c' ? credito += valor : debito += valor;   
        }
        $('#totalCredito').val( convertFloatToMoeda(credito.toFixed(2) ) );
        $('#totalDebito').val( convertFloatToMoeda(debito.toFixed(2) ) );
    }
    
    outros.remove = function(id){ 
        $("tr#linha"+id).remove();
        calculaTotais();
    };
    
    function getArraySalvar(){
        arraySalvar = new Array();
        $('#tab_lanc th').each(function(index, item) {
            headers[index] = $(item).html();
        });
        $('#tab_lanc01 tr').has('td').each(function() {
            var arrayItem = {};
            $('td', $(this)).each(function(index, item) {
                arrayItem[headers[index]] = $(item).html();
            });
            arraySalvar.push(arrayItem);
        });
        return arraySalvar;
    }
    
    function atualizar(){
        var b = validar();        
        if(b == true){
            var array = getArraySalvar();            
            var conta_id = $("#conta_id").val();
            $.ajax({
                type: "POST",
                url: "../view/vBancosOutrosLancamentos.php",
                dataType:"json",
                data: {'obj': array, 'funcao' : 'alterar', 'conta_id' : conta_id},
                success: function(json){                
                    //loadContent('#conteudo','bancos/bancosmenu.php');
                    $('.outroslancamentos').click();
                },
                error: function(json){console.error(json)}
            });
        }
        else{
            alert('preencha o campo Historico e o valor do lancamento')
        }        
    }
    
    function validar(){
        var b = false;
        
        if( $("#valor").val() != '0,00' && $('#historico').val() != ''){
            b = true;
        }
        return b;        
    }
    
    function datePortugues(date){
        var dia = date.getDate();
        var mes = date.getMonth("MM") + 1; //months are zero based
        var ano = date.getFullYear();
        dia <= 9 ? dia="0"+dia : dia=dia;
        mes <= 9 ? mes="0"+mes : mes=mes;
        return dia + "/" + mes + "/" + ano;
    } 
    
   
                   
   
    
    start();