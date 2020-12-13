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
  $erreurs[]="entrer le nom ";
} 
if(empty(verifier($prenom))){
  $valid=false;
  $erreurs[]="enter le prenom";
}


if( !empty(verifier($email)) and !filter_var($email,FILTER_VALIDATE_EMAIL)){
  $valid=false;
  $erreurs[]="l adresse mail est invalide";
}










if( !empty(verifier($email)) ){
if (existe_email_Prof($email)){
  $valid=false;
  $erreurs[]=" le mail est deja existe";
  
}}
else{
  $email=$mailEtudiant;
  
}

if($valid){ 

  $connexion=$bdd->prepare("UPDATE  etudiant SET mdp_etd=?,nom_etd=?,prenom_etd=?,email_etd=?,nom_classe=? where username_etd=?");
  $connexion->execute([$mdp,$nom,$prenom,$email,$classe,$idEtudiant]);



  $succes="le compte a été bien modifié";
  $repense=array('succes'=>$succes);

  echo json_encode($repense);exit;
}









else{
  $repense=array('errors'=>$erreurs);

  echo json_encode($repense);exit;;


}




