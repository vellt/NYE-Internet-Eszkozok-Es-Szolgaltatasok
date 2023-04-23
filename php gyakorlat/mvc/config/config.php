<?php


  // munkamenet indítása, ezek után lehet a $_SESSION globális tömböt használni
  // böngésző bezárásáig szolgáltat adatot
  session_start();

  /**
   *  $ _
   * $host = "";
   */
  $host = "localhost";
  $user = "phpg";
  $pass = "54)i(W9!5]EL7*nY";
  $db   = "phpgyakorlat"; 

  //Kapcsolodas az adatbazisszerverhez
  $mydb = new mysqli($host,$user,$pass,$db);
  
  //if(feltetel) {true} else {false}
  //osszefuzes jele . (pont)
  //kiiratas: print, echo 
  if($mydb->connect_errno)
    die('Kapcsolodasi hiba: ' . $mydb->connect_error);
## else print "siker";

  $zaj = "WSDEEF346m8uil87923453  '''dfgREZT!%Z657898ö)(ÖO()KHJFHFDXV ETW+%+!";

  $doc_root='/phpgyakorlat/';

  $session_time=time() + (60*60*24); //egy nap másodperceinek száma: (60*60*24)

  // kilépés kezelése
  if(isset($_GET['kilepes'])){ //get mivel url-en küldöm
    unset($_SESSION['user']); // kitöröljük a sessionből a user-t
    // $_SESSION=[];
    // $_SESSION=array();

    // lejáratjuk a sütit
    setcookie('remember_me',' ',time()-10, '/'); //10 másodpercel elmult az időpont, azaz leját
    unset($_COOKIE['remember_me']); // de törlöm a cookiból a remember_me-t
  }


  // nagyon fontos hogy ezt is lekezeljük: !empty($_COOKIE['remember_me']), hiszen ha a felhasználó a böngészőben 
  // null-ra állítja, akkor az adatbázisban lévő összes felhasználót le fogja hívni ahol null az érték! És akik
  // még egyszer sem kapcsolták be az emlékezz rám funkciót ott null az érték!!!

  // remeber me lekezelése
  if(!isset($_SESSION['user']) && isset($_COOKIE['remember_me']) && !empty($_COOKIE['remember_me'])){
    
    // sql szűrés
    $remember_me = $mydb->real_escape_string($_COOKIE['remember_me']);

    $sql ="SELECT * FROM users WHERE remember_me_token='{$remember_me}'";

    $query= $mydb->query($sql);

    if($query->num_rows){
      $_SESSION['user']=$query->fetch_assoc();

      //cookie frissitese
      //mivel a bállított egy nap folyamatosan ketyeg visszagfele
      setcookie('remember_me', $remember_me,  $session_time, '/');
    }
  }

  // védett oldalak
  $user_acl=[
    'profil',
    'felhasznalok'
  ];

  // lehetne admin_acl-t
  // vagy free_acl-t is

  if(!isset($_SESSION['user']) && isset($_GET['oldal'])){
    //iin_array attribútumai: string/szám,miben
    if(in_array($_GET['oldal'],$user_acl)){
      header('Location: ' . $doc_root . 'index.php?oldal=belepes&redirect=' . $_GET['oldal']);
    }
  }

?>