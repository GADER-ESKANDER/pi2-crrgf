<?php
/**
 * @classe VueAccueil VueAccueil.class.php "classes/VueAccueil.class.php"
 * @version 0.0.1
 * @date 2014-10-18
 * @author Eric Revelle
 * @brief Affiche le contenue de la page d'accueil.
 * @details Permet d'afficher le contenu de la page d'accueil.
 */
class VueAccueil {

	/**
	 * Affiche le contenu de la page d'accueil du site côté clients
	 */
	public static function afficherAccueil(array $aMsg = array()) {

		// Inclu les morceaux de pages, dont les metas, l'entete, la navigation et le carousel
		Vue::head('Achetez des oeuvres d\'art', 'Site de vente d\'oeuvres d\'art en ligne');
		Vue::header();
		Vue::nav();

		// Affiche un message d'alerte
		Vue::alerte($aMsg);

		Vue::carousel(array(array('src' => 'carousel5.jpg', 'alt' => 'Image 1'), array('src' => 'carousel7.jpg', 'alt' => 'Image 2'), array('src' => 'carousel8.jpg', 'alt' => 'Image 3'), array('src' => 'carousel9.jpg', 'alt' => 'Image 4'), array('src' => 'carousel10.jpg', 'alt' => 'Image 5'), array('src' => 'carousel11.jpg', 'alt' => 'Image 6'), array('src' => 'carousel12.jpg', 'alt' => 'Image 7')));

		echo "

			<article class=\"contenu-principal col-md-10\">
				<section class=\"a-propos row\">
					<article class=\"col-md-9 col-md-offset-1\">
						<header>
							<h1 class=\"text-center\">À propos de nous</h1>
							<p class=\"text-center\">Un site qui rassemble les passionnés d'oeuvres d'art.</p>
						</header>
						<p><strong>Arts aux enchères</strong> permet aux artistes de proposés des oeuvres sous la forme d’enchères. Nous offrons aussi la possibilité aux artistes de proposer leurs oeuvres en  mode achat instantané.</p>
					</article>
				</section>
				<section class=\"fonctionnalites row\">
					<article class=\"col-md-9 col-md-offset-1\">
						<header>
							<h1 class=\"text-center\">Fonctionnalités</h1>
							<p class=\"text-center\">Accédez à tout moment et de partout à vos informations via une interface personnalisé.</p>
						</header>
						<ul>
							<li>Accès depuis votre mobile</li>
							<li>Suivi de l'état de vos mises et achats via une interface</li>
							<li>Alertes par courriel</li>
						</ul>
						<p class=\"text-center\"><img src=\"img/mobiles.png\" alt=\"Tableau6\"></p>
					</article>
				</section>
				<section class=\"notre-engagement row\">
					<article class=\"col-md-9 col-md-offset-1\">
						<header>
							<h1 class=\"text-center\">Notre engagement</h1>
							<p class=\"text-center\">La promesse d'<strong>Arts aux Enchères</strong></p>
						</header>
						<p>Nous élevons votre expérience artistique, grâce à une approche spécialisée, complète et unique dans le monde du marché de l’art.</p>
						<p>Nous offrons des services d’une qualité exemplaires, peu importe la valeur de votre oeuvre.</p>
					</article>
				</section>
			</article>
		";

		VueEnchere::derniereEnchere(4);
		Vue::footer();

	}

}