<?php
/**
 * @classe VueAccueil VueUtilisateur.class.php "classes/VueUtilisateur.class.php"
 * @version 0.0.1
 * @date 2014-10-18
 * @author Martin Côté
 * @brief Affiche les formulaires Utilisateur ainsi que la page de choix.
 * @details Permet d'afficher le choix des parametres utilisateur ainsi que leur formulaires.
 */
class VueUtilisateur {

	/**
	 *
	 */
	public static function afficherFormModSup($oUtilisateur, $aMsg = array()) {

		$nom=(isset($_POST['cmd']))? $_POST['nom'] : trim($oUtilisateur->getNom());
		$prenom=(isset($_POST['cmd']))? $_POST['prenom'] : trim($oUtilisateur->getPrenom());
		$password=(isset($_POST['cmd']))? $_POST['password'] : trim($oUtilisateur->getMotDePasse());
		$courriel=(isset($_POST['cmd']))? $_POST['courriel'] : trim($oUtilisateur->getCourriel());


		// Inclu les morceaux de pages, dont les metas, l'entete, la navigation et le carousel
		Vue::head('Achetez des oeuvres d\'art', 'Site de vente d\'oeuvres d\'art en ligne');
		Vue::header();
		Vue::nav();

		echo"
			<article class=\"contenu-principal col-sm-10 col-sm-offset-1 col-md-8 col-md-offset-2\">
				<!-- Formulaire modification -->
				<section>
					<article>
						<header>
							<h1 class=\"text-center\">Formulaire de modification</h1>
							<p class=\"text-center\">Modifier les données de votre compte.</p>
						</header>
						<div class=\"form-conteneur\">";
							Vue::alerte($aMsg);
					echo "<form class=\"form-horizontal\" role=\"form\" action=\"index.php?page=utilisateur&action=parametres\" method=\"post\" id=\"FormModification\">

										<div class=\"form-group\">
											<label for=\"inputNom\" class=\"col-sm-2 control-label\">Nom</label>
											<div class=\"col-sm-10\">
												<input type=\"text\" name=\"nom\" class=\"form-control\" id=\"inputNom\" placeholder=\"Nom\" value=\"$nom\">
												<span class=col-xs12></span>
											</div>
										</div>
										<div class=\"form-group\">
											<label for=\"inputPrenom\" class=\"col-sm-2 control-label\">Prénom</label>
											<div class=\"col-sm-10\">
												<input type=\"text\" name=\"prenom\" class=\"form-control\" id=\"inputPrenom\" placeholder=\"Prénom\" value=\"$prenom\">
												<span class=col-xs12></span>
											</div>
										</div>
										<div class=\"form-group\">
											<label for=\"inputEmail\" class=\"col-sm-2 control-label\">Courriel</label>
											<div class=\"col-sm-10\">
												<input type=\"email\" name=\"courriel\" class=\"form-control\" id=\"inputEmail\" placeholder=\"Courriel\" value=\"$courriel\">
												<span class=col-xs12></span>
											</div>
										</div>

										<div class=\"form-group\">
											<label for=\"inputPassword\" class=\"col-sm-2 control-label\">Mot de passe</label>
											<div class=\"col-sm-10\">
												<input type=\"password\" name=\"password\" class=\"form-control\" id=\"inputPassword\" placeholder=\"Mot de passe\" value=\"\">
												<span class=col-xs12></span>
											</div>
										</div>
										<div class=\"form-group\">
											<div class=\"col-sm-offset-2 col-sm-2\">
												<button type=\"submit\" name=\"cmd\" class=\"btn btn-default\" value=\"modifier\">Modifier</button>
											</div>
										</div>
									</form>
						</div>
					</article>
				</section><!-- /Formulaire modification -->
				<!-- Formulaire de suppression -->
				<section>
					<article>
						<header>
							<h1 class=\"text-center\">Formulaire de suppression</h1>
							<p class=\"text-center\">Suprimmer votre compte.</p>
						</header>
						<div class=\"form-conteneur\">";
							Vue::alerte($aMsg);
					echo "<form role=\"form\" action=\"index.php?page=utilisateur&action=parametres\" method=\"post\" id=\"formSupression\">
										<div class=\"form-group\">
											<label for=\"txtarea\">Pour quelles raisons désirez-vous supprimer votre compte? :</label>
											<textarea class=\"form-control\" rows=\"5\"></textarea>
										</div>

										<div class=\"col-sm-offset-2 col-sm-2\">
											<div>
												<button type=\"submit\" name=\"cmd\" class=\"btn btn-default\" value=\"supprimer\">Supprimer</button>
											</div>
										</div>
									</form>
						</div>
					</article>
				</section><!-- /Formulaire de suppression -->
			</article>";

		Vue::footer();

	}//Fin de la fonction afficherFormSup

