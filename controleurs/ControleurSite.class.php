<?php
/**
 * @class ControleurSite.class.php "controleurs/ControleurSite.class.php"
 * @version 0.0.1
 * @date 2014-10-17
 * @author Eric Revelle
 * @brief Controleur de la section des utilisateurs
 * @details Gère et controle la section des utilisateurs
 */
class ControleurSite extends Controleur{

	public function __construct(){

		$this->gererSite();

	}

	public function gererSite(){

		try{

			if ( !isset($_GET['page']) ) {

				$_GET['page'] = 'accueil';

			}

			switch ( $_GET['page'] ) {

				case 'accueil':
					$this->gererAccueil();
					break;

				case 'encheres':
					$this->gererLesEncheres();
					break;

				case 'detailsEnchere':
					$this->gererUneEnchere();

                    // Utilisateur
                    // Inclu les morceaux de pages, dont les metas, l'entete, la navigation .
                    $this -> gererCommentaire();
                    Vue::footer();
					break;

				case 'gestionEnchere':
					$this->gererEnchere();
					break;

				case 'listeOffre':
					$this->gererOffres();
					break;

				case 'statutEnchere':
					$this->gererAjaxStatutEnchere();
					break;

				case 'ajoutOffre':
					if( isset($_SESSION['idUser']) && $_SESSION['idUser'] !=0 )	{

						$this->gererAjaxAjoutOffre();
					}
					break;

				case 'utilisateur':
					$this->gererUtilisateur();
					break;

                case 'utilisateurAjax':
                    try{
                        $this->gererUtilisateurAjax();
                    }catch(Exception $e){
                        echo $e->getMessage();
                    }
                    break;

				case 'oeuvres-encheres':
					$this->gererOeuvres();
					break;

                case 'gestionOeuvres':
                    $this->gererMesOeuvres();
                    break;

                case 'contact' :
					$this -> gererContact();
					break;

				case 'commentaires' :
					// Administrateur
					$this -> gererAdminCommentairs_Contact();
					break;

				case 'transaction':
					$this->gererTransaction();
					break;

                case 'oeuvres-vendues':
                    $this->gererVente();
                    break;

                case 'reglements':
                    $this->gererReglements();
                    break;

				default:
					header("HTTP/1.0 404 Not Found");
					$this->gererErreurs();

			}

		} catch ( Exception $e ) {

			echo "<p class=\"alert alert-danger\">".$e->getMessage()."</p>";

		}

	}

	public function gererAccueil(){

		VueAccueil::afficherAccueil();

	}

	/**
	 * afficher les encheres
	 */
	public function gererLesEncheres()
	{
		$aEnregs = Enchere::chargerLesEncheres();
		$aEncheres = array();

		foreach($aEnregs as $value)
		{
			$aEncheres[] = new Enchere($value['id']);
		}

		VueEnchere::afficherLesEnchere($aEncheres);
	}

	/**
	 * afficher detail d'une enchere
	 */
	public function gererUneEnchere()
	{
		if(isset($_GET['idEnchere']))
		{
			$oEnchere = new Enchere($_GET['idEnchere']);
			$oEnchere->chargerUneEnchereParIdEnchere();
		}
		elseif(isset($_GET['idOeuvre']))
		{
			$idEnchere = Enchere::rechercherIdEnchereParIdOeuvre($_GET['idOeuvre']);

			$oEnchere = new Enchere($idEnchere);
			$oEnchere->chargerUneEnchereParIdEnchere();
		}
		VueEnchere::afficherUneEnchere($oEnchere);
	}

	/**
	 *
	 */
	public function gererEnchere()
	{
		if(isset($_SESSION) && $_SESSION['idUser']!=0)
		{

			if(!isset($_GET['action']))
			{
				$_GET['action'] = 'default';
			}
			switch($_GET['action'])
			{
				case 'add':
					$this->gererCreerUneEnchere();
					break;

				case 'mod':
					$this->gererModEnchere();
					break;

				case 'sup':
					$this->gererSupEnchere();
					break;

				case 'default':
					default:
					$this->gererListeEnchere();
					break;
			}

		}
		else
		{
			header("Location: index.php");
		}
	}

	public function gererCreerUneEnchere()
	{

		if(isset($_SESSION['idUser']))
		{
			$oCreateur = new Utilisateur($_SESSION['idUser']);

			$oCreateur->rechercherUnUtilisateur();
		}
		else
		{
			header("Location: index.php?page=utilisateur&action=connexion");
		}

		$oModeleXHFModele = new XFHModeles();

		$sCondition = "WHERE utilisateur_id=" . $_SESSION['idUser'] . " AND etat='disponible' ;";

		$aEnregs = $oModeleXHFModele->selectParCondition('pi2_oeuvres', $sCondition);

		$aOeuvres = array();
        $sMsg = "";
		if(count($aEnregs)>0)
		{
			foreach($aEnregs as $value)
			{
                $oOeuvre = new Oeuvre($value['id']);
                $oOeuvre->rechercherOeuvreParId();
				$aOeuvres[] = $oOeuvre;
			}
			if(!isset($_POST['enregistrerEnchere']))
			{
                $aMsg = array();
				VueEnchere::formCreerEnchere($aOeuvres,$aMsg);
			}
			else
			{
				$oOeuvre = new Oeuvre($_POST['oeuvre']);

                $oOeuvre->rechercherOeuvreParId();

				$oEnchere = new Enchere(0, $oCreateur, $oOeuvre);

				$oEnchere->creerUneEnchere();

                if($oEnchere->getIdEnchere()>0)
                {
                    $oOeuvre->setEtatOeuvre('en enchere');

                    $oModeleXHFModele = new XFHModeles();

                    $sRequete = "UPDATE pi2_oeuvres SET etat='".$oOeuvre->getEtatOeuvre()."' WHERE id=".$oOeuvre->getIdOeuvre().";";

                    $oModeleXHFModele->update($sRequete);

                    header("Location: index.php?page=detailsEnchere&idEnchere=" . $oEnchere->getIdEnchere());
                }
				else
                {
                    $aMsg = array("type"=>"warning","msg"=>"Erreur de créer une enchère!");
                    VueEnchere::formCreerEnchere($aOeuvres,$aMsg);
                }
			}
		}
		else
		{
			header("Location: index.php?page=gestionOeuvres&action=add");//if the user doesn't have any oeuvre, send to page 'add un oeuvre'
		}

	}

