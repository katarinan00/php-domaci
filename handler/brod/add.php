<?php

require "../../dbBroker.php";
require "../../model/brod.php";

if(isset($_POST['nazivBroda']) &&
    isset($_POST['zemljaPorekla']) &&
    isset($_POST['vrstaBroda'])){

    $brod = new Brod(null,$_POST['nazivBroda'],$_POST['zemljaPorekla'],
        $_POST['vrstaBroda']);

    $status = $brod->add($konekcija);

    if($status){
        echo"Uspesno";
    }else{
        echo "Neuspesno";
    }

}


?>