<?php
require_once 'auth/protege.php';
require_once 'config/conexao.php';

$user_id = $_SESSION['id'];

$totalPilotos = $pdo->prepare("SELECT COUNT(*) FROM pilotos WHERE user_id = :user_id");
$totalPilotos->execute(['user_id' => $user_id]);
$totalPilotos = $totalPilotos->fetchColumn();
$totalEquipes = $pdo->prepare("SELECT COUNT(*) FROM equipes WHERE user_id = :user_id");
$totalEquipes->execute(['user_id' => $user_id]);
$totalEquipes = $totalEquipes->fetchColumn();
$totalCorridas = $pdo->prepare("SELECT COUNT(*) FROM corridas WHERE user_id = :user_id");
$totalCorridas->execute(['user_id' => $user_id]);
$totalCorridas = $totalCorridas->fetchColumn();

$proximaCorrida = $pdo->prepare("SELECT * FROM corridas WHERE data >= CURDATE() AND user_id = :user_id ORDER BY data ASC LIMIT 1");
$proximaCorrida->execute(['user_id' => $user_id]);
$proximaCorrida = $proximaCorrida->fetch(PDO::FETCH_ASSOC);
$meses = ['Jan','Fev','Mar','Abr','Mai','Jun','Jul','Ago','Set','Out','Nov','Dez'];

$equipes = $pdo->prepare("SELECT * FROM equipes WHERE user_id = :user_id ORDER BY titulos DESC");
$equipes->execute(['user_id' => $user_id]);
$equipes = $equipes->fetchAll(PDO::FETCH_ASSOC);

// Mapa de cores por nome de equipe(generico)
$teamColors = [
    'red bull'    => ['#3671C6','#1a3a7a'],
    'ferrari'     => ['#E8002D','#a30020'],
    'mercedes'    => ['#27F4D2','#0da88f'],
    'mclaren'     => ['#FF8000','#b35900'],
    'aston martin'=> ['#358C75','#1f5445'],
    'alpine'      => ['#0090FF','#005fb3'],
    'williams'    => ['#64C4FF','#2a8bbf'],
    'haas'        => ['#B6BABD','#6b6f72'],
    'sauber'      => ['#52E252','#27a327'],
    'kick sauber' => ['#52E252','#27a327'],
    'rb'          => ['#DC0000','#8a0000'],
    'vcarb'       => ['#DC0000','#8a0000'],
];