	public function gererModEnchere()
	{
		$oEnchere = new Enchere($_GET['idEnchere']);

        $aMsg = array();

		if(!isset($_POST['enregistrerEnchere']))
		{
			VueEnchere::formModEnchere($oEnchere, $aMsg);
		}
		else
		{

            $XHFModele = new XFHModeles();
            if(trim($_POST['titreEnchere']) == '' || trim($_POST['prixDebut']) == '' || trim($_POST['prixAug']) == '' || trim($_POST['prixDirecte']) == '')
            {
                $aMsg = array("type"=>"warning","msg"=>"Erreur de rouvrir une enchère!");
                VueEnchere::formModEnchere($oEnchere, $aMsg);
            }
            else
            {
                $sRequete = "INSERT INTO pi2_encheres (titre, prixDebut, prixFin, prixIncrement, prixDirecte, dateDebut, dateFin, etat, utilisateur_id, oeuvre_id)
		VALUES ('".$_POST['titreEnchere']."', ".$_POST['prixDebut'].", ".$_POST['prixDebut'].", ".$_POST['prixAug'].", ".$_POST['prixDirecte'].", now(), now()+INTERVAL ".$_POST['duree']." DAY, 'ouverte', ".$oEnchere->getCreateurEnchere()->getIdUtilisateur().", ".$oEnchere->getOeuvreEnchere()->getIdOeuvre().");";

                $id = $XHFModele->insertInto($sRequete);

                if($id)
                {
                    $oEnchere->supprimerUnEnchere();
                    $oEnchere = new Enchere($id);
                    $oEnchere->setIdEnchere($id);
                    $oEnchere->getOeuvreEnchere()->setEtatOeuvre('en enchere');
                    $sRequete = "UPDATE pi2_oeuvres SET etat='".$oEnchere->getOeuvreEnchere()->getEtatOeuvre()."' WHERE id=".$oEnchere->getOeuvreEnchere()->getIdOeuvre().";";
                    $XHFModele->update($sRequete);
                    header("Location: index.php?page=detailsEnchere&idEnchere=" . $oEnchere->getIdEnchere());
                }
            }

		}
	}

	public function gererAjaxStatutEnchere()
	{
		//$oEnchere = new Enchere($_GET['idEnchere']);

		VueEnchere::xmlAjaxDetailEnchere();
	}

	public function gererAjaxAjoutOffre()
	{
		//$oEnchere = new Enchere($_GET['idEnchere']);

		VueEnchere::xmlAjaxAjoutOffre();
	}

	public function gererSupEnchere()
	{
		$oEnchere = new Enchere($_GET['idEnchere']);
		$oEnchere->supprimerUnEnchere();
        header("Location: index.php?page=gestionEnchere");

	}

	public function gererListeEnchere()
	{
		$oModeleXHFModele = new XFHModeles();

		$sCondition='';

		if(isset($_SESSION['idUser']))
		{
			$sCondition = "WHERE utilisateur_id=" . $_SESSION['idUser'];
		}

		$aEnregs = $oModeleXHFModele->selectParCondition("pi2_encheres", $sCondition);

		$aEncheres=array();

		foreach($aEnregs as $value)
		{
			$aEncheres[] = new Enchere($value['id']);
		}

		VueEnchere::afficherListeEncheres($aEncheres);
//        VueEnchere::admAfficherListeEncheres($aEncheres);
	}

	public function gererOffres()
	{
		$aEnregs = Offre::chargerLesOffres();

        $sMsg = "";
        $aOffres = array();

        if(count($aEnregs)>0)
        {

            foreach($aEnregs as $value)
            {
                $aOffres[] = new Offre($value['id']);
            }
            VueOffre::afficherListeOffres($aOffres, $sMsg);
        }
        else
        {
            $sMsg = "No records";
            VueOffre::afficherListeOffres($aOffres, $sMsg);
        }

	}


    /***********************************************************************************************/


    public function gererUtilisateur(){
		switch ($_GET['action']){
			case 'inscription':
				$this->gererInscription();
				break;
			case 'connexion':
				$this->gererConnexion();
				break;
			case 'parametres':
				$this->gererParametres();
				break;
            case 'deconnecter':
                session_unset();
                session_destroy();
                header('location:index.php');
                break;
		}
	}


    public function gererInscription(){

        if(!isset($_POST['cmd'])){
            VueUtilisateur::afficherFormInscription();
        }
        else{
            try{
                if($_POST['courriel']===$_POST['confCourriel']){

                    if(Utilisateur::emailExiste($_POST['courriel'])){

                        VueUtilisateur::afficherFormInscription(array("type"=>"warning","msg"=>"Cette adresse courriel est déjà utilisée."));

                    }else{
                        $oUtilisateur = new Utilisateur(0, $_POST['nom'], $_POST['prenom'], $_POST['courriel'], $_POST['password']);
                        $oUtilisateur->ajouterUtilisateur();
                        header('location:index.php');

                    }
                }
                else{

                    throw new TypeException(TypeException::ERR_CONF_EMAIL);
                }
            }
            catch(Exception $e){

                VueUtilisateur::afficherFormInscription(array("type"=>"warning","msg"=>$e->getMessage()));

            }

        }

    }

