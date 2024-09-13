<script src="x_controle_botoes.js" type="text/javascript"></script>
<script src="js/jquery-meiomask.js" type="text/javascript"></script>
<style>
    #new_pop-up{
        font-family: verdana;
        font-size: 9pt;
        background: #CDC9A5;
        background: bisque;
        /*background: #EEEED1;*/
    }     
    

</style>
<?php

//echo "membros_filhos_incluir";

echo "<script>console.log('membros_incluir_filhos');</script>";
$membro = $_REQUEST['id_membro'];
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
        echo "<input type='hidden' id='id_membro' value='$membro_id'/>";
    }
    echo "</table>";    
    //echo $membro; echo "<br>"; echo $nome_membro; ;
?>

<div id="new_pop-up" class="ui-widget-content ui-corner-all pop-up" style="display: block; border: 0px;">
    
    <div class="entre_linhas"> </div> <!--   */ espaço entre fieldsets -->   
    
    <div style="width: 520px; border: 1px; padding-left: 1; " >
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
    </div>    
</div>

<div class="entre_linhas"> </div> <!--   */ espaço entre fieldsets -->   

<div id="new_pop-up" class="ui-widget-content ui-corner-all pop-up" style="display: block; border: 0px;">
    
    
    <div style="width: 520px; border: 0px; padding-left: 1; " >
        <fieldset class="fieldsetnew" style="width:480px; height: 80px;">
        <legend  class="ui-widget ui-widget-header ui-corner-all" style="width:200px; margin: auto; background: red; border: 0px;">Inclusao de Filho</legend>
            <div class="entre_linhas"> </div> <!--   */ espaço entre fieldsets -->  
            <fieldset class="fieldsetnew" style="width:100px;">
            <legend  class="ui-widget ui-widget-celso ui-corner-all"  style="width:120px;">Nome do Filho</legend>
            <!--<legend  class="ui-widget ui-widget-header ui-corner-all" >ID do Membro</legend>-->
            <input  type="text" id="mem_nome_filho" name="mem_nome_filho" style="width: 288px;" maxlength="50" value=""> 
            </fieldset>
            <fieldset  class="fieldsetnew" style="width:135px;">
                <legend  class="ui-widget ui-widget-celso ui-corner-all" style="width:130px;">Nascimento</legend>
                <input  type="text" id="mem_nascimento_filho" name="mem_nascimento_filho" alt="date" style="width: 134px" value="" >  <!-- alt="date" coloca mascara de data, pega do jquery-meiomask.js -->
            </fieldset>           
        </fieldset>
    </div>
    
    <div style="width: 520px; border: 0px; padding-left: 1; " >
        <div style="height:10px;"> </div> <!--   */ espaço entre fieldsets -->
    </div>    


    <div id="pop-upCorpo" style="text-align: center;"></div>
</div>

