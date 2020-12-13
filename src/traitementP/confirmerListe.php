<?php 




include '../db.php';
$db=bdd();



$json=$_POST['dataTable'];
	
  $arr=json_decode($json, true);
  array_pop($arr) ;
  array_pop($arr) ;
  array_pop($arr) ;
  array_pop($arr) ; 


$qrcode=$_POST['qrcode'];


 $DataArr = array();

foreach($arr as $row){
        $fieldVal1 = $row[0];
        $DataArr[] = "('$fieldVal1','$qrcode')";
    }



$sql = "INSERT IGNORE INTO assister values ";
$sql .= implode(',', $DataArr);
 
try{
$db->query($sql);
$delSeance=$db->prepare('DELETE FROM assister_temp WHERE qrcode = ? ');
$qy=$delSeance->execute(array($qrcode));
}catch(PDOException $pe) {
            die('Liste de présence invalide!! Vérifiez la liste et réessayez... ' );
        }





echo "Liste de présence enregistrée avec succés";