    public function gererConnexion(){

        if(!isset($_POST['cmd'])){
            VueUtilisateur::afficherFormConnexion("");
        }else{
            try{
                $oUtilisateur = new Utilisateur();
                $oUtilisateur->setCourriel($_POST['courriel']);
                $oUtilisateur->setMotDePasse($_POST['password']);
                if($oUtilisateur->connexionUtilisateur()){
                    $_SESSION['idUser']= $oUtilisateur->getIdUtilisateur();
                    header('location:index.php');

                }
                else if($oUtilisateur->emailExiste($_POST['courriel'])==false){
                    VueUtilisateur::afficherFormConnexion(array("type"=>"warning","msg"=>"Aucun utilisateur avec ce courriel n'est inscrit"));
                }
                else{
                    VueUtilisateur::afficherFormConnexion(array("type"=>"warning","msg"=>"Mot de Passe erroné"));
                }
            }
            catch(Exception $e){
                VueUtilisateur::afficherFormConnexion(array("type"=>"warning","msg"=>$e->getMessage()));

            }
        }
    }

	public function gererParametres(){
		$oUtilisateur = new Utilisateur($_SESSION['idUser']);
		$oUtilisateur->rechercherUnUtilisateur();
//        var_dump($oUtilisateur);

		if(!isset($_POST['cmd'])){
			VueUtilisateur::afficherFormModSup($oUtilisateur, "");
		}
		else if($_POST['cmd']=='modifier'){
			try{
				$oUtilisateur= new Utilisateur($_SESSION['idUser'], $_POST['nom'], $_POST['prenom'], $_POST['courriel'], $_POST['password']);
				$oUtilisateur->modifierUtilisateur();
				VueUtilisateur::afficherFormModSup($oUtilisateur, 'la modification s\'est bien déroulé');

			}
			catch(Exception $e){
				//var_dump($e);
				VueUtilisateur::afficherFormModSup($oUtilisateur, $e->getMessage());

			}
		}
		else if($_POST['cmd']=='supprimer'){
			$oUtilisateur->desactiverUtilisateur();
			header('location:index.php');
		}
	}

    public  function gererUtilisateurAjax(){

        switch($_POST['action']) {

            case 'connexion':
                $this->gererConnexionAjax();
                break;

            case 'inscription':
                $this->gererInscriptionAjax();
                break;

            default:

                break;
        }
    }

    public function gererConnexionAjax(){
        try{
            $oUtilisateur = new Utilisateur();
            $oUtilisateur->setCourriel($_POST['courriel']);
            $oUtilisateur->setMotDePasse($_POST['password']);
            if($oUtilisateur->connexionUtilisateur()){
                $_SESSION['idUser']= $oUtilisateur->getIdUtilisateur();

            }
            else if($oUtilisateur->emailExiste($_POST['courriel'])==false){
                echo "Aucun utilisateur avec ce courriel n'est inscrit";
            }
            else{
                echo "Mot de Passe erroné";
            }
        }
        catch(Exception $e){
            echo $e->getMessage();

        }
    }

    public function gererInscriptionAjax(){
        try{
            if($_POST['courriel']===$_POST['confCourriel']){
                if(Utilisateur::emailExiste($_POST['courriel'])){
                    echo "Cette adresse courriel est déjà une utilisation";

                }else{
                    try{
                        $oUtilisateur = new Utilisateur(0, $_POST['nom'], $_POST['prenom'], $_POST['courriel'], $_POST['password']);

                        $oUtilisateur->ajouterUtilisateur();
                        $_SESSION['idUser']= $oUtilisateur->getIdUtilisateur();

                    }
                    catch(Exception $e){
                        echo $e->getMessage();
                    }

                }
            }
            else{
                throw new TypeException(TypeException::ERR_CONF_EMAIL);
            }
        }
        catch(Exception $e){
            echo $e->getMessage();

        }

    }

