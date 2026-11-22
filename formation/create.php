<?php
require_once '../database/connexion.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $stmt = $pdo->prepare("INSERT INTO formation (nom_formation,duree) VALUES (:nom_formation, :duree)");
    $stmt->execute([
        ':nom_formation' => $_POST['nom_formation'],
        ':duree'    => $_POST['duree'],
    ]);
    header('Location: index.php');
    exit;
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Ajouter une formation</title>
</head>
<body>
    <p><a href="../index.php">Accueil</a> | <a href="index.php">Liste</a></p>
    <h1>Ajouter une formation</h1>
    <form method="POST">
        <p><label>Intitulé : <input type="text" name="nom_formation" required></label></p>
        <p><label>Durée (mois) : <input type="number" name="duree" min="1" required></label></p>
        <button type="submit">Enregistrer</button>
    </form>
</body>
</html>
