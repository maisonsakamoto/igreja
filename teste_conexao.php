<?php
//echo "celso";
//echo "Conexao aberta";
//die();
    include "bd\conexao.php";   //  vai la, abre banco de dados e retorna com ele aberto
    $o = new OpenDB();
    $o->server();
    $link = $o->server();
    $query = "SELECT * FROM membresia"; 
    $dt = mysqli_query($link,$query);  
    

    //echo "Arquivo aberta";
    //die();    
  
    
    $style="style='background-color: #ff0000; color: white; heigth: 80px;border:1px;font-family:verdana; font-size: 11px;'";
    $style="style='background-color: #DCDCDC; color: black; heigth: 80px;border:1px;font-family:verdana; font-size: 11px;'";
    echo "<table  style='border: 0px solid #d2d2d2'>";
        echo "<tr $style>";
            echo "<td style='width: 690px; height: 5px; text-align: center; font-weight:bold; background-color: white;'></td>";  // somente espaço em branco
        echo "</tr>";
        echo "<tr $style>";
        echo "<td style='width: 681px; height: 20px; text-align: center; font-weight:bold;'>MEMBRESIA</td>";
        echo "</tr>";
        echo "<tr $style>";
            echo "<td style='width: 690px; height: 1px; text-align: center; font-weight:bold; background-color: white;'></td>";  // somente espaço em branco
        echo "</tr>";            
    echo "</table>";
    echo "<table>";
        echo "<tr $style>";
        echo "<td style='border: 1px solid #d2d2d2; width: 80px; height: 20px; text-align: center;'>NOME</td>";
        echo "</tr>"; 
    echo "</table>";
    $style="style='background-color: #B4EEB4; color: black; heigth: 80px; font-family:verdana; font-size: 11px; style='border: 1px solid #d2d2d2;'";
    echo "<table>";

    //echo "Arquivo aberta";
    //die();

    $dt = mysqli_query($link,$query); 
    while ($obj=mysqli_fetch_object($dt)) {
        $nome= ($obj->nome);  
        $numero_id= ($obj->id_membresia);  
        echo "<tr $style>";
        echo "<td style='border: 1px solid #d2d2d2; width: 30px; text-align: left;'>$numero_id</td>";
        echo "<td style='border: 1px solid #d2d2d2; width: 70px; text-align: left;'>$nome</td>";
        echo "<tr>"; 
    }
    echo "</table>"
?>  
