
<script src="x_controle_botoes.js" type="text/javascript"></script>
<script src="js/jquery-meiomask.js" type="text/javascript"></script>
<style>
    .ui-widget {
        font-family:  Arial, sans-serif;
        font-size: 11px;  
        background: white;
        
    }    
    .ui-widget-header {
       /* background: url("images/ui-bg_highlight-soft_15_cc0000_1x100.png") repeat-x scroll 50% 50% #191970; */
        background: #191970;
        border: 1px solid #191970;
        color: #ffffff;
       /* width: 120px;*/
        height: 15px;
        line-height: 15px;        
    }
    
    .fieldsetnew {
        display: inline-block; 
        horizontal-align: left;
        vertical-align: top; /* Alinha os fieldsets no topo */
        height: 35px;
    }    
    .fieldsetgrupo {
        display: inline-block; 
        horizontal-align: left;
        vertical-align: top; /* Alinha os fieldsets no topo */
        height: 100px;
        width: 700px;
    } 
#new_pop-up{
    /*position: absolute;
    top: 40%;
    left: 60%;
    margin-left: -330px;
    margin-top: -80px;*/
    width: 830px;
    height: 850px;
    font-family: verdana;
    font-size: 9pt;
    background: #CDC9A5;
    background: #FFF8DC;
    /*background: blue;*/
}     
    
    #pop-up{
        /*position: absolute;
        top: 40%;
        left: 60%;
        margin-left: -330px;
        margin-top: -80px;*/
        width: 520px;
        height: 790px;
        font-family: verdana;
        font-size: 9pt;
        background: #CDC9A5;
        background: #FFF8DC;
        /*background: blue;*/
    } 
