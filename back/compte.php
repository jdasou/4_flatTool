<?php
//on teste si la variable de session S_SESSION['id_compte'] existe
if(isset($_SESSION['id_compte']))
{
    $titre="Gestion des comptes";
    //on connecte le fichier de fonctions
    require_once("../outils/fonctions.php");

    //on établit une connexion avec la BDD
    $connexion=connexion();

    if(isset($_GET['cas']))
    {
        //on switche sur la valeur contenue dans $_GET['action']
        switch($_GET['cas'])
        {
            case "avertir_compte":

                if(isset($_GET['id_compte']))
                {
                    $confirmation="<p>Voulez-vous supprimer le message du compte n°" . $_GET['id_compte'] . "</p>";
                    $confirmation.="<a href=\"back.php?action=compte&cas=supprimer_compte&id_compte=" . $_GET['id_compte'] . "\">OUI</a>&nbsp;&nbsp;&nbsp;";
                    $confirmation.="<a href=\"back.php?action=compte\">NON</a>";
                }

                break;

            case "supprimer_compte":

                if(isset($_GET['id_compte'])) {
                    //on veriifier si ce n est pas le dernier compte autoriser en fessant une requette

                    $requete = "SELECT COUNT(*) AS nb_compte FROM comptes";
                    $resultat = mysqli_query($connexion, $requete);
                    $ligne = mysqli_fetch_object($resultat);
                    //si c est le dernier compte de la table (1 seul ligne dans la table )
                    if ($ligne->nb_compte = 1) {
                        $confirmation = "<p class=\"pas_ok\"> le dernier compte autoriser ne peut pas etre suppirmé</p>";

                    } else {
                        //$requete="DELETE FROM compte WHERE id_contact='" . $_GET['id_contact'] . "'";
                        $resultat = mysqli_query($connexion, $requete);
                        $confirmation = "<p class=\"ok\">Le compte a bien été supprimé</p>";
                    }

                }

                break;

            case "recharger_compte":

                break;

            case "modifier_compte":

                break;
        }
    }

    //on selectionne tous les comptes triés par date de création
    $requete="SELECT * FROM comptes ORDER BY id_compte ASC";
    $resultat=mysqli_query($connexion,$requete);
    //tant que $resultat contient des lignes (uplets)
    $content="";
    while($ligne=mysqli_fetch_object($resultat))
    {
        $content.="<details class=\"tab_results\">";

        $content.="<summary>";
        $content.="<div>". $ligne->id_compte ."</div>";
        $content.="<div>". $ligne->login_compte ."</div>";
        $content.="<div>". $ligne->email_compte ."</div>";
        $content.="<div><a href=\"back.php?action=compte&cas=recharger_compte&id_compte=" . $ligne->id_compte . "\">modifier</a></div>";
        $content.="<div><a href=\"back.php?action=compte&cas=avertir_compte&id_compte=" . $ligne->id_compte . "\">supprimer</a></div>";
        $content.="</summary>";

        $content.="<div>".$ligne->nom_compte . " " . $ligne->prenom_compte ."</div>";

        $content.="</details>";
    }

    //on referme la connexion
    @mysqli_close($connexion);
}
else{
    //l'utilisateur n'est pas autorisé
    header("Location:../log/login.php");
}

?>
