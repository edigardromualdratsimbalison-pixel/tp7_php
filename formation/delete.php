<?php
require_once '../database/connexion.php';

$id = $_GET['id'] ?? null;
if ($id) {
    try {
        $stmt = $pdo->prepare("DELETE FROM formation WHERE id_formation = :id");
        $stmt->execute([':id' => $id]);
    } catch (PDOException $e) {
        // Clé étrangère : la formation contient encore des étudiants ou des modules
        echo "<p>Impossible de supprimer : cette formation contient encore des étudiants ou des modules.</p>";
        echo '<p><a href="index.php">Retour à la liste</a></p>';
        exit;
    }
}
header('Location: index.php');
exit;
