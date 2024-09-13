
<style>
    
    .ui-button:hover{color: red;};
    
</style>

<div style="background: bisque; height: 47px; width: 455px; float:c; overflow: auto; padding-left: 115;"> 
<?php
//echo "plano_contas_info";

$parametro = @$_REQUEST['nrid'];
//echo "<br>";
//echo $parametro;
echo "<input type='hidden' id='idgrupo' value='$parametro'/>";
include "../bd/conexao.php";   //  vai la, abre banco de dados e retorna com ele aberto
$o = new OpenDB();
$o->server();
$link = $o->server();

//  ver nome do grupo
    $query = "SELECT * FROM plano_contas_grupo where id_grupo=$parametro "; 
    $dt = mysqli_query($link,$query); 
    ($obj= mysqli_fetch_object($dt));
    $nome=$obj->grupo_nome;
    $id_do_grupo=$obj->id_grupo;
    //echo $nome;
    $style="style='background-color: black; height: 20px; border: 1px;font-family:verdana; font-size: 10px; font-weight:bold; color:white;'";     
    echo "<table>";
        echo "<tr $style>";
           echo "<td style='width: 430px;text-align:center;'>CONTAS DO GRUPO</td>";
        echo "</tr>";    
        echo "<tr $style>";
           echo "<td style='width: 430px;text-align:center;'>$id_do_grupo &nbsp;-&nbsp; $nome</td>";
        echo "</tr>";    
        
    
    echo "</table>";
    
//  Fim ver nome grupo
?>

</div>
<div style="background: bisque; height: 560px; width: 455px; float:c; overflow: auto; padding-left: 115;"> 
<?php
$query = "SELECT * FROM plano_contas_conta where grupo=$parametro "; 
$dt = mysqli_query($link,$query); 
$style="style='background-color: #EEEED1; height: 20px; border: 1px;font-family:verdana; font-size: 10px; font-weight:normal'"; 
$style="style='background-color: #B4EEB4; height: 20px; border: 1px;font-family:verdana; font-size: 10px; font-weight:normal'"; 
echo "<table>";
$conta_id=0;
while ($obj= mysqli_fetch_object($dt)) {
    $grupo_id=$obj->grupo;
    $conta_id=$obj->id_contas;
    $conta_nome=$obj->nome;

    if ($conta_id>0){
    echo "<tr $style>";
       echo "<td style='width: 35px;text-align:center;'>$grupo_id</td>";
       echo "<td style='width: 35px;text-align:center;'>$conta_id</td>";
       echo "<td style='width: 300px;text-align:left;'>&nbsp;&nbsp;$conta_nome</td>";
       //echo "<td style='width: 50px; text-align:center;'><input $style  type = 'button' nr_id='".$obj->id_contas."' name ='botao_edita'  value = 'Edita' class='botao aciona ui-button></td>";
       echo "<td style='width: 50px; text-align:center;'><input $style  type = 'button' nr_id='".$obj->id_contas."' name='botao_edita'  value = 'Editar'  class='info botao aciona ui-button'></td>";
    echo "</tr>";
    };
}   
echo "</table>"; 




        
?> 
</div>
<script type="text/javascript">
        $(document).ready(function () {            
            evento();
        });  

        
        function evento(){ 
            //idi = $(this).attr('nr_id');
            //fil = $(this).attr('$filial_nome');
            //var fil = $("#filial").val();
            $(".aciona").click(function(e){
                e.stopImmediatePropagation();
                    //console.log("evento()");
                    var idi = $(this).attr('nr_id');
                    //var fil = $(this).attr('filial');
                    //var sal_ant = $(this).attr('saldoan');
                    //var sal_atu = $(this).attr('saldoat');
                    //var cx_nr = $(this).attr('cx_nr');
                    //console.info('Botao acionado  '+idi+" filial="+fil   +" saldo_an="+sal_ant  +" saldoatu="+sal_atu);
                    //$('#itens').textt(sal_ant+ "  " +);
                    //window.open("movimento_caixa_filiais.php?nrid="+idi+'&filial='+fil+'&saldoatu='+sal_atu +'&saldoant='+sal_ant  +'&cx_nr='+cx_nr);
                   // var url=("movimento_caixa_foz_itens.php?nrid="+idi+'&saldoatu='+sal_atu +'&saldoant='+sal_ant  +'&cx_nr='+cx_nr);
                   // $('#itens').load(url);
                    //$('#itens').load(url, function(){
                    //$('#itens').show();
                    //}
                    console.info(idi);
                    
                //$('#bt_editar_conta').click(function(){      
                console.info('Edita Conta idi='+idi);
               // window.esconde_botoes();

                //var idi='celso';
                //var idi = $(this).attr('nr_id');
                var idgrupo = $('#idgrupo').val();
                var url=("x-plano-contas/contas_edita.php?nrid="+idi+"&idgrupo="+idgrupo);
                //die();
                //var url=("x-plano-contas/contas_edita.php");
                $('#itens').load(url);                
//            });                       
                    
                    
                    
                }
            );
        };
</script>