	public static function afficherFormInscription($aMsg = array()){

		$nom=(isset($_POST['cmd']))? $_POST['nom'] : "";
		$prenom=(isset($_POST['cmd']))? $_POST['prenom'] : "";
		$courriel=(isset($_POST['cmd']))? $_POST['courriel'] : "";
		$confCourriel=(isset($_POST['cmd']))? $_POST['confCourriel'] : "";
		$password=(isset($_POST['cmd']))? $_POST['password'] : "";

		//var_dump($_POST);

		Vue::head('Inscription gratuite et facile', 'Site de vente d\'oeuvres d\'art en ligne');
		Vue::header();
		Vue::nav();
		echo "
			<article class=\"contenu-principal col-sm-10 col-sm-offset-1 col-md-8 col-md-offset-2\">
				<section>
					<article>
						<header>
							<h1 class=\"text-center\">Formulaire d'inscription</h1>
							<p class=\"text-center\">Inscrivez-vous, c'est gratuit et facile.</p>
						</header>
						<div class=\"form-conteneur\">";
							Vue::alerte($aMsg);
						echo"<form name=\"formModification\" class=\"form-horizontal\" role=\"form\" action=\"index.php?page=utilisateur&action=inscription\" method=\"post\">

									<div class=\"form-group\">
										<label for=\"inputNom\" class=\"col-sm-2 control-label\">Nom</label>
										<div class=\"col-sm-10\">
											<input type=\"text\" class=\"form-control\" id=\"inputNom\" name=\"nom\" placeholder=\"Nom\" value=\"$nom\">
										</div>
									</div>
									<div class=\"form-group\">
										<label for=\"inputPrenom\" class=\"col-sm-2 control-label\">Prénom</label>
										<div class=\"col-sm-10\">
											<input type=\"text\" class=\"form-control\" id=\"inputPrenom\" name=\"prenom\" placeholder=\"Prénom\" value=\"$prenom\">
										</div>
									</div>
									<div class=\"form-group\">
										<label for=\"inputEmail\" class=\"col-sm-2 control-label\">Courriel</label>
										<div class=\"col-sm-10\">
											<input type=\"email\" class=\"form-control\" id=\"inputEmail\" name=\"courriel\" placeholder=\"Courriel\" value=\"$courriel\">
										</div>
									</div>
									<div class=\"form-group\">
										<label for=\"inputConfEmail\" class=\"col-sm-2 control-label\">Confirmation Courriel</label>
										<div class=\"col-sm-10\">
											<input type=\"email\" class=\"form-control\" id=\"inputConfEmail\" name=\"confCourriel\" placeholder=\"Confirmer courriel\" value=\"$confCourriel\">
										</div>
									</div>
									<div class=\"form-group\">
										<label for=\"inputPassword\" class=\"col-sm-2 control-label\">Mot de passe</label>
										<div class=\"col-sm-10\">
											<input type=\"password\" class=\"form-control\" id=\"inputPassword\" name=\"password\" placeholder=\"Mot de passe\" value=\"$password\">
										</div>
									</div>
									<div class=\"form-group\">
										<div class=\"col-sm-offset-2 col-sm-10\">
											<button type=\"submit\" class=\"btn btn-default\" name=\"cmd\">Soumettre</button>
										</div>
									</div>
								</form>
						</div>
					</article>
				</section>
			</article>";

		Vue::footer();

	}// fonction afficherFormInscription()

	public static function afficherFormConnexion($aMsg = array()){

		$courriel=(isset($_POST['cmd']))? $_POST['courriel'] : "";

		Vue::head('Se connecter', 'Site de vente d\'oeuvres d\'art en ligne');
		Vue::header();
		Vue::nav();

		echo"
			<article class=\"contenu-principal col-sm-10 col-sm-offset-1 col-md-8 col-md-offset-2\">
				<section>
					<article>
						<header>
							<h1 class=\"text-center\">Formulaire de connexion</h1>
							<p class=\"text-center\">Connectez-vous pour profiter pleinement du site</p>
						</header>
						<div class=\"form-conteneur\">";

						Vue::alerte($aMsg);

						echo"<form class=\"form-horizontal\" role=\"form\" action=\"index.php?page=utilisateur&action=connexion\" method=\"post\">

									<div class=\"form-group\">
										<label for=\"inputEmail\" class=\"col-sm-2 control-label\">Courriel</label>
										<div class=\"col-sm-10\">
											<input type=\"email\" name=\"courriel\"class=\"form-control\" id=\"inputEmail\" placeholder=\"Courriel\" value=\"$courriel\">
										</div>
									</div>
									<div class=\"form-group\">
										<label for=\"inputPassword\" class=\"col-sm-2 control-label\">Mot de passe</label>
										<div class=\"col-sm-10\">
											<input type=\"password\" name=\"password\" class=\"form-control\" id=\"inputPassword\" placeholder=\"Mot de passe\">
										</div>
									</div>
									<!--<div class=\"form-group\">
										<div class=\"col-sm-offset-2 col-sm-10\">
											<div class=\"checkbox\">
												<label>
													<input type=\"checkbox\">Se souvenir de moi
												</label>
											</div>
										</div>
									</div>-->
									<div class=\"form-group\">
										<div class=\"col-sm-offset-2 col-sm-10\">
											<button type=\"submit\" name=\"cmd\"class=\"btn btn-default\">Connexion</button></a>
										</div>
									</div>
								</form>
						</div>
					</article>
				</section>
			</article>";

		Vue::footer();
	}

}