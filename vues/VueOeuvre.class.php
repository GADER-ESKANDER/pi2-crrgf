<?php
/**
 * @classe VueAccueil VueAccueil.class.php "classes/VueAccueil.class.php"
 * @version 0.0.1
 * @date 2014-10-18
 * @author Eric Revelle
 * @brief Affiche le contenue de la page d'accueil.
 * @details Permet d'afficher le contenu de la page d'accueil.
 */
class VueOeuvre {

	public static function afficherLesOeuvres($aOeuvres, $aThemes, $aTechniques,array $aMsg = array("type"=>'',"msg"=>'')){

		// Inclu les morceaux de pages, dont les metas, l'entete, la navigation et le carousel
		Vue::head('Achetez des oeuvres d\'art', 'Site de vente d\'oeuvres d\'art en ligne','oeuvre.css');
		Vue::header('Ma recherche');
		Vue::nav();

		echo '		
				<button id="liste"><img class="icone" src="../medias/liste.png" alt=""></button>
				<button id="grille"><img class="icone" src="../medias/grille.png" alt=""></button>						
		';

		echo "<article id=\"selection\" class=\"col-md-12 affichage clearfix\">";
			echo "<section class=\"col-sm-6 col-md-3 \">";
				echo '

					<form action="index.php?page=oeuvres-encheres&mode=grille" method="POST">
							<fieldset>
								<legend>Rechercher des oeuvres</legend>

								<input type="text" name="txt" id="txt" value="">
								<input type="submit" name="cmd" value="Rechercher">								
							</fieldset>
						</form>
					';

				echo '<br/>';

				
				

				echo '	<form action="index.php?page=oeuvres-encheres&mode=grille" method="POST">';
						echo '<h2>Theme</h2>';						
					
							for($iTheme=0; $iTheme<count($aThemes); $iTheme++)
							{	
								echo "<input type='radio'  name='theme' value=\"".$aThemes[$iTheme]['id']."\"/>".$aThemes[$iTheme]['nom']."</br>";
								
							}
					
						echo '<h2>Technique</h2>';
					
							for($iTechnique=0; $iTechnique<count($aTechniques); $iTechnique++)
							{						
								echo "<input type='radio' name='technique' value=\"".$aTechniques[$iTechnique]['id']."\"/>".$aTechniques[$iTechnique]['nom']."</br>";
							}
						echo'<input type="submit" name="rech" value="Rechercher">

						</form>';


			echo "</section>";

	/**
	 *
	 * @return void
	 * @param Oeuvre $oOeuvre
	 */
		echo "<section class=\"col-sm-6 col-md-9 \">";
		echo "<a href=\"index.php?page=oeuvres-encheres\">Retour</a>";
		echo"<article class=\"row grille text-center\">";

		if($aOeuvres!=0)
		{
			foreach($aOeuvres As $oOeuvre){
				/***va chercher l'image de l'oeuvre***/

				echo"		<div class=\"thumbnail col-md-4\">
								<span class='apparent'>
								<a href=\"index.php?page=detailsEnchere&idOeuvre=".$oOeuvre->getIdOeuvre()."\"><img class=\"dimImg\" src=\"".$oOeuvre->getUrlOeuvre()."\" alt=\"Photo du tableau\"></a>
								<h2>".$oOeuvre->getNomOeuvre()."</h2>
								<a href=\"index.php?page=detailsEnchere&idOeuvre=".$oOeuvre->getIdOeuvre()."\"><button>Enchérir</button></a>

								</span>

								<table class='cache text-center'>
									<tr>
										<td> Description: ".$oOeuvre->getDescriptionOeuvre()."</td>
										<td>
											<a href=\"index.php?page=detailsEnchere&idOeuvre=".$oOeuvre->getIdOeuvre()."\"><img class=\"dimImg\" src=\"".$oOeuvre->getUrlOeuvre()."\" alt=\"Photo du tableau\"></a>
											<h2>".$oOeuvre->getNomOeuvre()."</h2>
											<a href=\"index.php?page=detailsEnchere&idOeuvre=".$oOeuvre->getIdOeuvre()."\"><button>Enchérir</button></a>
										</td>
										<td>
											Technique: ".$oOeuvre->getTechnique()->getNomTechnique()."<br/>
											Theme: ".$oOeuvre->getTheme()->getNomTheme()."<br/>
											Dimension: ".$oOeuvre->getDimensionOeuvre()."po <br/>
											Poids: ".$oOeuvre->getPoidsOeuvre()."lb

										</td>
									</tr>
								</table>
							</div>";
			}//fin du foreach
		}
		
				echo "<div class=\"col-md-12\">
				<div class=\"alert alert-".$aMsg['type']." alert-dismissible\">
					<p>".$aMsg['msg']."</p>
				</div>
				</div>";
		

		echo"</article>";
		echo "</section>";
		echo "</article>";

		Vue::footer('js/oeuvre.js');

	}//fin de la fonction afficherLesOeuvres()

