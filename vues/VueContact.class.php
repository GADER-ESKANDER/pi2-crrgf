<?php
/**
 * @classe VueContact VueContact.class.php "classes/VueContact.class.php"
 * @version 0.0.1
 * @date 2014-10-25
 * @author Gader Eskander
 * @brief Affiche le contenue de la page de contact.
 * @details Permet d'afficher le contenu de la page de contact.
 */
class VueContact {

	public static function afficherContact(array $aMsg = array()) {

		// Inclu les morceaux de pages, dont les metas, l'entete, la navigation .
		Vue::head('Contactez-nous', 'Page de contact de site Arts aux enchères');
		Vue::header();
		Vue::nav();
		Vue::alerte($aMsg);

		echo "
			<article class=\"contenu-principal col-sm-8 col-sm-offset-2 col-md-6-col-md-offset-3\">
				<section>
					<header>
						<h1 class=\"text-center\">Laissez-nous un message</h1>
						<p class=\"text-center\">Pour nous contacter, utilisez ce formulaire en précisant l’objet de votre message</p>
					</header>
					<div class=\"form-conteneur\">
						<form action=\"index.php?page=".$_GET['page']."&action=ajouContact\" method=\"post\">
							<div class=\"row\">
								<div class=\"form-group col-sm-6\">
									<label>Nom</label>
									<input type=\"text\" class=\"form-control\" name=\"txtNom\" placeholder=\"Smith\" autofocus>
								</div>
								<div class=\"form-group col-sm-6\">
									<label>Prénom</label>
									<input type=\"text\" class=\"form-control\" name=\"txtPrenom\" placeholder=\"John\">
								</div>
							</div>
							<div class=\"form-group\">
								<label for=\"exampleInputEmail1\">Courriel</label>
								<div class=\"input-group\">
									<span class=\"input-group-addon\">@</span>
									<input class=\"form-control\" type=\"email\" name=\"txtEmail\" placeholder=\"courriel@yahoo.ca\">
								</div>
							</div>
							<div class=\"form-group\">
								<label >Message</label>
								<textarea class=\"form-control\" rows=\"5\" name=\"textarea\" placeholder=\"Votre message...\"></textarea>
							</div>
							<button class=\"btn btn-default\" type=\"submit\" name=\"cmd\">Enovoyer</button>
						</form>
					</div>
					<!-- Fin Formulaire-->
				</section>
			</article>";

		Vue::footer();

	}

}