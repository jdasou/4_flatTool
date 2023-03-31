<?php

//===============================
// la fonction connecter() permet de choisir une
// base de données et de s'y connecter.

function connexion()
{
    require_once "connect.php";
    //si numéro de port
    //$connexion = mysqli_connect(SERVEUR,LOGIN,PASSE,BASE,PORT) or die("Error " . mysqli_error($connexion));
    //si pas de numéro de port
    ($connexion = mysqli_connect(SERVEUR, LOGIN, PASSE, BASE)) or
        die("Error " . mysqli_error($connexion));

    return $connexion;
}

//================================
function security($chaine)
{
    $connexion = connexion();
    $security = addcslashes(
        mysqli_real_escape_string($connexion, $chaine),
        "%_"
    );
    mysqli_close($connexion);
    return $security;
}

// ====détecter l'extension du fichier================
function fichier_type($uploadedFile)
{
    $tabType = explode(".", $uploadedFile);
    $nb = sizeof($tabType) - 1;
    $typeFichier = $tabType[$nb];
    if ($typeFichier == "jpeg") {
        $typeFichier = "jpg";
    }
    $extension = strtolower($typeFichier);
    return $extension;
}

//============================================
function redimage($img_src, $img_dest, $dst_w, $dst_h, $quality)
{
    if (!isset($quality)) {
        $quality = 100;
    }
    $extension = fichier_type($img_src);

    // Lit les dimensions de l'image
    $size = @GetImageSize($img_src);
    $src_w = $size[0];
    $src_h = $size[1];
    // Crée une image vierge aux bonnes dimensions   truecolor
    $dst_im = @ImageCreatetruecolor($dst_w, $dst_h);
    imagealphablending($dst_im, false);
    imagesavealpha($dst_im, true);

    // Copie dedans l'image initiale redimensionnée

    if ($extension == "jpg") {
        $src_im = @ImageCreateFromjpeg($img_src);
        imagecopyresampled(
            $dst_im,
            $src_im,
            0,
            0,
            0,
            0,
            $dst_w,
            $dst_h,
            $src_w,
            $src_h
        );

        // Sauve la nouvelle image
        @ImageJpeg($dst_im, $img_dest, $quality);
    }
    if ($extension == "png") {
        $src_im = @ImageCreateFrompng($img_src);
        imagecopyresampled(
            $dst_im,
            $src_im,
            0,
            0,
            0,
            0,
            $dst_w,
            $dst_h,
            $src_w,
            $src_h
        );

        // Sauve la nouvelle image
        @ImagePng($dst_im, $img_dest, 0);
    }
    if ($extension == "gif") {
        $src_im = @ImageCreateFromgif($img_src);
        imagecopyresampled(
            $dst_im,
            $src_im,
            0,
            0,
            0,
            0,
            $dst_w,
            $dst_h,
            $src_w,
            $src_h
        );

        // Sauve la nouvelle image
        @ImagePng($dst_im, $img_dest, 0);
    }
    if ($extension == "webp") {
        $src_im = @ImageCreateFromwebp($img_src);
        imagecopyresampled(
            $dst_im,
            $src_im,
            0,
            0,
            0,
            0,
            $dst_w,
            $dst_h,
            $src_w,
            $src_h
        );

        // Sauve la nouvelle image
        @ImageWebp($dst_im, $img_dest, 0);
    }

    // Détruis les tampons
    @ImageDestroy($dst_im);
    @ImageDestroy($src_im);
}

//===============================
function format_date($date, $format)
{
    if ($format == "anglais") {
        $tab_date = explode("/", $date);
        $date_au_format =
            $tab_date[2] . "-" . $tab_date[1] . "-" . $tab_date[0];
    }
    if ($format == "francais") {
        $tab_date = explode("-", $date);
        $date_au_format =
            $tab_date[2] . "/" . $tab_date[1] . "/" . $tab_date[0];
    }
    return $date_au_format;
}
//================================

function login($login, $pass)
{
    $connexion = connexion();
    //on fait une requette SQL qui verifie que le login et le passe existe dans la table comptes

    $requete =
        "SELECT*FROM comptes WHERE login_compte='" .
        $login .
        "' AND pass_compte=SHA1('" .
        $pass .
        "')";
    $resultat = mysqli_query($connexion, $requete);
    $nb_ligne = mysqli_num_rows($resultat);
    if ($nb_ligne == 1) {
        //si requete SELECT on se pose la question
        //si une ou plusieur lignes son attendues dans le resultat
        $ligne = mysqli_fetch_object($resultat);

        //on stocke en session les valeurs qui nous interessent
        $_SESSION["id_compte"] = $ligne->id_compte;
        $_SESSION["nom_compte"] = $ligne->nom_compte;
        $_SESSION["prenom_compte"] = $ligne->prenom_compte;
        $_SESSION["img_compte"] = $ligne->img_compte;

        //on redirige vers le back
        header("location:../back/back.php");
    }
    mysqli_close($connexion);
}

?>