		/**
		 * Côté utilisateur-vendeur/ Afficher la liste de tous les oeuvres
		 * @param array $aOeuvres tableau d'objets Oeuvre
		 */
	public static function user_afficherListeOeuvres($aOeuvres, array $aMsg = array())
	{		
		// Inclu les morceaux de pages, dont les metas, l'entete, la navigation et le carousel
		Vue::head('Achetez des oeuvres d\'art', 'Site de vente d\'oeuvres d\'art en ligne','oeuvre.css');
		Vue::header('Ma recherche');
		Vue::nav();
        $aMsg = array("type" =>"warning","msg"=>"Aucun produit ne correspond à votre recherche");

        if(!count($aOeuvres)>0)
        {
            Vue::alerte($aMsg);
            echo "
            <h1>Liste de vos oeuvres <a href=\"index.php?page=".$_GET['page']."&action=add\">Ajouter</a></h1>";
        }
		else
        {
            echo "
			<h1>Liste de vos oeuvres <a href=\"index.php?page=".$_GET['page']."&action=add\">Ajouter</a></h1>
		<table>

			<tr>
				<th>Noms des tableaux</th>
				<th>Descriptions</th>
				<th>Images</th>
				<th>Dimensions</th>
				<th>Poids</th>
				<th>Etats</th>
				<th>Techniques</th>
				<th>Themes</th>
				<th>Modifier</th>
				<th>Supprimer</th>
			</tr>
			";
            //foreach ( $aOProduits AS $oOeuvre )
            for($iOeuvre=0; $iOeuvre<count($aOeuvres); $iOeuvre++){
                $etat=$aOeuvres[$iOeuvre]->getEtatOeuvre();

                echo "

				<tr>
					<td>".$aOeuvres[$iOeuvre]->getNomOeuvre()."</td>
					<td>".$aOeuvres[$iOeuvre]->getDescriptionOeuvre()."</td>
					<td><img class=\"tailleImg\" src=\"".$aOeuvres[$iOeuvre]->getUrlOeuvre()."\" alt=\"Photo du tableau\"></td>
					<td>".$aOeuvres[$iOeuvre]->getDimensionOeuvre()."</td>
					<td>".$aOeuvres[$iOeuvre]->getPoidsOeuvre()."</td>
					<td>".$etat."</td>
					<td>".$aOeuvres[$iOeuvre]->getTechnique()->getNomTechnique()."</td>
					<td>".$aOeuvres[$iOeuvre]->getTheme()->getNomTheme()."</td>";

                if($etat=="disponible")
                {
                    echo"<td>
						<button class=\"btn\">
							<a href=\"index.php?page=".$_GET['page']."&action=mod&idOeuvre=".$aOeuvres[$iOeuvre]->getIdOeuvre()."\">Modifier</a>
						</button>
					</td>
					<td>
						<button class=\"btn\" onclick=\"supprimerUneOeuvre('Voulez-vous supprimer cet oeuvre', '".$_GET['page']."', 'sup', ".$aOeuvres[$iOeuvre]->getIdOeuvre().")\">
							Supprimer
						</button>
					</td>
				</tr>";
                }else

                {
                    echo"<td>
						<button class=\"btn\" disabled=\"disabled\">
							<a href=\"index.php?page=".$_GET['page']."&action=mod&idOeuvre=".$aOeuvres[$iOeuvre]->getIdOeuvre()."\">Modifier</a>
						</button>
					</td>
					<td>
						<button class=\"btn\" disabled=\"disabled\">
							<a href=\"#\">Supprimer</a>
						</button>
					</td>


				</tr>";

                }
            }
            echo "
			</table>
		";
        }

		
		Vue::footer('js/oeuvre.js');
	}

