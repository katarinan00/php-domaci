<?php

require "../../dbBroker.php";
require "../../model/luka.php";

if( isset($_POST['id']) &&
    isset($_POST['nazivLuke']) &&
    isset($_POST['brod_id']) &&
    isset($_POST['korisnik_id']) &&
    isset($_POST['grad'])){

    $luka = new Luka($_POST['id'],$_POST['nazivLuke'],$_POST['brod_id'],
        $_POST['korisnik_id'],$_POST['grad']);

    $status = $luka->update($konekcija);

    if($status){
        echo"Uspesno";
    }else{
        echo $status;
        echo "Neuspesno";
    }

}

?>