<?php
/**
 * @classe VueVente VueVente.class.php "vues/VueVente.class.php"
 * @version 0.0.1
 * @date 2014-11-04
 * @author Eric Revelle
 * @brief Affiche les achats.
 * @details Permet d'afficher les enchères auxquelles un utilisateur à participé.
 */
class VueVente {

	public static function toutes(array $aMsg = array()) {

		Vue::head();
		Vue::header();
		Vue::nav();

		Vue::alerte($aMsg);

		$oEnchereGagnees = new EnchereGagnee();
		var_dump($oEnchereGagnees->getEncheresGagneesParIdUtilisateur());

		?>

		<table class="table table-hover">
			<thead>
				<tr>
					<th>Nom de l'oeuvre</th>
					<th>Prix vendue</th>
					<th>Date achat</th>
					<th>Infos de livraison</th>
				</tr>
			</thead>
			<tbody>
				<?php
				foreach ( $aOeuvreVendue =>  ) {

					

				}
				?>
			</tbody>
		</table>

		<?php

		Vue::footer();

	}

}