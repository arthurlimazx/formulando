<?php

require_once 'config/conexao.php';


session_start();


if (isset($_SESSION['id'])) {
    $id_usuario = $_SESSION['id'];
   
}
?>





<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formula 2026 — Temporada</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Barlow+Condensed:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,400;1,700&family=Barlow:wght@300;400;500&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="assets/navbar.css">
    <link rel="stylesheet" href="assets/index.css">
</head>
<body>


<div class="navbar-container">
    <nav class="navbar" id="navbar">
        <div class="navbar-inner">
            <a href="index.php" class="logo">
                <div class="logo-icone">🏎️</div>
                <div class="logo-text">
                    <span class="logo-title">FORMULA</span>
                    <span class="logo-season">TEMPORADA 2026</span>
                </div>
            </a>
            <ul class="nav-links">
                <li><a href="index.php" class="active">INICIO</a></li>
                <li><a href="dashboard.php" >DASHBOARD</a></li>
                <li><a href="pilotos/pilotos.php">PILOTOS</a></li>
                <li><a href="equipe/equipes.php">EQUIPES</a></li>
                <li><a href="corridas/corridas.php">CALENDARIO</a></li>
            </ul>

            <?php if (isset($_SESSION['id'])): ?>
            <div class="nav-user">
                    
                    <a href="auth/logout.php" class="nav-logout">Sair</a>
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

<section class="hero">
    <div class="hero-content">
        <div class="hero-season fade-up">Temporada oficial · 2026</div>
        <h1 class="hero-title fade-up">
            Formula
            <span class="year">2026</span>
        </h1>
        <p class="hero-sub fade-up">
            Gerencie pilotos, equipes e o calendário completo da temporada. Tudo em um só lugar.
        </p>
        <div class="hero-cta fade-up">
            <a href="corridas/corridas.php" class="btn-primary">Ver Calendário</a>
            <a href="pilotos/pilotos.php" class="btn-ghost">Explorar Pilotos</a>
        </div>
    </div>
</section>




<section class="nav-section">
    <div class="nav-section-header">
        <div class="section-eyebrow">Gerenciar</div>
        <h2 class="section-title">O que você<br>deseja fazer?</h2>
    </div>
    <div class="nav-grid">
        <a href="pilotos/pilotos.php" class="nav-card">
            <span class="nav-card-icon">🧑‍✈️</span>
            <div class="nav-card-title">Pilotos</div>
            <div class="nav-card-desc">Cadastre e gerencie todos os pilotos da temporada, com número, equipe e títulos.</div>
            <div class="nav-card-arrow">Ver pilotos →</div>
        </a>
        <a href="equipe/equipes.php" class="nav-card">
            <span class="nav-card-icon">🏁</span>
            <div class="nav-card-title">Equipes</div>
            <div class="nav-card-desc">Adicione e edite as equipes participantes, incluindo histórico de títulos conquistados.</div>
            <div class="nav-card-arrow">Ver equipes →</div>
        </a>
        <a href="corridas/corridas.php" class="nav-card">
            <span class="nav-card-icon">📅</span>
            <div class="nav-card-title">Calendário</div>
            <div class="nav-card-desc">Organize todas as corridas da temporada com datas, circuitos e informações técnicas.</div>
            <div class="nav-card-arrow">Ver calendário →</div>
        </a>
    </div>
</section>


<footer class="footer">
    <div class="footer-logo">Formula <span>2026</span></div>
    <div class="footer-copy">© 2026 — Sistema de Gestão da Temporada</div>
</footer>




</body>
</html>