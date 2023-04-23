<?php
    require_once '../config/config.php';

    if(isset($_POST['vezeteknev']))
    {
        //KOTELEZO mezok vizsgalata
        if
        (
            empty($_POST['email'])          ||
            empty($_POST['felhasznalonev']) ||
            empty($_POST['szuletesiev'])

        )
        {
            //JSON tartalmat
            //hozzarendeles muvelete (tomb eleme): =>
            print json_encode(['uzenet'=>'Kötelező mezők!','class'=>'alert alert-danger']);
            return;
        }

        //jelszavak ell.
        if(!empty($_POST['jelszo'])){
            if($_POST['jelszo'] != $_POST['jelszoujra'])
            {
                print json_encode(['uzenet'=>'A jelszavak nem egyeznek!','class'=>'alert alert-danger']);
                return;
            }
        }
        
        $hirlevel = 0;
        foreach($_POST as $kulcs => $ertek)
        {
            //dinamikus valtozo letrehozasa az indexekbol $$
            // $a = 'alma'; $$a; - $alma
            $$kulcs = htmlspecialchars($mydb->real_escape_string($ertek));
        }

        //ismetlodo email es felhasznalonev ellenorzese
        $sql = "SELECT * FROM users WHERE (felhasznalonev='{$felhasznalonev}' OR email='{$email}') AND id<>'{$_SESSION['user']['id']}'";
        $query = $mydb->query($sql);
        if($query->num_rows)
        {
            print json_encode(['uzenet'=>'Felhasználónév vagy email már regisztrált!','class'=>'alert alert-danger']);
            return;
        }
        
        if(!empty($_POST['jelszo'])){
            //jelszó frissítés
            //jelszo hash sha256
            //jelszo zajositas
            $jelszo = hash('sha256',$jelszo.$zaj);
            $sql ="UPDATE users SET vezeteknev='{$vezeteknev}',keresztnev='{$keresztnev}',email='{$email}',felhasznalonev='{$felhasznalonev}',jelszo='{$jelszo}',neme='{$neme}',szuletesiev='{$szuletesiev}',hirlevel='{$hirlevel}',leiras='{$leiras}' WHERE id='{$_SESSION['user']['id']}'";
        }else{
            // nincs jelszó
            $sql ="UPDATE users SET vezeteknev='{$vezeteknev}',keresztnev='{$keresztnev}',email='{$email}',felhasznalonev='{$felhasznalonev}',neme='{$neme}',szuletesiev='{$szuletesiev}',hirlevel='{$hirlevel}',leiras='{$leiras}' WHERE id='{$_SESSION['user']['id']}'";
        }


        //SQL skript befuttatasa az db-re (query)
        if($mydb->query($sql))
        {
            print json_encode(['uzenet'=>'Sikeres módosítás!','class'=>'alert alert-success']);
            $sql = "SELECT * FROM users WHERE id= '{$_SESSION['user']['id']}'";
            $query = $mydb->query($sql);
            $_SESSION['user']= $query->fetch_assoc();
            return;
        }
        else
        {
            print $mydb->error;
        }

    }

    // moodle teszt megajlánott május utolsó hete, !egy hétre megosztja, , kb 40 kérdés. 
    // mvc jun 26
    
?>