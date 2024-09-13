<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<?php
    include_once 'controller/ColCarta.php';
    include_once 'model/Class.Carta.php';
    include_once 'controller/OpenDB.php';
    
    $conexao = new OpenDB();
    $conexao->conectarNovamente("maison", "maison123");
    $colC = new ColCarta();
    $cartas = new Carta();
    
    echo "<div style='border: 1px solid #d0d0d0; text-align: center;background-color: #fc0;'>Supor que hoje é dia 12-01-2012</div>
          <br />
          <center>
          <table border='1'>
            <tr>
                <td>NÚMERO</td>
                <td>PropProp</td>
                <td>DATA EMISSÃO</td>
                <td>VENCIDA</td>
            </tr>
        ";
    $hoje = strtotime("2012-01-12");
    
    $cartas = $colC->getByPropEst(2);    
    
    for ($index = 0; $index < count($cartas); $index++) {
        
        $emissao = strtotime($cartas[$index]->getCartEmissao() );
        if ($emissao > $hoje){ $style="style='background-color: green;'"; $b="OK"; }
        else if ($emissao < $hoje){ $style="style='background-color: red;'"; $b="VENCIDA"; }
        else if ($emissao == $hoje){ $b="EM DIA"; }
        echo "<tr $style>
                <td>".$cartas[$index]->getCartId()."</td>
                <td>".$cartas[$index]->getCartPropEst()."</td>
                <td>".date('d-m-Y',$emissao)."</td>
                <td>".$b."</td>
             </tr>";
        $style="";
        $b="";
    }
    echo "
        </center>
        </table>";
?>
</html>