<?php
require("../Sysconf/config.php");
if(isset($_SESSION['nom']))
{
    echo "Vous êtes connecté en tant que équipe ".$_SESSION['nom'];
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
            <h1>Page Equipe</h1><br>
            </font>
            <h2>Vos sessions en cours</h2>            

            
            <?php
            $mysqli = new mysqli(config_local::SERVERNAME,config_local::USER,config_local::PASSWORD,config_local::DBNAME);
            $req = $mysqli->prepare('SELECT s.id, s.nom FROM session s JOIN etude e on e.id=s.id_etude WHERE e.en_cours = 1 AND s.id_equipe =?');
            $req->bind_param('i', $_SESSION['id']);
        	?>
            
            <table class="table">
                <tr>
                    <th>Session</th>
                    <th>Traiter</th>
                </tr>
                <?php
                $req->execute();
                $req->bind_result($id, $nom);

                while($resultat=$req->fetch()){ ?>
                <tr><td><?php echo $nom; ?></td>
                <td><?php echo '<a href="PageSessionDeTest.php?idMsg='. $id .'">Traiter cette session</a>'; ?></td></tr>
                <?php } ?>
            </table>
            <br>

            <h2>Vos sessions finies</h2>
            <?php
            $req2 = $mysqli->prepare('SELECT s.id, s.nom FROM session s JOIN etude e on e.id=s.id_etude WHERE e.en_cours = 0 AND s.id_equipe =?');
            $req2->bind_param('i', $_SESSION['id']);
            ?>
            
            <table class="table">
                <tr>
                    <th>Session</th>
                    <th>Voir</th>
                </tr>
                <?php
                $req2->execute();
                $req2->bind_result($id, $nom);

                while($resultat2=$req2->fetch()){ ?>
                <tr><td><?php echo $nom; ?></td>
                <td><?php echo '<a href="PageSessionDeTest.php?idMsg='. $id .'">Traiter cette session</a>'; ?></td></tr>
                <?php } ?>

        </div>
</body>
</html>