<?php 


include '../db.php';
$db=bdd();

try{
	$username_etd=$_POST['username_etd'];
	$qrcode=$_POST['qrcode'];

	$prepare=$db->prepare('DELETE FROM `assister_temp` WHERE `qrcode` = ? AND `username_etd` = ?  ');
	$query=$prepare->execute(array($qrcode,$username_etd));
	$res="Etudiant retiré !";
}
catch(Exception $e){
	$res="une erreur s'est produite, reéssayer plus tard...";
}


echo json_encode($res);


