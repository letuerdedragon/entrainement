<?php
//sa me servira pour stocker la commande
session_start();

?>


<!DOCTYPE html>
<html>

<head class="w3-amber">

<style>
 /*pour la navigation bar*/ 
 ul {
  list-style-type: none;
  margin: 0;
  padding: 0;
  overflow: hidden;
  background-color: #333;
}

li {
  float: left;
  border-right:1px solid #bbb;
}

li:last-child {
  border-right: none;
}

li a {
  display: block;
  color: white;
  text-align: center;
  padding: 14px 16px;
  text-decoration: none;
}

li a:hover:not(.active) {
  background-color: #111;
}

.active {
  background-color: #04AA6D;
}
  
  /*aider par internet "https://www.alsacreations.com/article/lire/930-css3-media-queries.html"
  si c'est plus petit on a cette taille decran */
  @media screen and (max-width: 600px) {
  .bloc {
    display:block;
    clear:both;
  }
  body {
    font-size: 14px;
  }
}

  /*pour les moyen ecrant */
  @media screen and (min-width: 601px) and (max-width: 1024px) {
  .bloc {
    display:block;
    clear:both;
  }
  body {
    font-size: 16px;
  }
}

/*pour les grand ecrant */
@media screen and (min-width: 1025px) {
  .bloc {
    display:block;
    clear:both;
  }
  body {
    font-size: 18px;
  }
}
</style>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<br>
<?php
if (isset($_GET['submitted']) && $_GET['submitted'] == 1){

    echo $_SESSION["succes_envoie"];
    echo " et tout a etait sauvegarder,";
}
else{
    echo $_SESSION["succes_envoie"];
    echo "rien n'a marcher, ";}

$fichier = 'comande.txt';
file_put_contents($fichier, "");    
//on suprimer les info  pour eviter les probleme de commande
?>

<a href="article.php">revenir sur la page inisial</a>
<h1><p class='w3-text-lime w3-black'>recapituler des commande</p></h1><br>
</head>
<body class="w3-amber">
<?php
 echo $_SESSION['commande'];

?>

</body>
</html>