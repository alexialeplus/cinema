<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8" />
    <title> My cinema </title>
    <link rel="stylesheet" type="text/css" href="style.css"/>
    <link href="https://fonts.googleapis.com/css?family=Playfair+Display:400,400i,700i&amp;subset=cyrillic,latin-ext" rel="stylesheet"> 
    <link href="https://fonts.googleapis.com/css?family=Lobster&amp;subset=cyrillic,latin-ext" rel="stylesheet">
  </head>

  <body>
    <a href="index.html"><img src="home.png" alt="Bouton accueil" /></a>
    <h1> My_cinema </h1>
    <div id="result">
    <?php include "profil_film.php"; ?> <br/>
    <button type="button"> Ajouter un avis sur ce film </button> <br/>
    <form method="post" action="#" class="form">
    <input type="text" name="id_membre" placeholder="Votre id membre">
    <input type="text" name="opinion" placeholder="Votre avis">
    <input type="submit" value="Ok !">
    </form>
    </div>
  <script type="text/javascript" src="dynamic.js"></script>
  </body>
</html>