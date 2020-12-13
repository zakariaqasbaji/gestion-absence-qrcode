<?php 


$username_etd=htmlspecialchars($_POST['username_etd']);
$qrcode=htmlspecialchars($_POST['qrcode']);
$longitude_etd=htmlspecialchars($_POST['longitude_etd']);
$latitude_etd=htmlspecialchars($_POST['latitude_etd']);

include '../db.php';
$db=bdd();

if ($username_etd!="" AND $qrcode!="") {

	try {
		$prepare=$db->prepare('INSERT INTO assister_temp VALUES( ?, ?,?,? )');
	    $prepare->execute([$username_etd, $qrcode, $latitude_etd,$longitude_etd]);
	    echo " présence confirmée";
        }
    catch(PDOException $pe) {
           die('Votre présence est déja confirmée');
        }


}else{
	echo "Une erreur s'est produite. Veuillez réessayer...";
}




    














 ?>