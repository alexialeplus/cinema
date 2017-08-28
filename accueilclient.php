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

    <p class="presentation"> Recherchez un film par... </p>
    <form method="post" action="#">
      <input type="text" placeholder="Date au format AAAA-MM-JJ" name="entry">
      <select name="select">
        <option value="title"> Son titre </option>
        <option value="distrib"> Son distributeur </option>
        <option value="genre"> Son genre </option>
        <option value="date"> Sa date d'affiche</option>
      </select>
      <input type="submit" value="Ok !"> <br/>
    </form>
    
    <p class="presentation"> Par genre et par distributeur... </p>
    <form method="post" action="#">
      <?php include 'resultats_client.php'; ?>
    </form>
  </body>
  </html>