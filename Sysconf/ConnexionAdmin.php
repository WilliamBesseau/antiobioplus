

<?php
require("config.php");

if(isset($_POST)){
$mysqli = new mysqli(config_local::SERVERNAME,config_local::USER,config_local::PASSWORD,config_local::DBNAME);
$user = $_POST['user'];
$password = $_POST['pass'];

$req = $mysqli->prepare('SELECT id, nom FROM administrateur WHERE login =? && mdp =?');
$req->bind_param('ss', $user, $password);
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
        header("location: ../Preleveur/PageAdmin.php");

    }

}
}
else
    {
      header("location: ../index.php");
    }
?>
