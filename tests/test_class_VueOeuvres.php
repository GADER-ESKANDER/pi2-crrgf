<!DOCTYPE html>
<html lang="fr">
	<head>
		<meta charset="utf-8">

		<title>test_classe_VueOeuvre</title>
		
		<meta name="author" content="cmartin">
	</head>

	<body>
		<div>
			<header>
				<h1>test_classe_VueOeuvre</h1>
			</header>

			<div>
				<h2>afficherFormRechercheEtudiant() </h2>
				<?php
				/*require_once("../vues/VueEtudiant.class.php");
				require_once("../modeles/Etudiant.class.php");
				require_once("../lib/TypeException.class.php");
				try{
					VueEtudiant::afficherFormRechercheEtudiant();
				}catch(Exception $e){
					echo "<p>".$e->getMessage()."</p>";
				}*/
				?>
				
				
				<h2>afficherLesOeuvres($aOeuvres)</h2>
				<?php
				require_once("../vues/Vue.class.php");
				require_once("../vues/VueOeuvre.class.php");
				require_once("../modeles/Oeuvre.class.php");
				require_once("../libs/TypeException.class.php");
				
				try{
					/*$aEtudiants = array(
						new Etudiant(1, "Tremblay", "Bob", 45),
						new Etudiant(2, "Côté", "Martin", 12),
						new Etudiant(3, "Poulain", "Amélie", 38)
					);*/
					$aOeuvres=Oeuvre::rechercherListeDesOeuvres();
					VueOeuvre::afficherLesOeuvres($aOeuvres);
					
				}catch(Exception $e){
					echo "<p>".$e->getMessage()."</p>";
				}
				?>
				
				
				
				
				
				<h2>afficherUnEtudiant(Etudiant $oEtudiant)</h2>
				<?php
				
			/*	
				try{
					$oEtudiant = new Etudiant(1,"Tremblay","Lucie",23);
					
					VueEtudiant::afficherUnEtudiant($oEtudiant);
				}catch(Exception $e){
					echo "<p>".$e->getMessage()."</p>";
				}*/
				?>
				
				
				
				<h2>adm_afficherFormModificationEtudiant(Etudiant $oEtudiant)</h2>
				<?php
				
				
			/*	try{
					
					$oEtudiant = new Etudiant(1, "Tremblay", "Bob", 45);
					
					VueEtudiant::adm_afficherFormModificationEtudiant($oEtudiant);
					
				}catch(Exception $e){
					echo "<p>".$e->getMessage()."</p>";
				}*/
				?>
				
				<h2>adm_afficherFormModificationEtudiant(Etudiant $oEtudiant) => avec un paramètre qui n'est pas un objet de la classe Etudiant</h2>
				<?php
				/*
				
				try{
					
					$oEtudiant = "Tremblay";
					
					VueEtudiant::adm_afficherFormModificationEtudiant($oEtudiant);
					
				}catch(Exception $e){
					echo "<p>".$e->getMessage()."</p>";
				}*/
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
