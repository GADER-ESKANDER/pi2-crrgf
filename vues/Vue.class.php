<?php
/**
 * @classe Vue Vue.class.php "classes/Vue.class.php"
 * @version 0.0.1
 * @date 2014-10-17
 * @author Eric Revelle
 * @brief Affiche les différentes parties communes aux pages.
 * @details Permet d'afficher les parties communes de toutes les pages
 * comme l'entete, le pied de page, la naviagtion et les asides.
 */
class Vue {

	public static function head($sTitre = "", $sDescription = "", $sNomStyle = "", $sLienScript = "") {

		echo "
			<!DOCTYPE html>
			<!--[if lt IE 7]><html class=\"no-js lt-ie9 lt-ie8 lt-ie7\"> <![endif]-->
			<!--[if IE 7]><html class=\"no-js lt-ie9 lt-ie8\"> <![endif]-->
			<!--[if IE 8]><html class=\"no-js lt-ie9\"> <![endif]-->
			<!--[if gt IE 8]><!-->
			<html class=\"no-js\">
			<!--<![endif]-->
			<head>
				<base href=\"index.php\">
				<meta charset=\"utf-8\">
				<meta http-equiv=\"X-UA-Compatible\" content=\"IE=edge,chrome=1\">
				<title>".$sTitre = ($sTitre == '') ? 'Arts aux Enchères' : $sTitre.' - Arts aux Enchères'; echo "</title>
				<meta name=\"description\" content=\"".$sDescription = ($sDescription == '') ? 'Site de vente d\'oeuvres d\'art d\'artistes divers' : $sDescription; echo "\">
				<meta name=\"viewport\" content=\"width=device-width, initial-scale=1\">
				<link rel=\"stylesheet\" href=\"css/bootstrap.css\">
				<link rel=\"stylesheet\" href=\"css/bootstrap-theme.css\">
				<link rel=\"stylesheet\" href=\"css/main.css\">
				".$style = ($sNomStyle == '') ? '' : '<link rel="stylesheet" href="css/'.$sNomStyle.'">'; echo "
				<script src=\"js/vendor/modernizr-2.6.2-respond-1.1.0.min.js\"></script>
				".$script = ($sLienScript == '') ? '' : '<script rel="text/javascript" src="'.$sLienScript.'"></script>'; echo "
			</head>
			<body>
				<!--[if lt IE 7]>
				<p class=\"browsehappy\">La version de votre navigateur est <strong>désuète</strong>.
				Pour une expérience optimale, il est recommandé de le <a href=\"http://browsehappy.com/\">mettre à jour</a>.</p>
				<![endif]-->
		";

	}

    public static function header() {

        echo "
			<!-- Entete du document -->
			<header class=\"entete-document container-fluid\">
				<div class=\"container-fluid\">
					<section class=\"row\">
						<div class=\"col-sm-11 col-sm-offset-1\">
							<div class=\"row\">
								<!-- Logo & menu burger -->
								<div class=\"col-sm-2 text-center\">
									<a href=\"index.php\"><img src=\"img/logo-175x75.png\" height=\"75\" width=\"175\" alt=\"Logo Arts aux Enchères\"></a>
									<button type=\"button\" class=\"navbar-toggle\" data-toggle=\"collapse\" data-target=\".navbar-menu\">
										<span class=\"sr-only\">Bascule de navigation</span>
										<span class=\"icon-bar\"></span>
										<span class=\"icon-bar\"></span>
										<span class=\"icon-bar\"></span>
									</button>
								</div><!-- /Logo & menu burger -->
								<!-- Zone de recherche -->
								<div class=\"col-xs-8 col-xs-offset-2 col-sm-6 col-md-6 col-md-offset-1\">
									<form class=\"navbar-form\" action=\"?page=oeuvres-encheres\" method=\"POST\" role=\"search\">
										<div class=\"input-group\">
											<input type=\"search\" name=\"txt\" class=\"form-control\" value=\"".$q = ( isset($_POST['txt']) && $_POST['txt'] != '' ) ? $_POST['txt'] : '' ; echo "\" placeholder=\"Je cherche\">
											<span class=\"input-group-btn\">
												<input class=\"btn btn-default\" type=\"submit\" name=\"cmd\" value=\"Rechercher\">
											</span>
										</div>
									</form>
								</div><!-- /Zone de recherche -->
							</div>
						</div>
					</section>
				</div>
			</header><!-- /Entete du document -->
		";

    }

