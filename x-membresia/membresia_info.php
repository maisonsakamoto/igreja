<?php
//echo "membresia_info  ";
include"../lib/Formatador.php";
$parametro = @$_REQUEST['nrid'];
// echo "<br>";
//echo $parametro;

include "../bd/conexao.php";   //  vai la, abre banco de dados e retorna com ele aberto
$o = new OpenDB();
$o->server();
$link = $o->server();
$query = "SELECT * FROM membresia where id_membresia=$parametro ";
$dt = mysqli_query($link,$query);
$style="style='background-color: #EEEED1; height: 20px; border:1px;font-family:verdana; font-size: 10px; font-weight:normal'";
//echo "<table>";
$obj= mysqli_fetch_object($dt);
$mem_id=$obj->id_membresia;
$mem_nome=$obj->nome;
  $mem_nome=substr($mem_nome,0,50);
$mem_nascimento=$obj->nascimento;
  if($mem_nascimento<>null){$mem_nascimento=Formatador::dateEmPortugues($mem_nascimento);};
$mem_nascimento_cidade=$obj->nascimento_cidade;
$mem_nascimento_estado=$obj->nascimento_estado;
$mem_estado_civil=$obj->estado_civil;
  if($mem_estado_civil=='1'){$mem_estado_civil='SOLTEIRO';};
  if($mem_estado_civil=='2'){$mem_estado_civil='CASADO';};
  if($mem_estado_civil=='3'){$mem_estado_civil='VIÚVO';};
  if($mem_estado_civil=='4'){$mem_estado_civil='DIVORCIADO';};
  if($mem_estado_civil=='5'){$mem_estado_civil='OUTROS';};
$mem_conjuge=$obj->conjuge;
$mem_casamento=$obj->casamento;
  if($mem_casamento<>null){$mem_casamento=Formatador::dateEmPortugues($mem_casamento);};
$mem_nome_pai=$obj->nome_pai;
$mem_nome_mae=$obj->nome_mae;
$mem_grau_intrucao=$obj->grau_instrucao;
  if($mem_grau_intrucao=='1'){$mem_grau_intrucao='1º GRAU COMPL';};
  if($mem_grau_intrucao=='2'){$mem_grau_intrucao='2º GRAU COMPL';};
  if($mem_grau_intrucao=='3'){$mem_grau_intrucao='SUPERIOR COMPL';};
$mem_endereco=$obj->endereco_rua;
$mem_endereco_nr=$obj->endereco_numero;
$mem_endereco_bairo=$obj->endereco_bairo;
$mem_endereco_cep=$obj->endereco_cep;
$mem_endereco_complemento=$obj->endereco_complemento;
$mem_endereco_cidade=$obj->endereco_cidade;
$mem_endereco_estado=$obj->endereco_estado;
$mem_telefone=$obj->telefone;
$mem_celular=$obj->celular;
$mem_email=$obj->email;
$mem_rede_social=$obj->rede_social;
$mem_trabalho_local=$obj->trabalho_local;
$mem_trabalho_ramo=$obj->trabalho_ramo;
$mem_batismo=$obj->batismo;
   if($mem_batismo=='1'){$mem_batismo='SIM';};
   if($mem_batismo=='2'){$mem_batismo='NÃO';};
$mem_batismo_igreja=$obj->batismo_igreja;
$mem_batismo_data=$obj->batismo_data;
    if($mem_batismo_data<>null){$mem_batismo_data=Formatador::dateEmPortugues($mem_batismo_data);};
$mem_batismo_pastor=$obj->batismo_pastor;
$mem_batismo_cidade=$obj->batismo_cidade;
$mem_batismo_estado=$obj->batismo_estado;
$mem_email=$obj->email;
$mem_tipo=$obj->uso_ibr_membresia;  //  batismo, carta
    if($mem_tipo==null){$recebimento='';};
    if($mem_tipo=='1'){$recebimento='Batismo';};
    if($mem_tipo=='2'){$recebimento='Carta';};
    if($mem_tipo=='3'){$recebimento='Aclamação';};
    if($mem_tipo=='4'){$recebimento='Outro';};
$mem_uso_ibr_data=$obj->uso_ibr_data;
    if($mem_uso_ibr_data<>null){$mem_uso_ibr_data=Formatador::dateEmPortugues($mem_uso_ibr_data);};
