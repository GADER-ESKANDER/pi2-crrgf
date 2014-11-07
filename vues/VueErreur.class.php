<?php
/**
 * @classe VueErreur VueErreur.class.php "vues/VueErreur.class.php"
 * @version 0.0.1
 * @date 2014-10-25
 * @author Eric Revelle
 * @brief Affiche les erreurs de page
 * @details Permet d'afficher un message lorsqu'un utilisateur tape un mauvas url.
 */
class VueErreur {

	/**
	 * Affiche le message d'erreur du site côté clients
	 */
	public static function afficherErreur404() {

		// Inclu les morceaux de pages, dont les metas, l'entete, la navigation et le carousel
		Vue::head('Page introuvable', 'Site de vente d\'oeuvres d\'art en ligne');
		Vue::header();
		Vue::nav();

		echo "
			<article class=\"contenu-principal col-md-6 col-md-offset-3\">
				<section class=\"page-introuvable row\">
					<article>
						<header>
							<h1 class=\"text-center\">Page introuvable</h1>
							<p class=\"text-center\">Désolé, page introuvable.</p>
						</header>
						<p class=\"text-center\">La page que vous rechercher est présentement indisponible ou n'existe pas.<br>Veuillez réessayer un peu plus tard ou choisisser un autre lien.</p>
					</article>
				</section>
			</article>
		";

		Vue::footer();

	}

}