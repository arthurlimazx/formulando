<?php
require_once '../config/conexao.php';
require_once '../auth/protege.php';

?>

    

<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>F1 — Cadastro de Piloto</title>
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
  <h1>Novo Piloto</h1>
  <p>Preencha os dados abaixo para adicionar um piloto ao grid.</p>
</div>

<div class="form-wrapper">

  <div class="form-card">
    <div class="form-card-title">Informações do Piloto</div>
  
    <form method="POST" action="store.php">
      <div class="form-body">

      <div class="field">
        <label>Nome do piloto <span class="req">*</span></label>
        <input type="text" placeholder="Ex: Max Verstappen" name="nome" />
      </div>

      <div class="field-row">
        <div class="field">
          <label>Número <span class="req">*</span></label>
          <input type="number" placeholder="44" min="1" max="99" name="numero" />
        </div>
        <div class="field">
          <label>Títulos mundiais</label>
          <input type="number" placeholder="0" min="0" max="10" name="titulos" />
        </div>
      </div>

      <div class="field" style="margin-bottom:0">
        <label>Equipe <span class="req">*</span></label>
        <div class="field-select-wrap">
          <select id="teamSelect" name="equipe">
           <option value="" disabled selected>Selecione a equipe</option>
            <?php
            $stmt = $pdo->prepare("SELECT id, equipe FROM equipes WHERE user_id = :user_id ORDER BY equipe ASC");
            $stmt->bindValue(':user_id', $_SESSION['id']);
            $stmt->execute();
            $equipes = $stmt->fetchAll(PDO::FETCH_ASSOC);

            foreach ($equipes as $e) {
              $selecionado = (isset($_POST['equipe']) && $_POST['equipe'] == $e['id']) ? 'selected' : '';
              echo "<option value=\"{$e['equipe']}\" {$selecionado}>{$e['equipe']}</option>";
          }
  ?>
</select>
        </div>
      </div>

      <div class="form-footer">
        <a href="pilotos.php" class="btn-cancel">← Cancelar</a>
        <button type="submit" class="btn-submit">Registrar piloto</button>
      </div>
      </div>
    </form>
  </div>
</div>

</body>
</html>