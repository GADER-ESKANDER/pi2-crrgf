<!DOCTYPE html>
<html lang="fr">
	<head>
		<meta charset="utf-8">
		<title>test_classe_Contact</title>
		<meta name="author" content="cmartin">		
	</head>

	<body>
		<div>
			<header>
				<h1>test_classe_Contact</h1>
			</header>
			<div>
				<?php 
				/* La classe à tester */
				require_once("../modeles/Contact.class.php");
				require_once("../libs/TypeException.class.php");
				require_once("../libs/MySqliLib.class.php");
				// require_once("../libs/MySqliLib.class.php");
				
				
				?>
				
				<h2>setNomContact($nomContact) => integer 50</h2>
				<?php 
				
					try{
						$oContact = new Contact();
						$oContact->setNomContact(50);
					}catch(Exception $e){
						echo "<p>".$e->getMessage()."</p>";
					}
				
				?>
				<h2>setNomContact($nomContact) => chaîne vide</h2>
				<?php 
				
					try{
						$oContact = new Contact();
						$oContact->setNomContact("");
						
					}catch(Exception $e){
						echo "<p>".$e->getMessage()."</p>";
					}
				?>
				<h2>$oContact->setNomContact => chaîne de caractères "Tremblay"</h2>
				<?php 
				
					try{
						$oContact = new Contact();
						$oContact->setNomContact("Tremblay");
						
					}catch(Exception $e){
						echo "<p>".$e->getMessage()."</p>";
					}
				
				?>
				
				<h2>$oContact->setPrenomContactct() => chaîne de caractères "Toto"</h2>
				<?php 
				
					try{
						$oContact = new Contact();
						$oContact->setPrenomContact("Toto");
						
					}catch(Exception $e){
						echo "<p>".$e->getMessage()."</p>";
					}
				?>
				<h2>$oContact->setCourriel() => chaîne de caractères "skandergader@yahoo.fr"</h2>
				<?php 
				
					try{
						$oContact = new Contact();
						$oContact->setCourriel("skandergader@yahoo.fr");
						
					}catch(Exception $e){
						echo "<p>".$e->getCourriel()."</p>";
					}
				?>
				
				<h2>rechercherUnContact() => idContact qui existe pas 1</h2>
				<?php 				
					try{
						$oContact = new Contact(1);
						if($oContact->rechercherUnContact() == true){
							echo "<p>".$oContact->getNomContact()."</p>";
							echo "<p>".$oContact->getPrenomContact()."</p>";
							echo "<p>".$oContact->getCourriel()."</p>";	
							echo "<p>".$oContact->getMessage()."</p>";	
							echo "<p>".$oContact->getDateContact()."</p>";	
							echo "<p>".$oContact->getStatue()."</p>";	
								
						}else{
							echo "<p>Aucun contact avec le id de ".$oContact->getIdContact()."</p>";
						}
						
					}catch(Exception $e){
						echo "<p>".$e->getMessage()."</p>";
					}
				?>
				<h2>ajouterUnContacts() => idContacts</h2>
				<?php 
	
					try{
						
						$oContacts = new Contact(1,"Paul ", "Tremblay", "Paul@yahoo.ca", "Pgjf hf hhuhu iiugfuaf  gawf" , " Non Repense" );
						$iContacts = $oContacts->ajouterUnContact();
						var_dump($iContacts);
						$oContacts->rechercherUnContact($iContacts);
						var_dump($oContacts);
						echo "<p>Aller vérifier la base données.</p>";
					}catch(Exception $e){
						echo "<p>".$e->getMessage()."</p>";
					}
				?>
				
				<h2>supprimerUncontact()=> idContacts  <?php echo $iContacts; ?> </h2>
				<?php 
				
					try{
						
						$oContact = new Contact($iContacts);
						var_dump($oContact->supprimerUncontact());
						$oContact->rechercherUnContact($iContacts);
						var_dump($iContacts);
						echo "<p>Aller vérifier la base données.</p>";
					}catch(Exception $e){
						echo "<p>".$e->getMessage()."</p>";
					}
				
				?>
				
				<h2>modifierStatueContact() => idContact  </h2>
				<?php 
				
				try{
				$oContact = new Contact(3);
				
						if($oContact->rechercherUnContact() == true){
							
							var_dump($oContact->modifierStatueContact());
							$oContacts->rechercherUnContact(3);
							var_dump($oContact);
							
						}
						
				}catch(Exception $e){
						echo "<p>".$e->getMessage()."</p>";
					}
				
				
				?>
				
				<h2>rechercherListeDesContacts() </h2>
				<?php 				
					try{
						$oContact=  new Contact();
						$aContacts = $oContact->rechercherListeDesContacts();
						if($aContacts == true){
							var_dump($aContacts);	
								
						}else{
							echo "<p>Aucun contact qui existe</p>";
						}
						
					}catch(Exception $e){
						echo "<p>".$e->getMessage()."</p>";
					}
				?>
				
				
				
				
				
				
				

			</div>
			
		</div>
	</body>
</html>
