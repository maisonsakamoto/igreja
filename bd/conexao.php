<?php
//echo "Aguarde . . .";
//die();
class OpenDB{	
  
    public $link;
    
    public function server(){

        // Este arquivo conecta um banco de dados MySQL - Servidor = localhost
        $dbname="ibr"; // Indique o nome do banco de dados que será aberto
        $usuario="root"; // Indique o nome do usuário que tem acesso
        $password="btr2504"; // Indique a senha do usuário
        //1º passo - Conecta ao servidor MySQL
        if(!($id = mysqli_connect("192.168.1.193",$usuario,$password,$dbname))) {
           echo "Não foi possível estabelecer uma conexão com o MySQL. Favor Contactar o Administrador. <br/>";           
           exit;
        } 
        /*if(!($con= mysqli_select_db($id,$dbname))) {
           echo "Não foi possível estabelecer uma conexão com o Database $dbname. Favor Contactar o Administrador.";
           exit;
        } */
        $this->link = $id;
        return $id;    
    }
        
}
 ?>