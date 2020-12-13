<?php
include("../functions/functions.php")  ;  
include ("../functions/db.php");
global $bdd;
$bdd=bdd();
extract($_POST);
$valid=true;
$erreurs=[];
if(empty(verifier($nom))){

	$valid=false;
	$erreurs[]=" indiquer le nom de l'étudiant";
} 
if(empty(verifier($prenom))){
	$valid=false;
	$erreurs[]="Saisissez le prénom ";
}



if (empty(verifier($email))){
	$valid=false;
	$erreurs[]=" entrer l'email ";
} 
elseif( !filter_var($email,FILTER_VALIDATE_EMAIL)){
	$valid=false;
	$erreurs[]="l adresse email invalide";
}
if($emailconf!=$email){
	$valid=false;
	$erreurs[]="Les emails ne correspondent pas. Veuillez réessayer";
}


if($classes==''){
	$valid=false;
	$erreurs[]='selectionner une classe';
}


if (empty(verifier($username))){
	$valid=false;
	$erreurs[]="entrer le nom   du prof  ";
}




if(existe_email_etudiant($email)){
	$valid=false;
	$erreurs[]=" ce email  existe deja";

}
if(existe_username_etudiant($username)){
	$valid=false;
	$erreurs[]=" ce username existe deja";

}

if($valid){ 

	$connexion=$bdd->prepare("INSERT INTO etudiant VALUES(?,?,?,?,?,?)");
	$connexion->execute([$username,randomCode(),$nom,$prenom,$email,$classes]);



	$succes="le compte d'étudiant a été créé";
	$repense=array('succes'=>$succes);

	echo json_encode($repense);exit;
}









else{
	$repense=array('errors'=>$erreurs);

	echo json_encode($repense);exit;;


}




