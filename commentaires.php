<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="styles.css">
    <title>Commentaires</title>
</head>
<body>
    <h1>Mon blog</h1>
    <a href="index.php">Retour à la liste des billets</a>
<?php
    // Connexion à la BDD
    try {
        $bdd = new PDO('mysql:host=localhost;dbname=test;charset=utf8;port=3307', 'root', 'root');
    }
    catch (Exception $e) {
        die('Erreur : ' .$e->getMessage());
    }


    // Récupération du billet
    $req = $bdd->prepare('SELECT id, titre, contenu, date_creation FROM billets WHERE id = ?');
    $req->execute(array($_GET['billet']));
    $donnees = $req->fetch();
 ?>   

    <div class="news">
        <h3><?php echo htmlspecialchars($donnees['titre']) . ' ' . htmlspecialchars($donnees['date_creation']); ?></h3>
            <p><?php echo htmlspecialchars($donnees['contenu']); ?></p>
    </div>

    <h2>Commentaires</h2>
<?php
    $req->closeCursor();

    //  Récupération des commentaires
    $req = $bdd->prepare('SELECT auteur, date_commentaire, commentaire FROM commentaires WHERE id_billet = ? ORDER BY date_commentaire');
    $req->execute(array($_GET['billet']));

    while ($donnees = $req->fetch()) {
?>
    <p><strong><?php echo htmlspecialchars($donnees['auteur']) . ' '; ?></strong><?php echo htmlspecialchars($donnees['date_commentaire']); ?></p>
    <p><?php echo htmlspecialchars($donnees['commentaire']); ?></p>
<?php        
    }
$req->closeCursor();
?>    
</body>
</html>