    /*=============================================================================================*/
    public function gererOeuvres()
    {
        try{
            $aThemes = Theme::rechercherThemes();					
			$aTechniques=Technique::rechercherTechniques();
			
			if(isset($_POST['cmd'])==false && isset($_POST['rech'])==false)
            {
                $aOeuvres=Oeuvre::rechercherListeDesOeuvresEnVente();
                VueOeuvre::afficherLesOeuvres($aOeuvres,$aThemes, $aTechniques);
            }else if(isset($_POST['cmd'])){
                //Récupérer le texte saisi par l'internaute $_POST['txt']
                $recherche=$_POST['txt'];

                $aOeuvres =Oeuvre::rechercherDesOeuvresParMotCle($recherche);
                $aMsg = array("type" =>"warning","msg"=>"Aucun produit ne correspond à votre recherche");

                if($aOeuvres  == true)
                {
                    //afficher les oeuvres correspondant au mot clé
                   VueOeuvre::afficherLesOeuvres($aOeuvres,$aThemes, $aTechniques);
                }else
                {
                   VueOeuvre::afficherLesOeuvres($aOeuvres,$aThemes, $aTechniques,$aMsg);
                }

            } else if(isset($_POST['rech']))
            {
                //effectue la recherche si l'internaute a selectionné à la fois: theme ET technique
                if (isset($_POST['theme'])==true && isset($_POST['technique'])==true)
                {
                    //Récupère le theme choisi par l'utilisateur
                    $Theme= $_POST['theme'];
                    //echo $Theme;
                    //Instancier un objet Theme avec le numéro de theme choisi par l'internaute $Theme
                    $oTheme = new Theme($Theme);
                    //Recherche le nom du theme associé à ce numéro
                    $bRechercherTheme=$oTheme->rechercherNomThemeParSonId();
                    //Récupère le résultat
                    $nomTheme= $oTheme->getNomTheme();

                    //Récupère la technique choisie par l'utilisateur
                    $Technique= $_POST['technique'];
                    //echo $Technique;
                    //Instancier un objet Technique avec le numéro de technique saisi par l'internaute $Technique
                    $oTechnique = new Technique($Technique);
                    //Recherche le nom de la technique associé à ce numéro
                    $bRechercherTechnique=$oTechnique->rechercherNomTechniqueParSonId();
                    //Récupère le résultat
                    $nomTechnique= $oTechnique->getNomTechnique();

                    if($bRechercherTheme == true && $bRechercherTechnique == true)
                    {
                        //Instancier un objet Oeuvre
                        $oOeuvre = new Oeuvre();
                        //Recherche les oeuvres correspondant aux noms du theme ET de la technique choisis par l'internaute
                        $aOeuvres=$oOeuvre->rechercherParThemeTechnique($nomTheme,$nomTechnique);
                        $aMsg = array("type" =>"warning","msg"=>"Aucun produit ne correspond à votre recherche");
                        if($aOeuvres==true)
                        {
                           VueOeuvre::afficherLesOeuvres($aOeuvres,$aThemes, $aTechniques);
                        } else
                        {
                            VueOeuvre::afficherLesOeuvres($aOeuvres,$aThemes, $aTechniques,$aMsg);
                        }
                    } else

                    {
                        VueOeuvre::afficherLesOeuvres($oOeuvre,$aThemes, $aTechniques, array('type'=>'warning','msg'=>'Aucune oeuvre de disponible.'));
                    }

                } else  //effectue la recherche si l'internaute a selectionné une des categories: theme OU technique

                {   //si seulement theme est choisi
                    $critere=' ';
                    $categorie=' ';

                    if (isset($_POST['theme']))
                    {
                        //Récupérer la valeur du theme choisi par l'utilisateur(classique,moderne....)
                        $Theme= $_POST['theme'];
                        //donne une categorie à la valeur récupérée
                        $categorie='theme';

                        //Instancier un objet Theme avec le numéro de theme saisi par l'internaute $Theme
                        $oTheme = new Theme($Theme);
                        //Recherche le nom du theme associé à ce numéro
                        $bRechercherTheme=$oTheme->rechercherNomThemeParSonId();
                        //Récupère le résultat
                        $nomTheme= $oTheme->getNomTheme();

                        if($bRechercherTheme == true)
                        {
                            //affecte la valeur du theme dans une variable critère
                            $critere=$nomTheme;

                        }

                    }   else    //si seulement technique est choisie

                    {
                        //Récupérer la valeur de la technique choisie par l'utilisateur(acrylique,peinture a l'huile....)
                        $Technique= $_POST['technique'];
                        //donne une categorie à la valeur récupérée
                        $categorie='technique'  ;

                        //Instancier un objet Technique avec le numéro de technique saisi par l'internaute $Technique
                        $oTechnique = new Technique($Technique);
                        //Recherche le nom de la technique associé à ce numéro
                        $bRechercherTechnique=$oTechnique->rechercherNomTechniqueParSonId();
                        //Récupère le résultat
                        $nomTechnique= $oTechnique->getNomTechnique();
                        if($bRechercherTechnique == true)
                        {
                            //affecte la valeur de la technique dans une variable critère
                            $critere=$nomTechnique;
                        }
                    }

                    //Récupération des oeuvres correspondants au theme OU à la technique
                    //Instancier un objet Oeuvre
                    $oOeuvre=new Oeuvre();
                    //Recherche les enregistrements en fonction du:
                    //critère récupéré:$nomTheme ou $nomTechnique
                    //et de la categorie (type) à qui il appartient:Theme ou Technique
                    $aOeuvres=$oOeuvre->rechercherParCritere($critere,$categorie);
                    $aMsg = array("type" =>"warning","msg"=>"Aucun produit ne correspond à votre recherche");
                    if($aOeuvres==true)
                    {
                        VueOeuvre::afficherLesOeuvres($aOeuvres,$aThemes,$aTechniques);
                    }
                    else
                    {
                        VueOeuvre::afficherLesOeuvres($aOeuvres,$aThemes, $aTechniques,$aMsg);
                    }
                }
            }

        }catch(Exception $e){
            echo "<p>".$e->getMessage()."</p>";
        }
    }


    public function gererMesOeuvres()
    {
        if(isset($_SESSION) && $_SESSION['idUser']!=0)
        {
            if(!isset($_GET['action']))
            {
                $_GET['action'] = 'default';
            }

            switch($_GET['action'])
            {
                case "add":
                    ControleurSite::gererAjouterOeuvre();
                    break;
                case "mod":
                    ControleurSite::gererModifierOeuvre();
                    break;
                case "sup":
                    //	ControleurSite::gererSupprimerOeuvre();

                case 'default':
                default:
                    $this->gererListeDesOeuvres();
                    break;
            }
        }
        else
        {
            header("Location: index.php");
        }
    }
    /*=============================================================================================*/
    public static function ajax_gererMesOeuvres(){
        try{
            //1èr cas : aucune action n'a été sélectionné $_GET['action'] n'a pas affecté d'une valeur

            if(isset($_POST['action']) == FALSE){
                $_POST['action']="sup";
            }

            //2e cas :L'administrateur a sélectionné une action,
            //il existe 3 possibilités add, mod, sup ou la liste des étudiants
            switch($_POST['action']){
                case "add":
                    ControleurSite::ajax_gererAjouterOeuvre();
                    break;
                case "mod":
                    ControleurSite::ajax_gererModifierOeuvre();
                    break;
                case "sup":
                    ControleurSite::gererSupprimerOeuvre();
                    break;

            }//fin du switch() sur $_GET['action']
        }catch(Exception $e){
            echo "<p>".$e->getMessage()."</p>";
        }
    }//fin de la fonction gererOeuvre()

