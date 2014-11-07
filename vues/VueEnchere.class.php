<?php
/**
 * Created by Xiang Feng Han
 * User: fenix
 * Date: 14-10-23
 * Time: 21:41
 */
class VueEnchere {

	public static function afficherLesEnchere($aEncheres)
	{
		Vue::head('Liste des enchères','Arts aux enchères', 'enchere.css');
		Vue::header();
		Vue::nav();

		if(count($aEncheres)>0)
		{
			$i = 0;
            echo "<div class='container'>";
			foreach($aEncheres as $oEnchere)
			{
				if($i==4)
				{
					echo "</div><div class='row'>";
					$i=0;
				}

				echo "<article class='col-md-3 apercuEnchere'>";
				echo "<div class='picBox'><a href='index.php?page=detailsEnchere&idEnchere=" . $oEnchere->getIdEnchere() . "'><img src='".$oEnchere->getOeuvreEnchere()->getUrlOeuvre()."' alt='Responsive image'></a></div>";
				echo "<div class='textBox'><a href='index.php?page=detailsEnchere&idEnchere=" . $oEnchere->getIdEnchere() . "'><h2>".$oEnchere->getOeuvreEnchere()->getNomOeuvre()."</h2></a>";
				echo "<span>Mise Actuele: ".$oEnchere->getPrixFin()." \$CAD</span><br />";
				echo "<span>Prix Directe: ".$oEnchere->getPrixAcheterMaintenant()." \$CAD</span><br />";
                echo "<a class='btn btn-default' href='index.php?page=detailsEnchere&idEnchere=" . $oEnchere->getIdEnchere() . "'>Detail</a>";
				echo "</div></article>";
				$i++;
			}
            echo "</div>";
		}
		else
		{
			echo "<div class='container'>";
			echo "<span class='label label-danger'>Il n'y ai aucune enchere disponible en ce monment.</span>";
			echo "</div>";
		}

		Vue::footer();
	}

	public static function afficherListeEncheres($aEncheres)
	{
		Vue::head('Liste des enchères','Arts aux enchères');
		Vue::header();
		Vue::nav();

		echo "<div class='container'>";
		echo "<h1>Gestion des enchères</h1>".
			 "<a class='btn-success btn' href='index.php?page=gestionEnchere&action=add'>Creer une enchere</a>";
		if(count($aEncheres)>0)
		{
			echo "<table class='tableListeEnchere'>";
            echo "<tr><td>Nom</td><td>Aperçu</td><td>Statut</td><td>Modifier</td><td>Supprimer</td><td>Date de fin</td></td></tr>";
			foreach($aEncheres as $index=>$oEnchere)
			{

				echo "<tr><td><a href='index.php?page=detailsEnchere&idEnchere=".$oEnchere->getIdEnchere()."'>".$oEnchere->getNomEnchere()."</a></td>".
					 "<td class='col-md-3'><a href='index.php?page=detailsEnchere&idEnchere=".$oEnchere->getIdEnchere()."'><img src='".$oEnchere->getOeuvreEnchere()->getUrlOeuvre()."' class='img-responsive' alt='Responsive image' class='col-md-2'></a></td>".
					 "<td>".$oEnchere->getEtat()."</td>";
                $etat = '';
                if($oEnchere->getEtat()=='ouverte' || $oEnchere->getEtat()=='gelée')
                {
                    $etat = 'disabled';
                    echo "<td><a href='index.php?page=gestionEnchere&action=mod&idEnchere=".$oEnchere->getIdEnchere()."'><button class='btn btn-warning' ".$etat.">Rouvrir</button></a></td>".
                        "<td><a href='index.php?page=gestionEnchere&action=sup&idEnchere=".$oEnchere->getIdEnchere()."'><button class='btn btn-danger' ".$etat.">Supprimer</button></a></td>".
                        "<td>".$oEnchere->getDateFin()."</td>".
                        "</tr>";
                }
                else
                {
                    $aOffres = $oEnchere->getCollectionOffre();
                    if(count($aOffres)>0)
                    {
                        $etat = 'disabled';
                        echo "<td><a href='index.php?page=gestionEnchere&action=mod&idEnchere=".$oEnchere->getIdEnchere()."'><button class='btn btn-warning' ".$etat.">Rouvrir</button></a></td>".
                            "<td><a href='index.php?page=gestionEnchere&action=sup&idEnchere=".$oEnchere->getIdEnchere()."'><button class='btn btn-danger' ".$etat.">Supprimer</button></a></td>".
                            "<td>".$oEnchere->getDateFin()."</td>".
                            "</tr>";
                    }
                    else
                    {
                        echo "<td><a href='index.php?page=gestionEnchere&action=mod&idEnchere=".$oEnchere->getIdEnchere()."'><button class='btn btn-warning' ".$etat.">Rouvrir</button></a></td>".
                            "<td><a href='index.php?page=gestionEnchere&action=sup&idEnchere=".$oEnchere->getIdEnchere()."'><button class='btn btn-danger' ".$etat.">Supprimer</button></a></td>".
                            "<td>".$oEnchere->getDateFin()."</td>".
                            "</tr>";
                    }

                }


			}
			echo "</table>";
            echo "<p>Si l'enchère est en cours, vous ne pourrez pas la supprimer, si l'enchère est terminée sans offres, vous pourrez la rouvrir.</p></div>";
		}
		else
		{
			echo "</div><div class='container'>";
			echo "<span class='label label-danger'>Vous avez aucune enchere disponible en ce monment. Veillez créer une enchère d'abord</span>";
			echo "</div>";
		}

		Vue::footer();
	}