$mem_ata=$obj->uso_ibr_ata;
$mem_uso_ibr_pastor=$obj->uso_ibr_pastor;
$mem_uso_ibr_igreja=$obj->uso_ibr_igreja;
$mem_desligamento=$obj->uso_ibr_desligamento;
     if($mem_desligamento<>null){$mem_desligamento=Formatador::dateEmPortugues($mem_desligamento);};
$mem_desligamento_ata=$obj->uso_ibr_desliga_ata;
$mem_desligamento_motivo=$obj->uso_ibr_desliga_motivo;


//echo"<br>";
//echo $mem_nome;
//echo "<input $style  type = 'hidden' nr_id='".$obj->id_membresia."' name ='botao5'  value = '&nbsp;&nbsp;$mem_id'  class='ui-button'></td>";
echo "<input id='id_membresia' $style  type = 'hidden' nr_id='$mem_id' name ='botao5'  value='$mem_id'  class='ui-button'></td>";

?>
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
        width: 120px;
        height: 15px;
        line-height: 15px;
    }

    .fieldsetnew {
        display: inline-block;
        /*horizontal-align: left;*/
        vertical-align: top; /* Alinha os fieldsets no topo */
        height: 30px;
    }
    .hide{ display: none;}
    label3 {font: 12px verdana; height: 15px; color: #191970; text-align: left; background: bisque; padding-left: 5px;}  /* label dos checks box */
    h1 {font: 12px verdana; height: 15px; color: #191970; text-align: left; background: bisque; padding-left: 5px;}
    h2 {font: 12px verdana; height: 15px; color: black; text-align: left; background: #b4eeb4; padding-left: 5px; width: 100px;}  /*  ALINHA ESQUERDA  */
    h3 {font: 12px verdana; height: 15px; color: black; text-align: center; background: #b4eeb4; padding-left: 5px; width: 100px;}  /*  ALINHA CENTRO  */

    #bt_proximo:hover, #bt_voltar:hover{cursor: pointer; background: #CFCFCF; color: blue; font-weight: bold; border: 0px;}
    #bt_proximo, #bt_voltar{background: #CFCFCF; width: 110px; font: 12px verdana; height: 30px; color: black; border: 0px;  }
    #bt_proximo, #bt_voltar{float: right; margin-right: 10px;}

  </style>
  <div id="tela01" style="height: 618px; ">
    <div style="height:12px;"> </div> <!--   */ espaço entre fieldsets -->
    <div1 style="width: 675px; border: 0px; padding-left: 1; " >
        <fieldset class="fieldsetnew" style="width:386px;">
        <legend  class="ui-widget ui-widget-header ui-corner-all" >Nome do Membro</legend>
        <h1> <?php echo $mem_nome  ?> </h1>
        </fieldset>
        <fieldset  class="fieldsetnew" style="width:210px;">
            <legend  class="ui-widget ui-widget-header ui-corner-all" style="width:80px;">Nascimento</legend>
            <h1 style="text-align: center; "> <?php echo $mem_nascimento?> </h1>
        </fieldset>
    </div1>


    <div2 style="width: 675px; border: 0px; padding-left: 1; " >
        <div style="height:5px;"> </div> <!--   */ espaço entre fieldsets -->
        <fieldset class="fieldsetnew" style="width:310px;">
        <legend  class="ui-widget ui-widget-header ui-corner-all" style="width:120px;" >Cidade Nascimento</legend>
        <h1> <?php echo $mem_nascimento_cidade  ?> </h1>
        </fieldset>
        <fieldset  class="fieldsetnew" style="width:40px;">
            <legend  class="ui-widget ui-widget-header ui-corner-all" style="width:30px;">UF</legend>
            <h1 style="text-align: center; "> <?php echo $mem_nascimento_estado  ?> </h1>
        </fieldset>

        <fieldset  class="fieldsetnew" style="width:210px;">
            <legend  class="ui-widget ui-widget-header ui-corner-all" style="width:80px;">C E P Atual</legend>
            <h1 style="text-align: center; "> <?php echo $mem_endereco_cep ?> </h1>
        </fieldset>
    </div2>

    <div3 style="width: 675px; border: 0px; padding-left: 1; " >
        <div style="height:5px;"> </div> <!--   */ espaço entre fieldsets -->
        <fieldset class="fieldsetnew" style="width:310px;">
        <legend  class="ui-widget ui-widget-header ui-corner-all" style="width:130px;" >Endereço Residencial </legend>
        <h1> <?php echo $mem_endereco  ?> </h1>
        </fieldset>
        <fieldset  class="fieldsetnew" style="width:40px;">
            <legend  class="ui-widget ui-widget-header ui-corner-all" style="width:30px;">Nr</legend>
            <h1 style="text-align: center; "> <?php echo $mem_endereco_nr  ?> </h1>
        </fieldset>
        <fieldset  class="fieldsetnew" style="width:210px;">
            <legend  class="ui-widget ui-widget-header ui-corner-all" style="width:50px;">Bairro</legend>
            <h1 style="text-align: center; "> <?php echo $mem_endereco_bairo ?> </h1>
        </fieldset>
    </div3>

    <div4 style="width: 675px; border: 0px; padding-left: 1; " >
        <div style="height:5px;"> </div> <!--   */ espaço entre fieldsets -->
        <fieldset class="fieldsetnew" style="width:310px;">
        <legend  class="ui-widget ui-widget-header ui-corner-all" style="width:130px;" >Complemento </legend>
        <h1 style="text-align: left;"> <?php echo $mem_endereco_complemento  ?> </h1>
        </fieldset>
        <fieldset  class="fieldsetnew" style="width:210px;">
            <legend  class="ui-widget ui-widget-header ui-corner-all" style="width:80px;">Cidade</legend>
            <h1 style="text-align: center; "> <?php echo $mem_endereco_cidade ?> </h1>
        </fieldset>
        <fieldset  class="fieldsetnew" style="width:40px;">
            <legend  class="ui-widget ui-widget-header ui-corner-all" style="width:30px;">UF</legend>
            <h1 style="text-align: center; "> <?php echo $mem_endereco_estado ?> </h1>
        </fieldset>
    </div4>

    <div5 style="width: 675px; border: 0px; padding-left: 1; " >
        <div style="height:5px;"> </div> <!--   */ espaço entre fieldsets -->
        <fieldset class="fieldsetnew" style="width:132px;">
        <legend  class="ui-widget ui-widget-header ui-corner-all" style="width:90px;" >Estado Civil </legend>
        <h1 style="text-align: center;"> <?php echo $mem_estado_civil  ?> </h1>
        </fieldset>
        <fieldset  class="fieldsetnew" style="width:130px;">
            <legend  class="ui-widget ui-widget-header ui-corner-all" style="width:100px;">Dados Escolar</legend>
            <h1 style="text-align: center; "> <?php echo $mem_grau_intrucao ?> </h1>
        </fieldset>
        <fieldset  class="fieldsetnew" style="width:130px;">
            <legend  class="ui-widget ui-widget-header ui-corner-all" style="width:80px;">Fone Fixo</legend>
            <h1 style="text-align: center; "> <?php echo $mem_telefone ?> </h1>
        </fieldset>
        <fieldset  class="fieldsetnew" style="width:130px;">
            <legend  class="ui-widget ui-widget-header ui-corner-all" style="width:80px;">Celular</legend>
            <h1 style="text-align: center; "> <?php echo $mem_celular ?> </h1>
        </fieldset>

    </div5>

    <div6 style="width: 675px; border: 0px; padding-left: 1; " >
        <div style="height:5px;"> </div> <!--   */ espaço entre fieldsets -->
        <fieldset class="fieldsetnew" style="width:298px;">
        <legend  class="ui-widget ui-widget-header ui-corner-all" style="width:60px;" >Email </legend>
        <h1 style="text-align: left;"> <?php echo $mem_email  ?> </h1>
        </fieldset>
        <fieldset  class="fieldsetnew" style="width:298px;">
            <legend  class="ui-widget ui-widget-header ui-corner-all" style="width:80px;">Rede Social</legend>
            <h1 style="text-align: left; "> <?php echo $mem_rede_social ?> </h1>
        </fieldset>
    </div6>

    <div7 style="width: 675px; border: 0px; padding-left: 1; " >
        <div style="height:5px;"> </div> <!--   */ espaço entre fieldsets -->
        <fieldset class="fieldsetnew" style="width:386px;">
        <legend  class="ui-widget ui-widget-header ui-corner-all"   style="width:110px;">Nome Conjuge</legend>
        <h1 style="text-align: left;"> <?php echo $mem_conjuge  ?> </h1>
        </fieldset>
        <fieldset  class="fieldsetnew" style="width:210px;">
            <legend  class="ui-widget ui-widget-header ui-corner-all" style="width:110px;">Data Casamento</legend>
            <h1 style="text-align: center; "> <?php echo $mem_casamento?> </h1>
        </fieldset>
    </div7>

    <div8 style="width: 675px; border: 0px; padding-left: 1; " >
        <div style="height:5px;"> </div> <!--   */ espaço entre fieldsets -->
        <fieldset class="fieldsetnew" style="width:298px;">
        <legend  class="ui-widget ui-widget-header ui-corner-all"  style="width:80px;">Nome Pai</legend>
        <h1 style="text-align: left;"> <?php echo $mem_nome_pai  ?> </h1>
        </fieldset>
        <fieldset  class="fieldsetnew" style="width:298px;">
            <legend  class="ui-widget ui-widget-header ui-corner-all" style="width:80px;">Nome Mãe</legend>
            <h1 style="text-align: left; "> <?php echo $mem_nome_mae?> </h1>
        </fieldset>
    </div8>

    <div9 style="width: 675px; border: 0px; padding-left: 1; " >
        <div style="height:5px;"> </div> <!--   */ espaço entre fieldsets -->
        <fieldset class="fieldsetnew" style="width:298px;">
        <legend  class="ui-widget ui-widget-header ui-corner-all"  style="width:80px;">Local Trabalho</legend>
        <h1 style="text-align: left;"> <?php echo $mem_trabalho_local  ?> </h1>
        </fieldset>
        <fieldset  class="fieldsetnew" style="width:298px;">
            <legend  class="ui-widget ui-widget-header ui-corner-all" style="width:80px;">Ramo</legend>
            <h1 style="text-align: left; "> <?php echo $mem_trabalho_ramo?> </h1>
        </fieldset>
    </div9>


    <div id="itens222" style="background: bisque; height: 5px; width: 380px;float: right;">
    </div>
    <div style="background: bisque; height: 74px; width: 380px;float: right;"> </div> <!-- ESPAÇO PARA BOTAO PROXIMO-->
    <div id="grid222" style="border: 0px solid yellowgreen; margin:0 auto; padding-top: 0px; height: 40px; width: 680px; float: center; overflow: auto; text-align: right; background: bisque;">
         <?php //include "../bancodados\conexaomysqlproducao.php";?>
        <button id="bt_proximo">Proximo</button>
    </div>
</div>
<div id="tela02" class="hide" style="height: 618px;">
    <div10 style="width: 675px; border: 0px; padding-left: 1; " >
        <div style="height:5px;"> </div> <!--   */ espaço entre fieldsets -->
        <fieldset class="fieldsetnew" style="width:633px; height: 110px;">
            <legend  class="ui-widget ui-widget-header ui-corner-all" style="width:200px; margin: auto; background: red; border: 0px;">Dados Eclesiásticos</legend>
            <fieldset class="fieldsetnew" style="width:40px;">
            <legend  class="ui-widget ui-widget-header ui-corner-all" style="width:50px;" >Batismo </legend>
            <h1 style="text-align: center;"> <?php echo $mem_batismo  ?> </h1>
            </fieldset>
            <fieldset  class="fieldsetnew" style="width:100px;">
                <legend  class="ui-widget ui-widget-header ui-corner-all" style="width:80px;">Data Batismo</legend>
                <h1 style="text-align: center; "> <?php echo $mem_batismo_data ?> </h1>
            </fieldset>
            <fieldset  class="fieldsetnew" style="width:368px;">
                <legend  class="ui-widget ui-widget-header ui-corner-all" style="width:130px;">Batismo Igreja</legend>
                <h1 style="text-align: center; "> <?php echo $mem_batismo_igreja ?> </h1>
            </fieldset>
            <div style="height:1px;"> </div> <!--   */ espaço entre fieldsets -->
            <fieldset class="fieldsetnew" style="width:275px;">
            <legend  class="ui-widget ui-widget-header ui-corner-all" style="width:130px;" >Batismo Pastor </legend>
            <h1 style="text-align: left;"> <?php echo $mem_batismo_pastor  ?> </h1>
            </fieldset>
            <fieldset  class="fieldsetnew" style="width:210px;">
                <legend  class="ui-widget ui-widget-header ui-corner-all" style="width:80px;">Cidade</legend>
                <h1 style="text-align: center; "> <?php echo $mem_batismo_cidade ?> </h1>
            </fieldset>
            <fieldset  class="fieldsetnew" style="width:40px;">
                <legend  class="ui-widget ui-widget-header ui-corner-all" style="width:30px;">UF</legend>
                <h1 style="text-align: center; "> <?php echo $mem_batismo_estado ?> </h1>
            </fieldset>
        </fieldset>
    </div10>

    <div11 style="width: 675px; border: 0px; padding-left: 1; " >
        <div style="height:5px;"> </div> <!--   */ espaço entre fieldsets -->
        <fieldset class="fieldsetnew" style="width:633px; height: 110px;">
            <legend  class="ui-widget ui-widget-header ui-corner-all" style="width:200px; margin: auto; background: red; border: 0px;">Recebimento do Membro</legend>
            <div style="height:1px;"> </div> <!--   */ espaço entre fieldsets -->

            <fieldset class="fieldsetnew" style="width:175px;">
            <legend  class="ui-widget ui-widget-header ui-corner-all" style="width:80px;" >Recebido </legend>
            <h1 style="text-align: left;"> <?php echo $recebimento  ?> </h1>
            </fieldset>
            <fieldset class="fieldsetnew" style="width:175px;">
            <legend  class="ui-widget ui-widget-header ui-corner-all" style="width:60px;" >Data </legend>
            <h1 style="text-align: center;"> <?php echo $mem_uso_ibr_data  ?> </h1>
            </fieldset>
            <fieldset  class="fieldsetnew" style="width:175px;">
                <legend  class="ui-widget ui-widget-header ui-corner-all" style="width:60px;">Ata</legend>
                <h1 style="text-align: center; "> <?php echo $mem_ata ?> </h1>
            </fieldset>

            <div style="height:1px;"> </div> <!--   */ espaço entre fieldsets -->

            <fieldset class="fieldsetnew" style="width:278px;">
            <legend  class="ui-widget ui-widget-header ui-corner-all" style="width:80px;" >Pastor </legend>
            <h1 style="text-align: left;"> <?php echo $mem_uso_ibr_pastor  ?> </h1>
            </fieldset>
            <fieldset  class="fieldsetnew" style="width:278px;">
                <legend  class="ui-widget ui-widget-header ui-corner-all" style="width:80px;">Igreja</legend>
                <h1 style="text-align: center; "> <?php echo $mem_uso_ibr_igreja ?> </h1>
            </fieldset>

        </fieldset>
    </div11>

    <div12 style="width: 675px; border: 0px; padding-left: 1; " >
        <div style="height:15px;"> </div> <!--   */ espaço entre fieldsets -->
        <fieldset class="fieldsetnew" style="width:633px; height: 115px; background: #FAEBD7;">
            <legend  class="ui-widget ui-widget-header ui-corner-all" style="width:200px; margin: auto; background: red; border: 0px; background: black; color: white;">Desligamento do Membro</legend>
            <div style="height:1px;"> </div> <!--   */ espaço entre fieldsets -->

            <fieldset class="fieldsetnew" style="width:175px;  background: #FAEBD7; float: left; margin-left: 7px;">
            <legend  class="ui-widget ui-widget-header ui-corner-all" style="width:120px; background: black;" >Data Desligamento </legend>
            <h1 style="text-align: center;  background: #FAEBD7;" > <?php echo $mem_desligamento  ?> </h1>
            </fieldset>


            <!--<fieldset class="fieldsetnew" style="width:170px; border: 0px;">
            <legend  class="ui-widget ui-widget-header ui-corner-all" style="width:0px; background: black; width: 0px;" > </legend>
            <h1 style="text-align: left;  background: #FAEBD7;"> <?php //echo $mem_uso_ibr_data  ?> </h1>
            </fieldset>   -->

            <fieldset  class="fieldsetnew" style="width:175px; float: right; margin-right: 7px">
                <legend  class="ui-widget ui-widget-header ui-corner-all" style="width:120px; background: black;">Ata Desligamento</legend>
                <h1 style="text-align: center;  background: #FAEBD7; "> <?php echo $mem_desligamento_ata ?> </h1>
            </fieldset>

            <div style="height:53px; border: '1px'; border-color: blue;"> </div> <!--   */ espaço entre fieldsets -->

            <fieldset class="fieldsetnew" style="width:592px;">
            <legend  class="ui-widget ui-widget-header ui-corner-all" style="width:80px; background: black;" >Motivo </legend>
            <h1 style="text-align: left;  background: #FAEBD7;"> <?php echo $mem_desligamento_motivo  ?> </h1>
            </fieldset>


        </fieldset>
    </div12>


    <div id="itens222" style="background: bisque; height: 5px; width: 380px;float: right;"> </div>
    <div style="background: bisque; height: 153px; width: 380px;float: right;"> </div> <!-- ESPAÇO PARA BOTAO PROXIMO-->
    <div id="grid222" style="border: 0px solid blue; margin:0 auto; padding-top: 0px; height: 40px; width: 680px; float: center; overflow: auto; text-align: right; background: bisque">
         <?php //include "../bancodados\conexaomysqlproducao.php";?>
        <button id="bt_voltar">Anterior</button>
    </div>

  </div>

<script type="text/javascript">

    var mem_info = {};

    mem_info.start=function(){
        //mem_info.html();
        mem_info.eventos(); // EXECUTA A FUNCAO EVENTOS, CONFIGURA OQUE OS CLIQUES IRÁ FAZER
    };


        mem_info.eventos=function(){
            $('#bt_proximo').click(function(){
                $('#tela01').addClass('hide');
                $('#tela02').removeClass('hide');
            });

            $('#bt_voltar').click(function(){
                $('#tela02').addClass('hide');
                $('#tela01').removeClass('hide');
            });

         //   $('#bt_exclusivo').click(function(){
         //       console.info('Editar Membro');

         //       //$('#bt_exclusivo').hide();  //esconde botao
         //       //$('#bt_filhos').hide();  //esconde botao
         //       //var idi = $(this).attr('nr_id');
         //       var idi = $(this).attr('nr_id');
         //       console.log(idi);
         //       var url=("x-membresia/membresia_edita.php?nrid="+idi);
         //       $('#itens222').load(url);
         //   });

            /*
            $('#bt_proximo').click(function(){
                console.info('proximo');
                //$parametro
                var idi = $("#id_membresia").attr('nr_id');
                ///$('#bt_proximo').attr('nr_id',idi);
                console.log('clicando info   '+idi);
                var url=("x-membresia/membresia_info2.php?nrid="+idi);

                //$('#bt_novo_membro').hide();  //esconde botao
                //$('#bt_editar_membro').hide();  //esconde botao
                //$('#grid222').clear();
                //mem_info.getElementById('grid222').innerHTML = "";
                //document.getElementById("minhaDiv").innerHTML = "";

                //$('#gri222').innerhtml="";
                $('#itens').load(url);

            });  */



        };

        /*mem_info.html=function(){
            var $botao = $('<button>').text('Proximo').button();
            var $botao_voltar = $('<button>').text('Proximo').button();
            $botao.attr('id','bt_proximo');
            $('#grid222').append('&nbsp;&nbsp;&nbsp;&nbsp;');
            $('#grid222').append($botao);
            $('#grid222').append('&nbsp;&nbsp;&nbsp;&nbsp;');
            //var $botao = $('<button>').text('espaco').button();
            //$botao.attr('id','bt_espaco');
            //$('#grid').append($botao);
            //$('#grid222').append('&nbsp;&nbsp;&nbsp;&nbsp;');


           // var $botao = $('<button>').text('Exclusivo').button();
           // $botao.attr('id','bt_exclusivo');
           // $('#grid222').append($botao);


        };*/

    mem_info.start(); // EXECUTA A FUNCAO START NA ABERTURA DA PAGINA
</script>