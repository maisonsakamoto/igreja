<!DOCTYPE html><html lang="en"><head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>jQuery UI Dialog - Modal confirmation</title>
  <link rel="stylesheet" href="https://code.jquery.com/ui/1.14.0/themes/base/jquery-ui.css">
  <link rel="stylesheet" href="/resources/demos/style.css">
  <script src="https://code.jquery.com/jquery-3.7.1.js"></script>
  <script src="https://code.jquery.com/ui/1.14.0/jquery-ui.js"></script>

  <style>
      
      #dialog-confirm{background: bisque;  }
      .ui-dialog-titlebar {background: black;}
      .ui-dialog-title{ float: none; text-align: center; background: black; color:white; }
      .ui-dialog .ui-dialog-buttonpane button{background: #FFFFE0; width: 140px; font: 12px verdana; height: 30px; color: black; }
      .ui-dialog .ui-dialog-buttonpane button:hover{cursor: pointer; background: #CFCFCF; color: black;}
  </style>
  
  <script>
  $( function() {
    $( "#dialog-confirm" ).dialog({
      resizable: false,
      height: "auto",
      width: 400,
      modal: true,
      buttons: {
        "Redigite": function() {
          $( this ).dialog( "X" );
        },
        /*Cancel: function() {
          $( this ).dialog( "X" );
        }*/
      }
      /*$('#bt_gravar').click(function(){$dialog.dialog('close'); }*/
    

    });
  } );
  </script>
</head>
<body>
 
    <div id="dialog-confirm" title="DATA ERRADA">
  <p><span class="ui-icon ui-icon-alert" style="float:left; margin:12px 12px 20px 0;"></span>MENSAGEM CENTRAL</p>
</div>
 
 
 
 
 
</body></html>
 
 
 
 
</body></html>