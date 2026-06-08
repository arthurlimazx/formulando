<?php
require_once '../auth/protege.php';


 include '../config/conexao.php';
if ($_SERVER['REQUEST_METHOD'] ==='POST') {
    $id = $_SESSION['id'];
    $user_id = $_SESSION['id'];
    $gp= $_POST['gp'];
    $data= $_POST['data'];
    $circuito= $_POST['circuito'];
    $pais= $_POST['pais'];
    $distancia= $_POST['distancia'];
    $voltas= $_POST['voltas'];
    $obs= $_POST['obs'];
    if (empty($gp) || empty($data) || empty($circuito) || empty($pais) || empty($distancia) || empty($voltas) || empty($obs)) {
    header("Location: create.php?erro=Preencha todos os campos");
    exit();
}

    
}
    if (!is_numeric($distancia) || $distancia < 0) {
    header("Location: create.php?erro=Distância inválida");
    exit();
}

    if (!is_numeric($voltas) || $voltas < 0) {
    header("Location: create.php?erro=Voltas inválidas");
    exit();
}


    $sql= 'INSERT INTO corridas(user_id, gp, data, circuito, pais, distancia, voltas, obs) VALUES(:user_id, :gp, :data, :circuito, :pais, :distancia, :voltas, :obs)';

    $stmt = $pdo->prepare($sql);
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
        header("Location: corridas.php?sucesso=corrida adicionada");
        exit();
        
    } else{
       
        header("Location: create.php?erro=erro ao adicionar");
    }
    
?>