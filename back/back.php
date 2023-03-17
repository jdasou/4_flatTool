
<?php
//permet d'autoriser l'usage des variable de session

session_start();
//on teste si la variable de sessions $_SESSION['id_compte']

if (isset($_SESSION['id_compte'])){





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
             case "logout":
                 session_destroy();
                 //detruit toutes les varibles de SESSION qui on eté sauvegarder
                 header("Location:../index.php");
                 //on rediriqe vers la page d'acceuil du site
             break;


           case "messagerie":

            break;
         }

    }


        //permet de relier font.php avec front.html
        include("back.html");


    //on ferme la connexion
    mysqli_close($connexion);
    }
else{
    //l'utilisateur n'est pas autoriser
    header("Location:../log/login.php");
}
    ?>


    