<?php
require_once '../database/connexion.php';

$id = $_GET['id'] ?? $_POST['id_formation'] ?? null;
if (!$id) { header('Location: index.php'); exit; }

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $stmt = $pdo->prepare("UPDATE formation SET nom_formation = :libelle, duree = :mois WHERE id_formation = :id");
    $stmt->execute([
        ':libelle' => $_POST['nom_formation'],
        ':mois'    => $_POST['duree'],
        ':id'       => $id,
    ]);
    header('Location: index.php');
    exit;
}

$stmt = $pdo->prepare("SELECT * FROM formation WHERE id_formation = :id");
$stmt->execute([':id' => $id]);
$formation = $stmt->fetch();
if (!$formation) { header('Location: index.php'); exit; }
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Modifier une formation</title>
</head>
<body>
    <p><a href="../index.php">Accueil</a> | <a href="index.php">Liste</a></p>
    <h1 style="text-transform=italic;">Modifier la formation</h1>
    <form method="POST">
        <input type="hidden" name="id_formation" value="<?php echo $formation['id_formation']; ?>">
        <p><label>Intitulé : <input type="text" name="nom_formation" value="<?php echo htmlspecialchars($formation['nom_formation']); ?>" required></label></p>
        <p><label>Durée (mois) : <input type="number" name="duree" min="1" value="<?php echo $formation['duree']; ?>" required></label></p>
        <button type="submit">Update</button>
    </form>
</body>
</html>
