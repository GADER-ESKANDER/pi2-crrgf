<!DOCTYPE html>
<html lang="fr">
	<head>
		<meta charset="utf-8">
		<title>test_classe_Oeuvre</title>
		<meta name="author" content="cmartin">
	</head>

	<body>
		<div>
			<header>
				<h1>test_classe_Oeuvre</h1>
			</header>
			<div>
				<?php
				/* La classe à tester */
				require_once("../modeles/Oeuvre.class.php");
				require_once("../libs/TypeException.class.php");

				?>

				<h2>setNomOeuvre($sNomOeuvre) => integer 25</h2>
				<?php

					try{
						$oOeuvre = new Oeuvre();
						$oOeuvre ->setNomOeuvre(25);

					}catch(Exception $e){
						echo "<p>".$e->getMessage()."</p>";
					}

				?>
				<h2>setNomOeuvre($sNomOeuvre) => chaîne vide</h2>
				<?php

					try{
						$oOeuvre = new Oeuvre();
						$oOeuvre ->setNomOeuvre("");

					}catch(Exception $e){
						echo "<p>".$e->getMessage()."</p>";
					}

				?>
				<h2>setNomOeuvre($sNomOeuvre)  => chaîne de caractères "Tableau"</h2>
				<?php

					try{
						$oOeuvre = new Oeuvre();
						$oOeuvre ->setNomOeuvre("Tableau");
						echo "<p>".$oOeuvre->getNomOeuvre()."</p>";
					}catch(Exception $e){
						echo "<p>".$e->getMessage()."</p>";
					}

				?>

				<h2>setIdOeuvre($idOeuvre)  => chaîne de caractères "texte"</h2>
				<?php

					try{
						$oOeuvre = new Oeuvre();
						$oOeuvre ->setIdOeuvre("texte");
						//echo "<p>".$oOeuvre->getNomOeuvre()."</p>";
					}catch(Exception $e){
						echo "<p>".$e->getMessage()."</p>";
					}

				?>

				<h2>setIdOeuvre($idOeuvre)  => integer 20</h2>
				<?php

					try{
						$oOeuvre = new Oeuvre();
						$oOeuvre ->setIdOeuvre(20);
						echo "<p>".$oOeuvre->getIdOeuvre()."</p>";
					}catch(Exception $e){
						echo "<p>".$e->getMessage()."</p>";
					}

				?>

				<h2>setPoidsOeuvre($iPoidsOeuvre) => chaîne de caractères "poids"</h2>
				<?php

					try{
						$oOeuvre = new Oeuvre();
						$oOeuvre ->setPoidsOeuvre("poids");
						//echo "<p>".$oOeuvre->getNomOeuvre()."</p>";
					}catch(Exception $e){
						echo "<p>".$e->getMessage()."</p>";
					}

				?>

				<h2>setPoidsOeuvre($iPoidsOeuvre) => integer 20</h2>
				<?php

					try{
						$oOeuvre = new Oeuvre();
						$oOeuvre ->setPoidsOeuvre(20);
						echo "<p>".$oOeuvre->getPoidsOeuvre()."</p>";
					}catch(Exception $e){
						echo "<p>".$e->getMessage()."</p>";
					}

				?>









				<h2>setDossiers($aDossiers) => chaîne de caractères "Tremblay"</h2>
				<?php

				/*	try{
						$oEtudiant = new Etudiant();
						$oEtudiant->setDossiers("Tremblay");
						 var_dump($oEtudiant->getDossiers());
					}catch(Exception $e){
						echo "<p style=\"color:red;\">".$e->getMessage()."</p>";
					}
				*/
				?>
				<h2>setDossiers($aDossiers) => array(1,"Qwerty")</h2>
				<?php

				/*	try{
						$oEtudiant = new Etudiant();
						$aArr = array(1,"Qwerty");
						$oEtudiant->setDossiers($aArr);
						 var_dump($oEtudiant->getDossiers());
					}catch(Exception $e){
						echo "<p style=\"color:red;\">".$e->getMessage()."</p>";
					}
				*/
				?>
				<h2>rechercherUnEtudiant() => idEtudiant qui n'existe pas 999</h2>
				<?php
				/*
					try{
						$oEtudiant = new Etudiant(999);
						if($oEtudiant->rechercherUnEtudiant() == true){
							echo "<p>".$oEtudiant->getNom()."</p>";
							echo "<p>".$oEtudiant->getPrenom()."</p>";
							echo "<p>".$oEtudiant->getAge()."</p>";
						}else{
							echo "<p>Aucun étudiant avec le id de ".$oEtudiant->getIdEtudiant()."</p>";
						}

					}catch(Exception $e){
						echo "<p>".$e->getMessage()."</p>";
					}
				*/
				?>
				<h2>rechercherUnEtudiant() => idEtudiant qui existe  3</h2>
				<?php
				/*
					try{
						$oEtudiant = new Etudiant(3);
						if($oEtudiant->rechercherUnEtudiant() == true){
							echo "<p>".$oEtudiant->getNom()."</p>";
							echo "<p>".$oEtudiant->getPrenom()."</p>";
							echo "<p>".$oEtudiant->getAge()."</p>";
						}else{
							echo "<p>Aucun étudiant avec le id de ".$oEtudiant->getIdEtudiant()."</p>";
						}

					}catch(Exception $e){
						echo "<p>".$e->getMessage()."</p>";
					}
				*/
				?>
				<h2>ajouterEtudiant() => idEtudiant</h2>
				<?php
				/*
					try{
						$oEtudiant = new Etudiant(1,"Tremblay", "Paul", 45);
						$iEtudiant = $oEtudiant->ajouterEtudiant();
						var_dump($iEtudiant);
						$oEtudiant->rechercherUnEtudiant($iEtudiant);
						var_dump($oEtudiant);
						echo "<p>Aller vérifier la base données.</p>";
					}catch(Exception $e){
						echo "<p>".$e->getMessage()."</p>";
					}
				*/
				?>
				<h2>modifierEtudiant() => idEtudiant  <?php /*echo $idOeuvre; */?> </h2>
				<?php
				/*
					try{
						$oEtudiant = new Etudiant($iEtudiant,"Tremblay", "Bob", 45);
						var_dump($oEtudiant->modifierEtudiant());
						$oEtudiant->rechercherUnEtudiant($iEtudiant);
						var_dump($oEtudiant);
						echo "<p>Aller vérifier la base données.</p>";
					}catch(Exception $e){
						echo "<p>".$e->getMessage()."</p>";
					}
				*/
				?>
				<h2>supprimerEtudiant_innoDB() => idEtudiant  <?php/* echo $idOeuvre; */?> </h2>
				<?php
				/*
					try{
						$oEtudiant = new Etudiant($iEtudiant);
						var_dump($oEtudiant->supprimerEtudiant_innoDB());
						$oEtudiant->rechercherUnEtudiant($iEtudiant);
						var_dump($oEtudiant);
						echo "<p>Aller vérifier la base données.</p>";
					}catch(Exception $e){
						echo "<p>".$e->getMessage()."</p>";
					}
				*/
				?>
			</div>
			<h2>rechercherListeDesOeuvres()</h2>
				<?php

					try{
						echo "<pre>";
						var_dump(Oeuvre::rechercherListeDesOeuvres());
						echo "</pre>";


					}catch(Exception $e){
						echo "<p>".$e->getMessage()."</p>";
					}



				?>




			</div>
			<footer>
				<p>
					&copy; Copyright  by cmartin
				</p>
			</footer>
		</div>
	</body>
</html>
