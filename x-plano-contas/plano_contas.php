
<style>
    
    #bt_novo_grupo:hover{cursor: pointer; background: #CFCFCF; color: black; }
    #bt_novo_grupo{background: #FFFFE0; width: 140px; font: 12px verdana; height: 30px; color: black; }  
    #bt_editar_grupo:hover{cursor: pointer; background: #CFCFCF; color: black; }
    #bt_editar_grupo{background: #FFFFE0; width: 140px; font: 12px verdana; height: 30px; color: black; }  
    
    #bt_nova_conta:hover{cursor: pointer; background: #CFCFCF; color: black; }
    #bt_nova_conta{background: #FFFFE0; width: 140px; font: 12px verdana; height: 30px; color: black; }  
    #bt_editar_conta:hover{cursor: pointer; background: #CFCFCF; color: black; }
    #bt_editar_conta{background: #FFFFE0; width: 140px; font: 12px verdana; height: 30px; color: black; }    
    
    .cor_grid{color: red; font-weight:bold  !important; }  /* !important  colocar quando usar segunda classe */
    .cor_selecionado{ background-color: #9BCD9B   !important; }       /* exemplo: quando selecionar um registro no grid ele fica de outra cor*/
</style>


<div style="background: white; height: 5px; width: 880px; float: left;">  

</div>    
<div style="background: white; height: 690px; width: 1000px; float: left;"> 
    <?php
    
    include_once "../bd/conexao.php";   //  vai la, abre banco de dados e retorna com ele aberto
    
    $o = new OpenDB();
    $link = $o->server();
    $style_titulo="style='background-color: black; height: 20px; border: 1px;font-family:verdana; font-size: 10px; color: white; font-weight:bold'"; 
    echo "<table>";
        echo "<tr $style_titulo>";
           echo "<td style='width: 995px;text-align:center;'>GRUPOS</td>";
        echo "</tr>";
        echo "<tr>";
           echo "<td style='width: 687px;text-align:center;background-color: white; height: 2px;'></td>";
        echo "</tr>";        
    echo "</table>";    

    ?>    
    <div style="background: bisque; height: 608px; width: 310px; float: left; overflow: auto; border: 1px solid blue;">
        <?php 
        echo "<table>";
           // echo "<tr $style_titulo>";
           //    echo "<td style='width: 302px;text-align:center;'>FOZ DO IGUAÇU</td>";
           // echo "</tr>";
        echo "</table>";  
    echo "<table>";
        echo "<tr $style_titulo>";
               echo "<td style='width: 35px;text-align:center;'>ID</td>";
               echo "<td style='width: 250px; text-align:center; '>GRUPOS</td>";
               //echo "<td style='width: 30px; text-align:center;'>INFO</td>";
        echo "</tr>";        
    echo "</table>";          
        $query = "select * from plano_contas_grupo order by grupo_nome";
        $dt = mysqli_query($link,$query) or die(mysqli_error($link));                  
        $style="style='background-color: #EEEED1; height: 20px; border: 0px;font-family:verdana; font-size: 10px; font-weight:normal'"; 
        echo "<table id='table_grupos' >";
        $primeiro=0;
        while ($obj= mysqli_fetch_object($dt)) {
            $grupo_id=$obj->id_grupo;
            
            if($primeiro==0){
                $primeiro=1;    
                echo "<input id='nr_id' type='hidden' value=$grupo_id>";
            }
            $nome_grupo=$obj->grupo_nome;
            $nome_grupo=substr($nome_grupo,0,50);

            echo "<tr $style class='hover info botao aciona ui-button'>";
               //echo "<td style='width: 35px;text-align:center;'>$grupo_id</td>";
               echo "<td style='width: 35px; text-align:left;'><input $style  type = 'button' nr_id='".$obj->id_grupo."' name ='botao5'  value = '&nbsp;&nbsp;$grupo_id' class='ui-button' ></td>";
               echo "<td style='width: 250px; text-align:left;'><input $style type = 'button' nr_id='".$obj->id_grupo."' name ='botao5'  value = '&nbsp;&nbsp;$nome_grupo' class='ui-button' ></td>";
            echo "</tr>";
        }   
        echo "</table>";   
            ?>
    
    </div> 
    <div id="itens" style="background: bisque; height: 608px; width: 680px;float: right; border: 1px solid blue;"> 
    </div>     

<div id="bt_grupo" style="border: 1px solid blue; margin:0 auto; padding-top: 2px; height: 40px; width: 310px; float: left; overflow: auto; padding-left: 0px; background: bisque">  
     <?php //include "../bancodados\conexaomysqlproducao.php";?>
</div> 
<div id="bt_contas" style="border: 1px solid blue; margin:0 auto; padding-top: 2px; height: 40px; width: 680px; float: right; overflow: auto; padding-left: 0px; background: bisque;">  
     <?php //include "../bancodados\conexaomysqlproducao.php";?>
</div>     

    
</div>  
<script type="text/javascript">
    
    var principal = {};

    principal.start=function(){
        principal.html();
        principal.eventos(); // EXECUTA A FUNCAO EVENTOS, CONFIGURA OQUE OS CLIQUES IRÁ FAZER        
       // $("#pop-up").hide();
        var url=("x-plano-contas/plano_contas_info.php?nrid="+$("#nr_id").val());
        console.info('inicio primeiro registro',url);
        $('#itens').load(url);
        $('#bt_editar_grupo').attr('nr_id',$("#nr_id").val());
        //var nr_id=1;
        }; 
        window.mostra_botoes();
        principal.eventos=function(){
            
            $('.hover').mouseover(function(){
                $(this).addClass('cor_grid');
                $(this).find('input').addClass('cor_grid');
            });
            $('.hover').mouseout(function(){
                $(this).removeClass('cor_grid');
                $(this).find('input').removeClass('cor_grid');
            });
            
                $('.info').click(function(e){
                e.stopImmediatePropagation();
                // ini selecionar
                $('.cor_selecionado').removeClass('cor_selecionado');
                $(this).addClass('cor_selecionado');
                $(this).find('input').addClass('cor_selecionado');
                // fim selecionar
                
                
                window.mostra_botoes();
                //if nr_id = ' ' {nr_id=1};
                var idi = $(this).find('input').attr('nr_id');
                $('#bt_editar_grupo').attr('nr_id',idi);
                $('#bt_nova_conta').attr('nr_id',idi);
                $('#bt_novo_grupo').attr('nr_id',idi);
                console.log('  numero id do grupo  '+idi);
                var url=("x-plano-contas/plano_contas_info.php?nrid="+idi);
                $('#itens').load(url);
            });
            $('#bt_editar_grupo').click(function(){      
                console.info('Editar Grupo');
                var idi = $(this).attr('nr_id');
                console.log(idi);
                var url=("x-plano-contas/grupo_edita.php?nrid="+idi);
                $('#itens').load(url);
                window.esconde_botoes();
            });             
            
            $('#bt_novo_grupo').click(function(){      
                console.info('Novo Grupo');
                window.esconde_botoes();
                var idi = $('#bt_editar_grupo').attr('nr_id');
                //var idi = 1;
                console.log('numero idi'+idi);
                var url=("x-plano-contas/grupo_novo.php?nrid="+idi);
                $('#itens').load(url);  
            });      
            
            
            $('#bt_nova_conta').click(function(){      
                console.info('Novo Conta');
                window.esconde_botoes();
                var idi = $(this).attr('nr_id');
                console.log('numero do idi  '+idi);
                var url=("x-plano-contas/contas_nova.php?nrid="+idi);
                $('#itens').load(url);                 
            });      
            
            
         /*   $('#bt_editar_conta').click(function(){      
                console.info('Edita Conta');
                window.esconde_botoes();

                //var idi='celso';
                var idi = $(this).attr('nr_id');
                var url=("x-plano-contas/contas_edita.php?nrid="+idi);
                //die();
                //var url=("x-plano-contas/contas_edita.php");
                $('#itens').load(url);                
            });       */
            
        /*     $("#fechar").click(function(){
                $("#pop-up").hide('in');
                window.mostra_botoes();
            });     */       
        };
        
       /* function esconde_botoes_lll(){
            console.info('cheguei,  function controle de botoes')
                $('#bt_novo_grupo').hide();  //esconde botao
                $('#bt_editar_grupo').hide();  //esconde botao                
                $('#bt_nova_conta').hide();  //esconde botao
                $('#bt_editar_conta').hide();  //esconde botao         
            };
        function mostra_botoes_lll(){
            console.info('cheguei,  function controle de botoes')
                $('#bt_novo_grupo').show();  //esconde botao
                $('#bt_editar_grupo').show();  //esconde botao                
                $('#bt_nova_conta').show();  //esconde botao
                $('#bt_editar_conta').show();  //esconde botao         
            };     */
        principal.html=function(){
        var $botao = $('<button>').text('Novo Grupo').button();
        $botao.attr('id','bt_novo_grupo');
        $('#bt_grupo').append($botao);

        $('#bt_grupo').append('&nbsp;&nbsp;&nbsp;&nbsp;');        
        
        var $botao = $('<button>').text('Editar Grupo').button();
        $botao.attr('id','bt_editar_grupo');
        $('#bt_grupo').append($botao);        
        
        
        var $botao = $('<button>').text('Nova Conta').button();
        $botao.attr('id','bt_nova_conta');
        $('#bt_contas').append($botao);

        $('#bt_contas').append('&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;');        
        
       /* var $botao = $('<button>').text('Editar Conta').button();
        $botao.attr('id','bt_editar_conta');
        $('#bt_contas').append($botao);  */      
        
        
    };
        
    principal.start(); // EXECUTA A FUNCAO START NA ABERTURA DA PAGINA           
</script>