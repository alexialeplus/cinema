<?php
                                //Connexion à la base de données
function connect()
{              
  $connect = mysqli_connect('localhost', 'root', '', 'my_cinema');
  if (mysqli_connect_errno())
  {
    echo "Erreur de connexion: " . mysqli_connect_error();
  }
  infos($connect);
}


function infos($connect)      //Affiche infos du film + ajout d'un avis avec l'ID Membre
{
  echo "Titre: " . $_GET['titre'] . "<br/> Genre: " . $_GET['genre'] . "<br/> ID: " . $_GET['id_film'] . "<br/> <br/> Résumé: " . $_GET['resum'];
  $id_film = $_GET['id_film'];

  if(isset($_POST['id_membre']) && isset($_POST['opinion']))
  {
    if(is_string($_POST['id_membre']) && is_string($_POST['opinion']) && $_POST['id_membre'] !== "" && $_POST['opinion'] !== "")
    {
      $id_membre = $_POST['id_membre'];
      $opinion = $_POST['opinion'];

      $add_col = "ALTER TABLE tp_historique_membre ADD avis VARCHAR(1000)";     //Création de la colonne si elle n'existe pas
      $request = $connect->query($add_col);

      $sql = "INSERT INTO tp_historique_membre VALUES ($id_membre, $id_film , (SELECT CURRENT_DATE()), '$opinion')";
      $request_insert = $connect->query($sql);

      if($request_insert === FALSE)
      {
        echo "Erreur";
      }
      else
      {
        echo "<br/> <br/> Votre avis a été ajouté avec succès, merci !";
      }
    }

    else
    {
      echo "<br/> <br/> Merci de remplir convenablement les champs";
    }
  }
}
connect();
?>