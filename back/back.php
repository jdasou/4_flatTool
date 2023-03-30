 <?php
//permet d'autoriser l'usage des variables de session
session_start();

//on teste si la variable de session $_SESSION['id_compte']
//existe
if(isset($_SESSION['id_compte']))
    {
    //on connecte le fichier de fonctions
    require_once("../outils/fonctions.php");

    //on établit une connexion avec la BDD
    $connexion=connexion();

    if(isset($_GET['action']))
        {

        //on switche sur la valeur contenue dans $_GET['action']
        switch($_GET['action'])
            {
            case "logout":
            //détruit toutes les variables de SESSION qui ont été enregistrées
            session_destroy();
            //on redirige vers la page d'accueil du site
            header("Location:../index.php");
            break;

            case "messagerie":

            include("messagerie.php");

            break;

            case "compte";

            include('compte.php');

            break;
            }     
        }


    //permet de relier front.php avec front.html
    include("back.html");

mysqli_close($connexion);
    }
//on referme la connexion

else{
    //l'utilisateur n'est pas autorisé
    header("Location:../log/login.php");
    }


