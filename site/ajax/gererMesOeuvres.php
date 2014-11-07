<?php

session_start();
	/**
	 * Inclure les librairies
	 */	
	require_once("../../libs/TypeException.class.php");
	require_once("../../libs/MySqliException.class.php");
	require_once("../../libs/MySqliLib.class.php");
	
	/* * Inclure le contrôleur
	 */
	 
	
	require_once("../../systeme/Controleur.class.php");
	//header("Location: index.php?page=utilisateur&action=connexion");
	require_once("../../controleurs/ControleurSite.class.php");
	
   
	 /**
	 * Inclure les modèles
	 */
	require_once("../../systeme/Conf.class.php");
	require_once("../../systeme/Connexion.class.php");
	require_once("../../systeme/Modeles.class.php");
	require_once("../../modeles/Oeuvre.class.php");
	
	
	require_once("../../modeles/Technique.class.php");
	
	require_once("../../modeles/Theme.class.php");
	require_once("../../modeles/Utilisateur.class.php");
	
	  
	/**
	 * Inclure le contrôleur
	 */
	 require_once("../../vues/Vue.class.php");
	 require_once("../../vues/VueOeuvre.class.php");
	try{		
		ControleurSite::ajax_gererMesOeuvres();
				
	}catch(Exception $e){
		echo $e->getMessage();
	}
	
?>