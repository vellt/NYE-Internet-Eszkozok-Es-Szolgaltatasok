<?php


  // munkamenet indítása, ezek után lehet a $_SESSION globális tömböt használni
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

  $session_time=time() + (60*60*24); //egy napnak a másodpercei :(60*60*24)

  // kilépés kezelése
  if(isset($_GET['kilepes'])){
    unset($_SESSION['user']);
    // $_SESSION=[];
    // $_SESSION=array();

    // lejáratjuk a sütit
    setcookie('remember_me',' ',time()-10, '/');
    unset($_COOKIE['remember_me']);
  }

  // remeber me
  if(!isset($_SESSION['user']) && isset($_COOKIE['remember_me']) && !empty($_COOKIE['remember_me'])){
    
    // sql szűrés
    $remember_me = $mydb->real_escape_string($_COOKIE['remember_me']);

    $sql ="SELECT * FROM users WHERE remember_me_token='{$remember_me}'";

    $query= $mydb->query($sql);

    if($query->num_rows){
      $_SESSION['user']=$query->fetch_assoc();

      //cookie frissitese
      setcookie('remember_me', $remember_me,  $session_time, '/');
    }
  }

  // védett oldalak
  $user_acl=[
    'profil'
  ];

  if(!isset($_SESSION['user']) && isset($_GET['oldal'])){
    if(in_array($_GET['oldal'],$user_acl)){
      header('Location: ' . $doc_root . 'index.php?oldal=belepes&redirect='.$_GET['oldal']);
    }
  }

?>