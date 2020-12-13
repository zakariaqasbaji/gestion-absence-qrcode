<?php 

include '../db.php';
$db=bdd();

$return_arr = array();

$prepare=$db->prepare('SELECT * FROM etudiant where nom_etd=? and prenom_etd=? and nom_classe=?');
$query=$prepare->execute(array($_POST["nom_etd"],$_POST["prenom_etd"],$_POST['nom_classe']));
$qrcode=$_POST['qrcode'];

while ($donnees=$prepare->fetch())
{


	 $return_arr[] = array("username_etd"=>$donnees['username_etd'],
	 				"nom_etd" => $donnees['nom_etd'],
                    "prenom_etd" => $donnees['prenom_etd'],
                    );
	

}

$prepareIns=$db->prepare('INSERT IGNORE INTO assister_temp VALUES( ?, ?,?,? )');
$prepareIns->execute([$return_arr[0]["username_etd"], $qrcode, 'FROM_PROF','FROM_PROF']);


echo json_encode($return_arr);

