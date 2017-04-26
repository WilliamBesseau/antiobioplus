<?php 
require("config.php");

if(isset($_POST)){
$mysqli = new mysqli(config_local::SERVERNAME,config_local::USER,config_local::PASSWORD,config_local::DBNAME);
$CodePin = $_POST['PIN'];

$req = $mysqli->prepare('SELECT id, nom FROM equipe WHERE pin =?');
$req->bind_param('i', $CodePin);
$req->execute();
$resultat = $req->fetch();

if (!$resultat)
{
    header("location: ../index.php?mdp=faux");
}
else
{   
    if(!isset($_SESSION)) 
    { 
    	session_start();
        $_SESSION['Nom'] = $resultat[0]["Nom"];
        $_SESSION['id'] = $resultat[0]["id"];
        header("location: ../Preleveur/PageEquipe.php");

    }
    
}
}
else
    {
      header("location: ../index.php");
    }