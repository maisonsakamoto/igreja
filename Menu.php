

        <!--https://codepen.io/nikhil/details/sicrK
            https://www.rocketwp.com.br/83-melhores-menus-responsivos-em-css-e-html-gratuitos/
        -->
        <title>IGREJA BATISTA</title>
        <meta charset="UTF-8"/>

        <link rel='shortcut icon' href='imagens/ibr_logo.ico' type=”image/x-icon” />
        <link type="text/css" href="css/ui-lightness/jquery-ui-1.8.17.custom.css" rel="stylesheet" />
        <link type="text/css" href="css/menuBarra.css" rel="stylesheet" />
        <link rel="stylesheet" href="gridmaison/table.css" type="text/css" />
        <link rel="stylesheet" href="js/jqwidgets-ver3.4.0/styles/jqx.base.css" type="text/css" />

        <script src="js/js/jquery-1.7.1.min.js" type="text/javascript"></script>
        <script src="js/js/jquery-ui-1.8.17.custom.min.js" type="text/javascript"></script>
        <script src="js/custom_jquery.js" type="text/javascript"></script> <!-- PARA FORMATAÇOES CONVERCÓES ETC. API DA BTR -->
        <script src="js/js/date.js" type="text/javascript"></script> <!-- PARA FAZER O NEW Date().asString() -->
        <script src="js/js/dataBr.js" type="text/javascript"></script> <!-- PARA FAZER O CALENDARIO EM PT-BR -->
        <script src="js/jquery-meiomask.js" type="text/javascript"></script>
        <script src="js/jqwidgets-ver3.4.0/jqwidgets/jqxcore.js" type="text/javascript"></script>
        <script src="js/jqwidgets-ver3.4.0/jqwidgets/jqxgrid.js" type="text/javascript"></script>
        <script src="js/jqwidgets-ver3.4.0/jqwidgets/jqxdata.js" type="text/javascript"></script>
        <script src="js/jqwidgets-ver3.4.0/jqwidgets/jqxscrollbar.js" type="text/javascript"></script>
        <script src="js/jqwidgets-ver3.4.0/jqwidgets/jqxbuttons.js" type="text/javascript"></script>
        <script src="js/jqwidgets-ver3.4.0/jqwidgets/jqxgrid.selection.js" type="text/javascript"></script>
        <script src="js/jqwidgets-ver3.4.0/jqwidgets/jqxgrid.filter.js" type="text/javascript"></script>
        <script src="x_controle_botoes.js?nocache=1.1" type="text/javascript"></script>

