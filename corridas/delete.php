<?php

include '../auth/protege.php';
include '../config/conexao.php';

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $id = $_GET['id'];

    $sql = "DELETE FROM corridas WHERE id = :id";
    $stmt = $pdo->prepare($sql);
    $stmt->bindValue(':id', $id, PDO::PARAM_INT);

    if ($stmt->execute()) {
        header("Location: corridas.php");
        exit();
    } else {
        echo "Erro ao deletar corrida.";
    }
}


?>