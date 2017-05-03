<?php
require("../Sysconf/config.php");
if(isset($_SESSION['nom']))
{
    echo "Vous êtes connecté en tant qu'équipe ".$_SESSION['nom'];
}
else
{
    header("location: ../index.php");
}

?>
<!DOCTYPE html>

<html>

<head>
    <meta charset="UTF-8">
    <title>ANTIBIOPLUS</title>
    <link href="vue/login.css">

    <script src="https://code.jquery.com/jquery-3.1.1.js" integrity="sha256-16cdPddA6VdVInumRGo6IbivbERE8p7CQR3HzTBuELA=" crossorigin="anonymous"></script>
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

    <!-- Optional theme -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">

    <!-- Latest compiled and minified JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>

</head>

<body>

        <div class="container">
            <font color="#4CAF50">
            <h1>Page Administrateur</h1>
            </font>
            <h2>Vos études en cours</h2>




            <?php
            $mysqli = new mysqli(config_local::SERVERNAME,config_local::USER,config_local::PASSWORD,config_local::DBNAME);
            $req1 = $mysqli->prepare('SELECT id, nom FROM etude WHERE en_cours = 1');
            $req1->execute();
            $req1->bind_result($id, $nom);
        	?>

            <table class="table">
                <tr>
                    <th>Etude</th>
                    <th>Traiter</th>                    
                    <th>Supprimer</th>
                </tr>
                <?php

                while($resultat=$req1->fetch()){ ?>
                <tr><td><?php echo $nom; ?></td>
                <td><?php echo '<a href="PageModifEtude.php?idMsg='. $id .'">Traiter cette étude</a>'; ?></td>
                <td><?php echo '<a href="SupprimerEtude.php?idMsg='. $id .'" style="color: red;" onClick="return confirm('."'".'Êtes vous sûr de vouloir supprimer cette étude?'."'".')">Supprimer cette étude</a>'; ?></td></tr>
                <?php } ?>
            </table>

            <h2>Vos études finies</h2>




            <?php
            $req2 = $mysqli->prepare('SELECT id, nom FROM etude WHERE en_cours = 0');
            $req2->execute();
            $req2->bind_result($id2, $nom2);
            ?>

            <table class="table">
                <tr>
                    <th>Etude</th>
                    <th>Voir</th>
                    <th>Supprimer</th>
                </tr>
                <?php

                while($resultat=$req2->fetch()){ ?>
                <tr><td><?php echo $nom2; ?></td>
                <td><?php echo '<a href="PageEtude.php?idMsg='. $id2 .'">Voir cette étude</a>'; ?></td>
                <td><font color="red"><?php echo '<a href="SupprimerEtude.php?idMsg='. $id2 .'" style="color: red;" onClick="return confirm('."'".'Êtes vous sûr de vouloir supprimer cette étude?'."'".')">Supprimer cette étude</a>'; ?></font></td></tr>
                <?php } ?>
            </table>
            <br>
            <a href="../index.php">Retour à la connexion</a>'; ?>
        </div>
</body>
</html>
