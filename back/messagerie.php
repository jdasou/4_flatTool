 <?php
//on teste si la variable de session S_SESSION['id_compte'] existe
if(isset($_SESSION['id_compte']))
    {
    $titre="Gestion de la messagerie";
    //on connecte le fichier de fonctions
    require_once("../outils/fonctions.php");

    //on établit une connexion avec la BDD
    $connexion=connexion();

    if(isset($_GET['cas']))
        {
        //on switche sur la valeur contenue dans $_GET['action']
        switch($_GET['cas'])
            {
            case "afficher_message":
            
            //on selectionne tous les contacts triés par date décroissante
            $requete="SELECT * FROM contacts ORDER BY date_contact DESC";
            $resultat=mysqli_query($connexion,$requete);
            //tant que $resultat contient des lignes (uplets)
            $content="";
            while($ligne=mysqli_fetch_object($resultat))
                {
                $content.="<details>"; 

                $content.="<summary>"; 
                $content.="<div>". $ligne->date_contact ."</div>"; 
                $content.="<div>".$ligne->nom_contact . " " . $ligne->prenom_contact ."</div>"; 
                $content.="<div>". $ligne->email_contact ."</div>"; 
                $content.="<div><a href=\"#\">supprimer</a></div>"; 
                $content.="</summary>"; 

                $content.="<div>" . $ligne->message_contact . "</div>";

                $content.="</details>"; 
                }

            
            break;

            case "avertir_message":

            break;

            case "supprimer_message":

            break;
            }     
        }
 
    //on referme la connexion
    mysqli_close($connexion);
    }
else{
    //l'utilisateur n'est pas autorisé
    header("Location:../log/login.php");
    }

?>
