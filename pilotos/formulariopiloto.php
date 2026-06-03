<?php

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        
       header("Location: pilotos.php");
       exit();
    }
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
                <li><a href="pilotos.php" class="active">PILOTOS</a></li>
                <li><a href="../equipe/equipes.php">EQUIPES</a></li>
                <li><a href="../corridas/corridas.php">CALENDARIO</a></li>
            </ul>
        </div>
    </nav>
</div>

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
    <form method="POST" action="adicionarpiloto.php">
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
            <option data-color="#3671C6">Red Bull Racing</option>
            <option data-color="#E8002D">Ferrari</option>
            <option data-color="#27F4D2">Mercedes</option>
            <option data-color="#FF8000">McLaren</option>
            <option data-color="#358C75">Aston Martin</option>
            <option data-color="#0090FF">Alpine</option>
            <option data-color="#64C4FF">Williams</option>
            <option data-color="#B6BABD">Haas</option>
            <option data-color="#52E252">Kick Sauber</option>
            <option data-color="#DC0000">RB (VCARB)</option>
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