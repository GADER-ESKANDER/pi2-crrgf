<?php
class TypeException extends Exception {

	const ERR_VIDE ="Le paramètre ne doit pas être une chaîne vide.";
	const ERR_STRING ="Le paramètre doit être une chaîne de caractères.";
	const ERR_INTEGER ="Le paramètre doit être une valeur entière.";

	const ERR_FLOAT ="Le paramètre doit être une valeur float.";
	const ERR_UTILISATEUR ="Le paramètre doit être un objet de type Utilisateur.";
	const ERR_OEUVRE ="Le paramètre doit être un objet de type Oeuvre.";

    const ERR_COURRIEL ="L'adresse entrée, n'est pas valide";
    const ERR_PASSWORD ="Le mot de passe ne comporte pas au moins 8 caractères ou contient des caractère invalide";
    const ERR_NOM ="Le nom entrée contient des caractères invalide";
    const ERR_PRENOM ="Le prénom entrée contient des caractères invalide";

	const ERR_NUMERIC ="Le paramètre doit être une valeur numérique.";
	const ERR_FOLDER="Le paramètre doit être un dossier";
	const ERR_RESOURCE="Le paramètre doit être une ressource";
	const ERR_OBJET = "Erreur - le paramètre doit être un objet";
	const ERR_MEDIA = "Erreur - le paramètre doit être un objet de type Media";
	const ERR_ARRAY = "Erreur - le paramètre doit être un array";

	//martin
	const ERR_CONF_EMAIL = "les adresses de courriel ne sont pas identique";

	/**
	 * détermine si le paramètre est une chaîne vide
	 * @param mixed $sCh
	 */
	public static function estVide($sCh){
		if( $sCh === "")
			throw new TypeException(TypeException::ERR_VIDE);
	}

	/**
	 * détermine si le paramètre est une chaîne de caractères
	 * @param mixed $sCh
	 */
	public static function estString($sCh){
		if(is_numeric($sCh)==true)
			throw new TypeException(TypeException::ERR_STRING." - ".$sCh);
	}
	/**
	 * détermine si le paramètre est une valeur numérique
	 * @param mixed $iInt
	 */
	public static function estNumerique($iInt){
		if(is_numeric($iInt)==false)
			throw new TypeException(TypeException::ERR_NUMERIC);
	}


    /**
     * détermine si le paramètre est une valeur float
     * @param mixed $iInt
     */
    public static function estFloat($iInt){
        if(is_float($iInt)==false)
            throw new TypeException(TypeException::ERR_FLOAT);
    }

    /**
     * détermine si le paramètre est un objet de type Utilisateur
     * @param Utilisateur $oUtilisateur
     */
    public static function estUtilisateur(Object $oUtilisateur){
        if(gettype($oUtilisateur) !== 'Utilisateur')
            throw new TypeException(TypeException::ERR_UTILISATEUR);
    }

    /**
     * détermine si le paramètre est un objet de type Oeuvre
     * @param Oeuvre $oOeuvre
     */
    public static function estOeuvre(Object $oOeuvre){
        if(gettype($oOeuvre) !== 'Oeuvre')
            throw new TypeException(TypeException::ERR_OEUVRE);
    }


	/**
	 * détermine si le paramètre est une valeur entière
	 * @param mixed $iInt
	 */
	public static function estInteger($iInt){
		if(is_integer($iInt)==false)
			throw new TypeException(TypeException::ERR_INTEGER);
	}
	/**
	 * détermine si le paramètre est un dossier
	 * @param mixed $sDossier
	 */
	public static function estDossier($sDossier){
		if(is_dir($sDossier)==false)
			throw new TypeException(TypeException::ERR_FOLDER);
	}

	/**
	 * détermine si le paramètre est un objet de type Media
	 * @param Media $oMedia
	 */
	public static function estMedia(Object $oMedia){
		if(gettype($oMedia) !== 'Media')
			throw new TypeException(TypeException::ERR_MEDIA);

	}

	/**
	 * détermine si le paramètre est une ressource
	 * @param mixed $rH
	 */
	public static function estResource($rH){
		if(is_resource($rH)==false)
			throw new TypeException(TypeException::ERR_RESOURCE);
	}
	/**
	 * détermine si le paramètre est un objet
	 * @param mixed $oObj
	 */
	public static function estObjet($oObj){
		if(is_object($oObj) == false){
			throw new Exception(TypeException::ERR_OBJET);
		}
	}

	/**
	 * détermine si le paramètre est un array
	 * @param mixed $aArr
	 */
	public static function estArray($aArr){
		if(is_array($aArr) == false){
			throw new Exception(TypeException::ERR_ARRAY);
		}
	}


    /**
     * détermine si le paramètre est un mot de passe valide
     * @param sgtring $sPassword
     */
    public static function estPassword($sPassword){
        if($sPassword != " "){
            if(preg_match('/^([\w`~\!@#\$%\^&\*\(\)_\-\+\=\{\}\[\]\\\|\:;"\'<>,\.\?\/]){8,}$/', $sPassword)==0)
                throw new TypeException(TypeException::ERR_PASSWORD);

        }
    }

    /**
     * détermine si le paramètre est une valeur courriel
     * @param string $sCourriel
     */
    public static function estCourriel($sCourriel){
        if($sCourriel != " "){
            if(filter_var($sCourriel, FILTER_VALIDATE_EMAIL)==false)
                throw new TypeException(TypeException::ERR_COURRIEL);
        }
    }

    /**
     * détermine si le paramètre est un nom valide
     * @param string $sNom
     */
    public static function estNom($sNom){
        if($sNom != " "){
            if(preg_match('/^([a-zA-Z]{1,}){1}(([\-]| {1,}){1}[a-zA-Z]{1,}){0,}$/', $sNom)==0)
                throw new TypeException(TypeException::ERR_NOM);
        }
    }

    /**
     * détermine si le paramètre est un prénnom valide
     * @param string $sPrenom
     */
    public static function estPrenom($sPrenom){
        if($sPrenom != " "){
            if(preg_match('/^([a-zA-Z]{1,}){1}(([\-]| {1,}){1}[a-zA-Z]{1,}){0,}$/', $sPrenom)==0)
                throw new TypeException(TypeException::ERR_PRENOM);
        }
    }


	public function __construct($sMsg="", $iCode=0){
		parent::__construct($sMsg, $iCode);
	}

}