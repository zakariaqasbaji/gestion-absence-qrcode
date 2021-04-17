<?php $loginStudent = (empty($_COOKIE['loginStudent'])) ? '' : $_COOKIE['loginStudent'] ; 
$passwordStudent = (empty($_COOKIE['passwordStudent'])) ? '' : $_COOKIE['passwordStudent'] ;
$loginProf= (empty($_COOKIE['loginProf'])) ? '' : $_COOKIE['loginProf'] ; 
$passwordProf= (empty($_COOKIE['passwordProf'])) ? '' : $_COOKIE['passwordProf'] ; 
session_start();
session_destroy();
?>

<!DOCTYPE HTML>

<html>
	<head>
		<title>Home</title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1" />
		<link rel="stylesheet" href="assets/styles/index.css" />
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
		

	</head>
	<body>
		

				<header id="header">
				<a class="logo">Gestion d'absence </a>
				</header>


			<section id="banner">
				<div class="inner">
					<header>
						<h1>Bienvenue</h1>
						<i><p id="des">Cette Application est conçue pour la gestion d'absence </p></i>
						<a href="#Connexion" class="button">Get Started</a>
					</header>

				</div>
			</section>


		
			<section id="Connexion" class="wrapper align-center">
				<div class="inner">
					<div class="flex flex-2">
						<article>
							<div class="image round">
								<img src="assets/pictures/student.png " alt="student" />
							</div>
							<header>
								<h3>Je suis étudiant:</h3>
							</header>
							
							<footer>
								<button id="connectStudent" class="button">Se connecter</button>
							</footer>
							<form id="formStudent" class="box hide" method="post" onsubmit="event.preventDefault()">
									  <h1>Connexion</h1>
									  <input type="text" id="eUsername" name="eUsername" placeholder="Username" value="<?= $loginStudent ?> " required>
									  <input id="eMdp" type="password" name="eMdp" placeholder="Password" value="<?= $passwordStudent?>" required>
									  <input class="input" type="checkbox" id="eSouvenir" name="eSouvenir"> Se souvenir de moi
									  <div id="responseE" style="color: red"></div>
									  <input id="eSubmit" type="submit" name="eSubmit" value="Login" >
							</form>
						</article>
						<article>
							<div class="image round" >
								<img src="assets/pictures/teacher.png" alt="teacher" />
							</div>
							<header>
								<h3>Je suis professeur:</h3>
							</header>
							<footer>
								<button id="connectProf" class="button">Se connecter</button>
							</footer>
								<form id="formProf" class="box hide" method="post" onsubmit="event.preventDefault()">
									  <h1>Connexion</h1>
									  <input type="text" id="pUsername" name="pUsername" placeholder="Username" required  value="<?= $loginProf ?>">
									  <input type="password" id="pMdp" name="pMdp" placeholder="Password" value="<?= $passwordProf ?>">
									  <input class="input"  type="checkbox" id="pSouvenir" name="pSouvenir"> Se souvenir de moi
									  <div id="responseP" style="color: red"></div>
									  <input id="pSubmit" type="submit" name="pSubmit" value="Login">

								</form>

						</article>

					</div>

				</div>
				
			
			</section>
					

	</body>
	<script type="text/javascript" src="assets/scripts/index.js"></script>
	
</html>
