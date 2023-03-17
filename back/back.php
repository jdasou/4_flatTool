
<?php
session_start();

//on connect le fichier de fonctions 
require_once("../outils/fonctions.php");



//on etablie une connection avec la base de donnée 
$connexion=connexion();



// formulaire de contact

if(isset($_GET['action']))
{
     
     //on switche sur la valeur contenue dans $_GET['action']
     switch($_GET['action'])

     {
       case "messagerie":
        
        break;
     }

}


    //permet de relier font.php avec front.html
    include("back.html");


//on ferme la connexion
mysqli_close($connexion)
    ?>


    