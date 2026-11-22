<?php
require_once '../database/connexion.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $stmt = $pdo->prepare("INSERT INTO Etudiant (nom, prenom, email, id_formation) VALUES (:nom, :prenom, :email, :formation)");
    $stmt->execute([
        ':nom'       => $_POST['nom'],
        ':prenom'    => $_POST['prenom'],
        ':email'     => $_POST['email'],
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
    <title>Ajouter un étudiant</title>
</head>
<body>
    <p><a href="../index.php">Accueil</a> | <a href="index.php">Liste</a></p>
    <h1>Ajouter un étudiant</h1>
    <form method="POST">
        <p><label>Nom : <input type="text" name="nom" required></label></p>
        <p><label>Prénom : <input type="text" name="prenom" required></label></p>
        <p><label>Email : <input type="email" name="email" required></label></p>
        <p><label>Formation :
            <select name="id_formation" required>
                <option value="">Votre choix :</option>
                <?php foreach ($formations as $form): ?>
                    <option value="<?php echo $form['id_formation']; ?>"><?php echo htmlspecialchars($form['nom_formation']); ?></option>
                <?php endforeach; ?>
            </select>
        </label></p>
        <button type="submit">Envoyer</button>
    </form>
</body>
</html>