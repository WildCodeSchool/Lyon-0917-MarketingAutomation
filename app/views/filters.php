<?php
?>
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
    <link rel="stylesheet" href="../../web/css/main.css"
</head>

<body>

<div class="row">

    <div class="col s12 m6 l3">
        <h2>Choisissez des critères</h2>
        <ul class="collapsible" data-collapsible="accordion">
            <li>
                <div class="collapsible-header">
                    First filter family
                </div>
                <div class="collapsible-body">
                    <form action="#">
                        <p>
                            <input type="checkbox" class="filled-in" id="test1"  />
                            <label for="test1">Sms</label>
                        </p>
                        <p>
                            <input type="checkbox" class="filled-in" id="test2"  />
                            <label for="test2">Mail</label>
                        </p>
                        <p>
                            <input type="checkbox" class="filled-in" id="test3"  />
                            <label for="test3">Pigeon voyageur</label>
                        </p>
                    </form>
                </div>
            </li>
            <li>
                <div class="collapsible-header">
                    Second filter Family
                </div>
                <div class="collapsible-body">
                    <form action="#">
                        <p>
                            <input type="checkbox" class="filled-in" id="test4"  />
                            <label for="test4">BtoB</label>
                        </p>
                        <p>
                            <input type="checkbox" class="filled-in" id="test5"  />
                            <label for="test5">BtoC</label>
                        </p>
                        <p>
                            <input type="checkbox" class="filled-in" id="test6"  />
                            <label for="test6">BtoBtoC</label>
                        </p>
                    </form>
                </div>
            </li>
            <li>
                <div class="collapsible-header">
                    Others
                </div>
                <div class="collapsible-body">
                    <form action="#">
                        <p>
                            <input type="checkbox" class="filled-in" id="test4"  />
                            <label for="test4">Cycle long</label>
                        </p>
                        <p>
                            <input type="checkbox" class="filled-in" id="test5"  />
                            <label for="test5">Français</label>
                        </p>
                        <p>
                            <input type="checkbox" class="filled-in" id="test6"  />
                            <label for="test6">Utilisable sur Mac</label>
                        </p>
                    </form>
                </div>
            </li>
        </ul>
        <p>Indiquez une fourchette de prix:</p><br>
        <div id="test-slider"></div>
    </div>

</div>


<script type="text/javascript" src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.100.2/js/materialize.min.js"></script>
<script src="../../web/js/application.filters.js"></script>
<script src="../../web/js/nouislider.min.js"></script>
</body>
</html>
