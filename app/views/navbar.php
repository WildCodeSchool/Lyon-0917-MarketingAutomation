<?php
/**
 * Created by PhpStorm.
 * User: andy
 * Date: 04/10/17
 * Time: 15:44
 */
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <!--Import materialize.css-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.100.2/css/materialize.min.css">
    <!--Import Google Icon Font-->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">



    <title>Demo</title>
</head>
<body>
<div>
    <nav>
        <div class="nav-wrapper blue darken-1">
            <a href="#" class="brand-logo">Logo</a>
            <a href="#" data-activates="mobile-demo" class="button-collapse"><i class="material-icons">menu</i></a>
            <ul id="nav-mobile" class="right hide-on-med-and-down">
                <li>
                    <form action="">
                        <div class="center row">
                            <div class="col s12 ">
                                <div class="row" id="topbarsearch">
                                    <div class="input-field col s6 s12 ">
                                        <i class="material-icons prefix">search</i>
                                        <input type="text" placeholder="Recherche" id="autocomplete-input"
                                               class="autocomplete" style="text-align:center">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </li>
                <li><a href="#">Logiciels Marketing Automation</a></li>
                <li><a href="#">Comparatif Logiciels Automation</a></li>
                <li><a href="#">Contact</a></li>
            </ul>
            <ul class="side-nav" id="mobile-demo">
                <li><a href="#">Logiciels Marketing Automation</a></li>
                <li><a href="#">Comparatif Logiciels Automation</a></li>
                <li><a href="#">Contact</a></li>
            </ul>

        </div>
    </nav>
    <div class="hide-on-large-only">
        <form>
            <div class="input-field">
                <input id="search" type="search" required id="autocomplete-input" class="autocomplete" style="text-align:center">
                <label class="label-icon" for="search"><i class="material-icons">search</i></label>
                <i class="material-icons">close</i>
            </div>
        </form>
    </div>
</div>



<!--Import jQuery before materialize.js-->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.100.2/js/materialize.min.js"></script>
<script src="../../web/js/main.js"></script>


</body>
</html>


