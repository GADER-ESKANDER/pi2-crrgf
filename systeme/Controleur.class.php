<?php
/**
 * @class Controleur Controleur.class.php "systeme/Controleur.class.php"
 * @version 0.0.1
 * @date 2014-10-17
 * @author Eric Revelle
 * @brief Controleur principal
 * @details Gère les sections du site relative a tout le site
 */
class Controleur {

	public function gererErreurs() {

		VueErreur::afficherErreur404();

	}

}