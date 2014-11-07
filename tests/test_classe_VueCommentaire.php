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
				<h1>test_classe_VueCommentaire</h1>
			</header>
			<div>
				<h2>adm_afficherListeDesEtudiants($aEtudiants)</h2>
				<?php 
				/* La classe à tester */
				require_once("../vues/VueCommentaire.class.php");
				require_once("../modeles/Commentaire.class.php");
				require_once("../libs/TypeException.class.php");
				require_once("../libs/MySqliLib.class.php");
				?>
				<?php 
				$oComment= new Commentaire();
				$aCommentaire=$oComment ->adm_rechercherListeDesCommentaires();
				
				$oVueCommentaire=new VueCommentaire();
				
				$oVueCommentaire->afficherListeCommentaires($aCommentaire);
				
				var_export($oVueCommentaire);
				 ?>
				
				
				
				
				
				
			</div>
			
		</div>
	</body>
</html>
