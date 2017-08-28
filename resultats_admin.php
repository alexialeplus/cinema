<?php
                                              //Connexion à la base de données
function connect()
{              
  $connect = mysqli_connect('localhost', 'root', '', 'my_cinema');
  if (mysqli_connect_errno())
  {
    echo "Erreur de connexion: " . mysqli_connect_error();
  }
  name($connect);
}

                                              //Récupération des entrées et des valeurs

function name($connect)
{
	if(isset($_POST["select"]) && isset($_POST["entry"]) && $_POST['entry'] !== "")
	{
  	$select = $_POST["select"];
  	$entry = $_POST["entry"];

  	switch($select)
  	{
    	case "prenom":
      	$sql = "SELECT nom, prenom FROM tp_fiche_personne WHERE prenom LIKE '%$entry%'";
      	admin($select, $entry, $sql, $connect);
      break;
    	case "nom":
      	$sql = "SELECT nom, prenom FROM tp_fiche_personne WHERE nom LIKE '%$entry%'";
      	admin($select, $entry, $sql, $connect);
      break;
    	case "nom et prenom":
      	$sql = "SELECT CONCAT(nom,' ', prenom) AS 'Nom prenom' FROM tp_fiche_personne WHERE CONCAT(nom,' ', prenom) LIKE '%$entry%'";
      	admin($select, $entry, $sql, $connect);
      break;
  	}
	}
}

function admin($select, $entry, $sql,$connect)      //Fonction qui exécute la requête et affiche les résultats
{
  if(strlen($entry) >= 3)
  {
    $request = $connect->query($sql);
    if(mysqli_num_rows($request) !== 0)
    {
      echo "<div id='result'> Résultats trouvés pour la recherche '" . $entry . "': <br/> <br/>";
      while($result = $request->fetch_assoc())
      {
        if(isset($result['nom']) || isset($result['prenom']))
        {
          echo "<a href='description_client.php?nom=" . $result['nom'] . "&amp;prenom=" . $result['prenom'] . "'>" . $result['nom'] . " ". $result['prenom']. "</a>" . "<br/>";
        }
        elseif(isset($result['Nom prenom']))
        {
          $part = explode(" ", $result['Nom prenom']);
          echo "<a href='description_client.php?nom=" . $part[0] . "&amp;prenom=" . $part[1] . "'>" . $part[0] . " ". $part[1] . "</a>" . "<br/>";
        }  
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