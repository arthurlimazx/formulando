<?php
session_start();
include_once '../config/conexao.php';



if($_SERVER['REQUEST_METHOD']=== 'POST') {
    $email=trim($_POST['email']);
    $senha=trim($_POST['senha']);




    if (empty($email) || empty($senha)) {
        header("Location: login.php?erro=Preencha todos os campos");
        exit();
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        header("Location: login.php?erro=Email inválido");
        exit();
    } elseif (strlen($senha) < 6) {
        header("Location: login.php?erro=Senha tem menos que 6 letras");
        exit();
    } else {
        


    $stmt= $pdo->prepare('SELECT * FROM login WHERE email=:email');
    $stmt->bindValue(":email", $email);

    $stmt->execute();

    $user= $stmt->fetch();

    if ($user && password_verify($senha, $user['senha'])) {
        
        $_SESSION['id'] = $user['id'];

        header('Location: ../index.php?sucesso=login realizado');
        exit();
    }   else{
        
        header("Location: login.php?erro=credenciais incorretas");
        exit();
        
    }

    }
}


?>