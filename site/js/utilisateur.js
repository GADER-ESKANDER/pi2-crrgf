//utilisateur.js

$(function(){

	/*$("input[type=button]" ).on("click", function() {
		var sAction = $(this).attr('data-action');
		var idEtudiant = document.forms[0].elements['idEtudiant'].value;
		var sNom = document.forms[0].elements['txtNom'].value;
		var sPrenom = document.forms[0].elements['txtPrenom'].value;
		var iAge = document.forms[0].elements['txtAge'].value;
		//Ajax
		$.ajax({
			url:"../lib/ajax/gererEtudiant.php",
			type:"post",
			data:"idEtudiant="+idEtudiant+"&txtNom="+sNom+"&txtPrenom="+sPrenom+"&txtAge="+iAge+"&action="+sAction,
			dataType:"html",
			success:function(sData){				
				document.getElementById("msg").innerHTML=sData;
			},
			error: function(){
				alert("Erreur de communication !");
			}
		});
		
	});//fin de la fonction on()*/
	
	//appel du formulaire de connexion
	$("#connexion").click(function(event) {
		event.preventDefault();
		var formulaire='<div id="modalForm" class="modal fade"><div class="modal-dialog"><div class="modal-content"><div class="modal-header"><button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button><h4 class="modal-title">Connexion</h4></div><div class="modal-body"><form class=\"form-horizontal\" role=\"form\" action=\"index.php?page=utilisateur&action=connexion\" method=\"post\"><div id="msg" \"col-xs-12 col-sm-8 col-sm-offset-2\"><p></p></div><div class=\"form-group\"><label for=\"inputEmail\" class=\"col-sm-2 control-label\">Courriel</label><div class=\"col-sm-10\"><input type=\"email\" name=\"courriel\"class=\"form-control\" id=\"inputEmail\" placeholder=\"Courriel\" value=\"\"><span class=col-xs12></span></div></div><div class=\"form-group\"><label for=\"inputPassword\" class=\"col-sm-2 control-label\">Mot de passe</label><div class=\"col-sm-10\"><input type=\"password\" name=\"password\" class=\"form-control\" id=\"inputPassword\" placeholder=\"Mot de passe\"><span class=col-xs12></span></div></div><div class=\"form-group\"></div></form></div><div class="modal-footer"><button type="button" class="btn btn-default" data-dismiss="modal">Annuler</button><button type="button" data-action="connexion" class="btn btn-primary" value="connexion">Connexion</button></div></div><!-- /.modal-content --></div><!-- /.modal-dialog --></div><!-- /.modal -->';
		$('body').prepend(formulaire);
		$('#modalForm').modal();
		$("button[value=connexion]" ).on("click", function() {
			
			var formulaireConforme = true;
			var sAction = $(this).attr('data-action');
			var champCourriel = document.forms[0].elements['courriel'];
			var champPassword = document.forms[0].elements['password'];
			var sCourriel = champCourriel.value;
			var sPassword = champPassword.value;
			//console.log(sCourriel);
			formulaireConforme=verifieChampCourriel(champCourriel)&&formulaireConforme;
			
			formulaireConforme=verifieMotDePasse(champPassword)&&formulaireConforme;
			
			if(formulaireConforme){
				
				//Ajax
				$.ajax({
					url:"index.php?page=utilisateurAjax",
					type:"post",
					data:"courriel="+sCourriel+"&password="+sPassword+"&action="+sAction,
					dataType:"html",
					success:function(sData){
						if(sData != ""){
							document.getElementById("msg").innerHTML=sData
							console.log(12345);
						}
						else {
							$('#modalForm').modal('hide');
							$('#modalForm').on('hidden.bs.modal', function (e) {
								$('#modalForm').remove();
							});
							$('nav')[0].innerHTML='<div class=\"container-fluid\"><section class=\"row\"><!-- navbar-collapse --><div class=\"collapse navbar-collapse navbar-menu\"><div class=\"col-md-5 \"><ul class=\"nav navbar-nav\"><li><a href=\"?page=oeuvres-encheres\">Enchères</a></li><li><a href=\"?page=artistes\">Artistes</a></li><li><a href=\"?page=contact\">Contact</a></li></ul></div><div class=\"col-md-7\"><ul class=\"nav navbar-nav navbar-right\">";<li><a href=\"?page=commentaires\">Commentaires</a></li><li class=\"dropdown\"><a href=\"?page=compte\" class=\"dropdown-toggle\" data-toggle=\"dropdown\">Mon compte <b class=\"caret\"></b></a><ul class=\"dropdown-menu\"><li><a href=\"?page=gestionEnchere\">Mes enchères</a></li><li><a href=\"?page=mes-oeuvres\">Mes oeuvres</a></li><li><a href=\"?page=utilisateur&action=parametres\">Paramètres</a></li><li><a href=\"?page=utilisateur&action=deconnecter\">Déconnecter</a></li></ul></li></ul></div></div><!-- /.navbar-collapse --></section></div>'
						}
					},
					error: function(){
						alert("Erreur de communication !");
					}
				});
			}

		});//fin de la fonction on()*/

	});

	//appel du formulaire dinscription
	$("#inscription").click(function(event) {
		event.preventDefault();
		var formulaire='<div id="modalForm" class="modal fade"><div class="modal-dialog"><div class="modal-content"><div class="modal-header"><button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button><h4 class="modal-title">Inscription</h4></div><div class="modal-body"><form class=\"form-horizontal\" role=\"form\" action=\"index.php?page=utilisateur&action=inscription\" method=\"post\"><div id="msg" \"col-xs-12 col-sm-8 col-sm-offset-2\"><p></p></div><div class=\"form-group\"><label for=\"inputNom\" class=\"col-sm-2 control-label\">Nom</label><div class=\"col-sm-10\"><input type=\"text\" class=\"form-control\" id=\"inputNom\" name=\"nom\" placeholder=\"Nom\" value=\"\"><span class=col-xs12></span></div></div><div class=\"form-group\"><label for=\"inputPrenom\" class=\"col-sm-2 control-label\">Prénom</label><div class=\"col-sm-10\"><input type=\"text\" class=\"form-control\" id=\"inputPrenom\" name=\"prenom\" placeholder=\"Prénom\" value=\"\"><span class=col-xs12></span></div></div><div class=\"form-group\"><label for=\"inputEmail\" class=\"col-sm-2 control-label\">Courriel</label><div class=\"col-sm-10\"><input type=\"email\" class=\"form-control\" id=\"inputEmail\" name=\"courriel\" placeholder=\"Courriel\" value=\"\"><span class=col-xs12></span></div></div><div class=\"form-group\"><label for=\"inputConfEmail\" class=\"col-sm-2 control-label\">Confirmation Courriel</label><div class=\"col-sm-10\"><input type=\"email\" class=\"form-control\" id=\"inputConfEmail\" name=\"confCourriel\" placeholder=\"Confirmer courriel\" value=\"\"><span class=col-xs12></span></div></div><div class=\"form-group\"><label for=\"inputPassword\" class=\"col-sm-2 control-label\">Mot de passe</label><div class=\"col-sm-10\"><input type=\"password\" class=\"form-control\" id=\"inputPassword\" name=\"password\" placeholder=\"Mot de passe\" value=\"\"><span class=col-xs12></span></div></div></form></div><div class="modal-footer"><button type="button" class="btn btn-default" data-dismiss="modal">Annuler</button><button type="button" data-action="inscription" class="btn btn-primary" value="inscription">S\'inscrire</button></div></div><!-- /.modal-content --></div><!-- /.modal-dialog --></div><!-- /.modal -->';
		$('body').prepend(formulaire);
		$('#modalForm').modal();
		$("button[value=inscription]" ).on("click", function() {

			var formulaireConforme = true;
			var sAction = $(this).attr('data-action');
			var champNom= document.forms[0].elements['nom'];
			var champPrenom = document.forms[0].elements['prenom'];
			var champCourriel = document.forms[0].elements['courriel'];
			var champConfCourriel = document.forms[0].elements['confCourriel'];
			var champPassword = document.forms[0].elements['password'];
			var sNom = champNom.value;
			var sPrenom = champPrenom.value;
			var sCourriel = champTel.value;
			var sConfCourriel = champConfCourriel.value;
			var sPassword = champPassword.value;
			formulaireConforme=verifieChampText(champNom)&&formulaireConforme;
			formulaireConforme=verifieChampText(champPrenom)&&formulaireConforme;
			formulaireConforme=verifieChampCourriel(champCourriel)&&formulaireConforme;
			formulaireConforme=verifieChampConfCourriel(champCourriel, champConfCourriel)&&formulaireConforme;
			formulaireConforme=verifieMotDePasse(champPassword)&&formulaireConforme;
				
			if(formulaireConforme){
			//Ajax
				$.ajax({
					url:"index.php?page=utilisateurAjax",
					type:"post",
					data:"nom="+sNom+"&prenom="+sPrenom+"&courriel="+sCourriel+"&confCourriel="+sConfCourriel+"&password="+sPassword+"&action="+sAction,
					dataType:"html",
					success:function(sData){
						if(sData != ""){
							document.getElementById("msg").innerHTML=sData;
						}
						else {
							$('#modalForm').modal('hide');
							$('#modalForm').on('hidden.bs.modal', function (e) {
								$('#modalForm').remove();
							});
							$('nav')[0].innerHTML='<div class=\"container-fluid\"><section class=\"row\"><!-- navbar-collapse --><div class=\"collapse navbar-collapse navbar-menu\"><div class=\"col-md-5 \"><ul class=\"nav navbar-nav\"><li><a href=\"?page=oeuvres-encheres\">Enchères</a></li><li><a href=\"?page=artistes\">Artistes</a></li><li><a href=\"?page=contact\">Contact</a></li></ul></div><div class=\"col-md-7\"><ul class=\"nav navbar-nav navbar-right\">";<li><a href=\"?page=commentaires\">Commentaires</a></li><li class=\"dropdown\"><a href=\"?page=compte\" class=\"dropdown-toggle\" data-toggle=\"dropdown\">Mon compte <b class=\"caret\"></b></a><ul class=\"dropdown-menu\"><li><a href=\"?page=gestionEnchere\">Mes enchères</a></li><li><a href=\"?page=mes-oeuvres\">Mes oeuvres</a></li><li><a href=\"?page=utilisateur&action=parametres\">Paramètres</a></li><li><a href=\"?page=utilisateur&action=deconnecter\">Déconnecter</a></li></ul></li></ul></div></div><!-- /.navbar-collapse --></section></div>'
						}
					},
					error: function(){
						alert("Erreur de communication !");
					}
				});
			}

		});//fin de la fonction on()*/

	});
	//validation formulaire modification
	$("button[value=modifier]").click(function(event) {
		event.preventDefault();
		var formulaireConforme = true;
		var champNom= document.forms[1].elements['nom'];
		var champPrenom = document.forms[1].elements['prenom'];
		var champCourriel = document.forms[1].elements['courriel'];
		var champPassword = document.forms[1].elements['password'];
		formulaireConforme=verifieChampText(champNom)&&formulaireConforme;
		formulaireConforme=verifieChampText(champPrenom)&&formulaireConforme;
		formulaireConforme=verifieChampCourriel(champCourriel)&&formulaireConforme;
		formulaireConforme=verifieMotDePasse(champPassword)&&formulaireConforme;
        if(formulaireConforme){
            //Solution prise sur StackOverflow LIEN:http://stackoverflow.com/questions/5651933/what-is-the-opposite-of-evt-preventdefault
            function(event){
                return true;
            }

        }

	});
});

