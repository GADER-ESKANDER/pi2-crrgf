<?php
/**
 * @classe VueVente VueVente.class.php "vues/VueVente.class.php"
 * @version 0.0.1
 * @date 2014-11-04
 * @author Eric Revelle
 * @brief Affiche les ventes.
 * @details Permet d'afficher l'état des livraisons pour un artiste.
 */
class VueVente {

	public static function listeVentes(array $aMsg = array()) {

		Vue::head("Mes ventes","...","vente.css");
		Vue::header();
		Vue::nav();

		Vue::alerte($aMsg);


		$oEnchereGagnee = new EnchereGagnee();
		$aOEncheresGagnees = $oEnchereGagnee->listeEncheresGagneesParIdUtilisateur(3);
		//die(var_dump($aOEncheresGagnees));

		if ( count($aOEncheresGagnees) ) {
		?>
		<article class="contenu-principal col-md-12">
				<section class="row">
					<article class="col-md-10 col-md-offset-1">
						<header>
							<h1 class="text-center">Vos ventes</h1>
							<p class="text-center">Liste des oeuvres que vous avez vendues.</p>
						</header>
						<table class="table-ventes table table-striped">
							<thead>
								<tr>
									<th>#</th>
									<th>Nom de l'oeuvre</th>
									<th>Prix vendue</th>
									<th>Date achat</th>
									<th>Infos de livraison</th>
									<th>Livré</th>
								</tr>
							</thead>
							<tbody>
								<?php
								foreach ( $aOEncheresGagnees AS $oVente  ) {

									echo "
										<tr>
											<td>".$oVente->getId()."</td>
											<td>".$oVente->getTitre()."</td>
											<td>".$oVente->getPrixAchat()." \$CAD</td>
											<td>".$oVente->getDate()."</td>
											<td>...</td>
											<td><a href=\"#\"><span class=\"glyphicon glyphicon-ok-circle\"></span></a><a href=\"#\"><span class=\"glyphicon glyphicon-remove-circle\"></span></a></td>
										</tr>
									";

								}
								?>
							</tbody>
						</table>
					</article>
				</section>
			</article>

		<?php
		} else {

			Vue::alerte(array("type"=>"info","msg"=>"Vous n'avez actuellement aucune vente."));

		}

		Vue::footer();

	}

}