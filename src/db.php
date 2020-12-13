<?php function bdd(){
 	try {
	     $bdd=new PDO('mysql:host=localhost;dbname=qrcode;charset=utf8','root','');
	     $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }
    catch(PDOException $pe) {
    	echo "hold up";
    	die('ERREUR:'.$pe->getMessage() );
    }
 	return $bdd ;
}