<?php
session_start();
?>
<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="utf-8">
        <title>ReSoc - logOut</title>
        <meta name="author" content="Julie, Tijana et Théo">
        <link rel="styleSheet" href="style2.css"/>
    </head>
    <body>
        <header>
            <a href="admin.php"><img src="resoc.jpg" alt="Logo de notre réseau social"/></a>
            <nav id="menu">
            <a href="news.php">Actualités</a>
                <a href="wall.php?user_id=<?php echo  $_SESSION['connected_id'] ?>">Mur</a>
                <a href="feed.php?user_id=<?php echo  $_SESSION['connected_id'] ?>">Flux</a>
                <a href="tags.php?tag_id=<?php echo  $_SESSION['connected_id'] ?>">Mots-clés</a>
            </nav>
            <nav id="user">
                <a href="#">▾ Profil</a>
                <ul>
                    <li><a href="settings.php?user_id=<?php echo  $_SESSION['connected_id'] ?>">Paramètres</a></li>
                    <li><a href="followers.php?user_id=<?php echo  $_SESSION['connected_id'] ?>">Mes suiveurs</a></li>
                    <li><a href="subscriptions.php?user_id=<?php echo  $_SESSION['connected_id'] ?>">Mes abonnements</a></li>
                    <li><a href="logOut.php?user_id=<?php echo  $_SESSION['connected_id'] ?>">Déconnexion</a></li>
                </ul>
            </nav>
        </header>
        <div id="wrapper">
            <?php include 'repeat.php'; ?>
            <aside>
                <img src="user.jpg" alt="Portrait de l'utilisatrice"/>
                <section>
                <?php $userId =intval($_GET['user_id']);
                $laQuestionEnSql = "SELECT * FROM users WHERE id = '$userId'"; 
                $lesInformations = $mysqli->query($laQuestionEnSql);
                $user = $lesInformations->fetch_assoc();?>
                <?php echo "<pre>" . print_r($userId, 1) . "</pre>"; ?> 
                    
                    <h3><?php echo $user['alias'];?></h3>
                    
                </section>
            </aside>
            <main>
                <article>
                    <h1>Déconnexion</h1>
                    <?php 
                        if (array_key_exists('logout', $_POST)) {
                            toQuit();
                        }
                        function toQuit() {
                            unset($_SESSION['connected_id']);
                            header("Location: login.php");
                        }
                    ?>
                    <form method='post'>
                    <p>Voulez-vous vous déconnecter ?<p>
                    <input type = 'submit' name='logout' class='button' value='déconnexion'>
                    </form>
                </article>
            </main>
        </div>
</html>