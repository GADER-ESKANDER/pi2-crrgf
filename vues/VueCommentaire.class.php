	<?php
	/**
	 * @classe VueContact VueContact.class.php "classes/VueContact.class.php"
	 * @version 0.0.1
	 * @date 2014-10-25
	 * @author Gader Eskander
	 * @brief Affiche des Commentaires.
	 * @details Permet d'afficher le contenu des Commentaires pour un enchère.
	 */
	 
		class VueCommentaire {
		
		public static function afficherFormPoserUnCommentaires($IdConnecte)
		{
		$oUtilisateur = new Utilisateur($IdConnecte);
		$oUtilisateur-> rechercherUnUtilisateur();
		$Prenom= $oUtilisateur ->getPrenom() ;
		$Nom= $oUtilisateur ->getNom() ;
		
		// Pour l'utilisateur connecte: afficher un formulairepour pour ajouter Un Commentaire 
		echo '
		<article class="col-xs-12 col-sm-10 col-sm-offset-1   icon_commenter ">
			<article class="row commentaires">
				<section class=" col-sm-2 col-xs-12">
					<div class="text-center ">
						<p>
							<span class="glyphicon glyphicon-user"></span>
						</p>
						<p class="icon_pos_comm">
							'.$Nom .' '.$Prenom.'
						</p>
					</div>
				</section>
				<section class=" col-sm-10 col-xs-12">
					<form class=" form-horizontal " action="index.php?page='.$_GET["page"].'&action=ajouCommentaire&idUtilisateur='.$IdConnecte.'" method="post">
						<fieldset>
							<legend >
								<a href="index.php?page='. $_GET["page"] .'&action=instruction_commentaire"> Consignes sur les commentaires </a>
							</legend>
							<article class="clearfix">
								<textarea rows="3" name="txtCommentaire" id="commentaire"  ></textarea>
							</article>
		
							<input class="btn-primary  pull-right" type="submit" name="cmd" value="Publier">
						</fieldset>
					</form>
				</section>
			</article>
		</article>
		
		';
	}//Fin afficherFormPoserUnCommentaires()


		 /**
		 * Côté internaute - Afficher la liste de tous les Commentaires et un formulaire pour ajouter un.
		 */
		public static function afficherListeCommentaires($aCommentaires,$IdConnecte,$idEnchere)
		{
		$oUtilisateur = new Utilisateur($IdConnecte);
		$oUtilisateur-> rechercherUnUtilisateur();
		$Prenom= $oUtilisateur ->getPrenom() ;
		$Nom= $oUtilisateur ->getNom() ;
		
		//1/ Pour l'utilisateur connecte: afficher un formulaire, ajouter Un Commentaire
		echo '
		<article class="col-xs-12 col-sm-10 col-sm-offset-1   icon_commenter ">
			<article class="row commentaires">
				<section class=" col-sm-2 col-xs-12">
					<div class="text-center ">
						<p>
							<span class="glyphicon glyphicon-user"></span>
						</p>
						<p class="icon_pos_comm">
							'.$Nom .' '.$Prenom.'
						</p>
					</div>
				</section>
				<section class=" col-sm-10 col-xs-12">
					<form class=" form-horizontal " action="index.php?page='.$_GET["page"].'&action=ajouCommentaire&idUtilisateur='.$IdConnecte.'&idEnchere='.$idEnchere.'" method="post">
						<fieldset>
							<legend >
								<a href="index.php?page='.$_GET["page"].'&action=instruction_commentaire">Consignes sur les commentaires</a>
							</legend>
							<article class="clearfix">
								<textarea rows="3" name="txtCommentaire" id="commentaire"  ></textarea>
							</article>
		
							<input class="btn-primary  pull-right" type="submit" name="cmd" value="Publier">
						</fieldset>
					</form>
				</section>
			</article>
		</article>
		
		';
		//2 Afficher la liste de tous les Commentaires pour l'enchère choisie.
		if (count($aCommentaires) <= 0 && !empty($aMsg['sMsg'])) {
		echo "
		<p>
		Aucun Commentaire n'est disponible. Veuillez en ajouter un.
		</p>";
		return;
		}
		else {
	
		$aMsg = array();
		for ($iComm = 0; $iComm < count($aCommentaires); $iComm++)
		{
			$IdUtilisateur = $aCommentaires[$iComm] -> getIdUtilisateur();
			$oUtilisateur = new Utilisateur($IdUtilisateur);
			$oUtilisateur-> rechercherUnUtilisateur();
			$Prenom= $oUtilisateur ->getPrenom() ;
			$Nom= $oUtilisateur ->getNom() ;
		
		if($IdUtilisateur==$IdConnecte)
		{
			$aMsg['titre'] = "Supprimer";
		}else{
			$aMsg['titre'] = "Signaler un abus";
		}
		echo '
		<article class="col-xs-12 col-sm-10 col-sm-offset-1 icon_commenter ">
			<article class="row comment_afficher">
				<section class=" col-sm-2 col-xs-12">
					<div class="text-center ">
					<p>
						<span class="glyphicon glyphicon-user"></span>
					</p>
					<p class="Nom_prenom">
						'.$Nom .' '.$Prenom.'
					</p>
					</div>
				</section>
				<section  class=" col-sm-10 col-xs-12">
				<p >
				'.$aCommentaires[$iComm] -> getDateCommentaire().' <a class="abus" href="index.php?page='.$_GET['page'].'&action='.$aMsg['titre'].'&IdCommentaire='.$aCommentaires[$iComm] -> getIdCommentaire().'&idEnchere='.$idEnchere.'"> | '.$aMsg['titre'].' </a>
				</p>
			
				<p>
				'.$aCommentaires[$iComm] -> getCorpsCommentaire().'
				</p>
				</section >
			</article>
		</article>
		';
		}
		echo '
		<!-- Fin Affichage_commentaires-->
	
		';
		}

//            Vue::footer();
		}//Fin afficherListeCommentaires
		
		
		public static function afficherInstruction_commentaire()
		{
	
		
		echo '
			<!-- Débue page Instructions_commentaires-->
			<article id="Instructions" >
				<article class="row ">
					<article class="col-md-4">
						<a href="index.php?page='.$_GET["page"].'">Retourner</a>
						<h3>Articles Commentaires et partage apparentés. </h3>
						<ul>
							<li>
							<a href="index.php?page='. $_GET["page"] .'&action=PublierUnCommentaire"> -Publier un commentaire sur Arts aux enchères </a>
							</li>
							<li>
								<a href="pages/Retrouver_commentaires.html">-Retrouvez vos commentaires sur Arts aux enchères </a>
							</li>
							<li>
								<a href="pages/Supprim_commentaires.html">-Supprimer un commentaire sur Arts aux enchères </a>
							</li>
						</ul>
					</article>
					<article class="col-md-8">
						<article id="article_Instructions"></article>
						<h1> Instructions concernant la publication de commentaires sur le site Arts aux enchères </h1>
						<p>
							article offre des instructions détaillées sur les commentaires acceptables sur le site Arts aux enchères. Il peut également expliquer pourquoi certaines entrées n\'apparaissent plus sur le site.
						</p>
						<p>
							Les commentaires sur les pages le site Arts aux enchères vous permettent d\'entamer des discussions, de poser des questions et de donner votre opinion. Voici quelques éléments à prendre en compte avant de publier un commentaire&nbsp;:
						</p>
						<ol>
							<li>
								Ne recourez pas à un langage obscène, insultant ou grossier (conformément aux règles mises en place par le site Arts aux enchères et à la seule discrétion de la société). Il est interdit de harceler ou d\'insulter les autres utilisateurs ou de menacer la sécurité ou la propriété d\'autrui, de faire des déclarations diffamatoires ou calomnieuses ou encore d\'usurper l\'identité d\'une autre personne.
							</li>
							<li>
								Ne publiez pas d\'informations personnelles telles que des numéros de téléphone, des adresses postales ou électroniques ou des informations relatives à une carte de crédit qui vous concernent ou concernent d\'autres personnes.
							</li>
							<li>
								Vous n\'avez pas le droit de copier les biens, marques déposées ou propriétés intellectuelles d\'autrui. Il s\'agit là d\'une violation de la loi. Cela inclut les «&nbsp;copier-coller&nbsp;» de contenu provenant d\'autres sites internet. Vos commentaires doivent refléter vos propres pensées.
							</li>
							<li>
								Vous n\'avez pas le droit de publier du contenu HTML, des virus ou tout autre code malveillant.
							</li>
						</ol>
					</article>
				</article>
			</article>
		';

		}//Fin afficherInstruction_commentaire()
		
		
		public static function PublierUnCommentaire () 
		{
		echo '
		<!-- Débue page Publier_commentaires-->
			<article id="Instructions" >
				<article class="row ">
					<article class="col-md-4">
						<a href="pages/detailEnchere.html">Retourner</a>
						<h3>Articles Commentaires et partage apparentés. </h3>
						<ul>
							<li>
								<a href="pages/Publier_commentaire.html">-Publier un commentaire sur Arts aux enchères</a>
							</li>
							<li>
								<a href="pages/Retrouver_commentaires.html">-Retrouvez vos commentaires sur Arts aux enchères </a>
							</li>
							<li>
								<a href="pages/Supprim_commentaires.html">-Supprimer un commentaire sur Arts aux enchères </a>
							</li>
						</ul>
					</article>
					<article class="col-md-8">
						<article id="article_Instructions"></article>
						<h1> Publier un commentaire sur Arts aux enchères</h1>
						<p>
							Rejoignez la discussion en publiant vos commentaires sur les œuvres en enchères. Voici comment faire.
						</p>
						<p>
							<span>Avant toute publication</span> - Veillez à avoir pris connaissance de nos règles concernant<a href="Instructions_commentaires.html">  la publication de commentaires.</a>
						</p>
						<ol>
							<li>
								1.	Connectez-vous à votre compte Arts aux enchères.
							</li>
							<li>
								 2.	Accédez à n’importe quel œuvre en enchère.
							<li>
								3.	Faites défiler l’écran puis cliquez ou appuyez sur<span>Tous commentaires.</span> Saisissez vos commentaires dans le champ.
							</li>
							<li>
								4.	Cliquez ou appuyez sur <span>Publier</span>.
							</li>
						</ol>
					</article>
				</article>
			</article>
				
		';
		
		
		}//Fin PublierUnCommentaire () 


            // -------------------------------------------------------------------------------------------
            /**
             * Côté internaute sens avoir un conte : Afficher la liste de tous les Commentaires .
             */
            public static function afficherListeCommentairesPublique($aCommentaires,$idEnchere)
            {

                // Afficher la liste de tous les Commentaires pour l'enchère choisie.
                if (count($aCommentaires) <= 0 && !empty($aMsg['sMsg'])) {
                    echo "
		<p>
		Aucun Commentaire n'est disponible. Veuillez en ajouter un.
		</p>";
                    return;
                }
                else {
                    $aMsg = array();
                    for ($iComm = 0; $iComm < count($aCommentaires); $iComm++)
                    {
                        $IdUtilisateur = $aCommentaires[$iComm] -> getIdUtilisateur();
                        $oUtilisateur = new Utilisateur($IdUtilisateur);
                        $oUtilisateur-> rechercherUnUtilisateur();
                        $Prenom= $oUtilisateur ->getPrenom() ;
                        $Nom= $oUtilisateur ->getNom() ;

                        $aMsg['titre'] = "Signaler un abus";
                        echo '
		<article class="col-xs-12 col-sm-10 col-sm-offset-1 icon_commenter ">
			<article class="row comment_afficher">
				<section class=" col-sm-2 col-xs-12">
					<div class="text-center ">
					<p>
						<span class="glyphicon glyphicon-user"></span>
					</p>
					<p class="Nom_prenom">
						'.$Nom .' '.$Prenom.'
					</p>
					</div>
				</section>
				<section  class=" col-sm-10 col-xs-12">
				<p >
				'.$aCommentaires[$iComm] -> getDateCommentaire().' <a class="abus" href="index.php?page='.$_GET['page'].'&action='.$aMsg['titre'].'&IdCommentaire='.$aCommentaires[$iComm] -> getIdCommentaire().'"> | '.$aMsg['titre'].' </a>
				</p>

				<p>
				'.$aCommentaires[$iComm] -> getCorpsCommentaire().'
				</p>
				</section >
			</article>
		</article>
		';
                    }
                    echo '
		<!-- Fin Affichage_commentaires-->

		';
                }

            }//Fin afficherListeCommentairesPublique
		
		
		
		
	
		}//Fin VueCommentaire

		
		
		
		
		