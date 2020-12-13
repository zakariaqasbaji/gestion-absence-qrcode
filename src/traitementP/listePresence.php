<?php

include '../db.php';
$db=bdd();

$return_arr = array();
$prepare=$db->prepare('SELECT * FROM etudiant natural join assister_temp WHERE qrcode = ? ');
$query=$prepare->execute(array($_POST['qrcode']));

while ($donnees=$prepare->fetch())
{


	 $return_arr[] = array("username_etd"=>$donnees['username_etd'],
	 				"nom_etd" => $donnees['nom_etd'],
                    "prenom_etd" => $donnees['prenom_etd'],
                   "latitude_etd" => $donnees['latitude_etd'],
                    "longitude_etd" => $donnees['longitude_etd'],
                    );
	

}


echo json_encode($return_arr);


