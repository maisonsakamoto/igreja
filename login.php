<?php
include 'bd/conexao.php';

session_start();

$open = new OpenDB();
$open->server();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $query = "SELECT * FROM usuarios WHERE username = ? AND password = ?";
    $stmt = $open->conn->prepare($query);
    $stmt->bind_param("ss", $username, $password);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $_SESSION['loggedin'] = true;
        $_SESSION['username'] = $username;
        header("Location: principal.php");
    } else {
        echo "Nome de usuário ou senha inválidos.";
    }

    $stmt->close();
    $open->conn->close();
}
?>
