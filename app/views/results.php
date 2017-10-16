<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Filters</title>

    <!--Import Google Icon Font-->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <!--Import materialize.css-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.100.2/css/materialize.min.css">

    <!--Let browser know website is optimized for mobile-->
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <link rel="stylesheet" href="../../web/css/main.css">
    <title>Resultats</title>
</head>
<body>
<div class="container">
    <h2>Votre recherche: <!-- insérer ici en php la requete tappée avec les critères --></h2>
    <div class="collection">
        <!-- Faire boucler chaque balise <a> par logiciel et définir un nombre max par page avant pagination. Selectionner également quels critères seront disponibles en apperçu, faire que le lien amene vers la page software unique -->
        <a href="#!" class="collection-item">
            <h3>Nom du logiciel</h3>
            <p>Ceci est la description du logiciel. C'est une description très intéressante, qui peut faire envie. </p>
        </a>
        <a href="#!" class="collection-item">
            <h3>Nom du logiciel</h3>
            <p>Ceci est la description du logiciel. C'est une description très intéressante, qui peut faire envie. </p>
        </a>
        <a href="#!" class="collection-item">
            <h3>Nom du logiciel</h3>
            <p>Ceci est la description du logiciel. C'est une description très intéressante, qui peut faire envie. </p>
        </a>
        <a href="#!" class="collection-item">
            <h3>Nom du logiciel</h3>
            <p>Ceci est la description du logiciel. C'est une description très intéressante, qui peut faire envie. </p>
        </a>
    </div>
    <!-- voir pour intégrer la pagination bien proprement dynamiquement sur la meme page-->
    <ul class="pagination center-align">
        <li class="disabled"><a href="#!"><i class="material-icons">chevron_left</i></a></li>
        <li class="active"><a href="#!">1</a></li>
        <li class="waves-effect"><a href="#!">2</a></li>
        <li class="waves-effect"><a href="#!">3</a></li>
        <li class="waves-effect"><a href="#!">4</a></li>
        <li class="waves-effect"><a href="#!">5</a></li>
        <li class="waves-effect"><a href="#!"><i class="material-icons">chevron_right</i></a></li>
    </ul>
</div>
</body>
</html>