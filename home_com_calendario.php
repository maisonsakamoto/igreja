
<!doctype html>
<html lang="en">
<head>
  <title>CALENDARIO</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>jQuery UI Datepicker - Display inline</title>
  <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
  <link rel="stylesheet" href="/resources/demos/style.css">
  <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
  <script>
  $( function() {
    $( "#datepicker" ).datepicker({
        dateFormat: 'dd/mm/yy',
        dayNames: ['Domingo','Segunda','Terça','Quarta','Quinta','Sexta','Sábado','Domingo'],
        dayNamesMin: ['D','S','T','Q','Q','S','S','D'],
        dayNamesShort: ['Dom','Seg','Ter','Qua','Qui','Sex','Sáb','Dom'],
        monthNames: ['Janeiro','Fevereiro','Março','Abril','Maio','Junho','Julho','Agosto','Setembro','Outubro','Novembro','Dezembro'],
        monthNamesShort: ['Jan','Fev','Mar','Abr','Mai','Jun','Jul','Ago','Set','Out','Nov','Dez']
    });
  } );
  </script>
<style>
 /*.ui-datepicker-calendar css { text-align: center; } */
.ui-datepicker-calendar td.ui-datepicker-week-end:nth-child(1) a { background: #FDF5E6;; color: red; font-weight:bold;text-align: center;  }  /*DOMINGO*/
/*.ui-datepicker-calendar td.ui-datepicker-week-end:nth-child(0) a { background: #FDF5E6; text-align: center;  }
//.ui-datepicker-calendar td.ui-datepicker-week-end a { background: yellow; text-align: center;  }
//.ui-datepicker-calendar td.ui-datepicker-week-end { background: yellow; text-align: center;  } */

.ui-widget.ui-widget-content{width: 450px;}  //  TAMANHO DO CALENDARIO
.ui-datepicker td a { text-align: center; font-size: 30px;}  // INFDORMAÇOES DOS NUMEROS DOS DIAS
.ui-datepicker table { background:#FDF5E6; }  //  COR DE FUNDO 
.ui-datepicker title {font-size: 30px;}  //  titulo


/*.ui-datepicker th a { background:#FDF5E6; }
//.ui-datepicker-calendar {background:#FDF5E6;}*/
#datepicker  {padding-left: 20px; }

</style>  
</head>
<body>
<table width="995" height="350"  border="0" cellspacing="0" cellpadding="0" align="center" VALIGN="TOP">
    <tr>
        <td style="background: bisque;">
    <div id="datepicker"  align="center"  ></div>
        </td>
    </tr>
 </table>
 
</body>
</html>