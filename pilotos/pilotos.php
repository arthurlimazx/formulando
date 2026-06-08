<?php
require_once '../auth/protege.php';
require '../config/conexao.php';


$stmt = $pdo->prepare("SELECT * FROM pilotos WHERE user_id = :user_id");
$stmt->bindValue(':user_id', $_SESSION['id']);
$stmt->execute();
$pilotos = $stmt->fetchAll(PDO::FETCH_ASSOC);



?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="../assets/footer.css">
    <link rel="stylesheet" href="../assets/navbar.css">
    <link rel="stylesheet" href="../assets/pilotos.css">
    <link rel="stylesheet" href="../assets/cards-footer.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

    <link href="https://fonts.googleapis.com/css2?family=Barlow+Condensed:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,400;1,700&family=Barlow:wght@300;400;500&display=swap" rel="stylesheet">
    

    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pilotos</title>
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
      <li><a href="pilotos.php" class="active">PILOTOS</a></li>
      <li><a href="../equipe/equipes.php">EQUIPES</a></li>
      <li><a href="../corridas/corridas.php" class="active">CALENDARIO</a></li>
    </ul>
    <?php if (isset($_SESSION['id'])): ?>
            <div class="nav-user">
                    
                    <a href="../auth/logout.php" class="nav-logout">Sair</a>
                </div>
            <?php else: ?>
            <div class="nav-user">
                <a href="../auth/login.php" class="nav-login">Entrar</a>
                <a href="../auth/cadastro.php" class="nav-cadastro">Registrar</a>

            </div>
            <?php endif; ?>
    
    
  </div>
</nav>
</div>

<main>
    

    
    <div class="titulo">
      <div class="texto">
        <h1>PILOTOS 2026</h1>
        <p>Aqui você poderá inserir e alterar todas as informações de qualquer piloto quando quiser.</p>
      </div>
        
        <a href="create.php">
        <div class="botao">
        <button class="botao"> Adicionar novo piloto</button>
        </div>
        </a>
    
    </div>
    
    </main>
    <hr class="divisor">
    <div class="grid">
<?php foreach ($pilotos as $piloto): ?>

  <div class="crud-card">

    <div class="card-header">
        <div class="accent-bar"></div>

        <div class="bignumber">
            #<?= htmlspecialchars($piloto['numero']); ?>
        </div>

        <div class="card-title">
            <?= htmlspecialchars($piloto['nome']); ?>
        </div>

        <div class="card-subtitle">
            <?= htmlspecialchars($piloto['equipe']); ?>
        </div>
    </div>

    <div class="card-body">

        <div class="stat-row">
            <span class="stat-label">Número</span>
            <span class="stat-value">
                #<?= htmlspecialchars($piloto['numero']); ?>
            </span>
        </div>

        <div class="stat-row">
            <span class="stat-label">Títulos</span>
            <span class="stat-value">
                <?= htmlspecialchars($piloto['titulos']); ?>
            </span>
        </div>

        <div class="stat-row">
            <span class="stat-label">Equipe</span>
            <span class="team-badge">
                <?= htmlspecialchars($piloto['equipe']); ?>
            </span>
        </div>

    </div>

    <div class="card-footer">
        <a href="editar.php?id=<?= $piloto['id'] ?>" class="action-btn">
            Editar
        </a>

        <a href="delete.php?id=<?= $piloto['id'] ?>"
           onclick="return confirm('Tem certeza que deseja excluir?')"
           class="action-btn danger">
            Excluir
        </a>
    </div>

</div>

<?php endforeach; ?>
</div>



</body>
</html>