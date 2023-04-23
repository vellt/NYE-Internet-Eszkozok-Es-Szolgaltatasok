<?php require_once 'config/config.php' ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    
    <link rel="stylesheet" href="//cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css">
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>

    <script src="js/jquery-3.6.4.min.js"></script>

    <script src="//cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>

    <title>Teszt PHP</title>
</head>
<body>
    <div class="container">
    <?php 
        //
        # egysoros
        /**
         * include 'forras' - beemeli a forrasallomany tartalmat hiba eseten Warning, de az oldal tovabb mukodik
         * include_once - csak egyszer emeli be a forrast tobbszori meghivasra is
         * 
         * require - hiba eseten Parse - FATAL error, az oldal működése megáll
         * require_once
         * 
         * Hibauzenetek:
         * - Notice pl. nem letezo valtozora hivatkozom
         * - Warning az oldal tovabb mukodik, 
         * - Parse - FATAL error rendszerint szintaktikai hiba
         */
        include_once 'elements/menu.php';
    ?>
    <div id="uzenet" class="ajax-uzenetek"></div>
    <!-- =-el a print-et válthatjuk le -->
    <!-- @-al el tudjuk takarni azt a hibaüzenetet, amit nem létező változónál, index hivatkozásnál kapunk -->
    <?php if(isset($_SESSION['uzenet'])):  ?>
        <div class="<?=@$_SESSION['class']?>"><?=$_SESSION['uzenet']?></div>
    <?php 
        // unset() utasítással változó vagy tömb elem megszüntetése
        unset($_SESSION['uzenet']);
        unset($_SESSION['class']);
        endif;
    ?>  
    
    <!--
        <pre>
            <?php print_r($_SESSION) ?>
            <?php print_r($_COOKIE) ?>
        </pre>

    -->
    <?php
        if(isset($_GET['oldal']))
        {
            //vizsgalom a view allomany letezeset file_exists()
            $viewpath = 'views/' . $_GET['oldal'] . '.php';
            if(file_exists($viewpath))
            {
                require_once $viewpath;
            }
            else
            {
                require_once 'errors/404.html';
            }
        }
        else
        {
            require_once 'views/fooldal.php';
        }
    ?>
    <?php //require_once 'views/regisztracio.php' ?>

    <!-- HTML -->
    </div>
</body>
</html>
