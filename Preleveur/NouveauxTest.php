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
            <h1>Page ajout test</h1><br>
            </font>

            <form class='' action='' method='post'>
            
            Selectionner la molécule antibioplus concernée <br>
            <?php
            $idSession = $_GET["idM"];

            $mysqli = new mysqli(config_local::SERVERNAME,config_local::USER,config_local::PASSWORD,config_local::DBNAME);
            $req=$mysqli->prepare('SELECT id FROM etude e JOIN session s on s.id_etude=e.id WHERE s.id=?');
            $req->bind_param('i', $idSession);
            $req->execute();
            $req->bind_result($idEtude);

            $req2=$mysqli->prepare('SELECT nom FROM molecule_antibioplus m JOIN etude_molecule em on em.id_molecule=m.id JOIN etude e on e.id=em.id_etude WHERE e.id=?');
            $req2->bind_param('i', $idEtude);
            $req2->execute();
            $req2->bind_result($NomMolecule);
            echo "<select name='MoleculeSelection' size='1'>";
            while ($req2->fetch()) {
            printf("<option> $NomMolecule");
            }
            ?>
            </select>

            Selectionner la bacterie concernée <br>
            <?php
            $req3=$mysqli->prepare('SELECT nom FROM bacterie b JOIN etude_bacterie eb on eb.id_bacterie=b.id JOIN etude e on e.id=eb.id_etude WHERE e.id=?');
            $req3->bind_param('i', $idEtude);
            $req3->execute();
            $req3->bind_result($NomBacterie);
            echo "<select name='BacterieSelection' size='1'>";
            while ($req3->fetch()) {
            printf("<option> $NomBacterie");
            }
            ?>
            </select>

            Diamètre : <input type="text" name="Diamètre" required> <br>
            <input type='hidden' name='idSession' value='$idSession'>
            <input class="btn btn-info" type='submit' name='inserer' value='Valider'>

<?php
if (isset($_POST['inserer'])) {
        echo "Votre test a bien été traité";
        $mysqli = new mysqli(config_local::SERVERNAME,config_local::USER,config_local::PASSWORD,config_local::DBNAME);
        $Diametre = $_POST['Diametre'];
        $Bacterie = $_POST['BacterieSelection'];
        $Molecule = $_POST['MoleculeSelection'];
        $id_session = $_POST['idSession'];

        $req4=$mysqli->prepare("SELECT id FROM molecule_antibioplus WHERE nom=?");
        $req4->bind_param("s", $Molecule);
        $req4->execute();
        $req4->bind_result($idMolecule);

        $req5=$mysqli->prepare("SELECT id FROM bacterie WHERE nom=?");
        $req5->bind_param("s", $Bacterie);
        $req5->execute();
        $req5->bind_result($idBacterie);

        $req6=$mysqli->prepare("INSERT INTO `test` (`id`, `diametre`, `id_molecule`, `id_session`, `id_bacterie`) VALUES (NULL, ?, ?, ?, ?);");
        $req6->bind_param("iiii", $Diametre, $idMolecule, $id_session, $idBacterie);
        $req6->execute();

        echo "<h2 align='center' style='color:green;'>Votre test a été créé avec succès ! Vous allez être rediriger vers la page de session d'ici quelques secondes</h2>";
                header("location: PageSessionDeTest.php?idMsg='". $id ."'");
    }

?>