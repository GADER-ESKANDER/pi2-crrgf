"use strict";

$(document).ready(function()
{
//	console.log("bonjour");
	/*****GESTION DE L'AFFICHAGE EN MODE GRILLE/LISTE*****/

	//Affichage en mode liste sur clic du bouton de navigation:liste
	$('#liste').click(function()
	{
	console.log("liste");
	//document.location="../index.php?page=mes-oeuvres&mode=liste";
		$('#selection').removeClass("grille liste").addClass("liste");//enlève la classe grille et ajoute la classe liste
		$('#selection article.row div').removeClass("col-md-4").addClass("col-md-12");
	});

	//Affichage en mode grille sur clic du bouton de navigation:grille
	$('#grille').click(function()
	{
	console.log("grille");
	//document.location="../index.php?page=mes-oeuvres&mode=grille";
		$('#selection').removeClass("liste grille").addClass("grille");//enlève la classe liste et ajoute la classe grille
		$('#selection article.row div').removeClass("col-md-12").addClass("col-md-4");
	});

 });
 
 /**
 * demande une confirmation de suppression et redirige l'internaute pour effectuer la suppression
 * @param {string} sMsg le message à afficher dans la confirmation
 * @param {integer} iSection la section à utiliser pour la redirection
 * @param {string} sAction l'action à utiliser pour la redirection
 * @param {integer} idEtudiant numéor de l'étudiant à supprimer
 */
 /*addEventListener('click', function(){
 
 supprimerUneOeuvre('Voulez-vous supprimer cet oeuvre', 'gestionOeuvres', 'sup', 2)
 
 });*/
 
function supprimerUneOeuvre(sMsg, iSection, sAction, idOeuvre){
	
	console.log(iSection);
	console.log(idOeuvre);
	console.log(sAction);
	
	
	var bConfirm = confirm(sMsg);
	console.log(sMsg);
	console.log(bConfirm);
	if(bConfirm == true){	
		//Redirection
		document.location="../site/ajax/gererMesOeuvres.php?page="+iSection+"&action="+sAction+"&idOeuvre="+idOeuvre;		
	}
}//fin de la fonction supprimerUneOeuvre()
 
