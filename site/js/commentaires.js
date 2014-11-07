/**
 * @author Gader Eskander
 */

/**
 * demande une confirmation de suppression et redirige pour effectuer la suppression
 * @param {string} sMsg le message à afficher dans la confirmation
 * @param {integer} iSection la section à utiliser pour la redirection
 * @param {string} sAction l'action à utiliser pour la redirection
 * @param {integer} IdCommentaire numéor de Commentaire à supprimer
 */

var sUrl = location.href;
var aUrl = sUrl.split('?');
var paires = aUrl[1].split('&');
var pairePage = paires[0];
var page = pairePage.split('=');
// ---------------------Commentaire---------------------------
var aBtnSupprimer = document.querySelectorAll('.btnSupprimer');
for (var i=0; i < aBtnSupprimer.length; i++) {
	aBtnSupprimer[i].addEventListener('click', function(e){
		e.preventDefault();
		var idCommetaire= $(this).attr("data-idCommetaire");
		supprimerUnCommentaire('Voulez-vous supprimer cet Commentaire',page[1] ,'supCommentair', idCommetaire);
	});
  
};


function supprimerUnCommentaire(sMsg, iSection, sAction, IdCommentaire){
	var bConfirm = confirm(sMsg);//Affiche une boîte de confirmation:
	if(bConfirm == true){
		//Redirection (L'objet de l'emplacement contient des informations sur l'URL actuelle.)
		document.location="?page="+iSection
							+"&action="+sAction
							+"&IdCommentaire="+IdCommentaire;
	}
}


// ---------------------Contact---------------------------
// var paireAction = paires[1];
// var action = paireAction.split('=');
// console.log('Page: '+page[1]);
// console.log('action: '+action[1]);

var aBtnSupprimContact = document.querySelectorAll('.btnSupprimContact');
for (var i=0; i < aBtnSupprimContact.length; i++) {
	aBtnSupprimContact[i].addEventListener('click', function(e){
		e.preventDefault();
		var idContact= $(this).attr("data-idContact");
		console.log(idContact);
		supprimerUnContact('Voulez-vous supprimer cet Contact',page[1] ,'supContact', idContact);
	});
};

function supprimerUnContact(sMsg, iSection, sAction, idContact){
	console.log(sMsg);
	console.log(iSection);
	console.log(sAction);
	console.log(idContact);
	var bConfirm = confirm(sMsg);//Affiche une boîte de confirmation:
	if(bConfirm == true){
		//Redirection (L'objet de l'emplacement contient des informations sur l'URL actuelle.)
		document.location="?page="+iSection
							+"&action="+sAction
							+"&idContact="+idContact;
	}
}











