<!DOCTYPE HTML>
<html lang="fr">
<head>
<title>Flattools</title>
<!--charset=utf-8 permet de gérer les caractères accuentués-->
<meta http-equiv="content-type" content="text/html; charset=utf-8" />
<link href="../css/root.css" rel="stylesheet" type="text/css" />
<link href="../css/style.css" rel="stylesheet" type="text/css" />
<link href="../css/responsive.css" rel="stylesheet" type="text/css" />
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Roboto:wght@100;300;500;900&display=swap" rel="stylesheet">
<!--permet de detecter la résolution du client-->
<meta name="viewport" content="width=device-width, user-scalable=no" />
</head>
<body>
  <header id="header" class="flex w1 bgcolor4">
    <img id="logo" src="../images/logo.png" alt="Flattool - Landing page" />
    <div class="flex">
      <nav>
        <menu class="flex">
          <li><a class="color3" href="index.php?page=home">HOME</a></li>
          <li><a class="color3" href="index.php?page=features">FEATURES</a></li>
          <li><a class="color3" href="index.php?page=flattool">FLATTOOL</a></li>
          <li><a class="color3" href="index.php?page=formules">FORMULES</a></li>
        </menu>
      </nav>
      <figure class="flex">
        <a href="#"><img src="../images/flickr.png" alt="Flickr" /></a>
        <a href="#"><img src="../images/stumble.png" alt="Stumble" /></a>
        <a href="#"><img src="../images/facebook.png" alt="Facebook" /></a>
        <a href="#"><img src="../images/Twitter.png" alt="Twitter" /></a>
      </figure>
      <p class="flex">CALL NOW<img src="../images/phone.png" alt="Phone" /><a href="tel:1-800-123-456" class="color2">1-800-123-456</a></p>
    </div>
  </header>
  <main>

    <?php
    if(isset($_GET['page'])){
      $section=$_GET['page'] . ".php";
      }
    else{
      $section="home.php";
      }
    include($section);
    ?>

    <section id="blog" class="flex pad">
      <section class="w2">
        <h1>WHAT CUSTOMERS <span class="color2">SAY</span></h1>
        <article class="w1">
          <p>Et vehicula suspendisse fermentum. Repudiandae animi! Eiusmod porttitor minim integer mus laborum, nisl.</p>
          <p class="color2">Jane Leonarde, <span class="color1">Themeforest</span></p>
        </article>
        <article class="w1">
          <p>Et vehicula suspendisse fermentum. Repudiandae animi! Eiusmod porttitor minim integer mus laborum, nisl.</p>
          <p class="color2">Jane Leonarde, <span class="color1">Themeforest</span></p>
        </article>
        <article class="w1">
          <p>Et vehicula suspendisse fermentum. Repudiandae animi! Eiusmod porttitor minim integer mus laborum, nisl.</p>
          <p class="color2">Jane Leonarde, <span class="color1">Themeforest</span></p>
        </article>
      </section>
      <section class="w2">
        <h1>LEARN <span class="color2">MORE</span></h1>
        <figure class="w1">
          <img class="w1" src="../images/blog.jpg" alt="blog">
        </figure>
      </section>
    </section>

    <section id="news" class="bgcolor2 pad">
      <h1 class="center color4">CONTACTEZ-NOUS</h1>
      <form action="" method="post" class="flex pad">
        <div class="w2">
          <input id="nom" class="w1" required placeholder="Nom [obligatoire]" type="text" name="nom" value="">
          <label for="nom">Nom</label>
        </div>

        <div class="w2">
          <input id="prenom" class="w1" placeholder="Prénom [facultatif]" type="text" name="prenom" value="">
          <label for="prenom">Prénom</label>
        </div>

        <div class="w1">
          <input id="email" required class="w1" placeholder="Email [obligatoire]" type="email" name="email" value="">
          <label for="email">Email</label>
        </div>

        <div class="w1">
          <textarea id="message" required class="w1" placeholder="Message [obligatoire]" name="message"></textarea>
          <label for="message">Message</label>
        </div>

        <input class="bgcolor3" type="submit" name="submit" value="SEND">
      </form>
    </section>

  </main>
  <footer id="footer" class="flex pad">
    <p>Copyright &copy; 2013, all right reserved</p>
    <nav>
      <menu class="flex">
        <li><a>Privacy policy</a></li>
        <li><a>Terms et conditions</a></li>
      </menu>
    </nav>
  </footer>

</body>
</html>
