<?php
require_once '../auth/protege.php';
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <link rel="stylesheet" href="../assets/form.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>F1 — Nova Equipe</title>
</head>
<body>
    <?php include '../auth/popup.php'; ?>
    <div class="form-header">
        <div class="form-header-eyebrow">
            <span>F1</span>
            <span>Temporada 2026</span>
        </div>
        <h1>Nova Equipe</h1>
    </div>

    <div class="form-wrapper">
        
        <form method="POST" action="store.php">
            <div class="form-card">
                <div class="form-card-title">Informações da equipe</div>
                <div class="form-body">
                    <div class="field">
                        <label>Nome da equipe <span class="req">*</span></label>
                        <input type="text" name="equipe" placeholder="Ex: McLaren" >
                    </div>

                    <div class="field-row">
                        <div class="field">
                            <label>Títulos conquistados</label>
                            <input type="number" name="titulos" value="0">
                        </div>
                    </div>

                    <div class="field">
                        <label>Descrição</label>
                        <textarea name="descricao" placeholder="Descreva brevemente a equipe..." rows="3"></textarea>
                    </div>
                </div>

                <div class="form-footer">
                    <a href="equipes.php" class="btn-cancel">← Cancelar</a>
                    <button type="submit" class="btn-submit">Salvar equipe</button>
                </div>
            </div>
        </form>
    </div>
</body>
</html>
    