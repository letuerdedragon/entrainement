<?php
//sa me servira pour stocker la commande
session_start();

$_SESSION["succes_envoie"]="";//message de si sa était bien envoier
$_SESSION['commande'] = "";//pour le moment elle est vide
$_SESSION['comande_envoi'] ="";//mesage de notre mail
$_SESSION['prix'] = 0;//la somme
?>
<?php
// Vérifier si le formulaire
if($_SERVER['REQUEST_METHOD'] == 'GET') {
  if(isset($_GET['submit'])) {
    
    //les nom de mes article
    $nom ="nom";
    $prix="prix";
    $nb_article="nb";
    //debut de message pour savoir qui c'est
    $_SESSION['commande'] .= $_GET["nom_client"]."  ".$_GET["prenom_client"]."<br>".$_GET["com_client"]."<br>" ."veut commander:"."<br>";
    $_SESSION['comande_envoi'] .= $_GET["nom_client"]."  ".$_GET["prenom_client"]."\n".$_GET["com_client"]."\n" ."veut commander:\n";
    
    for ($i=1; $i < 83; $i++) { 
      $nom = $nom.strval($i);
      $prix =$prix.strval($i);
      $nb_article = $nb_article.strval($i);

      if($_GET[$nb_article] >0){
        //message sur le site
        $_SESSION['commande'] =$_SESSION['commande']."nombre d'article:".$_GET[$nb_article]."          ";
        $_SESSION['commande'] =$_SESSION['commande']."nom:".$_GET[$nom]."          ";
        $_SESSION['commande'] =$_SESSION['commande']."son prix:".$_GET[$prix]."<br>";
         
        //commande sur un fichier
        $_SESSION['comande_envoi'] =$_SESSION['comande_envoi']."nombre d'article:".$_GET[$nb_article]."          ";
        $_SESSION['comande_envoi'] =$_SESSION['comande_envoi']."nom:".$_GET[$nom]."          ";
        $_SESSION['comande_envoi'] =$_SESSION['comande_envoi']."son prix:".$_GET[$prix]."\n";

      }
      //reset de ces valeur pour pas avoir de probleme après comme le rajour de nombre nb1.2 = nb12
      $nom ="nom";
      $prix="prix";
      $nb_article="nb";

    }
    //envoie de mail
    // Construisez le contenu de l'e-mail
    $subject = "Nouvelle commande";
    //changer
    $message = $_SESSION['comande_envoi'];

    // Adresse e-mail du destinataire
    $to = "budner6@gmail.com";

    // Adresse e-mail de l'expéditeur
    $from = "budner6@gmail.com";

    // Chemin du fichier à joindre
    $fichier = 'comande.txt';
    // Convertir les données en format JSON
    $jsonData = json_encode($message);
    // Écrire les données dans le fichier
    file_put_contents($fichier, $jsonData);
    
    // Lecture du contenu du fichier
    $contenuFichier = file_get_contents($fichier);

    // Encodage du contenu du fichier en base64
    $contenuFichierEncode = base64_encode($contenuFichier);

    // En-têtes de l'e-mail
    $boundary = md5(time());
    $entete = "From: " . $from . "\r\n";
    $entete .= "Reply-To: " . $email . "\r\n";
    $entete .= "MIME-Version: 1.0\r\n";
    $entete .= "Content-Type: multipart/mixed; boundary=\"" . $boundary . "\"\r\n";
    $entete .= "This is a multi-part message in MIME format.\r\n\r\n";
    $corps = "--" . $boundary . "\r\n";
    $corps .= "Content-Type: text/plain; charset=utf-8\r\n";
    $corps .= "Content-Transfer-Encoding: 8bit\r\n\r\n";
    $corps .= $message . "\r\n\r\n";
    $corps .= "--" . $boundary . "\r\n";
    $corps .= "Content-Type: application/pdf; name=\"" . basename($fichier) . "\"\r\n";
    $corps .= "Content-Transfer-Encoding: base64\r\n";
    $corps .= "Content-Disposition: attachment; filename=\"" . basename($fichier) . "\"\r\n\r\n";
    $corps .= $contenuFichierEncode . "\r\n\r\n";
    $corps .= "--" . $boundary . "--";

    // Ajout de la pièce jointe aux en-têtes
    //$corps .= $contenuFichierEncode;

    // Envoi de l'e-mail avec la pièce jointe
    if (mail($to, $subject, $corps, $entete)) {
      $_SESSION["succes_envoie"]= "L'e-mail avec la pièce jointe a été envoyé avec succès.";
    } else {
      $_SESSION["succes_envoie"]="Erreur lors de l'envoi de l'e-mail avec la pièce jointe.";
    }
    
    //on a verifier tout et donc on peut aller sur un page 
    header("Location: validation.php?submitted=1");
    exit();
  }
}
?>




<!DOCTYPE html>
<html>

<head class="w3-amber">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js" ></script>
<script>
//grosis une case du tableau lors du pasage de la souri et retresi quand elle n'est plus sur la case
$(document).ready(function() {
  $("tr").hover(function() {
    $(this).css("font-size", "initial");//ici pour grosir
  }, function() {
    $(this).css("font-size", "initial");
  });
});

//chacher une balise, et fair aparétre une autre
$(document).ready(function(){     
    //Dès qu'on clique sur #b1, on applique hide() au titre
    $(".bouton2").click(function(){//next
      //on va metre des condition  
      if($('.div1').is(':visible')){
          $(".div2").toggle();//afficher
          $(".div1").toggle();//cacher
        }
        else if($('.div2').is(':visible')){
          $(".div3").toggle();//afficher
          $(".div2").toggle();//cacher
        }
        else if($('.div3').is(':visible')){
          $(".div4").toggle();//afficher
          $(".div3").toggle();//cacher
        }
        else if($('.div4').is(':visible')){
          $(".div5").toggle();//afficher
          $(".div4").toggle();//cacher
        }
        else if($('.div5').is(':visible')){
          $(".div6").toggle();//afficher
          $(".div5").toggle();//cacher
        }
        else if($('.div6').is(':visible')){
          $(".div7").toggle();//afficher
          $(".div6").toggle();//cacher
        }
        else if($('.div7').is(':visible')){
          $(".div8").toggle();//afficher
          $(".div7").toggle();//cacher
        }
        else if($('.div8').is(':visible')){
          $(".div9").toggle();//afficher
          $(".div8").toggle();//cacher
        }
        //sinon c'est le div9 et lui il a pas de precedent 
          //on fait rien
    });

    $(".bouton1").click(function(){//precedent
      //on va metre des condition
        if($('.div2').is(':visible')){
          $(".div1").toggle();//afficher
          $(".div2").toggle();//cacher
        }
        else if($('.div3').is(':visible')){
          $(".div2").toggle();//afficher
          $(".div3").toggle();//cacher
        }
        else if($('.div4').is(':visible')){
          $(".div3").toggle();//afficher
          $(".div4").toggle();//cacher
        }
        else if($('.div5').is(':visible')){
          $(".div4").toggle();//afficher
          $(".div5").toggle();//cacher
        }
        else if($('.div6').is(':visible')){
          $(".div5").toggle();//afficher
          $(".div6").toggle();//cacher
        }
        else if($('.div7').is(':visible')){
          $(".div6").toggle();//afficher
          $(".div7").toggle();//cacher
        }
        else if($('.div8').is(':visible')){
          $(".div7").toggle();//afficher
          $(".div8").toggle();//cacher
        }
        else if($('.div9').is(':visible')){
          $(".div8").toggle();//afficher
          $(".div9").toggle();//cacher
        }
        //sinon c'est le div1 et lui il a pas de precedent 
          //on fait rien
    });

});

