<?php

/**
 * ColPlanoContas
 * @author: Maison K. Sakamoto - 15/09/2024
 */

include_once "../bd/conexao.php";

class PlanoContas {
    private $link;

    public function __construct() {
        $o = new OpenDB();
        $this->link = $o->server();
    }

    public function getGrupos() {
        $query = "SELECT * FROM plano_contas_grupo ORDER BY id_grupo, grupo_nome";
        $result = mysqli_query($this->link, $query) or die(mysqli_error($this->link));

        $grupos = array();
        while ($row = mysqli_fetch_assoc($result)) {
            $grupos[] = $row;
        }

        return $grupos;
    }

    public function getGruposTipo() {
        $obj = (object) $_REQUEST['obj'];
        $query = "SELECT * FROM plano_contas_grupo WHERE grupo_tipo = ? ORDER BY id_grupo, grupo_nome";
        $stmt = mysqli_prepare($this->link, $query);
        mysqli_stmt_bind_param($stmt, "s", $obj->grupoTipo);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);

        $grupos = array();
        while ($row = mysqli_fetch_assoc($result)) {
            $grupos[] = $row;
        }

        return $grupos;
    }

    public function novoGrupo() {
        $nome = $_REQUEST['nome'];
        $grupoTipo = $_REQUEST['grupoTipo'];
        $query = "INSERT INTO plano_contas_grupo (grupo_nome, grupo_tipo) VALUES (UPPER(?), ?)";
        $stmt = mysqli_prepare($this->link, $query);
        mysqli_stmt_bind_param($stmt, "ss", $nome, $grupoTipo);
        $success = mysqli_stmt_execute($stmt);

        if ($success) {
            $novoId = mysqli_insert_id($this->link);
            return array('success' => true, 'id' => $novoId);
        } else {
            return array('success' => false, 'message' => mysqli_error($this->link));
        }
    }

    public function getContas() {
        $grupoId = $_REQUEST['grupoId'];
        $query = "SELECT * FROM plano_contas_conta WHERE grupo = ? ORDER BY conta_nome";
        $stmt = mysqli_prepare($this->link, $query);
        mysqli_stmt_bind_param($stmt, "i", $grupoId);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);

        $contas = array();
        while ($row = mysqli_fetch_assoc($result)) {
            $contas[] = $row;
        }

        return $contas;
    }

    public function novaConta() {
        $nome = $_REQUEST['nome'];
        $grupoId = $_REQUEST['grupoId'];
        $query = "INSERT INTO plano_contas_conta (conta_nome, grupo) VALUES (UPPER(?), ?)";
        $stmt = mysqli_prepare($this->link, $query);
        mysqli_stmt_bind_param($stmt, "si", $nome, $grupoId);
        $success = mysqli_stmt_execute($stmt);

        if ($success) {
            $novoId = mysqli_insert_id($this->link);
            return array('success' => true, 'id' => $novoId);
        } else {
            return array('success' => false, 'message' => mysqli_error($this->link));
        }
    }

    public function editarGrupo() {
        $id = $_REQUEST['id'];
        $nome = $_REQUEST['nome'];
        $grupoTipo = $_REQUEST['grupoTipo'];
        $query = "UPDATE plano_contas_grupo SET grupo_nome = ?, grupo_tipo = ? WHERE id_grupo = ?";
        $stmt = mysqli_prepare($this->link, $query);
        mysqli_stmt_bind_param($stmt, "ssi", $nome, $grupoTipo, $id);
        mysqli_stmt_execute($stmt);
        return mysqli_stmt_affected_rows($stmt) > 0;
    }

}

$planoContas = new PlanoContas();

// Verifica se a função foi passada como parâmetro
$funcao = isset($_REQUEST['funcao']) ? $_REQUEST['funcao'] : '';

// Verifica se o método existe na classe
if (method_exists($planoContas, $funcao)) {

    // Chama o método da classe
    $resultado = $planoContas->$funcao();

    // Retorna o resultado como JSON
    //header('Content-Type: application/json');
    echo json_encode($resultado);
} else {
    // Retorna um erro se a função não foi encontrada
    header('HTTP/1.1 400 Bad Request');
    echo json_encode(array('erro' => 'Função não encontrada'));
}
?>