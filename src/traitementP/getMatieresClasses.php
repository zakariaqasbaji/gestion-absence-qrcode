<?php 

include '../db.php';
$db=bdd();


$prepare=$db->prepare('SELECT nom_matiere, nom_classe FROM prof_matiere_classe WHERE username_prof = ? ORDER BY nom_matiere');
$query=$prepare->execute([$_POST['username_prof']]);


while ($donnees=$prepare->fetch())
{

	 $return_arr[] = array("nom_matiere" => $donnees['nom_matiere'],
                    "nom_classe" => $donnees['nom_classe'],
                    );
	

}

echo json_encode($return_arr);