	public static function afficherUneEnchere($oEnchere)
	{
		Vue::head("Detail d'une enchère","Arts aux enchères", "commentaire.css", "js/enchere.js");
		Vue::header();
		Vue::nav();

		echo "<div class=\"container\" id=\"containerUneEnchere\">
			<article class=\"col-md-5\">
			    <span class=\"titre\">".$oEnchere->getOeuvreEnchere()->getNomOeuvre()."</span>
				<img src=\"".$oEnchere->getOeuvreEnchere()->getUrlOeuvre()."\" class=\"img-responsive picEnchere\" alt=\"Responsive image\">
				<div class=\"briefDescription\"><h2>À propos de:</h2><p>".$oEnchere->getOeuvreEnchere()->getDescriptionOeuvre()."</p></div>
			 </article>";
		echo "
			<article class=\"col-md-7\">
				<form id=\"formDetailEnchere\"><input type=\"hidden\" id=\"idEnchere\" value=\"".$oEnchere->getIdEnchere()."\">
					<h1 class=\"titre\">".$oEnchere->getNomEnchere()."</h1>
					<div class=\"form-group\">
						<label>Vendeur: </label>
						<span>".$oEnchere->getCreateurEnchere()->getNom().", ".$oEnchere->getCreateurEnchere()->getPrenom()."</span>
					</div>
					<div class=\"form-group\">
						<label>Dimension: </label>
						<span>".$oEnchere->getOeuvreEnchere()->getDimensionOeuvre()."</span>
					</div>
					<div class=\"form-group\">
						<label>Temps restant: </label>
						<span class=\"tempRestant\">".$oEnchere->getTempsRestant()."</span>
					</div>
					<div class=\"form-group\">
						<label>Mise actuelle: </label>
						<span class=\"miseActuelle\" id=\"miseActuelle\"></span>
					</div>
					<div class=\"form-group\">
						<a href=\"index.php?page=listeOffre&idEnchere=".$oEnchere->getIdEnchere()."\">[Historique des offres]</a>
					</div>";
        if(isset($_SESSION['idUser']) && $_SESSION['idUser']!=$oEnchere->getCreateurEnchere()->getIdUtilisateur())
        {
            echo "<div class=\"form-group\">
						<input type=\"text\" name=\"prixFin\" id=\"prixFin\">
						<button id=\"btnOffre\" onclick=\"AjoutOffre(event)\" class=\"btn btn-primary\">Placer un offre</button><br />
						<span>(Entrer <span id=\"Prixconseil\"></span> \$CAD ou plus)</span>
					</div>
					<div class=\"form-group\">
						<span>Prix acheter maintenant: ".$oEnchere->getPrixAcheterMaintenant()." \$CAD</span>
					</div>
				</form>";


			/* PAYPAL */
            echo "
			<form action=\"https://www.sandbox.paypal.com/cgi-bin/webscr\" method=\"post\">
				<input type=\"hidden\" name=\"cmd\" value=\"_xclick\"><!-- Achat instantané -->
				<input type=\"hidden\" name=\"charset\" value=\"utf-8\">
				<input type=\"hidden\" name=\"return\" value=\"http://e1395672.webdev.cmaisonneuve.qc.ca/site/index.php?page=transaction&etat=accepte\"><!-- Url de retour -->
				<input type=\"hidden\" name=\"cancel_return\" value=\"http://e1395672.webdev.cmaisonneuve.qc.ca/site/index.php?page=transaction&etat=annule\">
				<input type=\"hidden\" name=\"notify_url\" value=\"http://e1395672.webdev.cmaisonneuve.qc.ca/site/paypal-ipn.php\"><!-- Url pour le traitement du IPN -->
				<input type=\"hidden\" name=\"business\" value=\"E7NW5SXHXN9JS\"><!-- Idntifiant/courriel du vendeur -->
				<input type=\"hidden\" name=\"item_name\" value=\"".$oEnchere->getOeuvreEnchere()->getNomOeuvre()."\">
				<input type=\"hidden\" name=\"item_number\" value=\"".$oEnchere->getOeuvreEnchere()->getIdOeuvre()."\">
				<input type=\"hidden\" name=\"amount\" value=\"".$oEnchere->getPrixAcheterMaintenant()."\">
				<input type=\"hidden\" name=\"shipping\" value=\"32.46\"><!-- Prix du transport.. provient de la bdd -->
				<input type=\"hidden\" name=\"currency_code\" value=\"CAD\"><!-- Devise du paiement -->
				<input type=\"hidden\" name=\"custom\" value=\"userId="; echo isset($_SESSION['UserId']) ? $_SESSION['UserId'] : 'Aucun'; echo " productId=".$oEnchere->getOeuvreEnchere()->getIdOeuvre()."\"><!-- Mes attributs personnalise -->
				<input type=\"hidden\" name=\"state\" value=\"QC\">
				<input type=\"hidden\" name=\"zip\" value=\"H1M2G6\">
				<input type=\"hidden\" name=\"country\" value=\"CA\">
				<input type=\"hidden\" name=\"lc\" value=\"CA\">
				<input type=\"image\" name=\"submit\" border=\"0\"
				src=\"https://www.paypalobjects.com/fr_FR/i/btn/x-click-but01.gif\"
				alt=\"PayPal - La manière sure et facile d'acheter en ligne\">
			</form>
		</article></div>";
        }
        elseif(!isset($_SESSION['idUser']))
        {
            echo "</form>";
            echo "<p class='text-warning'>Vous devez vous connecter pour faire les offres.</p>";
            echo "<div>
					<span>Prix acheter maintenant: ".$oEnchere->getPrixAcheterMaintenant()." \$CAD</span>
				  </div>

                <form action=\"https://www.sandbox.paypal.com/cgi-bin/webscr\" method=\"post\">
                    <input type=\"hidden\" name=\"cmd\" value=\"_xclick\"><!-- Achat instantané -->
                    <input type=\"hidden\" name=\"charset\" value=\"utf-8\">
                    <input type=\"hidden\" name=\"return\" value=\"http://e1395672.webdev.cmaisonneuve.qc.ca/site/index.php?page=transaction&etat=accepte\"><!-- Url de retour -->
                    <input type=\"hidden\" name=\"cancel_return\" value=\"http://e1395672.webdev.cmaisonneuve.qc.ca/site/index.php?page=transaction&etat=annule\">
                    <input type=\"hidden\" name=\"notify_url\" value=\"http://e1395672.webdev.cmaisonneuve.qc.ca/site/paypal-ipn.php\"><!-- Url pour le traitement du IPN -->
                    <input type=\"hidden\" name=\"business\" value=\"E7NW5SXHXN9JS\"><!-- Idntifiant/courriel du vendeur -->
                    <input type=\"hidden\" name=\"item_name\" value=\"".$oEnchere->getOeuvreEnchere()->getNomOeuvre()."\">
                    <input type=\"hidden\" name=\"item_number\" value=\"".$oEnchere->getOeuvreEnchere()->getIdOeuvre()."\">
                    <input type=\"hidden\" name=\"amount\" value=\"".$oEnchere->getPrixAcheterMaintenant()."\">
                    <input type=\"hidden\" name=\"shipping\" value=\"32.46\"><!-- Prix du transport.. provient de la bdd -->
                    <input type=\"hidden\" name=\"currency_code\" value=\"CAD\"><!-- Devise du paiement -->
                    <input type=\"hidden\" name=\"custom\" value=\"userId="; echo isset($_SESSION['UserId']) ? $_SESSION['UserId'] : 'Aucun'; echo " productId=".$oEnchere->getOeuvreEnchere()->getIdOeuvre()."\"><!-- Mes attributs personnalise -->
                    <input type=\"hidden\" name=\"state\" value=\"QC\">
                    <input type=\"hidden\" name=\"zip\" value=\"H1M2G6\">
                    <input type=\"hidden\" name=\"country\" value=\"CA\">
                    <input type=\"hidden\" name=\"lc\" value=\"CA\">
                    <input type=\"image\" name=\"submit\" border=\"0\"
                    src=\"https://www.paypalobjects.com/fr_FR/i/btn/x-click-but01.gif\"
                    alt=\"PayPal - La manière sure et facile d'acheter en ligne\">
                </form>";
            echo "</article></div>";
        }
        else
        {
            echo "<p class='text-warning'>Ceci est votre enchère, vous ne pouvez pas ajouter d'offre ou l'acheter.</p>";
            echo "</form></article></div>";
        }

	}

	public static function formCreerEnchere($aoOeuvres,$aMsg)
	{
		Vue::head("","","enchere.css","js/enchere.js");
		Vue::header();
		Vue::nav();

        echo "<script> var nomPic = new Array();";
        foreach($aoOeuvres as $oOeuvre)
        {
            echo "nomPic[".$oOeuvre->getIdOeuvre()."] = '".$oOeuvre->getUrlOeuvre()."';";
        }
        echo "</script>";
		echo "<div class='container' id='divCreerEnchere'><div class='titre'>Créer une enchère</div>";
        Vue::alerte($aMsg);
        echo "<div clas='row'>";
		echo "<article class='col-md-5' id='creerEncherePicBox'></article>";
		echo "<article class='col-md-7'>".
			 "<form action='index.php?page=gestionEnchere&action=add' method='post' class='form-horizontal'>".
				"<div class='form-group'>".
					"<label>Choisir un des votres oeuvres</label>".
						"<select name='oeuvre' id='optChoisi'>";
                        echo "<option value='0'>Choisir un oeuvre</option>";
							foreach($aoOeuvres as $oOeuvre)
							{
								echo "<option value='".$oOeuvre->getIdOeuvre()."'>".$oOeuvre->getNomOeuvre()."</option>";
							}
					echo "</select></div>".
					"<div class='form-group'><label>Titre de votre enchère</label>".
						"<input type='text' name='titreEnchere'></div>".
					"<div class='form-group prixEnchere'><label>Prix Enchère</label>".
						"<div><input type='text' name='prixDebut'><span>\$CAD | Montant debut</span></div>".
						"<div><input type='text' name='prixAug'><span>\$CAD | Montant incrementation</span></div></div>".
					"<div class='form-group prixEnchere'><label>Prix \"Acheter Maintenant\"</label>".
						"<div><input type='text' name='prixDirecte'> <span>\$CAD</span></div></div>".
					"<div class='form-group'><label>Duree</label>".
						"<select name='duree'>".
							"<option value='3'>3 jours</option>".
							"<option value='7'>7 jours</option>".
							"<option value='10'>10 jours</option>".
						"</select></div>".
					"<div class='form-group'><label>Les condition d'utilisation</label>".
						"<input type='checkbox' name='usageCondition'>J'accepte les conditions d'utilisation.</div>".
						"<input type='submit' name='enregistrerEnchere' value='Enregistrer' class='btn btn-default'>".
				"</form>".
				"</article></div></div>";

		Vue::footer();
	}

	public static function formModEnchere($oEnchere, $aMsg)
	{
		Vue::head("","","enchere.css");
		Vue::header();
		Vue::nav();

		echo "<div class='container' id='divCreerEnchere'><div class='titre'>Rouvrir une enchère</div>";
        Vue::alerte($aMsg);
        echo "<article class='col-md-5'>".
			"<img src='".$oEnchere->getOeuvreEnchere()->getUrlOeuvre()."'>".
			"</article>";

		echo "
		<article class=\"col-md-7\">
			<form action=\"index.php?page=gestionEnchere&action=mod&idEnchere=".$oEnchere->getIdEnchere(); echo "\" method=\"post\" class=\"form-horizontal\">
				<div class=\"form-group\">
					<label>Titre de votre enchère</label>
					<input type=\"text\" name=\"titreEnchere\" value=\"".$oEnchere->getNomEnchere(); echo "\">
				</div>
				<div class=\"form-group prixEnchere\">
					<label>Prix Enchère</label>
					<div><input type=\"text\" name=\"prixDebut\" value=\"".$oEnchere->getPrixDebut(); echo "\"> <span>\$CAD | Montant debut</span></div>
					<div><input type=\"text\" name=\"prixAug\" value=\"".$oEnchere->getMontantAugment(); echo "\"> <span>\$CAD | Montant incrementation</span></div>
				</div>
				<div class=\"form-group prixEnchere\">
					<label>Prix \"Acheter Maintenant\"</label>
					<div><input type=\"text\" name=\"prixDirecte\" value=\"".$oEnchere->getPrixAcheterMaintenant(); echo "\"> <span>\$CAD</span></div>
				</div>
				<div class=\"form-group\">
					<label>Duree</label>
					<select name=\"duree\">
						<option value=\"3\">3 jours</option>
						<option value=\"7\">7 jours</option>
						<option value=\"10\">10 jours</option>
					</select>
				</div>
				<div class=\"form-group\">
					<label>Les condition d'utilisation</label>
					<input type=\"checkbox\" name=\"usageCondition\">J'accepte les conditions d'utilisation.
				</div>
				<input type=\"submit\" name=\"enregistrerEnchere\" value=\"Rouvrir\" class='btn btn-success'>
				<a href=\"index.php?page=gestionEnchere\" class='btn btn-danger'>Retour</a>
			</form>
		</article></div>";

		Vue::footer();
	}

	public static function xmlAjaxDetailEnchere()
	{
		if(isset($_GET['idEnchere']))
		{
			$oEnchere = new Enchere($_GET['idEnchere']);

			if(strtotime($oEnchere->getDateFin())<=time())
			{
				$oEnchere->fermerEnchere();
			}

			header("Content-Type: application/xml; charset=utf-8");

			$xml = new DOMDocument("1.0", "utf-8");
			$root = $xml->createElement('detailsEnchere');

			$rootIdEnchere = $xml->createAttribute('id');
			$rootIdEnchere->value = $oEnchere->getIdEnchere();
			$root->appendChild($rootIdEnchere);

			$prixActuel = $xml->createElement('prixActuel', $oEnchere->getPrixFin());
			$root->appendChild($prixActuel);

			$prixIncremente = $xml->createElement('prixIncremente', $oEnchere->getPrixFin()+$oEnchere->getMontantAugment());
			$root->appendChild($prixIncremente);

			$statut = $xml->createElement('statut', $oEnchere->getEtat());
			$root->appendChild($statut);
			$xml->appendChild($root);

			echo $xml->saveXML();
		}
		else
		{
			exit();
		}
	}

	public static function xmlAjaxAjoutOffre()
	{
		if(isset($_GET['idEnchere']) && isset($_GET['montant']) && isset($_SESSION['idUser']))
		{
			$oEnchere = new Enchere($_GET['idEnchere']);
			$oUtilisateur = new Utilisateur($_SESSION['idUser']);
            $oUtilisateur->rechercherUnUtilisateur();
			$oOffre = new Offre(0, $oUtilisateur, $_GET['montant'], date('Y-m-d H:i:s'));
            $oOffre->creerUnOffre();
			$oEnchere->ajoutOffre($oOffre, true);


			VueEnchere::xmlAjaxDetailEnchere();
		}
		else
		{
			exit();
		}
	}

	public static function admAfficherListeEncheres($aEncheres)
	{
        Vue::head('Liste des enchères','Arts aux enchères');
        Vue::header();
        Vue::nav();

        echo "<div class='container'>";
        echo "<h1>Gestion des enchères</h1>".
            "<a class='btn-success btn' href='index.php?page=gestionEnchere&action=add'>Creer une enchere</a>";
        if(count($aEncheres)>0)
        {

            echo "<table class='tableListeEnchere'>";
            echo "<tr><td>Nom</td><td>Aperçu</td><td>Statut</td><td>Modifier</td><td>Supprimer</td><td>Date de fin</td></td></tr>";
            foreach($aEncheres as $index=>$oEnchere)
            {
                $etat = '';
                if($oEnchere->getEtat()=='fermée')
                {
                    $etat = 'disabled';
                }
                echo "<tr><td><a href='index.php?page=detailsEnchere&idEnchere=".$oEnchere->getIdEnchere()."'>".$oEnchere->getNomEnchere()."</a></td>".
                    "<td class='col-md-3'><a href='index.php?page=detailsEnchere&idEnchere=".$oEnchere->getIdEnchere()."'><img src='".$oEnchere->getOeuvreEnchere()->getUrlOeuvre()."' class='img-responsive' alt='Responsive image' class='col-md-2'></a></td>".
                    "<td>".$oEnchere->getEtat()."</td>".
                    "<td><a href='index.php?page=gestionEnchere&action=annuler&idEnchere=".$oEnchere->getIdEnchere()."'><button class='btn btn-warning' ".$etat.">Annuler</button></a></td>".
                    "<td><a href='index.php?page=gestionEnchere&action=sup&idEnchere=".$oEnchere->getIdEnchere()."'><button class='btn btn-danger'>Supprimer</button></a></td>".
                    "<td>".$oEnchere->getDateFin()."</td>".
                    "</tr>";

            }
            echo "</table>";
            echo "<p>Attention: supprimer ou annuler une enchère peut perdre tous historique des offres.</p></div>";
        }
        else
        {
            echo "</div><div class='container'>";
            echo "<span class='label label-danger'>Il n'y a aucune encheère disponible maintenant.</span>";
            echo "</div>";
        }

        Vue::footer();
    }


    public static function derniereEnchere($no) {

        $aEnregs = Enchere::chargerLesEncheres();

        shuffle($aEnregs);
        echo "
		<aside class=\"derniere-minute col-md-2\">
			<h1 class=\"text-center\">Enchères <br><span>plus récentes</span></h1 class=\"text-center\">
			<ul class=\"list-unstyled text-center\">";

        $aEncheres=array();

        foreach($aEnregs as $value)
        {
            $aEncheres[] = new Enchere($value['id']);
        }
        for($i=0; $i<4; $i++)
        {
            echo "<li><a href=\"?page=detailsEnchere&idEnchere=".$aEncheres[$i]->getIdEnchere()."\"><img class=\"img-responsive\" src=\"".$aEncheres[$i]->getOeuvreEnchere()->getUrlOeuvre()."\" height=\"288\" width=\"224\" alt=\"Oeuvre ".$i."\"></a></li>";
        }
        echo "</ul>
		</aside>";

    }

}