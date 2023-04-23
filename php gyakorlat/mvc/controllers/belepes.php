<?php
    require_once '../config/config.php';

    // post-al érkezik az űrlapról az adat
    if(isset($_POST['username'])){
        // kötelező mezők megvizsgálása!
        if(
            empty($_POST['username'])  ||
            empty($_POST['password']) 
        ){
            $_SESSION['uzenet']='Kötelező mezők!';
            $_SESSION['class']='alert alert-danger';
            
            // visszairanyitom a felh-t a belépési oldalra (header())
            header('Location: index.php?oldal=belepes');
            return; //megallítom az értelmező tovább futását, mert a header ezt implicit módon nem teszi ezt meg.

        } 

        // sql injekció szűrése, SQL védelem
        foreach($_POST as $kulcs=>$ertek){
            // dinamikus változó létrehozása: $$
            $$kulcs = $mydb->real_escape_string($ertek); 
        }

        // jelszó előállítása
        $jelszo = hash('sha256', $password.$zaj);

        $sql="SELECT * FROM users WHERE (email='{$username}' OR felhasznalonev='{$username}') AND jelszo='{$jelszo}'";
        if($query = $mydb->query($sql)){
            //SQL lefut, de még nem biztos h van találat
            if($query->num_rows) {  // ha nincs találat 1, ha van >0
                // sikeres a beléps
                $_SESSION['user']= $query->fetch_assoc(); // ha ez már létezik akkor bejelentkezett!
                $_SESSION['uzenet']='Sikeres belépés!';
                $_SESSION['class']='alert alert-success';
                
                // remember me
                if(isset($_POST['remember_me'])){ // ha létezik be van kapcsolwa a checkbox
                    // remember_me_token -uniqid
                    $token = hash('sha256',uniqid().$jelszo);

                    // mentem a tokent az adatbázisba
                    $sql = "UPDATE users SET remember_me_token ='{$token}' WHERE id='{$_SESSION['user']['id']}'";

                    $mydb->query($sql); // befuttatjuk a szerverbe

                    // létrehozom a sütit (cookie) - setcookie() 4 kötelező paraméter: név , tartalom, lejárat, útvonal
                    // lejárati idő UNIX idő 1970.01.01 től eltelt másodpercek száma
                    // a / jel azt jelenti hogy minden útvonalon elérhető
                    setcookie('remember_me', $token, $session_time, '/');
                } 
                // redirectet is le kell most már kezelni
                if(isset($_POST['redirect']) && !empty($_POST['redirect'])){
                    header('Location: ' . $doc_root . 'index.php?oldal='.$_POST['redirect']);
                    return;
                }
                // sikeres belépés ha nics redirect akkor főoldal!
                header('Location: ' . $doc_root . 'index.php');
                return;
            }else{
                // sikertelen a belépés
                $_SESSION['uzenet']='Sikertelen belépés!';
                $_SESSION['class']='alert alert-danger';
                header('Location: ' . $doc_root . 'index.php?oldal=belepes');
                return;
            }
        }else{
            // sql nem futott le! hiba!
            print $mydb->error;
        }
    }

?>