$(document).ready(function() {
  $('.cache').hide();
});

</script>


<style>
/*pour que les image soit tous de la meme taille*/
img{
  width: 150px;
  height: 150px;
}


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

/*centrer un bouton*/
.center {
  margin: 0;
  position: absolute;
  top: 40%;
  left: 25%;
  -ms-transform: translate(-50%, -50%);
  transform: translate(-50%, -50%);
}
/*c'est pour avoir les ligne entre chache colonne*/
/*mais ducou les style que j'ai rajouter sur les autre ne serve a rien*/
table, td, th {
  border: 1px solid black;
  border-collapse: collapse;
}


table {
  border-collapse: collapse;
  width: 50%;
}

td {
  text-align: center;
}



</style>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<ul>
    <li><a href="index.html">Home</a></li>
    <li><a href="article.php">voir les article</a></li>
  </ul>
<br>
<h1><p class='w3-text-lime w3-black'>les articles</p></h1><br>
</head>

<body class="w3-amber">


<div class="center">
  <button class="bouton1">page precedente</button>
  <button class="bouton2">page suivante</button>
</div>

<br>
<br>

<form action='article.php' method='GET'>

<label for='nom_client'>Votre nom :</label>
<input type='text' name='nom_client' id='nom_client' pattern="[a-zA-Z0-9._%+-]+"required>

<label for='prenom_client'>Votre prénom :</label>
<input type='text' name='prenom_client' id='prenom_client' pattern="[a-zA-Z0-9._%+-]+"required><br>

<label for='com_client'>plus d'info :</label>
<textarea name="com_client" id="com_client" rows="4" cols="50" value=""></textarea>
<br>

<table style='border: 1px solid black; '>
<tr style='border: 1px solid black; '>
<th>image</th>
<th>nom</th>
<th>prix</th>
<th>taille</th>
</tr>

<tr class='div1' style='border: 1px solid black;'>
<td><img src="image/346122261_3487527211482109_311952964021799036_n.jpg" alt=""></td>
<td>YOOO</td>
<td>yooo</td>
<td>yooo</td>
<td><input type='number' name='nb1' id='nb1' value="0" min='0'>
    <div class='cache'>
      <input type="text" name="nom1" id="nom1" value="UO" readonly='readonly' >
      <input type="text" name="prix1" id="prix1" value="AI" readonly='readonly' >
    </div>
</td>

</tr>

<tr class='div1' style='border: 1px solid black;'>
<td><img src="image/349259664_1220464865308931_1665106368398424943_n.jpg" alt=""></td>
<td></td>
<td></td>
<td></td>
<td><input type='number' name='nb2' id='nb2' value="0" min='0'>
    <div class='cache'>
      <input type="text" name="nom2" id="nom2" value="test2" readonly='readonly' >
      <input type="text" name="prix2" id="prix2" value="prix2" readonly='readonly' >
    </div></td>

</tr>

<tr class='div1' style='border: 1px solid black;'>
<td><img src="image/349400052_737341161419890_8841851979824813834_n.jpg" alt=""></td>
<td></td>
<td></td>
<td></td>
<td><input type='number' name='nb3' id='nb3' value="0" min='0'>
    <div class='cache'>
      <input type="text" name="nom3" id="nom3" value="test3" readonly='readonly' >
      <input type="text" name="prix3" id="prix3" value="prix3" readonly='readonly' >
    </div></td>

</tr>

<tr class='div1' style='border: 1px solid black;'>
<td><img src="image/349265346_584956533704602_1220090378023733361_n.jpg" alt=""></td>
<td></td>
<td></td>
<td></td>
<td><input type='number' name='nb4' id='nb4' value="0" min='0'>
    <div class='cache'>
      <input type="text" name="nom4" id="nom4" value="test4" readonly='readonly' >
      <input type="text" name="prix4" id="prix4" value="prix4" readonly='readonly' >
    </div></td>

</tr>

<tr class='div1' style='border: 1px solid black;'>
<td><img src="image/349288063_1663987344038202_6566639664401434747_n.jpg" alt=""></td>
<td></td>
<td></td>
<td></td>
<td><input type='number' name='nb5' id='nb5' value="0" min='0'>
    <div class='cache'>
      <input type="text" name="nom5" id="nom5" value="test5" readonly='readonly' >
      <input type="text" name="prix5" id="prix5" value="prix5" readonly='readonly' >
    </div></td>

</tr>

<tr class='div1' style='border: 1px solid black;'>
<td><img src="image/349416186_764186535196471_2373093082658415719_n.jpg" alt=""></td>
<td></td>
<td></td>
<td></td>
<td><input type='number' name='nb6' id='nb6' value="0" min='0'>
    <div class='cache'>
      <input type="text" name="nom6" id="nom6" value="test6" readonly='readonly' >
      <input type="text" name="prix6" id="prix6" value="prix6" readonly='readonly' >
    </div></td>

</tr>



<tr class='div1' style='border: 1px solid black;'>
<td><img src="image/349434259_1037447984327329_6203896020583285319_n.jpg" alt=""></td>
<td></td>
<td></td>
<td></td>
<td><input type='number' name='nb7' id='nb7' value="0" min='0'>
    <div class='cache'>
      <input type="text" name="nom7" id="nom7" value="test7" readonly='readonly' >
      <input type="text" name="prix7" id="prix7" value="prix7" readonly='readonly' >
    </div></td>

</tr>

