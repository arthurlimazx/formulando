<?php
include_once '../config/conexao.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nome  = trim($_POST['nome']);
    $email = trim($_POST['email']);
    $senha = trim($_POST['senha']);

    if (empty($email) || empty($senha) || empty($nome)) {
        header("Location: cadastro.php?erro=Preencha todos os campos");
        exit();
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        header("Location: cadastro.php?erro=Email inválido");
        exit();
    } elseif (strlen($senha) < 6) {
        header("Location: cadastro.php?erro=Senha tem menos que 6 letras");
        exit();
    } else {
    
        $check = $pdo->prepare('SELECT id FROM login WHERE email = :email');
        $check->bindValue(':email', $email);
        $check->execute();

        if ($check->fetch()) {
            header("Location: cadastro.php?erro=Este email já está cadastrado");
            exit();
        }

        $senha = password_hash($senha, PASSWORD_DEFAULT);

        try {
            $stmt = $pdo->prepare('INSERT INTO login (nome, email, senha) VALUES (:nome, :email, :senha)');
            $stmt->bindValue(':nome', $nome);
            $stmt->bindValue(':email', $email);
            $stmt->bindValue(':senha', $senha);
            $stmt->execute();

            header('Location: login.php?sucesso=Cadastro realizado');
            exit();
        } catch (PDOException $e) {
            header("Location: cadastro.php?erro=Erro ao cadastrar");
            exit();
        }
    }
}
?>