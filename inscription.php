<?php
session_start();
require_once "includes/database.php";

$message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Nettoyage des données reçues
    $nom = htmlspecialchars(trim($_POST["nom"]));
    $prenom = htmlspecialchars(trim($_POST["prenom"]));
    $email = htmlspecialchars(trim($_POST["email"]));
    $motdepasse = $_POST["motdepasse"];

    if (!empty($nom) && !empty($prenom) && !empty($email) && !empty($motdepasse)) {
        
        // 1. Vérifier si l'email existe déjà
        $sql_verif = "SELECT id FROM utilisateurs WHERE email = ?";
        $stmt_verif = $pdo->prepare($sql_verif);
        $stmt_verif->execute([$email]);
        
        if ($stmt_verif->rowCount() > 0) {
            $message = "Cet email existe déjà.";
        } else {
            // 2. Hacher le mot de passe
            $passwordHash = password_hash($motdepasse, PASSWORD_DEFAULT);
            
            // 3. Insérer le nouvel utilisateur (5 colonnes, 5 points d'interrogation)
            $sql_insert = "INSERT INTO utilisateurs(nom, prenom, email, mot_de_passe, role) VALUES (?, ?, ?, ?, ?)";
            $stmt_insert = $pdo->prepare($sql_insert);
            
            $stmt_insert->execute([
                $nom,
                $prenom,
                $email,
                $passwordHash,
                "user"
            ]);
            
            $message = "Inscription réussie ! Vous pouvez maintenant vous connecter.";
        }
    } else {
        $message = "Veuillez remplir tous les champs.";
    }
}

include "includes/header.php";
?>

<div class="container">
    <h2>Inscription</h2>

    <?php if ($message != ""): ?>
        <p style="color: green; font-weight: bold;"><?php echo $message; ?></p>
    <?php endif; ?>

    <form action="" method="POST">
        <input type="text" name="nom" placeholder="Nom" required>
        <br><br>
        <input type="text" name="prenom" placeholder="Prénom" required>
        <br><br>
        <input type="email" name="email" placeholder="Email" required>
        <br><br>
        <input type="password" name="motdepasse" placeholder="Mot de passe" required>
        <br><br>
        <button type="submit">S'inscrire</button>
    </form>
    
    <p><a href="connexion.php">Déjà inscrit ? Connectez-vous ici</a></p>
</div>

<?php 
include "includes/footer.php"; 
?>
