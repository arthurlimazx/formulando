<?php
require_once '../auth/protege.php';
require_once '../config/conexao.php';

$user_id = $_SESSION['id'];
$stmt = $pdo->prepare("SELECT * FROM corridas WHERE user_id = :user_id ORDER BY data ASC");
$stmt->bindValue(':user_id', $user_id);
$stmt->execute();
$corridas = $stmt->fetchAll(PDO::FETCH_ASSOC);
$meses = ['Janeiro','Fevereiro','Março','Abril','Maio','Junho','Julho','Agosto','Setembro','Outubro','Novembro','Dezembro'];
$i = 1;
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Calendário — Formula 2026</title>
    <link rel="stylesheet" href="../assets/navbar.css">
    <link rel="stylesheet" href="../assets/corridas.css">
    <link rel="stylesheet" href="../assets/cards-footer.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="preload" as="style" href="https://fonts.googleapis.com/css2?family=Barlow+Condensed:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,400;1,700&family=Barlow:wght@300;400;500&display=swap">
    <link href="https://fonts.googleapis.com/css2?family=Barlow+Condensed:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,400;1,700&family=Barlow:wght@300;400;500&display=swap" rel="stylesheet">
    <style>
        body { background-color: white; }
    </style>
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
                <li><a href="../equipe/equipes.php">EQUIPES</a></li>
                <li><a href="corridas.php" class="active">CALENDARIO</a></li>
                
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
            <h1>CALENDÁRIO <span>2026</span></h1>
            <p>Aqui você poderá inserir e alterar todas as informações de qualquer corrida quando quiser.</p>
        </div>
        <a href="create.php" class="botao-wrapper">
            <button>+ Adicionar nova corrida</button>
        </a>
    </div>
</main>

<hr class="divisor">

<div class="grid">
    <?php foreach ($corridas as $corrida):
        $data = new DateTime($corrida['data']);
        $mes  = $meses[(int)$data->format('n') - 1];
        $dataFormatada = $data->format('d') . ' ' . $mes . ' ' . $data->format('Y');
    ?>
    <div class="crud-card">

        <div class="card-header">
            <div class="accent-bar"></div>

            <div class="bignumber">
                <?= str_pad($i, 2, '0', STR_PAD_LEFT) ?>
            </div>

            <div class="card-title">
                <?= htmlspecialchars($corrida['gp']) ?>
            </div>

            <div class="card-subtitle">
                <?= htmlspecialchars($corrida['pais']) ?>
            </div>
        </div>

        <div class="card-body">

            <div class="stat-row">
                <span class="stat-label">País</span>
                <span class="stat-value">
                    <?= htmlspecialchars($corrida['pais']) ?>
                </span>
            </div>

            <div class="stat-row">
                <span class="stat-label">Circuito</span>
                <span class="stat-value">
                    <?= htmlspecialchars($corrida['circuito']) ?>
                </span>
            </div>

            <div class="stat-row">
                <span class="stat-label">Data</span>
                <span class="team-badge">
                    <?= $dataFormatada ?>
                </span>
            </div>

            <div class="stat-row">
                <span class="stat-label">Voltas</span>
                <span class="stat-value">
                    <?= htmlspecialchars($corrida['voltas']) ?>
                </span>
            </div>

            <div class="stat-row">
                <span class="stat-label">Distância</span>
                <span class="stat-value">
                    <?= htmlspecialchars($corrida['distancia']) ?> km
                </span>
            </div>

            <div class="stat-row">
                <span class="stat-label">Observações</span>
                <span class="team-badge">
                    <?= nl2br(htmlspecialchars($corrida['obs'])) ?>
                </span>
            </div>

        </div>

        <div class="card-footer">
            <a href="editar.php?id=<?= $corrida['id'] ?>" class="action-btn">
                Editar
            </a>

            <a href="delete.php?id=<?= $corrida['id'] ?>"
               onclick="return confirm('Excluir esta corrida?')"
               class="action-btn danger">
                Excluir
            </a>
        </div>

    </div>
    <?php $i++; endforeach; ?>
</div>

</body>
</html>