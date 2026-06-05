<?php
include_once '../config/conexao.php';


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nome = trim($_POST['nome']);
    $email = trim($_POST['email']);
    $senha = trim($_POST['senha']);

    if (empty($email) || empty($senha)) {
        header("Location: cadastro.php?erro=Preencha todos os campos");
        exit();
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        header("Location: cadastro.php?erro=Email inválido");
        exit();
    } elseif (strlen($senha) < 6) {
        header("Location: cadastro.php?erro=Senha tem menos que 6 letras");
        exit();
    } else {
       $senha = password_hash($_POST['senha'], PASSWORD_DEFAULT);
    }
     

    try {
        $stmt= $pdo->prepare('INSERT INTO login (nome, email, senha) VALUES (:nome, :email, :senha)');
    $stmt->bindValue(":nome", $nome);
    $stmt->bindValue(":email", $email);
    $stmt->bindValue(":senha", $senha);
    $stmt->execute();

    
    header('Location: ../index.php?sucesso=Cadastro realizado');
    } catch (PDOException $e) {
        header("Location: cadastro.php?erro=erro_ao_cadastrar");
        exit();
    }
    
}
?>




<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="../assets/login.css">
    <link rel="stylesheet" href="../assets/navbar.css">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php include 'popup.php'; ?>

<div class="navbar-container">


<nav class="navbar" id="navbar">
  <div class="navbar-inner">
 
    
    <a href="../index.php" class="logo">
      <div class="logo-icone">🏎️</div>
      <div class="logo-text">
        <span class="logo-title">F1 HUB</span>
        <span class="logo-season">TEMPORADA 2026</span>
      </div>
    </a>
 
    
    <ul class="nav-links">
      <li><a href="../index.php" class="active">INICIO</a></li>
      <li><a href="../pilotos/pilotos.php">PILOTOS</a></li>
      <li><a href="../equipe/equipes.php">EQUIPES</a></li>
      <li><a href="../corridas/corridas.php">CALENDARIO</a></li>
    </ul>
 
    
    
  </div>
</nav>
</div>


<div class="pagina">
    <div class="video">
        <video autoplay muted playsinline loop src="../assets/f1.mp4"></video>


    </div>
    <div class="formulario">
        
        
            <form action="" method="POST">
            <h1>CADASTRO</h1>

        <div class="input-box">
            <input type="text" name="nome" placeholder="Nome">
        </div>
        <div class="input-box">
              
            <input type="text" name="email" placeholder="Email"> 
            
        </div>
        <div class="input-box">
            <input type="password" name="senha" placeholder="Senha" >
        </div>
            <button type="submit" class="btn">Crie uma conta</button>
            <div class="registro">
               

            </div>
            </form>
        </div>
    </div>
    </div>
</body>
</html>