.ui-widget-header{font-family: verdana; font-size: 8pt; background: #191970; text-align: center; color: white; font-weight: bold;  }
.ui-widget-celso{font-family: arial; font-size: 8pt; background: #191970; text-align: center; color: white; font-weight: normal;  }
    .ui-dialog .ui-dialog-title{ float: none; text-align: center; }
    .titulo{font-family: verdana; font-size: 9pt; color: white; background: red; border-color: #191970; align: center;}    
    
    
   /* h1 {font: 12px verdana; height: 15px; color: #191970; text-align: left; background: bisque; padding-left: 5px;}
    h2 {font: 12px verdana; height: 15px; color: black; text-align: left; background: #b4eeb4; padding-left: 5px; width: 100px;}  /*  ALINHA ESQUERDA  */
   /* h3 {font: 12px verdana; height: 15px; color: black; text-align: center; background: #b4eeb4; padding-left: 5px; width: 100px;}  /*  ALINHA CENTRO  */    
    #bt_gravar:hover{cursor: pointer; background: #CFCFCF; color: black; }
    #bt_gravar{background: #FFFFE0; width: 140px; font: 12px verdana; height: 30px; color: black; }  
    #bt_fechar:hover{cursor: pointer; background: #CFCFCF; color: black; }
    #bt_fechar{background: #FFFFE0; width: 140px; font: 12px verdana; height: 30px; color: black; }  
    .entre_linhas{height: 6px; }
    
        .tooltip {
            position: relative;
            display: inline-block;
           
        }

        .tooltip .tooltiptext {
            visibility: hidden;
            width: 180px;
            background-color: black;
            color: #fff;
            text-align: left;
            border-radius: 5px;
            padding: 5px;
            position: absolute;
            z-index: 1;
            bottom: 125%; /* Posiciona a tooltip acima do elemento */
            left: 50%;
            margin-left: -100px;
            opacity: 0;
            transition: opacity 0.3s;
        }


        .tooltip:hover .tooltiptext {
            visibility: visible;
            opacity: 1;
        }    

</style>
<script>

    
    
</script>

<?php

$membro = $_REQUEST['nrid'];
echo "<input type='hidden' id='idnome' value='$membro'/>";
    include_once "../bd/conexao.php";   //  vai la, abre banco de dados e retorna com ele aberto
    $o = new OpenDB();
    $link = $o->server();
    $query = "select * from membresia where id_membresia=$membro";
    $dt = mysqli_query($link,$query) or die(mysqli_error($link));                  
    $style="style='background-color: #EEEED1; height: 20px; border: 1px;font-family:verdana; font-size: 10px; font-weight:normal'"; 
    echo "<table>";
    $primeiro=0;
    while ($obj= mysqli_fetch_object($dt)) {
        $membro_id=$obj->id_membresia;
        $nome_membro=$obj->nome;
        echo "<tr $style>";
           //   echo "<td>"; echo $membro; echo "</td>"; echo "<td>"; echo $nome_membro; echo "</td>";
        echo "</tr>";
        
        echo "<input type='hidden' id='nome_membro' value='$nome_membro'/>";
    }
    echo "</table>";    
    echo $membro; echo "<br>"; echo $nome_membro; ;
?>
<div id="new_pop-up" class="ui-widget-content ui-corner-all pop-up" style="display: block;">
    
    <div class="entre_linhas"> </div> <!--   */ espaço entre fieldsets -->   
    
    <div1 style="width: 675px; border: 0px; padding-left: 1; " >
        <fieldset class="fieldsetnew" style="width:100px;">
        <legend  class="ui-widget ui-widget-celso ui-corner-all"  style="width:85px;">ID Membro</legend>
        <!--<legend  class="ui-widget ui-widget-header ui-corner-all" >ID do Membro</legend>-->
        <p style="text-align: center;  "><?php echo $membro_id; ?></p>
        </fieldset>
        <fieldset  class="fieldsetnew" style="width:350px;">
            <legend  class="ui-widget ui-widget-celso ui-corner-all" style="width:130px;">Nome do Membro</legend>
            <p><?php echo $nome_membro; ?></p>
        </fieldset>           
    </div1>
 
<div11 style="width: 675px; border: 0px; padding-left: 1; " >
    <div style="height:10px;"> </div> <!--   */ espaço entre fieldsets -->
    <fieldset class="fieldsetgrupo" style="width:480px; height: 130px;">
        <legend  class="ui-widget ui-widget-header ui-corner-all" style="width:200px; margin: auto; background: red; border: 0px;">Desligamento do Membro</legend>    
        <div style="height:5px;"> </div> <!--   */ espaço entre fieldsets -->

        <fieldset class="fieldsetnew" style="width:130px; margin-right: 70px; margin-left: 30px; ">
        <legend  class="ui-widget ui-widget-celso ui-corner-all" style="width:140px;" >Data Desligamento </legend>
        <input  type="mem_uso_ibr_data_desligamento" id="mem_uso_ibr_data_desligamento" name="mem_uso_ibr_data_desligamento" alt="date" style="width: 150px;"   <!-- alt="date" coloca mascara de data, pega do jquery-meiomask.js -->
        </fieldset>   
        <fieldset  class="fieldsetnew" style="width:130px;">
            <legend  class="ui-widget ui-widget-celso ui-corner-all" style="width:60px;">Ata</legend>
            <input  type="mem_ata_desligamento" id="mem_ata_desligamento" name="mem_ata_desligamento"maxlength="15" style="width: 150px;" >  
        </fieldset>    
        <div style="height:5px;"> </div> <!--   */ espaço entre fieldsets -->
        
        <fieldset  class="fieldsetnew" style="width:398px; margin-left: 30px;">
            <legend  class="ui-widget ui-widget-celso ui-corner-all" style="width:60px;">Motivo</legend>
            <input  type="mem_motivo_desligamento" id="mem_motivo_desligamento" name="mem_motivo_desligamento"maxlength="50" style="width: 397px;" >  
        </fieldset>            
        
        
    </fieldset> 
</div11>
    <div id="pop-upCorpo" style="text-align: center;"></div>
</div>

<script type="text/javascript">
 
    
    var principal1 = {};
    var $dialog = $("#new_pop-up");
    
    principal1.start=function(){
        
      // $(document).ready(function(){
          $("*").setMask();
           //$("#nascimento").datepicker();
      // });         
        
        principal1.eventos(); // EXECUTA A FUNCAO EVENTOS, CONFIGURA OQUE OS CLIQUES IRÁ FAZER        
            $dialog.dialog({
            width: 540,
            height: 300,
            modal: true, 
            title: 'DESLIGAMENTO DE MEMBRO',
            close: function(){    // aqui é o X de fechar pop up
                //var url=("x-plano-contas/plano_membresia_info.php?nrid="+id_grupo);
                var url=("x-membresia/membresia_info.php?nrid="+id_membro);
                //var url=("x-membresia/plano_membresia.php");
                $('#itens').load(url); 
                $dialog.remove();  // REMOVE POP UP
                window.mostra_botoes();
            }
        });
    };
    principal1.eventos=function(){};  
                     
            $("#pop-upCorpo").empty();
            var id_membro = $("#idnome").val();
            var membro = $("#nome_membro").val();
            
            var classes= "ui-button ui-widget ui-state-default ui-corner-all ui-button-text-only";
            var $bt_gravar = $('<button>');
            $bt_gravar.addClass(classes);
            $bt_gravar.attr('id','bt_gravar');
            $bt_gravar.text('Gravar'); 
            
            var $bt_fechar = $('<button>');
            $bt_fechar.addClass(classes);
            $bt_fechar.attr('id','bt_fechar');
            $bt_fechar.text('Fechar'); 
            
            $("#pop-upCorpo")
                    .append('<p>')  // PULA LINHA
                    .append($bt_gravar)
                    .append('&nbsp;&nbsp;&nbsp;&nbsp;')  // ESPAÇO EM BRANCO
                    .append($bt_fechar);

            $('#bt_gravar').click(function(){ 
                var id_membro = $("#idnome").val();
                var dataDesligamento = $dialog.find('#mem_uso_ibr_data_desligamento').val();  // PEGA VALOR DO IMPUT
                var ataDesligamento = $dialog.find('#mem_ata_desligamento').val();  // PEGA VALOR DO IMPUT
                var motivoDesligamento = $dialog.find('#mem_motivo_desligamento').val();  // PEGA VALOR DO IMPUT
                    motivoDesligamento = encodeURIComponent(motivoDesligamento); //CODIFICA O CARACTER ESPACO DENTRO DO INPUT


                console.info('Botao Gravar Desligamento');
                //console.info('nome do membro   '+ membroNome);
                console.info('Data Desligamento   '+ dataDesligamento);
                console.info('membro ID   '+ id_membro);
                console.info('Ata   '+ ataDesligamento);
                console.info('Motivo   '+ motivoDesligamento);
                
                
                var atualiza_infos='desliga_membro';
                var url=("bd/atualiza_infos.php?id_membro="+id_membro+'&dataDesligamento='+dataDesligamento+'&atualiza_contas='+atualiza_infos+'&ata_desligamento='+ataDesligamento+'&motivoDesligamento='+motivoDesligamento);
                
                $('#itens').load(url);                
                console.info(url);
                $dialog.dialog('close');
                window.mostra_botoes();
                var url=("x-membresia/membresia.php");
                abrirPagina('x-membresia/membresia.php');
            });  
            function abrirPagina(url){
                console.info('abrir  ' + url);
                $('#pagina').slideUp("fast",function(){ // Efeito de sobe da pagina
                    $('#pagina').load(url, function(){  // Carrega pagina
                        $('#pagina').slideDown("fast"); // Efeito de desce da pagina
                    });
                });
                $(".open").removeClass('open');
            }

            $('#bt_fechar').click(function(){      
                console.info('Botao fecha popu up');
                //console.info('olha ai'+)
                var url=("x-membresia/membresia_info.php?nrid="+id_membro);
                $('#itens').load(url); 
                $dialog.dialog('close');
                window.mostra_botoes();
            });  
            
        
      
        
    principal1.start(); // EXECUTA A FUNCAO START NA ABERTURA DA PAGINA           
</script>