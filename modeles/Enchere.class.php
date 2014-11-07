<?php
/**
 * Created by Xiang Feng Han
 * User: fenix
 * Date: 14-10-23
 * Time: 21:15
 */

class Enchere extends XFHModeles
{
	private $idEnchere;
	private $nomEnchere;
	private $prixDebut;
	private $montantAugment;
	private $prixAcheterMaintenant;
	private $dateDebut;
	private $dateFin;
	private $aColletionOffres;
	private $aColletionCommentaires;
	private $oCreateurEnchere;
	private $oOeuvre;
	private $etat;
	private $prixFin;

	public function  __construct($idEnchere, $oCreateur=false, $oOeuvre=false, $nomEnchere=" ", $prixDebut=0, $prixFin=0, $montantAugment=0, $prixAcheterMaintenant=0, $dateDebut=" ", $dateFin=" ")
	{
		parent::__construct();

		if($idEnchere==0)
		{
			//Nouvelle enchère
			$this->setCreateurEnchere($oCreateur);
			$this->setOeuvreEnchere($oOeuvre);
			$this->setNomEnchere($nomEnchere);
			$this->setPrixDebut($prixDebut);
			$this->setMontantAugment($montantAugment);
			$this->setPrixAcheterMaintenant($prixAcheterMaintenant);
			$this->setDateDebut($dateDebut);
			$this->setDateFin($dateFin);
			$this->setCollectionOffre(array());
			$this->setCollectionCommentaire(array());
			$this->setPrixFin($prixDebut);

		}
		else
		{
			//Enchere existante
			$this->setIdEnchere($idEnchere);
			$this->chargerUneEnchereParIdEnchere();
		}

	}

	/**
	 *
	 */
	public function setIdEnchere($idEnchere)
	{
		TypeException::estNumerique($idEnchere);
		$this->idEnchere = $idEnchere;
	}

	public function setCreateurEnchere(Utilisateur $oUtilisateur)
	{
		TypeException::estObjet($oUtilisateur);
		$this->oCreateurEnchere = $oUtilisateur;
	}

	public function setOeuvreEnchere(Oeuvre $oOeuvre)
	{
		TypeException::estObjet($oOeuvre);
		$this->oOeuvre = $oOeuvre;
	}

	public function setNomEnchere($nomEnchere)
	{
		TypeException::estString($nomEnchere);
		$this->nomEnchere = $nomEnchere;
	}

	public function setPrixDebut($prixDebut)
	{
		TypeException::estNumerique($prixDebut);
		$this->prixDebut = $prixDebut;
	}

	public function setMontantAugment($montantAugment)
	{
		TypeException::estNumerique($montantAugment);
        if($montantAugment<1)
        {
            $montantAugment = 1;
        }
		$this->montantAugment = $montantAugment;
	}

	public function setPrixAcheterMaintenant($prixAcheterMaintenant)
	{
		if ( !is_null($prixAcheterMaintenant) ) {
			TypeException::estNumerique($prixAcheterMaintenant);
			$this->prixAcheterMaintenant = $prixAcheterMaintenant;
		}
	}

	public function setDateDebut($date)
	{
		TypeException::estString($date);
		$this->dateDebut = $date;
	}

	public function setDateFin($date)
	{
		TypeException::estString($date);
		$this->dateFin = $date;
	}

	public function setPrixFin($prix)
	{
		TypeException::estNumerique($prix);
		if($prix>=($this->getPrixFin()+$this->getMontantAugment()) || !$this->getPrixFin())
		{
			$this->prixFin = $prix;
		}
		else
		{
			return false;
		}
	}

	public function ajoutOffre(Offre $oOffre, $updateBd=false)
	{
		TypeException::estObjet($oOffre);

        $aOffres = $this->getCollectionOffre();

        if(count($aOffres)>0 && $oOffre->getMontant()<=end($aOffres)->getMontant())
        {
            return false;
        }
		$this->aColletionOffres[] = $oOffre;
        $this->setPrixFin($oOffre->getMontant());

        if($updateBd==true)
        {
            $this->updateUneEnchere();
        }

	}

	public function setCollectionOffre($aCollectionOffre)
	{
		TypeException::estArray($aCollectionOffre);

		foreach($aCollectionOffre as $index=>$offre)
		{
			if(!get_class($offre)=='Offre')
			{
				unset($aCollectionOffre[$index]);
			}
		}

		$this->aColletionOffres = $aCollectionOffre;
	}

