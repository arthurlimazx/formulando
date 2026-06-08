<?php
require_once 'auth/protege.php';
require_once 'config/conexao.php';


// Define quais os dados para o dashboard

$user_id = $_SESSION['id'];

// Total de pilotos

$stmt = $pdo->prepare("SELECT COUNT(*) FROM pilotos WHERE user_id = :user_id");
$stmt->execute([':user_id' => $user_id]);
$totalPilotos = $stmt->fetchColumn();

// Total de equipes

$stmt = $pdo->prepare("SELECT COUNT(*) FROM equipes WHERE user_id = :user_id");
$stmt->execute([':user_id' => $user_id]);
$totalEquipes = $stmt->fetchColumn();

// Total de corridas

$stmt = $pdo->prepare("SELECT COUNT(*) FROM corridas WHERE user_id = :user_id");
$stmt->execute([':user_id' => $user_id]);
$totalCorridas = $stmt->fetchColumn();

// Próxima corrida

$stmt = $pdo->prepare("SELECT * FROM corridas WHERE data >= CURDATE() AND user_id = :user_id ORDER BY data ASC LIMIT 1");
$stmt->execute([':user_id' => $user_id]);
$proximaCorrida = $stmt->fetch(PDO::FETCH_ASSOC);

// Últimos pilotos cadastrados

$stmt = $pdo->prepare("SELECT * FROM pilotos WHERE user_id = :user_id ORDER BY id DESC LIMIT 5");
$stmt->execute([':user_id' => $user_id]);
$ultimosPilotos = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Top equipes por títulos

$stmt = $pdo->prepare("SELECT * FROM equipes WHERE user_id = :user_id ORDER BY titulos DESC LIMIT 5");
$stmt->execute([':user_id' => $user_id]);
$topEquipes = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Próximas corridas (além da próxima)

$stmt = $pdo->prepare("SELECT * FROM corridas WHERE data >= CURDATE() AND user_id = :user_id ORDER BY data ASC LIMIT 4");
$stmt->execute([':user_id' => $user_id]);
$proximasCorridas = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Array de meses para formatação de datas

$meses = ['Jan','Fev','Mar','Abr','Mai','Jun','Jul','Ago','Set','Out','Nov','Dez'];
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard — Formula 2026</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel='stylesheet' href='assets/dashboard.css'>
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Barlow+Condensed:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,400;1,700&family=Barlow:wght@300;400;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="assets/navbar.css">
    <style>
       
    </style>
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
                <li><a href="index.php">INICIO</a></li>
                <li><a href="dashboard.php" class="active">DASHBOARD</a></li>
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

<!-- HEADER -->
<div class="dash-header">
    <div class="dash-header-eyebrow">Painel de controle · Temporada 2026</div>
    <h1>Dashboard</h1>
    <p class="dash-header-sub">Visão geral da temporada em tempo real</p>
</div>

