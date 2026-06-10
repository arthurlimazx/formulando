

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="../assets/login.css">
    <link rel="stylesheet" href="../assets/navbar.css">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
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
    <?php if (isset($_SESSION['id'])): ?>
            <div class="nav-user">
                    
                    <a href="auth/logout.php" class="nav-logout">Sair</a>
                </div>
            <?php else: ?>
            <div class="nav-user">
                <a href="login.php" class="nav-login">Entrar</a>
                <a href="cadastro.php" class="nav-cadastro">Registrar</a>
            </div>
            
            <?php endif; ?>
    
    
  </div>
</nav>
</div>


<div class="pagina">
    <div class="video">
        <video autoplay muted playsinline loop src="../assets/f1.mp4"></video>


    </div>
    
    <div class="formulario">
    
        <form action="autenticaLogin.php" method="POST">
            <h1>LOGIN</h1>
        <div class="input-box">
            <input type="text" name="email" placeholder="Email"> 
            
        </div>
        <div class="input-box">
            <input type="password" name="senha" placeholder="Senha">
        </div>
            <button type="submit" class="btn">Logar</button>
            <div class="registro">
                <p>Não tem conta ainda? <a href="cadastro.php">Crie aqui</a></p>

            </div>
            </form>
        </div>
    </div>
    </div>
</body>
</html>