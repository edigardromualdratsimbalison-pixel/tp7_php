<?php
require_once '../database/connexion.php';
$sql = "SELECT e.id_etudiant, e.nom, e.prenom, e.email, f.nom_formation AS formation
        FROM Etudiant e
        JOIN formation f ON e.id_formation = f.id_formation
        ORDER BY e.id_etudiant";
$etudiants = $pdo->query($sql)->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Étudiants</title>
</head>
<body style="background-color: #3010e4;">
    <p><a href="../index.php">Accueil</a></p>
    <h1 style="color: red;">Liste des étudiants</h1>
    <p><a href="create.php">Ajouter un étudiant</a></p>
    <table border="1" cellpadding="6" style="background-color: #f8c51d;">
        <tr style="color: red;"><th>ID</th><th>Nom</th><th>Prénom</th><th>Email</th><th>Formation</th><th>Actions</th></tr>
        <?php foreach ($etudiants as $e): ?>
        <tr>
            <td><?php echo $e['id_etudiant'];?></td>
            <td><?php echo htmlspecialchars($e['nom']); ?></td>
            <td><?php echo htmlspecialchars($e['prenom']); ?></td>
            <td><?php echo htmlspecialchars($e['email']); ?></td>
            <td><?php echo htmlspecialchars($e['formation']); ?></td>
            <td>
                <a href="edit.php?id=<?php echo $e['id_etudiant']; ?>">Modifier</a> |
                <a href="delete.php?id=<?php echo $e['id_etudiant']; ?>" onclick="return confirm('Supprimer cet étudiant ?')">Supprimer</a>
            </td>
        </tr>
        <?php endforeach; ?>
    </table>
</body>
</html>
