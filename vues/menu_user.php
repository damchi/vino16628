<?php
/**
 * Created by PhpStorm.
 * User: Max Germain
 * Date: 2019-03-16
 * Time: 03:39
 */
?>
<header class="entete">
    <div class="enteteImage">
        <img src="images/bottle-50573_1280.jpg" alt="enteteImage">
    </div>
    <nav class="topnav" id="topnav">
    <?php
    if(!isset($_SESSION['user_pseudo'])){
    ?>
        <a href="?requete=login">Acceuil<span class="sr-only">(current)</span></a>
    <?php
    }
    else{
//         var_dump($_SESSION['user_pseudo']);
    ?>
        <a href="?requete=accueil">Mes celliers<span class="sr-only">(current)</span></a>
<!--                 <li>-->
<!--                     <a href="?requete=ajouterNouvelleBouteilleCellier">Ajouter une bouteille au cellier</a>-->
<!--                 </li>-->
        <a href="?requete=logout">Se deconnecter</a>
    <?php
    }
    ?>
        <a href="javascript:void(0);" class="icon" onclick="myFunction()">
        <i class="fas fa-bars"></i>
    </nav>
</header>
<script type="text/javascript">
    function myFunction() {
  var x = document.getElementById("topnav");
  if (x.className === "topnav") {
    x.className += " responsive";
  } else {
    x.className = "topnav";
  }
}
</script>