<tr class='div1' style='border: 1px solid black;'>
<td><img src="image/349434259_2436608453174282_6401216399178273123_n.jpg" alt=""></td>
<td></td>
<td></td>
<td></td>
<td><input type='number' name='nb8' id='nb8' value="0" min='0'>
    <div class='cache'>
      <input type="text" name="nom8" id="nom8" value="test8" readonly='readonly' >
      <input type="text" name="prix8" id="prix8" value="prix8" readonly='readonly' >
    </div></td>

</tr>

<tr class='div1' style='border: 1px solid black;'>
<td><img src="image/349446452_274401278297958_1545756617472524990_n.jpg" alt=""></td>
<td></td>
<td></td>
<td></td>
<td><input type='number' name='nb9' id='nb9' value="0" min='0'>
    <div class='cache'>
      <input type="text" name="nom9" id="nom9" value="test9" readonly='readonly' >
      <input type="text" name="prix9" id="prix9" value="prix9" readonly='readonly' >
    </div></td>

</tr>

<tr class='div1' style='border: 1px solid black;'>
<td><img src="image/349446452_289995393460327_5684733680960168504_n.jpg" alt=""></td>
<td></td>
<td></td>
<td></td>
<td><input type='number' name='nb10' id='nb10' value="0" min='0'>
    <div class='cache'>
      <input type="text" name="nom10" id="nom10" value="test10" readonly='readonly' >
      <input type="text" name="prix10" id="prix10" value="prix10" readonly='readonly' >
    </div></td>

</tr>

<tr class='div1' style='border: 1px solid black;'>
<td><img src="image/349520031_2603908319761989_3137989351388290202_n.jpg" alt=""></td>
<td></td>
<td></td>
<td></td>
<td><input type='number' name='nb11' id='nb11' value="0" min='0'>
    <div class='cache'>
      <input type="text" name="nom11" id="nom11" value="test11" readonly='readonly' >
      <input type="text" name="prix11" id="prix11" value="prix11" readonly='readonly' >
    </div></td>
</tr>

<tr class='div2' style='border: 1px solid black; display:none;'>
<td><img src="image/349539496_1422034645005381_2972907014251615231_n.jpg" alt=""></td>
<td></td>
<td></td>
<td></td>
<td><input type='number' name='nb12' id='nb12' value="0" min='0'>
    <div class='cache'>
      <input type="text" name="nom12" id="nom12" value="test12" readonly='readonly' >
      <input type="text" name="prix12" id="prix12" value="prix12" readonly='readonly' >
    </div></td>

</tr>

<tr class='div2' style='border: 1px solid black; display:none;'>
<td><img src="image/349578144_787647749476905_8903450391421068304_n.jpg" alt=""></td>
<td></td>
<td></td>
<td></td>
<td><input type='number' name='nb13' id='nb13' value="0" min='0'>
    <div class='cache'>
      <input type="text" name="nom13" id="nom13" value="test13" readonly='readonly' >
      <input type="text" name="prix13" id="prix13" value="prix13" readonly='readonly' >
    </div></td>

</tr>

<tr class='div2' style='border: 1px solid black; display:none;'>
<td><img src="image/349630203_1392073884970042_7668180171729068084_n.jpg" alt=""></td>
<td></td>
<td></td>
<td></td>
<td><input type='number' name='nb14' id='nb14' value="0" min='0'>
    <div class='cache'>
      <input type="text" name="nom14" id="nom14" value="test14" readonly='readonly' >
      <input type="text" name="prix14" id="prix14" value="prix14" readonly='readonly' >
    </div></td>

</tr>

<tr class='div2' style='border: 1px solid black; display:none;'>
<td><img src="image/349696852_1274794376753560_7432110920961452427_n.jpg" alt=""></td>
<td></td>
<td></td>
<td></td>
<td><input type='number' name='nb15' id='nb15' value="0" min='0'>
    <div class='cache'>
      <input type="text" name="nom15" id="nom15" value="test15" readonly='readonly' >
      <input type="text" name="prix15" id="prix15" value="prix15" readonly='readonly' >
    </div></td>

</tr>

<tr class='div2' style='border: 1px solid black; display:none;'>
<td><img src="image/349717426_637691111212358_3678477937620784855_n.jpg" alt=""></td>
<td></td>
<td></td>
<td></td>
<td><input type='number' name='nb16' id='nb16' value="0" min='0'>
    <div class='cache'>
      <input type="text" name="nom16" id="nom16" value="test16" readonly='readonly' >
      <input type="text" name="prix16" id="prix16" value="prix16" readonly='readonly' >
    </div></td>

</tr>

<tr class='div2' style='border: 1px solid black; display:none;'>
<td><img src="image/349981580_1458616971544552_3389964927461034150_n.jpg" alt=""></td>
<td></td>
<td></td>
<td></td>
<td><input type='number' name='nb17' id='nb17' value="0" min='0'>
    <div class='cache'>
      <input type="text" name="nom17" id="nom17" value="test17" readonly='readonly' >
      <input type="text" name="prix17" id="prix17" value="prix17" readonly='readonly' >
    </div></td>

</tr>

<tr class='div2' style='border: 1px solid black; display:none;'>
<td><img src="image/350029977_213959144737660_6728565954037849513_n.jpg" alt=""></td>
<td></td>
<td></td>
<td></td>
<td><input type='number' name='nb17' id='nb17' value="0" min='0'>
    <div class='cache'>
      <input type="text" name="nom17" id="nom17" value="test17" readonly='readonly' >
      <input type="text" name="prix17" id="prix17" value="prix17" readonly='readonly' >
    </div></td>

</tr>

<tr class='div2' style='border: 1px solid black; display:none;'>
<td><img src="image/350084578_1212387786130744_7467943783979889823_n.jpg" alt=""></td>
<td></td>
<td></td>
<td></td>
<td><input type='number' name='nb18' id='nb18' value="0" min='0'>
    <div class='cache'>
      <input type="text" name="nom18" id="nom18" value="test18" readonly='readonly' >
      <input type="text" name="prix18" id="prix18" value="prix18" readonly='readonly' >
    </div></td>

</tr>

<tr class='div2' style='border: 1px solid black; display:none;'>
<td><img src="image/350085351_217685111064395_3550010709059006690_n.jpg" alt=""></td>
<td></td>
<td></td>
<td></td>
<td><input type='number' name='nb19' id='nb19' value="0" min='0'>
    <div class='cache'>
      <input type="text" name="nom19" id="nom19" value="test19" readonly='readonly' >
      <input type="text" name="prix19" id="prix19" value="prix19" readonly='readonly' >
    </div></td>

