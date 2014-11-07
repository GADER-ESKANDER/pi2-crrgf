<?php
/**
 * @classe VueAchats VueAchats.class.php "vues/VueAchats.class.php"
 * @version 0.0.1
 * @date 2014-11-04
 * @author Eric Revelle
 * @brief Affiche les achats.
 * @details Permet d'afficher les enchères auxquelles un utilisateur à participé.
 */
class VueAchats {

    public static function tous(array $aMsg = array()) {

        Vue::head();
        Vue::header();
        Vue::nav();

        Vue::alerte($aMsg);

        $oEnchereGagnees = new EnchereGagnee();
        var_dump($oEnchereGagnees->getEncheresGagneesParIdUtilisateur());

        Vue::footer();

    }

}