<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="styles.css">
    <title>Blog</title>
</head>
<body>
<?php
    try {
        $bdd = new PDO('mysql:host=localhost;dbname=test;charset=utf8;port=3307', 'root', 'root');
    }
    catch (Exception $e) {
        die('Erreur : ' .$e->getMessage());
    }

    $reponse = $bdd->query('SELECT id, titre, contenu, date_creation FROM Billets ORDER BY id DESC LIMIT 0, 5');


    echo '<h1>Mon blog</h1>';
    echo '<p>Derniers billets du blog</p>';
    while ($donnees = $reponse->fetch()) {
?>
            
            <div class="news">
                <h3><?php echo htmlspecialchars($donnees['titre']) . ' ' . htmlspecialchars($donnees['date_creation']); ?></h3>
                    <p><?php echo htmlspecialchars($donnees['contenu']); ?><br />
                        <a href="commentaires.php?billet=<?php echo htmlspecialchars($donnees['id']); ?>">Commentaires</a>
                    </p>
            </div>
<?php            
    }

$reponse->closeCursor();
        
?>
</body>
</html>