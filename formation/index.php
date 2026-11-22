<?php
require_once '../database/connexion.php';
$formations = $pdo->query("SELECT * FROM formation ORDER BY id_formation")->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Formations</title>
</head>
<body style="background-color: rgb(240, 120, 240);">
    <p><a href="../index.php">Accueil</a></p>
    <h1>Liste des formations</h1>
    <p><a href="create.php">+ Ajouter une formation</a></p>
    <table border="1" cellpadding="6" style="background-color: #fF55;">
        <tr><th>ID</th><th>Intitulé</th><th>Durée (mois)</th><th>Actions</th></tr>
        <?php foreach ($formations as $f): ?>
        <tr>
            <td><?php echo $f['id_formation']; ?></td>
            <td><?php echo htmlspecialchars($f['nom_formation']); ?></td>
            <td><?php echo $f['duree']; ?></td>
            <td>
                <a href="edit.php?id=<?= $f['id_formation'] ?>">Modifier</a> |
                <a href="delete.php?id=<?= $f['id_formation'] ?>" onclick="return confirm('Supprimer cette formation ?')">Supprimer</a>
            </td>
        </tr>
        <?php endforeach; ?>
    </table>
</body>
</html>
