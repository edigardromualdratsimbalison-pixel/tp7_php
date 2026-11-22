<?php
require_once '../database/connexion.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $stmt = $pdo->prepare("INSERT INTO module (titre, horaire, id_formation) VALUES (:titre, :heure, :formation)");
    $stmt->execute([
        ':titre'     => $_POST['titre'],
        ':heure'    => $_POST['volume_horaire'],
        ':formation' => $_POST['id_formation'],
    ]);
    header('Location: index.php');
    exit;
}

$formations = $pdo->query("SELECT id_formation, nom_formation FROM formation ORDER BY nom_formation")->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Ajouter un module</title>
</head>
<body>
    <p><a href="../index.php">Accueil</a> | <a href="index.php">Liste</a></p>
    <h1>Ajouter un module</h1>
    <form method="POST">
        <p><label>Titre : <input type="text" name="titre" required></label></p>
        <p><label>Volume horaire : <input type="number" name="volume_horaire" min="1" required></label></p>
        <p><label>Formation :
            <select name="id_formation" required>
                <option value="">Votre choix</option>
                <?php foreach ($formations as $f): ?>
                    <option value="<?php echo $f['id_formation']; ?>"><?php echo htmlspecialchars($f['nom_formation']); ?></option>
                <?php endforeach; ?>
            </select>
        </label></p>
        <button type="submit">Enregistrer</button>
    </form>
</body>
</html>
