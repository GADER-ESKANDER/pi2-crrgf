<?php
/**
 * @classe VueReglements VueReglements.class.php "vues/VueReglements.class.php"
 * @version 0.0.1
 * @date 2014-11-04
 * @author Eric Revelle
 * @brief Affiche les règlements concernant l'usage du site.
 * @details Permet d'afficher les règlements concenrant la confidentialité, la non-responsabilité et l'utilisation des commentaires sur le site.
 */
class VueReglements {

	/**
	 * Affiche la politique de confidentialité du site
	 */
	public static function confidentialite(array $aMsg = array()) {

		// Inclu les morceaux de pages, dont les metas, l'entete, la navigation et le carousel
		Vue::head('Politique de confidentialité', 'Nos conditions de confidentialité pour les utilisateurs du site.');
		Vue::header();
		Vue::nav();

		// Affiche un message d'alerte
		Vue::alerte($aMsg);

		echo "
			<article class=\"contenu-principal col-md-10 col-md-offset-1\">
				<section class=\"row\">
					<article class=\"col-md-10 col-md-offset-1\">
						<header>
							<h1 class=\"text-center\">Politique de confidentialité</h1>
							<p class=\"text-center\">Notre politique concernant l'usage de vos données.</p>
						</header>
						<p>Cette politique de confidentialité comporte des principes observés par Arts aux Enchères relativement à la collecte, l’utilisation et la divulgation de renseignements personnels.</p>
						<ul>
							<li>Cette politique s’applique aux renseignements personnels de tou utilisateurs ou individus de <strong>Arts aux Enchères</strong>, concernant les données qui y sont recueillis.</li>
							<li>Cette politique ne s’applique pas aux renseignements relatifs aux entreprises clientes de Arts aux Enchères; toutefois, de tels renseignements sont protégé par différentes ententes contractuelles, politiques et pratiques de Arts aux Enchères.</li>
							<li>Cette politique ne s’applique pas aux renseignements fournis par les employés de Arts aux Enchères; toutefois, de tels renseignements sont protégé par différentes politiques et pratiques de Arts aux Enchères.</li>
							<li>Cette politique est sujette à changement et peut être complétée ou modifiée par de nouvelles conditions applicables entre Arts aux Enchères et un particulier.</li>
						</ul>
						<ol>
							<li>Arts aux Enchères doit désigner une ou plusieurs personnes pour être responsable de la conformité avec la politique.</li>
							<li>Arts aux Enchères se doit de faire connaître, sur demande, le nom de la personne ou des personnes désignées pour superviser la conformité de Arts aux Enchères avec la politique.</li>
							<li>Arts aux Enchères est responsable des renseignements personnels en sa possession ou à sa disposition. Arts aux Enchères se doit de utiliser les moyens appropriés pour protéger les renseignements personnels pendant que ces renseignements sont traités par un tiers relativement à Arts aux Enchères (voir principe 7)</li>
							<li>Arts aux Enchères se doit d’implanter les politiques et procédures pour mettre en vigueur cette politique.</li>
						</ol>
					</article>
				</section>
			</article>
		";

		Vue::footer();

	}

	/**
	 * Affiche l'avis de non-responsabilité du site
	 */
	public static function nonResponsabilite(array $aMsg = array()) {

		// Inclu les morceaux de pages, dont les metas, l'entete, la navigation et le carousel
		Vue::head('Avis de non-responsabilité', 'La responsabilité de Arts aux Enchères envers les produits qui peuvent s\'y trouver.');
		Vue::header();
		Vue::nav();

		// Affiche un message d'alerte
		Vue::alerte($aMsg);

		echo "
			<article class=\"contenu-principal col-md-10 col-md-offset-1\">
				<section class=\"row\">
					<article class=\"col-md-10 col-md-offset-1\">
						<header>
							<h1 class=\"text-center\">Avis complet de non-responsabilité</h1>
							<p class=\"text-center\">Les responsabilités d'<strong>Arts aux Enchères</strong> et de ses membres.</p>
						</header>
						<p></p>Les informations présentées sur ce site sont basées sur des informations que nous considérons fiables, mais parce qu'ils ont été fournis par des tiers (qui à leurs tours communiquées à nous).
						<p></p>Nous ne pouvons pas représenter qu'elle est exacte ou complète, et il ne faut pas être invoqué en tant que telle. Les offres sont sujettes à des erreurs, des omissions.
						<p></p>Des changements, y compris le prix des tableaux, ou de retrait des tableaux par leur propriétaire sans préavis.
						<p></p>Toutes les dimensions des tableaux n'ont pas été vérifiées et ne peuvent être vérifiées par <strong>Arts aux Enchères</strong>.
					</article>
				</section>
			</article>
		";

		Vue::footer();

	}

	/**
	 * Affiche les règlements concernant l'usage des commentaires
	 */
	public static function commentaire(array $aMsg = array()) {

		// Inclu les morceaux de pages, dont les metas, l'entete, la navigation et le carousel
		Vue::head('Règlements sur l\'usage des commentaires','Arts aux Enchères à certains règlements quant aux messages qui y sont afficher, veuillez consulter les règlements.');
		Vue::header();
		Vue::nav();

		// Affiche un message d'alerte
		Vue::alerte($aMsg);

		echo "
			<article class=\"contenu-principal col-md-10 col-md-offset-1\">
				<section class=\"row\">
					<article class=\"col-md-10 col-md-offset-1\">
						<header>
							<h1 class=\"text-center\">Règlements sur les commentaires</h1>
							<p class=\"text-center\">À tout moment <strong>Arts aux Enchères</strong> se réserve le droits de supprimer les commentaires.</p>
						</header>
						<p>L'article offre des instructions détaillées sur les commentaires acceptables sur le site Arts aux enchères. Il peut également expliquer pourquoi certaines entrées n'apparaissent plus sur le site.</p>
						<p>Les commentaires sur les pages le site Arts aux enchères vous permettent d'entamer des discussions, de poser des questions et de donner votre opinion. Voici quelques éléments à prendre en compte avant de publier un commentaire :</p>
						<ul>
							<li>Ne recourez pas à un langage obscène, insultant ou grossier (conformément aux règles mises en place par le site Arts aux enchères et à la seule discrétion de la société).</li>
							<li>Il est interdit de harceler ou d'insulter les autres utilisateurs ou de menacer la sécurité ou la propriété d'autrui, de faire des déclarations diffamatoires ou calomnieuses ou encore d'usurper l'identité d'une autre personne.</li>
							<li>Ne publiez pas d'informations personnelles telles que des numéros de téléphone, des adresses postales ou électroniques ou des informations relatives à une carte de crédit qui vous concernent ou concernent d'autres personnes.</li>
							<li>Vous n'avez pas le droit de copier les biens, marques déposées ou propriétés intellectuelles d'autrui. Il s'agit là d'une violation de la loi. Cela inclut les « copier-coller » de contenu provenant d'autres sites internet. Vos commentaires doivent refléter vos propres pensées.</li>
							<li>Vous n'avez pas le droit de publier du contenu HTML, des virus ou tout autre code malveillant.</li>
						</ul>
					</article>
				</section>
			</article>
		";

		Vue::footer();

	}

}