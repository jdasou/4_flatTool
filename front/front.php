 <?php
//permet d'autoriser l'usage des variables de session
session_start();
$slide="home.php";

//si on est connecté au back
//on place un bouton sur le front pour revenir vers le TB
if(isset($_SESSION['id_compte']))
    {
    $retour="<div><a href=\"../back/back.php\">RETOUR</a></div>";
    }

//on connecte le fichier de fonctions
require_once("../outils/fonctions.php");
$contact="form_contact.php";  

//on établit une connexion avec la BDD
$connexion=connexion();

//on calcule le menu_haut que poyr les pages visibles
$requete="SELECT * FROM pages WHERE visible='1' ORDER BY id_page";
$resultat=mysqli_query($connexion,$requete);
$menu_haut="<nav id=\"menu_haut\">\n<menu class=\"flex\">\n";
while($ligne=mysqli_fetch_object($resultat))
    {
    $menu_haut.="<li><a class=\"color3\" href=\"front.php?action=page&id_page=" . $ligne->id_page . "\">" . strtoupper($ligne->titre_page) . "</a></li>";
    }
$menu_haut.="</menu>\n</nav>\n";



if(isset($_GET['action']))
    {
    $message=array();  
    $color_champ=array();    
    //on switche sur la valeur contenue dans $_GET['action']
    switch($_GET['action'])
        {
        case "contact":    
         
        if(empty($_POST['nom_contact']))
            {
            $message['nom_contact']="<label class=\"pas_ok\">Mets ton nom</label>";   
            $color_champ['nom_contact']="color_champ";
            }
        elseif(empty($_POST['email_contact']))
            {
            $message['email_contact']="<label class=\"pas_ok\">Mets ton email</label>";  
            $color_champ['email_contact']="color_champ";
            }
        elseif(empty($_POST['message_contact']))
            {
            $message['message_contact']="<label class=\"pas_ok\">Mets ton message</label>";  
            $color_champ['message_contact']="color_champ"; 
            }
        else{
            //on enregistre les champs dans la table contacts
            $requete="INSERT INTO contacts SET nom_contact='".$_POST['nom_contact']."',
                                                prenom_contact='".$_POST['prenom_contact']."',
                                                email_contact='".$_POST['email_contact']."',
                                                message_contact='".$_POST['message_contact']."',
                                                date_contact=NOW()";
            $resultat=mysqli_query($connexion,$requete);
            
            $contact="merci.php";
            }
        break;

        case "page":
        //si on reçoit le parametre "id_page" via la méthode GET (lien url)
        if(isset($_GET['id_page']))
            {
            unset($slide);
            $requete="SELECT * FROM pages WHERE id_page='" . $_GET['id_page'] . "'";
            $resultat=mysqli_query($connexion, $requete);
            $ligne=mysqli_fetch_object($resultat);

            $content="<section id=\"page\" class=\"page-".$ligne->id_page." flex pad\">";
            $content.="<h1 class=\"center\">" . $ligne->titre_page . "</h1>";
            if(!empty($ligne->img_page))
                {
                $content.="<figure class=\"illu\"><img src=\"" . str_replace("_s","_m",$ligne->img_page) . "\" alt=\"" . $ligne->titre_page . "\" /></figure>"; 
                }
            $content.="<article class=\"text\">" . $ligne->contenu_page . "</article>";
            $content.="</section>";
            }
        break;
        }     
    }

//permet de relier front.php avec front.html
include("front.html");

//on referme la connexion
mysqli_close($connexion);

?>