	/**
	 * 
	 * @return 
	 * @param Produit $oOeuvre
	 * @param array $aMsg[optional] message à afficher
	 * optional = type correspond à une classe de BootStrap, optional = sMsg correspond au message à afficher
	 * optional = titre correspond au titre à afficher
	 */
	public static function user_afficherModifierOeuvre(Oeuvre $oOeuvre,$aMsg = array(),$aThemes,$aTechniques,$aInfosHidden = array("s"=>1), $sNomInputFile, $sMsg="&nbsp;"){
		
	// Inclu les morceaux de pages, dont les metas, l'entete, la navigation et le carousel
	Vue::head('Achetez des oeuvres d\'art', 'Site de vente d\'oeuvres d\'art en ligne','oeuvre.css');
	Vue::header('Ma recherche');
	Vue::nav();
	
	echo"<section class=\"col-md-12\">
			<article class='col-md-3'></article>
			<article class='hauteur imgload col-md-3'>
			<a href=\"index.php?page=gestionOeuvres\">Retour</a>";
				
				
				echo "<legend>".$aMsg['titre']." un produit </legend>";
					
				/******Formulaire de téléchargement de l'image***********/
				$sForm = "
					<form action=\"index.php?page=".$_GET['page']."&action=".$_GET['action']."&idOeuvre=".$oOeuvre->getIdOeuvre()."&".$_SERVER['PHP_SELF']."\" method=\"post\"  enctype='multipart/form-data' id='frmUpload'>
					";
						foreach($aInfosHidden as $sKey => $sValue){
							$sForm .= "	<input type='hidden' name='".$sKey."' value='".$sValue."'>";
						}
						
				$sForm .= "	
						<!-- MAX_FILE_SIZE must precede the file input field -->
						<input   type='hidden' 
									 name='MAX_FILE_SIZE' 
									 VALUE='20000000'>
									 
						<!-- Name of input element determines name in _FILES array -->
						<input type='file' name='".$sNomInputFile."'>
						<br/><input type='submit' value='UpLoad' name='telecharger'>	
					</form>";						
				echo $sForm;					
				/**********************************************************/
					
				/****Formulaire de modification des informations***/
				/*echo "hjkfsdhfhsdjfhlsdf".$oOeuvre->getIdOeuvre();*/
				
				echo"<form id='formulaire' name='formulaire' action=\"index.php?page=".$_GET['page']."&action=".$_GET['action']."&idOeuvre=".$oOeuvre->getIdOeuvre()."\" method=\"post\">
							
					<input type=\"hidden\" name=\"idOeuvre\" id=\"idOeuvre\" value=\"".$oOeuvre->getIdOeuvre()."\" ><br>
					
					<label for=\"media\"></label>";
					if(isset($_POST['telecharger']) == false || isset($_FILES['fic']) == false)						
					{
						echo"<input type=\"hidden\" id=\"txtMedia\" name=\"txtMedia\" value=\"".$oOeuvre->getUrlOeuvre()."\">
						<img class='imgposition' src='".$oOeuvre->getUrlOeuvre()."'/><br>";
											
					/*****Si l'utilisateur choisit un fichier et clique sur upload***/									
					}				
					//if(isset($_POST['telecharger']) == true && isset($_FILES['fic']) == true)						
					else {						
						//echo "<pre>";
						//var_dump($_FILES['fic']);	
						//echo "</pre>";
						$sMsg = Image::telecharger("fic", "../upload/", 642, 553);
						echo "<dl>
							<dd>".$sMsg."</dd>
							</dl>";				
						/****affichage de l'image******/					
						$image= '../upload/' . basename($_FILES['fic']['name']);				
						echo"<input type=\"hidden\"  id=\"txtMedia\" name=\"txtMedia\" value=\"".$image."\" ><br>
							<img class='imgposition' src='".$image."' alt='nom de oeuvre' /><br/><br/>";
								
						}					
					/***********************************************/	
			echo"</article>";

			echo"<article class='infos imgload col-md-6'>";
					
					echo"<label for=\"nom\">Nom de l'oeuvre: </label><input type=\"text\" id=\"nom\" name=\"txtNom\" value=\"".trim($oOeuvre->getNomOeuvre())."\"><span class=\"erreur\"></span><br/>";	
											
					echo"<label for=\"description\">Description: </label>
						<textarea id=\"description\" name=\"txtDescription\">".trim($oOeuvre->getDescriptionOeuvre())."</textarea><span class=\"erreur\"></span><br/>
						
						
						<label for=\"dimension\">Dimension: </label><input type=\"text\" id=\"dimension\" name=\"txtDimension\" placeholder=\"ex: 70x140...\" value=\"".trim($oOeuvre->getDimensionOeuvre())."\">po<span class=\"erreur\"></span><br>
						
						<label for=\"poids\">Poids: </label><input type=\"text\" id=\"poids\" name=\"txtPoids\" value=\"".$oOeuvre->getPoidsOeuvre()."\">lbs<span class=\"erreur\"></span><br>	
						
						<label for=\"txtTheme\">Theme:</label>									
							<select id=\"txtTheme\" name=\"txtTheme\" >";
						
								for($iTheme=0; $iTheme<count($aThemes); $iTheme++){
									$selected="";
									if($aThemes[$iTheme]['nom']== $oOeuvre->getTheme()->getNomTheme())
									{
										$selected = 'selected';
									}
										echo "<option  value=\"".$aThemes[$iTheme]['nom']."\"".$selected.">".$aThemes[$iTheme]['nom']."</option>";
								}
						
						echo "</select><span class=\"erreur\"></span><br/>
						
						<label for=\"txtTechnique\">Technique: </label>	
							<select id=\"txtTechnique\" name=\"txtTechnique\">";									
								
								for($iTechnique=0; $iTechnique<count($aTechniques); $iTechnique++){
									$selected="";
									if($aTechniques[$iTechnique]['nom']== $oOeuvre->getTechnique()->getNomTechnique())
									{
										$selected = 'selected';
									}
										echo "<option value=\"".$aTechniques[$iTechnique]['nom']."\"".$selected.">".$aTechniques[$iTechnique]['nom']."</option>";
								}
						echo"</select><span class=\"erreur\"></span><br/><br/>";						
						echo "<input type=\"button\" id='btnEnvoyer' name=\"cmd\" value=\"".$aMsg['titre']."\" data-page=\"".$_GET['page']."\" data-action=\"".$_GET['action']."\"><br/><br/>";
						echo"<p id=\"msg\">".$sMsg."</p>
				
					</form>
				</article>
			
		</section>
		";
	Vue::footer('js/oeuvre.js');

	}//fin de la fonction adm_afficherAjouterUnProduit()

	
	/**
	 * 
	 * @return 
	 * @param Produit $oOeuvre
	 * @param array $aMsg[optional] message à afficher
	 * optional = type correspond à une classe de BootStrap, optional = sMsg correspond au message à afficher
	 * optional = titre correspond au titre à afficher
	 */
	public static function user_afficherAjouterOeuvre($aMsg=array(),$aThemes,$aTechniques,$aInfosHidden = array("s"=>1), $sNomInputFile){		
		$oOeuvre = new Oeuvre();		
		$aMsg['titre'] = "Ajouter";
		VueOeuvre::user_afficherModifierOeuvre($oOeuvre,$aMsg,$aThemes,$aTechniques,$aInfosHidden = array("s"=>1), $sNomInputFile);
	
	}//fin de la fonction adm_afficherAjouterUnProduit()

	
}