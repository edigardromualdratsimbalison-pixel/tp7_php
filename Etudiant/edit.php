<?php
require_once '../database/connexion.php';

$id = $_GET['id'] ?? $_POST['id_etudiant'] ?? null;
if (!$id) { header('Location: index.php'); exit; }

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $stmt = $pdo->prepare("UPDATE etudiant SET nom = :nom, prenom = :prenom, email = :email, id_formation = :formation WHERE id_etudiant = :id");
    $stmt->execute([
        ':nom'       => $_POST['nom'],
        ':prenom'    => $_POST['prenom'],
        ':email'     => $_POST['email'],
        ':formation' => $_POST['id_formation'],
        ':id'        => $id,
    ]);
    header('Location: index.php');
    exit;
}

$stmt = $pdo->prepare("SELECT * FROM Etudiant WHERE id_etudiant = :id");
$stmt->execute([':id' => $id]);
$etudiant = $stmt->fetch();
if (!$etudiant) { header('Location: index.php'); exit; }

$formations = $pdo->query("SELECT id_formation, nom_formation FROM formation ORDER BY nom_formation")->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Modifier un étudiant</title>
</head>
<body>
    <p><a href="../index.php">Accueil</a> | <a href="index.php">Liste</a></p>
    <h1>Modifier l'étudiant</h1>
    <form method="POST">
        <input type="hidden" name="id_etudiant" value="<?php echo $etudiant['id_etudiant']; ?>">
        <p><label>Nom : <input type="text" name="nom" value="<?php echo htmlspecialchars($etudiant['nom']); ?>" required></label></p>
        <p><label>Prénom : <input type="text" name="prenom" value="<?php echo htmlspecialchars($etudiant['prenom']); ?>" required></label></p>
        <p><label>Email : <input type="email" name="email" value="<?php echo htmlspecialchars($etudiant['email']); ?>" required></label></p>
        <p><label>Formation :
            <select name="id_formation" required>
                <option value="">Votre choix :</option>
                <?php foreach ($formations as $f): ?>
                    <option value="<?php echo $f['id_formation']; ?>" <?php echo $f['id_formation'] == $etudiant['id_formation'] ? 'selected' : ''; ?>>
                        <?php echo htmlspecialchars($f['nom_formation']); ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </label></p>
        <button type="submit">Mettre à jour</button>
    </form>
</body>
</html>