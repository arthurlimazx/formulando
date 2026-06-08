<?php
require_once '../auth/protege.php';
include '../config/conexao.php';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $user_id = $_SESSION['id'];
    $equipe = $_POST['equipe'];
    $descricao = $_POST['descricao'];
    $titulos = $_POST['titulos'];
    
if (empty($equipe) || empty($descricao) || empty($titulos)) {
    header("Location: create.php?erro=Preencha todos os campos");
    exit();
}
if (!is_numeric($titulos) || $titulos < 0) {
    header("Location: create.php?erro=Títulos inválido");
    exit();

}


    $sql = "INSERT INTO equipes (user_id, equipe, descricao, titulos) VALUES (:user_id, :equipe, :descricao, :titulos)";

    $stmt = $pdo->prepare($sql);
    $stmt->bindValue(':user_id', $user_id);
    $stmt->bindValue(':equipe', $equipe);
    $stmt->bindValue(':descricao', $descricao);
    $stmt->bindValue(':titulos', $titulos);
    $user= $stmt->execute();
    

    if ($user) {
        header("Location: equipes.php?sucesso=Equipe adicionada");
        exit();
    } else {
       
        header("Location: create.php?erro=Erro ao adicionar equipe");
        exit();
    }
}
?>