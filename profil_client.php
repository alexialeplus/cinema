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


function infos($connect)                    //Affichage des infos du client
{
  $entire_name = $_GET['nom'] . " " . $_GET['prenom'];     //Récupération données de la précédente requête
  echo "Prénom et nom: " . $_GET['prenom'] . " " . $_GET['nom'] . "<br/>";

  $sql = "SELECT LEFT(date_naissance, 10) AS 'date_naissance', email, id_membre FROM tp_fiche_personne INNER JOIN tp_membre ON tp_fiche_personne.id_perso = tp_membre.id_fiche_perso WHERE CONCAT(nom, ' ', prenom) = '$entire_name'";

  $request = $connect->query($sql);
  while($result = $request->fetch_assoc())
  {
    echo "Date de naissance: " . $result['date_naissance'] . "<br/> Email: " . $result['email'] . "<br/> <br/>";
    $id_membre = $result['id_membre'];
  }

  historic($connect, $entire_name, $id_membre);
}


function historic($connect, $entire_name, $id_membre)   //Fonction pour ajouter une entrée à l'historique
{
  $sql = "SELECT titre, tp_membre.id_membre FROM tp_fiche_personne INNER JOIN tp_membre ON tp_fiche_personne.id_perso = tp_membre.id_fiche_perso INNER JOIN tp_historique_membre ON tp_membre.id_membre = tp_historique_membre.id_membre INNER JOIN tp_film ON tp_historique_membre.id_film = tp_film.id_film WHERE CONCAT(nom,' ', prenom) = '$entire_name'";

  echo "Historique des films: ";
  
  $request = $connect->query($sql);
  while($result = $request->fetch_assoc())
  {
    echo "'" . $result['titre'] . "', ";
  }

  if(isset($_POST['title_entry']))
  {
    $title_entry = $_POST['title_entry'];
    $insert = "INSERT INTO tp_historique_membre (id_membre, id_film, date) VALUES ($id_membre, (SELECT id_film FROM tp_film WHERE titre = '$title_entry'), (SELECT CURRENT_DATE))";

    $request_insert = $connect->query($insert);

    if($request_insert === FALSE)
    {
      echo "<br /> <br /> Titre inconnu";
    }
    else
    {
      echo " <br/> <br/> Titre ajouté à l'historique du client ! <br/>" ;
    }
  }
  subs($connect, $entire_name, $id_membre);
}


function subs($connect, $entire_name, $id_membre)      //Affichage de l'abonnement du client + ajout/modification de l'abonnement
{

  $sql = "SELECT  tp_membre.id_membre, tp_abonnement.nom, tp_abonnement.resum, tp_abonnement.prix, tp_abonnement.duree_abo FROM tp_fiche_personne INNER JOIN tp_membre ON tp_fiche_personne.id_perso = tp_membre.id_fiche_perso INNER JOIN tp_abonnement ON tp_membre.id_abo = tp_abonnement.id_abo WHERE CONCAT(tp_fiche_personne.nom, ' ', tp_fiche_personne.prenom) = '$entire_name'";

  $request = $connect->query($sql);
  if(mysqli_num_rows($request) === 0)
  {
    echo "<br/> Aucun abonnement <br/>";
  }
  else {
    while($result = $request->fetch_assoc())
    {
      echo " <br/> <br/> Abonnement: " . $result['nom'] . " (" . $result['resum'] .", prix: " . $result['prix'] . " euros, durée: " . $result['duree_abo'] . " jour(s)) <br/>";
    }
  }

  if(isset($_POST['update_abo']) && strlen($_POST['update_abo']) !== 0 && isset($id_membre))
  {
    $up_abo = $_POST['update_abo'];
    $update = "UPDATE tp_membre SET id_abo = (SELECT id_abo FROM tp_abonnement WHERE nom = '$up_abo') WHERE id_membre = $id_membre";

    $request_up = $connect->query($update);

    if($request_up === FALSE)
    {
      echo "<br /> <br /> Abonnement inconnu";
    }
    else
    {
      echo " <br/> <br/> Abonnement du client ajouté/modifié ! <br/>" ;
    }
  }

  delete($connect, $entire_name, $id_membre);
}


function delete ($connect, $entire_name, $id_membre)      //Suppression de l'abonnement 
{
  if(isset($_POST['del_button']))
  {
    $delete = "UPDATE tp_membre SET id_abo = NULL WHERE id_membre = $id_membre";

    $request_del = $connect->query($delete);

    if($request_del === FALSE)
    {
      echo "<br/> Action impossible";
    }
    else
    {
      echo "<br/> Abonnement suprimé ! <br/>";
    }
  }
}

connect();
?>