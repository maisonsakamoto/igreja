
<style>
    
    #bt_gravar:hover{cursor: pointer; background: #CFCFCF; color: black; }
    #bt_gravar{background: #FFFFE0; width: 140px; font: 12px verdana; height: 30px; color: black; }  
    #bt_fechar:hover{cursor: pointer; background: #CFCFCF; color: black; }
    #bt_fechar{background: #FFFFE0; width: 140px; font: 12px verdana; height: 30px; color: black; }  
</style>

<?php

//echo "contas_nova     ";

$idgrupo = $_REQUEST['nrid'];
//$id = $_REQUEST['id'];
//$dia=date('Y-m-d');
//$teste="SANEPAR";
//echo $idgrupo;
echo "<input type='hidden' id='idgrupo' value='$idgrupo'/>";
//echo "<td style='width: 250px; text-align:left;'><input $style  type = 'button' nr_id='".$_REQUEST['nrid']."' ></td>";
//echo "<td style='width: 250px; text-align:left;'><input $style  type = 'button' nr_id='".$obj->id_grupo."' name ='botao5'  value = '&nbsp;&nbsp;$nome_grupo'  class='info botao aciona ui-button'></td>";

    include_once "../bd/conexao.php";   //  vai la, abre banco de dados e retorna com ele aberto
    
    $o = new OpenDB();
    $link = $o->server();
    $query = "select * from plano_contas_grupo where id_grupo=$idgrupo";
    $dt = mysqli_query($link,$query) or die(mysqli_error($link));                  
    $style="style='background-color: #EEEED1; height: 20px; border: 1px;font-family:verdana; font-size: 10px; font-weight:normal'"; 
    echo "<table>";
    $primeiro=0;
    while ($obj= mysqli_fetch_object($dt)) {
        $grupo_id=$obj->id_grupo;

        if($primeiro==0){
            $primeiro=1;    
            echo "<input id='grupo_id' type='hidden' value=$grupo_id>";
        }
        $nome_grupo=$obj->grupo_nome;
        $nome_grupo=substr($nome_grupo,0,25);

        echo "<tr $style>";
          // echo "<td style='width: 35px;text-align:center;'>$grupo_id</td>";
          // echo "<td style='width: 250px; text-align:left;'><input $style  type = 'button' nr_id='".$obj->id_grupo."' name ='botao5'  value = '&nbsp;&nbsp;$nome_grupo'  class='info botao aciona ui-button'></td>";
        echo "</tr>";
        
        echo "<input type='hidden' id='nome_grupo' value='$nome_grupo'/>";
        
    }
    echo "</table>";    

?>


<style>
    
    #pop-up{
        /*position: absolute;
        top: 40%;
        left: 60%;
        margin-left: -330px;
        margin-top: -80px;*/
        width: 520px;
        height: 260px;
        font-family: verdana;
        font-size: 9pt;
        background: #CDC9A5;
        background: #FFF8DC;
        /*background: blue;*/
    } 
    .ui-widget-header{font-family: verdana; font-size: 9pt; background: #191970; text-align: center; }
    .ui-dialog .ui-dialog-title{ float: none; text-align: center; }
    .titulo{
        font-family: verdana; font-size: 9pt; color: white; background: red; border-color: #191970; align: center;            }
</style>
<div id="pop-up" class="ui-widget-content ui-corner-all pop-up" style="display: block;">
       
      <!-- <center>
            <h3 id="fechar" class="ui-widget-header ui-corner-all" style="cursor: pointer;  font-family: verdana; font-size: 9pt; color: white; background: #191970; border-color: #191970; "></h3>
        </center>  --> 
    
    <div id="pop-conta" style="text-align:center;"></div>
        <h3 id="total" class="ui-widget-header ui-corner-all" style="font-family: verdana; font-size: 9pt; color: black; background: #8B8970; border-color: #8B8970; "></h3>    
    
        <div id="pop-upCorpo" style="text-align: center;"></div>
        <h3 id="total" class="ui-widget-header ui-corner-all" style="font-family: verdana; font-size: 9pt; color: black; background: #8B8970; border-color: #8B8970; text-align: center; "></h3>
</div> 


<script type="text/javascript">
    
    var principal1 = {};
    var $dialog = $("#pop-up");
    
    principal1.start=function(){
        //principal1.html();
        principal1.eventos(); // EXECUTA A FUNCAO EVENTOS, CONFIGURA OQUE OS CLIQUES IRÁ FAZER        
        //$("#pop-up").show();
            $dialog.dialog({
            width: 520,
            height: 180,
            modal: true, 
            title: 'CRIAR NOVA CONTA',
            close: function(){    // aqui é o X de fechar pop up
                var url=("x-plano-contas/plano_contas_info.php?nrid="+id_grupo);
                $('#itens').load(url); 
                $dialog.remove();  // REMOVE POP UP
                window.mostra_botoes();
            }
        });
    };
    principal1.eventos=function(){};  
                     
            $("#pop-upCorpo").empty();
            var id_grupo = $("#idgrupo").val();
            var grupo = $("#nome_grupo").val();
            
            console.info('id   '+id_grupo);
            console.info('grupo  '+grupo);
            
            $("#pop-conta").append("<label style='color: black; font-weight: bold;'>GRUPO --> &nbsp;&nbsp;"+grupo+"</label><br>");  
            $("#pop-upCorpo").append("<label>NOME DA CONTA:&nbsp;&nbsp;</label>")
            
        // PARA O INPUT FUNCIONAR
            $("#pop-upCorpo").append("<input id='conta' style='width: 350; maxlength: 6; color: red;'></input>")  
            $('#conta').on('input', function() {
                const maxLength = 40; // Definir o número máximo de caracteres
                if ($(this).val().length > maxLength) {
                    $(this).val($(this).val().slice(0, maxLength)); // Truncate o valor do input
                }
            });            
        // FIM DO FUNCIONAMENTO DO INPUT 
            
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
                    .append('<p></p>')  // PULA LINHA
                    .append($bt_gravar)
                    .append('&nbsp;&nbsp;&nbsp;&nbsp;')  // ESPAÇO EM BRANCO
                    .append($bt_fechar);

            $('#bt_gravar').click(function(){      
                var contaNome = $dialog.find('#conta').val();  // PEGA VALOR DO IMPUT
                if( contaNome==''){
                    alert('NOME DA CONTA NO PODE SER VAZIO');
                    return false;
                }
                console.info('Botao Gravar');
                //$dialog.dialog('close');
                //var idi = $(this).attr('contaNome');
                console.info(contaNome);
                console.info(id_grupo);
                console.info(grupo);
                var atualiza_infos='nova_conta';
                contaNome = encodeURIComponent(contaNome); //CODIFICA O CARACTER ESPACO DENTRO DO INPUT
                var url=("bd/atualiza_infos.php?nome_conta="+contaNome+'&atualiza_contas='+atualiza_infos+'&id_do_grupo='+id_grupo);
                $('#itens').load(url);                
                console.info(url);
                $dialog.dialog('close');
                window.mostra_botoes();
            });  


            $('#bt_fechar').click(function(){      
                console.info('Botao fecha popu up');
                //console.info('olha ai'+)
                var url=("x-plano-contas/plano_contas_info.php?nrid="+id_grupo);
                $('#itens').load(url); 
                $dialog.dialog('close');
                window.mostra_botoes();
            });  
            
        
      
        
    principal1.start(); // EXECUTA A FUNCAO START NA ABERTURA DA PAGINA           
</script>