</tr>

<tr class='div2' style='border: 1px solid black; display:none;'>
<td><img src="image/350091493_1404633646991758_6729264804188435370_n.jpg" alt=""></td>
<td></td>
<td></td>
<td></td>
<td><input type='number' name='nb20' id='nb20' value="0" min='0'>
    <div class='cache'>
      <input type="text" name="nom20" id="nom20" value="test20" readonly='readonly' >
      <input type="text" name="prix20" id="prix20" value="prix20" readonly='readonly' >
    </div></td>
</tr>

<tr class='div3' style='border: 1px solid black; display:none;'>
<td><img src="image/350091806_255708927038095_5855091891653991151_n.jpg" alt=""></td>
<td></td>
<td></td>
<td></td>
<td><input type='number' name='nb21' id='nb21' value="0" min='0'>
    <div class='cache'>
      <input type="text" name="nom21" id="nom21" value="test21" readonly='readonly' >
      <input type="text" name="prix21" id="prix21" value="prix21" readonly='readonly' >
    </div></td>

</tr>

<tr class='div3' style='border: 1px solid black; display:none;'>
<td><img src="image/350095923_794241685364510_1223622692449114791_n.jpg" alt=""></td>
<td></td>
<td></td>
<td></td>
<td><input type='number' name='nb22' id='nb22' value="0" min='0'>
    <div class='cache'>
      <input type="text" name="nom22" id="nom22" value="test22" readonly='readonly' >
      <input type="text" name="prix22" id="prix22" value="prix22" readonly='readonly' >
    </div></td>

</tr>

<tr class='div3' style='border: 1px solid black; display:none;'>
<td><img src="image/350096401_662184762387813_6737932015153816666_n.jpg" alt=""></td>
<td></td>
<td></td>
<td></td>
<td><input type='number' name='nb23' id='nb23' value="0" min='0'>
    <div class='cache'>
      <input type="text" name="nom23" id="nom23" value="test23" readonly='readonly' >
      <input type="text" name="prix23" id="prix23" value="prix23" readonly='readonly' >
    </div></td>

</tr>

<tr class='div3' style='border: 1px solid black; display:none;'>
<td><img src="image/350100604_596007712317287_3095425153484754616_n.jpg" alt=""></td>
<td></td>
<td></td>
<td></td>
<td><input type='number' name='nb24' id='nb24' value="0" min='0'>
    <div class='cache'>
      <input type="text" name="nom24" id="nom24" value="test24" readonly='readonly' >
      <input type="text" name="prix24" id="prix24" value="prix24" readonly='readonly' >
    </div></td>

</tr>

<tr class='div3' style='border: 1px solid black; display:none;'>
<td><img src="image/350121696_2590930837721083_6510186999683114575_n.jpg" alt=""></td>
<td></td>
<td></td>
<td></td>
<td><input type='number' name='nb25' id='nb25' value="0" min='0'>
    <div class='cache'>
      <input type="text" name="nom25" id="nom25" value="test25" readonly='readonly' >
      <input type="text" name="prix25" id="prix25" value="prix25" readonly='readonly' >
    </div></td>

</tr>

<tr class='div3' style='border: 1px solid black; display:none;'>
<td><img src="image/350134299_203952859184052_5999162908840561294_n.jpg" alt=""></td>
<td></td>
<td></td>
<td></td>
<td><input type='number' name='nb26' id='nb26' value="0" min='0'>
    <div class='cache'>
      <input type="text" name="nom26" id="nom26" value="test26" readonly='readonly' >
      <input type="text" name="prix26" id="prix26" value="prix26" readonly='readonly' >
    </div></td>

</tr>

<tr class='div3' style='border: 1px solid black; display:none;'>
<td><img src="image/350139558_1374270313140722_2669193249396374345_n.jpg" alt=""></td>
<td></td>
<td></td>
<td></td>
<td><input type='number' name='nb27' id='nb27' value="0" min='0'>
    <div class='cache'>
      <input type="text" name="nom27" id="nom27" value="test27" readonly='readonly' >
      <input type="text" name="prix27" id="prix27" value="prix27" readonly='readonly' >
    </div></td>

</tr>

<tr class='div3' style='border: 1px solid black; display:none;'>
<td><img src="image/350161497_931148408114448_715603223167515632_n.jpg" alt=""></td>
<td></td>
<td></td>
<td></td>
<td><input type='number' name='nb28' id='nb28' value="0" min='0'>
    <div class='cache'>
      <input type="text" name="nom28" id="nom28" value="test28" readonly='readonly' >
      <input type="text" name="prix28" id="prix28" value="prix28" readonly='readonly' >
    </div></td>

</tr>

<tr class='div3' style='border: 1px solid black; display:none;'>
<td><img src="image/350172731_216751551210121_4395251161741919771_n.jpg" alt=""></td>
<td></td>
<td></td>
<td></td>
<td><input type='number' name='nb29' id='nb29' value="0" min='0'>
    <div class='cache'>
      <input type="text" name="nom29" id="nom29" value="test29" readonly='readonly' >
      <input type="text" name="prix29" id="prix29" value="prix29" readonly='readonly' >
    </div></td>

</tr>

<tr class='div3' style='border: 1px solid black; display:none;'>
<td><img src="image/350205872_126453217113114_6249527706926799251_n.jpg" alt=""></td>
<td></td>
<td></td>
<td></td>
<td><input type='number' name='nb30' id='nb30' value="0" min='0'>
    <div class='cache'>
      <input type="text" name="nom30" id="nom30" value="test30" readonly='readonly' >
      <input type="text" name="prix30" id="prix30" value="prix30" readonly='readonly' >
    </div></td>
</tr>

<tr class='div4' style='border: 1px solid black; display:none;'>
<td><img src="image/350237554_155780157476157_2213287850776305139_n.jpg" alt=""></td>
<td></td>
<td></td>
<td></td>
<td><input type='number' name='nb31' id='nb31' value="0" min='0'>
    <div class='cache'>
      <input type="text" name="nom31" id="nom31" value="test31" readonly='readonly' >
      <input type="text" name="prix31" id="prix31" value="prix31" readonly='readonly' >
    </div></td>
</tr>

<tr class='div4' style='border: 1px solid black; display:none;'>
<td><img src="image/350238846_616605963729755_4780654635793404500_n.jpg" alt=""></td>
<td></td>
<td></td>
<td></td>
<td><input type='number' name='nb32' id='nb32' value="0" min='0'>
    <div class='cache'>
      <input type="text" name="nom32" id="nom32" value="test32" readonly='readonly' >
      <input type="text" name="prix32" id="prix32" value="prix32" readonly='readonly' >
    </div></td>
