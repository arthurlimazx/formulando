<?php
require_once '../auth/protege.php';
include '../config/conexao.php';

$user_id = $_SESSION['id'];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'];
    $nome = $_POST['nome'];
    $numero = $_POST['numero'];
    $titulos = $_POST['titulos'];
    $equipe = $_POST['equipe'];

    if (empty($nome) || empty($numero) || empty($equipe)) {
        header("Location: editar.php?id=$id&erro=Preencha todos os campos");
        exit();
    }

    if (!is_numeric($numero) || $numero < 0) {
        header("Location: editar.php?id=$id&erro=Número inválido");
        exit(); 
    }

    if (!is_numeric($titulos) || $titulos < 0) {
        header("Location: editar.php?id=$id&erro=Títulos inválido");
        exit();
    }

    $sql = "UPDATE pilotos SET nome = :nome, numero = :numero, titulos = :titulos, equipe = :equipe WHERE id = :id AND user_id = :user_id";
    $stmt = $pdo->prepare($sql);
    $stmt->bindValue(':id', $id, PDO::PARAM_INT);
    $stmt->bindValue(':user_id', $user_id, PDO::PARAM_INT);
    $stmt->bindValue(':nome', $nome);
    $stmt->bindValue(':numero', $numero, PDO::PARAM_INT);
    $stmt->bindValue(':titulos', $titulos, PDO::PARAM_INT);
    $stmt->bindValue(':equipe', $equipe, PDO::PARAM_INT);

    if ($stmt->execute()) {
        header("Location: pilotos.php?sucesso=Piloto atualizado");
        exit();
    } else {
        header("Location: editar.php?id=$id&erro=Erro ao atualizar piloto");
        exit();
    }
}

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $sql = 'SELECT * FROM pilotos WHERE id = :id AND user_id = :user_id';
    $stmt = $pdo->prepare($sql);
    $stmt->bindValue(':id', $id, PDO::PARAM_INT);
    $stmt->bindValue(':user_id', $user_id, PDO::PARAM_INT);
    $stmt->execute();
    $piloto = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$piloto) {
        header("Location: pilotos.php");
        exit();
    }
} else {
    header("Location: pilotos.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>F1 — Editar Piloto</title>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&display=swap" rel="stylesheet" />
  <link rel="stylesheet" href="../assets/navbar.css">
  <link href="../assets/form.css" rel="stylesheet" />
</head>
<body>
<?php include '../auth/popup.php'; ?>

<div class="form-header">
  <div class="form-header-eyebrow">
    <span>F1</span>
    <span>Temporada 2026</span>
  </div>
  <h1>Editar Piloto</h1>
  <p>Atualize os dados do piloto abaixo.</p>
</div>

<div class="form-wrapper">
  <div class="form-card">
    <div class="form-card-title">Informações do Piloto</div>
    <form method="POST" action="editar.php">
      <input type="hidden" name="id" value="<?= (int) $piloto['id'] ?>">
      <div class="form-body">

        <div class="field">
          <label>Nome do piloto <span class="req">*</span></label>
          <input type="text" placeholder="Ex: Max Verstappen" name="nome" value="<?= htmlspecialchars($piloto['nome']) ?>" />
        </div>

        <div class="field-row">
          <div class="field">
            <label>Número <span class="req">*</span></label>
            <input type="number" placeholder="44" min="1" max="99" name="numero" value="<?= htmlspecialchars($piloto['numero']) ?>" />
          </div>
          <div class="field">
            <label>Títulos mundiais</label>
            <input type="number" placeholder="0" min="0" max="10" name="titulos" value="<?= htmlspecialchars($piloto['titulos']) ?>" />
          </div>
        </div>

        <div class="field" style="margin-bottom:0">
          <label>Equipe <span class="req">*</span></label>
          <div class="field-select-wrap">
            <select id="teamSelect" name="equipe">
              <option value="" disabled>Selecione a equipe</option>
              <?php
              $stmt = $pdo->prepare("SELECT id, equipe FROM equipes WHERE user_id = :user_id ORDER BY equipe ASC");
              $stmt->bindValue(':user_id', $user_id, PDO::PARAM_INT);
              $stmt->execute();
              $equipes = $stmt->fetchAll(PDO::FETCH_ASSOC);

              $valorAtual = isset($_POST['equipe']) ? $_POST['equipe'] : $piloto['equipe'];

              foreach ($equipes as $e) {
                  $selecionado = ($valorAtual == $e['equipe']) ? 'selected' : '';
                  echo "<option value=\"{$e['equipe']}\" {$selecionado}>{$e['equipe']}</option>";
              }
              ?>
            </select>
          </div>
        </div>

        <div class="form-footer">
          <a href="pilotos.php" class="btn-cancel">← Cancelar</a>
          <button type="submit" class="btn-submit">Atualizar piloto</button>
        </div>
      </div>
    </form>
  </div>
</div>

</body>
</html>