/********************************************************************************
*                                                                               *
*           Controle des champs                                                 *
*           fonction de validation prise à partir du tp de programmation 2      *
*                                                                               *
********************************************************************************/



// gestion d'un champ type Nom  sans chiffre

function verifieChampText(elementFormulaire)//Vérifie si une chaine est composé de seulement des caractères situé entre a et z minuscule
{
	var champTexte = elementFormulaire.value.trim(); 
    var rgxValideNom = /^([a-zA-Z]{1,}){1}(([\-]| {1,}){1}[a-zA-Z]{1,}){0,}$/;///^[a-z]{2,}([\- ]{0,1}[a-z]{2,}){0,}$/;//   /^\w$/;//
    var resValidation = rgxValideNom.test(champTexte);
	var formulaireConforme = true;
	
	if (champTexte == "")
	{
		afficherErreurChampVide(elementFormulaire);
		formulaireConforme =false;
		//elementFormulaire.previousElementSibling.classList.add("erreur");
	}
	else
	{
		if(resValidation == false)
		{
			afficherErreurChampTexte(elementFormulaire);
			formulaireConforme =false;
		//	elementFormulaire.previousElementSibling.classList.add("erreur");
		}
		else
		{
			elementFormulaire.nextElementSibling.innerHTML = "";
		}
	}
	return formulaireConforme;
}

