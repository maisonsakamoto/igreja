<?php

/**
 * ColLancamentos
 * @author: Maison K. Sakamoto - 17/09/2024
 */

include_once "../bd/conexao.php";

class ColLancamentos {
    private $link;

    public function __construct() {
        $o = new OpenDB();
        $this->link = $o->server();
    }

    public function novaDespesa() {
        $obj = (object) $_REQUEST['obj'];
        $dataEmissao = $obj->dataEmissao;
        $descricao = $obj->descricao;
        $valor = $obj->valor;
        $contaId = $obj->contaId;
        $tipo = 'D';
        $query = "INSERT INTO plano_contas_lancamento (lanc_dt_emissao, lanc_descricao, lanc_valor, lanc_conta, lanc_tipo) VALUES (?, UPPER(?), ?, ?, ?)";
        $stmt = mysqli_prepare($this->link, $query);
        mysqli_stmt_bind_param($stmt, "ssdis", $dataEmissao, $descricao, $valor, $contaId, $tipo);
        $success = mysqli_stmt_execute($stmt);

        if ($success) {
            $novoId = mysqli_insert_id($this->link);
            return array('success' => true, 'id' => $novoId);
        } else {
            return array('success' => false, 'message' => mysqli_error($this->link));
        }
    }

    public function getLancamentos() {
        $query = "SELECT
                        l.lanc_id,
                        l.lanc_dt_emissao,
                        l.lanc_descricao,
                        l.lanc_valor,
                        c.conta_nome,
                        g.grupo_nome
                        FROM plano_contas_lancamento l
                    LEFT JOIN plano_contas_conta c ON c.id_contas = l.lanc_conta
                    LEFT JOIN plano_contas_grupo g ON g.id_grupo = c.grupo
                    WHERE l.lanc_tipo = 'D'
                    ORDER BY lanc_dt_emissao DESC limit 1000";
        $stmt = mysqli_prepare($this->link, $query);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);

        $lancamentos = array();
        while ($row = mysqli_fetch_assoc($result)) {
            $lancamentos[] = $row;
        }

        return $lancamentos;
    }

    public function excluirLancamento() {
        $obj = (object) $_REQUEST['obj'];
        $lancamentoId = $obj->lancamentoId;

        $query = "DELETE FROM plano_contas_lancamento WHERE lanc_id = ?";
        $stmt = mysqli_prepare($this->link, $query);
        mysqli_stmt_bind_param($stmt, "i", $lancamentoId);
        $success = mysqli_stmt_execute($stmt);

        if ($success) {
            return array('success' => true);
        } else {
            return array('success' => false, 'message' => mysqli_error($this->link));
        }
    }
}

$col_lanc = new ColLancamentos();

// Verifica se a função foi passada como parâmetro
$funcao = isset($_REQUEST['funcao']) ? $_REQUEST['funcao'] : '';

// Verifica se o método existe na classe
if (method_exists($col_lanc, $funcao)) {

    // Chama o método da classe
    $resultado = $col_lanc->$funcao();

    // Retorna o resultado como JSON
    echo json_encode($resultado);
}