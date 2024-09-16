
<style>

body {
    font-family: Arial, sans-serif;
}

.container {
    display: flex;
    flex-wrap: wrap;
    justify-content: space-between;
    align-items: flex-start; /* Align items at the top */
}

.left-container {
    display: flex;
    flex-direction: column;
}

.left {
    width: 100%;
}

#div1, #div2 {
    margin-bottom: 2px; /* Optional: Add some space between the divs */
}

.right {
    align-self: flex-start; /* Align self at the top */
    margin-left: auto;
}

.jqx-grid-cell{ font-size: 11px; background: #EEEED1; }
.jqx-fill-state-hover{ color: red; font-weight: bold; }
.jqx-grid-cell-selected{ background: #9BCD9B; }




    #bt_novo_membro:hover, #bt_editar_membro:hover, #bt_filhos:hover,  #bt_desliga_membro:hover{cursor: pointer; background: #CFCFCF; color: black; }
    #bt_novo_membro, #bt_editar_membro, #bt_filhos, #bt_desliga_membro {background: #FFFFE0; width: 140px; font: 12px verdana; height: 30px; color: black; }

    .cor_grid{color: red; font-weight:bold  !important; }  /* !important  colocar quando usar segunda classe */
    .cor_selecionado{ background-color: #9BCD9B   !important; }       /* exemplo: quando selecionar um registro no grid ele fica de outra cor*/
</style>


<div style="background: red; height: 0px; width: 880px; float: left;"></div>

<div class="container"  style="background: #FAEBD7; height: 690px; width: 1000px; float: left;">
    <?php

    include_once "../bd/conexao.php";   //  vai la, abre banco de dados e retorna com ele aberto

    $o = new OpenDB();
    $link = $o->server();
    $style_titulo="style='background-color: black; height: 25px; border:1px; font-family:verdana; font-size: 10px; color: white; font-weight:bold'";
    echo "<table>";

   //SELECT COUNT(*) AS total_registros
   //FROM nombre_de_la_tabla;


        $query = "select count(*) as total_membros from membresia where uso_ibr_desligamento is null";
        $dt = mysqli_query($link,$query) or die(mysqli_error($link));
        while ($obj= mysqli_fetch_object($dt)) {
                $total_membros=$obj->total_membros;
                //echo $total_membros;
        }

        echo "<tr $style_titulo>";
           $espaco=str_repeat('&nbsp;', 100);
           echo "<td style='width: 995px;text-align:center;'>$espaco MEMBRESIA ATIVA $espaco TOTAL DE MEMBROS &nbsp;&nbsp;&nbsp;&nbsp;  $total_membros </td>";
           //echo "<td style='width: 300px;text-align:center;'>TOTAL DE MEMBROS  $total_membros</td>";
           //echo "<td style='width: 995px;text-align:center;'>$total_membros</td>";
        echo "</tr>";
        echo "<tr>";
           echo "<td style='width: 687px;text-align:center;background-color: bisque; height: 0px;'></td>";
        echo "</tr>";
    echo "</table>";

    ?>
    <div class="left-container">
    <div class="left" id="div1" style="background: bisque; height: 35px; width: 310px; float: left; overflow: auto; border: 1px solid blue;">  <!-- ATALHO PARA NOME DOS MEMBROS -->
        <input id="input-filtro" style="width: 305px; margin-top: 5px;" />
    </div>
    <div class="left" id="div2 "style="background: bisque; height: 579px; width: 310px; float: left; overflow: auto; border: 1px solid blue;">  <!-- GRID COM NOME DOS MEMBROS -->

        <?php
        echo "<table>";
           // echo "<tr $style_titulo>";
           //    echo "<td style='width: 302px;text-align:center;'>FOZ DO IGUAÇU</td>";
           // echo "</tr>";
        echo "</table>";
    /*echo "<table>";
        echo "<tr $style_titulo>";
               echo "<td style='width: 35px;text-align:center;'>ID</td>";
               echo "<td style='width: 250px; text-align:center; '>MEMBRO</td>";
               //echo "<td style='width: 30px; text-align:center;'>INFO</td>";
        echo "</tr>";        */
    echo "</table>";
        $query = "select * from membresia where uso_ibr_desligamento is null order by nome";
        $dt = mysqli_query($link,$query) or die(mysqli_error($link));
        $style="style='background-color: #EEEED1; height: 20px; border:1px;font-family:verdana; font-size: 10px; font-weight:normal'";
        echo "<table id='tab_membro'>";
        $primeiro=0;
        while ($obj= mysqli_fetch_object($dt)) {
            $mem_id=$obj->id_membresia;

            if($primeiro==0){
                $primeiro=1;
                echo "<input id='nr_id' type='hidden' value=$mem_id>";
            }
            $membro=$obj->nome;
            $membro=substr($membro,0,25);
            //$filial_nome='FOZ DO IGUAÇU';
            echo "<tr $style class='hover info botao aciona ui-button'>";
               //echo "<td style='width: 35px;text-align:center;'>$mem_id</td>";
               echo "<td style='width:  35px; text-align:left;'><input $style  type = 'button' nr_id='".$obj->id_membresia."' name ='botao5'  value = '&nbsp;&nbsp;$mem_id'  class='ui-button'></td>";
               echo "<td style='width: 250px; text-align:left;'><input $style  type = 'button' nr_id='".$obj->id_membresia."' name ='botao5'  value = '&nbsp;&nbsp;$membro'  class='ui-button'></td>";
            echo "</tr>";
        }
        echo "</table>";
        ?>

        <div id="div_membros"></div>
    </div>
    </div>
    <div class="right" id="itens" style="border: 1px solid blue; background: bisque; height: 613x; width: 680px;float: right;"></div>  <!-- div das informaçoes do membro  -->
    <div style="height:3px; width: 1000px; background: #FAEBD7;"> </div> <!--   */ espaço entre div -->
    <div class="left"id="grid" style="border: 1px solid blue; margin:0 auto; padding-top: 5px; height: 40px; width: 1000px; float: left; overflow: auto; padding-left: 0px; background: bisque;"></div>   <!-- div botoes NOVO MEMBRO e EDITAR MEMBRO  -->


</div>

<script type="text/javascript">

    var membresia = {};
    membresia.arrayMembros=new Array();
    membresia.start=function(){
        membresia.html();
        membresia.eventos(); // EXECUTA A FUNCAO EVENTOS, CONFIGURA OQUE OS CLIQUES IRÁ FAZER

        var url=("x-membresia/membresia_info.php?nrid="+$("#nr_id").val());
        $('#itens').load(url);
        $('#bt_editar_membro').attr('nr_id',$("#nr_id").val());
        $('#bt_novo_membro').attr('nr_id',$("#nr_id").val());
        $('#bt_desliga_membro').attr('nr_id',$("#nr_id").val());

        membresia.setGridMembro();
    };

    membresia.setGridMembro = function(){
        $('#tab_membro').find('tr').each( function(){
           // pegando o valor do ID
           var id = $(this).find('td:eq(0) input').val(); // this = TR
           var nome_membro = $(this).find('td:eq(1) input').val(); // this = TR
           var obj = new Object();
           obj.id = id;
           obj.nome = nome_membro;
           //membresia.arrayMembros.push( { id:id, nome: nome_membro } );
           membresia.arrayMembros.push( obj );
        });
         var source = { localdata: membresia.arrayMembros };
         var dataAdapter = new $.jqx.dataAdapter(source);
         $('#div_membros').jqxGrid({
            height: '577px',     // Altura do grid
            width:'308px',       // Largura do grid
            columnsheight: 0,   // Altura do Cabecalho
            rowsheight: 20,      // Altura das linhas
            source: dataAdapter, // Array dos dados do grid
            columns: [
                { text: 'ID', dataField: 'id', width: '15%', align: 'center', cellsalign:'center'},    // Configuracao da primeira coluna
                { text: 'Nome', dataField: 'nome', width: '85%', align: 'center', cellsalign:'left' } // Configuracao da segunda coluna
            ]
         });
         $('#tab_membro').hide();
         $('#div_membros').jqxGrid('selectrow',0);

    };

        membresia.eventos=function(){
            // Para filtrar no grid
            $('#input-filtro').keyup( function(){
                var param = $(this).val();
                custom.filtroGrid(param,$('#div_membros'),'nome');

                if( param.length == 0 ){
                    $('#div_membros').jqxGrid('clearfilters');
                }
            });

            $('#div_membros').on('rowselect',function (evt){
                var idx = evt.args.rowindex;
                var obj = $('#div_membros').jqxGrid('getrowdata', idx );
                obj.id = new Number(obj.id);
                console.log('captura de obj',obj);
                window.mostra_botoes();
                var url=("x-membresia/membresia_info.php?nrid="+obj.id);
                $('#itens').load(url);
            });

            $('.hover').mouseover(function(){
                $(this).addClass('cor_grid');
                $(this).find('input').addClass('cor_grid');
            });
            $('.hover').mouseout(function(){
                $(this).removeClass('cor_grid');
                $(this).find('input').removeClass('cor_grid');
            });



            $('.Info').click(function(e){
                e.stopImmediatePropagation();
                // ini selecionar
                $('.cor_selecionado').removeClass('cor_selecionado');
                $(this).addClass('cor_selecionado');
                $(this).find('input').addClass('cor_selecionado');
                // fim selecionar
                var idi = $(this).find('input').attr('nr_id');
                $('#bt_editar_membro').attr('nr_id',idi);
                $('#bt_novo_membro').attr('nr_id',idi);
                $('#bt_desliga_membro').attr('nr_id',idi);
                $('#bt_filhos').attr('nr_id',idi);
                console.log('clicando info   '+idi);
                var url=("x-membresia/membresia_info.php?nrid="+idi);
                $('#itens').load(url);

            });
            $('#bt_editar_membro').click(function(){
                console.info('Editar Membro');
                window.esconde_botoes();
                var idx = $('#div_membros').jqxGrid('getselectedrowindex');
                if( idx == -1){
                    return custom.informe('SELECIONE UM MEMBRO NO GRID PRIMEIRO');
                }
                var obj = $('#div_membros').jqxGrid('getrowdata', idx );
                var idi = new Number(obj.id);
                console.info('clicando novo membro   '+idi);
                $('#itens').load("x-membresia/membresia_edita.php?nrid="+idi);
            });

            $('#bt_novo_membro').click(function(){
                console.info('Novo Membro');
                window.esconde_botoes();
                //$('#bt_novo_membro').hide();  //esconde botao
                //$('#bt_editar_membro').hide();  //esconde botao
                //var idi = $(this).attr('nr_id');
                var idx = $('#div_membros').jqxGrid('getselectedrowindex');
                if( idx == -1){
                    return custom.informe('SELECIONE UM MEMBRO NO GRID PRIMEIRO');
                }
                var obj = $('#div_membros').jqxGrid('getrowdata', idx );
                var idi = new Number(obj.id);
                //var idi = $(this).attr('nr_id');
                console.info('clicando novo membro   '+idi);
                //$('#itens').load("x-membresia/membresia_novo_popup.php?nrid="+idi);
                $('#itens').load("x-membresia/membresia_novo.php?nrid="+idi);

            });

            $('#bt_desliga_membro').click(function(){
                console.info('Desliga Membro');
                window.esconde_botoes();
                var idx = $('#div_membros').jqxGrid('getselectedrowindex');
                if( idx == -1){
                    return custom.informe('SELECIONE UM MEMBRO NO GRID PRIMEIRO');
                }
                var obj = $('#div_membros').jqxGrid('getrowdata', idx );
                var idi = new Number(obj.id);
                console.info('clicando desligar membro   '+idi);
                $('#itens').load("x-membresia/membresia_desligar_membro.php?nrid="+idi);

            });

             //#bt_filhos,


            $('#bt_filhos').click(function(){
                console.info('Filhos Membro');
                window.esconde_botoes();
                var idx = $('#div_membros').jqxGrid('getselectedrowindex');
                if( idx == -1){
                    return custom.informe('SELECIONE UM MEMBRO NO GRID PRIMEIRO');
                }
                var obj = $('#div_membros').jqxGrid('getrowdata', idx );
                var idi = new Number(obj.id);
                console.info('clicando filhos membro   '+idi);
                $('#itens').load("x-membresia/membros_filhos.php?nrid="+idi);

            });


        };

        membresia.html=function(){
            var $botao = $('<button>').text('Novo Membro').button();
            $botao.attr('id','bt_novo_membro');
            $('#grid').append($botao);

            $('#grid').append('&nbsp;&nbsp;&nbsp;&nbsp;');

            var $botao = $('<button>').text('Editar Membro').button();
            $botao.attr('id','bt_editar_membro');
            $('#grid').append($botao);

            $('#grid').append('&nbsp;&nbsp;&nbsp;&nbsp;');

            var $botao = $('<button>').text('Desligar Membro').button();
            $botao.attr('id','bt_desliga_membro');
            $('#grid').append($botao);

            $('#grid').append('&nbsp;&nbsp;&nbsp;&nbsp;');

            var $botao = $('<button>').text('Filhos do Membro').button();
            $botao.attr('id','bt_filhos');
            $('#grid').append($botao);

        };

    membresia.start(); // EXECUTA A FUNCAO START NA ABERTURA DA PAGINA
</script>