function verifieChampTel(elementFormulaire)// renvoie true si la chaine type TEL est comforme
{
    var champTel = elementFormulaire.value.trim();
    var rgxValideTel = /^\([0-9]{3}\) [0-9]{3}\-[0-9]{4}$/;
    var resValidation = rgxValideTel.test(champTel);
	var formulaireConforme = true;
	

	if (champTel == "")
	{
		afficherErreurChampVide(elementFormulaire);
		formulaireConforme =false;
		//elementFormulaire.previousElementSibling.classList.add("erreur");
	}
	else
	{
		if(resValidation == false)
		{
			afficherErreurChampTel(elementFormulaire);
			formulaireConforme =false;
		//	elementFormulaire.previousElementSibling.classList.add("erreur");
		}
		else
		{
			elementFormulaire.nextElementSibling.innerHTML = "";
		}
	}
	return formulaireConforme;
	//console.log(champTel);
}


function verifieChampCourriel(elementFormulaire)
{
    var champCourriel=elementFormulaire.value.trim();
    var rgxValideEmail = /^([\w\-]{1,}){1}(\.[\w\-]{1,}){0,}@[\w\-]{2,}(\.[\w\-]{2,}){1,}$/;
    var resValidation = rgxValideEmail.test(champCourriel);
    var formulaireConforme=true;
	
	if (champCourriel == "")
	{
		afficherErreurChampVide(elementFormulaire);
		formulaireConforme =false;
		//elementFormulaire.previousElementSibling.classList.add("erreur");
	}
	else
	{
		if(resValidation == false)
		{
			afficherErreurChampCourriel(elementFormulaire);
			formulaireConforme =false;
			//elementFormulaire.previousElementSibling.classList.add("erreur");
		}
		else
		{
			elementFormulaire.nextElementSibling.innerHTML = "";
		}
	}
	return formulaireConforme;
	//console.log(champCourriel);
	
}
function verifieChampConfCourriel(elementFormulaireCourriel, elementFormulaireConfCourriel){
	var champCourriel=elementFormulaireCourriel.value.trim();
	var champConfCourriel=elementFormulaireConfCourriel.value.trim();
    var formulaireConforme=true;
	if (champConfCourriel == "")
	{
		afficherErreurChampVide(elementFormulaireConfCourriel);
		formulaireConforme =false;
		//elementFormulaire.previousElementSibling.classList.add("erreur");
	}
	else
	{
		if(champCourriel != champConfCourriel)
		{
			afficherErreurChampConfCourriel(elementFormulaireConfCourriel);
			formulaireConforme =false;
			//elementFormulaire.previousElementSibling.classList.add("erreur");
		}
		else
		{
			elementFormulaire.nextElementSibling.innerHTML = "";
		}
	}
	return formulaireConforme;

}