    /*=============================================================================================*/

    public function gererListeDesOeuvres(){

        try{
            if(isset($_SESSION['idUser']))
            {
                $oCreateur = new Utilisateur($_SESSION['idUser']);

                $bRechercherCreateur = $oCreateur->rechercherUnUtilisateur();
                $noCreateur= $oCreateur->getIdUtilisateur();
                //echo $noCreateur;
            }
            else
            {
                header("Location: index.php?page=utilisateur&action=connexion");
            }

            if(isset($_GET['bSup']) == true){
                $aMsg = array("type" =>"warning","msg"=>"La suppression s'est bien déroulée");
            }

            $aOeuvres = Oeuvre::rechercherListeDesOeuvres($noCreateur);

            $aMsg = array("type" =>"warning","msg"=>"Aucun produit ne correspond à votre recherche");
            //Afficher la liste de tous les produits
            if(count($aOeuvres)>0)
            {
                VueOeuvre::user_afficherListeOeuvres($aOeuvres);
            }
            else
            {
                //VueOeuvre::afficherLesOeuvres($aOeuvres=array(),$aMsg);
                VueOeuvre::user_afficherListeOeuvres($aOeuvres);

            }
        }catch(Exception $e){
            echo "<p>".$e->getMessage()."</p>";
        }
    }

    /*=============================================================================================*/
    /**
     * afficher le formulaire de modification et sur submit modifier oeuvre dans la base de données
     */
    public static function gererModifierOeuvre(){

        try{
            if(isset($_SESSION['idUser']))
            {
                $oCreateur = new Utilisateur($_SESSION['idUser']);

                $bRechercherCreateur = $oCreateur->rechercherUnUtilisateur();
                $noCreateur= $oCreateur->getIdUtilisateur();
                $nomCreateur=$oCreateur->getNom();
                //echo $noCreateur;
                //echo $nomCreateur;
            }
            else
            {
                header("Location: index.php?page=utilisateur&action=connexion");
            }

            $oOeuvre = new Oeuvre($_GET['idOeuvre']);
            $oOeuvre->rechercherOeuvreParId();

            $aThemes = Theme::rechercherThemes();									
			$aTechniques=Technique::rechercherTechniques();

            VueOeuvre::user_afficherModifierOeuvre($oOeuvre,$aMsg=array("titre"=>"Modifier"),$aThemes,$aTechniques,array("s"=>1), "fic");

        }catch(Exception $e){
            $oOeuvre = new Oeuvre($_GET['idOeuvre']);
            $oOeuvre->rechercherOeuvreParId();

            $aThemes = Theme::rechercherThemes();									
			$aTechniques=Technique::rechercherTechniques();

            VueOeuvre::user_afficherModifierOeuvre($oOeuvre,$aMsg=array("titre"=>"Modifier"),$aThemes,$aTechniques,array("s"=>1), "fic", $e->getMessage());
        }


    }

    /*=============================================================================*/
    public static function ajax_gererModifierOeuvre(){

        //2e cas : le bouton submit Modifier a été cliqué
        try{

            if(isset($_SESSION['idUser']))
            {
                $oCreateur = new Utilisateur($_SESSION['idUser']);
                $bRechercherCreateur = $oCreateur->rechercherUnUtilisateur();
                $noCreateur= $oCreateur->getIdUtilisateur();
                $nomCreateur=$oCreateur->getNom();
                //echo $noCreateur;
                //echo $nomCreateur;
            }
            else
            {
                header("Location: index.php?page=utilisateur&action=connexion");
            }

            $oOeuvre = new Oeuvre($_POST['idOeuvre'], $_POST['txtNom'], $_POST['txtMedia'],$_POST['txtDescription'],
                $_POST['txtDimension'],$_POST['txtPoids'],"disponible",$_POST['txtTheme'],$_POST['txtTechnique']);

            //modifier dans la base de données l'étudiant
            $oOeuvre->modifierUneOeuvre();

            $aMsg = array("type" =>"warning","msg"=>"La modification de l'oeuvre - ".$oOeuvre->getNomOeuvre()." - s'est déroulée avec succès.");
            $aOeuvres = Oeuvre::rechercherListeDesOeuvres($noCreateur);

            //header("Location:../site/index.php?page=gestionOeuvres");
            //VueOeuvre::user_afficherListeOeuvres($aOeuvres,$aMsg);
        }catch(Exception $e){
            echo $e->getMessage();
        }

    }//fin de la fonction gererModifierOeuvre()

