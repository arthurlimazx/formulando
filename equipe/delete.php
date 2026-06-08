<?php
include '../auth/protege.php';
include '../config/conexao.php';
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $id = $_GET['id'];


    $sql = "DELETE FROM equipes WHERE id = :id AND user_id = :user_id";

    $stmt = $pdo->prepare($sql);
    $stmt->bindValue(':id', $id, PDO::PARAM_INT);
    $stmt->bindValue(':user_id', $_SESSION['id'], PDO::PARAM_INT);

    if ($stmt->execute()) {
        header("Location: equipes.php");
        exit();
    } else {
        echo "Erro ao excluir equipe.";
    }
}




?>