    public static function nav() {

        echo "
			<nav class=\"navbar\" role=\"navigation\">
				<div class=\"container-fluid\">
					<section class=\"row\">
						<!-- navbar-collapse -->
						<div class=\"collapse navbar-collapse navbar-menu\">
							<div class=\"col-md-5 \">
								<ul class=\"nav navbar-nav\">
									<li><a href=\"?page=oeuvres-encheres\">Enchères</a></li>
									<li><a href=\"?page=artistes\">Artistes</a></li>
									<li><a href=\"?page=contact\">Contact</a></li>
								</ul>
							</div>
							<div class=\"col-md-7\">
								<ul class=\"nav navbar-nav navbar-right\">";

        //Si non connecte
        if( !isset($_SESSION['idUser']) ) {
            echo "
									<li><a href=\"?page=utilisateur&action=connexion\">Se connecter</a></li>
									<li><a href=\"?page=utilisateur&action=inscription\">S'inscrire</a></li>
									";
            //Lorsque connecte
        } else {
            echo"
									<li><a href=\"?page=commentaires\">Commentaires</a></li>
									<li class=\"dropdown\">
										<a href=\"#\" class=\"dropdown-toggle\" data-toggle=\"dropdown\">Mes ventes <b class=\"caret\"></b></a>
										<ul class=\"dropdown-menu\">
											<li><a href=\"?page=gestionEnchere\">Mes enchères</a></li>
											<li><a href=\"?page=gestionOeuvres\">Mes oeuvres</a></li>
											<li><a href=\"?page=oeuvres-vendues\">Oeuvres vendues</a></li>
										</ul>
									</li>
									<li><a href=\"#\">Mes achats</a></li>
									<li class=\"dropdown\">
										<a href=\"#\" class=\"dropdown-toggle\" data-toggle=\"dropdown\"><span class=\"sr-only\">Mon compte</span><span class=\"glyphicon glyphicon-user\"></span></a>
										<ul class=\"dropdown-menu\">
											<li><a href=\"?page=utilisateur&action=parametres\">Paramètres</a></li>
											<li><a href=\"?page=utilisateur&action=deconnecter\">Déconnecter</a></li>
										</ul>
									</li>
									";
        }//Fin Lorsque connecte
        echo"
								</ul>
							</div>
						</div><!-- /.navbar-collapse -->
					</section>
				</div>
			</nav>
			<main class=\"container-fluid\">
				<!-- row principale -->
				<div class=\"row\">
		";

    }

