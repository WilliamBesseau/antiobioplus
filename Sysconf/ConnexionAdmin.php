<?php
require("config.php");

if(isset($_POST)){
$mysqli = new mysqli(config_local::SERVERNAME,config_local::USER,config_local::PASSWORD,config_local::DBNAME);
$user = $_POST['user'];
$password = $_POST['pass'];

$req = $mysqli->prepare('SELECT id, nom FROM administrateur WHERE login =? && mdp =?');
$req->bind_param('ss', $user, $password);
$req->execute();
$req->bind_result($id, $nom);
$resultat = $req->fetch();

if (!$resultat)
{
    header("location: ../index.php?mdp=faux2");
}
else
{

    	session_start();
      $_SESSION['Nom'] = $nom;
      $_SESSION['id'] = $id;
      header("location: ../AdministrateurPageAdmin.php");


}
}
else
    {
      header("location: ../index.php");
    }
?>
