<?php
//on teste si la variable de session S_SESSION['id_compte'] existe
if (isset($_SESSION["id_compte"])) {
    $titre = "Gestion des pages";
    $form = "form_page.html";

    $action_form = "inserer_page";
    //pour cocher pars defaut visible a oui
    $check[1]="checked";

    if (isset($_GET["cas"])) {
        //on switche sur la valeur contenue dans $_GET['action']
        switch ($_GET["cas"]) {
            case "inserer_page":
                if (empty($_POST["titre_page"])) {
                    $confirmation =
                        "<p class=\"pas_ok\">Le titre est obligatoire</p>";
                } elseif (empty($_POST["contenu_page"])) {
                    $confirmation =
                        "<p class=\"pas_ok\">Le contenu est obligatoire</p>";

                } else {
                    //on enregistre le compte dans la table compte
                    $requete="INSERT INTO pages SET titre_page='".security($_POST['titre_page'])."',
                                                contenu_page='".security($_POST['contenu_page'])."',
                                                visible='".$_POST['visible']."',
                                                date_page=NOW()";
                    $resultat=mysqli_query($connexion,$requete);

                    //on confirme l enregistrement
                    $confirmation =
                        "<p class=\"ok\">la page a bien été enregister</p>";

                    //on vide le formulaire
                    foreach ($_POST as $cle => $valeur) {
                        //unset supprime une variable
                        unset($_POST[$cle]);
                    }
                }

                break;
            case "avertir_page":
                if (isset($_GET["id_page"])) {
                    $confirmation =
                        "<p class='ok'>Voulez-vous supprimer la page n°" .
                        $_GET["id_page"] .
                        "</p>";
                    $confirmation .=
                        "<a class='yes' href=\"back.php?action=page&cas=supprimer_page&id_page=" .
                        $_GET["id_page"] .
                        "\">OUI</a>&nbsp;&nbsp;&nbsp;";
                    $confirmation .=
                        "<a class='non' href=\"back.php?action=page\">NON</a>";
                }

                break;

            case "supprimer_page":
                if (isset($_GET["id_page"])) {

                        $requete =
                            "DELETE FROM pages WHERE id_page='" .
                            $_GET["id_page"] .
                            "'";
                        $resultat= mysqli_query($connexion, $requete);
                        $confirmation =
                            "<p class=\"ok\">La page a bien été supprimé</p>";
                    }


                break;

            case "recharger_page":
                $action_form =
                    "modifier_page&id_page=" . $_GET["id_page"];
                if (isset($_GET["id_page"])) {
                    $requete =
                        "SELECT * FROM pages WHERE id_page='" .
                        $_GET["id_page"] .
                        "'";
                    $resultat = mysqli_query($connexion, $requete);
                    $ligne = mysqli_fetch_object($resultat);
                    $_POST["titre_page"] = $ligne->titre_page;
                    $_POST["contenu_page"] = $ligne->contenu_page;


                }
                break;

            case "modifier_page":
                if (isset($_GET["id_page"])) {
                    if (empty($_POST["titre_page"])) {
                        $confirmation =
                            "<p class='pas_ok'>Le titre  est obligatoire</p>";
                    } elseif (empty($_POST["contenu_page"])) {
                        $confirmation =
                            "<p class='pas_ok'>Le contenu est obligatoire</p>";

                    } else {
                        $requete =
                            "UPDATE pages SET 
                        titre_page='" .
                            security($_POST["titre_page"]) .
                            "',
                        contenu_page='" .
                            security($_POST["contenu_page"]) .
                            "',
                            visible='".$_POST["visible"]."'";


                        $requete .=
                            " WHERE id_page='" . $_GET["id_page"] . "'";
                        $resultat = mysqli_query($connexion, $requete);
                    }

                    foreach ($_POST as $cle => $valeur) {
                        unset($_POST[$cle]);
                    }

                    $confirmation =
                        "<p class='ok'>la page a bien été modifié ! </p> ";
                }

                break;
        }
    }

    //on selectionne tous les comptes triés par date de création
     //on selectionne tous les pages triés par date de création
    $requete="SELECT * FROM pages ORDER BY id_page ASC";
    $resultat=mysqli_query($connexion,$requete);
    //tant que $resultat contient des lignes (uplets)
    $content="";
    while($ligne=mysqli_fetch_object($resultat))
        {
        $content.="<details class=\"tab_results\">";

        $content.="<summary>";
        $content.="<div>". $ligne->id_page ." - ". $ligne->titre_page ."</div>";
        if($ligne->visible==1)
            {
            $content.="<div class=\"actions\"><a href=\"back.php?action=page&cas=changer_etat&etat=0&id_page=" . $ligne->id_page . "\"><span class=\"dashicons dashicons-visibility\"></span></a>";
            }
        else{
            $content.="<div class=\"actions\"><a href=\"back.php?action=page&cas=changer_etat&etat=1&id_page=" . $ligne->id_page . "\"><span class=\"dashicons dashicons-hidden\"></span></a>";
            }
        $content.="<a href=\"back.php?action=page&cas=recharger_page&id_page=" . $ligne->id_page . "#form_back\"><span class=\"dashicons dashicons-admin-customizer\"></span></a>";
        $content.="<a href=\"back.php?action=page&cas=avertir_page&id_page=" . $ligne->id_page . "\"><span class=\"dashicons dashicons-no\"></span></a></div>";
        $content.="</summary>";

        $content.="<div class=\"all\">Créée le : ".$ligne->date_page ."<br><br>".$ligne->contenu_page ."</div>";

        $content.="</details>";
        }

} else {
    //l'utilisateur n'est pas autorisé
    header("Location:../log/login.php");
}

?>
