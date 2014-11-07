<?php
/**
 * Created by Xiang Feng Han
 * User: fenix
 * Date: 14-10-24
 * Time: 23:12
 */

class VueOffre
{
    public static function afficherListeOffres($aOffres, $sMsg)
    {
        Vue::head('Liste des offres','Arts aux enchères');
        Vue::header();
        Vue::nav();

        echo "<div class=\"container\"><h1>Historique des offres</h1>".
             "<p>[Les 10 derniers enregistrements]</p>".
             "<a class='btn-default btn' href='index.php?page=detailsEnchere&idEnchere=".$_GET['idEnchere']."'>retour</a>";

        if(count($aOffres)>0)
        {
            echo "<table class='table tableListeOffre'>";
            echo "<tr><td>Nom</td><td>Prix de l'offre</td><td>Date</td></tr>";



            if(count($aOffres)>10)
            {
                for($i=count($aOffres)-1,$counter=0; $i>0,$counter<10; $i--,$counter++)
                {
                    echo "<tr><td>".substr_replace($aOffres[$i]->getBidder()->getNom(),'****',1,-1)."</td>".
                        "<td>".$aOffres[$i]->getMontant()."</td>".
                        "<td>".$aOffres[$i]->getDateOffre()."</td>".
                        "</tr>";
                }
                echo "</table></div>";
            }
            else
            {
                foreach($aOffres as $oOffre)
                {
                    echo "<tr><td>".substr_replace($oOffre->getBidder()->getNom(),'****',1,-1)."</td>".
                        "<td>".$oOffre->getMontant()."</td>".
                        "<td>".$oOffre->getDateOffre()."</td>".
                        "</tr>";
                }
                echo "</table></div>";
            }

        }
        else
        {
            echo "<p>".$sMsg."</p>";
        }



        Vue::footer();
    }
}

?>