</tr>

<tr class='div4' style='border: 1px solid black; display:none;'>
<td><img src="image/350240141_747389527075501_6632756172777535710_n.jpg" alt=""></td>
<td></td>
<td></td>
<td></td>
<td><input type='number' name='nb33' id='nb33' value="0" min='0'>
    <div class='cache'>
      <input type="text" name="nom33" id="nom33" value="test33" readonly='readonly' >
      <input type="text" name="prix33" id="prix33" value="prix33" readonly='readonly' >
    </div></td>
</tr>

<tr class='div4' style='border: 1px solid black; display:none;'>
<td><img src="image/350244921_1388567195275280_7304045143571373715_n.jpg" alt=""></td>
<td></td>
<td></td>
<td></td>
<td><input type='number' name='nb34' id='nb34' value="0" min='0'>
    <div class='cache'>
      <input type="text" name="nom34" id="nom34" value="test34" readonly='readonly' >
      <input type="text" name="prix34" id="prix34" value="prix34" readonly='readonly' >
    </div></td>
</tr>

<tr class='div4' style='border: 1px solid black; display:none;'>
<td><img src="image/350264793_243762968344658_6671747658958537874_n.jpg" alt=""></td>
<td></td>
<td></td>
<td></td>
<td><input type='number' name='nb35' id='nb35' value="0" min='0'>
    <div class='cache'>
      <input type="text" name="nom35" id="nom35" value="test35" readonly='readonly' >
      <input type="text" name="prix35" id="prix35" value="prix35" readonly='readonly' >
    </div></td>
</tr>

<tr class='div4' style='border: 1px solid black; display:none;'>
<td><img src="image/350293359_921433018962479_281790536372010079_n.jpg" alt=""></td>
<td></td>
<td></td>
<td></td>
<td><input type='number' name='nb36' id='nb36' value="0" min='0'>
    <div class='cache'>
      <input type="text" name="nom36" id="nom36" value="test36" readonly='readonly' >
      <input type="text" name="prix36" id="prix36" value="prix36" readonly='readonly' >
    </div></td>
</tr>

<tr class='div4' style='border: 1px solid black; display:none;'>
<td><img src="image/350297122_287121983652516_4327861408548100800_n.jpg" alt=""></td>
<td></td>
<td></td>
<td></td>
<td><?php //ici on metra le formulaire pour commander  ?></td>
</tr>

<tr class='div4' style='border: 1px solid black; display:none;'>
<td><img src="image/350308643_1294067577861419_3358554236818715938_n.jpg" alt=""></td>
<td></td>
<td></td>
<td></td>
<td><input type='number' name='nb37' id='nb37' value="0" min='0'>
    <div class='cache'>
      <input type="text" name="nom37" id="nom37" value="test37" readonly='readonly' >
      <input type="text" name="prix37" id="prix37" value="prix37" readonly='readonly' >
    </div></td>
</tr>

<tr class='div4' style='border: 1px solid black; display:none;'>
<td><img src="image/350341924_934734647834165_3367967491371556653_n.jpg" alt=""></td>
<td></td>
<td></td>
<td></td>
<td><input type='number' name='nb38' id='nb38' value="0" min='0'>
    <div class='cache'>
      <input type="text" name="nom38" id="nom38" value="test38" readonly='readonly' >
      <input type="text" name="prix38" id="prix38" value="prix38" readonly='readonly' >
    </div></td>
</tr>

<tr class='div4' style='border: 1px solid black; display:none;'>
<td><img src="image/350341929_171426232281248_1347169359085554974_n.jpg" alt=""></td>
<td></td>
<td></td>
<td></td>
<td><input type='number' name='nb39' id='nb39' value="0" min='0'>
    <div class='cache'>
      <input type="text" name="nom39" id="nom39" value="test39" readonly='readonly' >
      <input type="text" name="prix39" id="prix39" value="prix39" readonly='readonly' >
    </div></td>
</tr>

<tr class='div5' style='border: 1px solid black; display:none;'>
<td><img src="image/350353592_238329312159082_980460845196059732_n.jpg" alt=""></td>
<td></td>
<td></td>
<td></td>
<td><input type='number' name='nb40' id='nb40' value="0" min='0'>
    <div class='cache'>
      <input type="text" name="nom40" id="nom40" value="test40" readonly='readonly' >
      <input type="text" name="prix40" id="prix40" value="prix40" readonly='readonly' >
    </div></td>
</tr>

<tr class='div5' style='border: 1px solid black; display:none;'>
<td><img src="image/350355413_661322922491895_1773764293133004774_n.jpg" alt=""></td>
<td></td>
<td></td>
<td></td>
<td><input type='number' name='nb41' id='nb41' value="0" min='0'>
    <div class='cache'>
      <input type="text" name="nom41" id="nom41" value="test41" readonly='readonly' >
      <input type="text" name="prix41" id="prix41" value="prix41" readonly='readonly' >
    </div></td>
</tr>

<tr class='div5' style='border: 1px solid black; display:none;'>
<td><img src="image/350355843_924423525449454_3728817124770931325_n.jpg" alt=""></td>
<td></td>
<td></td>
<td></td>
<td><input type='number' name='nb42' id='nb42' value="0" min='0'>
    <div class='cache'>
      <input type="text" name="nom42" id="nom42" value="test42" readonly='readonly' >
      <input type="text" name="prix42" id="prix42" value="prix42" readonly='readonly' >
    </div></td>
</tr>

<tr class='div5' style='border: 1px solid black; display:none;'>
<td><img src="image/350356483_994454081912095_8060082737680927751_n.jpg" alt=""></td>
<td></td>
<td></td>
<td></td>
<td><input type='number' name='nb43' id='nb43' value="0" min='0'>
    <div class='cache'>
      <input type="text" name="nom43" id="nom43" value="test43" readonly='readonly' >
      <input type="text" name="prix43" id="prix43" value="prix43" readonly='readonly' >
    </div></td>
</tr>

<tr class='div5' style='border: 1px solid black; display:none;'>
<td><img src="image/350357466_153718357684077_2409986509623487381_n.jpg" alt=""></td>
<td></td>
<td></td>
<td></td>
<td><input type='number' name='nb44' id='nb44' value="0" min='0'>
    <div class='cache'>
      <input type="text" name="nom44" id="nom44" value="test44" readonly='readonly' >
      <input type="text" name="prix44" id="prix44" value="prix44" readonly='readonly' >
    </div></td>
