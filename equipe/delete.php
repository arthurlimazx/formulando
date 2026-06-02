<?php
include '../auth/protege.php';
include '../config/conexao.php';
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $id = $_GET['id'];


    $sql = "DELETE FROM equipes WHERE id = :id";

    $stmt = $pdo->prepare($sql);
    $stmt->bindValue(':id', $id, PDO::PARAM_INT);
    
    if ($stmt->execute()) {
        header("Location: equipes.php");
        exit();
    } else {
        echo "Erro ao excluir equipe.";
    }
}




?>