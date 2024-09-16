<!--

  NAO UTILIZAR MAIS ESSE ARQUIVO
    UTILIZE MEMBRESIA_NOVO.PHP

-->
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
        /*horizontal-align: left;*/
        vertical-align: top; /* Alinha os fieldsets no topo */
        height: 35px;
    }
    .fieldsetgrupo {
        display: inline-block;
        /*horizontal-align: left;*/
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
    .ui-widget-header{font-family: verdana; font-size: 9pt; background: #191970; text-align: center; }
    .ui-dialog .ui-dialog-title{ float: none; text-align: center; }
    .titulo{font-family: verdana; font-size: 9pt; color: white; background: red; border-color: #191970; /*align: center;*/}


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
    function validarEntradaestadocivil(event) {
        const input = event.target;
        const valor = input.value;
        if (valor !== '1' && valor !== '2' && valor !== '3' && valor !== '4' && valor !== '5') {
            alert("Por favor, digite apenas '1' à '5'.\nPasse mouse sobre coluna para ver opçoes");
            input.value = '';
        }
    }
    function validarEntradaInstrucao(event) {
        const input = event.target;
        const valor = input.value;
        if (valor !== '1' && valor !== '2' && valor !== '3') {
            alert("Por favor, digite apenas '1' à '3'.\nPasse mouse sobre coluna para ver opçoes");
            input.value = '';
        }
    }
    function validarEntradaMembresia(event) {
        const input = event.target;
        const valor = input.value;
        if (valor !== '1' && valor !== '2' && valor !== '3' && valor !== '4') {
            alert("Por favor, digite apenas '1' à '4'.\nPasse mouse sobre coluna para ver opçoes");
            input.value = '';
        }
    }
    function validarEntradaBatismo(event) {
        const input = event.target;
        const valor = input.value;
        if (valor !== '1' && valor !== '2' && valor ) {
            alert("Por favor, digite apenas '1' ou '2'.\nPasse mouse sobre coluna para ver opçoes");
            input.value = '';
        }
    }


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
        if($primeiro==0){
            $primeiro=1;
            echo "<input id='grupo_id' type='hidden' value=$membro_id>";
        }
        $nome_membro=$obj->nome;
        $nome_membro=substr($nome_membro,0,25);

        echo "<tr $style>";
           //   echo "<td>"; echo $membro; echo "</td>"; echo "<td>"; echo $nome_membro; echo "</td>";
        echo "</tr>";

        echo "<input type='hidden' id='nome_membro' value='$nome_membro'/>";
    }
    echo "</table>";
?>
<div id="new_pop-up" class="ui-widget-content ui-corner-all pop-up" style="display: block;">

    <div class="entre_linhas"> </div> <!--   */ espaço entre fieldsets -->

    <div1 style="width: 675px; border: 0px; padding-left: 1; " >
        <fieldset class="fieldsetnew" style="width:458px;">
        <legend  class="ui-widget ui-widget-header ui-corner-all" >Nome do Membro</legend>
        <input  type="mem_nome" id="mem_nome" name="mem_nome" style="width: 455px;" maxlength="50">
        </fieldset>
        <fieldset  class="fieldsetnew" style="width:210px;">
            <legend  class="ui-widget ui-widget-header ui-corner-all" style="width:80px;">Nascimento</legend>
            <input  type="mem_nascimento" id="mem_nascimento" name="mem_nascimento" alt="date" style="width: 210px;">  <!-- alt="date" coloca mascara de data, pega do jquery-meiomask.js -->
        </fieldset>
    </div1>


    <div2 style="width: 675px; border: 0px; padding-left: 1; " >
        <div class="entre_linhas"> </div> <!--   */ espaço entre fieldsets -->
        <fieldset class="fieldsetnew" style="width:310px;">
        <legend  class="ui-widget ui-widget-header ui-corner-all" style="width:150px;" >Cidade Nascimento</legend>
        <input  type="mem_nasc_cidade" id="mem_nasc_cidade" name="mem_nasc_cidade" style="width: 370px;" maxlength="30">
        </fieldset>
        <fieldset  class="fieldsetnew" style="width:40px;">
            <legend  class="ui-widget ui-widget-header ui-corner-all" style="width:30px;" >UF</legend>
            <input  type="mem_nasc_estado" id="mem_nasc_estado" name="mem_nasc_estado" maxlength="2" style="width: 60px;">
        </fieldset>
        <fieldset  class="fieldsetnew" style="width:208px;">
            <legend  class="ui-widget ui-widget-header ui-corner-all" style="width:80px;">C E P Atual</legend>
            <input  type="mem_endereco_cep" id="mem_endereco_cep" name="mem_endereco_cep" alt="cep" maxlength="12" style="width: 210px;">
        </fieldset>
    </div2>

    <div3 style="width: 675px; border: 0px; padding-left: 1; " >
        <div style="height:1px;"> </div> <!--   */ espaço entre fieldsets -->
        <fieldset class="fieldsetnew" style="width:310px;">
            <legend  class="ui-widget ui-widget-header ui-corner-all" style="width:130px;" >Endereço Residencial </legend>
            <input  type="mem_endereco" id="mem_endereco" name="mem_endereco" style="width: 370px;" maxlength="50">
        </fieldset>
        <fieldset  class="fieldsetnew" style="width:40px;">
            <legend  class="ui-widget ui-widget-header ui-corner-all" style="width:30px;">Nr</legend>
            <input  type="mem_endereco_nr" id="mem_endereco_nr" name="mem_endereco_nr"  alt="numero"  style="width: 60px;">
        </fieldset>
        <fieldset  class="fieldsetnew" style="width:208px;">
            <legend  class="ui-widget ui-widget-header ui-corner-all" style="width:50px;">Bairro</legend>
            <input  type="mem_endereco_bairro" id="mem_endereco_bairro" name="mem_endereco_bairro"  maxlength="50" style="width: 210px;" maxlength="50">
        </fieldset>
    </div3>

    <div4 style="width: 675px; border: 0px; padding-left: 1; " >
       <div style="height:1px;"> </div> <!--   */ espaço entre fieldsets -->
       <fieldset class="fieldsetnew" style="width:290px;">
       <legend  class="ui-widget ui-widget-header ui-corner-all" style="width:130px;" >Complemento </legend>
       <input  type="mem_endereco_complemento" id="mem_endereco_complemento" name="mem_endereco_complemento"  maxlength="50" style="width: 290px;">
       </fieldset>
       <fieldset  class="fieldsetnew" style="width:290px;">
           <legend  class="ui-widget ui-widget-header ui-corner-all" style="width:80px;">Cidade</legend>
           <input  type="mem_endereco_cidade" id="mem_endereco_cidade" name="mem_endereco_cidade"  maxlength="30" style="width: 290px;">
       </fieldset>
       <fieldset  class="fieldsetnew" style="width:60px;">
           <legend  class="ui-widget ui-widget-header ui-corner-all" style="width:30px;">UF</legend>
           <input  type="mem_endereco_estado" id="mem_endereco_estado" name="mem_endereco_estado"  maxlength="2" style="width: 60px;">
        </fieldset>

    </div4>

<div5 style="width: 675px; border: 0px; padding-left: 1; " >
    <div style="height:1px;"> </div> <!--   */ espaço entre fieldsets -->

     <fieldset class="fieldsetnew tooltip" style="width:160px;">
    <legend  class="ui-widget ui-widget-header ui-corner-all" style="width:90px;" >Estado Civil </legend>
    <input type="mem_estado_civil" id="mem_estado_civil" name="mem_estado_civil"  maxlength="1" alt="numerounico" pattern="[12345]" oninput="validarEntradaestadocivil(event)"  style="width: 158px;">
    <span class="tooltiptext">&nbsp 1 para Solteiro<br>&nbsp 2 para Casado<br>&nbsp 3 para Viúvo<br>&nbsp 4 para Divorciado<br>&nbsp 5 para Outro</span>
    </fieldset>
    <fieldset  class="fieldsetnew tooltip" style="width:160px;">
        <legend  class="ui-widget ui-widget-header ui-corner-all" style="width:100px;">Dados Escolar</legend>
        <input  type="mem_grau_instruao" id="mem_grau_instrucao" name="mem_grau_instruao"  maxlength="1" alt="numerounico" pattern="[123]" oninput="validarEntradaInstrucao(event)" style="width: 158px;">
        <span class="tooltiptext">&nbsp 1 para 1º Grau<br>&nbsp 2 para 2º grau<br>&nbsp 3 para Superior Completo</span>
    </fieldset>



    <fieldset  class="fieldsetnew" style="width:145px;">
        <legend  class="ui-widget ui-widget-header ui-corner-all" style="width:80px;">Fone Fixo</legend>
        <input  type="mem_telefone" id="mem_telefone" name="mem_telefone" alt="phone" maxlength="12" style="width: 144px;">
    </fieldset>
    <fieldset  class="fieldsetnew" style="width:145px;">
        <legend  class="ui-widget ui-widget-header ui-corner-all" style="width:80px;">Celular</legend>
        <input  type="mem_celular" id="mem_celular" name="mem_celular" alt="celular" maxlength="12" maxlength="12" style="width: 144px;">
    </fieldset>

</div5>

<div6 style="width: 675px; border: 0px; padding-left: 1; " >
    <div style="height:1px;"> </div> <!--   */ espaço entre fieldsets -->
    <fieldset class="fieldsetnew" style="width:335px;">
    <legend  class="ui-widget ui-widget-header ui-corner-all" style="width:60px;" >Email </legend>
    <input  type="mem_email" id="mem_email" name="mem_email" maxlength="50" style="width: 335px;">
    </fieldset>
    <fieldset  class="fieldsetnew" style="width:335px;">
        <legend  class="ui-widget ui-widget-header ui-corner-all" style="width:80px;">Rede Social</legend>
        <input  type="mem_rede_social" id="mem_rede_social" name="mem_rede_social" maxlength="50" style="width: 335px;">
    </fieldset>
</div6>


<div7 style="width: 675px; border: 0px; padding-left: 1; " >
    <div style="height:1px;"> </div> <!--   */ espaço entre fieldsets -->
    <fieldset class="fieldsetnew" style="width:460px;">
    <legend  class="ui-widget ui-widget-header ui-corner-all"   style="width:110px;">Nome Conjuge</legend>
    <input  type="mem_conjuge" id="mem_conjuge" name="mem_conjuge" maxlength="50" style="width: 460px;">
    </fieldset>
    <fieldset  class="fieldsetnew" style="width:210px;">
        <legend  class="ui-widget ui-widget-header ui-corner-all" style="width:110px;">Data Casamento</legend>
        <input  type="mem_casamento" id="mem_casamento" name="mem_casamento" alt="date" style="width: 210px;">
    </fieldset>
</div7>

<div8 style="width: 675px; border: 0px; padding-left: 1; " >
    <div style="height:1px;"> </div> <!--   */ espaço entre fieldsets -->
    <fieldset class="fieldsetnew" style="width:335px;">
    <legend  class="ui-widget ui-widget-header ui-corner-all"  style="width:80px;">Nome Pai</legend>
    <input  type="mem_nome_pai" id="mem_nome_pai" name="mem_nome_pai"maxlength="50" style="width: 335px;">
    </fieldset>
    <fieldset  class="fieldsetnew" style="width:335px;">
        <legend  class="ui-widget ui-widget-header ui-corner-all" style="width:80px;">Nome Mãe</legend>
            <input  type="mem_nome_mae" id="mem_nome_mae" name="mem_nome_mae"maxlength="50" style="width: 335px;">
    </fieldset>
</div8>

<div9 style="width: 675px; border: 0px; padding-left: 1; " >
    <div style="height:1px;"> </div> <!--   */ espaço entre fieldsets -->
    <fieldset class="fieldsetnew" style="width:335px;">
    <legend  class="ui-widget ui-widget-header ui-corner-all"  style="width:120px;">Local Trabalho</legend>
    <input  type="mem__trabalho_local" id="mem_trabalho_local" name="mem_trabalho_local" maxlength="50" style="width: 335px;">
    </fieldset>
    <fieldset  class="fieldsetnew" style="width:335px;">
        <legend  class="ui-widget ui-widget-header ui-corner-all" style="width:80px;">Ramo</legend>
        <input  type="mem__trabalho_ramo" id="mem_trabalho_ramo" name="mem_trabalho_ramo"maxlength="30" style="width: 335px;">
    </fieldset>
</div9>

<div10 style="width: 675px; border: 0px; padding-left: 1; " >
    <div style="height:5px;"> </div> <!--   */ espaço entre fieldsets -->
    <fieldset  class="fieldsetgrupo" style="width:700px; height: 115px; ">
        <legend  class="ui-widget ui-widget-header ui-corner-all" style="width:200px; margin: auto; background: red; border: 0px;">Dados Eclesiásticos</legend>


        <fieldset  class="fieldsetnew tooltip" style="width:95px;">
            <legend  class="ui-widget ui-widget-header ui-corner-all" style="width:100px;">Batismo</legend>
            <input  type="mem_batisao_nao_batizado" id="mem_batisao_nao_batizado" name="mem_batisao_nao_batizado"  maxlength="1" alt="numerounico" pattern="[12]" oninput="validarEntradaBatismo(event)" style="width: 100px;">
            <span class="tooltiptext">&nbsp 1 - para Batizado<br>&nbsp 2 - para Não Batizado</span>
        </fieldset>

        <fieldset  class="fieldsetnew" style="width:150px;">
            <legend  class="ui-widget ui-widget-header ui-corner-all" style="width:110px;">Data Batismo</legend>
            <input  type="mem_dt_batismo" id="mem_dt_batismo" name="mem_dt_batismo" alt="date" style="width: 150px;">  <!-- alt="date" coloca mascara de data, pega do jquery-meiomask.js -->
        </fieldset>
        <fieldset  class="fieldsetnew" style="width:323px;">
            <legend  class="ui-widget ui-widget-header ui-corner-all" style="width:130px;">Batismo Igreja</legend>
            <input  type="mem_batismo_igreja" id="mem_batismo_igreja" name="mem_batismo_igreja"maxlength="50" style="width: 358px;">
        </fieldset>
        <div style="height:1px;"> </div> <!--   */ espaço entre fieldsets -->

            <div style="height:1px;"> </div> <!--   */ espaço entre fieldsets -->
            <fieldset class="fieldsetnew" style="width:275px;">
            <legend  class="ui-widget ui-widget-header ui-corner-all" style="width:130px;" >Batismo Pastor </legend>
            <input  type="mem_batismo_pastor" id="mem_batismo_pastor" name="mem_batismo_pastor"maxlength="50" style="width: 322px;">
            </fieldset>
            <fieldset  class="fieldsetnew" style="width:210px;">
                <legend  class="ui-widget ui-widget-header ui-corner-all" style="width:80px;">Cidade</legend>
                <input  type="mem_batismo_cidade" id="mem_batismo_cidade" name="mem_batismo_cidade"maxlength="50" style="width: 232px;">
            </fieldset>
            <fieldset  class="fieldsetnew" style="width:40px;">
                <legend  class="ui-widget ui-widget-header ui-corner-all" style="width:30px;">UF</legend>
                <input  type="mem_batismo_estado" id="mem_batismo_estado" name="mem_batismo_estado"  maxlength="2" style="width: 60px;">
            </fieldset>
        </fieldset>
    </fieldset>
</div10>

<div11 style="width: 675px; border: 0px; padding-left: 1; " >
    <div style="height:5px;"> </div> <!--   */ espaço entre fieldsets -->
    <fieldset class="fieldsetgrupo" style="width:700px; height: 115px;">
        <legend  class="ui-widget ui-widget-header ui-corner-all" style="width:200px; margin: auto; background: red; border: 0px;">Recebimento do Membro</legend>
        <div style="height:1px;"> </div> <!--   */ espaço entre fieldsets -->

        <fieldset class="fieldsetnew tooltip" style="width:175px;">
        <legend  class="ui-widget ui-widget-header ui-corner-all" style="width:80px;" >Recebido </legend>
            <input type="mem_tipo_recebido" id="mem_tipo_recebido" name="mem_tipo_recebido"  maxlength="1" alt="numerounico" pattern="[1234]" oninput="validarEntradaMembresia(event)"  style="width: 204px;">
            <span class="tooltiptext">&nbsp 1 para Batismo<br>&nbsp 2 para Carta<br>&nbsp 3 para Aclamação<br>&nbsp 4 para Outro</span>
        </fieldset>
        <fieldset class="fieldsetnew" style="width:175px;">
        <legend  class="ui-widget ui-widget-header ui-corner-all" style="width:110px;" >Data </legend>
        <input  type="mem_uso_ibr_data" id="mem_uso_ibr_data" name="mem_uso_ibr_data" alt="date" style="width: 204px;">  <!-- alt="date" coloca mascara de data, pega do jquery-meiomask.js -->
        </fieldset>
        <fieldset  class="fieldsetnew" style="width:175px;">
            <legend  class="ui-widget ui-widget-header ui-corner-all" style="width:60px;">Ata</legend>
            <input  type="mem_ata_batismo" id="mem_ata_batismo" name="mem_ata_batismo"maxlength="50" style="width: 204px;">
        </fieldset>

        <div style="height:1px;"> </div> <!--   */ espaço entre fieldsets -->

        <fieldset class="fieldsetnew" style="width:278px;">
        <legend  class="ui-widget ui-widget-header ui-corner-all" style="width:80px;" >Pastor </legend>
        <input  type="mem_uso_ibr_pastor" id="mem_uso_ibr_pastor" name="mem_uso_ibr_pastor"maxlength="50" style="width: 321px;">
        </fieldset>
        <fieldset  class="fieldsetnew" style="width:278px;">
            <legend  class="ui-widget ui-widget-header ui-corner-all" style="width:80px;">Igreja</legend>
            <input  type="mem_uso_ibr_igreja" id="mem_uso_ibr_igreja" name="mem_uso_ibr_igreja"maxlength="50" style="width: 321px;">
        </fieldset>

    </fieldset>
</div11>


    <div id="pop-upCorpo" style="text-align: center;"></div>
</div>

<script type="text/javascript">


    var mem_novo_popup = {};
    var $dialog = $("#new_pop-up");

    mem_novo_popup.start=function(){

      // $(document).ready(function(){
          $("*").setMask();
           //$("#nascimento").datepicker();
      // });

        mem_novo_popup.eventos(); // EXECUTA A FUNCAO EVENTOS, CONFIGURA OQUE OS CLIQUES IRÁ FAZER
            $dialog.dialog({
            width: 760,
            height: 830,
            modal: true,
            title: 'CADASTRO NOVO MEMBRO',
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
    mem_novo_popup.eventos=function(){};

            $("#pop-upCorpo").empty();
            var id_membro = $("#idnome").val();
            var membro = $("#nome_membro").val();

    //        console.info('id   '+id_membro);
    //        console.info('grupo  '+membro);

    //        //$("#pop-conta").append("<label style='color: black; font-weight: bold;'>GRUPO --> &nbsp;&nbsp;"+id_membro+"</label><br>");
    //        $("#pop-upCorpo").append("<label>NOME:&nbsp;&nbsp;</label>")

    //    // PARA O INPUT FUNCIONAR
    //        $("#pop-upCorpo").append("<input id='nome' style='width: 350; maxlength: 6; color: red;'></input>")
    //        $('#nome').on('input', function() {
    //            const maxLength = 40; // Definir o número máximo de caracteres
    //            if ($(this).val().length > maxLength) {
    //                $(this).val($(this).val().slice(0, maxLength)); // Truncate o valor do input
    //            }
    //        });
    //    // FIM DO FUNCIONAMENTO DO INPUT

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
                var membroNome = $dialog.find('#mem_nome').val();  // PEGA VALOR DO IMPUT
                    if( membroNome==''){
                        alert('NOME DO MEMBRO NAO PODE SER VAZIO');
                        return false;
                    }
                    membroNome = encodeURIComponent(membroNome); //CODIFICA O CARACTER ESPACO DENTRO DO INPUT
                var membroNascimento = $dialog.find('#mem_nascimento').val();  // PEGA VALOR DO IMPUT
                var membroNascCidade = $dialog.find('#mem_nasc_cidade').val();  // PEGA VALOR DO IMPUT
                    membroNascCidade = encodeURIComponent(membroNascCidade); //CODIFICA O CARACTER ESPACO DENTRO DO INPUT
                var membroNascEstado = $dialog.find('#mem_nasc_estado').val();  // PEGA VALOR DO IMPUT
                var membroCEP = $dialog.find('#mem_endereco_cep').val();  // PEGA VALOR DO IMPUT
                var membroEndereco = $dialog.find('#mem_endereco').val();  // PEGA VALOR DO IMPUT
                    membroEndereco = encodeURIComponent(membroEndereco); //CODIFICA O CARACTER ESPACO DENTRO DO INPUT
                var membroEnderecoNr = $dialog.find('#mem_endereco_nr').val();  // PEGA VALOR DO IMPUT
                var membroEnderecoBairro = $dialog.find('#mem_endereco_bairro').val();  // PEGA VALOR DO IMPUT
                    membroEnderecoBairro = encodeURIComponent(membroEnderecoBairro); //CODIFICA O CARACTER ESPACO DENTRO DO INPUT
                var membroEnderecoComplemento = $dialog.find('#mem_endereco_complemento').val();  // PEGA VALOR DO IMPUT
                    membroEnderecoComplemento = encodeURIComponent(membroEnderecoComplemento); //CODIFICA O CARACTER ESPACO DENTRO DO INPUT
                var membroEnderecoCidade = $dialog.find('#mem_endereco_cidade').val();  // PEGA VALOR DO IMPUT
                    membroEnderecoCidade = encodeURIComponent(membroEnderecoCidade); //CODIFICA O CARACTER ESPACO DENTRO DO INPUT
                var membroEnderecoEstado = $dialog.find('#mem_endereco_estado').val();  // PEGA VALOR DO IMPUT
                var membroEstadoCivil = $dialog.find('#mem_estado_civil').val();  // PEGA VALOR DO IMPUT
                var membroGrauInstrucao = $dialog.find('#mem_grau_instrucao').val();  // PEGA VALOR DO IMPUT
                var membroTelefone = $dialog.find('#mem_telefone').val();  // PEGA VALOR DO IMPUT
                    membroTelefone = encodeURIComponent(membroTelefone); //CODIFICA O CARACTER ESPACO DENTRO DO INPUT
                var membroCelular = $dialog.find('#mem_celular').val();  // PEGA VALOR DO IMPUT
                    membroCelular = encodeURIComponent(membroCelular); //CODIFICA O CARACTER ESPACO DENTRO DO INPUT
                var membroEmail = $dialog.find('#mem_email').val();  // PEGA VALOR DO IMPUT
                var membroRedeSocial = $dialog.find('#mem_rede_social').val();  // PEGA VALOR DO IMPUT
                    membroRedeSocial = encodeURIComponent(membroRedeSocial); //CODIFICA O CARACTER ESPACO DENTRO DO INPUT
                var membroConjuge = $dialog.find('#mem_Conjuge').val();  // PEGA VALOR DO IMPUT
                    membroConjuge = encodeURIComponent(membroConjuge); //CODIFICA O CARACTER ESPACO DENTRO DO INPUT
                var membroDataCasamento = $dialog.find('#mem_casamento').val();  // PEGA VALOR DO IMPUT
                var membroNomePai = $dialog.find('#mem_nome_pai').val();  // PEGA VALOR DO IMPUT
                    membroNomePai = encodeURIComponent(membroNomePai); //CODIFICA O CARACTER ESPACO DENTRO DO INPUT
                var membroNomeMae = $dialog.find('#mem_nome_mae').val();  // PEGA VALOR DO IMPUT
                    membroNomeMae = encodeURIComponent(membroNomeMae); //CODIFICA O CARACTER ESPACO DENTRO DO INPUT
                var membroLocalTrabalho = $dialog.find('#mem_trabalho_local').val();  // PEGA VALOR DO IMPUT
                    membroLocalTrabalho = encodeURIComponent(membroLocalTrabalho); //CODIFICA O CARACTER ESPACO DENTRO DO INPUT
                var membroRamoTrabalho = $dialog.find('#mem_trabalho_ramo').val();  // PEGA VALOR DO IMPUT
                    membroRamoTrabalho = encodeURIComponent(membroRamoTrabalho); //CODIFICA O CARACTER ESPACO DENTRO DO INPUT
                var membroBatisadoSN = $dialog.find('#mem_batisao_nao_batizado').val();  // PEGA VALOR DO IMPUT
                var membroDataBatismo = $dialog.find('#mem_dt_batismo').val();  // PEGA VALOR DO IMPUT
                var membroBatismoIgreja = $dialog.find('#mem_batismo_igreja').val();  // PEGA VALOR DO IMPUT
                    membroBatismoIgreja = encodeURIComponent(membroBatismoIgreja); //CODIFICA O CARACTER ESPACO DENTRO DO INPUT
                var membroBatismoPastor = $dialog.find('#mem_batismo_pastor').val();  // PEGA VALOR DO IMPUT
                    membroBatismoPastor = encodeURIComponent(membroBatismoPastor); //CODIFICA O CARACTER ESPACO DENTRO DO INPUT
                var membroBatismoCidade = $dialog.find('#mem_batismo_cidade').val();  // PEGA VALOR DO IMPUT
                    membroBatismoCidade = encodeURIComponent(membroBatismoCidade); //CODIFICA O CARACTER ESPACO DENTRO DO INPUT
                var membroBatismoEstado = $dialog.find('#mem_batismo_Estado').val();  // PEGA VALOR DO IMPUT
                var membroTipoRecebimento = $dialog.find('#mem_tipo_recebido').val();  // PEGA VALOR DO IMPUT
                var membroDataRecebimento = $dialog.find('#mem_uso_ibr_data').val();  // PEGA VALOR DO IMPUT
                var membroAtaRecebimento = $dialog.find('#mem_ata_Batismo').val();  // PEGA VALOR DO IMPUT
                    membroAtaRecebimento = encodeURIComponent(membroAtaRecebimento); //CODIFICA O CARACTER ESPACO DENTRO DO INPUT
                var membroPastorRecebimento = $dialog.find('#mem_uso_ibr_pastor').val();  // PEGA VALOR DO IMPUT
                    membroPastorRecebimento = encodeURIComponent(membroPastorRecebimento); //CODIFICA O CARACTER ESPACO DENTRO DO INPUT
                var membroIgrejaRecebimento = $dialog.find('#mem_uso_ibr_igreja').val();  // PEGA VALOR DO IMPUT
                    membroIgrejaRecebimento = encodeURIComponent(membroIgrejaRecebimento); //CODIFICA O CARACTER ESPACO DENTRO DO INPUT


                console.info('Botao Gravar');
                console.info('nome do membro   '+ membroNome);
                console.info('nascimento do membro   '+ membroNascimento);
                console.info('nascimento cidade   '+ membroNascCidade);
                console.info('nascimento Estado   '+ membroNascEstado);
                console.info('membro CEP   '+ membroCEP);
                console.info('membro Endereço   '+ membroEndereco);
                console.info('membro Endereço Numero   '+ membroEnderecoNr);
                console.info('membro Endereço Bairro   '+ membroEnderecoBairro);
                console.info('membro Endereço Complemento   '+ membroEnderecoComplemento);
                console.info('membro Endereço Cidade   '+ membroEnderecoCidade);
                console.info('membro Endereço Estado   '+ membroEnderecoEstado);
                console.info('membro Endereço Estado Civil   '+ membroEstadoCivil);
                console.info('membro Endereço Grau Instruçao   '+ membroGrauInstrucao);
                console.info('membro Endereço Telefone Fixo   '+ membroTelefone);
                console.info('membro Endereço Celular   '+ membroCelular);
                console.info('membro Email   '+ membroEmail);
                console.info('membro RedeSocial   '+ membroRedeSocial);
                console.info('membro Conjuge   '+ membroConjuge);
                console.info('membro Data Casamento   '+ membroDataCasamento);
                console.info('membro Nome do Pai   '+ membroNomePai);
                console.info('membro Nome do Mae   '+ membroNomeMae);
                console.info('membro Local Trabalho   '+ membroLocalTrabalho);
                console.info('membro Ramo Trabalho   '+ membroRamoTrabalho);
                console.info('membro Batisado   '+ membroBatisadoSN);
                console.info('membro Data Batismo   '+ membroDataBatismo);
                console.info('membro Batismo Igreja   '+ membroBatismoIgreja);
                console.info('membro Batismo Pastor   '+ membroBatismoPastor);
                console.info('membro Batismo Cidade   '+ membroBatismoCidade);
                console.info('membro Batismo Estado   '+ membroBatismoEstado);
                console.info('membro Tipo Recebimento   '+ membroTipoRecebimento);
                console.info('membro Data Recebimento   '+ membroDataRecebimento);
                console.info('membro Ata Recebimento   '+ membroAtaRecebimento);
                console.info('membro Pastor Recebimento   '+ membroPastorRecebimento);
                console.info('membro Igreja Recebimento   '+ membroIgrejaRecebimento);


                var atualiza_infos='novo_membro';
                //var url=("bd/atualiza_infos.php?nome_membro="+membroNome+'&atualiza_contas='+atualiza_infos+'&id_do_grupo='+id_membro);
                //var url=("bd/atualiza_infos.php?nome_conta="+contaNome+'&atualiza_contas='+atualiza_infos+'&id_do_grupo='+id_grupo);
                var url=("bd/atualiza_infos.php?nome_membro="+membroNome+'&atualiza_contas='+atualiza_infos+
                        '&nascimento_membro='+membroNascimento+
                        '&membro_nasc_cidade='+membroNascCidade+
                        '&membro_nasc_estado='+membroNascEstado+
                        '&membro_cep='+membroCEP+
                        '&membro_Endereco='+membroEndereco+
                        '&membro_Endereco_Nr='+membroEnderecoNr+
                        '&membro_Endereco_Bairro='+membroEnderecoBairro+
                        '&membro_Endereco_Complemento='+membroEnderecoComplemento+
                        '&membro_Endereco_Cidade='+membroEnderecoCidade+
                        '&membro_Endereco_Estado='+membroEnderecoEstado+
                        '&membro_Estado_Civil='+membroEstadoCivil+
                        '&membro_grau_instrucao='+membroGrauInstrucao+
                        '&membro_Telefone='+membroTelefone+
                        '&membro_Celular='+membroCelular+
                        '&membro_Email='+membroEmail+
                        '&membro_Rede_Social='+membroRedeSocial+
                        '&membroConjuge='+membroConjuge+
                        '&membroDataCasamento='+membroDataCasamento+
                        '&membroNomePai='+membroNomePai+
                        '&membroNomeMae='+membroNomeMae+
                        '&membroLocalTrabalho='+membroLocalTrabalho+
                        '&membroRamoTrabalho='+membroRamoTrabalho+
                        '&membroBatismoSN='+membroBatisadoSN+
                        '&membroDataBatismo='+membroDataBatismo+
                        '&membroBatismoIgreja='+membroBatismoIgreja+
                        '&membroBatismoPastor='+membroBatismoPastor+
                        '&membroBatismoCidade='+membroBatismoCidade+
                        '&membroBatismoEstado='+membroBatismoEstado+
                        '&membroTipoRecebimento='+membroTipoRecebimento+
                        '&membroDataRecebimento='+membroDataRecebimento+
                        '&membroAtaRecebimento='+membroAtaRecebimento+
                        '&membroPastorRecebimento='+membroPastorRecebimento+
                        '&membroIgrejaRecebimento='+membroIgrejaRecebimento
                        );
                $('#itens').load(url);
                console.info(url);
                $dialog.dialog('close');
                window.mostra_botoes();
                javascript:abrirPagina('x-membresia/membresia.php');
            });


            $('#bt_fechar').click(function(){
                console.info('Botao fecha popu up');
                //console.info('olha ai'+)
                var url=("x-membresia/membresia_info.php?nrid="+id_membro);
                $('#itens').load(url);
                $dialog.dialog('close');
                window.mostra_botoes();
            });




    mem_novo_popup.start(); // EXECUTA A FUNCAO START NA ABERTURA DA PAGINA
</script>