</tr>

<tr class='div5' style='border: 1px solid black; display:none;'>
<td><img src="image/350358416_778474100446798_9110915500031537643_n.jpg" alt=""></td>
<td></td>
<td></td>
<td></td>
<td><input type='number' name='nb45' id='nb45' value="0" min='0'>
    <div class='cache'>
      <input type="text" name="nom45" id="nom45" value="test45" readonly='readonly' >
      <input type="text" name="prix45" id="prix45" value="prix45" readonly='readonly' >
    </div></td>
</tr>

<tr class='div5' style='border: 1px solid black; display:none;'>
<td><img src="image/350358432_904998230593166_3299972115593568149_n.jpg" alt=""></td>
<td></td>
<td></td>
<td></td>
<td><input type='number' name='nb46' id='nb46' value="0" min='0'>
    <div class='cache'>
      <input type="text" name="nom46" id="nom46" value="test46" readonly='readonly' >
      <input type="text" name="prix46" id="prix46" value="prix46" readonly='readonly' >
    </div></td>
</tr>

<tr class='div5' style='border: 1px solid black; display:none;'>
<td><img src="image/350358464_5997285727064384_5045760934520414798_n.jpg" alt=""></td>
<td></td>
<td></td>
<td></td>
<td><input type='number' name='nb47' id='nb47' value="0" min='0'>
    <div class='cache'>
      <input type="text" name="nom47" id="nom47" value="test47" readonly='readonly' >
      <input type="text" name="prix47" id="prix47" value="prix47" readonly='readonly' >
    </div></td>
</tr>

<tr class='div5' style='border: 1px solid black; display:none;'>
<td><img src="image/350359891_805688760913832_4273397604413657201_n.jpg" alt=""></td>
<td></td>
<td></td>
<td></td>
<td><input type='number' name='nb48' id='nb48' value="0" min='0'>
    <div class='cache'>
      <input type="text" name="nom48" id="nom48" value="test48" readonly='readonly' >
      <input type="text" name="prix48" id="prix48" value="prix48" readonly='readonly' >
    </div></td>
</tr>

<tr class='div5' style='border: 1px solid black; display:none;'>
<td><img src="image/350361119_638993387745634_3767800991334674938_n.jpg" alt=""></td>
<td></td>
<td></td>
<td></td>
<td><input type='number' name='nb49' id='nb49' value="0" min='0'>
    <div class='cache'>
      <input type="text" name="nom49" id="nom49" value="test49" readonly='readonly' >
      <input type="text" name="prix49" id="prix49" value="prix49" readonly='readonly' >
    </div></td>
</tr>

<tr class='div6' style='border: 1px solid black; display:none;'>
<td><img src="image/350362380_3465192550361978_8082234880421949659_n.jpg" alt=""></td>
<td></td>
<td></td>
<td></td>
<td><input type='number' name='nb50' id='nb50' value="0" min='0'>
    <div class='cache'>
      <input type="text" name="nom50" id="nom50" value="test50" readonly='readonly' >
      <input type="text" name="prix50" id="prix50" value="prix50" readonly='readonly' >
    </div></td>
</tr>

<tr class='div6' style='border: 1px solid black; display:none;'>
<td><img src="image/350362737_280558784411104_6354299970429976134_n.jpg" alt=""></td>
<td></td>
<td></td>
<td></td>
<td><input type='number' name='nb51' id='nb51' value="0" min='0'>
    <div class='cache'>
      <input type="text" name="nom51" id="nom51" value="test51" readonly='readonly' >
      <input type="text" name="prix51" id="prix51" value="prix51" readonly='readonly' >
    </div></td>
</tr>

<tr class='div6' style='border: 1px solid black; display:none;'>
<td><img src="image/350363148_775411070732634_5076325028189992397_n.jpg" alt=""></td>
<td></td>
<td></td>
<td></td>
<td><input type='number' name='nb52' id='nb52' value="0" min='0'>
    <div class='cache'>
      <input type="text" name="nom52" id="nom52" value="test52" readonly='readonly' >
      <input type="text" name="prix52" id="prix52" value="prix52" readonly='readonly' >
    </div></td>
</tr>

<tr class='div6' style='border: 1px solid black; display:none;'>
<td><img src="image/350364223_211176675109347_3923574090331586097_n.jpg" alt=""></td>
<td></td>
<td></td>
<td></td>
<td><input type='number' name='nb53' id='nb53' value="0" min='0'>
    <div class='cache'>
      <input type="text" name="nom53" id="nom53" value="test53" readonly='readonly' >
      <input type="text" name="prix53" id="prix53" value="prix53" readonly='readonly' >
    </div></td>
</tr>

<tr class='div6' style='border: 1px solid black; display:none;'>
<td><img src="image/350364385_949100993096452_8128447155637940119_n.jpg" alt=""></td>
<td></td>
<td></td>
<td></td>
<td><input type='number' name='nb54' id='nb54' value="0" min='0'>
    <div class='cache'>
      <input type="text" name="nom54" id="nom54" value="test54" readonly='readonly' >
      <input type="text" name="prix54" id="prix54" value="prix54" readonly='readonly' >
    </div></td>
</tr>

<tr class='div6' style='border: 1px solid black; display:none;'>
<td><img src="image/350364412_810029570752736_8910178760527637414_n.jpg" alt=""></td>
<td></td>
<td></td>
<td></td>
<td><input type='number' name='nb55' id='nb55' value="0" min='0'>
    <div class='cache'>
      <input type="text" name="nom55" id="nom55" value="test55" readonly='readonly' >
      <input type="text" name="prix55" id="prix55" value="prix55" readonly='readonly' >
    </div></td>
</tr>

<tr class='div6' style='border: 1px solid black; display:none;'>
<td><img src="image/350364560_284431417257115_923151732753157110_n.jpg" alt=""></td>
<td></td>
<td></td>
<td></td>
<td><input type='number' name='nb56' id='nb56' value="0" min='0'>
    <div class='cache'>
      <input type="text" name="nom56" id="nom56" value="test56" readonly='readonly' >
      <input type="text" name="prix56" id="prix56" value="prix56" readonly='readonly' >
    </div></td>
</tr>

<tr class='div6' style='border: 1px solid black; display:none;'>
<td><img src="image/350365415_214996121000558_7126431215902648598_n.jpg" alt=""></td>
<td></td>
<td></td>
<td></td>
<td><input type='number' name='nb57' id='nb57' value="0" min='0'>
    <div class='cache'>
      <input type="text" name="nom57" id="nom57" value="test57" readonly='readonly' >
      <input type="text" name="prix57" id="prix57" value="prix57" readonly='readonly' >
    </div></td>
