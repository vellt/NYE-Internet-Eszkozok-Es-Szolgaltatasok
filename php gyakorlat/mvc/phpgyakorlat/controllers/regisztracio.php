<?php
    require_once '../config/config.php';

    /**
     * vizsgaljuk erkezett-e adat a view-rol - isset
     * isset(valtozo) boolean, a aparmneterben megadott valtozo vagy tombelem letezik-e
     * 
     * kotelezo mezok vizsgalata - empty
     * empty(valtozo) boolean, letezo valtozot var, ha van erteke false, ha ures vagy null akkor true
     * 
     * $array = array();
     * $array[] = "";
     * 
     * tombok: 1. sorszamozott
     * 2. tarsitasos - az indexek stringek
     * 
     * Szuperglobalis tombok
     * $_GET, $_POST, $_FILES, $_SESSION, $_COOKIE, $_SERVER
     * 
     * 
     */
    
    /*
    print "<pre>";
        print_r($_POST);
    print "</pre>";
    */

    if(isset($_POST['vezeteknev']))
    {
        //KOTELEZO mezok vizsgalata
        if
        (
            empty($_POST['email'])          ||
            empty($_POST['felhasznalonev']) ||
            empty($_POST['jelszo'])         ||
            empty($_POST['jelszoujra'])     ||
            empty($_POST['szuletesiev'])

        )
        {
            //JSON tartalmat
            //hozzarendeles muvelete (tomb eleme): =>
            print json_encode(['uzenet'=>'Kötelező mezők!','class'=>'alert alert-danger']);
            return;
        }

        //jelszavak ell.
        if($_POST['jelszo'] != $_POST['jelszoujra'])
        {
            print json_encode(['uzenet'=>'A jelszavak nem egyeznek!','class'=>'alert alert-danger']);
            return;
        }

        


        /**
         * XSS tamadas és SQL injekció elleni vedelem - htmlspecialchars
         * XSS - HTML, javascript, CSS tartalmak ervenyesitese az oldalon
         * htmlspecialchars: < = &lt; > = &gt;
         * SQL- SQL skriptet futtatnak be az adatbazisba - real_escape_string
         * real_escape_string: ' = \', " = \"
         * foreach - kifejezetten tombok es objektumok bejarasa
         * foreach(array as kulcs=>ertek)
         */

        $hirlevel = 0;
        foreach($_POST as $kulcs => $ertek)
        {
            //dinamikus valtozo letrehozasa az indexekbol $$
            // $a = 'alma'; $$a; - $alma
            $$kulcs = htmlspecialchars($mydb->real_escape_string($ertek));
        }

        //ismetlodo email es felhasznalonev ellenorzese
        $sql = "SELECT * FROM users WHERE felhasznalonev='{$felhasznalonev}' OR email='{$email}'";
        $query = $mydb->query($sql);
        if($query->num_rows)
        {
            print json_encode(['uzenet'=>'Felhasználónév vagy email már regisztrált!','class'=>'alert alert-danger']);
            return;
        }


         //jelszo hash sha256
         //jelszo zajositas
         $jelszo = hash('sha256',$jelszo.$zaj);

         //INSERT SQL
         $sql = "INSERT INTO users(vezeteknev,keresztnev,email,felhasznalonev,jelszo,neme,szuletesiev,hirlevel,leiras) VALUES
                ('{$vezeteknev}','{$keresztnev}','{$email}','{$felhasznalonev}','{$jelszo}','{$neme}','{$szuletesiev}','{$hirlevel}','{$leiras}')
                ";

        //SQL skript befuttatasa az db-re (query)
        if($mydb->query($sql))
        {
            print json_encode(['uzenet'=>'Sikeres regisztráció! Kérem, lépjen be.','class'=>'alert alert-success']);
            return;
        }
        else
        {
            print $mydb->error;
        }

    }
?>