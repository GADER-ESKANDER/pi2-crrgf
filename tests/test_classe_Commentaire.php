<!DOCTYPE html>
<html lang="fr">
	<head>
		<meta charset="utf-8">
		<title>test_classe_Commentaire</title>
		<meta name="author" content="cmartin">		
	</head>

	<body>
		<div>
			<header>
				<h1>test_classe_Commentaire</h1>
			</header>
			<div>
				<?php 
				/* La classe à tester */
				require_once("../modeles/Commentaire.class.php");
				require_once("../libs/TypeException.class.php");
				require_once("../libs/MySqliLib.class.php");
				?>
				<h2>setIdCommentaire($idCommentaire) => integer 100</h2>
				<?php 
				// getIdCommentaire()
					try{
						$oCommentaire = new Commentaire();
						$oCommentaire->setIdEnchere(50);
						echo $oCommentaire->getIdEnchere();
					}catch(Exception $e){
						echo "<p>".$e->getMessage()."</p>";
					}
					
				?>
				<h2>setCorpsCommentaire($corpsCommentair)) => chaîne vide</h2>
				<?php 
				
					try{
						$oCommentaire = new Commentaire();
						$oCommentaire->setCorpsCommentaire("");
						
					}catch(Exception $e){
						echo "<p>".$e->getMessage()."</p>";
					}
				?>
				<h2>$oCommentaire->setCorpsCommentaire => chaîne de caractères "Tremblay sdfsdf asds"</h2>
				<?php 
				
					try{
						$oCommentaire = new Commentaire();
						$oCommentaire->setCorpsCommentaire("Tremblay sdfsdf asds");
						echo $oCommentaire->getCorpsCommentaire(); 
						
					}catch(Exception $e){
						echo "<p>".$e->getMessage()."</p>";
					}
				
				?>
	
				<h2>$oCommentaire->setDateCommentaire() => chaîne de caractères "2014-10"</h2>
				<?php 
				// ($idCommentaire = 0, $corpsCommentaire = " ", $dateCommentaire =" ", $abus = "Non", $idUtilisateur = 0, $idEnchere = 0)
				
					try{
						$oCommentaire = new Commentaire();
						$oCommentaire->setDateCommentaire("2014-10");
						echo $oCommentaire->getDateCommentaire();
						
					}catch(Exception $e){
						echo "<p>".$e->getMessage()."</p>";
					}
				?>
				<h2>$oCommentaire->setAbus() => chaîne de caractères "Abus"</h2>
				<?php 
				
					try{
						$oCommentaire = new Commentaire();
						$oCommentaire->setAbus("Abus");
						echo $oCommentaire->getAbus("Abus");
						
					}catch(Exception $e){
						echo "<p>".$e->getAbus()."</p>";
					}
				?>
	<!-- --------------------------------Test_Fonctions--------------------------------------------------- -->
				
				<h2>ajouterUnCommentaires() => idCommentaires</h2>
				<?php 
					try{
						$oCommentaires = new Commentaire( 3, "khigias hui yhiodf hfh huhfyh hlahsfui", "2014-10-23", "Non" , 2,1 );	
						$iCommentaires = $oCommentaires->ajouterUnCommentaire();
						var_dump($iCommentaires);
						$oCommentaires->rechercherUnCommentaire($iCommentaires);
						var_dump($oCommentaires);
						echo "<p>Aller vérifier la base données.</p>";
					}catch(Exception $e){
						echo "<p>".$e->getMessage()."</p>";
					}
				?>
				
				<h2>recherUnCommentParIdEnchere() => IdEnchere qui existe  2</h2>
				<?php 				
					try{
						// ($idCommentaire = 0, $corpsCommentaire = " ", $dateCommentaire =" ", $abus = "Non", $idUtilisateur = 0, $idEnchere = 0)
						$oCommentaire = new Commentaire();
						$oCommentaire->setIdEnchere(2);
						if($oCommentaire->recherUnCommentParIdEnchere() == true){
							echo "<p>".$oCommentaire->getidCommentaire()."</p>";
							echo "<p>".$oCommentaire->getCorpsCommentaire()."</p>";
							echo "<p>".$oCommentaire->getDateCommentaire()."</p>";	
							echo "<p>".$oCommentaire->getAbus()."</p>";	
							echo "<p>".$oCommentaire->getIdUtilisateur()."</p>";	
							echo "<p>".$oCommentaire->getIdEnchere()."</p>";	
						}else{
							echo "<p>Aucun Commentaire avec le id de ".$oCommentaire->getIdCommentaire()."</p>";
						}
						
					}catch(Exception $e){
						echo "<p>".$e->getMessage()."</p>";
					}
				?>
				
				<h2>rechercherUnCommentaire() => idCommentaire qui existe  12</h2>
				<?php 				
					try{
						$oCommentaire = new Commentaire(11);
						
						if($oCommentaire->rechercherUnCommentaire() == true){
							
							var_export($oCommentaire);
							
								
						}else{
							echo "<p>Aucun Commentaire avec le id de ".$oCommentaire->getIdCommentaire()."</p>";
						}
						
					}catch(Exception $e){
						echo "<p>".$e->getMessage()."</p>";
					}
				?>
		
				<h2>supprimerUnCommentaire()=> idCommentaires  <?php  echo $iCommentaires; ?> </h2>
				<?php 
				
					// try{