</tr>

<tr class='div6' style='border: 1px solid black; display:none;'>
<td><img src="image/350366449_1033349747634299_9185343764757756326_n.jpg" alt=""></td>
<td></td>
<td></td>
<td></td>
<td><input type='number' name='nb58' id='nb58' value="0" min='0'>
    <div class='cache'>
      <input type="text" name="nom58" id="nom58" value="test58" readonly='readonly' >
      <input type="text" name="prix58" id="prix58" value="prix58" readonly='readonly' >
    </div></td>
</tr>

<tr class='div6' style='border: 1px solid black; display:none;'>
<td><img src="image/350367614_5999008543560926_112982926731492423_n.jpg" alt=""></td>
<td></td>
<td></td>
<td></td>
<td><input type='number' name='nb59' id='nb59' value="0" min='0'>
    <div class='cache'>
      <input type="text" name="nom59" id="nom59" value="test59" readonly='readonly' >
      <input type="text" name="prix59" id="prix59" value="prix59" readonly='readonly' >
    </div></td>
</tr>


<tr class='div7' style='border: 1px solid black; display:none;'>
<td><img src="image/350368948_643319504312842_5425957309617745653_n.jpg" alt=""></td>
<td></td>
<td></td>
<td></td>
<td><input type='number' name='nb60' id='nb60' value="0" min='0'>
    <div class='cache'>
      <input type="text" name="nom60" id="nom60" value="test60" readonly='readonly' >
      <input type="text" name="prix60" id="prix60" value="prix60" readonly='readonly' >
    </div></td>
</tr>

<tr class='div7' style='border: 1px solid black; display:none;'>
<td><img src="image/350369884_823354555956099_4532632517925509533_n.jpg" alt=""></td>
<td></td>
<td></td>
<td></td>
<td><input type='number' name='nb61' id='nb61' value="0" min='0'>
    <div class='cache'>
      <input type="text" name="nom61" id="nom61" value="test61" readonly='readonly' >
      <input type="text" name="prix61" id="prix61" value="prix61" readonly='readonly' >
    </div></td>
</tr>

<tr class='div7' style='border: 1px solid black; display:none;'>
<td><img src="image/350369888_1419411822191972_4516436243337412880_n.jpg" alt=""></td>
<td></td>
<td></td>
<td></td>
<td><input type='number' name='nb62' id='nb62' value="0" min='0'>
    <div class='cache'>
      <input type="text" name="nom62" id="nom62" value="test62" readonly='readonly' >
      <input type="text" name="prix62" id="prix62" value="prix62" readonly='readonly' >
    </div></td>
</tr>

<tr class='div7' style='border: 1px solid black; display:none;'>
<td><img src="image/350371959_594309399168142_1732918704318222702_n.jpg" alt=""></td>
<td></td>
<td></td>
<td></td>
<td><input type='number' name='nb63' id='nb63' value="0" min='0'>
    <div class='cache'>
      <input type="text" name="nom63" id="nom63" value="test63" readonly='readonly' >
      <input type="text" name="prix63" id="prix63" value="prix63" readonly='readonly' >
    </div></td>
</tr>

<tr class='div7' style='border: 1px solid black; display:none;'>
<td><img src="image/350372269_626176206091057_5460307996520450867_n.jpg" alt=""></td>
<td></td>
<td></td>
<td></td>
<td><input type='number' name='nb64' id='nb64' value="0" min='0'>
    <div class='cache'>
      <input type="text" name="nom64" id="nom64" value="test64" readonly='readonly' >
      <input type="text" name="prix64" id="prix64" value="prix64" readonly='readonly' >
    </div></td>
</tr>

<tr class='div7' style='border: 1px solid black; display:none;'>
<td><img src="image/350373517_1918532331864159_4531336191930383347_n.jpg" alt=""></td>
<td></td>
<td></td>
<td></td>
<td><input type='number' name='nb65' id='nb65' value="0" min='0'>
    <div class='cache'>
      <input type="text" name="nom65" id="nom65" value="test65" readonly='readonly' >
      <input type="text" name="prix65" id="prix65" value="prix65" readonly='readonly' >
    </div></td>
</tr>

<tr class='div7' style='border: 1px solid black; display:none;'>
<td><img src="image/350374697_776893337359941_3309515496968781264_n.jpg" alt=""></td>
<td></td>
<td></td>
<td></td>
<td><input type='number' name='nb66' id='nb66' value="0" min='0'>
    <div class='cache'>
      <input type="text" name="nom66" id="nom66" value="test66" readonly='readonly' >
      <input type="text" name="prix66" id="prix66" value="prix66" readonly='readonly' >
    </div></td>
</tr>

<tr class='div7' style='border: 1px solid black; display:none;'>
<td><img src="image/350375596_156986307221861_854530728179299754_n.jpg" alt=""></td>
<td></td>
<td></td>
<td></td>
<td><input type='number' name='nb67' id='nb67' value="0" min='0'>
    <div class='cache'>
      <input type="text" name="nom67" id="nom67" value="test67" readonly='readonly' >
      <input type="text" name="prix67" id="prix67" value="prix67" readonly='readonly' >
    </div></td>
</tr>

<tr class='div7' style='border: 1px solid black; display:none;'>
<td><img src="image/350375637_740735844720621_4239633500156509308_n.jpg" alt=""></td>
<td></td>
<td></td>
<td></td>
<td><input type='number' name='nb68' id='nb68' value="0" min='0'>
    <div class='cache'>
      <input type="text" name="nom68" id="nom68" value="test68" readonly='readonly' >
      <input type="text" name="prix68" id="prix68" value="prix68" readonly='readonly' >
    </div></td>
</tr>

<tr class='div7' style='border: 1px solid black; display:none;'>
<td><img src="image/350376079_770907171245759_5191555125596222559_n.jpg" alt=""></td>
<td></td>
<td></td>
<td></td>
<td><input type='number' name='nb69' id='nb69' value="0" min='0'>
    <div class='cache'>
      <input type="text" name="nom69" id="nom69" value="test69" readonly='readonly' >
      <input type="text" name="prix69" id="prix69" value="prix69" readonly='readonly' >
    </div></td>
</tr>