function getTeamColors(string $nome, array $map): array {
    $lower = strtolower($nome);
    foreach ($map as $key => $colors) {
        if (str_contains($lower, $key)) return $colors;
    }
    return ['#E10600','#8a0000'];
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


<div class="stats-bar">
    <div class="stat-item">
        <div class="stat-num"><?= str_pad((int)$totalCorridas, 2, '0', STR_PAD_LEFT) ?></div>
        <div class="stat-label">Corridas</div>
    </div>
    <div class="stat-item">
        <div class="stat-num"><?= str_pad((int)$totalPilotos, 2, '0', STR_PAD_LEFT) ?></div>
        <div class="stat-label">Pilotos</div>
    </div>
    <div class="stat-item">
        <div class="stat-num"><?= str_pad((int)$totalEquipes, 2, '0', STR_PAD_LEFT) ?></div>
        <div class="stat-label">Equipes</div>
    </div>
    <div class="stat-item">
        <div class="stat-num">2026</div>
        <div class="stat-label">Temporada</div>
    </div>
</div>


<div class="marquee-wrap">
    <div class="marquee-track">
        <?php
        $items = ['Formula 2026','Temporada Em Curso','Calendário Atualizado','Pilotos Registrados','Equipes Cadastradas','Gerencie Sua Temporada'];
        $repeated = array_merge($items, $items);
        foreach ($repeated as $item): ?>
            <span class="marquee-item"><?= $item ?></span>
            <span class="marquee-dot">✦</span>
        <?php endforeach; ?>
    </div>
</div>


<section class="equipes-section">
    <div class="equipes-header">
        <div>
            <div class="section-eyebrow">Grid da temporada</div>
            <h2 class="section-title">Equipes <br>2026</h2>
        </div>
        <div style="display:flex;flex-direction:column;align-items:flex-end;gap:16px">
            <div class="carousel-controls">
                <button class="carousel-btn" id="prevBtn">&#8592;</button>
                <button class="carousel-btn" id="nextBtn">&#8594;</button>
            </div>
            <a href="equipe/equipes.php" style="font-family:'Barlow Condensed',sans-serif;font-size:0.7rem;font-weight:700;letter-spacing:3px;text-transform:uppercase;color:var(--red);text-decoration:none;">Ver todas →</a>
        </div>
    </div>

    <div class="carousel-track-wrap" id="carouselWrap">
        <div class="carousel-track" id="carouselTrack">
            <?php foreach ($equipes as $i => $eq):
                [$cor1, $cor2] = getTeamColors($eq['equipe'], $teamColors);
            ?>
            <a href="equipe/equipes.php" class="equipe-card">
                <div class="equipe-card-bg" style="background: linear-gradient(135deg, <?= $cor1 ?> 0%, <?= $cor2 ?> 100%);"></div>
                <div class="equipe-card-content">
                    <div class="equipe-card-index">Equipe · <?= str_pad($i+1, 2, '0', STR_PAD_LEFT) ?></div>
                    <div class="equipe-card-nome"><?= htmlspecialchars($eq['equipe']) ?></div>
                    <?php if (!empty($eq['descricao'])): ?>
                    <div class="equipe-card-desc"><?= htmlspecialchars($eq['descricao']) ?></div>
                    <?php else: ?>
                    <div style="margin-bottom:24px"></div>
                    <?php endif; ?>
                    <div class="equipe-card-footer">
                        <div class="equipe-titulos">
                            <span class="equipe-titulos-num"><?= (int)$eq['titulos'] ?></span>
                            <span class="equipe-titulos-label">Títulos</span>
                        </div>
                        <span class="equipe-card-arrow">→</span>
                    </div>
                </div>
            </a>
            <?php endforeach; ?>

            <?php if (empty($equipes)): ?>
            <div style="padding:60px;color:var(--muted);font-family:'Barlow Condensed',sans-serif;font-size:1.2rem;">
                Nenhuma equipe cadastrada ainda.
            </div>
            <?php endif; ?>
        </div>
    </div>

    <div class="carousel-dots" id="carouselDots"></div>
</section>


<section class="next-race">
    <div>
        <div class="section-eyebrow">Na pista em breve</div>
        <h2 class="section-title">
            Próxima<br>Corrida
        </h2>

        <?php if ($proximaCorrida): ?>
        <?php
            $data = new DateTime($proximaCorrida['data']);
            $mes  = $meses[(int)$data->format('n') - 1];
        ?>
        <div class="next-race-info">
            <div class="race-detail">
                <span class="race-key">Grande Prêmio</span>
                <span class="race-val"><?= htmlspecialchars($proximaCorrida['gp']) ?></span>
            </div>
            <div class="race-detail">
                <span class="race-key">País</span>
                <span class="race-val"><?= htmlspecialchars($proximaCorrida['pais']) ?></span>
            </div>
            <div class="race-detail">
                <span class="race-key">Circuito</span>
                <span class="race-val"><?= htmlspecialchars($proximaCorrida['circuito']) ?></span>
            </div>
            <?php if ($proximaCorrida['voltas']): ?>
            <div class="race-detail">
                <span class="race-key">Voltas</span>
                <span class="race-val"><?= htmlspecialchars($proximaCorrida['voltas']) ?></span>
            </div>
            <?php endif; ?>
            <?php if ($proximaCorrida['distancia']): ?>
            <div class="race-detail">
                <span class="race-key">Distância</span>
                <span class="race-val"><?= htmlspecialchars($proximaCorrida['distancia']) ?> km</span>
            </div>
            <?php endif; ?>
        </div>
        <?php else: ?>
        <p class="no-race" style="margin-top:32px">Nenhuma corrida futura cadastrada ainda.</p>
        <?php endif; ?>
    </div>

    <div class="next-race-visual">
        <?php if ($proximaCorrida): ?>
        <div class="date-block">
            <div class="date-day"><?= $data->format('d') ?></div>
            <div class="date-month"><?= strtoupper($mes) ?></div>
            <div class="date-year"><?= $data->format('Y') ?></div>
        </div>
        <?php else: ?>
        <div class="date-block">
            <div class="date-day">—</div>
            <div class="date-month">Em Breve</div>
        </div>
        <?php endif; ?>
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

<script>
(function() {
    const track   = document.getElementById('carouselTrack');
    const wrap    = document.getElementById('carouselWrap');
    const prevBtn = document.getElementById('prevBtn');
    const nextBtn = document.getElementById('nextBtn');
    const dotsWrap= document.getElementById('carouselDots');

    if (!track) return;

    const cards      = Array.from(track.children);
    const cardWidth  = 300 + 20; // card + gap
    const visible    = Math.max(1, Math.floor(wrap.offsetWidth / cardWidth));
    const maxIndex   = Math.max(0, cards.length - visible);
    let current      = 0;


    const totalDots = maxIndex + 1;
    for (let i = 0; i < totalDots; i++) {
        const d = document.createElement('div');
        d.className = 'carousel-dot' + (i === 0 ? ' active' : '');
        d.addEventListener('click', () => goTo(i));
        dotsWrap.appendChild(d);
    }

    function goTo(idx) {
        current = Math.max(0, Math.min(idx, maxIndex));
        track.style.transform = `translateX(-${current * cardWidth}px)`;
        dotsWrap.querySelectorAll('.carousel-dot').forEach((d, i) =>
            d.classList.toggle('active', i === current)
        );
    }

    prevBtn.addEventListener('click', () => goTo(current - 1));
    nextBtn.addEventListener('click', () => goTo(current + 1));

  
    let startX = 0, isDragging = false, startTranslate = 0;

    wrap.addEventListener('mousedown', e => {
        isDragging = true;
        startX = e.clientX;
        startTranslate = current * cardWidth;
        track.style.transition = 'none';
    });

    window.addEventListener('mousemove', e => {
        if (!isDragging) return;
        const delta = startX - e.clientX;
        track.style.transform = `translateX(-${startTranslate + delta}px)`;
    });

    window.addEventListener('mouseup', e => {
        if (!isDragging) return;
        isDragging = false;
        track.style.transition = '';
        const delta = startX - e.clientX;
        if (Math.abs(delta) > 80) goTo(delta > 0 ? current + 1 : current - 1);
        else goTo(current);
    });

    // Touch
    wrap.addEventListener('touchstart', e => {
        startX = e.touches[0].clientX;
        startTranslate = current * cardWidth;
        track.style.transition = 'none';
    }, { passive: true });

    wrap.addEventListener('touchend', e => {
        track.style.transition = '';
        const delta = startX - e.changedTouches[0].clientX;
        if (Math.abs(delta) > 60) goTo(delta > 0 ? current + 1 : current - 1);
        else goTo(current);
    });
})();
</script>

</body>
</html>