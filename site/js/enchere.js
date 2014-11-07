/**
 * Created by fenix on 14-10-04.
 */

//Ajout d'event listeners au chargement de la page
window.addEventListener("load", function(){

    if(document.querySelector(".tempRestant")!=null)
    {
        var timeLeft = document.querySelector(".tempRestant").innerText;
        var timeZoneInnerHTML = document.querySelector(".tempRestant");
    }

    var tempsRestantTimeout, statutEnchereTimeout;
    var xmlHttpStatut;

    if(typeof timeLeft != "undefined" && timeLeft != null)
    {
        // Création du décompte pour la fin de l'enchère
//        var currentTime = document.querySelector(".currentTime");

        tempsRestantTimeout = setTimeout(function(){decompte(timeLeft)},0);
        statutEnchereTimeout = setTimeout(function(){MiseAJourEtatEnchere();},0);

        // Fonction à appeler à chaque seconde pour le décompte
        function decompte(secondesTotal)
        {
            if(secondesTotal>0)
            {
                var days = parseInt(secondesTotal/86400);
                var hours = parseInt((secondesTotal-days*86400)/3600);
                var minutes = parseInt((secondesTotal-hours*3600-days*86400)/60);
                var secondes = (secondesTotal-days*86400-hours*3600-minutes*60);
                timeZoneInnerHTML.innerHTML = days + " jours " + hours + " heures " + minutes + " minutes " + secondes + " secondes ";

                tempsRestantTimeout = setTimeout(function(){decompte(secondesTotal-1)},1000);
            }
            else
            {
                timeZoneInnerHTML.innerHTML = "Cette enchère est déjà fermée!";
                if(document.getElementById("btnOffre")!=null)
                {
                    var btnPlacerOffre = document.getElementById("btnOffre");
                    btnPlacerOffre.setAttribute("disabled", "disabled");
                }
            }
        }
    }


    // Changement de l'image du produit au changement du SELECT à la création de l'enchère
    var creerEncherePicBox = document.getElementById("creerEncherePicBox");

    if(creerEncherePicBox!=null)
    {
        var optChoisi = document.getElementById("optChoisi");

        optChoisi.addEventListener("change", function(){
            creerEncherePicBox.innerHTML = "<img src='"+ nomPic[optChoisi.value] + "' alt='"+ nomPic[optChoisi.value] +"'>";
        })
    }

    function MiseAJourEtatEnchere()
    {
        if (window.XMLHttpRequest)
        {// code for IE7+, Firefox, Chrome, Opera, Safari
            xmlHttpStatut=new XMLHttpRequest();
        }
        else
        {// code for IE6, IE5
            xmlHttpStatut=new ActiveXObject("Microsoft.XMLHTTP");
        }

        xmlHttpStatut.onreadystatechange=function()
        {
            if (xmlHttpStatut.readyState==4 && xmlHttpStatut.status==200)
            {
                var response = xmlHttpStatut.responseXML;

//                console.log(xmlHttpStatut);
                $('#miseActuelle').text(response.childNodes[0].childNodes[0].textContent + ' $CAD');

                if($('#prixFin').val()<response.childNodes[0].childNodes[1].textContent)
                {
                    if(!$('#prixFin').is(':focus') && $('#prixFin').css('background-color')!='rgb(255, 0, 0)')
                    {
                        $('#prixFin').val(response.childNodes[0].childNodes[1].textContent);
//                        $('#prixFin').css('background-color', 'white');
                    }

                    $('#Prixconseil').text(response.childNodes[0].childNodes[1].textContent);
                }
                else
                {
                    $('#prixFin').css('background-color', 'white');
                }


                if(response.childNodes[0].childNodes[2].textContent=='fermée')
                {
                    clearTimeout(tempsRestantTimeout);
                    decompte(0);
                }
                else
                {
                    statutEnchereTimeout = setTimeout(function(){MiseAJourEtatEnchere();},1000);
                }
            }
        }

        var idEnchere = document.getElementById('idEnchere').value;

        xmlHttpStatut.open("GET","index.php?page=statutEnchere&idEnchere=" + idEnchere,true);
        xmlHttpStatut.send();
    }
});

    function AjoutOffre(e)
    {
        e.preventDefault();

        var xmlHttpOffre;

        if (window.XMLHttpRequest)
        {// code for IE7+, Firefox, Chrome, Opera, Safari
            xmlHttpOffre=new XMLHttpRequest();
        }
        else
        {// code for IE6, IE5
            xmlHttpOffre=new ActiveXObject("Microsoft.XMLHTTP");
        }

        var idEnchere = document.getElementById('idEnchere').value;
        var prixFin = document.getElementById('prixFin').value;
        var miseActuelle =  document.getElementById('miseActuelle').innerHTML;
        var aMiseActuelle = miseActuelle.split(" ");

        if(prixFin<=parseFloat(aMiseActuelle[0]))
        {
            $('#prixFin').css('background-color', 'red');
            return false;
        }
        else
        {
            $('#prixFin').css('background-color', 'white');
        }
        xmlHttpOffre.onreadystatechange=function()
        {
            if (xmlHttpOffre.readyState==4 && xmlHttpOffre.status==200)
            {
                var response = xmlHttpOffre.responseXML;

                if(xmlHttpOffre.responseXML==null)
                {
                    return false;
                }

                console.log(response);

                $('#miseActuelle').innerHTML = response.childNodes[0].childNodes[0].textContent + '$CAD';
                $('#prixFin').value = response.childNodes[0].childNodes[1].textContent;

                if(response.childNodes[0].childNodes[2].textContent!='ouverte')
                {
                    clearTimeout(tempsRestantTimeout);
                    decompte(0);
                }
            }
        }



        xmlHttpOffre.open("GET","index.php?page=ajoutOffre&idEnchere=" + idEnchere + "&montant=" + prixFin,true);
        xmlHttpOffre.send();
    }


//});