<script type="text/javascript">
 
    var principal1 = {};
    var $dialog = $("#new_pop-up");
    document.getElementById("mem_nome_filho").focus();
  
    
    principal1.start=function(){




      // $(document).ready(function(){
          $("*").setMask();
           //$("#nascimento").datepicker();
      // });         
        
        principal1.eventos(); // EXECUTA A FUNCAO EVENTOS, CONFIGURA OQUE OS CLIQUES IRÁ FAZER        
            $dialog.dialog({
            width: 540,
            height: 280,
            modal: true, 
            title: 'INCLUSAO FILHOS DO MEMBRO',
            close: function(){    // aqui é o X de fechar pop up
                //var url=("x-plano-contas/plano_membresia_info.php?nrid="+id_grupo);
                var url=("x-membresia/membros_filhos.php?nrid="+id_membro);
                //var url=("x-membresia/plano_membresia.php");
                $('#pop-upCorpo').load(url); 
                $dialog.remove();  // REMOVE POP UP
                window.mostra_botoes();
            }
        });
    };
    principal1.eventos=function(){};  
            $("#pop-upCorpo").empty();
            var id_membro = $("#id_membro").val();
            var membro = $("#nome_membro").val();
            
            var classes= "ui-button ui-widget ui-state-default ui-corner-all ui-button-text-only botao";
            var $bt_gravar_filhos = $('<button>');
            $bt_gravar_filhos.addClass(classes);
            $bt_gravar_filhos.attr('id','bt_gravar_filhos');
            $bt_gravar_filhos.text('Gravar'); 

            var $bt_fechar = $('<button>');
            $bt_fechar.addClass(classes);
            $bt_fechar.attr('id','bt_fechar');
            $bt_fechar.text('Fechar'); 
            
            $("#pop-upCorpo")
                    .append('<br/>')  // PULA LINHA
                    .append($bt_gravar_filhos)
                    .append('&nbsp;&nbsp;&nbsp;&nbsp;')  // ESPAÇO EM BRANCO
                    .append($bt_fechar);
            

            $('#bt_gravar_filhos').click(function(){ 
                var id_membro = $("#idnome").val();
                var membroNomeFilho = $dialog.find('#mem_nome_filho').val();  // PEGA VALOR DO IMPUT
                    if( membroNomeFilho==''){
                        alert('NOME DO FILHO NAO PODE SER VAZIO');
                        return false;
                    }
                    membroNomeFilho = encodeURIComponent(membroNomeFilho); //CODIFICA O CARACTER ESPACO DENTRO DO INPUT
                var membroNascimentoFilho = $dialog.find('#mem_nascimento_filho').val();  // PEGA VALOR DO IMPUT                
                validarData();    
                
                
                
                console.info('Botao gravar filhos');
                console.info('membro ID   '+ id_membro);
                console.info('Nome do Filho   '+ membroNomeFilho);
                console.info('Nascimento Filho   '+ membroNascimentoFilho);
                
                
                var atualiza_infos='inclui_filho';
                var url=("bd/atualiza_infos.php?id_membro="+id_membro+'&nome_filho='+membroNomeFilho+'&atualiza_contas='+atualiza_infos
                        +'&nascimento_filho='+membroNascimentoFilho);
                //var url=("x-membresia/membros_filhos_incluir.php?id_membro="+id_membro);
                $('#pop-upCorpo').load(url);
                window.mostra_botoes();
                //console.info('clicou no botao gravar filhos'+url);
                var url=("x-membresia/membros_filhos.php?nrid="+id_membro);
                $('#itens').load(url); 
                $dialog.dialog('close');                
            });  

            $('#bt_fechar').click(function(){      
                console.info('Botao fecha popu up');
                //console.info('olha ai'+)
                var url=("x-membresia/membros_filhos.php?nrid="+id_membro);
                $('#itens').load(url); 
                $dialog.dialog('close');
                //window.mostra_botoes();
            });  
            
        function validarData() {
         const inputData = document.getElementById("mem_nascimento_filho").value;
         // Expressão regular para verificar o formato DD/MM/AAAA
         const dataRegex = /^(\d{2})\/(\d{2})\/(\d{4})$/;
         // Verifica se a data está no formato correto
         
            if (!/^\d{2}\/\d{2}\/\d{4}$/.test(inputData)) {
              console.info('formato da data errado');
              alert('FORMATO DA DATA INVALIDA - DIGITE DD/MM/YYYY');
              mem_nascimento_filho.focus();
            }         
         
         if (!dataRegex.test(inputData)) {
           document.getElementById("resultado").innerText = "Formato inválido. Use DD/MM/AAAA.";
           console.info('formato da data errado');
           mem_nascimento_filho.focus();
           return;
         }
         // Extrai o dia, mês e ano
         let [, dia, mes, ano] = inputData.match(dataRegex);
         // Converte para números inteiros
         dia = parseInt(dia, 10);
         mes = parseInt(mes, 10);
         ano = parseInt(ano, 10);
         // Cria uma data com os valores extraídos
         const dataFormatada = new Date(ano, mes - 1, dia);  // Mês é zero-indexado em JavaScript (0 = Janeiro, 11 = Dezembro)
         // Verifica se a data é válida
         if (
           dataFormatada.getFullYear() === ano &&
           dataFormatada.getMonth() === mes - 1 &&
           dataFormatada.getDate() === dia
         ) {
           console.info('data valida');
           document.getElementById("resultado").innerText = "Data válida!";
         } else {
           console.info('data invalida');
           alert('DATA INVALIDA');
           mem_nascimento_filho.focus();
           document.getElementById("resultado").innerText = "Data inválida!";
         }
       }       
      
        
    principal1.start(); // EXECUTA A FUNCAO START NA ABERTURA DA PAGINA         
</script>