<!DOCTYPE html>
<html lang="en">
<?php
session_start();
include("../traitementA/modification.php");
include("../traitementA/db.php");
$bdd=bdd();

if(isset($_POST['modifie'])){
  $professeurs=rechercher_prof();
}
else{
  $professeurs=afficher_prof();

}



?>

<head>
  <style type="text/css">
   

}

  </style>
 
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>modifier professeur</title>

  <!-- fonts-->
  <link href="../../vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="../../vendor/jquery/jquery-3.4.1.min.js"></script>
  <link rel="stylesheet" type="text/css" href="../../assets/styles/style2.css">



  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
  <!--  styles -->
  <link href="../../assets/styles/sb-admin-2.min.css" rel="stylesheet">

</head>

<body id="page-top">

  <!-- Page Wrapper -->
  <div id="wrapper">

    <!-- Sidebar -->
    <?php include("includes/slidebar.php") ?>

    <!-- debut de contenu -->
    <!-- Modal editProf -->
    <div class="modal fade" id="editProf" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Modifier Prof</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close" onclick="javascript:window.location.reload()" >
              <span aria-hidden="true">&times;</span>
            </button>
          </div>

          <div class="modal-body">
           
            <form   method="post"   id="changeProf" action="">
             <div class="col-md-12">
              <label  for="firstname"> prenom <span class="">*</span></label><br>
              <input type="text" id="prenom" name="prenom" class="form-control" placeholder="pernom" value="" >
              
            </div>
            <div class="col-md-12">
              <label  for="nom">  nom <span class="">*</span></label><br>
              <input type="text"   id="nom" name="nom" class="form-control" placeholder="nom" value=""> </div>
            
              
              <div class="col-md-12">
                

                <label  for="mail">  email <span class="">*</span></label><br>
                <input type="text" id="email" name="email" class="form-control" placeholder="email" value="">
                
              </div>
              <div class="col-md-12">
                <label  for="emailconf">  mot de passe<span class="">*</span></label><br>
                <input type="text" id="mdp" name="mdp" class="form-control" placeholder="mot de passe" >
                
                
              </div>
              <div class="col-md-12">
                
                <input type="hidden" id="idProfesseur" name="idProfesseur" >
                
                
              </div>
              
              <div class="col-md-12">
                
                <input type="hidden" id="mailProfesseur" name="mailProfesseur" >
                
                
              </div>
              
              
              
              
              <br>
             
             
             
             

             <div class="col-md-12 ">
               <input type="submit" id="button" name="button" class="btn btn-primary center-block" value="submit" >
               
             </div>

           </form>



           
           
         </div>
         <div class="modal-footer">
          <button id="hasan" type="button" class="btn btn-secondary" data-dismiss="modal" onclick="javascript:window.location.reload()">Close</button>
          
        </div>
      </div>
    </div>
  </div>

  <section id="modification">

    <div class="container">
     <form method="post" action="" >
      
      <div class="row">

       <div class="col-md-10">
         
        
        <input type="text " id="rechercher" name="rechercher" class="form-control" placeholder="chercher par nom utilisateur et email " value="">
        
        
      </div>
      <div class="col-md-2-ml-1">
        <input type="submit" name="modifie" class="btn btn-primary">
      </div>
    </div>

 
    <br></form>
    
    
    

    
  </div>

  
  
  <div class="container">
         <div class="row pt-5 m-auto">
      <?php
      
      foreach($professeurs as $professeur):
        ?>
 
      <div class="col-md-6 col-lg-4 pb-3">

        <!-- card-Prof -->
        <div class="card card-custom bg-white border-white border-0">
          <div class="card-custom-img" style="background-image: url(http://res.cloudinary.com/d3/image/upload/c_scale,q_auto:good,w_1110/trianglify-v1-cs85g_cc5d2i.jpg);"></div>
          <div class="card-custom-avatar">
            <img class="img-fluid" src="../../assets/pictures/img6.png" alt="Avatar" />
          </div>
          <div class="card-body" style="overflow-y: auto">
            <h4 class="card-title"><?= $professeur["username_prof"]?></h4>
             <p><?= 'Nom: '.$professeur["nom_prof"]?></p>
            <p><?= 'Prenom: '.$professeur["prenom_prof"]?></p>
            <P>Email:</P>
            <p><?= $professeur["email_prof"]?></p>
          </div>
          <div class="card-footer" style="background: inherit; border-color: inherit;">
            <input type="button" id="<?= $professeur["username_prof"]?>" name="edit" value="modifier" class="btn btn-primary editProf " data-toggle="modal" data-target="#editProf"  >

          </div>
        </div>
        <!-- Copy until here -->

      </div>

       
       
   
      
      
       
        <?php 
      endforeach ;
      
      ?>
    </div>
  </div>
</section>
<!-- fin Content -->

<!-- Footer -->
  <?php include('includes/footer.php') ?>;
<!-- fin Footer -->

</div>
<!-- fin: Wrapper -->

</div>
<!-- fin: Wrapper -->

<!-- Button-->
<a class="scroll-to-top rounded" href="#page-top">
  <i class="fas fa-angle-up"></i>
</a>

<!-- Logout Modal-->
<?php include('includes/lougout_modal.php') ?>;

<?php include("includes/includes.php")?>

</body>

</html>
