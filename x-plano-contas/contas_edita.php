
<style>
    
    #bt_gravar:hover{cursor: pointer; background: #CFCFCF; color: black; }
    #bt_gravar{background: #FFFFE0; width: 140px; font: 12px verdana; height: 30px; color: black; }  
    #bt_fechar:hover{cursor: pointer; background: #CFCFCF; color: black; }
    #bt_fechar{background: #FFFFE0; width: 140px; font: 12px verdana; height: 30px; color: black; }  
</style>
<?php
    $idconta = $_REQUEST['nrid'];
    $idgrupo = $_REQUEST['idgrupo'];
    //echo "plano_contas_edita_grupo";
    //echo "<br>";
    //echo $idgrupo;

    echo "<input type='hidden' id='idconta' value='$idconta'/>";
    echo "<input type='hidden' id='idgrupo' value='$idgrupo'/>";
    include_once "../bd/conexao.php";   //  vai la, abre banco de dados e retorna com ele aberto
    $o = new OpenDB();
    $link = $o->server();
    $query = "select * from plano_contas_conta where id_contas=$idconta";
    $dt = mysqli_query($link,$query) or die(mysqli_error($link));                  
    $style="style='background-color: #EEEED1; height: 20px; border: 1px;font-family:verdana; font-size: 10px; font-weight:normal'"; 
    $style1="style='background-color: black; height: 20px; border: 1px; color: white; font-family:verdana; font-size: 10px; font-weight:bold'"; 
    echo "<table>";
        $primeiro=0;
        while ($obj= mysqli_fetch_object($dt)) {
            $id_conta=$obj->id_contas;
            $nome_conta=$obj->nome;
            $nome_grupo=$obj->grupo;
            $nome_conta=substr($nome_conta,0,50);

           /* echo "<tr $style1>";
               echo "<td style='width: 35px;text-align:center;'></td>";
               echo "<td style='width: 250px; text-align:center;'>SOMENTE A TITULO DE INFORMAÇAO, APAGAR DEPOIS</td>";
            echo "</tr>";  
            
            
            echo "<tr $style>";
               echo "<td style='width: 35px;text-align:center;'>$id_conta</td>";
               echo "<td style='width: 250px; text-align:left;'><input $style  type = 'button' nr_id='".$obj->id_contas."' name ='botao5'  value = '&nbsp;&nbsp;$nome_conta'  class='info botao aciona ui-button'></td>";
            echo "</tr>";          */
            
            echo "<input type='hidden' id='nome_conta' value='$nome_conta'/>";
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
    .ui-widget-header{font-family: verdana; font-size: 9pt; background: #A52A2A; text-align: center; }
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
            width: 550,
            height: 180,
            modal: true, 
            title: 'EDITAR CONTAS',
            close: function(){    // aqui é o X de fechar pop up
                var nridgrupo = $('#idgrupo').val();
                var url=("x-plano-contas/plano_contas_info.php?nrid="+nridgrupo);
                $('#itens').load(url); 
                $dialog.remove();  // REMOVE POP UP
                window.mostra_botoes();
            }
        });
    };
    principal1.eventos=function(){};
            
            $("#pop-upCorpo").empty();
            var id_da_conta = $("#idconta").val();
            var conta = $("#nome_conta").val();
            
            console.info('id   '+id_da_conta);
            console.info('conta  '+conta);
            
            //$("#pop-conta").append("<label style='color: black; font-weight: bold;'>GRUPO --> &nbsp;&nbsp;"+grupo+"</label><br>");  
            
        // PARA O INPUT FUNCIONAR
            $("#pop-conta").append("<label style='color: black; font-weight: bold;'>ALTERAR CONTA --> &nbsp;&nbsp;"+conta+"</label><br>");  
            $("#pop-upCorpo").append("<label>NOME DA CONTA:&nbsp;&nbsp;&nbsp;</label>")
            $("#pop-upCorpo").append("<input id='conta' value='"+conta+"'  style='width: 350; maxlength: 6; color: red;'></input>");            
            $('#grupo').on('input', function() {
                const maxLength = 50; // Definir o número máximo de caracteres
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
                var contaNome = $('#conta').val();  // PEGA VALOR DO IMPUT
                if( contaNome==''){
                    alert('NOME DA CONTA NAO PODE SER VAZIO');
                    return false;
                }
                console.clear();
                console.info('Botao Gravar');
                //$dialog.dialog('close');
                //var idi = $(this).attr('contaNome');
                console.info(contaNome);
                console.info('id_conta  '+id_da_conta);
                console.info('nome do conta '+contaNome);
                var atualiza_infos='edita_conta';
                contaNome = encodeURIComponent(contaNome); //CODIFICA O CARACTER ESPACO DENTRO DO INPUT
                var url=("bd/atualiza_infos.php?id_conta="+id_da_conta+'&atualiza_contas='+atualiza_infos+'&nome_conta='+contaNome);
                $('#itens').load(url);                
                console.info(url);
                $dialog.dialog('close');
                window.mostra_botoes();
                javascript:abrirPagina('x-plano-contas/plano_contas.php');
            });  


            $('#bt_fechar').click(function(){      
                console.info('Botao fecha popu up');
                var nridgrupo = $('#idgrupo').val();
                var url=("x-plano-contas/plano_contas_info.php?nrid="+nridgrupo);
                $('#itens').load(url); 
                $dialog.dialog('close');
                window.mostra_botoes();
            });  
            
        
      
        
    principal1.start(); // EXECUTA A FUNCAO START NA ABERTURA DA PAGINA           
</script>