    /*=============================================================================================*/
    /**
     * afficher le formulaire d'ajout et sur submit ajouter oeuvre dans la base de données
     */
    public static function gererAjouterOeuvre(){

        try{

            if(isset($_SESSION['idUser']))
            {
                $oCreateur = new Utilisateur($_SESSION['idUser']);

                $bRechercherCreateur = $oCreateur->rechercherUnUtilisateur();
                $noCreateur= $oCreateur->getIdUtilisateur();
                //echo $noCreateur;
                $nomCreateur=$oCreateur->getNom();
            }
            else
            {
                header("Location: index.php?page=utilisateur&action=connexion");
            }

            $aThemes = Theme::rechercherThemes();									
			$aTechniques=Technique::rechercherTechniques();

            //afficher le formulaire
            VueOeuvre::user_afficherAjouterOeuvre($aMsg=array(),$aThemes,$aTechniques,array("s"=>1), "fic");

        }catch(Exception $e){
            //afficher le formulaire
            VueOeuvre::user_afficherAjouterOeuvre($aMsg=array(),$aThemes,$aTechniques,array("s"=>1),"fic",$e->getMessage());
        }
    }//fin de la fonction gererAjouterOeuvre()

    /*=============================================================================================*/
    /**
     * afficher le formulaire d'ajout et sur submit ajouter l'étudiant dans la base de données
     */
    public static function ajax_gererAjouterOeuvre(){

        try{

            if(isset($_SESSION['idUser']))
            {
                $oCreateur = new Utilisateur($_SESSION['idUser']);

                $bRechercherCreateur = $oCreateur->rechercherUnUtilisateur();
                $noCreateur= $oCreateur->getIdUtilisateur();
                $nomCreateur=$oCreateur->getNom();
            }
            else
            {
                header("Location: index.php?page=utilisateur&action=connexion");
            }

            $aThemes = Theme::rechercherThemes();									
			$aTechniques=Technique::rechercherTechniques();

            $oOeuvre = new Oeuvre($_POST['idOeuvre'], $_POST['txtNom'], $_POST['txtMedia'], $_POST['txtDescription'],
                $_POST['txtDimension'],$_POST['txtPoids'],"disponible",$_POST['txtTheme'],$_POST['txtTechnique'],$nomCreateur);

            $oOeuvre->ajouterOeuvre($noCreateur);

            $aMsg = array("type" =>"warning","msg"=>"L'ajout de l'oeuvre - ".$oOeuvre->getNomOeuvre()." - s'est déroulée avec succès.");
            $aOeuvres = Oeuvre::rechercherListeDesOeuvres($noCreateur);
            //header("Location:../../site/index.php?page=gestionOeuvres");
        }catch(Exception $e){
            echo $e->getMessage();
        }
    }//fin de la fonction gererAjouterEtudiant()

    /*=============================================================================================*/

    /**
     * Supprimer l'oeuvre de la base de données
     * Ne gère pas les refresh -> 15 refresh = 15 delete
     */
    public static function gererSupprimerOeuvre(){

        try{
            /*if(isset($_SESSION['idUser']))
                {
                    $oCreateur = new Utilisateur($_SESSION['idUser']);

                    $bRechercherCreateur = $oCreateur->rechercherUnUtilisateur();
                    $noCreateur= $oCreateur->getIdUtilisateur();
                    //echo $noCreateur;
                    $nomCreateur=$oCreateur->getNom();
                }
                else
                {
                    header("Location: index.php?page=utilisateur&action=connexion");
                }	*/

            $oOeuvre = new Oeuvre($_GET['idOeuvre']);
            $oOeuvre->rechercherOeuvreParId();
            //supprimer dans la base de données l'oeuvre
            $bDelete =$oOeuvre->supprimerOeuvre();
            $aMsg = array("type" =>"warning","msg"=> "La suppression de l'oeuvre - ".$oOeuvre->getNomOeuvre()." - s'est déroulée avec succès.");
            //Rediriger
            header("Location:../../site/index.php?page=".$_GET['page']."&bSup=".$bDelete);
        }catch(Exception $e){
            return $e->getMessage();
        }
    }//fin de la fonction gererSupprimerOeuvre()


    /****************************************************************************************/

	public function gererContact() {

		try{
			//1èr cas : aucune action n'a été sélectionné $_GET['action'] n'a pas affecté d'une valeur
			if(isset($_GET['action']) == FALSE){
				$_GET['action']="form";
			}

			//2e cas :L'utilisateur a sélectionné une action: envoyer un message,
			switch($_GET['action']){
				case "ajouContact":
					ControleurSite::gererAjouterContact();
					break;
				case "form": default:
					VueContact::afficherContact();
			}//fin du switch() sur $_GET['action']
		}catch(Exception $e){
			echo "<p>".$e->getMessage()."</p>";
		}

	}//Fin gererContact()

	/**
	 * afficher le formulaire d'ajout et sur submit ajouter le contac dans la base de données
	 */
	public static function gererAjouterContact(){
		try{
			//1èr cas : aucun submit n'a été cliqué
			if(isset($_POST['cmd']) == false){
				//afficher le formulaire
				VueContact::afficherContact();
			//2e cas : le bouton submit Modifier a été cliqué
			}else{

				$oContact = new Contact(0,$_POST['txtNom'], $_POST['txtPrenom'], $_POST['txtEmail'], $_POST['textarea']);
				//modifier dans la base de données l'étudiant
				$oContact->ajouterUnContact();
				//echo "L'envoie de votre message s'est déroulé avec succès.";
				VueContact::afficherContact(array('type'=>'success','msg'=>'Le contact a bien été créer.'));
			}
		}catch(Exception $e){
			echo "<p>".$e->getMessage()."</p>";
		}

	}//fin de la fonction gererAjouterContact()

