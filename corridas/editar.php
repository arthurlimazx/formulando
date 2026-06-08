<?php



require_once '../auth/protege.php';
include '../config/conexao.php';


$id = $_GET['id'];
$user_id = $_SESSION['id'];

$sql= 'SELECT * FROM corridas WHERE id= :id AND user_id = :user_id';

$stmt= $pdo->prepare($sql);
$stmt->bindValue(':id', $id);
$stmt->bindValue(':user_id', $user_id);
$stmt->execute();

$corrida=$stmt->fetch(PDO::FETCH_ASSOC);



if ($_SERVER['REQUEST_METHOD'] ==='POST') {
    $id = $_POST['id'];
    $gp= $_POST['gp'];
    $data= $_POST['data'];
    $circuito= $_POST['circuito'];
    $pais= $_POST['pais'];
    $distancia= $_POST['distancia'];
    $voltas= $_POST['voltas'];
    $obs= $_POST['obs'];
     if (empty($gp) || empty($data) || empty($circuito) || empty($pais) || empty($distancia) || empty($voltas) || empty($obs)) {
    header("Location: editar.php?erro=Preencha todos os campos");
    exit();
}

if (!is_numeric($distancia) || $distancia < 0) {
    header("Location: editar.php?erro=Distância inválida");
    exit();
}

if (!is_numeric($voltas) || $voltas < 0) {
    header("Location: editar.php?erro=Voltas inválidas");
    exit();
}

    $sql= 'UPDATE corridas SET gp= :gp, data= :data, circuito=:circuito, pais= :pais, distancia =:distancia, voltas= :voltas, obs= :obs WHERE id=:id AND user_id = :user_id';

    $stmt = $pdo->prepare($sql);
    $stmt->bindValue(':id', $id);
    $stmt->bindValue(':user_id', $user_id);
    $stmt->bindValue(':gp', $gp);
    $stmt->bindValue(':data', $data);
    $stmt->bindValue(':circuito', $circuito);
    $stmt->bindValue(':pais', $pais);
    $stmt->bindValue(':voltas', $voltas);
    $stmt->bindValue(':distancia', $distancia);
    $stmt->bindValue(':obs', $obs);
    $user= $stmt->execute();
    
    if ($user) {
        header("Location: corridas.php?sucesso=Corrida atualizada");
        exit();
    } else {
        header("Location: editar.php?erro=Erro ao atualizar corrida");
    }
}
    
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="../assets/navbar.css">
    <link rel="stylesheet" href="../assets/form.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Corrida</title>
</head>
<body>
    <?php include '../auth/popup.php'; ?>
    <div class="form-header">
    <div class="form-header-eyebrow">Calendário · Temporada 2026</div>
    <h1>Editar Corrida</h1>
    <p>Atualize os dados da corrida abaixo.</p>
</div>

<div class="form-wrapper">
    
    <form method="POST" action="">
    <input 
            type="hidden" 
            name="id" 
            value="<?= $corrida['id'] ?>"
        >
        <div class="form-card">
            <div class="form-card-title">Informações da corrida</div>
            <div class="form-body">

                <div class="field">
                    <label>Nome do Grande Prêmio <span>*</span></label>
                    <input type="text" name="gp" required value="<?= isset($corrida['gp']) ? htmlspecialchars($corrida['gp']) : '' ?>">
                </div>

                <div class="field-row">
                    <div class="field">
                        <label>País <span>*</span></label>
                        <input type="text" name="pais"  required value="<?= isset($corrida['pais']) ? htmlspecialchars($corrida['pais']) : '' ?>"> 
                    </div>
                    <div class="field">
                        <label>Data <span>*</span></label>
                        <input type="date" name="data" required value="<?= isset($corrida['data']) ? htmlspecialchars($corrida['data']) : '' ?>">
                    </div>
                </div>

                <div class="field">
                    <label>Circuito <span>*</span></label>
                    <input type="text" name="circuito"  required value="<?= isset($corrida['circuito']) ? htmlspecialchars($corrida['circuito']) : '' ?>">
                </div>

                <div class="field-row">
                    <div class="field">
                        <label>Número de voltas</label>
                        <input type="number" name="voltas" min="1"  value="<?= isset($corrida['voltas']) ? htmlspecialchars($corrida['voltas']) : '' ?>">
                    </div>
                    <div class="field">
                        <label>Distância (km)</label>
                        <input type="number" name="distancia" min="1"  value="<?= isset($corrida['distancia']) ? htmlspecialchars($corrida['distancia']) : '' ?>">
                    </div>
                </div>

                <div class="field">
                    <label>Observações</label>
                    <textarea name="obs"><?= isset($corrida['obs']) ? htmlspecialchars($corrida['obs']) : '' ?></textarea>
                </div>

            </div>
            <div class="form-footer">
                <a href="corridas.php" class="btn-cancel">← Cancelar</a>
                <button type="submit" class="btn-submit">Editar corrida</button>
            </div>
        </div>
    </form>
   
</div>
</body>
</html>