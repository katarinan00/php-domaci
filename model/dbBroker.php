<?php

     $user = 'root';
     $password = '';
     $server = 'localhost';
     $database = 'evidencija_luka';


    $konekcija = new mysqli($server,$user,$password,$database);

    if($konekcija->connect_errno){
        exit('Neuspelo povezivanje sa bazom, greska: '. $konekcija->connect_error);
    }

?>