<?php
require("config.php");
if(isset($_SESSION['Nom'])) 
{
    echo "Vous êtes connectez en tant que équipe "$_SESSION['Nom'];
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
            <h1>Page Session de test</h1>
            </font>
            <?php 
            $idSession = $_GET["idmsg"]);
            
            $mysqli = new mysqli(config_local::SERVERNAME,config_local::USER,config_local::PASSWORD,config_local::DBNAME);

            $req = $mysqli->prepare('SELECT nom FROM antibiotique a join session s on s.id_antibiotique=a.id WHERE s.id=?');
            $req->bind_param('i', $idSession);
            $req->execute();
            $resultat = $req->fetch();

            $req2 = $mysqli->prepare('SELECT nom FROM molecule');

            $req3 = $mysqli->prepare('SELECT nom FROM bacterie');

            ?>

            <table>
                <tr>
                    <th>Pour molécule <? $resultat['nom'] ?></th>
                    <?
                    $req2->execute();
                    $resultat2 = $req2->fetch();
                    while($resultat2=$req2->fetch()) { ?>
                    <th><? echo $resultat2['nom']; ?></th>
                    <? } ?>
                </tr>

                <?
                $req3->execute();
                $resultat3 = $req3->fetch();
                while($resultat3=$req3->fetch()) { ?>
                <tr><? echo $resultat3['nom']; ?></tr>
                <? } ?>



            </table>