/* Lorsque le dom est prêt */
window.addEventListener('load', function()
	{
		var cmd= document.getElementById('btnEnvoyer');		
		cmd.addEventListener('click', validerFormulaire);
	});
	
	/**
	* fonction qui valide un champs alphabétique
	* @param {DOMelement} Element qui contient une propriété value        
	*/
	
	var noOeuvre="";
	var nomOeuvre="";   
	var descriptionOeuvre="";
	var dimensionOeuvre="";   
	var poidsOeuvre="";   
	var nameTechnique="";   
	var nameTheme="";
	var nameMedia="";
	
	var nomMedia=document.getElementById('txtMedia').value;
	var idOeuvre=document.getElementById('idOeuvre').value;		
	
	function validerFormulaire()
	{
    
		var nomTechnique=document.getElementById('txtTechnique').value;	
		var nomTheme=document.getElementById('txtTheme').value;
		//var description=document.getElementById('description').value;	
		
		noOeuvre=idOeuvre;
		nameTechnique=nomTechnique;
		nameTheme=nomTheme;
		nameMedia=nomMedia;
		//descriptionOeuvre=description;
		
		//validation du nom 
			var valide=0;//compte le nombre de champ validé
			
            var testNom=document.getElementById('nom').value.trim();//récupère la valeur entrée dans le champ nom
            
            var patron1=/^[a-zA-ZÀ-ÿ\s\'-]{1,50}$/; // not(début et fin: caractères alphabétiques; milieu: autorise espace et trait d'union) 
            var res = patron1.test(testNom); 
                                
            
        if(testNom=='') //si le champ est vide
        {
            nom.nextElementSibling.innerHTML ='Veuillez compléter ce champ';
                
        }else 
		
		
			{
				if(testNom.length<2) //si taille <2 
				
			
				{
					nom.nextElementSibling.innerHTML ='Trop court';
						
				}else 
					{
						if(testNom.length>50) //si taille >50             
						{
							nom.nextElementSibling.innerHTML ='Trop de caractères';
						
						}else 
							{
								if(res==false)//si test est faux
								{                    
									nom.nextElementSibling.innerHTML = 'Ce champ comporte des caractères invalides';
								
								}else                    
									{
										nomOeuvre=testNom;		
										console.log(nomOeuvre);								
																	
										//console.log(nomOeuvre);
										nom.nextElementSibling.innerHTML ='';
										valide++;  //incrémente le nombre de champ validé                  
									} 
							}
					}
			}		
			
		//validation de description             
            var testDescription=document.getElementById('description').value.trim();            
        
            var patron2=/^[a-zA-ZÀ-ÿ\s\'-;?]*$/; //not(début:caractères alphabétiques; milieu et fin: caractères alphabétiques avec quelques caractères spéciaux)
            var res = patron2.test(testDescription);
                                
            
            if(testDescription=='')
            {
                description.nextElementSibling.innerHTML ='Veuillez compléter ce champ';
            
            }else

				{
					if(testDescription.length<10) //si taille <10	
				
					{
						description.nextElementSibling.innerHTML ='Trop court, min 10 caractères';
						
					}else
						{					
							if(testDescription.length>255) //si taille >255		
							{
								description.nextElementSibling.innerHTML ='trop de caractères, maximum 255 caractères';								
							}
							else
								{
									if(res==false)//si test est false            
									{
										description.nextElementSibling.innerHTML = 'Ce champ comporte des caractères invalides';
										
									}else	            
											{
												descriptionOeuvre=testDescription;
												
												description.nextElementSibling.innerHTML ='';
												valide++;												
											}
								}
						}

				 }
				 
		//validation de dimension	
		//teste une condition contraire
		   var testDimension=document.getElementById('dimension').value.trim();   
			//console.log(testDimension);
					
			
			var patron3=/^(\d{2,3})(\x\d{2,3})$/i; //not (début:chiffres; milieu x et fin: chiffres)
			
			var res = patron3.test(testDimension); 
			//console.log(res);
			if(testDimension=='') //si le champ est vide
        {
            dimension.nextElementSibling.innerHTML ='Veuillez compléter ce champ';
		
		}else 
		
			{
			if(res==false)//si test est vrai
			
			{                    
				dimension.nextElementSibling.innerHTML = 'Veuillez respecter le format 123x456';
			
			}else                    
				{
					dimensionOeuvre=testDimension;
					
					dimension.nextElementSibling.innerHTML ='';
					valide++;  //incrémente le nombre de champ validé

				} 
			}
		//validation de poids	
		//teste une condition contraire
		   var testPoids=document.getElementById('poids').value;    
			var patron4=/^[1-9][0-9]{0,2}[\.|,]?[0-9]{0,2}$/; //(début:chiffres; milieu , et fin: chiffres)
			var res = patron4.test(testPoids); 
	
		if(testPoids=='') //si le champ est vide
        {
            poids.nextElementSibling.innerHTML ='Veuillez compléter ce champ'; 					
			                
		}else 
		
			{
				if(res==false)//si test est vrai
				{                    
					poids.nextElementSibling.innerHTML = 'Veuillez rentrer des valeurs exacts';
				
				}else                    
					{
						poidsOeuvre=testPoids;
						poidsOeuvre=poidsOeuvre.replace(",",".");
						console.log(poidsOeuvre);
						poids.nextElementSibling.innerHTML ='';
						valide++;  //incrémente le nombre de champ validé                  
					} 
			}					
		
						
	 if (valide==4)//si les 4 champs sont validés
                    
        {         
		  //Ajax
		
		var sAction = $(this).attr('data-action');
		//console.log("idOeuvre="+noOeuvre+"&txtNom="+nomOeuvre+"&txtMedia="+nameMedia+"&txtDescription="+descriptionOeuvre+"&txtDimension="+dimensionOeuvre+"&txtPoids="+poidsOeuvre+"&txtTheme="+nameTheme+"&txtTechnique="+nameTechnique+"&action="+sAction);
		$.ajax({
			url:"../site/ajax/gererMesOeuvres.php",
			type:"post",
			data:"idOeuvre="+noOeuvre+"&txtNom="+nomOeuvre+"&txtMedia="+nameMedia+"&txtDescription="+descriptionOeuvre+"&txtDimension="+dimensionOeuvre+"&txtPoids="+poidsOeuvre+"&txtTheme="+nameTheme+"&txtTechnique="+nameTechnique+"&action="+sAction,			
			dataType:"html",
			success:function(sData){				
				document.getElementById("msg").innerHTML= "Ajout/Modification faite.";//sData;
				
			},
			error: function(){
				alert("Erreur de communication !");
			}
		});		  
		  //document.querySelector("#formulaire").submit();//soumettre le formulaire
        }           
  
      
    }//fin de la fonction on()