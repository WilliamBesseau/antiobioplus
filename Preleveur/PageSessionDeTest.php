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
            <h1>Page Session de test</h1>
            </font>
            
<table class="table">
    <tr>
        <th></th>
<?php 

$idSession = $_GET["idMsg"];

$mysqli = new mysqli(config_local::SERVERNAME,config_local::USER,config_local::PASSWORD,config_local::DBNAME);
$req_molecule = $mysqli->prepare('SELECT t.diametre, m.id, m.nom, b.id, b.nom FROM Test t LEFT OUTER JOIN molecule_antibioplus m on m.id=t.id_molecule LEFT OUTER JOIN bacterie b on b.id=t.id_bacterie WHERE id_session=?');
$req_molecule->bind_param('i', $idSession);
$req_molecule->execute();
$req_molecule->bind_result($diametree, $idm, $nomm, $idb, $nomb);
while ($row = $req_molecule->fetch()) {
    $tblMolecule[$idm] = $nomm;
    echo '<th>' . $nomm . '</th>
    <tr>
    <td>' . $nomb . '</td>';
            foreach ($tblMolecule as $id_molecule=>$nom_molecule) {
                $test = isset($tblSession[$idb][$id_molecule]) ? $tblSession[$idb][$id_molecule] : 0;
                echo '<td>' . $diametree. '</td>';
            }
            echo '<tr>';
}
?>
</table>
<br>
<?php 

$mysqli = new mysqli(config_local::SERVERNAME,config_local::USER,config_local::PASSWORD,config_local::DBNAME);
            $req=$mysqli->prepare('SELECT en_cours FROM etude e JOIN session s on s.id_etude=e.id WHERE s.id=?');
            $req->bind_param('i', $idSession);
            $req->execute();
            $req->bind_result($en_cours);
if($en_cours == 0){
echo '<a href="NouveauxTest.php?idM='. $idSession .'">Rentrer un test</a>'; 
} ?>
<br>
<a href="PageEquipe.php">Retour</a>