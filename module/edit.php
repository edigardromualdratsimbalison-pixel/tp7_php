<?php
require_once '../database/connexion.php';

$id = $_GET['id'] ?? $_POST['id_module'] ?? null;
if (!$id) { header('Location: index.php'); exit; }

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $stmt = $pdo->prepare("UPDATE module SET titre = :titre,horaire = :heure, id_formation = :formation WHERE id_module = :id");
    $stmt->execute([
        ':titre'     => $_POST['titre'],
        ':heure'    => $_POST['horaire'],
        ':formation' => $_POST['id_formation'],
        ':id'        => $id,
    ]);
    header('Location: index.php');
    exit;
}

$stmt = $pdo->prepare("SELECT * FROM module WHERE id_module = :id");
$stmt->execute([':id' => $id]);
$module = $stmt->fetch();
if (!$module) { header('Location: index.php'); exit; }

$formations = $pdo->query("SELECT id_formation, nom_formation FROM formation ORDER BY nom_formation")->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Modifier un module</title>
</head>
<body>
    <p><a href="../index.php">Accueil</a> | <a href="index.php">Liste</a></p>
    <h1>Modifier le module</h1>
    <form method="POST">
        <input type="hidden" name="id_module" value="<?php echo $module['id_module']; ?>">
        <p><label>Titre : <input type="text" name="titre" value="<?php echo htmlspecialchars($module['titre']); ?>" required></label></p>
        <p><label>Volume horaire : <input type="number" name="horaire" min="1" value="<?php echo $module['horaire']; ?>" required></label></p>
        <p><label>Formation :
            <select name="id_formation" required>
                <?php foreach ($formations as $f): ?>
                    <option value="<?php echo $f['id_formation']; ?>" <?php echo ($f['id_formation'] == $module['id_formation']) ? 'selected' : '' ?>>
                        <?php echo htmlspecialchars($f['nom_formation']); ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </label></p>
        <button type="submit">Mettre à jour</button>
    </form>
</body>
</html>
