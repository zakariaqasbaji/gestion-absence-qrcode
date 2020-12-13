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
  $erreurs[]="indiquer le nom";
} 
if(empty(verifier($prenom))){
  $valid=false;
  $erreurs[]="Saisissez le prénom";
}



if (empty(verifier($email))){
  $valid=false;
  $erreurs[]="entrer l'email ";
} 
elseif( !filter_var($email,FILTER_VALIDATE_EMAIL)){
  $valid=false;
  $erreurs[]="l adresse email  est  invalide";
}

if($emailconf!=$email){
  $valid=false;
  $erreurs[]="Les emails ne correspondent pas. Veuillez réessayer";
}


if (empty(verifier($username))){
  $valid=false;
  $erreurs[]="entrer le username    ";
}





if(existe_email_prof($email)){
  $valid=false;
  $erreurs[]=" l email indique  existe déja";

}
if(existe_username_prof($username)){
  $valid=false;
  $erreurs[]=" username existe deja";

}

if($valid){ 

  $connexion=$bdd->prepare("INSERT INTO professeur VALUES(?,?,?,?,?)");
  $connexion->execute([$username,randomCode(),$nom,$prenom,$email]);



  $succes="le compte du professeur a été créé";
  $repense=array('succes'=>$succes);

  echo json_encode($repense);exit;
}









else{
  $repense=array('errors'=>$erreurs);

  echo json_encode($repense);exit;;


}




