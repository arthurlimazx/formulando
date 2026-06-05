<?php
$erro = $_GET['erro'] ?? '';
$sucesso = $_GET['sucesso'] ?? '';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/form.css">
    <title>Document</title>
</head>
<body>
    <?php if ($erro): ?>
    <div class="popup-overlay" id="popup">
        <div class="popup erro">
            <div class="popup-icone">✕</div>
            <p><?= htmlspecialchars($erro) ?></p>
            <button onclick="document.getElementById('popup').remove()">OK</button>
        </div>
    </div>
<?php endif; ?>

<?php if ($sucesso): ?>
    <div class="popup-overlay" id="popup">
        <div class="popup sucesso">
            <div class="popup-icone">✓</div>
            <p><?= htmlspecialchars($sucesso) ?></p>
            <button onclick="document.getElementById('popup').remove()">OK</button>
        </div>
    </div>
<?php endif; ?>
</body>
</html>
