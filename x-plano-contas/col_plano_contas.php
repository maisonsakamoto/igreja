<?php
include_once "../bd/conexao.php";

class PlanoContas {
    private $link;

    public function __construct() {
        $o = new OpenDB();
        $this->link = $o->server();
    }

    public function getGrupos() {
        $query = "SELECT * FROM plano_contas_grupo ORDER BY grupo_nome";
        $result = mysqli_query($this->link, $query) or die(mysqli_error($this->link));

        $grupos = array();
        while ($row = mysqli_fetch_assoc($result)) {
            $grupos[] = $row;
        }

        return $grupos;
    }

    public function getContas($grupoId) {
        $query = "SELECT * FROM plano_contas_conta WHERE grupo = ? ORDER BY nome";
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
}

$planoContas = new PlanoContas();

$funcao = isset($_REQUEST['funcao']) ? $_REQUEST['funcao'] : '';

if (method_exists($planoContas, $funcao)) {
    if ($funcao === 'getContas') {
        $grupoId = isset($_REQUEST['grupoId']) ? $_REQUEST['grupoId'] : null;
        $resultado = $planoContas->$funcao($grupoId);
    } else {
        $resultado = $planoContas->$funcao();
    }
    header('Content-Type: application/json');
    echo json_encode($resultado);
} else {
    header('HTTP/1.1 400 Bad Request');
    echo json_encode(array('erro' => 'Função não encontrada'));
}
?>