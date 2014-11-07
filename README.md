pi2-crrgf - projet integration 2 - Arts aux Enchères
=========

# Les Dossiers
Les dossiers sont admin, bdd, controleurs, libs, modeles, site, systeme et vues.

## admin
Contient les fichiers de base nécessaires à la section d'administration.

## bdd
Contient les fichiers SQL pour créer et populer la base de données.

## controleurs
Contient les controleurs qui héritent de la classe controleur principale.

## libs
Contient divers librairies du site internet.

## modeles
Contient les modeles qui héritent de la classe modele principale

## site
Contient les fichiers de base du site pour les utilisateurs du site.

## systeme
Contient tout les fichiers "piliers" du site. Le fichier de configuration, de connexion à la bdd, le controleur principal, d'inclusions et du modele de base.

## vues
Contient les vues du site internet.

# Les fichiers
Les fichiers asurant le fonctionnement minimal du site

## bdd/ struc-bdd.sql
Fichier SQL permettant de créer la structure de la base de données ainsi que ses contraintes.

## bdd /donnees-bdd.sql
Fichier SQL permettant de populer la base de données.

## controleurs/ ControleurAdmin.class.php
Gère l'affichage des données correpsondantes au requete de l'administrateur.

## controleurs/ ControleurSite.class.php
Gère l'affichage des données correpsondantes au requete de l'utilisateur.

## libs/ TypeException.class.php
Teste le type des données et renvoie le message correspondant.

## modeles/

## systeme/ Conf.class.php
Contient les configurations pour les connexions aux base de données.

## systeme/ Connexion.class.php
Crée la connexion à la base de donnée avec PDO et ses attributs de base.

## systeme/ Controleur.class.php
Controleur de base contenant les méthodes communes à tout le site.

## systeme/ includes.php
Fichier d'inclusion des classes de l'application.

## systeme/ Modeles.class.php
Modele de base contenant les méthodes communes à l'application.

## vues/ Vue.class.php
Classe contenant les bouts de html commune à tout le site. L'entête du document, l'entête de la page, la navigation, un carousel et le pied de page.