<style>

    /*MENU  BARRINHAS */
        .menu li a{
          display: block;
          text-indent: -500em;
          height: 40px;
          width: 40px;;
          line-height: 40px;;
          text-align:center;
          color: #72739f;
          position: relative;
          border-bottom: 1px solid rgba(0, 0, 0, 0.05);
          transition: background 0.1s ease-in-out;
          left: 2px;
        }

    /* FIM MENU BARRINHAS*/

    /*  BARRINHA FICA DENTRO DESTE ESTILO*/
        .menu {
            position: fixed;
            top: 30;
            left: 465;
            height: 82px;
            list-style-type: none;
            margin: 0;
            padding: 0;
            background: #f7f7f7;
            z-index:10;
            overflow:hidden;
            box-shadow: 2px 0 18px rgba(0, 0, 0, 0.26);
            height: 45px;
            width: 45px;
        }
    /* FIM ESTILO DAS BARRINHAS*/



    /* LINHAS DO MENU DE DENTRO*/
        .menu-bar li a {
          display: block;
          height: 20px;
          line-height: 25px;;
          text-align:center;
          color: #72739f;
          color: black;
          text-decoration:none;
          position: relative;
          font-family:verdana;
          border-bottom: 1px solid rgba(0, 0, 0, 0.05);
          transition: background 0.1s ease-in-out;
          font-family: verdana;
          font-size: 11px;
        }


        .menu-bar li b{
          display: block;
          height: 20px;
          line-height: 25px;;
          text-align:center;
          color: black;
          text-decoration:none;
          position: relative;
          font-family:verdana;
          border-bottom: 1px solid rgba(0, 0, 0, 0.05);
          transition: background 0.1s ease-in-out;
          font-family: verdana;
          font-size: 11px;
          background: #CDC9C9;
        }


    /* FIM DAS LINHAS DO MENU DENTRO  */

    .menu li a:before {font-family: FontAwesome; text-indent: 0em; position: absolute; top: 0; left: 0; width: 100%; height: 100%; font-size: 1.4em;}
    .menu li a.home:before {content: "\f039";}
    .menu-bar li a:hover {background: bisque;}
    .menu li a:hover,
    .menu li:first-child a {background: #267fdd; color: #fff;}
    .menu-bar{overflow:hidden;left:540pxz; z-index:5; width:0; height:0; transition: all 0.1s ease-in-out;}
    .para{color:#033f72; padding-left:100px; font-size:3em; margin-bottom:20px;}
    /*  MENU DE DENTRO */
        .open{
            width:190px;
            height:500px;
        }

        .menu-bar {
            position: fixed;
            top: 70;
            left: 465;
            height: 590;  /*// tamanho do menu  TAMANO DO MENU NA VERTICAL  */
            list-style-type: none;
            margin: 0;
            padding: 0;
            background: #f7f7f7;
            z-index: 9999;
            overflow:hidden;
            box-shadow: 2px 0 18px rgba(0, 0, 0, 0.26);

        }
    /* FIM MENU DE DENTRO */



    /* DVs da tela */
        #pagina{position: absolute; top: 100px; height: 694px; line-height: 35px; text-align: center; width: 1000px; background-color:bisque; float: center; border-width: 5px; border-color: black;}
        #DivMeio{position:relative; border-width:2px; width:100px; height: 35px; background-color: white; float: left;}
        #DivEsquerda{position: relative; border-width:2px; width: 90px; height: 80px; left:0px; background-color: white; float: left;}
        .group:before,
        .group:after {content: ""; display: table;}
        .group:after { clear: both;}
        .group { zoom: 1; /* For IE 6/7 (trigger hasLayout) */}
        .group {position: top;}
    /* Fim  DVs da tela */
#imagem1 a:houver {cursor: pointer;}

</style>
 </head>

<table width="1000" height="80"  border="1" cellspacing="0" cellpadding="0" align="center" VALIGN="TOP"  style="background-color: white; ">
    <tr>
        <td>
                    <ul class="menu">

                         <li title="Menu Barrinha">
                            <a href="javascript:void(0);" class="menu-button home">menu</a></li>

                       </ul>

                       <ul class="menu-bar">
                           <!--<li><a href="#" class="menu-button">Esconder Menu</a></li>   -->
                           <li><b>Inicio</b></li>
                           <!--<a title="Home" href="javascript:abrirPagina('Home.php');">Home</a>  -->
                           <li><a href="javascript:abrirPagina('home.php');">Home</a></li>
                           <li><a href="javascript:abrirPagina('x-membresia/membresia.php');">Membresia Ativos</a></li>
                           <li><a href="javascript:abrirPagina('x-membresia/membresia_desligados.php');">Membresia Desligados</a></li>
                           <li><a href="javascript:abrirPagina('home_com_calendario.php');">Calendario</a></li>
                           <li><b>Financeiro</b></li>
                           <li><a href="javascript:abrirPagina('x-plano-contas/plano_contas.php');">Plano de Contas</a></li>
                           <!--<li><a href="javascript:abrirPagina('testes.php');">T E S T E S</a></li>-->
                       </ul>
            <div class="group">
                <div id="DivEsquerda"></div>
                <div id="DivMeio"><a><br></a> <a  href="javascript:abrirPagina('home.php');" class="imagem1"><img src="imagens/ibr_logo_2024.png"  height="40" whidth="40"  ></a></div>
                <div id="DivA"><a><br></a><?php  include "relogio_pequeno.php";?> </div>
            </div>
            <div id="pagina">grid</div>
        </td>
    </tr>
</table>

<script>




$(document).ready(function(){
$(".menu-button").click(function(){
$(".menu-bar").toggleClass( "open" );
})

//$(".menu-bar").click(function(){
//    $(".menu-bar").toggleClass( "esconde" );
//})

})

        function abrirPagina(url){
            console.info('abrir  ' + url);


            $('#pagina').slideUp("fast",function(){ // Efeito de sobe da pagina
                $('#pagina').load(url, function(){  // Carrega pagina
                    $('#pagina').slideDown("fast"); // Efeito de desce da pagina
                });
            });

            $(".open").removeClass('open');
        }

        function novaPagina(url){
            window.open(url);
            $(".open").removeClass('open');
        }
        $(document).ready(function () {
            abrirPagina('home.php');
        });

</script>