<!-- BODY -->
<div class="dash-body">

    <!-- KPIs -->
    <div class="kpi-grid">
        <a href="corridas/corridas.php" class="kpi-card fade-in">
            <div class="kpi-icon">📅</div>
            <div class="kpi-label">Total de corridas</div>
            <div class="kpi-value"><?= str_pad((int)$totalCorridas, 2, '0', STR_PAD_LEFT) ?></div>
            <div class="kpi-link">Ver calendário →</div>
        </a>
        <a href="pilotos/pilotos.php" class="kpi-card fade-in">
            <div class="kpi-icon">🧑‍✈️</div>
            <div class="kpi-label">Pilotos registrados</div>
            <div class="kpi-value"><?= str_pad((int)$totalPilotos, 2, '0', STR_PAD_LEFT) ?></div>
            <div class="kpi-link">Ver pilotos →</div>
        </a>
        <a href="equipe/equipes.php" class="kpi-card fade-in">
            <div class="kpi-icon">🏁</div>
            <div class="kpi-label">Equipes cadastradas</div>
            <div class="kpi-value"><?= str_pad((int)$totalEquipes, 2, '0', STR_PAD_LEFT) ?></div>
            <div class="kpi-link">Ver equipes →</div>
        </a>
        <div class="kpi-card fade-in">
            <div class="kpi-icon">📆</div>
            <div class="kpi-label">Temporada</div>
            <div class="kpi-value">2026</div>
            <div class="kpi-link">Em andamento</div>
        </div>
    </div>

    <!-- NEXT RACE + UPCOMING -->
    <div class="two-col">

        <!-- Próxima corrida -->
        <div class="next-race-card">
            <div class="next-race-label">Próxima corrida</div>
            <?php if ($proximaCorrida):
                $data = new DateTime($proximaCorrida['data']);
                $mes  = $meses[(int)$data->format('n') - 1];
            ?>
            <div class="next-race-gp"><?= htmlspecialchars($proximaCorrida['gp']) ?></div>
            <div class="next-race-details">
                <div class="next-race-row">
                    <span class="next-race-key">País</span>
                    <span class="next-race-val"><?= htmlspecialchars($proximaCorrida['pais']) ?></span>
                </div>
                <div class="next-race-row">
                    <span class="next-race-key">Circuito</span>
                    <span class="next-race-val"><?= htmlspecialchars($proximaCorrida['circuito']) ?></span>
                </div>
                <div class="next-race-row">
                    <span class="next-race-key">Data</span>
                    <span class="next-race-val"><?= $data->format('d') . ' ' . $mes . ' ' . $data->format('Y') ?></span>
                </div>
                <?php if ($proximaCorrida['voltas']): ?>
                <div class="next-race-row">
                    <span class="next-race-key">Voltas</span>
                    <span class="next-race-val"><?= htmlspecialchars($proximaCorrida['voltas']) ?></span>
                </div>
                <?php endif; ?>
                <?php if ($proximaCorrida['distancia']): ?>
                <div class="next-race-row">
                    <span class="next-race-key">Distância</span>
                    <span class="next-race-val"><?= htmlspecialchars($proximaCorrida['distancia']) ?> km</span>
                </div>
                <?php endif; ?>
            </div>
            <?php else: ?>
            <div class="next-race-gp" style="font-size:1.4rem;color:#444;">Nenhuma corrida futura</div>
            <p class="no-race-msg">Adicione corridas ao calendário para visualizá-las aqui.</p>
            <?php endif; ?>
        </div>

        <!-- Próximas corridas -->
        <div class="upcoming-card">
            <div class="section-eyebrow">Calendário</div>
            <div class="section-title">Próximas corridas</div>
            <div class="race-list">
                <?php if (empty($proximasCorridas)): ?>
                    <p style="color:var(--muted);font-size:0.9rem;">Nenhuma corrida cadastrada.</p>
                <?php else: foreach ($proximasCorridas as $c):
                    $d = new DateTime($c['data']);
                    $m = $meses[(int)$d->format('n') - 1];
                ?>
                <a href="corridas/corridas.php" class="race-item">
                    <div class="race-date-badge">
                        <div class="race-date-day"><?= $d->format('d') ?></div>
                        <div class="race-date-mon"><?= strtoupper(substr($m, 0, 3)) ?></div>
                    </div>
                    <div>
                        <div class="race-info-gp"><?= htmlspecialchars($c['gp']) ?></div>
                        <div class="race-info-pais"><?= htmlspecialchars($c['pais']) ?> · <?= htmlspecialchars($c['circuito']) ?></div>
                    </div>
                    <div class="race-arrow">→</div>
                </a>
                <?php endforeach; endif; ?>
            </div>
        </div>

    </div>

    <!-- PILOTOS + EQUIPES -->
    <div class="two-col">

        <!-- Últimos pilotos -->
        <div class="table-card">
            <div class="section-eyebrow">Grid</div>
            <div class="section-title">Pilotos recentes</div>
            <table class="dash-table">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Piloto</th>
                        <th style="text-align:right">Títulos</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (empty($ultimosPilotos)): ?>
                    <tr><td colspan="3" style="color:var(--muted);padding:20px 0;">Nenhum piloto cadastrado.</td></tr>
                    <?php else: foreach ($ultimosPilotos as $p): ?>
                    <tr>
                        <td class="pilot-num"><?= htmlspecialchars($p['numero']) ?></td>
                        <td>
                            <div class="pilot-name"><?= htmlspecialchars($p['nome']) ?></div>
                            <div class="pilot-team"><?= htmlspecialchars($p['equipe']) ?></div>
                        </td>
                        <td class="pilot-titles"><?= htmlspecialchars($p['titulos']) ?></td>
                    </tr>
                    <?php endforeach; endif; ?>
                </tbody>
            </table>
            <div style="margin-top:20px">
                <a href="pilotos/pilotos.php" style="font-family:'Barlow Condensed',sans-serif;font-size:0.65rem;font-weight:700;letter-spacing:3px;text-transform:uppercase;color:var(--red);text-decoration:none;">Ver todos os pilotos →</a>
            </div>
        </div>

        <!-- Ranking equipes -->
        <div class="table-card">
            <div class="section-eyebrow">Construtores</div>
            <div class="section-title">Ranking equipes</div>
            <?php
            $maxTitulos = !empty($topEquipes) ? max(array_column($topEquipes, 'titulos')) : 1;
            $maxTitulos = max($maxTitulos, 1);
            ?>
            <?php if (empty($topEquipes)): ?>
                <p style="color:var(--muted);font-size:0.9rem;">Nenhuma equipe cadastrada.</p>
            <?php else: foreach ($topEquipes as $i => $eq): ?>
            <div class="equipe-rank-item">
                <div class="equipe-rank-pos <?= $i < 3 ? 'top' : '' ?>"><?= str_pad($i+1, 2, '0', STR_PAD_LEFT) ?></div>
                <div class="equipe-rank-name"><?= htmlspecialchars($eq['equipe']) ?></div>
                <div class="equipe-rank-bar-wrap">
                    <div class="equipe-rank-bar" style="width:<?= round(($eq['titulos'] / $maxTitulos) * 100) ?>%"></div>
                </div>
                <div class="equipe-rank-titles"><?= (int)$eq['titulos'] ?></div>
            </div>
            <?php endforeach; endif; ?>
            <div style="margin-top:20px">
                <a href="equipe/equipes.php" style="font-family:'Barlow Condensed',sans-serif;font-size:0.65rem;font-weight:700;letter-spacing:3px;text-transform:uppercase;color:var(--red);text-decoration:none;">Ver todas as equipes →</a>
            </div>
        </div>

    </div>

    <div>
        <div class="section-eyebrow">Atalhos</div>
        <div class="section-title">Ações rápidas</div>
        <div class="actions-grid">
            <a href="pilotos/formulariopiloto.php" class="action-card">
                <div class="action-icon">🧑‍✈️</div>
                <div>
                    <div class="action-text-title">Novo piloto</div>
                    <div class="action-text-sub">Cadastrar piloto no grid</div>
                </div>
                <div class="action-arrow">Adicionar →</div>
            </a>
            <a href="equipe/formularioequipe.php" class="action-card">
                <div class="action-icon">🏁</div>
                <div>
                    <div class="action-text-title">Nova equipe</div>
                    <div class="action-text-sub">Cadastrar equipe construtora</div>
                </div>
                <div class="action-arrow">Adicionar →</div>
            </a>
            <a href="corridas/create.php" class="action-card">
                <div class="action-icon">📅</div>
                <div>
                    <div class="action-text-title">Nova corrida</div>
                    <div class="action-text-sub">Adicionar ao calendário</div>
                </div>
                <div class="action-arrow">Adicionar →</div>
            </a>
        </div>
    </div>

</div>

<?php include 'auth/popup.php'; ?>

<script>
window.addEventListener('scroll', () => {
    document.getElementById('navbar').classList.toggle('scrolled', window.scrollY > 20);
});
</script>

</body>
</html>