<tr class='div8' style='border: 1px solid black; display:none;'>
<td><img src="image/350377359_2377048775806282_4642689416730759871_n.jpg" alt=""></td>
<td></td>
<td></td>
<td></td>
<td><input type='number' name='nb70' id='nb70' value="0" min='0'>
    <div class='cache'>
      <input type="text" name="nom70" id="nom70" value="test70" readonly='readonly' >
      <input type="text" name="prix70" id="prix70" value="prix70" readonly='readonly' >
    </div></td>
</tr>

<tr class='div8' style='border: 1px solid black; display:none;'>
<td><img src="image/350377573_1421912815266560_470188436982567495_n.jpg" alt=""></td>
<td></td>
<td></td>
<td></td>
<td><input type='number' name='nb71' id='nb71' value="0" min='0'>
    <div class='cache'>
      <input type="text" name="nom71" id="nom71" value="test71" readonly='readonly' >
      <input type="text" name="prix71" id="prix71" value="prix71" readonly='readonly' >
    </div></td>
</tr>

<tr class='div8' style='border: 1px solid black; display:none;'>
<td><img src="image/350378168_982198669586214_5607068941921648936_n.jpg" alt=""></td>
<td></td>
<td></td>
<td></td>
<td><input type='number' name='nb72' id='nb72' value="0" min='0'>
    <div class='cache'>
      <input type="text" name="nom72" id="nom72" value="test72" readonly='readonly' >
      <input type="text" name="prix72" id="prix72" value="prix72" readonly='readonly' >
    </div></td>
</tr>

<tr class='div8' style='border: 1px solid black; display:none;'>
<td><img src="image/350378823_276574978100861_8067789270749725335_n.jpg" alt=""></td>
<td></td>
<td></td>
<td></td>
<td><input type='number' name='nb73' id='nb73' value="0" min='0'>
    <div class='cache'>
      <input type="text" name="nom73" id="nom73" value="test73" readonly='readonly' >
      <input type="text" name="prix73" id="prix73" value="prix73" readonly='readonly' >
    </div></td>
</tr>

<tr class='div8' style='border: 1px solid black; display:none;'>
<td><img src="image/350378974_631736668840155_6688712469524272186_n.jpg" alt=""></td>
<td></td>
<td></td>
<td></td>
<td><input type='number' name='nb74' id='nb74' value="0" min='0'>
    <div class='cache'>
      <input type="text" name="nom74" id="nom74" value="test74" readonly='readonly' >
      <input type="text" name="prix74" id="prix74" value="prix74" readonly='readonly' >
    </div></td>
</tr>

<tr class='div8' style='border: 1px solid black; display:none;'>
<td><img src="image/350378980_1907954712919455_1214742195667672416_n.jpg" alt=""></td>
<td></td>
<td></td>
<td></td>
<td><input type='number' name='nb75' id='nb75' value="0" min='0'>
    <div class='cache'>
      <input type="text" name="nom75" id="nom75" value="test75" readonly='readonly' >
      <input type="text" name="prix75" id="prix75" value="prix75" readonly='readonly' >
    </div></td>
</tr>

<tr class='div8' style='border: 1px solid black; display:none;'>
<td><img src="image/350378988_184219167582310_8120830365266327630_n.jpg" alt=""></td>
<td></td>
<td></td>
<td></td>
<td><input type='number' name='nb76' id='nb76' value="0" min='0'>
    <div class='cache'>
      <input type="text" name="nom76" id="nom76" value="test76" readonly='readonly' >
      <input type="text" name="prix76" id="prix76" value="prix76" readonly='readonly' >
    </div></td>
</tr>

<tr class='div8' style='border: 1px solid black; display:none;'>
<td><img src="image/350380365_787791056324521_3485423759111045370_n.jpg" alt=""></td>
<td></td>
<td></td>
<td></td>
<td><input type='number' name='nb77' id='nb77' value="0" min='0'>
    <div class='cache'>
      <input type="text" name="nom77" id="nom77" value="test77" readonly='readonly' >
      <input type="text" name="prix77" id="prix77" value="prix77" readonly='readonly' >
    </div></td>
</tr>

<tr class='div8' style='border: 1px solid black; display:none;'>
<td><img src="image/350385840_9386959324709338_6855523521651594201_n.jpg" alt=""></td>
<td></td>
<td></td>
<td></td>
<td><input type='number' name='nb78' id='nb78' value="0" min='0'>
    <div class='cache'>
      <input type="text" name="nom78" id="nom78" value="test78" readonly='readonly' >
      <input type="text" name="prix78" id="prix78" value="prix78" readonly='readonly' >
    </div></td>
</tr>

<tr class='div8' style='border: 1px solid black; display:none;'>
<td><img src="image/350387732_2258346294373092_3121053854673330172_n.jpg" alt=""></td>
<td></td>
<td></td>
<td></td>
<td><input type='number' name='nb79' id='nb79' value="0" min='0'>
    <div class='cache'>
      <input type="text" name="nom79" id="nom79" value="test79" readonly='readonly' >
      <input type="text" name="prix79" id="prix79" value="prix79" readonly='readonly' >
    </div></td>
</tr>

<tr class='div9' style='border: 1px solid black; display:none;'>
<td><img src="image/350641765_762050445462746_1897405034351820985_n.jpg" alt=""></td>
<td></td>
<td></td>
<td></td>
<td><input type='number' name='nb80' id='nb80' value="0" min='0'>
    <div class='cache'>
      <input type="text" name="nom80" id="nom80" value="test80" readonly='readonly' >
      <input type="text" name="prix80" id="prix80" value="prix80" readonly='readonly' >
    </div></td>
</tr>

<tr class='div9' style='border: 1px solid black; display:none;'>
<td><img src="image/350707012_933381894614961_8318773693130352639_n.jpg" alt=""></td>
<td></td>
<td></td>
<td></td>
<td><input type='number' name='nb81' id='nb81' value="0" min='0'>
    <div class='cache'>
      <input type="text" name="nom81" id="nom81" value="test81" readonly='readonly' >
      <input type="text" name="prix81" id="prix81" value="prix81" readonly='readonly' >
    </div></td>
</tr>

<tr class='div9' style='border: 1px solid black; display:none;'>
<td><img src="image/350759156_660398679249678_2670876970569392272_n.jpg" alt=""></td>
<td></td>
<td></td>
<td></td>
<td><input type='number' name='nb82' id='nb82' value="0" min='0'>
    <div class='cache'>
      <input type="text" name="nom82" id="nom82" value="test82" readonly='readonly' >
      <input type="text" name="prix82" id="prix82" value="prix82" readonly='readonly' >
    </div></td>
</tr>
</table>
<input type="submit" name="submit" value="valider la commande">
</form>



</body>
</html>