    public static function footer($sNomScript = "") {

        echo "
				</div><!-- /row princiaple -->
			</main>
			<!-- Pied de page du document -->
			<footer class=\"container-fluid\">
				<aside class=\"row\">
					<section class=\"col-xs-offset-1 col-sm-5 col-sm-offset-1 col-md-3\">
						<ul class=\"list-unstyled\">
							<li><a href=\"?page=oeuvres-encheres\">Trouver une oeuvre</a></li>
							<li><a href=\"?page=artistes\">Trouver un artiste</a></li>
							<li><a href=\"?page=contact\">Nous joindre</a></li>
						</ul>
					</section>
					<section class=\"col-xs-offset-1 col-sm-6 col-sm-offset-0 col-md-4\">
						<ul class=\"list-unstyled\">
							<li><a href=\"?page=reglements&section=confidentialite\">Politique de confidentialité</a></li>
							<li><a href=\"?page=reglements&section=non-responsabilite\">Avis de non-responsabilité</a></li>
							<li><a href=\"?page=utilisateur&action=connexion\">Connexion</a></li>
						</ul>
					</section>
					<!-- Reseaux sociaux -->
					<section class=\"col-sm-12 col-sm-offset-0 col-md-offset-0 col-md-4\">
						<div class=\"row\">
							<ul class=\"list-inline text-center\">
								<li><a href=\"https://www.facebook.com/skander.gader\"><img src=\"img/icones/logo-facebook.png\" alt=\"logo Facebook \" width=\"48\" height=\"48\" /></a></li>
								<li><a href=\"https://www.youtube.com/channel/UC2T0Ish3GMFzTRflE9bfIUQ\"><img src=\"img/icones/logo-youtube.png\" alt=\"logo Youtube\" width=\"48\" height=\"48\" /></a></li>
								<li><a href=\"http://gader-eskander.blogspot.ca/2013_10_01_archive.html\"><img src=\"img/icones/logo-blogger.png\" alt=\"logo Blogger\" width=\"48\" height=\"48\" /></a></li>
							</ul>
						</div>
						<div class=\"droits row\">
							<p class=\"text-center\">Arts aux Enchères &copy;2014 Tous droits réservés.</p>
						</div>
					</section><!-- /Reseaux sociaux -->
				</aside>
			</footer><!-- /Pied de page du document -->
			<!-- Scripts javascript -->
			<script src=\"http://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js\"></script>
			<script>
				window.jQuery || document.write('<script src=\"js/vendor/jquery-1.11.0.min.js\"><\/script>')
			</script>
			<script src=\"js/vendor/bootstrap.min.js\"></script>
			<script src=\"js/main.js\"></script>
			".$script = ( $sNomScript == '' ) ? '' : '<script type="text/javascript" src="'.$sNomScript.'"></script>'; echo "
			<script src=\"js/plugins.js\"></script>
			<script src=\"js/utilisateur.js\"></script>
			<!-- Google Analytics: change UA-XXXXX-X to be your site's ID. -->
			<!-- <script>
				( function(b, o, i, l, e, r) {
					b.GoogleAnalyticsObject = l;
					b[l] || (b[l] = function() {
						(b[l].q = b[l].q || []).push(arguments)
					});
					b[l].l = +new Date;
					e = o.createElement(i);
					r = o.getElementsByTagName(i)[0];
					e.src = 'http://www.google-analytics.com/analytics.js';
					r.parentNode.insertBefore(e, r)
				}(window, document, 'script', 'ga'));
				ga('create', 'UA-XXXXX-X');
				ga('send', 'pageview');
			</script> -->
		</body>
		</html>
		";

    }

	public static function carousel($aImages = array(array('src' => 'img/image1.jpg', 'alt' => 'Image1'),array('src' => 'img/image2.jpg', 'alt' => 'Image2'))) {

		if ( count($aImages) ) {

			echo "<article id=\"carousel\" class=\"carousel slide hidden-xs\" data-ride=\"carousel\">
			    <ol class=\"carousel-indicators\">";

			foreach ( $aImages AS $iImage => $aImage ) {

				if ( $iImage == 0 ) {

					echo "
					<li data-target=\"#carousel\" data-slide-to=\"".$iImage."\" class=\"active\"></li>";

				} else {

					echo "
					<li data-target=\"#carousel\" data-slide-to=\"".$iImage."\" class=\"\"></li>";

				}

			}

			echo "
				</ol>
				<section class=\"carousel-inner\">";

			foreach ( $aImages AS $iImage => $aImage ) {

				if ( $iImage == 0 ) {

					echo "
						<article class=\"item active\">
			            	<img src=\"img/carousel/".$aImage['src']."\" alt=\"".$aImage['alt']."\" height=\"350\" width=\"auto\">
			        	</article>";

				} else {

					echo "
						<article class=\"item\">
				            <img src=\"img/carousel/".$aImage['src']."\" alt=\"".$aImage['alt']."\" height=\"350\" width=\"auto\">
				        </article>";

				}

			}

			echo "
				</section>
			</article>";

		}

	}



	public static function alerte($aMsg) {

		if ( count($aMsg) && isset($aMsg['msg']) ) {

			echo "
				<div class=\"alert alert-".$aMsg['type']." alert-dismissible\" role=\"alert\">
					<button type=\"button\" class=\"close\" data-dismiss=\"alert\">
						<span aria-hidden=\"true\">&times;</span><span class=\"sr-only\">Fermer</span>
					</button>
					<p>".$aMsg['msg']."</p>
				</div>";

		}

	}

}