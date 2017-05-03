<?php
require("../Sysconf/config.php");
if(isset($_SESSION['nom']))
{
}
else
{
    header("location: ../index.php");
}
if (isset($_GET["idMsg"])) {        
        $db = new PDO('mysql:host=localhost;dbname=ANTIBIOPLUS;charset=utf8', 'root', '');

        $idEtude = $_GET["idMsg"];

        $req = $db->prepare('DELETE t FROM test t INNER JOIN session s on s.id=t.id_session WHERE s.id_etude=:idetude');
        $req->bindParam(":idetude",$idEtude);
		$req->execute();
		$result = $req->fetch();

		$req1 = $db->prepare('DELETE FROM session WHERE id_etude=:idetude');
        $req1->bindParam(":idetude",$idEtude);
		$req1->execute();
		$result1 = $req1->fetch();

		$req2 = $db->prepare('DELETE FROM etude_bacterie where id_etude=:idetude');
		$req2->bindParam(":idetude",$idEtude);
		$req2->execute();
		$result2 = $req2->fetch();

		$req3 = $db->prepare('DELETE FROM etude_molecule where id_etude=:idetude');
		$req3->bindParam(":idetude",$idEtude);
		$req3->execute();
		$result3 = $req3->fetch();

		$req4 = $db->prepare('DELETE FROM etude_equipe where id_etude=:idetude');
		$req4->bindParam(":idetude",$idEtude);
		$req4->execute();
		$result4 = $req4->fetch();
        
        $req5 = $db->prepare("DELETE FROM etude WHERE etude.id=:idetude;");
		$req5->bindParam(":idetude",$idEtude);
		$req5->execute();
		$result5 = $req5->fetch();

        echo "<h2 align='center' style='color:green;'>Votre étude a bien été supprimée ! Vous allez être rediriger vers la page Administrateur d'ici quelques secondes</h2>";
                header("Refresh: 5; URL='PageAdmin.php'");
    }

?>