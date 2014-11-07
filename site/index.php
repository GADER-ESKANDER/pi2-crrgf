<?php

	session_start();
	// Déclaration de constantes pour facilite l'acces aux chemins
	define('DS', '/'); // Le séparateur de dossier
	define('SITE', dirname($_SERVER['SCRIPT_NAME'])); // La base du site
	define('RACINE', dirname(SITE)); // La racine
	define('SYSTEME', RACINE.DS."systeme");

    date_default_timezone_set("America/New_York");
	require_once '../systeme/includes.php';

	$oControleurSite = new ControleurSite();

 ?>