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
            <h1>Page Equipe</h1>
            </font>




            <?php
            $mysqli = new mysqli(config_local::SERVERNAME,config_local::USER,config_local::PASSWORD,config_local::DBNAME);
            $req1 = $mysqli->prepare('SELECT id, nom FROM session WHERE en_cours = 1');
            $req1->execute();
            $req1->bind_result($id, $nom);
        	?>

            <table class="table">

                <?php


                while($resultat=$req1->fetch()){ ?>
                <td><?php echo $nom; ?></td>
                <td><?php echo '<a href="PageSessionDeTest.php?idMsg='. $id .'">Traiter cette session</a>'; ?></td>
                <?php } ?>
            </table>

        </div>
</body>
</html>
