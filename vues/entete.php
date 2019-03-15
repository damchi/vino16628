<!DOCTYPE html>
<html lang="fr">
<head>
    <title>Un petit verre de vino</title>

    <meta charset="utf-8">
    <meta http-equiv="cache-control" content="no-cache">
    <meta name="viewport" content="width=device-width, minimum-scale=0.5, initial-scale=1.0, user-scalable=yes">

    <meta name="description" content="Un petit verre de vino">
    <meta name="author" content="Jonathan Martel (jmartel@cmaisonneuve.qc.ca)">

    <link rel="stylesheet" href="./css/normalize.css" type="text/css" media="screen">
    <link rel="stylesheet" href="./css/base_h5bp.css" type="text/css" media="screen">
    <link rel="stylesheet" href="./css/main.css" type="text/css" media="screen">
    <base href="<?php echo BASEURL; ?>">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css">
    <!-- Bootstrap core CSS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet">
    <!-- Material Design Bootstrap -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/mdbootstrap/4.7.4/css/mdb.min.css" rel="stylesheet">

    <!--<script src="./js/vendor/modernizr-2.6.2-respond-1.1.0.min.js"></script>-->
    <script src="./js/main.js"></script>
    <script src="./js/usager.js"></script>
    <script src="./js/ajoutBouteille.js"></script>


</head>
<body >
<header>
    <div class="container">
        <div class="view">
            <img src="images/bottle-50573_1280.jpg" class="img-fluid" alt="placeholder">
            <div class="mask flex-center waves-effect waves-light gba(156, 39, 176, 0.7)">
                <p class="white-text">Un petit verre de vino ?</p>
            </div>
        </div>
        <nav class="navbar  navbar-expand-lg navbar-dark purple darken-3 scrolling-navbar">
            <a class="navbar-brand" href="#"><strong>Vino</strong></a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarMenu"
                    aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarMenu">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item active">
                        <a class="nav-link" href="?requete=accueil">Mon cellier<span class="sr-only">(current)</span></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="?requete=ajouterNouvelleBouteilleCellier">Ajouter une bouteille au cellier</a>
                    </li>
                </ul>
                <ul class="navbar-nav nav-flex-icons">
                    <li class="nav-item">
                        <a class="nav-link"><i class="fab fa-facebook-f"></i></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link"><i class="fab fa-twitter"></i></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link"><i class="fab fa-instagram"></i></a>
                    </li>
                </ul>
            </div>
        </nav>

        <!--<div class="d-flex flex-column flex-md-row align-items-center p-3 px-md-4 mb-3 bg-white border-bottom box-shadow">
			<h5 class="my-0 mr-md-auto font-weight-normal">Vino</h5>
			<nav class="my-2 my-md-0 mr-md-3">
				<a class="p-2 text-dark" href="?requete=accueil">Mon cellier</a>
				<a class="p-2 text-dark" href="?requete=ajouterNouvelleBouteilleCellier">Ajouter une bouteille au cellier</a>
			</nav>
			<a class="btn btn-outline-primary" href="#">Connexion</a>
		</div>-->
    </div>
</header>

<main>