	public function ajoutCommentaire(Commentaire $oCommentaire)
	{
		TypeException::estObjet($oCommentaire);
		$this->aColletionCommentaires[] = $oCommentaire;
	}

	public function setCollectionCommentaire($aColletionCommentaire)
	{
		TypeException::estArray($aColletionCommentaire);

		foreach($aColletionCommentaire as $index=>$oCommentaire)
		{
			if(!get_class($oCommentaire)=='Commentaire')
			{
				unset($aColletionCommentaire[$index]);
			}
		}

		$this->aColletionCommentaires = $aColletionCommentaire;
	}

	public function setEtat($etat)
	{
		TypeException::estString($etat);
		$this->etat = $etat;
	}

	/**
	 *
	 */
	public function getIdEnchere()
	{
		return htmlentities($this->idEnchere);
	}

	public function getCreateurEnchere()
	{
		return $this->oCreateurEnchere;
	}

	public function getOeuvreEnchere()
	{
		return $this->oOeuvre;
	}

	public function getNomEnchere()
	{
		return htmlentities($this->nomEnchere);
	}

	public function getPrixDebut()
	{
		return htmlentities($this->prixDebut);
	}

    public function getPrixFin()
    {
        return htmlentities($this->prixFin);
    }

	public function getMontantAugment()
	{
		return htmlentities($this->montantAugment);
	}

	public function getPrixAcheterMaintenant()
	{
		return htmlentities($this->prixAcheterMaintenant);
	}

	public function getDateDebut()
	{
		return htmlentities($this->dateDebut);
	}

	public function getDateFin()
	{
		return htmlentities($this->dateFin);
	}

	public function getCollectionOffre()
	{
		return $this->aColletionOffres;
	}

	public function getEtat()
	{
		return $this->etat;
	}

	/**
	 * rechercher une enchere par id oeuvre
	 * @return int
	 */
	public static function rechercherIdEnchereParIdOeuvre($sIdOeuvre)
	{

//		$sCondition = 'WHERE oeuvre_id = ' . $sIdOeuvre . ' ORDER BY '. $sIdOeuvre .' DESC ;';
		$sCondition = 'WHERE oeuvre_id = ' . $sIdOeuvre . ';';
		$oXHFModele = new XFHModeles();
		$aEncheres = $oXHFModele->selectParCondition('pi2_encheres',$sCondition);
		if(count($aEncheres)>0)
		{
			return $aEncheres[0]['id'];
		}
		else
		{
			return 0;
		}
	}

	/**
	 * rechercher une enchere par id enchere
	 */
	public function chargerUneEnchereParIdEnchere()
	{

		$condition = 'WHERE id=' . $this->getIdEnchere() . ';';

		$aEncheres = $this->selectParCondition('pi2_encheres', $condition);

		if(count($aEncheres)>0)
		{
			$aEnchere = $aEncheres[0];
		}
		else
		{
			return false;
		}

		$oCreateur = new Utilisateur($aEnchere['utilisateur_id']);

		$oCreateur->rechercherUnUtilisateur();

		$oOeuvre = new Oeuvre($aEnchere['oeuvre_id']);
		$oOeuvre->rechercherOeuvreParId();

		$this->setCreateurEnchere($oCreateur);
		$this->setDateFin($aEnchere['dateFin']);
		$this->setDateDebut($aEnchere['dateDebut']);
		$this->setMontantAugment($aEnchere['prixIncrement']);
		$this->setNomEnchere($aEnchere['titre']);
		$this->setOeuvreEnchere($oOeuvre);
		$this->setPrixAcheterMaintenant($aEnchere['prixDirecte']);
		$this->setPrixDebut($aEnchere['prixDebut']);
		$this->setEtat($aEnchere['etat']);
		$this->setPrixFin($aEnchere['prixFin']);

		$aOffres = $this->selectParCondition('pi2_offres', 'WHERE enchere_id=' . $this->getIdEnchere() . ' ORDER BY date ASC');

		$this->setCollectionOffre(array());

		if(is_array($aOffres) && count($aOffres)>0)
		{
			foreach($aOffres as $offre)
			{
				$oOffre = new Offre($offre["id"]);

				$this->ajoutOffre($oOffre);
			}
		}

	}