    public function gererCommentaire() {
        try {
            //1èr cas : aucune action n'a été sélectionné $_GET['action'] n'a pas affecté d'une valeur
            if (isset($_GET['action']) == FALSE) {
                $_GET['action'] = "lst";
            }

            //2e cas :L'utilisateur a sélectionné une action,
            //il existe 3 possibilités add, mod, sup ou la liste des Commentaires
            switch($_GET['action']) {
                case "ajouCommentaire" :
                    ControleurSite::gererAjouterCommentaire();
                    break;
                case "Signaler un abus" :
                    ControleurSite::gererSignalerAbus();
                    break;
                case "Supprimer" :
                    ControleurSite::gererSupprimerCommentaire();
                    //affiche les commentaires
                    ControleurSite::gererlistCommentaire();
                    break;
                case "instruction_commentaire" :
                    ControleurSite::gererInstruction_commentaire();
                    break;
                case "PublierUnCommentaire" :
                    ControleurSite::gererPublierUnCommentaire();
                    break;
                case "lst" :
                default :
                    ControleurSite::gererlistCommentaire();
            }//fin du switch() sur $_GET['action']
        } catch(Exception $e) {
            echo "<p>" . $e -> getMessage() . "</p>";
        }

    }//Fin gereCommentaire()

    /**
     * afficher le formulaire d'ajout d'un Commentaire dans la base de données
     */
    public static function gererAjouterCommentaire() {
        try {
            //1èr cas : aucun submit n'a été cliqué
//            if (isset($_POST['cmd']) == false) {
//                $IdEnchere = Enchere::rechercherIdEnchereParIdOeuvre($_GET['idOeuvre']);
//                //afficher le formulaire
//                VueCommentaire::afficherListeCommentaires($aCommentaires,$IdConnecte,$IdEnchere);
//                //2e cas : le bouton submit Publier a été cliqué
//            }

                $IdConnecte = $_SESSION['idUser'];
//                $IdEnchere = Enchere::rechercherIdEnchereParIdOeuvre($_GET['idOeuvre']);
                $IdEnchere = $_GET['idEnchere'];

                $oCommentaire = new Commentaire(0, $_POST['txtCommentaire'], 'ncgn', 'nvbn', $IdConnecte, $IdEnchere);
                //modifier dans la base de données l'étudiant
                $oCommentaire -> ajouterUnCommentaire();
                ControleurSite::gererlistCommentaire();

        } catch(Exception $e) {
            echo "
		<p>
		" . $e -> getMessage() . "
		</p>";
        }
    }//fin de la fonction gererAjouterCommentaire()

    // ----------------------------------------------------------------------------
    /**
     * fonction qui ajoute un signal d'abus sur un commentaire
     */
    public static function gererSignalerAbus() {

        try {
            $oCmmentaire = new Commentaire($_GET['IdCommentaire']);
            $oCmmentaire -> rechercherUnCommentaire();
            //ajouter Abus pour un commentaire dans la base de données
            $oCmmentaire -> SignalerAbus();
            ControleurSite::gererlistCommentaire();
        } catch(Exception $e) {
            echo "
	<p>
	" . $e -> getMessage() . "
	</p>";
        }
    }//fin de la fonction gererSignalerAbus()



    /**
     * afficher la liste des Commentaires qui vont pouvoir être modifier: supprimer et ajouter un Abus
     */
    public static function gererlistCommentaire() {
        try {
            if(isset($_SESSION['idUser']))
            {
                $IdConnecte= $_SESSION['idUser'];
            }

            if(isset($_GET['idOeuvre']))
            {
                $idEnchere = Enchere::rechercherIdEnchereParIdOeuvre($_GET['idOeuvre']);
            }
            elseif(isset($_GET['idEnchere']))
            {
                $idEnchere = $_GET['idEnchere'];
            }

            $oComment = new Commentaire();
            $aCommentaires = $oComment -> recherListeCommentairesParIdEnchere($idEnchere);
            $oVueCommentaire = new VueCommentaire();
            if(!isset($_SESSION['idUser']))
            {
                $oVueCommentaire->afficherListeCommentairesPublique($aCommentaires,$idEnchere);
            }
            else
            {
                //afficher les commentaires
                $oVueCommentaire -> afficherListeCommentaires($aCommentaires, $IdConnecte ,$idEnchere);
            }
        } catch(Exception $e) {
            echo "<p>" . $e -> getMessage() . "</p>";
        }
    }//fin de la fonction gererListeDesProduit()

	public function gererAdminCommentaires_Contact(){

		try{
			//1èr cas : aucune action n'a été sélectionné $_GET['action'] n'a pas affecté d'une valeur
			if(isset($_GET['action']) == FALSE){
				$_GET['action']="lst";
			}

			//2e cas :L'utilisateur a sélectionné une action,
			//il existe 2 possibilités supprimer un Commentaire, supprimer un contact
			switch($_GET['action']){
				case "supCommentair":
					ControleurSite::gererSupprimerCommentaire();
					break;
				case "supContact":
					ControleurSite::gererSupprimerContact();
					break;
				case "lst": default:
					ControleurSite::gererlistCommentairs_Contact();
			}//fin du switch() sur $_GET['action']
		}catch(Exception $e){
			echo "<p>".$e->getMessage()."</p>";
		}

	}//Fin gererAdmiCommentairs_Contact()

    /**
     * afficher la liste des Commentaires et des contacts pour l'administrateur
     */
    public static function gererlistCommentairs_Contact() {
        try {

            $oComment = new Commentaire();
            $aCommentaires = $oComment -> adm_rechercherListeDesCommentaires();
            // var_export($aCommentaires);exit;
            $oContact = new Contact();
            $aContacts = $oContact -> rechercherListeDesContacts();
            // var_export($aContacts);exit;
            $oVueCommentaire_Contact = new VueCommentaire_Contact();
            //afficher les commentaires et les contacts
            $oVueCommentaire_Contact -> admi_afficherCommentaire_contact($aCommentaires, $aContacts);
        } catch(Exception $e) {
            echo "<p>" . $e -> getMessage() . "</p>";
        }
    }//fin de la fonction gererlistCommentairs_Contact()

