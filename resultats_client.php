<?php
                                              //Connexion à la base de données
function connect()
{              
  $connect = mysqli_connect('localhost', 'root', '', 'my_cinema');
  if (mysqli_connect_errno())
  {
    echo "Erreur de connexion: " . mysqli_connect_error();
  }
  genre_distrib($connect);
  title($connect);
}

                                              //Récupération des entrées et des valeurs


function genre_distrib($connect)              //Moteur de recherche par genre & distributeur
{

  $sql_list_genre = "SELECT nom FROM tp_genre ORDER BY nom";    //Création du select genre
  $request_genre = $connect->query($sql_list_genre);

  echo "<select name='list_genre'>";
  while($result_genre = $request_genre->fetch_assoc())
  {
    echo "<option value='" . $result_genre['nom'] . "'> " . $result_genre['nom'] . "</option>";
  }
  echo "</select>";

  $sql_list_distrib = "SELECT nom FROM tp_distrib ORDER BY nom";  //Création du select distributeur
  $request_distrib = $connect->query($sql_list_distrib);

  echo "<select name='list_distrib'>";
  while($result_distrib = $request_distrib->fetch_assoc())
  {
    echo "<option value='" . $result_distrib['nom'] . "'> " . $result_distrib['nom'] . "</option>";
  }
  echo "</select> <input type='submit' value='Ok !'> <br/>";

  if(isset($_POST['list_genre']) && isset($_POST['list_distrib']))    //Exécution de la requête
  {
    $genre = $_POST['list_genre'];
    $distrib = $_POST['list_distrib'];
    $sql = "SELECT titre, resum, id_film, tp_genre.nom AS 'genre', tp_distrib.nom AS 'distributeur' FROM tp_film INNER JOIN tp_genre ON tp_film.id_genre = tp_genre.id_genre INNER JOIN tp_distrib ON tp_film.id_distrib = tp_distrib.id_distrib WHERE tp_genre.nom = '$genre' AND tp_distrib.nom = '$distrib'";

    $request = $connect->query($sql);
    if(mysqli_num_rows($request) !== 0)                               //Affichage des résultats
    {
      echo "<div id='result'> Résultats trouvés pour votre recherche: <br/> <br/>";
      while($result = $request->fetch_assoc())
      {
        echo "<a href='description_film.php?titre=" . $result['titre'] . "&amp;genre=" . $result['genre'] ."&amp;resum=". urlencode($result['resum']) . "&amp;id_film=" . $result['id_film'] . "'> * " . $result['titre'] . " * </a> <br/> Genre: " . $result['genre'] . "<br/> Résumé: " . $result['resum'] . "<br/> <br/>";
      }
      echo "</div>";
    }
    else
    {
      echo "Aucun résultat ne correspond à votre recherche";
    }
  }
}

function title($connect)            //Moteur de recherche par titre, genre, distributeur & date
{
	if(isset($_POST["select"]) && isset($_POST["entry"]) && $_POST['entry'] !== "")
	{
  	$select = $_POST["select"];
  	$entry = $_POST["entry"];

  	switch($select)
  	{
    	case "title":
      	$sql = "SELECT titre, resum, id_film, tp_genre.nom AS 'genre' FROM tp_film INNER JOIN tp_genre ON tp_film.id_genre = tp_genre.id_genre WHERE titre LIKE '%$entry%'";
      	client($select, $entry, $sql, $connect);
      break;
    	case "genre":
      	$sql = "SELECT titre, resum, id_film, tp_genre.nom AS 'genre' FROM tp_film INNER JOIN tp_genre ON tp_film.id_genre = tp_genre.id_genre WHERE tp_genre.nom LIKE '%$entry%'";
      	client($select, $entry, $sql, $connect);
      break;
    	case "distrib":
      	$sql = "SELECT titre, resum, id_film, tp_genre.nom AS 'genre', tp_distrib.nom AS 'distributeur' FROM tp_film INNER JOIN tp_genre ON tp_film.id_genre = tp_genre.id_genre INNER JOIN tp_distrib ON tp_film.id_distrib = tp_distrib.id_distrib WHERE tp_distrib.nom LIKE '%$entry%'";
      	client($select, $entry, $sql, $connect);
      break;
    	case "date":
        $sql = "SELECT titre, resum, id_film, tp_genre.nom AS 'genre' FROM tp_film INNER JOIN tp_genre ON tp_film.id_genre = tp_genre.id_genre WHERE date_debut_affiche <= '$entry' AND date_fin_affiche >= '$entry'";
      	client($select, $entry, $sql, $connect);
      break;
  	}
	}
}

function client($select, $entry, $sql,$connect)         //Fonction qui exécute requête et affiche résultats
{
  if(strlen($entry) >= 3)
  {
    $request = $connect->query($sql);
    if(mysqli_num_rows($request) !== 0)               //S'il n'y a pas aucun résultat
    {
      echo "<div id='result'> Résultats trouvés pour la recherche '" . $entry . "': <br/> <br/>";
      while($result = $request->fetch_assoc())
      {
        echo "<a href='description_film.php?titre=" . $result['titre'] . "&amp;genre=" . $result['genre'] ."&amp;resum=". urlencode($result['resum']) . "&amp;id_film=" . $result['id_film'] . "'> * " . $result['titre'] . " * </a> <br/> Genre: " . $result['genre'] . "<br/> Résumé: " . $result['resum'] . "<br/> <br/>";
      }
      echo "</div>";
    }
    else
    {
      echo "Aucun résultat ne correspond à votre recherche";
    }
  }
  else
  {
    echo "Votre requête doit comporter 3 caractères minimum";
  }
}

connect();
?>