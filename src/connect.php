<?php

include 'db.php';

if (isset($_POST['eSubmit']) AND isset($_POST['eUsername']) AND isset($_POST['eMdp']) ) {

    $eUsername=htmlspecialchars($_POST['eUsername']);
    $eMdp=htmlspecialchars($_POST['eMdp']);
    $eSubmit=htmlspecialchars($_POST['eSubmit']);
    $eSouvenir=htmlspecialchars($_POST['eSouvenir']);
   if ( count($_POST) AND ($eSubmit) ){

    $db=bdd();

    $prepare=$db->prepare('SELECT * FROM etudiant WHERE username_etd = ? ');
    $query=$prepare->execute([$eUsername]);
    $final=$prepare->fetch();
    if ($final !== false) {
    	if ($final['mdp_etd']==$eMdp ) {

            if($eSouvenir=="true"){

                setcookie('loginStudent',$eUsername,time()+3600*24*364,'/');
                setcookie('passwordStudent',$eMdp,time()+3600*24*364,'/');

            }
            session_start();

    		$_SESSION['eUsername'] = $eUsername;
            $_SESSION['etudiantLogedIn'] = true;
    		echo "connected";
    	}
    	else { 
        echo "<p>Mot de passe invalide . Réessayez!</p>";
      }
    }

  else{
 	echo "<p>Username invalide. Réessayez!</p>"; }
}

}



if (isset($_POST['pSubmit']) AND isset($_POST['pUsername']) AND isset($_POST['pMdp']) ) {

if ((count($_POST)) AND ($_POST['pSubmit'])){

    $pUsername=htmlspecialchars($_POST['pUsername']);
    $pMdp=htmlspecialchars($_POST['pMdp']);
    $pSubmit=htmlspecialchars($_POST['pSubmit']);
    $pSouvenir=htmlspecialchars($_POST['pSouvenir']);
     
    $db=bdd();

    $prepare=$db->prepare('SELECT * FROM professeur WHERE username_prof = ? ');
    $query=$prepare->execute([$pUsername]);
    $final=$prepare->fetch();
    if ($final !== false) {
    	if ($final['mdp_prof']==$pMdp ) {


            if($pSouvenir=="true"){

                setcookie('loginProf',$pUsername,time()+3600*24*364,'/');
                setcookie('passwordProf',$pMdp,time()+3600*24*364,'/');

            }

            session_start();
            
    		$_SESSION['pUsername'] = $pUsername;
            $_SESSION['professeurLogedIn'] = true;
            echo "connected";

    	}
    	else { 
        echo "<p>Mot de passe invalide . Réessayez!</p>"; 
      }
    }

  else{
 	echo "<p>Username invalide. Réessayez!</p>"; 
  }
}

}
