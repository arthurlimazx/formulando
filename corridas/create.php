<?php require_once '../auth/protege.php'; 

?>



<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nova Corrida — Formula 2026</title>
    <link rel="stylesheet" href="../assets/navbar.css">
    <link rel="stylesheet" href="../assets/form.css">
</head>
<body>
    <?php include '../auth/popup.php'; ?>
    



<div class="form-header">
    <div class="form-header-eyebrow">Calendário · Temporada 2026</div>
    <h1>Nova Corrida</h1>
    <p>Preencha os dados abaixo para adicionar uma corrida ao calendário.</p>
</div>

<div class="form-wrapper">
   
    <form method="POST" action="store.php">
        <div class="form-card">
            <div class="form-card-title">Informações da corrida</div>
            <div class="form-body">
                
                <div class="field">
                    <label>Nome do Grande Prêmio <span>*</span></label>
                    <input type="text" name="gp" placeholder="Ex: Grande Prêmio do Brasil" >
                </div>

                <div class="field-row">
                    <div class="field">
                        <label>País <span>*</span></label>
                        <input type="text" name="pais" placeholder="Ex: Brasil" >
                    </div>
                    <div class="field">
                        <label>Data <span>*</span></label>
                        <input type="date" name="data" >
                    </div>
                </div>

                <div class="field">
                    <label>Circuito <span>*</span></label>
                    <input type="text" name="circuito" placeholder="Ex: Autódromo José Carlos Pace" >
                </div>

                <div class="field-row">
                    <div class="field">
                        <label>Número de voltas</label>
                        <input type="number" name="voltas"  placeholder="Ex: 71">
                    </div>
                    <div class="field">
                        <label>Distância (km)</label>
                        <input type="number" name="distancia"  placeholder="Ex: 305">
                    </div>
                </div>

                <div class="field">
                    <label>Observações</label>
                    <textarea name="obs" placeholder="Informações adicionais sobre a corrida..."></textarea>
                </div>

            </div>
            <div class="form-footer">
                <a href="corridas.php" class="btn-cancel">← Cancelar</a>
                <button type="submit" class="btn-submit">Salvar corrida</button>


            </div>
        </div>
    </form>
</div>

</body>
</html>