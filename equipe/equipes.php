<?php
include '../config/conexao.php';
require_once '../auth/protege.php';
$user_id = $_SESSION['id'];
$stmt = $pdo->prepare("SELECT * FROM equipes WHERE user_id = :user_id");
$stmt->bindValue(':user_id', $user_id);
$stmt->execute();
$equipes = $stmt->fetchAll(PDO::FETCH_ASSOC);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="icon" href="../assets/footer.css">
    <link rel="stylesheet" href="../assets/navbar.css">
    <link rel="stylesheet" href="../assets/equipes.css">
    <meta charset="UTF-8">
    <link rel="stylesheet" href="../assets/cards-footer.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="preload" as="style" href="https://fonts.googleapis.com/css2?family=Barlow+Condensed:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,400;1,700&family=Barlow:wght@300;400;500&display=swap">
    <link href="https://fonts.googleapis.com/css2?family=Barlow+Condensed:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,400;1,700&family=Barlow:wght@300;400;500&display=swap" rel="stylesheet">
    
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Equipes</title>
</head>
<body>
  <?php include '../auth/popup.php'; ?>   
    <div class="navbar-container">

<nav class="navbar" id="navbar">
  <div class="navbar-inner">
 
    
    <a href="../index.php" class="logo">
      <div class="logo-icone">🏎️</div>
      <div class="logo-text">
        <span class="logo-title">FORMULA</span>
        <span class="logo-season">TEMPORADA 2026</span>
      </div>
    </a>
 
    
    <ul class="nav-links">
      <li><a href="../index.php">INICIO</a></li>
      <li><a href="../dashboard.php" >DASHBOARD</a></li>
      <li><a href="../pilotos/pilotos.php">PILOTOS</a></li>
      <li><a href="equipes.php" class="active">EQUIPES</a></li>
      <li><a href="../corridas/corridas.php">CALENDARIO</a></li>
      
    </ul>
    <?php if (isset($_SESSION['id'])): ?>
            <div class="nav-user">
                    
                    <a href="../auth/logout.php" class="nav-logout">Sair</a>
                </div>
            <?php else: ?>
            <div class="nav-user">
                <a href="auth/login.php" class="nav-login">Entrar</a>
                <a href="auth/cadastro.php" class="nav-cadastro">Registrar</a>

            </div>
            <?php endif; ?>
    
    
  </div>
</nav>
</div>

<main>
    <div class="titulo">
      <div class="texto">
        <h1>EQUIPES 2026</h1>
        <p>Aqui você poderá inserir e alterar todas as informações de qualquer equipe quando quiser.</p>
      </div>
        
        <a href="create.php">
        <div class="botao">
        <button class="botao"> Adicionar nova equipe</button>
        </div>
        </a>
    
    </div>
    
</main>
<hr class="divisor">

<div class="grid">

    <?php foreach ($equipes as $equipe): ?>
  <div class="crud-card">

    <div class="card-header">
        <div class="accent-bar"></div>

        <div class="card-title">
            <?= htmlspecialchars($equipe['equipe']) ?>
        </div>

        <div class="card-subtitle">
            Construtora
        </div>
    </div>

    <div class="card-body">

        <div class="stat-row">
            <span class="stat-label">Títulos</span>
            <span class="stat-value">
                <?= htmlspecialchars($equipe['titulos']) ?>
            </span>
        </div>

        <div class="stat-row">
            <span class="stat-label">Descrição</span>
        </div>

        <div class="team-badge" style="display:block; border-radius:6px; font-weight:400; color:#555; font-size:13px; line-height:1.5;">
            <?= nl2br(htmlspecialchars($equipe['descricao'])) ?>
        </div>

    </div>

    <div class="card-footer">
        <a href="editar.php?id=<?= $equipe['id'] ?>" class="action-btn">
            Editar
        </a>

        <a onclick="return confirm('Tem certeza que deseja excluir?')"
           href="delete.php?id=<?= $equipe['id'] ?>"
           class="action-btn danger">
            Excluir
        </a>
    </div>

</div>
    <?php endforeach; ?>
</div>

</body>
</html>