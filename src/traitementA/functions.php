<?php
function verifier($var){

	$var =trim($var);
	$var=stripcslashes($var);
	$var=htmlspecialchars($var);
	return $var;
}

function existe_username_prof($username) {
	global $bdd;
	
	$resultat = $bdd->prepare("SELECT COUNT(*) FROM professeur WHERE username_prof = ?");
	$resultat->execute([$username]);
	$resultat = $resultat->fetch()[0];
	
	return $resultat;
}
function existe_email_prof($email) {
	global $bdd;
	
	$resultat = $bdd->prepare("SELECT COUNT(*) FROM professeur WHERE email_prof = ?");
	$resultat->execute([$email]);
	$resultat = $resultat->fetch()[0];
	
	return $resultat;
}
function existe_username_etudiant($username) {
	global $bdd;
	
	$resultat = $bdd->prepare("SELECT COUNT(*) FROM etudiant WHERE username_etd = ?");
	$resultat->execute([$username]);
	$resultat = $resultat->fetch()[0];
	
	return $resultat;
}
function existe_email_etudiant($email) {
	global $bdd;
	
	$resultat = $bdd->prepare("SELECT COUNT(*) FROM etudiant WHERE email_etd = ?");
	$resultat->execute([$email]);
	$resultat = $resultat->fetch()[0];
	
	return $resultat;
}
function randomCode() {
	$alphabet = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890@_.&';
	$pass = array(); 
	$alphaLength = strlen($alphabet) - 1;
	for ($i = 0; $i < 8; $i++) {
		$n = Rand(0, $alphaLength);
		$pass[] = $alphabet[$n];
	}
	return implode($pass);
}
?>