<?php
//on teste si la variable de session S_SESSION['id_compte'] existe
if (isset($_SESSION['id_compte'])) {
    $titre = "Gestion des comptes";


    if (isset($_GET['cas'])) {
        //on switche sur la valeur contenue dans $_GET['action']
        switch ($_GET['cas']) {

            case "avertir_compte":

                if (isset($_GET['id_compte'])) {
                    $confirmation = "<p>Voulez-vous supprimer le compte n°" . $_GET['id_compte'] . "</p>";
                    $confirmation .= "<a href=\"back.php?action=compte&cas=supprimer_&id_compte=" . $_GET['id_compte'] . "\">oui</a>&nbsp;&nbsp;&nbsp;";
                    $confirmation .= "<a href=\"back.php?action=compte\">non</a> ";
                }
                break;

            case "supprimer_compte":
                if (isset($_GET['id_compte'])) {
                    //on vérifie que ce n'est pas le dernier compte autorisé
                    $requete = "SELECT COUNT(*) AS nb_compte FROM comptes ";
                    $resultat = mysqli_query($connexion, $requete);
                    $ligne = mysqli_fetch_object($resultat);
                    //
                    if ($ligne->nb_compte == 1) {
                        $confirmation = "<p class=\"pas_ok\">Le dernier compte autorisé ne peut pas être supprimé</p>";
                    } else {
                        $requete = "DELETE FROM comptes WHERE id_comptes='" . $_GET['id_compte'] . "'";
                        $resultat = mysqli_query($connexion, $requete2);
                        $confirmation = "<p class=\"pas_ok\">Le compte a bien été supprimé</p>";
                    }
                }

                break;

            case "recharger_compte":

                break;

            case "modifier_compte":
                break;
        }
    }
    //on selectionne tous les comptes triés par date de creation
    $requete = "SELECT * FROM comptes ORDER BY id_compte ASC";
    $resultat = mysqli_query($connexion, $requete);
    //tant que $resultat contient des lignes (uplets)

    // j 'initialise la varibla $content
    $content = "";
    while ($ligne = mysqli_fetch_object($resultat)) {
        // bien metttre le point apres $content pour pas le reinitialiser
        $content .= "<details class=\"tab_results\">";

        $content .= "<summary>";
        $content .= "<div>" . $ligne->id_compte . "</div>";


        $content .= "<div>" . $ligne->login_compte . "</div>";
        $content .= "<div>" . $ligne->email_compte . "</div>";
        $content .= "<div><a href=\"back.php?action=compte&cas=recharger_compte&id_compte=" . $ligne->id_compte . "\">modifier</a></div>";
        $content .= "<div><a href=\"back.php?action=compte&cas=avertir_compte&id_compte=" . $ligne->id_compte . "\">supprimer</a></div>";
        $content .= "</summary>";

        $content .= "<div>" . $ligne->nom_compte . " " . $ligne->prenom_compte . "</div>";

        $content .= "</details>";
    }

} else {
    //l'utilisateur n'est pas autorisé
    header("Location:../log/login.php");
}
