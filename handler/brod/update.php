<?php

require "../../dbBroker.php";
require "../../model/brod.php";

if( isset($_POST['id']) &&
    isset($_POST['nazivBroda']) &&
    isset($_POST['zemljaPorekla']) &&
    isset($_POST['vrstaBroda'])){
    $brod = new Brod($_POST['id'],$_POST['nazivBroda'],$_POST['zemljaPorekla'],
        $_POST['vrstaBroda']);

    $status = $brod->update($konekcija);

    if($status){
        echo"Uspesno";
    }else{
        echo $status;
        echo "Neuspesno";
    }

}

?>