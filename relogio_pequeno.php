<html>
<head>
<title>Relogio com Javascript</title>
<script language="JavaScript">
function moveRelogio1(){
    momentoAtual = new Date()
    hora = momentoAtual.getHours()
    minuto = momentoAtual.getMinutes()
    segundo = momentoAtual.getSeconds()


//minuto = "0" + minut 

str_minuto = new String (minuto) 
//if (minuto<10){str_minuto="0"+minuto}
if (minuto<10){minuto=str_minuto="0"+new String(minuto)}



str_segundo = new String (segundo) 
if (str_segundo.length == 1)
segundo = "0" + segundo 


//  colocar 0  antes dos segundos
str_segundo = new String (segundo) 
if (segundo<10){str_segund="0"+segundo}
//if (segundo<10){segundo=str_segundo="0"+new String(segundo)}


    horaImprimivel = hora + ":" + minuto + ":" + segundo

    document.form_relogio.relogio.value = horaImprimivel

    setTimeout("moveRelogio1()",1000)
}
</script>
</head>
<style>
#cortopo11{
   
    border-radius: 12px;
    border-radius: 0px;
    border: 12px;
    border: 0px;

    font-family: verdana;
    font-family: the display st;
    font-family: Digital Dismay;
    font-family: ticking Timebomb BB;
    font-size: 30px;
    font-weight: normal;
    color:#008B00;    
    /*color:red;*/
    text-align: center;
    padding-top: 7px;
}
</style>

<body onload="moveRelogio1()">


<form name="form_relogio">
<input id="cortopo11" type="text" name="relogio" size="10" >
</form>

</body>
</html> 