// 						
						// $oCommentaire = new Commentaire($iCommentaires);
						// var_export($oCommentaire->supprimerUnCommentaire());
						// $oCommentaire->rechercherUnCommentaire($iCommentaires);
						// var_export($iCommentaires);
						// echo "<p>Aller vérifier la base données.</p>";
					// }catch(Exception $e){
						// echo "<p>".$e->getMessage()."</p>";
					// }
				
				?>
				
				($idCommentaire = 0, $corpsCommentaire = " ", $dateCommentaire =" ", $abus = "Non", $idUtilisateur = 0, $idEnchere = 0)
				
				<h2>modifierUnCommentaire() => idCommentaire  <?php echo $iCommentaires; ?> </h2>
				<?php 
				
					try{
						$oCommentaire = new Commentaire(22,"modifierUnCommentaire", 2014-10-24, 'Non',1,1 );
						var_export ($oCommentaire->modifierUnCommentaire());
						$oCommentaire->rechercherUnCommentaire(22);
						var_dump($oCommentaire);
						echo "<p>Aller vérifier la base données.</p>";
					}catch(Exception $e){
						echo "<p>".$e->getMessage()."</p>";
					}
				
				?>
				
				
				<h2>recherListeCommentairesParIdEnchere() => IdEnchere qui existe 2</h2>
				<?php 				
					try{ 
						$oCommentaire=  new Commentaire();
						$oCommentaire->setIdEnchere(1);
						$idEnchere= $oCommentaire->getIdEnchere();
						$aCommentaires = $oCommentaire->recherListeCommentairesParIdEnchere($idEnchere);
						if($aCommentaires == true){
							var_export($aCommentaires);		
						}else{
							echo "<p>Aucun Commentaire qui existe</p>";
						}
						
					}catch(Exception $e){
						echo "<p>".$e->getMessage()."</p>";
					}
					
				?>
				
				
				
				<h2>adm_rechercherListeDesCommentaires() </h2>
				<?php 				
					try{
						$oCommentaire=  new Commentaire();
						$aCommentaires = $oCommentaire->adm_rechercherListeDesCommentaires();
						if($aCommentaires == true){
							var_export($aCommentaires);		
						}else{
							echo "<p>Aucun Commentaire qui existe</p>";
						}
						
					}catch(Exception $e){
						echo "<p>".$e->getMessage()."</p>";
					}
				?>
				
				
				<h2>SignalerAbus() => idCommentaire  </h2>
				<?php 
				
				try{
				$oCommentaire = new Commentaire(7);
				
						if($oCommentaire->rechercherUnCommentaire() == true){
							
							var_export($oCommentaire->SignalerAbus());
							$oCommentaires->rechercherUnCommentaire(7);
							var_export($oCommentaire);
							
						}
						
				}catch(Exception $e){
						echo "<p>".$e->getMessage()."</p>";
					}
			
				
				?>
				
				
				
				
			</div>
			
		</div>
	</body>
</html>
