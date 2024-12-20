<?php
class OpenDB{

    public $link;
    public $conn;

    public function server(){

        // Este arquivo conecta um banco de dados MySQL - Servidor = localhost
        $dbname="ibr"; // Indique o nome do banco de dados que será aberto
        $usuario="root"; // Indique o nome do usuário que tem acesso
        $password="btr2504"; // Indique a senha do usuário
        //$host="192.168.1.193"; // Indique o endereço do servidor
        $host="localhost"; // Indique o endereço do servidor
        //1º passo - Conecta ao servidor MySQL
        if(!($id = mysqli_connect($host,$usuario,$password,$dbname))) {
           echo "Não foi possível estabelecer uma conexão com o MySQL. Favor Contactar o Administrador. <br/>";
           exit;
        }

        $this->conn = $id;
        $this->link = $id;
        return $id;
    }

}
 ?>