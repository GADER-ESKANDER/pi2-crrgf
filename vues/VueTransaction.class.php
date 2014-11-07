<?php
/**
 * @classe VueTransaction VueTransaction.class.php "classes/VueTransaction.class.php"
 * @version 0.0.1
 * @date 2014-10-18
 * @author Eric Revelle
 * @brief Affiche le message concernant la transaction.
 * @details Permet d'afficher un message personnalisé selon le déroulement transaction.
 */
class VueTransaction {

	/**
	 * Affiche le contenu de la page d'accueil du site côté clients
	 */
	public static function afficherSuccess(array $aMsg = array()) {

		// Inclu les morceaux de pages, dont les metas, l'entete, la navigation et le carousel
		Vue::head('Transaction effectué avec succès', 'Site de vente d\'oeuvres d\'art en ligne');
		Vue::header();
		Vue::nav();

		if ( isset($_POST['item_number']) ) {

			$oEnchere = new Enchere($_POST['item_number']);
			$oEnchere->fermerEnchere();

			// Affichage d'une alerte
			Vue::alerte($aMsg);

			echo "
				<article class=\"contenu-principal col-md-10 col-md-offset-1\">
					<section class=\"row\">
						<article class=\"col-md-10 col-md-offset-1\">
							<header>
								<h1 class=\"text-center\">Félicitation !</h1>
								<p class=\"text-center\">La transaction s'est effectué avec succès.</p>
							</header>
							<p>Nous vous remercions pour votre paiement. Votre transaction est terminée et vous allez recevoir par courriel un reçu pour votre achat. Vous pouvez vous connecter à votre compte sur <a href=\"https://www.sandbox.paypal.com\" title=\"Connectez-vous à votre compte\"><img src=\"https://www.paypalobjects.com/webstatic/fr_CA/mktg/logo-image/pp_cc_mark_37x23.jpg\" width=\"auto\" height=\"24\" alt=\"Logo de Paypal\"></a> pour consulter les détails de cette transaction.</p>
						</article>
					</section>
				</article>";

		} else {

			// Affichage d'une alerte
			Vue::alerte(array('type'=>'danger','msg'=>'Une erreur inatendue s\'est produite.'));

			echo "
				<article class=\"contenu-principal col-md-10 col-md-offset-1\">
					<section class=\"row\">
						<article class=\"col-md-10 col-md-offset-1\">
							<header>
								<h1 class=\"text-center\">Erreur</h1>
								<p class=\"text-center\">Une erreur inatendue s'est produit après la transaction.</p>
							</header>
							<p>Notre équipe tentera de régler le problème le plus rapidement possible.<br>Un courriel vous sera envoyé sous peu.</p>
						</article>
					</section>
				</article>";

		}

		Vue::footer();

	}

	public static function afficherAnnule(array $aMsg = array()) {

		// Inclu les morceaux de pages, dont les metas, l'entete, la navigation et le carousel
		Vue::head('Transaction annulé', 'Site de vente d\'oeuvres d\'art en ligne');
		Vue::header();
		Vue::nav();

		// Affiche un alerte
		Vue::alerte($aMsg);

		echo "
			<article class=\"contenu-principal col-md-10 col-md-offset-1\">
				<section class=\"row\">
					<article class=\"col-md-10 col-md-offset-1\">
						<header>
							<h1 class=\"text-center\">Paiement Annulé!</h1>
							<p class=\"text-center\">La transaction a été annulé.</p>
						</header>
						<p>Si vous en êtes pas la cause, veuillez réessayer un peu plus tard ou bien communiquer avec nous.</p>
						<pre>"; var_dump($_POST); echo "</pre>
					</article>
				</section>
			</article>
		";

		Vue::footer();

	}

}