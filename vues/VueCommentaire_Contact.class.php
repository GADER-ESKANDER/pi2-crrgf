<?php
/**
 * @classe VueCommentaire_Contact VueCommentaire_Contact.class.php "classes/VueCommentaire_Contact.class.php"
 * @version 0.0.1
 * @date 2014-10-25
 * @author Gader Eskander
 * @brief Affiche des Commentaires.
 * @details Permet d'afficher le contenu des Commentaires pour un enchère.
 */
 
class VueCommentaire_Contact {

	
	/**
	 * Côté administrateur - Afficher la liste de tous les Commentaires et les contact 
	 * @param array $aCommentaires tableau d'objets Cmmentaire
	 */
	public static function admi_afficherCommentaire_contact($aCommentaires, $aContacts) {
		// Inclu les morceaux de pages, dont les metas, l'entete, la navigation .
		Vue::head('Commentaires et Contactes', 'Page pour gérer les commentaires et les contacts ','commentaire.css');
		Vue::header('Ma recherche');
		Vue::nav();
		
		
		echo '
				<article id="Commont_Contact">
					<!-- Nav tabs -->
					<ul class="nav nav-tabs Tab_commentaires" role="tablist">
						<li class="active">
							<a href="#Tous_commentaires" role="tab" data-toggle="tab"> Commentaires </a>
						</li>
						<li>
							<a href="#Tous_Contacts" role="tab" data-toggle="tab"> Contacts </a>
						</li>
					</ul>
					<!-- Tab panes -->
					<article class="tab-content">
						<article id="Tous_commentaires" class="tab-pane active">
							<article class="media icon_commenter">
								<article class="media-body">
									<!-- Début Affichage_commentaires-->
									<table class="table table-bordered  table-striped table-condensed">
										<thead>
											<tr>
												<th class="bg-info text-center"> Nom </th>
												<th class="bg-info text-center"> Commentaires </th>
												<th class="bg-info text-center"> Abus </th>
												<th class="bg-info text-center"> Date </th>
												<th class="bg-info text-center"> Supprimer </th>
											</tr>
										</thead>
										<tbody>';
											for ($iComm = 0; $iComm < count($aCommentaires); $iComm++)
											{										
												$IdUtilisateur = $aCommentaires[$iComm] -> getIdUtilisateur();
												$IdCommentaire = $aCommentaires[$iComm] -> getIdCommentaire();
												$oUtilisateur = new Utilisateur($IdUtilisateur);
												$oUtilisateur-> rechercherUnUtilisateur();
												$Prenom= $oUtilisateur ->getPrenom() ;
												$Nom= $oUtilisateur ->getNom() ;
												echo '<tr ><td class=\" text-center\">'.$Nom .' '.$Prenom.'</td>';
												echo '<td>'.$aCommentaires[$iComm] -> getCorpsCommentaire().'</td>';
												echo "<td class='Danger text-center'>".$aCommentaires[$iComm] -> getAbus()."</td>";
												echo '<td class=\" text-center\">'.$aCommentaires[$iComm] -> getDateCommentaire().'</td>';
												echo "<td class=\" text-center\">
														<button class=\"btn-default\" type=\"submit\">
													 	 <a class=\"btnSupprimer\" href=\"#\" data-idCommetaire=\"".$IdCommentaire."\"> Supprimer </a>											 	 
													 </button>
													  </td>
													 </tr>";
											}
									echo'</tbody>
									</table>
								</article>
							</article>
						</article>
						<!-- Fin Affichage_commentaires-->

						<!-- Début Affichage Tous_Contacts-->
						<article id="Tous_Contacts" class="tab-pane">
							<table class="table table-bordered  table-striped table-condensed">
								<thead>
									<tr>
										<th class="bg-success text-center ">Nom</th>
										<th class="bg-success text-center">Messages</th>
										<th class="bg-info text-center"> Date </th>
										<th class="bg-success text-center">Supprimer</th>
									</tr>
								</thead>
								
								<tbody>';
										for ($iCont = 0; $iCont < count($aContacts); $iCont++)
										{
											$IdContact = $aContacts[$iCont] -> getIdContact();
											$Prenom= $aContacts[$iCont] ->getPrenomContact() ;
											$Nom= $aContacts[$iCont] ->getNomContact() ;
									echo '	<tr><td>'.$Nom .' '.$Prenom.'</td>';
										  echo '<td>'.$aContacts[$iCont] -> getMessage().'</td>';
										  echo '<td class=\" text-center\">'.$aContacts[$iCont] -> getDateContact().'</td>';
										  echo "<td class=\"text-center\">
												<button class=\"btn-default\" type=\"submit\">
											 	  <a class=\"btnSupprimContact\" href=\"#\"data-idContact=\"".$IdContact."\"> Supprimer </a>	
											 	</button>
											    </td>
											</tr>";
										}

							echo'</tbody>
							</table>
						</article>
					<!-- Fin Affichage Tous_Contacts-->
				</article>
			</article>
		';
	Vue::footer('js/commentaires.js');
		
	}

}
