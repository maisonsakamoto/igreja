
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
        font-family: verdana;
        font-size: 9pt;
        background: #CDC9A5;
        background: #FFF8DC;
    }     
    
    #pop-up{
        width: 600px;
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
    /*#bt_incluir_filhos:hover{cursor: pointer; background: #CFCFCF; color: black; }
    #bt_incluir_filhos{background: #FFFFE0; width: 100px; font: 12px verdana; height: 30px; color: black; }  
    #bt_editar_filhos:hover{cursor: pointer; background: #CFCFCF; color: black; }
    #bt_editar_filhos{background: #FFFFE0; width: 100px; font: 12px verdana; height: 30px; color: black; }      
    #bt_fechar:hover{cursor: pointer; background: #CFCFCF; color: black; }
    #bt_fechar{background: #FFFFE0; width: 100px; font: 12px verdana; height: 30px; color: black; } */ 
    .botao{background: #FFFFE0 !important; width: 100px; font: 12px verdana !important; height: 30px; color: black !important; }  
    .botao:hover{cursor: pointer; background: #CFCFCF !important; color: black; }    
    .entre_linhas{height: 6px; }
    
  
        .table-filhos {
            width: 100%;
            border-collapse: collapse;
            border-spacing: 0;
        }
        .table-filhos th, .table-filhos td {
            border: 1px solid black;
            padding: 0;
            margin: 0;
            text-align: left;
        }
</style>

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
    //echo $membro; echo "<br>"; echo $nome_membro; ;
?>
<div id="new_pop-up" class="ui-widget-content ui-corner-all pop-up" style="display: block;">
    
    <div class="entre_linhas"> </div> <!--   */ espaço entre fieldsets -->   
    
    <div style="width: 520px; border: 0px; padding-left: 1; " >
        <fieldset class="fieldsetnew" style="width:100px;">
        <legend  class="ui-widget ui-widget-celso ui-corner-all"  style="width:85px;">ID Membro</legend>
        <!--<legend  class="ui-widget ui-widget-header ui-corner-all" >ID do Membro</legend>-->
        <p style="text-align: center;  "><?php echo $membro_id; ?></p>
        </fieldset>
        <fieldset  class="fieldsetnew" style="width:350px;">
            <legend  class="ui-widget ui-widget-celso ui-corner-all" style="width:130px;">Nome do Membro</legend>
            <p><?php echo $nome_membro; ?></p>
        </fieldset>           
    </div>
    
    <div style="width: 520px; border: 0px; padding-left: 1; " >
        <div style="height:10px;"> </div> <!--   */ espaço entre fieldsets -->
        <fieldset class="fieldsetgrupo" style="width:480px; height: 170px;">
            <legend  class="ui-widget ui-widget-header ui-corner-all" style="width:200px; margin: auto; background: red; border: 0px;">Filhos</legend>    
            <div style="height:5px;"> </div> <!--   */ espaço entre fieldsets -->



                <?php
                $style="style='background-color: black; color: white; height: 20px; border: 1px;font-family:verdana; font-size: 10px; font-weight:normal'";
                echo "<table class='table-filhos'>";
                    echo "<tr $style>";
                          //echo "<td>" echo NOME DO FILHO; echo "</td>" echo "<td>" NASCIMENTO echo "</td>";
                          echo "<td style='width:  400px; text-align:center;'>NOME DO FILHO</td>";
                          echo "<td style='width:  150px; text-align:center;'>NASCIMENTO </td>";
                    echo "</tr>";                
                echo "</table>";
                //$membro = $_REQUEST['nrid'];
                //echo "<input type='hidden' id='idnome' value='$membro'/>";
                //    include_once "../bd/conexao.php";   //  vai la, abre banco de dados e retorna com ele aberto
                //    $o = new OpenDB();
                //    $link = $o->server();
                    $query = "select * from membros_filhos where id_membro=$membro";
                    $dt = mysqli_query($link,$query) or die(mysqli_error($link));                  
                    $style="style='background-color: #EEEED1; height: 20px; border: 1px; font-family:verdana; font-size: 10px; font-weight:normal'"; 
                    echo "<table class='table-filhos'>";
                    $primeiro=0;
                    while ($obj= mysqli_fetch_object($dt)) {
                        //$membro_id=$obj->id_membresia;
                        $nome_filho=$obj->nome;
                        $nascimento_filho=$obj->nascimento;
                        $data = date_create($nascimento_filho);

                        // Formatando para o formato brasileiro
                        $data_brasileira = date_format($data, 'd/m/Y');
                        echo "<tr $style>";
                              echo "<td style='width:  400px; text-align:center;'>$nome_filho</td1>"; 
                              echo "<td style='width:  150px; text-align:center;'>$data_brasileira</td1>";
                        echo "</tr>";

                        //echo "<input type='hidden' id='nome_membro' value='$nome_filho'/>";
                    }
                    echo "</table>";    
                    //echo $membro; echo "<br>"; echo $nome_membro; ;
                ?>                
                
      


        </fieldset> 
    </div>    


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
            height: 400,
            modal: true, 
            title: 'FILHOS DO MEMBRO',
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
            
            var classes= "ui-button ui-widget ui-state-default ui-corner-all ui-button-text-only botao";
            var $bt_incluir_filhos = $('<button>');
            $bt_incluir_filhos.addClass(classes);
            $bt_incluir_filhos.attr('id','bt_incluir_filhos');
            $bt_incluir_filhos.text('Incluir'); 

            var $bt_editar_filhos = $('<button>');
            $bt_editar_filhos.addClass(classes);
            $bt_editar_filhos.attr('id','bt_editar_filhos');
            $bt_editar_filhos.text('Editar'); 


            var $bt_fechar = $('<button>');
            $bt_fechar.addClass(classes);
            $bt_fechar.attr('id','bt_fechar');
            $bt_fechar.text('Fechar'); 
            
            $("#pop-upCorpo")
                    .append('<p>')  // PULA LINHA
                    .append($bt_incluir_filhos)
                    //.append('<p>')  // PULA LINHA
                    .append('&nbsp;&nbsp;&nbsp;&nbsp;')  // ESPAÇO EM BRANCO
                    .append($bt_editar_filhos)            
                    .append('&nbsp;&nbsp;&nbsp;&nbsp;')  // ESPAÇO EM BRANCO
                    .append($bt_fechar);
            

            $('#bt_incluir_filhos').click(function(){ 
                var id_membro = $("#idnome").val();
                console.info('Botao incluir filhos');
                console.info('membro ID   '+ id_membro);
                
                
                //var atualiza_infos='desliga_membro';
                var url=("x-membresia/membros_filhos_incluir.php?id_membro="+id_membro);
                $('#new_pop-up').load(url);
                console.info(url);
            });  

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