    /**
     * Supprimer un Contact de la base de données
     *
     * @return string message
     */
    public static function gererSupprimerContact() {

        try {
            $oContact = new Contact($_GET['idContact']);
            $oContact -> rechercherUnContact();
            //supprimer dans la base de données un Contact
            // var_export($oContact);exit;
            $oContact -> supprimerUncontact();

            $aContacts = $oContact -> rechercherListeDesContacts();
            $oComment = new Commentaire();
            $aCommentaires = $oComment -> adm_rechercherListeDesCommentaires();
            $oVueCommentaire_Contact = new VueCommentaire_Contact();
            //afficher les commentaires et les contacts
            header("Location:index.php?page=".$_GET['page']);
            $oVueCommentaire_Contact -> admi_afficherCommentaire_contact($aCommentaires, $aContacts);

        } catch(Exception $e) {
            return $e -> getMessage();
        }
    }//fin de la gererSupprimerContact()

    /**
     * Supprimer un Commentaire de la base de données
     *
     * @return string message
     */
    public static function gererSupprimerCommentaire() {

        try {

            $oCommentaire = new Commentaire($_GET['IdCommentaire']);
            $oCommentaire -> rechercherUnCommentaire();
            //supprimer dans la base de données un Commentaire
            $oCommentaire -> supprimerUnCommentaire();
        } catch(Exception $e) {
            return $e -> getMessage();
        }
    }//fin de la gererSupprimerCommentaire()

    /**
     * Fonction qui afficher la page Consignes sur les commentaires
     */
    public static function gererInstruction_commentaire() {

        try {
            $oVueCommentaire = new VueCommentaire();
            //afficher la page  Consignes sur les commentaires
            $oVueCommentaire -> afficherInstruction_commentaire();
        } catch(Exception $e) {
            echo "
	<p>
	" . $e -> getMessage() . "
	</p>";
        }
    }//fin de la fonction gererInstruction_commentaire()


    /**
     * Fonction qui afficher la page Consignes sur les commentaires
     */
    public static function gererPublierUnCommentaire() {

        try {
            $oVueCommentaire = new VueCommentaire();
            //afficher la page  Consignes sur les commentaires
            $oVueCommentaire -> PublierUnCommentaire ();
        } catch(Exception $e) {
            echo "
	<p>
	" . $e -> getMessage() . "
	</p>";
        }
    }//fin de la fonction gererPublierUnCommentaire()


    public function gererAdminCommentairs_Contact() {

        try {
            //1èr cas : aucune action n'a été sélectionné $_GET['action'] n'a pas affecté d'une valeur
            if (isset($_GET['action']) == FALSE) {
                $_GET['action'] = "lst";
            }

            //2e cas :L'utilisateur a sélectionné une action,
            //il existe 2 possibilités supprimer un Commentaire, supprimer un contact
            switch($_GET['action']) {
                case "supCommentair" :
                    ControleurSite::gererSupprimerCommentaire();
                    header("Location:index.php?page=".$_GET['page']);
                    //affiche les commentaires et les contacts
                    ControleurSite::gererlistCommentairs_Contact();
                    break;
                case "supContact" :
                    ControleurSite::gererSupprimerContact();
                    //affiche les commentaires et les contacts
                    ControleurSite::gererlistCommentairs_Contact();
                    break;
                case "lst" :
                default :
                    ControleurSite::gererlistCommentairs_Contact();
            }//fin du switch() sur $_GET['action']
        } catch(Exception $e) {
            echo "<p>" . $e -> getMessage() . "</p>";
        }

    }//Fin gererAdmiCommentairs_Contact()


    /****************************************************************************************/




    public static function gererAchats(){

        try {

            VueAchats::tous();

        } catch (Exception $e) {

            VueAchats::tous(array("type"=>"danger","msg"=>"Une erreur est survenu."));

        }

    }

    public function gererVente(){

        try {

            VueVente::listeVentes();

        } catch (Exception $e) {

            Vue::alerte(array("type"=>"danger","msg"=>$e->getMessage()));

        }

    }

	public function gererTransaction() {

		try {

			if ( !isset($_GET['etat']) ) {

				$_GET['etat'] = 'erreur';

			}

			switch ( $_GET['etat'] ) {

				case 'accepte':
					VueTransaction::afficherSuccess(array('type'=>'success','msg'=>'Félicitation!'));
					break;

				case 'annule':
					VueTransaction::afficherAnnule(array('type'=>'danger','msg'=>'Transaction annulé!'));
					break;

				default:
				$this->gererErreurs();

			}

		} catch ( Exception $e) {

			echo "
				<div class=\"alert alert-danger alert-dismissible\" role=\"alert\">
					<button type=\"button\" class=\"close\" data-dismiss=\"alert\">
						<span aria-hidden=\"true\">&times;</span><span class=\"sr-only\">Fermer</span>
					</button>
					<p>".$e->getMessage()."</p>
				</div>";

		}

	}

    public function gererReglements() {

        try {

            if ( !isset($_GET['section']) ) {

                $_GET['section'] = "confidentialite";

            }

            switch ( $_GET['section'] ) {

                case 'non-responsabilite':
                    VueReglements::nonResponsabilite();
                    break;

                case 'commentaire':
                    VueReglements::commentaire();
                    break;

                case 'confidentialite':

                default:
                    VueReglements::confidentialite();
                    break;

            }

        } catch ( Exception $e ) {

            VueReglements::confidentialite(array("type"=>"danger","msg"=>$e->getMessage()));

        }

    }

}