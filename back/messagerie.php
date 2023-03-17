
<?php
//permet d'autoriser l'usage des variable de session


//on teste si la variable de sessions $_SESSION['id_compte']

if (isset($_SESSION['id_compte'])){

    $titre="gestion de la messagerie";





    //on connect le fichier de fonctions
    require_once("../outils/fonctions.php");



    //on etablie une connection avec la base de donnée
    $connexion=connexion();



    // formulaire de contact

    if(isset($_GET['cas']))
    {

         //on switche sur la valeur contenue dans $_GET['action']
         switch($_GET['cas'])

         {
             case "afficher_message":
                 //on selectionne tous les contact trier pars date décroisssant

                 $requette="SELECT * FROM contacts ORDER BY date_contact DESC";
                 $resultat=mysqli_query($connexion,$requette);

                 //tant que $resultat contien des ligne (uplets =ligne d'enregistrement)
                $content="";
                 while ($ligne=mysqli_fetch_object($resultat)){



                 }

             break;


             case "avertir_message":

             break;

             case "supprimer_message":

             break;

               case "";
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


    