	/**
	 * rechercher les encheres
	 * @return array
	 */
	public static function chargerLesEncheres()
	{
		$oModele = new Modeles();
		$aEncheres = $oModele->selectAllFrom("pi2_encheres");
		return $aEncheres;
	}

	/**
	 * creer une enchere
	 * @return $this
	 */
	public function creerUneEnchere()
	{

        if(trim($_POST['titreEnchere']) == '' || trim($_POST['prixDebut']) == '' || trim($_POST['prixAug']) == '' || trim($_POST['prixDirecte']) == '')
        {
            return false;
        }
        else
        {
            $sRequete = "INSERT INTO pi2_encheres (titre, prixDebut, prixFin, prixIncrement, prixDirecte, dateDebut, dateFin, etat, utilisateur_id, oeuvre_id)
		VALUES ('".$_POST['titreEnchere']."', ".$_POST['prixDebut'].", ".$_POST['prixDebut'].", ".$_POST['prixAug'].", ".$_POST['prixDirecte'].", now(), now()+INTERVAL ".$_POST['duree']." DAY, 'ouverte', ".$this->oCreateurEnchere->getIdUtilisateur().", ".$this->oOeuvre->getIdOeuvre().");";

            $id = $this->insertInto($sRequete);
            if($id)
            {
                $this->setIdEnchere($id);
                return true;
            }
        }

	}

    public function updateUneEnchere()
    {
        $sRequete = "UPDATE pi2_encheres SET prixFin=".$this->getPrixFin()." WHERE id=".$this->getIdEnchere().";";
        $bRes = $this->update($sRequete);
        if($bRes)
        {
            return true;
        }
        else
        {
            return "Impossible d'ajouter votre offre.";

        }
    }

	/**
	 * supprimer une enchere
	 */
	public function supprimerUnEnchere()
	{
		$sRequete = "DELETE FROM pi2_encheres WHERE id=".$this->getIdEnchere().";";
		$this->deleteFrom($sRequete);
	}

	/**
	 * charger le temps restant
	 * @return int
	 */
	public function getTempsRestant()
	{
		$iTempsFin = strtotime($this->getDateFin());

		$iTempsRestant = $iTempsFin - time();

		return $iTempsRestant;

	}

	public function fermerEnchere($annuler=false)
	{

		$sRequete = "UPDATE pi2_encheres SET etat='fermée' WHERE id=".$this->getIdEnchere().";";

		$this->update($sRequete);

        $this->setEtat("fermée");

        if($annuler==false)
        {
            if(count($this->getCollectionOffre())>0)
            {
                $sRequete = "UPDATE pi2_oeuvres SET etat='vendue' WHERE id=".$this->getOeuvreEnchere()->getIdOeuvre().";";

                $this->update($sRequete);

                $this->getOeuvreEnchere()->setEtatOeuvre('vendue');

                $sRequete = "INSERT INTO pi2_encheresgagnees (utilisateur_id, enchere_id, date) VALUES (".end($this->getCollectionOffre())->getBidder()->getIdUtilisateur().", ".$this->getIdEnchere().", now())";
                $idGagnee = $this->insertInto($sRequete);
            }
            else
            {
                $sRequete = "UPDATE pi2_oeuvres SET etat='disponible' WHERE id=".$this->getOeuvreEnchere()->getIdOeuvre().";";

                $this->update($sRequete);

                $this->getOeuvreEnchere()->setEtatOeuvre('disponible');
            }
        }
        elseif(annuler==true)
        {
            $sRequete = "UPDATE pi2_oeuvres SET etat='disponible' WHERE id=".$this->getOeuvreEnchere()->getIdOeuvre().";";

            $this->update($sRequete);

            $this->getOeuvreEnchere()->setEtatOeuvre('disponible');
        }

	}

    public function frozenEnchere()
    {
        $sRequete = "UPDATE pi2_encheres SET etat='gelée' WHERE id=".$this->getIdEnchere().";";
        $this->update($sRequete);
        $this->setEtat("gelée");
    }

    public function unfrozenEnchere()
    {
        $sRequete = "UPDATE pi2_encheres SET etat='ouverte' WHERE id=".$this->getIdEnchere().";";
        $this->update($sRequete);
        $this->setEtat("ouverte");
    }




}

?>