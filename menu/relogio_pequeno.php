<script language="JavaScript">
    function moveRelogio1(){
        momentoAtual = new Date()
        hora = momentoAtual.getHours()
        minuto = momentoAtual.getMinutes()
        segundo = momentoAtual.getSeconds()
        str_minuto = new String (minuto)

        if (minuto<10){ minuto=str_minuto="0"+new String(minuto) }

        str_segundo = new String (segundo)
        if (str_segundo.length == 1)
        segundo = "0" + segundo


        //  colocar 0  antes dos segundos
        str_segundo = new String (segundo)
        if (segundo<10){ str_segund="0"+segundo }
        horaImprimivel = hora + ":" + minuto + ":" + segundo
        document.form_relogio.relogio.value = horaImprimivel
        setTimeout(function(){ moveRelogio1() },1000)
    }
    moveRelogio1();
</script>

<form name="form_relogio">
    <input id="relogio" type="text" name="relogio" size="10" >
</form>