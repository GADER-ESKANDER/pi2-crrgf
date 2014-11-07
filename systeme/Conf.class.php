<?php
/**
 * @class Conf Conf.class.php "systeme/Conf.class.php"
 * @version 0.0.1
 * @date 2014-10-17
 * @author Eric Revelle
 * @brief Configurations de l'application
 * @details Contient les différentes donnees de configurations de l'application
 */
class Conf {

	// Tableau contenant les configurations d'accès à la base de données
	static $aBaseDonnees = array(
		"defaut" => array(
			"hote"        => "localhost",
			"bd"          => "bd_pi2",
			"utilisateur" => "root",
			"motDePasse"  => "",
		),
		"eric" => array(
			"hote"        => "localhost",
			"bd"          => "e1195921",
			"utilisateur" => "e1195921",
			"motDePasse"  => "aaa",
		),
		"feng" => array(
			"hote"        => "127.0.0.1",
			"bd"          => "bd_pi2",
			"utilisateur" => "root",
			"motDePasse"  => "26y6fasdf",
		),
		"martin" => array(
			"hote"        => "localhost",
			"bd"          => "pi2",
			"utilisateur" => "e9581797",
			"motDePasse"  => "hb193ss94",

		)
	);

}