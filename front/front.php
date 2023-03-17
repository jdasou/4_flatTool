
<?php
session_start();

if(isset($_SESSION['id_compte']))
{
    $retour="<div><a href=\"../back/back.php\">RETOUR</a></div>";
}

//on connect le fichier de fonctions 
require_once("../outils/fonctions.php");

$content="home.php";
$contact="form_contact.php";

//on etablie une connection avec la base de donnée 
$connexion=connexion();



// formulaire de contact

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
               $message['nom_contact'] ="<label class=\"pas_ok\">met ton nom</label>";
               $color_champ['nom_contact']="color_champ";

          }
          elseif(empty($_POST['email_contact']))
          {
               $message['email_contact'] ="<label class=\"pas_ok\">met ton email</label>";
               $color_champ['email_contact']="color_champ";
          }
          elseif(empty($_POST['message_contact']))
          {
               $message['message_contact'] ="<label class=\"pas_ok\">met ton message</label>";
               $color_champ['message_contact']="color_champ";
          }
         else{
               //on enrgiste les champs dans la table contact
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

          //si on reçoit le parametre page via la methode get(lien url)
          if(isset($_GET['page']))
        {
        $content = $_GET['page'] . ".php";
        //ex : formule.php
        }
         
          break;
     }

}







    //permet de relier font.php avec front.html
    include("front.html");


//on ferme la connexion
mysqli_close($connexion)
    ?>


    