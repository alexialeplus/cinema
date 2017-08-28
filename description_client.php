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
    <?php include "profil_client.php"; ?>
    <button type="button"> Ajouter une entrée à l'historique du client </button> <br/>
    <form method="post" action="#" class="form">
      <input type="text" placeholder="Spécifier le nom du film" name="title_entry">
      <input type="submit" value="Ok !"> <br/>
    </form>

    <button type="button"> Ajouter/modifier l'abonnement </button> <br/>
    <form method="post" action="#" class="form">
    <p> Spécifiez le nom de l'abonnement :
      <input type="text" placeholder="GOLD, VIP, pass day, Classic, malsch" name="update_abo">
      <input type="submit" value="Ok !"> <br/>
    </form>
    
    <button> Supprimer l'abonnement </button> <br/>
    <form method="post" action="#" class="form">
      <input type="submit" name="del_button" value="Ok !"> <br/>
    </form>
    </div>
    <script type="text/javascript" src="dynamic.js"></script>
  </body>
</html>