<?php
//on teste si la variable de session S_SESSION['id_compte'] existe
if(isset($_SESSION['id_compte']))
{
    $titre="Gestion des comptes";
    $form="form_compte.html";

    $action_form = "inserer_compte";


    if(isset($_GET['cas']))
    {
        //on switche sur la valeur contenue dans $_GET['action']
        switch($_GET['cas'])
        {
            case "inserer_compte":
                if (empty($_POST['nom_compte'])){
                    $confirmation="<p class=\"pas_ok\">Le nom est obligatoire</p>";
                }

                elseif (empty($_POST['email_compte'])){
                    $confirmation="<p class=\"pas_ok\">L'email est obligatoire</p>";

                }
                elseif (empty($_POST['login_compte'])){
                    $confirmation="<p class=\"pas_ok\">Le login est obligatoire</p>";

                }
                elseif (empty($_POST['pass_compte'])){
                    $confirmation="<p class=\"pas_ok\">Le mot de passe est obligatoire</p>";

                }
                else{
                    //on enregistre le compte dans la table compte
                    $requete="INSERT INTO comptes SET nom_compte='".security($_POST['nom_compte'])."',
                                                      prenom_compte='".security($_POST['prenom_compte'])."',  
                                                      email_compte='".security($_POST['email_compte'])."',  
                                                      login_compte='".security($_POST['login_compte'])."',  
                                                      pass_compte=SHA1('".$_POST['pass_compte']."')";

                    $resultat=mysqli_query($connexion,$requete);


                    //on confirme l enregistrement
                    $confirmation="<p class=\"pas_ok\">le compte a bien été enregister</p>";


                    //on vide le formulaire
                    foreach ($_POST AS $cle => $valeur){
                        //unset supprime une variable
                        unset($_POST[$cle]);
                    }

                }

            break;
            case "avertir_compte":

                if(isset($_GET['id_compte']))
                {
                    $confirmation="<p>Voulez-vous supprimer le compte n°" . $_GET['id_compte'] . "</p>";
                    $confirmation.="<a href=\"back.php?action=compte&cas=supprimer_compte&id_compte=" . $_GET['id_compte'] . "\">OUI</a>&nbsp;&nbsp;&nbsp;";
                    $confirmation.="<a href=\"back.php?action=compte\">NON</a>";
                }

                break;

            case "supprimer_compte":

                if(isset($_GET['id_compte']))
                {
                    //on vérifie que ce n'est pas le dernier compte autorisé
                    $requete="SELECT COUNT(*) AS nb_compte FROM comptes";
                    $resultat=mysqli_query($connexion,$requete);
                    $ligne=mysqli_fetch_object($resultat);
                    //si c'est le dernier compte de la table (1 seule ligne dans la table)
                    if($ligne->nb_compte==1)
                    {
                        $confirmation="<p class=\"pas_ok\">Le dernier compte autorisé ne peut pas être supprimé</p>";
                    }
                    else{
                        $requete2="DELETE FROM comptes WHERE id_compte='" . $_GET['id_compte'] . "'";
                        $resultat2=mysqli_query($connexion,$requete2);
                        $confirmation="<p class=\"ok\">Le compte a bien été supprimé</p>";
                    }
                }

                break;

            case "recharger_compte":
                $action_form="modifier_compte&id_compte=" . $_GET['id_compte'];
                if(isset($_GET['id_compte'])){
                    $requete = "SELECT * FROM comptes WHERE id_compte='".$_GET['id_compte']."'";
                    $resultat=mysqli_query($connexion, $requete);
                    $ligne = mysqli_fetch_object($resultat);
                    $_POST['nom_compte']=$ligne->nom_compte;
                    $_POST['prenom_compte']=$ligne->prenom_compte;
                    $_POST['email_compte']=$ligne->email_compte;
                    $_POST['login_compte']=$ligne->login_compte;
                }
                break;

            case "modifier_compte":
                if(isset($_GET['id_compte'])){
                    if(empty($_POST['nom_compte']))
                    {
                        $confirmation="<p class='pas_ok'>Le nom du compte est obligatoire</p>";
                    }
                    elseif (empty($_POST['email_compte']))
                    {
                        $confirmation="<p class='pas_ok'>Le champ email est obligatoire</p>";
                    }
                    elseif (empty($_POST['login_compte']))
                    {
                        $confirmation="<p class='pas_ok'>Le champ login est obligatoire</p>";
                    }
                    else
                    {
                        $requete="UPDATE comptes SET 
                        nom_compte='".security($_POST['nom_compte'])."',
                        prenom_compte='".security($_POST['prenom_compte'])."',
                        email_compte='".security($_POST['email_compte'])."',
                        login_compte='".security($_POST['login_compte'])."'";

                        if(!empty($_POST['pass_compte']))
                        {
                            // modified password
                            $requete.=",pass_compte=SHA1('".$_POST['pass_compte']."')";
                        }
                        $requete.=" WHERE id_compte='".$_GET['id_compte']."'";
                        $resultat=mysqli_query($connexion, $requete);
                    }

                    foreach ($_POST as $cle => $valeur)
                    {
                        unset($_POST[$cle]);
                    }

                    $confirmation = "<p class='ok'>Le compte a bien été modifié ! </p> ";
                }

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

}
else{
    //l'utilisateur n'est pas autorisé
    header("Location:../log/login.php");
}

?>