function verifieMotDePasse(elementFormulaire)
{
    var champPassword=elementFormulaire.value;
    var rgxValidePwd = /^([\w`~\!@#\$%\^&\*\(\)_\-\+\=\{\}\[\]\\\|\:;"'<>,\.\?\/]){8,}$/;
    var resValidation = rgxValidePwd.test(champPassword);
    var formulaireConforme=true;

	
	if (champPassword == "")
	{
		afficherErreurChampVide(elementFormulaire);
		formulaireConforme =false;
		//elementFormulaire.previousElementSibling.classList.add("erreur");
	}
	else
	{
		if(resValidation == false)
		{
			afficherErreurChampPassword(elementFormulaire);
			formulaireConforme =false;
			//elementFormulaire.previousElementSibling.classList.add("erreur");
		}
		else
		{
			elementFormulaire.nextElementSibling.innerHTML = "";
		}
	}
	return formulaireConforme;
	//console.log(champCourriel);
}

    
/********************************************************************************
*                                                                               *
*           Message d'erreurs	                                                *
*                                                                               *
*                                                                               *
********************************************************************************/

function afficherErreurChampVide(elementFormulaire)
{
	elementFormulaire.nextElementSibling.innerHTML = "Veuillez compléter ce champ. " ;
	
}


function afficherErreurChampTexte(elementFormulaire)
{
	elementFormulaire.nextElementSibling.innerHTML = "Ce champ comporte des caractères invalides. "
}

function afficherErreurChampPassword(elementFormulaire)
{

	if(elementFormulaire.value.length < 8){
		elementFormulaire.nextElementSibling.innerHTML = "Ce champs doit contenir au moins 8 caractères."
	}
	else{
		elementFormulaire.nextElementSibling.innerHTML = "Ce champs contient des caractères invalides.<br/>les caracteres valides sont A-Z, a-z, 0-1 et ` ~ ! @ # $ % ^ & * ( ) _ - + = { } [ ] \\ | : ; \" ' < > , . ? / "
	}
}
	
function afficherErreurChampCourriel(elementFormulaire)
{
	elementFormulaire.nextElementSibling.innerHTML = "Vous devez inscrire un courriel valide. "
}

function afficherErreurChampConfCourriel(elementFormulaire)
{
	elementFormulaire.nextElementSibling.innerHTML = "Les adresses courriel ne correspondent pas."
}


function nomPropre(chaine)
{
    
    chaine = chaine.split("-");
    for (var i = 0 ; i < chaine.length ; i++)
    {
        chaine[i] = chaine[i].split("");
        for(var j = 0 ; j < chaine[i].length ; j++)
            {
                if(j == 0)
                {
                    chaine[i][j] = chaine[i][j].toUpperCase();
                }
                else
                {
                    chaine[i][j] = chaine[i][j].toLowerCase();
                }
            }
        chaine[i] = chaine[i].join("");
        console.log(chaine[i]);
    }
    chaine = chaine.join("-");

return chaine;
}

