<?php 

include '../db.php';
$db=bdd();

$return_arr = array();
$prof=$_POST["username_prof"];
$matiere=$_POST["nom_matiere"];
$classe=$_POST["nom_classe"];
$prepare=$db->prepare("SELECT nom_etd , prenom_etd, COUNT(*) as 'nb',(COUNT(*)/(SELECT COUNT(*) FROM seance  WHERE username_prof=? and nom_matiere=? and nom_classe=?))*100 as 'score' FROM etudiant NATURAL JOIN assister NATURAL JOIN seance WHERE username_prof=? and nom_matiere=? and nom_classe=? GROUP BY username_etd ");
$query=$prepare->execute([$prof,$matiere,$classe,$prof,$matiere,$classe]);
while ($donnees=$prepare->fetch())
{

	 $return_arr[] = array("nom_etd" => $donnees['nom_etd'],
                    "prenom_etd" => $donnees['prenom_etd'],
                    "nb"=>$donnees['nb'],
                    "score"=>$donnees['score'],
                    );
	

}

echo json_encode($return_arr);



