<?php
session_start();
include 'restriction.php';
?>
<!doctype html>
<html lang="fr">
    <head>
        <meta charset="utf-8">
        <title>ReSoC - Mes abonnements</title> 
        <meta name="author" content="Julien Falconnet">
        <link rel="stylesheet" href="style2.css"/>
    </head>
    <body>
        <header>
        <a href='admin.php'><img src="resoc.jpg" alt="Logo de notre réseau social"/></a>
            <nav id="menu">
                <a href="news.php">Actualités</a>
                <a href="wall.php?user_id=<?php echo  $_SESSION['connected_id'] ?>">Mur</a>
                <a href="feed.php?user_id=<?php echo  $_SESSION['connected_id'] ?>">Flux</a>
                <a href="tags.php?tag_id=<?php echo  $_SESSION['connected_id'] ?>">Mots-clés</a>
            </nav>
            <nav id="user">
                <a href="#">Profil</a>
                <ul>
                    <li><a href="settings.php?user_id=<?php echo  $_SESSION['connected_id'] ?>">Paramètres</a></li>
                    <li><a href="followers.php?user_id=<?php echo  $_SESSION['connected_id'] ?>">Mes suiveurs</a></li>
                    <li><a href="subscriptions.php?user_id=<?php echo  $_SESSION['connected_id'] ?>">Mes abonnements</a></li>
                    <li><a href="logOut.php?user_id=<?php echo  $_SESSION['connected_id'] ?>">Déconnexion</a></li>
                </ul>

            </nav>
        </header>
        <div id="wrapper">
            <aside>
                <img src="user.jpg" alt="Portrait de l'utilisatrice"/>
                <section>
                    <h3>Présentation</h3>
                    <p>Sur cette page vous trouverez la liste des personnes dont
                        l'utilisatrice
                        n° <?php echo intval($_GET['user_id']) ?>
                        suit les messages
                    </p>

                </section>
            </aside>
            <main class='contacts'>
                <?php
                // Etape 1: récupérer l'id de l'utilisateur
                $userId = intval($_GET['user_id']);
                // Etape 2: se connecter à la base de donnée
                include 'repeat.php';
                // Etape 3: récupérer le nom de l'utilisateur
                $laQuestionEnSql = "
                    SELECT users.* 
                    FROM followers 
                    LEFT JOIN users ON users.id=followers.followed_user_id 
                    WHERE followers.following_user_id='$userId'
                    GROUP BY users.id
                    ";
                $lesInformations = $mysqli->query($laQuestionEnSql);
                // Etape 4: à vous de jouer
                //@todo: faire la boucle while de parcours des abonnés et mettre les bonnes valeurs ci dessous 
                while ($user = $lesInformations->fetch_assoc())
                {
         
                ?>
                <article>
                    <img src="user.jpg" alt="blason"/>
                    <a href="wall.php?user_id=<?php echo $user['id'] ?>">
                        <h3><?php echo $user['alias'] ?></h3>
                    </a>
                    <p>id:<?php echo $user['id'] ?></p>                    
                </article>
                <?php }?>
            </main>
        </div>
    </body>
</html>
