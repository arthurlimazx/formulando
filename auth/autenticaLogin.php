<?php
session_start();
include_once '../config/conexao.php';


$email= "";
$senha= "";

if($_SERVER['REQUEST_METHOD']=== 'POST') {
    $email=trim($_POST['email']);
    $senha=trim($_POST['senha']);




    if (empty($email) || empty($senha)) {
        echo "";
    } else{


    $stmt= $pdo->prepare('SELECT * FROM login WHERE email=:email AND senha=:senha');
    $stmt->bindValue(":email", $email);
    $stmt->bindValue(":senha", $senha);
    $stmt->execute();

    $user= $stmt->fetch();

    if ($user) {
        
        $_SESSION['id'] = $user['id'];

        header('Location: ../index.php');
        exit();
    }   else{
        
        echo "Email ou senha incorretos:(";
    }

    }
}


?>