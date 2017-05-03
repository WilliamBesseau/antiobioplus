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
            

<?php 


$db = new PDO('mysql:host=localhost;dbname=ANTIBIOPLUS;charset=utf8', 'root', '');
$req = $db->prepare("  SELECT
                        t.id_molecule,
                        m.nom as nom_molecule,
                        t.id_bacterie,
                        b.nom as nom_bacterie,
                        t.diametre
                    FROM
                        test t
                    INNER JOIN
                        molecule_antibioplus m
                    ON
                        t.id_molecule = m.id
                    INNER JOIN
                        bacterie b
                    ON
                        t.id_bacterie = b.id
                    ORDER BY t.id_molecule, t.id_bacterie
                    ");
$req->execute();
$result = $req->fetchall(PDO::FETCH_OBJ);
 
// ibitialisation des variables
$id = array();
$molecules = array();
$tab = array();


 
// début affichage
echo "<table class='table'><tr><th></th>";
 
// on affiche la première ligne du tableau qui sont donc les molecules
foreach($result as $v){
    // si l'id du molecule n'est pas présent dans le tableau $id on crée une cellule <th>
    if(!in_array($v->id_molecule,$id)){
        echo "<th>".$v->nom_molecule."</th>";
         
        // on remplis le $molecules avec pour indice l'id du molecule et
        // pour valeur le nom du molecule
        $molecules[$v->id_molecule] = $v->nom_molecule;
         
        // on met l'id du molecule dans $id
        $id[] = $v->id_molecule;
    }
     
    // remplissage du tableau $tab
    if(!array_key_exists($v->nom_bacterie.$v->id_bacterie,$tab)){
        $tab[$v->nom_bacterie.$v->id_bacterie][0] = $v->nom_bacterie;
        $tab[$v->nom_bacterie.$v->id_bacterie][$v->id_molecule] = $v->diametre;
    }else{
        $tab[$v->nom_bacterie.$v->id_bacterie][$v->id_molecule] = $v->diametre;
    }
}
echo "</tr>";
 
// affichage des quantités
foreach($tab as $ktab=>$vtab){
    echo "<tr>";
    echo "<td>".$vtab[0]."</td>";
    foreach($molecules as $kmolecules=>$vmolecules){
        if(isset($vtab[$kmolecules])){
            echo "<td>".$vtab[$kmolecules]."</td>";
        }else{
            echo "<td>0</td>";
        }
    }
    echo "</tr>";
}
echo "</table>";
?>
<br>
<?php 

$mysqli = new mysqli(config_local::SERVERNAME,config_local::USER,config_local::PASSWORD,config_local::DBNAME);
            $req=$mysqli->prepare('SELECT en_cours FROM etude e JOIN session s on s.id_etude=e.id WHERE s.id=?');
            $req->bind_param('i', $idSession);
            $req->execute();
            $req->bind_result($en_cours);
            $resultat=$req->fetch();
if($en_cours == 1){
echo '<a href="NouveauxTest.php?idM='. $idSession .'">Rentrer un test</a>'; 
} ?>
<br>
<a href="PageEquipe.php">Retour</a>