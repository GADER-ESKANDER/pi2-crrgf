<?php
/**
 * @class ControleurAdmin ControleurAdmin.class.php "controleurs/ControleurAdmin.class.php"
 * @version 0.0.1
 * @date 2014-10-17
 * @author Eric Revelle
 * @brief Controleur de la section administrateur
 * @details Gere et controle la section d'aministration du site
 */
class ControleurAdmin extends Controleur{

	public function __construct(){

		self::gererSite();

	}

	public static function gererSite(){

		try{

			if ( !isset($_GET['page']) ) {

				$_GET['page'] = 'accueil';

			}

			switch ( $_GET['page'] ) {

				case 'accueil':
					self::gererAccueil();
					break;

				case 'admEncheres':
					ControleurAdmin::adm_GererEncheres();
					break;

				case 'commentaires' :// Administrateur
					ControleurAdmin::gererAdmiCommentairs_contact();
					break;

				default:
					ControleurAdmin::gererErreurs();

			}

		} catch ( Exception $e ) {

			echo "<p class=\"alert alert-danger\">".$e->getMessage()."</p>";

		}

	}

	public static function gererAccueil(){

		echo "page accueil";

	}

/*******************************************************************************************/

	public static function adm_GererEncheres()
	{
        if(!isset($_GET['action']))
        {
            $_GET['action'] = "defaut";
        }
        switch($_GET['action'])
        {
            case 'annuler':
                ControleurAdmin::admGererAnnulerEnchere();
                break;

            case 'mod':
                ControleurAdmin::admGererModifierEnchere();
                break;

            case 'sup':
                ControleurAdmin::admGererSupprimerEnchere();
                break;

            case 'defaut':
                default:

                $aEncheres = Enchere::chargerLesEncheres();

                VueEnchere::admAfficherListeEncheres($aEncheres);

        }
	}

    public function admGererAnnulerEnchere()
    {
        if(isset($_GET['idEnchere']))
        {
            $oEnchere = new Enchere($_GET['idEnchere']);
            $oEnchere->fermerEnchere(true);
            $aEncheres = Enchere::chargerLesEncheres();
            $aMsg = array("type"=>"warning","msg"=>"Annuler avec succès!");
            Vue::alerte($aMsg);
            VueEnchere::admAfficherListeEncheres($aEncheres);
        }
        else
        {
            exit;
        }

    }

    public function admGererModifierEnchere()
    {}

    public function admGererSupprimerEnchere()
    {

        if(isset($_GET['idEnchere']))
        {
            $oEnchere = new Enchere($_GET['idEnchere']);
            $oEnchere->supprimerUnEnchere();
            $aEncheres = Enchere::chargerLesEncheres();
            $aMsg = array("type"=>"warning","msg"=>"Supprimer avec succès!");
            Vue::alerte($aMsg);
            VueEnchere::admAfficherListeEncheres($aEncheres);
        }
        else
        {
            exit;
        }
    }

}