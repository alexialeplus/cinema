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
    <p id="presentation"> Cherchez un membre par... </p>
    <form method="post" action="#">
      <input type="text" placeholder="..." name="entry">
      <select name="select">
        <option value="prenom"> Prénom </option>
        <option value="nom"> Nom </option>
        <option value="nom et prenom"> Nom et prénom </option>
      </select>
      <input type="submit" value="Ok !"> <br/>
    </form>
    <?php include "resultats_admin.php"; ?>
  </body>
</html>