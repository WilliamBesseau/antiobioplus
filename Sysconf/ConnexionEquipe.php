<?php
require("config.php");

if(isset($_POST)){
$mysqli = new mysqli(config_local::SERVERNAME,config_local::USER,config_local::PASSWORD,config_local::DBNAME);
$CodePin = $_POST['PIN'];

$req = $mysqli->prepare('SELECT id, nom FROM equipe WHERE pin =?');
$req->bind_param('i', $CodePin);
$req->execute();
$req->bind_result($id, $nom);
$resultat = $req->fetch();

if (!$resultat)
{
    header("location: ../index.php?mdp=faux");
}
else
{
    session_start();
    $_SESSION['nom'] = $nom;
    $_SESSION['id'] = $id;
    header("location: ../Preleveur/PageEquipe.php");
}

}

else
    {
      header("location: ../index.php");
    }
?>
