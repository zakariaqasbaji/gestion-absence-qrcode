<?php
session_start();
if (!$_SESSION['etudiantLogedIn']) {
  header('location: ../index.php');
}


?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <title>Bienvennue</title>

	
  </head>
  
  <body style="text-align: center;">

    <h2>Veuillez scanner le Code</h2>
    <article class="pad-2">
        <section>
            <div class="frm-grp txt-cntr">
			</div>
            <!-- webcamera view component -->
            <video id="webcameraPreview" playsinline autoplay muted loop style="width: 100%;"></video>
        </section>
    </article>
    <br>
   
    <script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
    <script type="text/javascript" src="../assets/scripts/adapter.min.js"></script>
    <script type="text/javascript" src="../assets/scripts/instascan.js"></script>
    <script type="text/javascript" src="../assets/scripts/QrCodeScanner.js"></script>
    <script type="text/javascript">var username_etd="<?=$_SESSION['eUsername'] ?>";</script>
    <script type="text/javascript" src="../assets/scripts/etudiant.js"></script>

  </body>
</html>