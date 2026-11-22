<?php
require_once '../database/connexion.php';
$sql = "SELECT m.id_module, m.titre, m.horaire, f.nom_formation AS formation
        FROM module m
        JOIN formation f ON m.id_formation = f.id_formation
        ORDER BY m.id_module";
$modules = $pdo->query($sql)->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Modules</title>
</head>
<body>
    <p><a href="../index.php">Accueil</a></p>
    <h1>Liste des modules</h1>
    <p><a href="create.php">+ Ajouter un module</a></p>
    <table border="1" cellpadding="6">
        <tr><th>ID</th><th>Titre</th><th>Volume horaire (h)</th><th>Formation</th><th>Actions</th></tr>
        <?php foreach ($modules as $m): ?>
        <tr>
            <td><?php echo $m['id_module']; ?></td>
            <td><?php echo htmlspecialchars($m['titre']); ?></td>
            <td><?php echo $m['horaire']; ?></td>
            <td><?php echo htmlspecialchars($m['formation']); ?></td>
            <td>
                <a href="edit.php?id=<?= $m['id_module'] ?>">Modifier</a> |
                <a href="delete.php?id=<?= $m['id_module'] ?>" onclick="return confirm('Supprimer ce module ?')">Supprimer</a>
            </td>
        </tr>
        <?php endforeach; ?>
    </table>
</body>
</html>
