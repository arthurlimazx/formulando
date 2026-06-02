<?php
include '../config/conexao.php';
$id = $_GET['id'];

    $sql= 'SELECT * FROM equipes WHERE id= :id';

    $stmt= $pdo->prepare($sql);
    $stmt->bindValue(':id', $id);
    $stmt->execute();
    $equipe=$stmt->fetch(PDO::FETCH_ASSOC);

include '../config/conexao.php';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id= $_POST['id'];
    $equipe = $_POST['equipe'];
    $descricao = $_POST['descricao'];
    $titulos = $_POST['titulos'];
    

    $sql = "UPDATE equipes SET equipe = :equipe, descricao = :descricao, titulos = :titulos WHERE id = :id";

    $stmt = $pdo->prepare($sql);
    $stmt->bindValue(':id', $id);
    $stmt->bindValue(':equipe', $equipe);
    $stmt->bindValue(':descricao', $descricao);
    $stmt->bindValue(':titulos', $titulos);
    $user= $stmt->execute();
    

    if ($user) {
        header("Location: equipes.php");
        exit();
    } else {
        echo "Erro ao adicionar equipe.";
    }
}
?>
    

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="../assets/navbar.css">
    <link rel="stylesheet" href="../assets/form.css">

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Equipe</title>
</head>
<body>
    <div class="form-header">
        <div class="form-header-eyebrow">
            <span>F1</span>
            <span>Temporada 2026</span>
        </div>
        <h1>Editar Equipe</h1>
    </div>

    <div class="form-wrapper">
        <form method="POST" action="editar.php">
             <input 
            type="hidden" 
            name="id" 
            value="<?= $equipe['id'] ?>"
        >
            <div class="form-card">
                <div class="form-card-title">Informações da equipe</div>
                <div class="form-body">
                    <div class="field">
                        <label>Nome da equipe <span class="req">*</span></label>
                        <input type="text" name="equipe" placeholder="Ex: McLaren" required value="<?= htmlspecialchars($equipe['equipe']) ?>">
                    </div>

                    <div class="field-row">
                        <div class="field">
                            <label>Títulos conquistados</label>
                            <input type="number" name="titulos" min="0" value="<?= htmlspecialchars($equipe['titulos']) ?>">
                        </div>
                    </div>

                    <div class="field">
                        <label>Descrição</label>
                        <textarea name="descricao" placeholder="Descreva brevemente a equipe..." rows="3"><?= htmlspecialchars($equipe['descricao']) ?></textarea>
                    </div>
                </div>

                <div class="form-footer">
                    <a href="equipes.php" class="btn-cancel">← Cancelar</a>
                    <button type="submit" class="btn-submit">Editar equipe</button>
                </div>
            </div>
        </form>
    </div>
</body>
</html>
    
</body>
</html>
