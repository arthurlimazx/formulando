<?php
require_once '../auth/protege.php';
include '../config/conexao.php';
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $id = $_GET['id'];
     $user_id = $_SESSION['id'];

    $sql = "DELETE FROM pilotos WHERE id = :id AND user_id = :user_id";
    $stmt = $pdo->prepare($sql);
    $stmt->bindValue(':id', $id, PDO::PARAM_INT);
    $stmt->bindValue(':user_id', $user_id, PDO::PARAM_INT);

    if ($stmt->execute()) {
        header("Location: pilotos.php");
        exit();
    } else {
        echo "Erro ao deletar piloto.";
    }
}


?>