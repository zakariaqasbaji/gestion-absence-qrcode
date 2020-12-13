<?php 

include '../db.php';
$db=bdd();

$prof=$_POST["username_prof"];
$matiere=$_POST["nom_matiere"];
$classe=$_POST["nom_classe"];
$date=$_POST["dateSeance"];      

$return_arr = array();
$prepare=$db->prepare('SELECT nom_etd, prenom_etd FROM etudiant NATURAL JOIN assister NATURAL JOIN seance WHERE date_session = ? and username_prof=? and nom_matiere=? and nom_classe=? ');
$query=$prepare->execute([$date,$prof,$matiere,$classe]);

while ($donnees=$prepare->fetch())
{


	 $return_arr[] = array("nom_etd" => $donnees['nom_etd'],
                    "prenom_etd" => $donnees['prenom_etd']
                    );
	

}


echo json_encode($return_arr);


 ?>